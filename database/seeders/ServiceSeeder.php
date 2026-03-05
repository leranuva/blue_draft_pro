<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            [
                'title' => 'Kitchen Remodel',
                'slug' => 'kitchen-remodeling-new-york',
                'hero_title' => 'Kitchen Remodeling Services',
                'hero_subtitle' => 'Transform your kitchen into the heart of your home',
                'seo_title' => 'Kitchen Remodeling | Blue Draft Construction',
                'seo_description' => 'Professional kitchen remodeling services. Custom designs, quality materials, on-time delivery. Free estimates.',
                'content' => null,
                'faq_json' => [
                    ['question' => 'How long does a kitchen remodel take?', 'answer' => 'Most kitchen remodels take 4-8 weeks depending on scope. We provide a detailed timeline during the estimate.'],
                    ['question' => 'Do you handle permits?', 'answer' => 'Yes, we handle all necessary permits for your kitchen renovation project.'],
                ],
                'cta_text' => 'Schedule Your Free Kitchen Design Consultation',
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'title' => 'Bathroom Renovation',
                'slug' => 'bathroom-renovation-new-york',
                'hero_title' => 'Bathroom Renovation',
                'hero_subtitle' => 'Modern, functional bathrooms you\'ll love',
                'seo_title' => 'Bathroom Renovation | Blue Draft Construction',
                'seo_description' => 'Expert bathroom renovation and remodeling. Quality craftsmanship, modern designs. Free estimates.',
                'content' => null,
                'faq_json' => [],
                'cta_text' => 'Get Your Bathroom Renovation Quote in 24 Hours',
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'title' => 'Commercial Construction',
                'slug' => 'commercial-construction-manhattan',
                'hero_title' => 'Commercial Construction',
                'hero_subtitle' => 'Build your business space with confidence',
                'seo_title' => 'Commercial Construction | Blue Draft',
                'seo_description' => 'Commercial construction services for offices, retail, and more. On-time, on-budget delivery.',
                'content' => null,
                'faq_json' => [],
                'cta_text' => 'Lock Your Commercial Project Timeline Before Spring',
                'is_active' => true,
                'sort_order' => 3,
            ],
        ];

        foreach ($services as $data) {
            Service::updateOrCreate(
                ['title' => $data['title']],
                $data
            );
        }

        // Migrate old slugs to NYC versions
        $slugMap = [
            'kitchen-remodel' => 'kitchen-remodeling-new-york',
            'bathroom-renovation' => 'bathroom-renovation-new-york',
            'commercial-construction' => 'commercial-construction-manhattan',
        ];
        foreach ($slugMap as $old => $new) {
            Service::where('slug', $old)->update(['slug' => $new]);
        }

        $this->command->info('Services seeded.');
    }
}
