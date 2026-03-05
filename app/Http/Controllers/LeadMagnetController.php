<?php

namespace App\Http\Controllers;

use App\Jobs\AddLeadToEmailSequence;
use App\Models\LeadMagnetSubscriber;
use App\Models\Quote;
use App\Models\Settings;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LeadMagnetController extends Controller
{
    public function show(): View
    {
        return view('pages.lead-magnet', [
            'contact' => $this->getContact(),
            'hero' => $this->getHero(),
        ]);
    }

    public function submit(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'email' => 'required|email|max:255',
            'name' => 'nullable|string|max:255',
        ]);

        $wasNew = !LeadMagnetSubscriber::where('email', $validated['email'])->exists();

        $subscriber = LeadMagnetSubscriber::updateOrCreate(
            ['email' => $validated['email']],
            [
                'name' => $validated['name'] ?? null,
                'downloaded_at' => now(),
            ]
        );

        if ($wasNew) {
            $quote = Quote::create([
                'client_name' => $subscriber->name ?? 'Lead Magnet',
                'email' => $subscriber->email,
                'service_type' => 'renovation',
                'status' => 'pending',
                'stage' => Quote::STAGE_NEW,
                'is_partial' => false,
                'step' => 2,
                'lead_score' => 1,
                'lead_source' => 'lead_magnet_free_guide',
            ]);

            AddLeadToEmailSequence::dispatch($quote);
        }

        session(['lead_magnet_accessed' => true]);

        return redirect()->route('lead-magnet.guide')
            ->with('success', $wasNew ? 'Check your email — we\'ve sent you the guide!' : 'Your guide is ready.');

    }

    public function guide(Request $request): View|RedirectResponse
    {
        if (!session('lead_magnet_accessed')) {
            return redirect()->route('lead-magnet.show');
        }

        return view('pages.lead-magnet-guide', [
            'contact' => $this->getContact(),
            'hero' => $this->getHero(),
        ]);
    }

    private function getContact(): array
    {
        $settings = Settings::where('group', 'contact')->pluck('value', 'key')->toArray();
        $phone = $settings['contact_phone'] ?? '+1.3476366128';
        return [
            'phone' => $phone,
            'phone_link' => str_replace(['.', ' ', '-'], '', $phone),
            'whatsapp' => str_replace(['.', ' ', '-'], '', $settings['contact_whatsapp'] ?? $phone),
        ];
    }

    private function getHero(): array
    {
        $settings = Settings::where('group', 'hero')->pluck('value', 'key')->toArray();
        return [
            'cta_text' => $settings['hero_cta_text'] ?? 'Get Your Free Quote',
        ];
    }
}
