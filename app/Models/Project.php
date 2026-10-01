<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    public const CATEGORIES = [
        'web' => 'Web Development',
        'graphic' => 'Graphic Design',
        'ui' => 'UI/UX Design',
    ];

    protected $fillable = [
        'title', 'category', 'client', 'year', 'description',
        'tags', 'image', 'url', 'sort_order', 'is_published',
    ];

    protected $casts = [
        'tags' => 'array',
        'is_published' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('is_published', true)->orderBy('sort_order')->orderByDesc('id');
    }

    public function getCategoryLabelAttribute(): string
    {
        return self::CATEGORIES[$this->category] ?? ucfirst($this->category);
    }

    public function getImageUrlAttribute(): ?string
    {
        return $this->image ? asset($this->image) : null;
    }
}
