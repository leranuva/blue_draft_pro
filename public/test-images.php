<?php
/**
 * Script temporal para verificar URLs de imágenes
 * Ejecutar: https://leranuva.com/test-images.php
 * Eliminar después de usar
 */

require __DIR__.'/../vendor/autoload.php';

$app = require_once __DIR__.'/../bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Project;
use Illuminate\Support\Facades\Storage;

header('Content-Type: text/html; charset=utf-8');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Image URLs Test</title>
    <style>
        body { font-family: monospace; padding: 20px; background: #1a1a1a; color: #0f0; }
        .success { color: #0f0; }
        .error { color: #f00; }
        .warning { color: #ff0; }
        .info { color: #0ff; }
        h1 { color: #fff; }
        h2 { color: #0ff; margin-top: 30px; }
        pre { background: #000; padding: 10px; border: 1px solid #333; }
        a { color: #0ff; }
        .url-test { margin: 10px 0; padding: 10px; background: #000; border-left: 3px solid #0ff; }
    </style>
</head>
<body>
    <h1>🔍 Image URLs Diagnostic Tool</h1>
    
    <?php
    // Check APP_URL
    $appUrl = env('APP_URL');
    echo "<h2>1. APP_URL Configuration</h2>";
    echo "<div class='url-test'>";
    echo "<strong>APP_URL:</strong> <span class='info'>" . ($appUrl ?: 'NOT SET') . "</span><br>";
    
    if (empty($appUrl)) {
        echo "<span class='error'>❌ APP_URL is not set in .env</span>";
    } elseif (substr($appUrl, -1) === '/') {
        echo "<span class='warning'>⚠️  APP_URL ends with / - this may cause issues</span>";
    } else {
        echo "<span class='success'>✅ APP_URL is correctly configured</span>";
    }
    echo "</div>";
    
    // Check storage link
    echo "<h2>2. Storage Link Status</h2>";
    $storageLink = public_path('storage');
    $linkExists = is_link($storageLink);
    
    echo "<div class='url-test'>";
    if ($linkExists) {
        $target = readlink($storageLink);
        $targetPath = dirname($storageLink) . '/' . $target;
        echo "<span class='success'>✅ Link exists: {$storageLink}</span><br>";
        echo "<strong>Target:</strong> {$target}<br>";
        
        if (is_dir($targetPath)) {
            echo "<span class='success'>✅ Target directory exists</span>";
        } else {
            echo "<span class='error'>❌ Target directory does NOT exist: {$targetPath}</span>";
        }
    } else {
        echo "<span class='error'>❌ Link does NOT exist: {$storageLink}</span>";
    }
    echo "</div>";
    
    // Check filesystem config
    echo "<h2>3. Filesystem Configuration</h2>";
    $publicDisk = config('filesystems.disks.public');
    echo "<div class='url-test'>";
    echo "<strong>Root:</strong> {$publicDisk['root']}<br>";
    echo "<strong>URL:</strong> {$publicDisk['url']}<br>";
    echo "</div>";
    
    // Get projects with images
    echo "<h2>4. Project Images Test</h2>";
    $projects = Project::whereNotNull('image_after')
        ->orWhereNotNull('image_before')
        ->take(5)
        ->get();
    
    if ($projects->isEmpty()) {
        echo "<div class='url-test'><span class='warning'>⚠️  No projects with images found.</span></div>";
    } else {
        echo "<div class='url-test'>";
        echo "<strong>Found {$projects->count()} project(s) with images:</strong><br><br>";
        
        foreach ($projects as $project) {
            echo "<strong>Project: {$project->title} (ID: {$project->id})</strong><br>";
            
            if ($project->image_after) {
                $url = Storage::disk('public')->url($project->image_after);
                $path = storage_path('app/public/' . $project->image_after);
                $exists = file_exists($path);
                
                echo "  <strong>After Image:</strong><br>";
                echo "  Path in DB: {$project->image_after}<br>";
                echo "  Physical: " . ($exists ? '<span class="success">✅ EXISTS</span>' : '<span class="error">❌ NOT FOUND</span>') . "<br>";
                echo "  URL: <a href='{$url}' target='_blank'>{$url}</a><br>";
                
                // Check URL format
                $expectedUrl = rtrim($appUrl, '/') . '/storage/' . $project->image_after;
                if ($url !== $expectedUrl) {
                    echo "  <span class='warning'>⚠️  URL mismatch!</span><br>";
                    echo "  Expected: {$expectedUrl}<br>";
                } else {
                    echo "  <span class='success'>✅ URL format is correct</span><br>";
                }
                
                echo "<br>";
            }
            
            if ($project->image_before) {
                $url = Storage::disk('public')->url($project->image_before);
                $path = storage_path('app/public/' . $project->image_before);
                $exists = file_exists($path);
                
                echo "  <strong>Before Image:</strong><br>";
                echo "  Path in DB: {$project->image_before}<br>";
                echo "  Physical: " . ($exists ? '<span class="success">✅ EXISTS</span>' : '<span class="error">❌ NOT FOUND</span>') . "<br>";
                echo "  URL: <a href='{$url}' target='_blank'>{$url}</a><br><br>";
            }
        }
        
        echo "</div>";
    }
    
    // Test direct access
    echo "<h2>5. Direct Access Test</h2>";
    echo "<div class='url-test'>";
    echo "<strong>Click on the URLs above to test if images load directly.</strong><br>";
    echo "<strong>If images load:</strong> Configuration is correct, problem may be browser cache.<br>";
    echo "<strong>If 404 error:</strong> Problem with symbolic link or Document Root.<br>";
    echo "<strong>If 403 error:</strong> Permission problem.<br>";
    echo "</div>";
    ?>
    
    <h2>6. Next Steps</h2>
    <div class="url-test">
        <ol>
            <li>Click on the image URLs above to test direct access</li>
            <li>If images load: Clear browser cache or try incognito mode</li>
            <li>If 404: Check symbolic link: <code>ls -la public/storage</code></li>
            <li>If 403: Fix permissions: <code>chmod -R 775 storage/app/public</code></li>
            <li><strong>Delete this file after testing:</strong> <code>rm public/test-images.php</code></li>
        </ol>
    </div>
</body>
</html>

