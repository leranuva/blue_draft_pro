<?php

namespace App\Http\Controllers;

use App\Jobs\AddLeadToEmailSequence;
use App\Mail\ContactNotification;
use App\Mail\QuoteNotification;
use App\Models\Project;
use App\Models\Quote;
use App\Models\QuoteAttachment;
use App\Models\Settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $projects = Project::where('is_featured', true)
            ->orWhere(function($query) {
                $query->whereNotNull('image_before')
                      ->orWhereNotNull('image_after');
            })
            ->latest()
            ->take(6)
            ->get();

        // Cargar settings del Hero
        $heroSettings = Settings::where('group', 'hero')
            ->pluck('value', 'key')
            ->toArray();

        // Cargar settings de About
        $aboutSettings = Settings::where('group', 'about')
            ->pluck('value', 'key')
            ->toArray();

        // Cargar settings de Services
        $servicesSettings = Settings::where('group', 'services')
            ->pluck('value', 'key')
            ->toArray();

        // Cargar settings de Testimonials
        $testimonialsSettings = Settings::where('group', 'testimonials')
            ->pluck('value', 'key')
            ->toArray();

        // Cargar settings de Contact
        $contactSettings = Settings::where('group', 'contact')
            ->pluck('value', 'key')
            ->toArray();

        // Cargar settings de Footer
        $footerSettings = Settings::where('group', 'footer')
            ->pluck('value', 'key')
            ->toArray();

        // Prefill quote form when coming from cost calculator
        $quotePrefill = [];
        if ($request->query('from') === 'calculator') {
            $quotePrefill = [
                'service' => $request->query('service', ''),
                'budget' => $request->query('budget', ''),
                'budget_min' => $request->query('budget_min', ''),
                'budget_max' => $request->query('budget_max', ''),
                'estimated_value' => $request->query('estimated_value', ''),
                'calc_sqft' => $request->query('calc_sqft', ''),
                'calc_type' => $request->query('calc_type', ''),
                'calc_borough' => $request->query('calc_borough', ''),
                'calc_finish' => $request->query('calc_finish', ''),
                'calc_version' => $request->query('calc_version', ''),
                'calculation_hash' => $request->query('calc_hash', ''),
            ];
        }

        return view('home', [
            'recaptchaSiteKey' => config('services.recaptcha.site_key', ''),
            'quotePrefill' => $quotePrefill,
            'projects' => $projects,
            'hero' => [
                'badge' => $heroSettings['hero_badge'] ?? 'Expert Construction',
                'title_line1' => $heroSettings['hero_title_line1'] ?? 'Solutions You',
                'title_line2' => $heroSettings['hero_title_line2'] ?? 'Can Trust',
                'subtitle' => $heroSettings['hero_subtitle'] ?? 'Free Estimates. On-Time Delivery. Guaranteed Quality.',
                'description' => $heroSettings['hero_description'] ?? 'Reliable construction services for your dream projects. We deliver high-quality results that exceed expectations with integrity, safety, and sustainable practices.',
                'cta_text' => $heroSettings['hero_cta_text'] ?? 'Get Your Free Quote',
                'phone' => $heroSettings['hero_phone'] ?? '+13476366128',
                'phone_display' => $heroSettings['hero_phone_display'] ?? '+1.3476366128',
                'image_text' => $heroSettings['hero_image_text'] ?? 'Construction Excellence',
                'image_svg_path' => $heroSettings['hero_image_svg_path'] ?? 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4',
                'background_image' => $heroSettings['hero_background_image'] ?? null,
                'placeholder_image' => $heroSettings['hero_placeholder_image'] ?? null,
            ],
            'about' => [
                'badge' => $aboutSettings['about_badge'] ?? 'About Us',
                'title' => $aboutSettings['about_title'] ?? 'About Blue Draft Company',
                'subtitle' => $aboutSettings['about_subtitle'] ?? 'Our Mission',
                'description_1' => $aboutSettings['about_description_1'] ?? 'At Blue Draft Construction Company, our mission is to deliver high-quality construction services that exceed client expectations. We are committed to integrity, safety, and sustainable practices in every project we undertake.',
                'description_2' => $aboutSettings['about_description_2'] ?? 'With years of experience in the construction industry, we bring expertise, reliability, and dedication to every project. From residential to commercial construction, we ensure that your vision becomes reality with the highest standards of quality and craftsmanship.',
                'stat_years' => $aboutSettings['about_stat_years'] ?? '15+',
                'stat_projects' => $aboutSettings['about_stat_projects'] ?? '200+',
                'stat_satisfaction' => $aboutSettings['about_stat_satisfaction'] ?? '100%',
                'stat_rating' => $aboutSettings['about_stat_rating'] ?? '4.9/5',
                'stat_borough' => $aboutSettings['about_stat_borough'] ?? null,
                'image' => $aboutSettings['about_image'] ?? null,
                'image_text' => $aboutSettings['about_image_text'] ?? 'Quality & Safety',
                'image_svg_path' => $aboutSettings['about_image_svg_path'] ?? 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z',
            ],
            'services' => [
                'badge' => $servicesSettings['services_badge'] ?? 'Our Services',
                'title' => $servicesSettings['services_title'] ?? 'What We Offer',
                'description' => $servicesSettings['services_description'] ?? 'Comprehensive construction solutions tailored to your needs',
                'service1' => [
                    'title' => $servicesSettings['services_service1_title'] ?? 'Residential Construction',
                    'description' => $servicesSettings['services_service1_description'] ?? 'From custom homes to renovations, we bring your residential vision to life with precision and quality craftsmanship.',
                    'svg_path' => $servicesSettings['services_service1_svg_path'] ?? 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4',
                ],
                'service2' => [
                    'title' => $servicesSettings['services_service2_title'] ?? 'Commercial Projects',
                    'description' => $servicesSettings['services_service2_description'] ?? 'Professional commercial construction services for offices, retail spaces, and business facilities.',
                    'svg_path' => $servicesSettings['services_service2_svg_path'] ?? 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4',
                ],
                'service3' => [
                    'title' => $servicesSettings['services_service3_title'] ?? 'Renovation & Remodeling',
                    'description' => $servicesSettings['services_service3_description'] ?? 'Transform your existing space with expert renovation services that enhance both function and aesthetics.',
                    'svg_path' => $servicesSettings['services_service3_svg_path'] ?? 'M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15',
                ],
            ],
            'testimonials' => [
                'badge' => $testimonialsSettings['testimonials_badge'] ?? 'What Our Clients Say',
                'title' => $testimonialsSettings['testimonials_title'] ?? 'Client Testimonials',
                'description' => $testimonialsSettings['testimonials_description'] ?? 'Don\'t just take our word for it. See what our satisfied clients have to say about our work.',
                'testimonial1' => [
                    'name' => $testimonialsSettings['testimonials_testimonial1_name'] ?? 'John & Sarah Martinez',
                    'role' => $testimonialsSettings['testimonials_testimonial1_role'] ?? 'Homeowners',
                    'project' => $testimonialsSettings['testimonials_testimonial1_project'] ?? 'Residential Renovation',
                    'rating' => (int)($testimonialsSettings['testimonials_testimonial1_rating'] ?? 5),
                    'image' => $testimonialsSettings['testimonials_testimonial1_image'] ?? '👨‍👩‍👧',
                    'text' => $testimonialsSettings['testimonials_testimonial1_text'] ?? 'Blue Draft transformed our outdated kitchen into a modern masterpiece. Their attention to detail and professionalism exceeded our expectations. We couldn\'t be happier with the results!',
                ],
                'testimonial2' => [
                    'name' => $testimonialsSettings['testimonials_testimonial2_name'] ?? 'Michael Chen',
                    'role' => $testimonialsSettings['testimonials_testimonial2_role'] ?? 'Business Owner',
                    'project' => $testimonialsSettings['testimonials_testimonial2_project'] ?? 'Commercial Construction',
                    'rating' => (int)($testimonialsSettings['testimonials_testimonial2_rating'] ?? 5),
                    'image' => $testimonialsSettings['testimonials_testimonial2_image'] ?? '👔',
                    'text' => $testimonialsSettings['testimonials_testimonial2_text'] ?? 'As a business owner, I needed a reliable construction partner. Blue Draft delivered on time, within budget, and with exceptional quality. Our new office space is exactly what we envisioned.',
                ],
                'testimonial3' => [
                    'name' => $testimonialsSettings['testimonials_testimonial3_name'] ?? 'Emily Rodriguez',
                    'role' => $testimonialsSettings['testimonials_testimonial3_role'] ?? 'Property Manager',
                    'project' => $testimonialsSettings['testimonials_testimonial3_project'] ?? 'Multi-Unit Renovation',
                    'rating' => (int)($testimonialsSettings['testimonials_testimonial3_rating'] ?? 5),
                    'image' => $testimonialsSettings['testimonials_testimonial3_image'] ?? '🏢',
                    'text' => $testimonialsSettings['testimonials_testimonial3_text'] ?? 'Working with Blue Draft was a pleasure from start to finish. They handled our complex multi-unit renovation project with expertise and kept us informed every step of the way.',
                ],
            ],
            'contact' => [
                'badge' => $contactSettings['contact_badge'] ?? 'Get In Touch',
                'title' => $contactSettings['contact_title'] ?? 'Contact Us',
                'description' => $contactSettings['contact_description'] ?? 'Have questions? We\'re here to help. Reach out to us today.',
                'address' => $contactSettings['contact_address'] ?? '358 Amboy St, Brooklyn, NY 11212, USA',
                'phone' => $contactSettings['contact_phone'] ?? '+1.3476366128',
                'phone_link' => $contactSettings['contact_phone_link'] ?? '+13476366128',
                'email' => $contactSettings['contact_email'] ?? config('mail.admin_notification_email'),
                'hours' => $contactSettings['contact_hours'] ?? 'Mon - Fri: 8:00 AM - 6:00 PM',
                'whatsapp' => $contactSettings['contact_whatsapp'] ?? '13476366128',
                'form_title' => $contactSettings['contact_form_title'] ?? 'Send Us a Message',
                'map_url' => $contactSettings['contact_map_url'] ?? 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3024.184133583885!2d-73.94482368459418!3d40.67834397932778!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c25bae6c5b3b3b%3A0x8b5e5e5e5e5e5e5e!2s358%20Amboy%20St%2C%20Brooklyn%2C%20NY%2011212%2C%20USA!5e0!3m2!1sen!2sus!4v1735123456789!5m2!1sen!2sus',
                'schedule_url' => $contactSettings['contact_schedule_url'] ?? null,
            ],
            'footer' => [
                'description' => $footerSettings['footer_description'] ?? 'Expert Construction Solutions You Can Trust. Reliable construction services for your dream projects.',
                'address' => $footerSettings['footer_address'] ?? '358 Amboy St, Brooklyn, NY 11212, USA',
                'email_1' => $footerSettings['footer_email_1'] ?? config('mail.admin_notification_email'),
                'email_2' => $footerSettings['footer_email_2'] ?? config('mail.admin_notification_email'),
                'phone' => $footerSettings['footer_phone'] ?? '+1.3476366128',
                'linkedin_url' => $footerSettings['footer_linkedin_url'] ?? 'https://www.linkedin.com/company/bluedraft',
                'instagram_url' => $footerSettings['footer_instagram_url'] ?? 'https://www.instagram.com/bluedraft',
                'facebook_url' => $footerSettings['footer_facebook_url'] ?? 'https://www.facebook.com/bluedraft',
                'copyright' => $footerSettings['footer_copyright'] ?? 'Blue Draft - All Rights Reserved.',
            ],
        ]);
    }

    public function submitContact(Request $request)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ];

        if (config('services.recaptcha.secret')) {
            $rules['g-recaptcha-response'] = 'required|string';
        } else {
            $rules['g-recaptcha-response'] = 'nullable|string';
        }
        
        // Si es una solicitud de cotización, las reglas son diferentes
        if ($request->has('quote_request')) {
            $rules['service'] = 'required|string';
            $rules['message'] = 'nullable|string|max:2000';
            $rules['photos.*'] = 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240'; // 10MB max
        } else {
            $rules['service'] = 'required|string';
            $rules['budget'] = 'nullable|string';
            $rules['phone'] = 'nullable|string|max:20';
            $rules['address'] = 'nullable|string|max:500';
            $rules['message'] = 'nullable|string|max:2000';
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

        // Guardar en la base de datos
        if ($request->has('quote_request')) {
            $tracking = Quote::extractTrackingFromRequest($request);
            $hasPhotos = $request->hasFile('photos');
            $address = $request->input('address');
            $quote = Quote::create(array_merge([
                'client_name' => $validated['name'],
                'email' => $validated['email'],
                'phone' => $request->input('phone'),
                'address' => $request->input('address'),
                'service_type' => $validated['service'],
                'estimated_budget' => null,
                'message' => $validated['message'] ?? null,
                'status' => 'pending',
                'stage' => Quote::STAGE_NEW,
                'is_partial' => false,
                'step' => 2,
                'borough' => Quote::inferBoroughFromAddress($address),
                'lead_score' => Quote::calculateLeadScore([
                    'service_type' => $validated['service'],
                    'address' => $address,
                    'borough' => Quote::inferBoroughFromAddress($address),
                ], $hasPhotos),
                'source_url' => $request->header('Referer'),
                'user_agent' => $request->userAgent(),
                'ip_address' => $request->ip(),
            ], $tracking));

            // Procesar y guardar fotos si existen
            if ($request->hasFile('photos')) {
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

            // Cargar relaciones para el email
            $quote->load('attachments');
            
            // Enviar notificación por correo
            try {
                Mail::to(config('mail.admin_notification_email'))->send(new QuoteNotification($quote));
                Log::info('Quote notification email sent', [
                    'quote_id' => $quote->id,
                    'email' => $quote->email,
                ]);
            } catch (\Exception $e) {
                Log::error('Failed to send quote notification email', [
                    'quote_id' => $quote->id,
                    'error' => $e->getMessage(),
                ]);
            }

            Log::info('Quote request saved', [
                'quote_id' => $quote->id,
                'email' => $quote->email,
                'attachments_count' => $quote->attachments()->count(),
            ]);

            AddLeadToEmailSequence::dispatch($quote);

            return back()->with('success', '¡Gracias por tu solicitud de cotización! Revisaremos tus fotos y te contactaremos pronto con una estimación.');
        } else {
            $tracking = Quote::extractTrackingFromRequest($request);
            $quote = Quote::create(array_merge([
                'client_name' => $validated['name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'] ?? null,
                'address' => $validated['address'] ?? null,
                'service_type' => $validated['service'],
                'estimated_budget' => $validated['budget'] ?? null,
                'message' => $validated['message'] ?? null,
                'status' => 'pending',
                'stage' => Quote::STAGE_NEW,
                'is_partial' => false,
                'step' => 2,
                'borough' => Quote::inferBoroughFromAddress($validated['address'] ?? null),
                'lead_score' => Quote::calculateLeadScore([
                    'service_type' => $validated['service'],
                    'estimated_budget' => $validated['budget'] ?? null,
                    'message' => $validated['message'] ?? null,
                    'address' => $validated['address'] ?? null,
                    'phone' => $validated['phone'] ?? null,
                    'borough' => Quote::inferBoroughFromAddress($validated['address'] ?? null),
                ], false),
                'source_url' => $request->header('Referer'),
                'user_agent' => $request->userAgent(),
                'ip_address' => $request->ip(),
            ], $tracking));

            // Enviar notificación por correo
            try {
                Mail::to(config('mail.admin_notification_email'))->send(new ContactNotification($quote));
                Log::info('Contact notification email sent', [
                    'quote_id' => $quote->id,
                    'email' => $quote->email,
                ]);
            } catch (\Exception $e) {
                Log::error('Failed to send contact notification email', [
                    'quote_id' => $quote->id,
                    'error' => $e->getMessage(),
                ]);
            }

            Log::info('Contact form submitted', [
                'quote_id' => $quote->id,
                'email' => $quote->email,
                'service' => $quote->service_type,
                'budget' => $quote->estimated_budget,
            ]);

            return back()->with('success', '¡Gracias por tu mensaje! Nos pondremos en contacto contigo pronto.');
        }
    }
}
