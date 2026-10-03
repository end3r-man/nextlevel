<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Location extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'state',
        'district',
        'short_name',
        'excerpt',
        'description',
        'meta_title',
        'meta_description',
        'localities',
        'popular_routes',
        'latitude',
        'longitude',
        'image',
        'icon',
        'sort_order',
        'priority_tier',
        'is_active',
    ];

    protected $casts = [
        'localities' => 'array',
        'popular_routes' => 'array',
        'latitude' => 'float',
        'longitude' => 'float',
        'is_active' => 'boolean',
        'sort_order' => 'integer',
        'priority_tier' => 'integer',
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

    /** Tier 1 cities first — Erode, Tiruppur, Coimbatore. */
    public function scopePrimary(Builder $query): Builder
    {
        return $query->orderBy('priority_tier')->orderBy('sort_order');
    }

    public function getDisplayNameAttribute(): string
    {
        return $this->short_name ?: $this->name;
    }

    public function getSeoTitleAttribute(): string
    {
        return $this->meta_title
            ?: "Packers and Movers in {$this->name} | Next Level Packers & Movers";
    }

    public function getSeoDescriptionAttribute(): string
    {
        return $this->meta_description ?: Str::limit($this->excerpt, 158);
    }

    /** "packers and movers in erode" — the money keyword for this city. */
    public function getPrimaryKeywordAttribute(): string
    {
        return 'packers and movers in '.Str::lower($this->name);
    }
}
