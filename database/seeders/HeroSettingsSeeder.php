<?php

namespace Database\Seeders;

use App\Models\Settings;
use Illuminate\Database\Seeder;

class HeroSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            [
                'key' => 'hero_badge',
                'value' => 'Expert Construction',
                'type' => 'text',
                'group' => 'hero',
            ],
            [
                'key' => 'hero_title_line1',
                'value' => 'Solutions You',
                'type' => 'text',
                'group' => 'hero',
            ],
            [
                'key' => 'hero_title_line2',
                'value' => 'Can Trust',
                'type' => 'text',
                'group' => 'hero',
            ],
            [
                'key' => 'hero_description',
                'value' => 'Reliable construction services for your dream projects. We deliver high-quality results that exceed expectations with integrity, safety, and sustainable practices.',
                'type' => 'textarea',
                'group' => 'hero',
            ],
            [
                'key' => 'hero_cta_text',
                'value' => 'Get Your Free Quote',
                'type' => 'text',
                'group' => 'hero',
            ],
            [
                'key' => 'hero_phone',
                'value' => '+1.3476366128',
                'type' => 'text',
                'group' => 'hero',
            ],
            [
                'key' => 'hero_phone_display',
                'value' => '+1.3476366128',
                'type' => 'text',
                'group' => 'hero',
            ],
            [
                'key' => 'hero_image_text',
                'value' => 'Construction Excellence',
                'type' => 'text',
                'group' => 'hero',
            ],
            [
                'key' => 'hero_image_svg_path',
                'value' => 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4',
                'type' => 'textarea',
                'group' => 'hero',
            ],
            [
                'key' => 'hero_background_image',
                'value' => null,
                'type' => 'image',
                'group' => 'hero',
            ],
            [
                'key' => 'hero_placeholder_image',
                'value' => null,
                'type' => 'image',
                'group' => 'hero',
            ],
        ];

        foreach ($settings as $setting) {
            Settings::updateOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }

        $this->command->info('Hero settings created successfully!');
    }
}

