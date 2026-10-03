@props([
    'title',
    'description',
    'image' => null,
    'canonical' => null,
    'type' => 'website',
    'noindex' => false,
    'publishedAt' => null,
    'modifiedAt' => null,
    'keywords' => null,
    'schema' => [],
])

@php
    $site = config('site');
    $canonicalUrl = $canonical ?: url()->current();
    $ogImage = $image ? asset($image) : $site['url'].'/images/og-default.png';
    $schemaPayload = $schema ? \App\Support\SchemaBuilder::render($schema) : null;
@endphp

{{-- Core metadata. The legacy site had a 26-character description that was
     just the brand name; this is the single biggest on-page SEO fix. --}}
<title>{{ $title }}</title>
<meta name="description" content="{{ \Illuminate\Support\Str::limit(strip_tags($description), 160) }}">
@if ($keywords)
    <meta name="keywords" content="{{ $keywords }}">
@endif
<meta name="author" content="{{ $site['name'] }}">
<meta name="robots" content="{{ $noindex ? 'noindex, nofollow' : 'index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1' }}">
<meta name="googlebot" content="{{ $noindex ? 'noindex' : 'index, follow' }}">

<link rel="canonical" href="{{ $canonicalUrl }}">

{{-- Open Graph --}}
<meta property="og:site_name" content="{{ $site['name'] }}">
<meta property="og:type" content="{{ $type }}">
<meta property="og:title" content="{{ $title }}">
<meta property="og:description" content="{{ \Illuminate\Support\Str::limit(strip_tags($description), 160) }}">
<meta property="og:url" content="{{ $canonicalUrl }}">
<meta property="og:image" content="{{ $ogImage }}">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">
<meta property="og:image:alt" content="{{ $title }}">
<meta property="og:locale" content="en_IN">
@if ($publishedAt)
    <meta property="article:published_time" content="{{ $publishedAt }}">
@endif
@if ($modifiedAt)
    <meta property="article:modified_time" content="{{ $modifiedAt }}">
@endif

{{-- Twitter / X --}}
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $title }}">
<meta name="twitter:description" content="{{ \Illuminate\Support\Str::limit(strip_tags($description), 160) }}">
<meta name="twitter:image" content="{{ $ogImage }}">

{{-- Geo / local business hints, used by some local-SEO crawlers --}}
<meta name="geo.region" content="IN-TN">
<meta name="geo.placename" content="{{ $site['address']['city'] }}">
<meta name="geo.position" content="{{ $site['geo']['latitude'] }};{{ $site['geo']['longitude'] }}">

{{-- Structured data. This is what earns rich results, the local knowledge
     panel and inclusion in AI answer engines. --}}
@if ($schemaPayload)
    <script type="application/ld+json">{!! $schemaPayload !!}</script>
@endif
