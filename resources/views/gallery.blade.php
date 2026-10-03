@extends('layouts.app')

@push('meta')
    <x-seo :title="$title" :description="$description" image="images/og-default.png"
           :canonical="route('gallery')" :schema="$schema" />
@endpush

@section('content')

<x-page-hero
    eyebrow="Gallery"
    title="Photos from real jobs"
    subtitle="House shifting, office relocation, packing and transport — photographed on the work, in the cities we actually operate in."
    image="images/about-bg.webp"
    :breadcrumbs="$crumbs"
/>

<section class="section">
    <div class="container-page">
        <div class="columns-2 gap-4 sm:columns-3 lg:columns-4">
            @foreach ($images as $image)
                <button type="button"
                        class="group relative mb-4 block w-full overflow-hidden rounded-2xl bg-ink-100"
                        data-lightbox-trigger="{{ asset($image->image) }}"
                        data-lightbox-alt="{{ $image->alt_text }}"
                        data-lightbox-title="{{ $image->caption ?? $image->title }}"
                        aria-label="View larger: {{ $image->title }}">
                    <img src="{{ asset($image->image) }}"
                         alt="{{ $image->alt_text }}"
                         width="900" height="700" loading="lazy" decoding="async"
                         class="w-full object-cover transition duration-500 group-hover:scale-105">

                    <span class="pointer-events-none absolute inset-x-0 bottom-0 bg-gradient-to-t from-ink-950/90 to-transparent p-4 text-left">
                        <span class="block text-sm font-semibold text-white">{{ $image->title }}</span>
                        @if ($image->caption)
                            <span class="mt-0.5 block text-xs text-ink-500">{{ $image->caption }}</span>
                        @endif
                    </span>
                </button>
            @endforeach
        </div>

        <p class="mt-8 text-center text-sm text-ink-500">
            {{ $images->count() }} photos. Select any image to view it larger — use the arrow keys to move between them.
        </p>
    </div>
</section>

<x-lightbox />

<x-quote-form source="gallery" showImage="false"
              heading="Like what you see? That is what your move looks like"
              lead="Send us the details and we will book the same crew and the same care for your move." />

@endsection