<?php

namespace App\Http\Controllers;

use App\Models\GalleryImage;
use App\Support\SchemaBuilder;
use Illuminate\Contracts\View\View;

class GalleryController extends Controller
{
    public function index(): View
    {
        $images = GalleryImage::active()->ordered()->get();

        $title = 'Gallery | Packers and Movers in Erode, Tiruppur & Coimbatore';
        $description = 'Photos from real house shifting, office relocation, packing and transport jobs carried out by '
            .'Next Level Packers and Movers across Erode, Tiruppur and Coimbatore.';

        $crumbs = [
            ['title' => 'Home', 'url' => route('home')],
            ['title' => 'Gallery', 'url' => route('gallery')],
        ];

        $schema = [
            SchemaBuilder::organization(),
            SchemaBuilder::website(),
            SchemaBuilder::webPage($title, $description, route('gallery'), [
                'image' => $images->first() ? asset($images->first()->image) : null,
            ]),
            SchemaBuilder::breadcrumbs($crumbs),
        ];

        return view('gallery', compact('images', 'title', 'description', 'schema', 'crumbs'));
    }
}
