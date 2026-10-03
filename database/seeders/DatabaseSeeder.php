<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            ServiceSeeder::class,
            LocationSeeder::class,
            ContentSeeder::class,
            FaqSeeder::class,
            PostSeeder::class,
        ]);

        Setting::put('hero_subtitle', 'Stress-free shifting starts here with safe packing, secure transport, timely delivery and affordable moving solutions across Erode, Tiruppur and Coimbatore.');
        Setting::put('founded_year', (string) config('site.founded_year'));
        Setting::put('years_experience', (string) (now()->year - (int) config('site.founded_year')));
        Setting::put('moves_completed', '8500');
        Setting::put('vehicles_fleet', '60');
        Setting::put('crew_members', '50');
        Setting::put('cities_served', '25');
    }
}
