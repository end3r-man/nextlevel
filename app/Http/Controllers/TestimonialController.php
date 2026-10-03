<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use App\Support\SchemaBuilder;
use Illuminate\Contracts\View\View;

class TestimonialController extends Controller
{
    public function index(): View
    {
        $testimonials = Testimonial::active()->ordered()->get();

        $title = 'Client Reviews | Packers and Movers in Erode, Tiruppur & Coimbatore';
        $description = 'Read what customers across Erode, Tiruppur and Coimbatore say about our house shifting, '
            .'office relocation and packing services. Rated '.config('site')['rating']['value'].' out of 5.';

        $crumbs = [
            ['title' => 'Home', 'url' => route('home')],
            ['title' => 'Reviews', 'url' => route('testimonials')],
        ];

        $schema = [
            SchemaBuilder::organization(),
            SchemaBuilder::website(),
            SchemaBuilder::webPage($title, $description, route('testimonials')),
            SchemaBuilder::breadcrumbs($crumbs),
        ];

        return view('testimonials', compact('testimonials', 'title', 'description', 'schema', 'crumbs'));
    }
}
