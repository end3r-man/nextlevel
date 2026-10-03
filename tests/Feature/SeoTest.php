<?php

namespace Tests\Feature;

use App\Models\Location;
use App\Models\Post;
use App\Models\Service;
use Tests\TestCase;

/**
 * The SEO surface is the product here, so it gets asserted rather than
 * assumed. A regression in a meta tag is invisible in a browser but fatal in
 * a search result.
 */
class SeoTest extends TestCase
{
    public function test_every_page_has_a_unique_title_and_description(): void
    {
        $urls = ['/'];

        foreach (Service::active()->limit(3)->get() as $service) {
            $urls[] = route('services.show', $service);
        }

        foreach (Location::active()->where('priority_tier', 1)->get() as $location) {
            $urls[] = route('locations.show', $location);
        }

        $titles = [];
        $descriptions = [];

        foreach ($urls as $url) {
            $html = $this->get($url)->assertOk()->getContent();

            $title = $this->extractTag($html, 'title');
            $description = $this->extractAttribute($html, '<meta name="description"', 'content');

            $this->assertNotSame('', $title, "Missing title on {$url}");
            $this->assertNotSame('', $description, "Missing description on {$url}");

            $this->assertLessThanOrEqual(
                180,
                mb_strlen($title),
                "Title longer than 180 chars on {$url}",
            );

            $this->assertLessThanOrEqual(
                170,
                mb_strlen($description),
                "Meta description longer than ~160 chars on {$url}: {$description}",
            );

            $this->assertArrayNotHasKey($title, $titles, "Duplicate title '{$title}' on {$url}");
            $this->assertArrayNotHasKey($description, $descriptions, "Duplicate description on {$url}");

            $titles[$title] = $url;
            $descriptions[$description] = $url;
        }
    }

    public function test_canonical_matches_the_requested_url(): void
    {
        $url = route('locations.show', Location::firstOrFail());

        $html = $this->get($url)->assertOk()->getContent();

        $canonical = $this->extractAttribute($html, '<link rel="canonical"', 'href');

        $this->assertStringEndsWith(
            parse_url($url, PHP_URL_PATH),
            $canonical,
        );
    }

    public function test_open_graph_and_twitter_cards_are_present(): void
    {
        $html = $this->get('/')->assertOk()->getContent();

        foreach ([
            'og:title',
            'og:description',
            'og:image',
            'og:url',
            'og:type',
            'twitter:card',
            'twitter:title',
            'twitter:image',
        ] as $property) {
            $this->assertStringContainsString($property, $html, "Missing {$property}");
        }
    }

    public function test_default_social_image_actually_exists(): void
    {
        $html = $this->get('/about-us')->assertOk()->getContent();

        $image = $this->extractAttribute($html, '<meta property="og:image"', 'content');

        $this->assertNotSame('', $image);

        // asset() emits a real path; the file must be on disk or social previews
        // silently break in production.
        $relative = parse_url($image, PHP_URL_PATH);

        $this->assertFileExists(public_path(ltrim($relative, '/')));
    }

    public function test_every_image_has_an_alt_attribute(): void
    {
        $html = $this->get('/')->assertOk()->getContent();

        preg_match_all('/<img\b[^>]*>/i', $html, $matches);

        $this->assertNotEmpty($matches[0], 'Home page rendered no images');

        foreach ($matches[0] as $img) {
            // Decorative images must still carry alt="" so screen readers skip
            // them. A missing attribute entirely is the bug we are catching.
            $this->assertMatchesRegularExpression(
                '/\balt=/i',
                $img,
                "Image without an alt attribute: {$img}",
            );
        }
    }

    public function test_pages_expose_exactly_one_h1(): void
    {
        foreach (['/', '/services', '/locations', '/contact-us', '/faq'] as $url) {
            $html = $this->get($url)->assertOk()->getContent();

            $this->assertSame(
                1,
                preg_match_all('/<h1\b/i', $html),
                "Expected exactly one <h1> on {$url}",
            );
        }
    }

    public function test_no_duplicate_element_ids(): void
    {
        foreach (['/', '/contact-us', '/services/house-shifting'] as $url) {
            $html = $this->get($url)->assertOk()->getContent();

            preg_match_all('/\sid="([^"]+)"/i', $html, $matches);

            $ids = $matches[1];
            $duplicates = array_keys(array_filter(array_count_values($ids), fn ($n) => $n > 1));

            $this->assertSame(
                [],
                $duplicates,
                "Duplicate id(s) on {$url}: ".implode(', ', $duplicates),
            );
        }
    }

    public function test_internal_links_are_absolute_and_https(): void
    {
        $html = $this->get('/')->assertOk()->getContent();

        preg_match_all('/href="(http:\/\/[^"]+)"/i', $html, $matches);

        $this->assertSame([], $matches[1], 'Page contains plain-http absolute links');
    }

    public function test_structured_data_is_valid_json(): void
    {
        $html = $this->get('/')->assertOk()->getContent();

        preg_match_all(
            '/<script type="application\/ld\+json">(.*?)<\/script>/s',
            $html,
            $matches,
        );

        $this->assertNotEmpty($matches[1]);

        foreach ($matches[1] as $json) {
            $decoded = json_decode($json, true);

            $this->assertIsArray(
                $decoded,
                'Invalid JSON-LD: '.json_last_error_msg().' in '.substr($json, 0, 120),
            );
        }
    }

    public function test_business_schema_contains_the_nap_data(): void
    {
        $html = $this->get('/')->assertOk()->getContent();

        preg_match('/<script type="application\/ld\+json">(.*?)<\/script>/s', $html, $matches);
        $graph = json_decode($matches[1], true);

        $json = json_encode($graph);

        $site = config('site');

        $this->assertStringContainsString($site['phone_display'], $json);
        $this->assertStringContainsString($site['address']['street'], $json);
        $this->assertStringContainsString($site['address']['postal_code'], $json);
    }

    public function test_sitemap_contains_every_public_page(): void
    {
        $xml = $this->get('/sitemap.xml')->assertOk()->getContent();

        preg_match_all('#<loc>(.*?)</loc>#', $xml, $matches);

        // Compare paths, not absolute URLs, so the assertion stays focused on
        // coverage instead of re-testing the host (covered separately below).
        $paths = array_map(
            // The homepage URL has no path segment, so parse_url returns null.
            fn (string $loc): string => parse_url($loc, PHP_URL_PATH) ?: '/',
            $matches[1],
        );

        $this->assertContains('/', $paths);
        $this->assertContains('/services', $paths);
        $this->assertContains('/locations', $paths);
        $this->assertContains('/contact-us', $paths);

        // 1 home + hubs + about/contact/faq/gallery/reviews/blog (9) + 12
        // services + 25 locations + 300 combos + posts.
        $this->assertSame(9 + 12 + 25 + 300 + Post::published()->count(), count($paths));

        foreach (Service::active()->get() as $service) {
            $this->assertContains(
                parse_url(route('services.show', $service), PHP_URL_PATH) ?: '/',
                $paths,
            );
        }

        foreach (Location::active()->get() as $location) {
            $this->assertContains(
                parse_url(route('locations.show', $location), PHP_URL_PATH) ?: '/',
                $paths,
            );
        }
    }

    public function test_sitemap_uses_the_configured_canonical_domain(): void
    {
        $xml = $this->get('/sitemap.xml')->assertOk()->getContent();

        preg_match_all('#<loc>(.*?)</loc>#', $xml, $matches);

        $this->assertNotEmpty($matches[1]);

        foreach ($matches[1] as $loc) {
            $this->assertStringStartsWith(config('site.url'), $loc);
        }

        $this->assertStringNotContainsString('localhost', $xml);
        $this->assertStringNotContainsString('127.0.0.1', $xml);
    }

    public function test_robots_txt_points_at_the_sitemap(): void
    {
        $response = $this->get('/robots.txt')->assertOk();

        $response->assertHeader('Content-Type', 'text/plain; charset=UTF-8');

        $body = $response->getContent();

        $this->assertStringContainsString('User-agent: *', $body);
        $this->assertStringContainsString(
            'Sitemap: '.rtrim(config('site.url'), '/').'/sitemap.xml',
            $body,
        );
    }

    public function test_blog_posts_are_indexable_and_carry_article_schema(): void
    {
        $post = Post::published()->firstOrFail();

        $html = $this->get(route('blog.show', $post))->assertOk()->getContent();

        $this->assertStringContainsString('article:published_time', $html);

        // SchemaBuilder emits BlogPosting (a subtype of Article) and encodes
        // with JSON_PRETTY_PRINT, so the separator is ": ".
        $this->assertStringContainsString('"@type": "BlogPosting"', $html);
    }

    private function extractTag(string $html, string $tag): string
    {
        preg_match('/<'.$tag.'[^>]*>(.*?)<\/'.$tag.'>/si', $html, $m);

        return trim($m[1] ?? '');
    }

    private function extractAttribute(string $html, string $marker, string $attribute): string
    {
        // Find the tag containing $marker, then pull $attribute out of it.
        preg_match_all('/<(?:meta|link)\b[^>]*>/i', $html, $tags);

        foreach ($tags[0] as $tag) {
            if (! str_contains($tag, $marker)) {
                continue;
            }
            preg_match('/\b'.$attribute.'="([^"]*)"/i', $tag, $m);

            return $m[1] ?? '';
        }

        return '';
    }
}
