<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PracticeArea extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'short_description',
        'description',
        'icon',
        'emoji_icon',
        'features',
    ];

    protected $casts = [
        'features' => 'array',
    ];
}
