<?php

namespace Database\Seeders;

use App\Models\Settings;
use Illuminate\Database\Seeder;

class ContactSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            [
                'key' => 'contact_badge',
                'value' => 'Get In Touch',
                'type' => 'text',
                'group' => 'contact',
            ],
            [
                'key' => 'contact_title',
                'value' => 'Contact Us',
                'type' => 'text',
                'group' => 'contact',
            ],
            [
                'key' => 'contact_description',
                'value' => 'Have questions? We\'re here to help. Reach out to us today.',
                'type' => 'textarea',
                'group' => 'contact',
            ],
            [
                'key' => 'contact_address',
                'value' => '358 Amboy St, Brooklyn, NY 11212, USA',
                'type' => 'text',
                'group' => 'contact',
            ],
            [
                'key' => 'contact_phone',
                'value' => '+1.3476366128',
                'type' => 'text',
                'group' => 'contact',
            ],
            [
                'key' => 'contact_phone_link',
                'value' => '+13476366128',
                'type' => 'text',
                'group' => 'contact',
            ],
            [
                'key' => 'contact_email',
                'value' => 'marcin@bluedraft.org',
                'type' => 'text',
                'group' => 'contact',
            ],
            [
                'key' => 'contact_hours',
                'value' => 'Mon - Fri: 8:00 AM - 6:00 PM',
                'type' => 'text',
                'group' => 'contact',
            ],
            [
                'key' => 'contact_form_title',
                'value' => 'Send Us a Message',
                'type' => 'text',
                'group' => 'contact',
            ],
            [
                'key' => 'contact_map_url',
                'value' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3024.184133583885!2d-73.94482368459418!3d40.67834397932778!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c25bae6c5b3b3b%3A0x8b5e5e5e5e5e5e5e!2s358%20Amboy%20St%2C%20Brooklyn%2C%20NY%2011212%2C%20USA!5e0!3m2!1sen!2sus!4v1735123456789!5m2!1sen!2sus',
                'type' => 'textarea',
                'group' => 'contact',
            ],
        ];

        foreach ($settings as $setting) {
            Settings::updateOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }

        $this->command->info('Contact settings created successfully!');
    }
}

