<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class HeroSlide extends Model
{
    protected $fillable = [
        'title',
        'alt_text',
        'image_path',
        'image_url',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active'  => 'boolean',
        'sort_order' => 'integer',
    ];

    /**
     * Always return the full public URL for the image.
     */
    public function getImageUrlAttribute(): string
    {
        if ($this->attributes['image_url']) {
            return $this->attributes['image_url'];
        }
        return Storage::disk('public')->url($this->image_path);
    }

    /**
     * Scope: only active slides in sort order.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('sort_order');
    }
}
