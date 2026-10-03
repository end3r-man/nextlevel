<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\LocationServiceController;
use App\Http\Controllers\SeoController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\TestimonialController;
use App\Models\Post;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public routes
|--------------------------------------------------------------------------
|
| URL architecture, chosen for local SEO:
|
|   /                                  home — brand + primary service term
|   /about                             brand trust
|   /services                          service hub
|   /services/{slug}                   12 service detail pages
|   /locations                         location hub
|   /locations/{city}                  25 city landing pages
|   /locations/{city}/{slug}           25 x 12 service x location combo pages
|
| The combo pages are the actual ranking targets for queries like
| "house shifting in coimbatore". The legacy site had none of these — it
| rendered 25 city names as inert list items.
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/about-us', [HomeController::class, 'about'])->name('about');

Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
Route::get('/services/{service}', [ServiceController::class, 'show'])->name('services.show');

Route::get('/locations', [LocationController::class, 'index'])->name('locations.index');
Route::get('/locations/{location}', [LocationController::class, 'show'])->name('locations.show');
Route::get('/locations/{location}/{service}', [LocationServiceController::class, 'show'])->name('services.location');

Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery');
Route::get('/reviews', [TestimonialController::class, 'index'])->name('testimonials');
Route::get('/faq', [HomeController::class, 'faq'])->name('faq');

Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{post}', [BlogController::class, 'show'])->name('blog.show');

Route::get('/contact-us', [ContactController::class, 'index'])->name('contact');
Route::post('/enquiry', [ContactController::class, 'store'])->name('enquiry.store');

/*
|--------------------------------------------------------------------------
| Lead capture — dedicated endpoint so the quote form can live on any page
| (home, service, location) without every page owning a POST route.
*/
Route::post('/get-a-quote', [ContactController::class, 'store'])
    ->middleware('throttle:10,1')
    ->name('quote.store');

/*
|--------------------------------------------------------------------------
| SEO endpoints
*/
Route::get('/sitemap.xml', [SeoController::class, 'sitemap'])->name('sitemap');
Route::get('/robots.txt', [SeoController::class, 'robots'])->name('robots');
