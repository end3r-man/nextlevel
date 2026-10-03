<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\Post;
use App\Models\Service;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\URL;

/**
 * Sitemap and robots.
 *
 * The legacy site shipped a sitemap containing exactly one URL (the homepage)
 * and no robots.txt. With 300+ indexable pages now available, this is where a
 * large share of the new traffic will come from.
 */
class SeoController extends Controller
{
    public function __construct()
    {
        // route() resolves against the *request* host and scheme, so a stray
        // internal hostname — or a plain-http request in front of a TLS
        // terminator — would leak into the sitemap and robots.txt. Pin both.
        $configured = rtrim((string) config('site.url'), '/');

        if ($configured !== '') {
            URL::forceRootUrl($configured);
            URL::forceScheme(parse_url($configured, PHP_URL_SCHEME) ?: null);
        }
    }

    public function sitemap(): Response
    {
        $urls = [];

        $add = function (string $loc, Carbon|string $lastmod, string $priority, ?string $changefreq = null) use (&$urls) {
            $entry = ['loc' => $loc, 'lastmod' => $lastmod, 'priority' => $priority];
            if ($changefreq) {
                $entry['changefreq'] = $changefreq;
            }
            $urls[] = $entry;
        };

        $now = Carbon::now()->toAtomString();

        // Static / editorial pages
        $add(route('home'), $now, '1.0', 'weekly');
        $add(route('services.index'), $now, '0.9', 'monthly');
        $add(route('locations.index'), $now, '0.9', 'monthly');
        $add(route('about'), $now, '0.7', 'yearly');
        $add(route('contact'), $now, '0.8', 'yearly');
        $add(route('faq'), $now, '0.7', 'monthly');
        $add(route('gallery'), $now, '0.5', 'monthly');
        $add(route('testimonials'), $now, '0.5', 'monthly');
        $add(route('blog.index'), $now, '0.7', 'weekly');

        // Services — highest-value static pages
        foreach (Service::active()->ordered()->get() as $service) {
            $add(route('services.show', $service), $service->updated_at->toAtomString(), '0.9', 'monthly');
        }

        // Locations — tier drives priority so the money cities are crawled first
        foreach (Location::active()->primary()->get() as $location) {
            $priority = match ($location->priority_tier) {
                1 => '0.9',
                2 => '0.8',
                default => '0.6',
            };
            $add(route('locations.show', $location), $location->updated_at->toAtomString(), $priority, 'monthly');
        }

        // Service x location combos. These are 300+ pages, so they are grouped
        // as a plain <urlset> rather than a <sitemapindex> to keep it to one
        // request. Anything beyond ~50,000 URLs would need splitting.
        foreach (Location::active()->get() as $location) {
            foreach (Service::active()->get() as $service) {
                $add(
                    route('services.location', [$location, $service]),
                    max($location->updated_at, $service->updated_at)->toAtomString(),
                    $location->priority_tier === 1 ? '0.8' : '0.5',
                    'monthly',
                );
            }
        }

        // Blog
        foreach (Post::published()->latestFirst()->get() as $post) {
            $add(route('blog.show', $post), $post->updated_at->toAtomString(), '0.6', 'yearly');
        }

        $xml = view('seo.sitemap', compact('urls'))->render();

        return response($xml, 200, [
            'Content-Type' => 'application/xml; charset=UTF-8',
            'Cache-Control' => 'public, max-age=3600',
        ]);
    }

    public function robots(): Response
    {
        $lines = [
            'User-agent: *',
            'Allow: /',
            '',
            // Only paths that carry no SEO value are blocked. Query strings stay
            // crawlable because /blog?page=2 is real pagination, not a duplicate.
            'Disallow: /admin',
            'Disallow: /vendor',
            'Disallow: /storage/',
            '',
            // Let AI answer engines read the site — this is a large share of
            // how local trade queries are answered now.
            'User-agent: GPTBot',
            'Allow: /',
            '',
            'User-agent: ClaudeBot',
            'Allow: /',
            '',
            'User-agent: PerplexityBot',
            'Allow: /',
            '',
            'Sitemap: '.route('sitemap'),
        ];

        return response(implode("\n", $lines)."\n", 200, [
            'Content-Type' => 'text/plain; charset=UTF-8',
            'Cache-Control' => 'public, max-age=86400',
        ]);
    }
}
