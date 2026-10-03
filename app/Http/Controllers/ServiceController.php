<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\Service;
use App\Models\Testimonial;
use App\Support\SchemaBuilder;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index(Request $request): View
    {
        $services = Service::active()->ordered()->get();
        $primaryLocations = Location::active()->where('priority_tier', 1)->orderBy('sort_order')->get();
        $testimonials = Testimonial::active()->ordered()->limit(3)->get();

        $title = 'Our Moving & Relocation Services | Packers and Movers Erode, Coimbatore';
        $description = 'House shifting, office relocation, local and international moving, packing, loading, '
            .'storage, two-wheeler shifting and door-to-door relocation across Erode, Tiruppur and Coimbatore.';

        $crumbs = [
            ['title' => 'Home', 'url' => route('home')],
            ['title' => 'Services', 'url' => route('services.index')],
        ];

        $schema = [
            SchemaBuilder::organization(),
            SchemaBuilder::website(),
            SchemaBuilder::webPage($title, $description, route('services.index'), [
                'image' => asset('images/s1.webp'),
            ]),
            SchemaBuilder::breadcrumbs($crumbs),
        ];

        return view('services.index', compact(
            'services', 'primaryLocations', 'testimonials', 'title', 'description', 'schema', 'crumbs',
        ));
    }

    public function show(Service $service): View
    {
        abort_unless($service->is_active, 404);

        $locations = Location::active()->primary()->get();
        $related = Service::active()->ordered()
            ->where('id', '!=', $service->id)
            ->limit(4)
            ->get();

        $testimonials = Testimonial::active()
            ->where('service_id', $service->id)
            ->ordered()
            ->get();

        // The service x location pages are the money pages. Linking every
        // service to every tier-1 and tier-2 city builds a dense internal
        // graph around the commercial keywords.
        $targetLocations = Location::active()
            ->where('priority_tier', '<=', 2)
            ->orderBy('priority_tier')
            ->orderBy('sort_order')
            ->get();

        $title = $service->seo_title;
        $description = $service->seo_description;

        $crumbs = [
            ['title' => 'Home', 'url' => route('home')],
            ['title' => 'Services', 'url' => route('services.index')],
            ['title' => $service->name, 'url' => route('services.show', $service)],
        ];

        $schema = [
            SchemaBuilder::organization(),
            SchemaBuilder::website(),
            SchemaBuilder::webPage($title, $description, route('services.show', $service), [
                'image' => $service->image ? asset($service->image) : null,
            ]),
            SchemaBuilder::breadcrumbs($crumbs),
            SchemaBuilder::service($service),
            SchemaBuilder::faqPage($service->faqs ?? [], route('services.show', $service)),
        ];

        return view('services.show', compact(
            'service', 'locations', 'related', 'testimonials', 'targetLocations',
            'title', 'description', 'schema', 'crumbs',
        ));
    }
}
