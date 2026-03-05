<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LeadMagnetSubscriber extends Model
{
    protected $fillable = ['email', 'name', 'downloaded_at'];

    protected $casts = [
        'downloaded_at' => 'datetime',
    ];
}
