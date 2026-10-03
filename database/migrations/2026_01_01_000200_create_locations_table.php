<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('state')->default('Tamil Nadu');
            $table->string('district')->nullable();
            // "Erode", "Coimbatore" — used for natural language in copy.
            $table->string('short_name')->nullable();
            $table->text('excerpt');
            $table->longText('description');
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            // Localities / neighbourhoods served, shown as chips.
            $table->json('localities')->nullable();
            // Popular routes from this city, drives the internal-linking block.
            $table->json('popular_routes')->nullable();
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
            $table->string('image')->nullable();
            $table->string('icon')->default('ph:map-pin-fill');
            $table->unsignedInteger('sort_order')->default(0);
            // Tier 1 = primary money cities (Erode, Tiruppur, Coimbatore).
            $table->unsignedTinyInteger('priority_tier')->default(3);
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index(['is_active', 'priority_tier', 'sort_order']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('locations');
    }
};
