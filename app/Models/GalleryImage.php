<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GalleryImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'image',
        'alt_text',
        'caption',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('sort_order')->orderBy('id');
    }

    /**
     * Map service slugs to prioritized gallery images based on category relevance.
     *
     * @return array<string, array<int, string>>
     */
    public static function serviceCategoryMap(): array
    {
        return [
            'house-shifting' => ['images/55.webp', 'images/g1.webp', 'images/g2.webp', 'images/g3.webp', 'images/g88.webp', 'images/g11.webp', 'images/g12.webp', 'images/g10.webp'],
            'office-shifting' => ['images/g4.webp', 'images/g3.webp', 'images/g1.webp', 'images/g2.webp', 'images/g12.webp', 'images/55.webp'],
            'local-shifting' => ['images/55.webp', 'images/g5.webp', 'images/g2.webp', 'images/g10.webp', 'images/g13.webp', 'images/g3.webp', 'images/g12.webp'],
            'international-shifting' => ['images/g1.webp', 'images/g2.webp', 'images/g9.webp', 'images/g11.webp', 'images/g13.webp', 'images/55.webp'],
            'loading-and-unloading' => ['images/55.webp', 'images/g5.webp', 'images/g10.webp', 'images/g88.webp', 'images/g13.webp', 'images/g12.webp'],
            'packing-services' => ['images/g1.webp', 'images/g2.webp', 'images/g3.webp', 'images/g9.webp', 'images/g88.webp', 'images/g12.webp'],
            'domestic-movers' => ['images/g11.webp', 'images/55.webp', 'images/g5.webp', 'images/g13.webp', 'images/g2.webp', 'images/g10.webp'],
            'door-to-door-service' => ['images/g10.webp', 'images/g13.webp', 'images/55.webp', 'images/g1.webp', 'images/g12.webp', 'images/g88.webp'],
            'storage-facility' => ['images/g7.webp', 'images/g2.webp', 'images/g9.webp', 'images/g13.webp', 'images/g1.webp'],
            'two-wheeler-shifting' => ['images/g6.webp', 'images/55.webp', 'images/g5.webp', 'images/g13.webp', 'images/g11.webp'],
            'transport-service' => ['images/g5.webp', 'images/g11.webp', 'images/g13.webp', 'images/55.webp', 'images/g6.webp'],
            'relocation-service' => ['images/55.webp', 'images/g1.webp', 'images/g4.webp', 'images/g88.webp', 'images/g10.webp', 'images/g11.webp'],
        ];
    }

    /**
     * Get randomized gallery images related to a specific service.
     * Prioritizes category-matched images and fills remaining slots with other active images.
     *
     * @return Collection<int, static>
     */
    public static function forService(Service|string $service, int $limit = 4): Collection
    {
        $slug = $service instanceof Service ? $service->slug : $service;
        $map = self::serviceCategoryMap();
        $preferredImages = $map[$slug] ?? [];

        $allActive = self::active()->get();

        if ($allActive->isEmpty()) {
            return new Collection;
        }

        // Partition into matching category images and others, then randomize each group
        $matched = $allActive->filter(fn ($img) => in_array($img->image, $preferredImages, true))->shuffle();
        $others = $allActive->reject(fn ($img) => in_array($img->image, $preferredImages, true))->shuffle();

        return $matched->concat($others)->take($limit)->values();
    }
}
