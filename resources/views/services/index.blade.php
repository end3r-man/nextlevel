@extends('layouts.app')

@push('meta')
    <x-seo :title="$title" :description="$description" image="images/s1.webp"
           :canonical="route('services.index')" :schema="$schema" />
@endpush

@section('content')

<x-page-hero
    eyebrow="Our services"
    title="Moving and relocation services for homes and businesses"
    subtitle="Twelve services covering every stage of a move — from a single sofa to a full factory floor, and from a one-bedroom flat to an international shipment."
    image="images/about-bg.webp"
    :breadcrumbs="$crumbs"
/>

{{-- ============================== SERVICE LIST ============================== --}}
<section class="section">
    <div class="container-page">
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($services as $service)
                <article class="card-hover group flex flex-col overflow-hidden" data-reveal>
                    <div class="relative h-44 overflow-hidden bg-ink-100">
                        <img src="{{ asset($service->image) }}"
                             alt="{{ $service->name }} services in Erode, Tiruppur and Coimbatore"
                             width="378" height="388" loading="lazy" decoding="async"
                             class="h-full w-full object-cover transition duration-500 group-hover:scale-105">
                        <div class="absolute inset-0 bg-gradient-to-t from-ink-950/80 to-transparent"></div>
                        <span class="absolute top-4 left-4 inline-flex h-11 w-11 items-center justify-center rounded-xl bg-white/95 text-brand-700 shadow-soft">
                            <x-icon :name="$service->icon" class="w-5 h-5" />
                        </span>
                    </div>

                    <div class="flex flex-1 flex-col p-6">
                        <h2 class="text-lg">
                            <a href="{{ route('services.show', $service) }}" class="transition hover:text-brand-700">
                                {{ $service->name }}
                            </a>
                        </h2>

                        <p class="mt-3 flex-1 text-sm leading-relaxed text-ink-600">{{ $service->excerpt }}</p>

                        @if ($service->benefits)
                            <ul class="mt-4 space-y-1.5">
                                @foreach (array_slice($service->benefits, 0, 3) as $benefit)
                                    <li class="flex items-start gap-2 text-xs text-ink-500">
                                        <x-icon name="check" class="mt-0.5 w-3.5 h-3.5 shrink-0 text-emerald-500" />
                                        {{ $benefit }}
                                    </li>
                                @endforeach
                            </ul>
                        @endif

                        <a href="{{ route('services.show', $service) }}"
                           class="mt-6 inline-flex items-center gap-2 text-sm font-semibold text-brand-700">
                            {{ $service->name }} details
                            <x-icon name="arrow-right" class="w-4 h-4 transition group-hover:translate-x-1" />
                        </a>
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</section>

{{-- ============================== SERVICE x LOCATION ============================== --}}
<section class="section bg-ink-50">
    <div class="container-page">
        <x-section-heading
            eyebrow="Local availability"
            title="Our services in your city"
            lead="We run dedicated crews in all three primary cities. Pick your city to see local rates, timings and what is included."
        />

        <div class="mt-12 grid gap-6 lg:grid-cols-3">
            @foreach ($primaryLocations as $loc)
                <div class="card p-7" data-reveal>
                    <h3 class="flex items-center gap-2.5 text-lg">
                        <span class="inline-flex h-9 w-9 items-center justify-center rounded-lg bg-brand-50 text-brand-700">
                            <x-icon name="pin" class="w-5 h-5" />
                        </span>
                        {{ $loc->name }}
                    </h3>

                    <ul class="mt-5 space-y-1">
                        @foreach ($services as $service)
                            <li>
                                <a href="{{ route('services.location', [$loc, $service]) }}"
                                   class="flex items-center justify-between gap-3 rounded-lg px-3 py-2 text-sm text-ink-600 transition hover:bg-white hover:text-brand-700">
                                    {{ $service->name }}
                                    <x-icon name="chevron-right" class="w-3.5 h-3.5 text-ink-400" />
                                </a>
                            </li>
                        @endforeach
                    </ul>

                    <a href="{{ route('locations.show', $loc) }}" class="btn-outline mt-6 w-full !py-2.5 text-sm">
                        All {{ $loc->name }} services
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ============================== REVIEWS ============================== --}}
@if ($testimonials->isNotEmpty())
    <section class="section">
        <div class="container-page">
            <x-section-heading eyebrow="Reviews" title="Customers on these services" align="left" />

            <div class="mt-12 grid gap-6 md:grid-cols-3">
                @foreach ($testimonials as $t)
                    <figure class="card flex flex-col p-7" data-reveal>
                        <div class="flex gap-0.5 text-accent-500" aria-label="{{ $t->rating }} out of 5 stars">
                            @for ($i = 0; $i < $t->rating; $i++)
                                <x-icon name="star" class="w-4 h-4" />
                            @endfor
                        </div>
                        <blockquote class="mt-4 flex-1 text-sm leading-relaxed text-ink-700">{{ $t->quote }}</blockquote>
                        <figcaption class="mt-6 border-t border-ink-100 pt-5">
                            <p class="font-bold text-ink-900">{{ $t->name }}</p>
                            <p class="text-xs text-ink-500">{{ $t->designation }}{{ $t->location ? ' · '.$t->location : '' }}</p>
                        </figcaption>
                    </figure>
                @endforeach
            </div>
        </div>
    </section>
@endif

{{-- ============================== GALLERY / REAL WORK ============================== --}}
@if (isset($galleryImages) && $galleryImages->isNotEmpty())
    <section class="section">
        <div class="container-page">
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
                <div>
                    <x-section-heading
                        eyebrow="Operations in action"
                        title="Real work across our 12 services"
                        lead="A glimpse into everyday moves, packing standards and vehicle fleets handled by our full-time crews."
                        align="left"
                    />
                </div>
                <a href="{{ route('gallery') }}" class="btn-outline shrink-0 text-xs">
                    Explore all photos
                    <x-icon name="arrow-right" class="w-3.5 h-3.5" />
                </a>
            </div>

            <div class="mt-10 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
                @foreach ($galleryImages as $img)
                    <button type="button"
                            class="card-hover group relative overflow-hidden rounded-2xl text-left bg-white"
                            data-lightbox-trigger="{{ asset($img->image) }}"
                            data-lightbox-alt="{{ $img->alt_text }}"
                            data-lightbox-title="{{ $img->caption ?? $img->title }}"
                            aria-label="View larger: {{ $img->title }}">
                        <div class="relative aspect-[4/3] w-full overflow-hidden bg-ink-100">
                            <img src="{{ asset($img->image) }}"
                                 alt="{{ $img->alt_text }}"
                                 width="600" height="450" loading="lazy" decoding="async"
                                 class="h-full w-full object-cover transition duration-500 group-hover:scale-105">
                            <div class="absolute inset-0 bg-gradient-to-t from-ink-950/80 via-ink-950/20 to-transparent"></div>
                            <span class="absolute top-3 right-3 inline-flex items-center gap-1 rounded-full bg-ink-950/60 px-2.5 py-1 text-[11px] font-semibold text-white backdrop-blur-xs">
                                <x-icon name="image" class="w-3 h-3 text-accent-400" />
                                <span>Expand</span>
                            </span>
                        </div>
                        <div class="p-4">
                            <p class="font-bold text-sm text-ink-900 line-clamp-1">{{ $img->title }}</p>
                            @if ($img->caption || $img->alt_text)
                                <p class="mt-1 text-xs text-ink-500 line-clamp-1">{{ $img->caption ?? $img->alt_text }}</p>
                            @endif
                        </div>
                    </button>
                @endforeach
            </div>
        </div>
    </section>
@endif

<x-lightbox />

<x-quote-form source="services-index" />

@endsection