<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'excerpt',
        'description',
        'icon',
        'image',
        'meta_title',
        'meta_description',
        'primary_keyword',
        'benefits',
        'includes',
        'faqs',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'benefits' => 'array',
        'includes' => 'array',
        'faqs' => 'array',
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('sort_order')->orderBy('name');
    }

    public function testimonials()
    {
        return $this->hasMany(Testimonial::class);
    }

    /** "House Shifting" -> "house-shifting" */
    public static function slugFor(string $name): string
    {
        return Str::slug($name);
    }

    public function getSeoTitleAttribute(): string
    {
        return $this->meta_title ?: "{$this->name} Services | Next Level Packers & Movers";
    }

    public function getSeoDescriptionAttribute(): string
    {
        return $this->meta_description ?: Str::limit($this->excerpt, 158);
    }
}
