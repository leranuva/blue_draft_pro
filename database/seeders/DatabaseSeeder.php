<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AdminUserSeeder::class,
            ProjectSeeder::class,
            ServiceSeeder::class,
            PillarPageSeeder::class,
            PillarCitySeeder::class,
            HeroSettingsSeeder::class,
            AboutSettingsSeeder::class,
            ServicesSettingsSeeder::class,
            TestimonialsSettingsSeeder::class,
            ContactSettingsSeeder::class,
            FooterSettingsSeeder::class,
        ]);
    }
}
