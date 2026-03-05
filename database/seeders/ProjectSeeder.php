<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $projects = [
            [
                'title' => 'Modern Residential Home',
                'description' => 'Custom homes built with precision and attention to detail. This project showcases our expertise in residential construction.',
                'category' => 'residential',
                'is_featured' => true,
            ],
            [
                'title' => 'Commercial Office Space',
                'description' => 'Professional commercial construction services for businesses. Ensuring functionality, durability, and modern design.',
                'category' => 'commercial',
                'is_featured' => true,
            ],
            [
                'title' => 'Kitchen Renovation',
                'description' => 'Transform your existing space with expert renovation services. This kitchen renovation demonstrates our attention to detail.',
                'category' => 'renovation',
                'is_featured' => true,
            ],
            [
                'title' => 'Luxury Residential Complex',
                'description' => 'Creating spaces that reflect your unique style and needs. A multi-unit residential project with modern amenities.',
                'category' => 'residential',
                'is_featured' => false,
            ],
            [
                'title' => 'Retail Store Construction',
                'description' => 'Commercial space designed for retail businesses with modern aesthetics and functional layouts.',
                'category' => 'commercial',
                'is_featured' => false,
            ],
            [
                'title' => 'Bathroom Remodel',
                'description' => 'Complete bathroom renovation with modern fixtures and elegant design. See the transformation with our before/after slider.',
                'category' => 'renovation',
                'is_featured' => true,
            ],
        ];

        foreach ($projects as $project) {
            // Check if project already exists before creating
            $exists = Project::where('title', $project['title'])
                ->where('category', $project['category'])
                ->exists();
            
            if (!$exists) {
                Project::create($project);
            }
        }
    }
}
