<?php

namespace Database\Seeders;

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
            HeroSettingsSeeder::class,
            AboutSettingsSeeder::class,
            ServicesSettingsSeeder::class,
            TestimonialsSettingsSeeder::class,
            ContactSettingsSeeder::class,
            FooterSettingsSeeder::class,
        ]);
    }
}

