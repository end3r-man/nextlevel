<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('phone', 32);
            $table->string('departure_city')->nullable();
            $table->string('delivery_city')->nullable();
            $table->date('moving_date')->nullable();
            $table->string('moving_time')->nullable();
            $table->string('service')->nullable();
            $table->string('message')->nullable();
            // Where the enquiry came from, for attribution.
            $table->string('source_page')->nullable();
            $table->string('ip_address', 45)->nullable();
            $table->timestamps();

            $table->index('created_at');
        });

        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->text('value')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('settings');
        Schema::dropIfExists('leads');
    }
};
