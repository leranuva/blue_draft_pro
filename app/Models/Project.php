<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Project extends Model
{
    protected $fillable = [
        'title',
        'description',
        'category',
        'image_before',
        'image_after',
        'is_featured',
    ];

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
        return $this->image_before ? Storage::disk('public')->url($this->image_before) : null;
    }

    /**
     * Get the full URL for the after image
     */
    public function getAfterImageUrlAttribute(): ?string
    {
        return $this->image_after ? Storage::disk('public')->url($this->image_after) : null;
    }
}
