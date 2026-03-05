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

            $defaultContent = "<p>Renovating an apartment or home in {$name} requires experienced contractors who understand NYC building regulations, permits, and board approvals. At Blue Draft, we provide full-service renovation solutions for {$name} properties, including kitchen remodeling, bathroom renovation, and complete apartment transformations.</p><p>Our team works with property managers, architects, and building boards to ensure every renovation meets NYC code requirements. Contact us for a free estimate.</p>";

            $settings = [
                ['key' => $group . '_title', 'value' => "Renovation Contractor {$name} | Blue Draft", 'type' => 'text', 'group' => $group],
                ['key' => $group . '_meta_description', 'value' => "Premier renovation contractor in {$name}. Kitchen remodeling, bathroom renovation, apartment renovations. Free estimates.", 'type' => 'text', 'group' => $group],
                ['key' => $group . '_hero_title', 'value' => "Apartment Renovation Contractor in {$name}", 'type' => 'text', 'group' => $group],
                ['key' => $group . '_hero_subtitle', 'value' => "Licensed NYC contractors for kitchen, bathroom, and full apartment renovations in {$name}.", 'type' => 'text', 'group' => $group],
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
