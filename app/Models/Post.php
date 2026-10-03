<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'body',
        'image',
        'author',
        'meta_title',
        'meta_description',
        'published_at',
        'views',
        'is_published',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'is_published' => 'boolean',
        'views' => 'integer',
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('is_published', true)->whereNotNull('published_at');
    }

    public function scopeLatestFirst(Builder $query): Builder
    {
        return $query->orderByDesc('published_at');
    }

    public function getReadingMinutesAttribute(): int
    {
        $words = str_word_count(strip_tags($this->body));

        return max(1, (int) ceil($words / 220));
    }

    public function getSeoTitleAttribute(): string
    {
        return $this->meta_title ?: $this->title;
    }

    public function getSeoDescriptionAttribute(): string
    {
        return $this->meta_description ?: Str::limit($this->excerpt, 158);
    }
}
