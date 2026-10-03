<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            // Short description used on cards and in meta descriptions.
            $table->string('excerpt', 300);
            // Long-form body, stored as markdown-ish HTML.
            $table->longText('description');
            $table->string('icon')->default('ph:package-fill');
            $table->string('image')->nullable();
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            // Primary target keyword, e.g. "packers and movers"
            $table->string('primary_keyword')->nullable();
            $table->json('benefits')->nullable();
            $table->json('includes')->nullable();
            $table->json('faqs')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index(['is_active', 'sort_order']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
