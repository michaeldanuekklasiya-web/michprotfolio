<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    protected $fillable = [
        'title', 'slug', 'category', 'excerpt', 'body',
        'cover_image', 'is_published', 'published_at',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'published_at' => 'datetime',
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('is_published', true)
            ->where('published_at', '<=', now())
            ->orderByDesc('published_at');
    }

    /** Body is written in Markdown; raw HTML is stripped for safety. */
    public function getBodyHtmlAttribute(): string
    {
        return Str::markdown($this->body ?? '', [
            'html_input' => 'strip',
            'allow_unsafe_links' => false,
        ]);
    }

    public function getSummaryAttribute(): string
    {
        return $this->excerpt ?: Str::limit(strip_tags($this->body_html), 160);
    }

    public function getReadingMinutesAttribute(): int
    {
        return max(1, (int) ceil(str_word_count(strip_tags($this->body_html)) / 200));
    }

    public function getCoverUrlAttribute(): ?string
    {
        return $this->cover_image ? asset($this->cover_image) : null;
    }

    public static function uniqueSlug(string $title, ?int $ignoreId = null): string
    {
        $base = Str::slug($title) ?: 'post';
        $slug = $base;
        $i = 2;
        while (static::where('slug', $slug)->when($ignoreId, fn ($q) => $q->whereKeyNot($ignoreId))->exists()) {
            $slug = $base.'-'.$i++;
        }

        return $slug;
    }
}
