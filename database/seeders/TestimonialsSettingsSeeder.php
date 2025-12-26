<?php

namespace Database\Seeders;

use App\Models\Settings;
use Illuminate\Database\Seeder;

class TestimonialsSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            [
                'key' => 'testimonials_badge',
                'value' => 'What Our Clients Say',
                'type' => 'text',
                'group' => 'testimonials',
            ],
            [
                'key' => 'testimonials_title',
                'value' => 'Client Testimonials',
                'type' => 'text',
                'group' => 'testimonials',
            ],
            [
                'key' => 'testimonials_description',
                'value' => 'Don\'t just take our word for it. See what our satisfied clients have to say about our work.',
                'type' => 'textarea',
                'group' => 'testimonials',
            ],
            [
                'key' => 'testimonials_testimonial1_name',
                'value' => 'John & Sarah Martinez',
                'type' => 'text',
                'group' => 'testimonials',
            ],
            [
                'key' => 'testimonials_testimonial1_role',
                'value' => 'Homeowners',
                'type' => 'text',
                'group' => 'testimonials',
            ],
            [
                'key' => 'testimonials_testimonial1_project',
                'value' => 'Residential Renovation',
                'type' => 'text',
                'group' => 'testimonials',
            ],
            [
                'key' => 'testimonials_testimonial1_rating',
                'value' => '5',
                'type' => 'text',
                'group' => 'testimonials',
            ],
            [
                'key' => 'testimonials_testimonial1_image',
                'value' => '👨‍👩‍👧',
                'type' => 'text',
                'group' => 'testimonials',
            ],
            [
                'key' => 'testimonials_testimonial1_text',
                'value' => 'Blue Draft transformed our outdated kitchen into a modern masterpiece. Their attention to detail and professionalism exceeded our expectations. We couldn\'t be happier with the results!',
                'type' => 'textarea',
                'group' => 'testimonials',
            ],
            [
                'key' => 'testimonials_testimonial2_name',
                'value' => 'Michael Chen',
                'type' => 'text',
                'group' => 'testimonials',
            ],
            [
                'key' => 'testimonials_testimonial2_role',
                'value' => 'Business Owner',
                'type' => 'text',
                'group' => 'testimonials',
            ],
            [
                'key' => 'testimonials_testimonial2_project',
                'value' => 'Commercial Construction',
                'type' => 'text',
                'group' => 'testimonials',
            ],
            [
                'key' => 'testimonials_testimonial2_rating',
                'value' => '5',
                'type' => 'text',
                'group' => 'testimonials',
            ],
            [
                'key' => 'testimonials_testimonial2_image',
                'value' => '👔',
                'type' => 'text',
                'group' => 'testimonials',
            ],
            [
                'key' => 'testimonials_testimonial2_text',
                'value' => 'As a business owner, I needed a reliable construction partner. Blue Draft delivered on time, within budget, and with exceptional quality. Our new office space is exactly what we envisioned.',
                'type' => 'textarea',
                'group' => 'testimonials',
            ],
            [
                'key' => 'testimonials_testimonial3_name',
                'value' => 'Emily Rodriguez',
                'type' => 'text',
                'group' => 'testimonials',
            ],
            [
                'key' => 'testimonials_testimonial3_role',
                'value' => 'Property Manager',
                'type' => 'text',
                'group' => 'testimonials',
            ],
            [
                'key' => 'testimonials_testimonial3_project',
                'value' => 'Multi-Unit Renovation',
                'type' => 'text',
                'group' => 'testimonials',
            ],
            [
                'key' => 'testimonials_testimonial3_rating',
                'value' => '5',
                'type' => 'text',
                'group' => 'testimonials',
            ],
            [
                'key' => 'testimonials_testimonial3_image',
                'value' => '🏢',
                'type' => 'text',
                'group' => 'testimonials',
            ],
            [
                'key' => 'testimonials_testimonial3_text',
                'value' => 'Working with Blue Draft was a pleasure from start to finish. They handled our complex multi-unit renovation project with expertise and kept us informed every step of the way.',
                'type' => 'textarea',
                'group' => 'testimonials',
            ],
        ];

        foreach ($settings as $setting) {
            Settings::updateOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }

        $this->command->info('Testimonials settings created successfully!');
    }
}

