<?php
/** @var array<int, array{loc: string, lastmod: string, priority: string, changefreq?: string}> $urls */
?>
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
@foreach ($urls as $url)
    <url>
        <loc>{{ $url['loc'] }}</loc>
        <lastmod>{{ $url['lastmod'] }}</lastmod>
        @if (! empty($url['changefreq']))
            <changefreq>{{ $url['changefreq'] }}</changefreq>
        @endif
        <priority>{{ $url['priority'] }}</priority>
    </url>
@endforeach
</urlset>
