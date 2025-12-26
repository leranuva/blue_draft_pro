<?php

namespace App\Console\Commands;

use App\Models\Project;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class TestImageUrls extends Command
{
    protected $signature = 'images:test-urls';
    protected $description = 'Test image URLs and verify they are accessible';

    public function handle()
    {
        $this->info('Testing Image URLs...');
        $this->newLine();

        // Check APP_URL
        $appUrl = env('APP_URL');
        $this->info("APP_URL: {$appUrl}");
        
        if (empty($appUrl)) {
            $this->error('❌ APP_URL is not set in .env');
            return 1;
        }
        
        if (substr($appUrl, -1) === '/') {
            $this->warn('⚠️  APP_URL ends with / - this may cause issues');
        }
        
        $this->newLine();

        // Get projects with images
        $projects = Project::whereNotNull('image_after')
            ->orWhereNotNull('image_before')
            ->take(3)
            ->get();

        if ($projects->isEmpty()) {
            $this->warn('No projects with images found.');
            return 0;
        }

        $this->info("Testing URLs for {$projects->count()} project(s):");
        $this->newLine();

        foreach ($projects as $project) {
            $this->line("Project: {$project->title} (ID: {$project->id})");
            
            if ($project->image_after) {
                $url = Storage::disk('public')->url($project->image_after);
                $path = storage_path('app/public/' . $project->image_after);
                $exists = file_exists($path);
                
                $this->line("  After Image:");
                $this->line("    Path in DB: {$project->image_after}");
                $this->line("    Physical: " . ($exists ? '✅ EXISTS' : '❌ NOT FOUND'));
                $this->line("    URL: {$url}");
                
                // Check if URL is correct
                $expectedUrl = rtrim($appUrl, '/') . '/storage/' . $project->image_after;
                if ($url !== $expectedUrl) {
                    $this->warn("    ⚠️  URL mismatch!");
                    $this->line("    Expected: {$expectedUrl}");
                } else {
                    $this->info("    ✅ URL format is correct");
                }
            }
            
            if ($project->image_before) {
                $url = Storage::disk('public')->url($project->image_before);
                $path = storage_path('app/public/' . $project->image_before);
                $exists = file_exists($path);
                
                $this->line("  Before Image:");
                $this->line("    Path in DB: {$project->image_before}");
                $this->line("    Physical: " . ($exists ? '✅ EXISTS' : '❌ NOT FOUND'));
                $this->line("    URL: {$url}");
            }
            
            $this->newLine();
        }

        // Check storage link
        $storageLink = public_path('storage');
        $linkExists = is_link($storageLink);
        
        $this->info('Storage Link Status:');
        if ($linkExists) {
            $target = readlink($storageLink);
            $this->info("  ✅ Link exists: {$storageLink}");
            $this->line("  Target: {$target}");
            
            // Check if target exists
            $targetPath = dirname($storageLink) . '/' . $target;
            if (is_dir($targetPath)) {
                $this->info("  ✅ Target directory exists");
            } else {
                $this->error("  ❌ Target directory does NOT exist: {$targetPath}");
            }
        } else {
            $this->error("  ❌ Link does NOT exist: {$storageLink}");
        }
        
        $this->newLine();
        
        // Check filesystem config
        $this->info('Filesystem Configuration:');
        $publicDisk = config('filesystems.disks.public');
        $this->line("  Root: {$publicDisk['root']}");
        $this->line("  URL: {$publicDisk['url']}");
        
        $this->newLine();
        $this->info('💡 Next Steps:');
        $this->line('1. Try accessing one of the URLs directly in your browser');
        $this->line('2. Check browser console (F12) for errors');
        $this->line('3. Verify APP_URL in .env matches your domain');
        $this->line('4. Clear browser cache or try incognito mode');

        return 0;
    }
}

