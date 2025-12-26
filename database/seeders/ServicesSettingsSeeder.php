<?php

namespace Database\Seeders;

use App\Models\Settings;
use Illuminate\Database\Seeder;

class ServicesSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            [
                'key' => 'services_badge',
                'value' => 'Our Services',
                'type' => 'text',
                'group' => 'services',
            ],
            [
                'key' => 'services_title',
                'value' => 'What We Offer',
                'type' => 'text',
                'group' => 'services',
            ],
            [
                'key' => 'services_description',
                'value' => 'Comprehensive construction solutions tailored to your needs',
                'type' => 'textarea',
                'group' => 'services',
            ],
            [
                'key' => 'services_service1_title',
                'value' => 'Residential Construction',
                'type' => 'text',
                'group' => 'services',
            ],
            [
                'key' => 'services_service1_description',
                'value' => 'From custom homes to renovations, we bring your residential vision to life with precision and quality craftsmanship.',
                'type' => 'textarea',
                'group' => 'services',
            ],
            [
                'key' => 'services_service1_svg_path',
                'value' => 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4',
                'type' => 'textarea',
                'group' => 'services',
            ],
            [
                'key' => 'services_service2_title',
                'value' => 'Commercial Projects',
                'type' => 'text',
                'group' => 'services',
            ],
            [
                'key' => 'services_service2_description',
                'value' => 'Professional commercial construction services for offices, retail spaces, and business facilities.',
                'type' => 'textarea',
                'group' => 'services',
            ],
            [
                'key' => 'services_service2_svg_path',
                'value' => 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4',
                'type' => 'textarea',
                'group' => 'services',
            ],
            [
                'key' => 'services_service3_title',
                'value' => 'Renovation & Remodeling',
                'type' => 'text',
                'group' => 'services',
            ],
            [
                'key' => 'services_service3_description',
                'value' => 'Transform your existing space with expert renovation services that enhance both function and aesthetics.',
                'type' => 'textarea',
                'group' => 'services',
            ],
            [
                'key' => 'services_service3_svg_path',
                'value' => 'M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15',
                'type' => 'textarea',
                'group' => 'services',
            ],
        ];

        foreach ($settings as $setting) {
            Settings::updateOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }

        $this->command->info('Services settings created successfully!');
    }
}

