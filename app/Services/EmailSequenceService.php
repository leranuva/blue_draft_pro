<?php

namespace App\Services;

use App\Jobs\SendSequenceEmailJob;
use App\Models\Quote;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class EmailSequenceService
{
    /**
     * Add a lead to the email sequence.
     * Dispatches 6 emails: immediate, 24h, 3d, 7d, 10d, 14d.
     * Optionally adds contact to Brevo list for CRM.
     */
    public function addLeadToSequence(Quote $quote): bool
    {
        if (!config('email_sequence.enabled')) {
            Log::debug('Email sequence disabled, skipping', ['quote_id' => $quote->id]);
            return false;
        }

        $delays = config('email_sequence.delays', [1 => 0, 2 => 24, 3 => 72, 4 => 168, 5 => 240, 6 => 336]);

        foreach ([1, 2, 3, 4, 5, 6] as $num) {
            $delayMinutes = ($delays[$num] ?? 0) * 60;
            SendSequenceEmailJob::dispatch($quote, $num)
                ->delay(now()->addMinutes($delayMinutes));
        }

        $this->addContactToBrevo($quote);

        Log::info('Lead added to email sequence', ['quote_id' => $quote->id, 'emails' => 6]);
        return true;
    }

    /**
     * Add contact to Brevo list (CRM) when API key is set.
     */
    private function addContactToBrevo(Quote $quote): void
    {
        $apiKey = config('email_sequence.brevo.api_key');
        $listId = config('email_sequence.brevo.list_id');
        if (!$apiKey) {
            return;
        }

        try {
            $response = Http::withHeaders(['api-key' => $apiKey])
                ->post('https://api.brevo.com/v3/contacts', [
                    'email' => $quote->email,
                    'attributes' => [
                        'FIRSTNAME' => $quote->client_name,
                        'PHONE' => $quote->phone ?? '',
                        'SMS' => $quote->phone ?? '',
                        'ADDRESS' => $quote->address ?? '',
                        'QUOTE_ID' => (string) $quote->id,
                        'SERVICE_TYPE' => $quote->service_type ?? '',
                    ],
                    'listIds' => $listId ? [(int) $listId] : [],
                    'updateEnabled' => true,
                ]);

            if ($response->successful()) {
                Log::info('Contact added to Brevo', ['quote_id' => $quote->id]);
            } else {
                Log::warning('Brevo contact add failed', ['quote_id' => $quote->id, 'response' => $response->json()]);
            }
        } catch (\Exception $e) {
            Log::error('Brevo API error', ['quote_id' => $quote->id, 'error' => $e->getMessage()]);
        }
    }

    /**
     * Send transactional email via Brevo API (alternative to Laravel Mail).
     */
    public function sendViaBrevoApi(string $to, string $subject, string $htmlContent, ?string $replyTo = null): bool
    {
        $apiKey = config('email_sequence.brevo.api_key');
        if (!$apiKey) {
            return false;
        }

        $response = Http::withHeaders(['api-key' => $apiKey])
            ->post('https://api.brevo.com/v3/smtp/email', [
                'sender' => [
                    'name' => config('mail.from.name', 'Blue Draft'),
                    'email' => config('mail.from.address', config('mail.admin_notification_email')),
                ],
                'to' => [['email' => $to]],
                'subject' => $subject,
                'htmlContent' => $htmlContent,
                'replyTo' => $replyTo ? ['email' => $replyTo] : null,
            ]);

        return $response->successful();
    }
}
