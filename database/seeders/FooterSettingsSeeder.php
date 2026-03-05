<?php

namespace Database\Seeders;

use App\Models\Settings;
use Illuminate\Database\Seeder;

class FooterSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            [
                'key' => 'footer_description',
                'value' => 'Expert Construction Solutions You Can Trust. Reliable construction services for your dream projects.',
                'type' => 'textarea',
                'group' => 'footer',
            ],
            [
                'key' => 'footer_address',
                'value' => '358 Amboy St, Brooklyn, NY 11212, USA',
                'type' => 'text',
                'group' => 'footer',
            ],
            [
                'key' => 'footer_email_1',
                'value' => 'info@bluedraft.cc',
                'type' => 'text',
                'group' => 'footer',
            ],
            [
                'key' => 'footer_email_2',
                'value' => 'info@bluedraft.cc',
                'type' => 'text',
                'group' => 'footer',
            ],
            [
                'key' => 'footer_phone',
                'value' => '+1.3476366128',
                'type' => 'text',
                'group' => 'footer',
            ],
            [
                'key' => 'footer_linkedin_url',
                'value' => 'https://www.linkedin.com/company/bluedraft',
                'type' => 'text',
                'group' => 'footer',
            ],
            [
                'key' => 'footer_instagram_url',
                'value' => 'https://www.instagram.com/bluedraft',
                'type' => 'text',
                'group' => 'footer',
            ],
            [
                'key' => 'footer_facebook_url',
                'value' => 'https://www.facebook.com/bluedraft',
                'type' => 'text',
                'group' => 'footer',
            ],
            [
                'key' => 'footer_copyright',
                'value' => 'Blue Draft - All Rights Reserved.',
                'type' => 'text',
                'group' => 'footer',
            ],
            [
                'key' => 'footer_license',
                'value' => 'NYC Licensed & Insured',
                'type' => 'text',
                'group' => 'footer',
            ],
            [
                'key' => 'footer_insured',
                'value' => 'Fully insured & bonded',
                'type' => 'text',
                'group' => 'footer',
            ],
            [
                'key' => 'footer_certifications',
                'value' => 'EPA Lead-Safe Certified',
                'type' => 'text',
                'group' => 'footer',
            ],
        ];

        foreach ($settings as $setting) {
            Settings::updateOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }

        $this->command->info('Footer settings created successfully!');
    }
}

