<?php

namespace App\Http\Controllers;

use App\Jobs\AddLeadToEmailSequence;
use App\Mail\QuoteNotification;
use App\Models\Quote;
use App\Models\QuoteAttachment;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class QuoteController extends Controller
{
    /**
     * Guarda el Step 1 (parcial) — nombre, email, servicio.
     * Se llama vía AJAX cuando el usuario completa el paso 1.
     */
    public function savePartial(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'service' => 'required|string|in:residential,commercial,renovation,other',
            'timeline' => 'nullable|string|max:50',
            'property_type' => 'nullable|string|max:50',
            'calculator_budget_min' => 'nullable|string|max:20',
            'calculator_budget_max' => 'nullable|string|max:20',
            'calculator_sqft' => 'nullable|integer|min:1|max:50000',
            'calculator_type' => 'nullable|string|max:50',
            'calculator_borough' => 'nullable|string|max:50',
            'calculator_finish_level' => 'nullable|string|max:20',
            'calculator_algorithm_version' => 'nullable|string|max:20',
            'estimated_value' => 'nullable|numeric|min:0',
            'calculation_hash' => 'nullable|string|max:64',
        ]);

        $tracking = Quote::extractTrackingFromRequest($request);
        $fromCalculator = $request->input('from_calculator') === true || $request->input('from_calculator') === 'true';
        if ($fromCalculator) {
            $tracking['lead_source'] = 'calculator';
        }

        $calcMin = $validated['calculator_budget_min'] ?? null;
        $calcMax = $validated['calculator_budget_max'] ?? null;
        $estimatedValue = !empty($validated['estimated_value']) ? (float) $validated['estimated_value'] : null;
        if ($fromCalculator && $calcMin && $calcMax && !$estimatedValue) {
            $estimatedValue = round(((float) $calcMin + (float) $calcMax) / 2);
        }
        $calcType = $validated['calculator_type'] ?? null;
        $calcBorough = $validated['calculator_borough'] ?? null;
        $costRatioMatrix = config('cost_calculator.cost_ratio_type_borough', []);
        $costRatio = ($calcType && $calcBorough && isset($costRatioMatrix[$calcType][$calcBorough]))
            ? $costRatioMatrix[$calcType][$calcBorough]
            : config('cost_calculator.cost_ratio', 0.75);
        $internalCost = $estimatedValue ? round($estimatedValue * $costRatio, 2) : null;
        $expectedMargin = ($estimatedValue && $internalCost) ? round($estimatedValue - $internalCost, 2) : null;

        $leadScore = Quote::calculateLeadScore([
            'estimated_budget' => ($calcMin && $calcMax) ? ($calcMin . '-' . $calcMax) : null,
            'service_type' => $validated['service'],
            'message' => null,
            'address' => null,
            'phone' => null,
            'borough' => $validated['calculator_borough'] ?? null,
            'calculator_budget_min' => $calcMin,
            'calculator_budget_max' => $calcMax,
            'calculator_sqft' => $validated['calculator_sqft'] ?? null,
            'calculator_borough' => $validated['calculator_borough'] ?? null,
            'calculator_finish_level' => $validated['calculator_finish_level'] ?? null,
        ], false);

        $quote = Quote::create(array_merge([
            'client_name' => $validated['name'],
            'email' => $validated['email'],
            'service_type' => $validated['service'],
            'phone' => null,
            'address' => null,
            'estimated_budget' => ($calcMin && $calcMax) ? ($calcMin . '-' . $calcMax) : null,
            'estimated_value' => $estimatedValue,
            'message' => null,
            'status' => 'pending',
            'stage' => Quote::STAGE_NEW,
            'is_partial' => true,
            'step' => 1,
            'lead_score' => $leadScore,
            'source_url' => $request->header('Referer'),
            'user_agent' => $request->userAgent(),
            'ip_address' => $request->ip(),
            'timeline' => $validated['timeline'] ?? null,
            'property_type' => $validated['property_type'] ?? null,
            'calculator_budget_min' => $calcMin,
            'calculator_budget_max' => $calcMax,
            'calculator_sqft' => $validated['calculator_sqft'] ?? null,
            'calculator_type' => $validated['calculator_type'] ?? null,
            'calculator_borough' => $validated['calculator_borough'] ?? null,
            'calculator_finish_level' => $validated['calculator_finish_level'] ?? null,
            'calculator_algorithm_version' => $validated['calculator_algorithm_version'] ?? null,
            'calculation_hash' => $validated['calculation_hash'] ?? null,
            'internal_cost_estimate' => $internalCost,
            'expected_margin' => $expectedMargin,
            'lead_source' => $tracking['lead_source'] ?? null,
        ], $tracking));

        Log::info('Partial quote saved (Step 1)', [
            'quote_id' => $quote->id,
            'email' => $quote->email,
        ]);

        return response()->json([
            'success' => true,
            'quote_id' => $quote->id,
        ]);
    }

    /**
     * Completa el Step 2 y envía notificación.
     */
    public function complete(Request $request): RedirectResponse
    {
        $rules = [
            'quote_id' => 'required|integer|exists:quotes,id',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
            'budget' => 'nullable|string|max:50',
            'message' => 'nullable|string|max:2000',
            'photos.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
        ];

        if (config('services.recaptcha.secret')) {
            $rules['g-recaptcha-response'] = 'required|string';
        } else {
            $rules['g-recaptcha-response'] = 'nullable|string';
        }

        $validated = $request->validate($rules);

        // Verificar reCAPTCHA solo si está configurado
        $recaptchaSecret = config('services.recaptcha.secret');
        if ($recaptchaSecret) {
            $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
                'secret' => $recaptchaSecret,
                'response' => $validated['g-recaptcha-response'] ?? '',
                'remoteip' => $request->ip(),
            ]);

            $result = $response->json();
            if (!$result['success'] ?? false) {
                return back()->withErrors(['recaptcha' => 'La verificación de reCAPTCHA falló. Por favor, inténtalo de nuevo.'])->withInput();
            }
        }

        $quote = Quote::findOrFail($validated['quote_id']);

        if (!$quote->is_partial) {
            return back()->withErrors(['quote' => 'Esta solicitud ya fue completada.'])->withInput();
        }

        $hasPhotos = $request->hasFile('photos');
        $tracking = Quote::extractTrackingFromRequest($request);
        if (empty($quote->utm_source) && !empty($tracking['utm_source'])) {
            // Fill UTM from step 2 if not captured in step 1
            $tracking = array_filter($tracking);
        } else {
            $tracking = [];
        }

        $updateData = array_merge([
            'phone' => $request->input('phone') ?: null,
            'address' => $request->input('address') ?: null,
            'estimated_budget' => $request->input('budget') ?: null,
            'message' => $request->input('message') ?: null,
            'is_partial' => false,
            'step' => 2,
            'source_url' => $quote->source_url ?: $request->header('Referer'),
            'user_agent' => $quote->user_agent ?: $request->userAgent(),
            'ip_address' => $quote->ip_address ?: $request->ip(),
        ], $tracking);
        $address = $updateData['address'] ?? $quote->address;
        $borough = Quote::inferBoroughFromAddress($address) ?: $quote->borough;
        $updateData['borough'] = $borough;
        $updateData['lead_score'] = Quote::calculateLeadScore([
            'estimated_budget' => $updateData['estimated_budget'],
            'service_type' => $quote->service_type,
            'message' => $updateData['message'],
            'address' => $address,
            'phone' => $updateData['phone'] ?? $quote->phone,
            'borough' => $borough,
            'calculator_budget_min' => $quote->calculator_budget_min,
            'calculator_budget_max' => $quote->calculator_budget_max,
            'calculator_sqft' => $quote->calculator_sqft,
            'calculator_borough' => $quote->calculator_borough,
            'calculator_finish_level' => $quote->calculator_finish_level,
        ], $hasPhotos);

        $quote->update($updateData);

        if ($hasPhotos) {
            foreach ($request->file('photos') as $photo) {
                $path = $photo->store('quotes/' . $quote->id, 'public');
                QuoteAttachment::create([
                    'quote_id' => $quote->id,
                    'file_path' => $path,
                    'file_type' => $photo->getMimeType(),
                    'original_name' => $photo->getClientOriginalName(),
                    'file_size' => $photo->getSize(),
                ]);
            }
        }

        $quote->load('attachments');

        try {
            Mail::to(config('mail.admin_notification_email'))->send(new QuoteNotification($quote));
            Log::info('Quote notification email sent', ['quote_id' => $quote->id]);
        } catch (\Exception $e) {
            Log::error('Failed to send quote notification', [
                'quote_id' => $quote->id,
                'error' => $e->getMessage(),
            ]);
        }

        AddLeadToEmailSequence::dispatch($quote);

        return back()->with('success', 'Thank you for your quote request! We will review your data and contact you soon.');
    }
}
