<?php

namespace Tests\Feature;

use App\Models\Location;
use App\Models\Service;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

/**
 * Every public page must render, and must render with real content.
 *
 * The legacy site returned 200 for a homepage full of dead city links and
 * empty panels, so "it returns 200" is deliberately not the assertion here —
 * these tests also assert that the SEO surface and the actual content exist.
 */
class PageRenderingTest extends TestCase
{
    #[DataProvider('staticPages')]
    public function test_static_page_renders(string $uri): void
    {
        $response = $this->get($uri);

        $response->assertOk();
        $response->assertSee('<title>', false);
        $response->assertSee('name="description"', false);
        $response->assertSee('rel="canonical"', false);
        $response->assertSee('application/ld+json', false);
    }

    /** @return array<string, array{string}> */
    public static function staticPages(): array
    {
        return [
            'home' => ['/'],
            'about' => ['/about-us'],
            'services hub' => ['/services'],
            'locations hub' => ['/locations'],
            'gallery' => ['/gallery'],
            'reviews' => ['/reviews'],
            'faq' => ['/faq'],
            'blog' => ['/blog'],
            'contact' => ['/contact-us'],
        ];
    }

    public function test_home_links_every_location_instead_of_rendering_dead_text(): void
    {
        $response = $this->get('/');

        $response->assertOk();

        foreach (Location::active()->get() as $location) {
            $response->assertSee(route('locations.show', $location), false);
        }
    }

    public function test_home_links_every_service(): void
    {
        $response = $this->get('/');

        foreach (Service::active()->get() as $service) {
            $response->assertSee(route('services.show', $service), false);
        }
    }

    public function test_home_shows_the_business_phone_number(): void
    {
        $this->get('/')
            ->assertSee(config('site')['phone_display']);
    }

    public function test_every_location_page_renders(): void
    {
        foreach (Location::active()->get() as $location) {
            $this->get(route('locations.show', $location))
                ->assertOk()
                ->assertSee('Packers and Movers in '.$location->name);
        }
    }

    public function test_every_service_page_renders(): void
    {
        foreach (Service::active()->get() as $service) {
            $this->get(route('services.show', $service))
                ->assertOk()
                ->assertSee($service->name);
        }
    }

    public function test_service_location_combination_pages_render(): void
    {
        $location = Location::where('priority_tier', 1)->firstOrFail();
        $service = Service::firstOrFail();

        $this->get(route('services.location', [$location, $service]))
            ->assertOk()
            ->assertSee($service->name.' in '.$location->name, false);
    }

    public function test_all_300_combination_pages_exist(): void
    {
        // Cheap guard against a silently broken route or seeder count.
        $expected = Location::active()->count() * Service::active()->count();

        $this->assertSame(300, $expected);

        foreach (Location::active()->get() as $location) {
            foreach (Service::active()->get() as $service) {
                $this->get(route('services.location', [$location, $service]))->assertOk();
            }
        }
    }

    public function test_inactive_records_are_not_reachable(): void
    {
        $service = Service::firstOrFail();
        $service->update(['is_active' => false]);

        $this->get(route('services.show', $service))->assertNotFound();

        $service->update(['is_active' => true]);

        $location = Location::firstOrFail();
        $location->update(['is_active' => false]);

        $this->get(route('locations.show', $location))->assertNotFound();
    }

    public function test_unknown_pages_return_404(): void
    {
        $this->get('/services/not-a-real-service')->assertNotFound();
        $this->get('/locations/atlantis')->assertNotFound();
        $this->get('/nope')->assertNotFound();
    }
}
