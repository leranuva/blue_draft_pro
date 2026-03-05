<?php

namespace Database\Seeders;

use App\Models\Settings;
use Illuminate\Database\Seeder;

class AboutSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            [
                'key' => 'about_badge',
                'value' => 'About Us',
                'type' => 'text',
                'group' => 'about',
            ],
            [
                'key' => 'about_title',
                'value' => 'About Blue Draft Company',
                'type' => 'text',
                'group' => 'about',
            ],
            [
                'key' => 'about_subtitle',
                'value' => 'Our Mission',
                'type' => 'text',
                'group' => 'about',
            ],
            [
                'key' => 'about_description_1',
                'value' => 'At Blue Draft Construction Company, our mission is to deliver high-quality construction services that exceed client expectations. We are committed to integrity, safety, and sustainable practices in every project we undertake.',
                'type' => 'textarea',
                'group' => 'about',
            ],
            [
                'key' => 'about_description_2',
                'value' => 'With years of experience in the construction industry, we bring expertise, reliability, and dedication to every project. From residential to commercial construction, we ensure that your vision becomes reality with the highest standards of quality and craftsmanship.',
                'type' => 'textarea',
                'group' => 'about',
            ],
            [
                'key' => 'about_stat_years',
                'value' => '15+',
                'type' => 'text',
                'group' => 'about',
            ],
            [
                'key' => 'about_stat_projects',
                'value' => '200+',
                'type' => 'text',
                'group' => 'about',
            ],
            [
                'key' => 'about_stat_satisfaction',
                'value' => '100%',
                'type' => 'text',
                'group' => 'about',
            ],
            [
                'key' => 'about_stat_rating',
                'value' => '4.9/5',
                'type' => 'text',
                'group' => 'about',
            ],
            [
                'key' => 'about_stat_borough',
                'value' => '+127 Renovations in Brooklyn Since 2019',
                'type' => 'text',
                'group' => 'about',
            ],
            [
                'key' => 'about_image',
                'value' => null,
                'type' => 'image',
                'group' => 'about',
            ],
            [
                'key' => 'about_image_text',
                'value' => 'Quality & Safety',
                'type' => 'text',
                'group' => 'about',
            ],
            [
                'key' => 'about_image_svg_path',
                'value' => 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z',
                'type' => 'textarea',
                'group' => 'about',
            ],
        ];

        foreach ($settings as $setting) {
            Settings::updateOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }

        $this->command->info('About settings created successfully!');
    }
}


