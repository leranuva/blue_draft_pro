<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Project extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'description',
        'category',
        'image_before',
        'image_after',
        'is_featured',
    ];

    protected static function booted(): void
    {
        static::saving(function (Project $project) {
            if (empty($project->slug) && !empty($project->title)) {
                $project->slug = Str::slug($project->title);
            }
        });
    }

    public function services(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Service::class, 'project_service');
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * Never return null to avoid 500 when generating URLs.
     * Falls back to id when slug is empty.
     */
    public function getRouteKey(): mixed
    {
        return $this->slug ?? $this->getKey();
    }

    /**
     * Resolve route binding: when value is numeric, match by id (allows /projects/123).
     * Otherwise match by slug (allows /projects/my-renovation).
     */
    public function resolveRouteBindingQuery($query, $value, $field = null)
    {
        if ($field === 'slug' && is_numeric($value)) {
            return $query->where('id', $value);
        }
        return parent::resolveRouteBindingQuery($query, $value, $field);
    }

    protected $casts = [
        'is_featured' => 'boolean',
    ];

    /**
     * Get the category options
     */
    public static function getCategories(): array
    {
        return ['residential', 'commercial', 'renovation'];
    }

    /**
     * Get the full URL for the before image
     */
    public function getBeforeImageUrlAttribute(): ?string
    {
        return $this->image_before ? url('storage/' . $this->image_before) : null;
    }

    /**
     * Get the full URL for the after image
     */
    public function getAfterImageUrlAttribute(): ?string
    {
        return $this->image_after ? url('storage/' . $this->image_after) : null;
    }
}
