<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Quote extends Model
{
    protected $fillable = [
        'client_name',
        'email',
        'phone',
        'address',
        'service_type',
        'estimated_budget',
        'message',
        'status',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the attachments for the quote
     */
    public function attachments(): HasMany
    {
        return $this->hasMany(QuoteAttachment::class);
    }

    /**
     * Get the status options
     */
    public static function getStatuses(): array
    {
        return ['pending', 'contacted', 'completed'];
    }
}
