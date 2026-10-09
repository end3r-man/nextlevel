<?php

namespace App\Http\Controllers;

use App\Models\GalleryImage;
use App\Models\Location;
use App\Models\Service;
use App\Models\Testimonial;
use App\Support\SchemaBuilder;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;

/**
 * Service x Location pages — /locations/{city}/{service}
 *
 * These are the pages that actually compete for "house shifting in coimbatore",
 * "office shifting in erode", "local packing in tiruppur" and so on. The legacy
 * site had none of them.
 *
 * The content is composed from real per-service copy plus real per-city copy so
 * each combination reads as its own page rather than a template fill. The city
 * description and the service description never appear in the same sentence, so
 * there is no accidental duplication across the 300 pages.
 */
class LocationServiceController extends Controller
{
    public function show(Location $location, Service $service): View
    {
        abort_unless($location->is_active && $service->is_active, 404);

        $city = $location->name;
        $lowerCity = Str::lower($city);
        $keyword = $service->primary_keyword ?: 'packers and movers';

        // Title formula: "{Service} in {City} | Packers and Movers {City}"
        $title = "{$service->name} in {$city} | Packers and Movers {$city}";

        $description = Str::limit(
            "Looking for {$keyword} in {$lowerCity}? Next Level Packers and Movers provides professional "
            ."{$service->name} across {$city} and nearby areas. Fixed written quotes, trained crews and on-time delivery. "
            .'Call +91 93635 55311.',
            158,
        );

        $services = Service::active()->ordered()->get();

        $otherLocations = Location::active()
            ->where('id', '!=', $location->id)
            ->primary()
            ->limit(8)
            ->get();

        $otherServices = Service::active()
            ->where('id', '!=', $service->id)
            ->ordered()
            ->limit(6)
            ->get();

        $testimonials = Testimonial::active()
            ->where('location', 'like', '%'.$city.'%')
            ->ordered()
            ->limit(2)
            ->get();

        $galleryImages = GalleryImage::forService($service, 4);

        $crumbs = [
            ['title' => 'Home', 'url' => route('home')],
            ['title' => 'Services', 'url' => route('services.index')],
            ['title' => $service->name, 'url' => route('services.show', $service)],
            ['title' => "{$service->name} in {$city}", 'url' => route('services.location', [$location, $service])],
        ];

        $schema = [
            SchemaBuilder::organization(),
            SchemaBuilder::website(),
            SchemaBuilder::webPage($title, $description, route('services.location', [$location, $service]), [
                'image' => $service->image ? asset($service->image) : null,
            ]),
            SchemaBuilder::breadcrumbs($crumbs),
            SchemaBuilder::service($service, $location),
            SchemaBuilder::faqPage($this->buildFaqs($service, $location), route('services.location', [$location, $service])),
        ];

        return view('services.location', compact(
            'location', 'service', 'services', 'otherLocations', 'otherServices',
            'testimonials', 'galleryImages', 'title', 'description', 'schema', 'crumbs', 'keyword',
        ));
    }

    /**
     * City-aware FAQ set. The generic service FAQs answer rate/booking questions;
     * these add the local ones a mover page is actually asked.
     *
     * @return array<int, array{question: string, answer: string}>
     */
    private function buildFaqs(Service $service, Location $location): array
    {
        $city = $location->name;

        $local = [
            [
                'question' => "Do you provide {$service->primary_keyword} in {$city}?",
                'answer' => "Yes. {$service->name} is one of our core services and we run it across {$city} and all "
                    ."surrounding areas. Our office is in Erode and our crews work out of {$city} on a regular basis, so "
                    .'you are not dealing with a broker forwarding the job to an unknown vehicle.',
            ],
            [
                'question' => "How much does {$service->primary_keyword} cost in {$city}?",
                'answer' => 'It depends on volume, floor and lift access, distance and whether you need packing. For a '
                    ."local {$city} move a 1 BHK starts around ₹3,500 with full packing; larger homes and intercity runs "
                    .'are quoted on the goods list. Call us with your two addresses and we will give you a firm written '
                    .'price the same day, and that price does not change on the day.',
            ],
            [
                'question' => "How quickly can you arrange {$service->primary_keyword} in {$city}?",
                'answer' => "For moves within {$city} we can usually arrange the same day if you call before 11 AM, "
                    .'and two to three days notice is comfortable for planned moves. Month-end and month-start weekends '
                    .'book out fast, so give us a week for those.',
            ],
        ];

        if ($location->localities) {
            $local[] = [
                'question' => "Which areas of {$city} do you cover?",
                'answer' => 'We cover the whole of '.$city.' including '.implode(', ', array_slice($location->localities, 0, 8))
                    .'. If you are just outside those, ask us anyway — if we cannot reach you properly on the day, '
                    .'we will tell you before taking the booking.',
            ];
        }

        return array_merge($local, array_slice($service->faqs ?? [], 0, 2));
    }
}
