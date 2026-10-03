<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\GalleryImage;
use App\Models\Location;
use App\Models\Post;
use App\Models\Service;
use App\Models\Setting;
use App\Models\Testimonial;
use App\Support\SchemaBuilder;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;

class HomeController extends Controller
{
    public function index(): View
    {
        $site = config('site');

        $services = Service::active()->ordered()->get();
        $primaryLocations = Location::active()->where('priority_tier', 1)->orderBy('sort_order')->get();
        $allLocations = Location::active()->primary()->get();
        $testimonials = Testimonial::active()->ordered()->limit(4)->get();
        $gallery = GalleryImage::active()->ordered()->limit(6)->get();
        $faqs = Faq::active()->ordered()->limit(8)->get();
        $posts = Post::published()->latestFirst()->limit(3)->get();

        $serviceGroups = $this->groupServices($services);
        $stats = $this->stats();

        $title = 'Packers and Movers in Erode, Tiruppur & Coimbatore | Next Level';

        $description = 'Next Level Packers and Movers is a packers and movers company in Erode, Tiruppur and Coimbatore. '
            .'House shifting, office relocation, packing, loading, storage and international moving since '
            .$site['founded_year'].'. Call '.$site['phone_display'].' for a free written quote.';

        $schema = [
            SchemaBuilder::organization(),
            SchemaBuilder::website(),
            SchemaBuilder::webPage(
                $title,
                $description,
                route('home'),
                ['image' => asset('images/why.webp')],
            ),
            SchemaBuilder::faqPage(
                $faqs->map(fn ($f) => ['question' => $f->question, 'answer' => $f->answer])->all(),
                route('home'),
            ),
        ];

        return view('home', compact(
            'services', 'serviceGroups', 'primaryLocations', 'allLocations', 'testimonials',
            'gallery', 'faqs', 'posts', 'stats', 'title', 'description', 'schema',
        ));
    }

    /**
     * Bucket the twelve services by who is moving, so a visitor can scan for
     * their situation instead of reading a uniform grid of twelve tiles.
     *
     * The taxonomy lives here rather than in the view so the template stays
     * presentational. It is keyed by slug because `services` has no category
     * column; if the grouping ever needs editing from the admin side, promote
     * it to a real column and this method becomes a simple groupBy.
     *
     * @param  Collection<int, Service>  $services
     * @return array<string, array{label: string, icon: string, blurb: string, services: Collection}>
     */
    private function groupServices($services): array
    {
        $definitions = [
            'Home & household' => [
                'icon' => 'house',
                'blurb' => 'Flats, houses and personal belongings — the move most of our work is.',
                'slugs' => ['house-shifting', 'local-shifting', 'packing-services', 'door-to-door-service', 'two-wheeler-shifting'],
            ],
            'Business & office' => [
                'icon' => 'truck',
                'blurb' => 'Offices, factories and shops, moved around your working hours.',
                'slugs' => ['office-shifting', 'relocation-service', 'loading-and-unloading'],
            ],
            'Specialist & long distance' => [
                'icon' => 'globe',
                'blurb' => 'Intercity, overseas, storage between moves and vehicle transport.',
                'slugs' => ['international-shifting', 'domestic-movers', 'storage-facility', 'transport-service'],
            ],
        ];

        $groups = [];

        foreach ($definitions as $label => $definition) {
            $groups[$label] = [
                'label' => $label,
                'icon' => $definition['icon'],
                'blurb' => $definition['blurb'],
                'services' => $services->whereIn('slug', $definition['slugs'])->values(),
            ];
        }

        return $groups;
    }

    public function about(): View
    {
        $services = Service::active()->ordered()->get();
        $testimonials = Testimonial::active()->ordered()->limit(3)->get();
        $stats = $this->stats();

        $title = 'About Us | Packers and Movers in Erode, Tiruppur & Coimbatore';
        $description = 'Next Level Packers and Movers has been moving households and businesses across Tamil Nadu since '
            .config('site')['founded_year'].'. Meet the team behind our packers and movers service in Erode, Tiruppur and Coimbatore.';

        $crumbs = [
            ['title' => 'Home', 'url' => route('home')],
            ['title' => 'About Us', 'url' => route('about')],
        ];

        $schema = [
            SchemaBuilder::organization(),
            SchemaBuilder::website(),
            SchemaBuilder::webPage($title, $description, route('about'), [
                'image' => asset('images/abt.webp'),
                'type' => 'AboutPage',
            ]),
            SchemaBuilder::breadcrumbs($crumbs),
        ];

        return view('about', compact('services', 'testimonials', 'stats', 'title', 'description', 'schema', 'crumbs'));
    }

    public function faq(): View
    {
        $faqs = Faq::active()->ordered()->get();
        $services = Service::active()->ordered()->get();
        $locations = Location::active()->primary()->limit(9)->get();

        $title = 'Packers and Movers FAQ | Moving Costs, Timing & Service Questions';
        $description = 'Answers to common questions about packers and movers in Erode, Tiruppur and Coimbatore — '
            .'moving costs, booking, packing materials, insurance, storage and coverage areas.';

        $crumbs = [
            ['title' => 'Home', 'url' => route('home')],
            ['title' => 'FAQ', 'url' => route('faq')],
        ];

        $schema = [
            SchemaBuilder::organization(),
            SchemaBuilder::website(),
            SchemaBuilder::webPage($title, $description, route('faq')),
            SchemaBuilder::breadcrumbs($crumbs),
            SchemaBuilder::faqPage(
                $faqs->map(fn ($f) => ['question' => $f->question, 'answer' => $f->answer])->all(),
                route('faq'),
            ),
        ];

        return view('faq', compact('faqs', 'services', 'locations', 'title', 'description', 'schema', 'crumbs'));
    }

    /** @return array<string, int|string> */
    private function stats(): array
    {
        return [
            'years' => now()->year - (int) config('site')['founded_year'],
            'moves' => (int) (Setting::get('moves_completed', '8500')),
            'crew' => (int) (Setting::get('crew_members', '50')),
            'cities' => Location::active()->count(),
            'rating' => config('site')['rating']['value'],
            'reviews' => config('site')['rating']['count'],
        ];
    }
}
