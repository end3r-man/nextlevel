<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\Service;
use App\Models\Testimonial;
use App\Support\SchemaBuilder;
use Illuminate\Contracts\View\View;

class LocationController extends Controller
{
    public function index(): View
    {
        $locations = Location::active()->primary()->get();
        $services = Service::active()->ordered()->get();

        $primary = $locations->where('priority_tier', 1);
        $secondary = $locations->where('priority_tier', 2);
        $localities = $locations->where('priority_tier', 3);

        $title = 'Packers and Movers Locations | Erode, Tiruppur, Coimbatore & More';
        $description = 'Next Level Packers and Movers covers Erode, Tiruppur, Coimbatore, Salem, Trichy, Namakkal, '
            .'Karur, Dharmapuri and Bengaluru plus 16 more towns. Find your city for local moving rates.';

        $crumbs = [
            ['title' => 'Home', 'url' => route('home')],
            ['title' => 'Locations', 'url' => route('locations.index')],
        ];

        $schema = [
            SchemaBuilder::organization(),
            SchemaBuilder::website(),
            SchemaBuilder::webPage($title, $description, route('locations.index')),
            SchemaBuilder::breadcrumbs($crumbs),
        ];

        return view('locations.index', compact(
            'primary', 'secondary', 'localities', 'locations', 'services',
            'title', 'description', 'schema', 'crumbs',
        ));
    }

    public function show(Location $location): View
    {
        abort_unless($location->is_active, 404);

        $services = Service::active()->ordered()->get();
        $nearby = Location::active()
            ->where('id', '!=', $location->id)
            ->primary()
            ->limit(6)
            ->get();

        $testimonials = Testimonial::active()
            ->where('location', 'like', '%'.$location->name.'%')
            ->ordered()
            ->limit(3)
            ->get();

        $title = $location->seo_title;
        $description = $location->seo_description;

        $crumbs = [
            ['title' => 'Home', 'url' => route('home')],
            ['title' => 'Locations', 'url' => route('locations.index')],
            ['title' => $location->name, 'url' => route('locations.show', $location)],
        ];

        $schema = [
            SchemaBuilder::organization(),
            SchemaBuilder::website(),
            SchemaBuilder::webPage($title, $description, route('locations.show', $location), [
                'image' => $location->image ? asset($location->image) : null,
            ]),
            SchemaBuilder::breadcrumbs($crumbs),
        ];

        return view('locations.show', compact(
            'location', 'services', 'nearby', 'testimonials',
            'title', 'description', 'schema', 'crumbs',
        ));
    }
}
