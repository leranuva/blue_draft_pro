<?php

namespace App\Console\Commands;

use App\Models\Project;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class CheckProjects extends Command
{
    protected $signature = 'projects:check';
    protected $description = 'Check projects and their images';

    public function handle()
    {
        $this->info('Checking projects and images...');
        $this->newLine();

        $projects = Project::all(['id', 'title', 'image_before', 'image_after']);

        if ($projects->isEmpty()) {
            $this->warn('No projects found in database.');
            return 0;
        }

        $this->info("Found {$projects->count()} project(s):");
        $this->newLine();

        foreach ($projects as $project) {
            $this->line("ID: {$project->id} - {$project->title}");
            
            // Check Before Image
            if ($project->image_before) {
                $beforePath = storage_path('app/public/' . $project->image_before);
                $beforeExists = file_exists($beforePath);
                $beforeUrl = Storage::disk('public')->url($project->image_before);
                
                $this->line("  Before Image:");
                $this->line("    Path in DB: {$project->image_before}");
                $this->line("    Physical: " . ($beforeExists ? '✅ EXISTS' : '❌ NOT FOUND'));
                $this->line("    URL: {$beforeUrl}");
            } else {
                $this->line("  Before Image: ❌ NOT SET");
            }
            
            // Check After Image
            if ($project->image_after) {
                $afterPath = storage_path('app/public/' . $project->image_after);
                $afterExists = file_exists($afterPath);
                $afterUrl = Storage::disk('public')->url($project->image_after);
                
                $this->line("  After Image:");
                $this->line("    Path in DB: {$project->image_after}");
                $this->line("    Physical: " . ($afterExists ? '✅ EXISTS' : '❌ NOT FOUND'));
                $this->line("    URL: {$afterUrl}");
            } else {
                $this->line("  After Image: ❌ NOT SET");
            }
            
            $this->newLine();
        }

        // Check storage link
        $storageLink = public_path('storage');
        $linkExists = is_link($storageLink);
        $linkTarget = $linkExists ? readlink($storageLink) : null;
        
        $this->info('Storage Link Status:');
        if ($linkExists) {
            $this->line("  ✅ Link exists: {$storageLink}");
            $this->line("  Target: {$linkTarget}");
        } else {
            $this->error("  ❌ Link does NOT exist: {$storageLink}");
        }
        
        $this->newLine();
        
        // Check directories
        $this->info('Image Directories:');
        $directories = [
            'projects' => storage_path('app/public/images/projects'),
            'hero' => storage_path('app/public/images/hero'),
            'about' => storage_path('app/public/images/about'),
            'testimonials' => storage_path('app/public/images/testimonials'),
        ];
        
        foreach ($directories as $name => $path) {
            $exists = is_dir($path);
            $writable = $exists && is_writable($path);
            $this->line("  {$name}: " . ($exists ? '✅ EXISTS' : '❌ NOT FOUND') . ($writable ? ' (writable)' : ' (not writable)'));
        }

        return 0;
    }
}

