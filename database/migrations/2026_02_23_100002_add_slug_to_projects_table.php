<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->string('slug')->nullable()->after('title');
        });

        // Populate slugs for existing projects
        $projects = \App\Models\Project::whereNull('slug')->orWhere('slug', '')->get();
        foreach ($projects as $project) {
            $base = \Illuminate\Support\Str::slug($project->title) ?: 'project-' . $project->id;
            $slug = $base;
            $i = 1;
            while (\App\Models\Project::where('slug', $slug)->where('id', '!=', $project->id)->exists()) {
                $slug = $base . '-' . $i++;
            }
            $project->update(['slug' => $slug]);
        }

        Schema::table('projects', function (Blueprint $table) {
            $table->unique('slug');
        });
    }

    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }
};
