<?php

namespace Database\Seeders;

use App\Models\Settings;
use Illuminate\Database\Seeder;

class PillarCitySeeder extends Seeder
{
    /**
     * Seed pillar pages for districts: Manhattan, Queens, Brooklyn, Bronx, New Jersey.
     */
    public function run(): void
    {
        $districts = config('pillar_cities.cities', []);

        foreach ($districts as $slug => $config) {
            $name = $config['name'] ?? ucfirst(str_replace('-', ' ', $slug));
            $group = 'pillar_' . $slug;

            $defaultContent = "<p>Blue Draft offers expert construction and renovation services in {$name}. Kitchen remodeling, bathroom renovation, commercial construction. Contact us for a free estimate.</p>";

            $settings = [
                ['key' => $group . '_title', 'value' => "Construction Company {$name} | Blue Draft", 'type' => 'text', 'group' => $group],
                ['key' => $group . '_meta_description', 'value' => "Premier construction company in {$name}. Kitchen remodeling, bathroom renovation, commercial construction. Free estimates.", 'type' => 'text', 'group' => $group],
                ['key' => $group . '_hero_title', 'value' => "Construction Company {$name}", 'type' => 'text', 'group' => $group],
                ['key' => $group . '_hero_subtitle', 'value' => "Premium Construction Services in {$name}", 'type' => 'text', 'group' => $group],
                ['key' => $group . '_content', 'value' => $defaultContent, 'type' => 'textarea', 'group' => $group],
            ];

            foreach ($settings as $s) {
                Settings::updateOrCreate(['key' => $s['key']], $s);
            }
        }

        // Remove old cities if any
        Settings::whereIn('group', ['pillar_miami', 'pillar_boston'])->delete();

        $this->command->info('Pillar district settings seeded: ' . implode(', ', array_map(fn ($d) => $d['name'], $districts)));
    }
}
