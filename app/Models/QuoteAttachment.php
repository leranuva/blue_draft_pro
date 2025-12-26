<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class QuoteAttachment extends Model
{
    protected $fillable = [
        'quote_id',
        'file_path',
        'file_type',
        'original_name',
        'file_size',
    ];

    protected $casts = [
        'file_size' => 'integer',
    ];

    /**
     * Get the quote that owns the attachment
     */
    public function quote(): BelongsTo
    {
        return $this->belongsTo(Quote::class);
    }
}
