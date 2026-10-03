@extends('layouts.app')

@push('meta')
    <x-seo :title="$title" :description="$description" image="images/og-default.png"
           :canonical="route('locations.index')" :schema="$schema" />
@endpush

@section('content')

<x-page-hero
    eyebrow="Locations"
    title="Packers and movers across {{ count($locations) }} cities"
    subtitle="Our crews are based in Erode and run daily routes through Erode, Tiruppur and Coimbatore, with scheduled moves across the rest of Tamil Nadu and into Karnataka."
    image="images/about-bg.webp"
    :breadcrumbs="$crumbs"
/>

{{-- ============================== PRIMARY CITIES ============================== --}}
@if ($primary->isNotEmpty())
    <section class="section">
        <div class="container-page">
            <x-section-heading
                eyebrow="Primary service cities"
                title="Where our crews are based every day"
                lead="These three cities have dedicated crews and stored vehicles, so a booking here is served by people who know the streets rather than a network that might not answer."
            />

            <div class="mt-14 grid gap-6 lg:grid-cols-3">
                @foreach ($primary as $loc)
                    <a href="{{ route('locations.show', $loc) }}" class="card-hover group flex flex-col p-7" data-reveal>
                        <span class="inline-flex h-13 w-13 items-center justify-center rounded-xl bg-brand-50 p-3.5 text-brand-700 transition group-hover:bg-brand-700 group-hover:text-white">
                            <x-icon name="pin" class="w-6 h-6" />
                        </span>

                        <h2 class="mt-5 text-xl">Packers and Movers in {{ $loc->name }}</h2>
                        <p class="mt-3 flex-1 text-sm leading-relaxed text-ink-600">{{ $loc->excerpt }}</p>

                        @if ($loc->localities)
                            <p class="mt-4 text-xs text-ink-500">
                                Covering {{ implode(', ', array_slice($loc->localities, 0, 5)) }}@if (count($loc->localities) > 5)
                                    and {{ count($loc->localities) - 5 }} more
                                @endif
                            </p>
                        @endif

                        <span class="mt-5 inline-flex items-center gap-2 text-sm font-semibold text-brand-700">
                            Services &amp; rates in {{ $loc->name }}
                            <x-icon name="arrow-right" class="w-4 h-4 transition group-hover:translate-x-1" />
                        </span>
                    </a>
                @endforeach
            </div>
        </div>
    </section>
@endif

{{-- ============================== SECONDARY CITIES ============================== --}}
@if ($secondary->isNotEmpty())
    <section class="section bg-ink-50">
        <div class="container-page">
            <x-section-heading
                eyebrow="Regional coverage"
                title="Scheduled moves across Tamil Nadu"
                align="left"
            />

            <div class="mt-12 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($secondary as $loc)
                    <a href="{{ route('locations.show', $loc) }}" class="card-hover group p-6" data-reveal>
                        <div class="flex items-start justify-between gap-3">
                            <div>
                                <h3 class="text-base">Packers and Movers in {{ $loc->name }}</h3>
                                <p class="mt-1 text-xs text-ink-500">{{ $loc->state }}</p>
                            </div>
                            <x-icon name="arrow-right" class="mt-1 w-4 h-4 shrink-0 text-accent-500 transition group-hover:translate-x-1" />
                        </div>
                        <p class="mt-3 line-clamp-2 text-sm leading-relaxed text-ink-600">{{ $loc->excerpt }}</p>
                    </a>
                @endforeach
            </div>
        </div>
    </section>
@endif

{{-- ============================== ALL CITIES INDEX ============================== --}}
<section class="section">
    <div class="container-page">
        <x-section-heading
            eyebrow="Full list"
            title="All cities and towns we serve"
            lead="Every city has its own page with local rates, coverage areas and the services available there."
        />

        <div class="mt-12 rounded-2xl border border-ink-200 bg-white p-7 sm:p-9">
            <ul class="grid gap-2.5 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($locations as $loc)
                    <li>
                        <a href="{{ route('locations.show', $loc) }}"
                           class="group flex items-center justify-between gap-3 rounded-xl border border-ink-200 px-4 py-3 text-sm transition hover:border-brand-400 hover:bg-brand-50">
                            <span class="flex min-w-0 items-center gap-2.5">
                                <x-icon name="pin" class="w-4 h-4 shrink-0 text-accent-500" />
                                <span class="truncate font-medium text-ink-800 group-hover:text-brand-800">
                                    Packers and Movers in {{ $loc->name }}
                                </span>
                            </span>
                            <x-icon name="arrow-right" class="w-4 h-4 shrink-0 text-ink-500 transition group-hover:translate-x-0.5 group-hover:text-brand-600" />
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</section>

{{-- ============================== SERVICES x CITIES ============================== --}}
<section class="section bg-ink-50">
    <div class="container-page">
        <x-section-heading
            eyebrow="Service directories"
            title="Find movers by service"
            lead="Jump straight to the service you need in the city you are moving to."
        />

        <div class="mt-12 space-y-8">
            @foreach ($services as $service)
                <div>
                    <h3 class="flex items-center gap-3 text-base">
                        <span class="inline-flex h-9 w-9 items-center justify-center rounded-lg bg-brand-50 text-brand-700">
                            <x-icon :name="$service->icon" class="w-5 h-5" />
                        </span>
                        {{ $service->name }}
                    </h3>

                    <ul class="mt-4 flex flex-wrap gap-2">
                        @foreach ($primary as $loc)
                            <li>
                                <a href="{{ route('services.location', [$loc, $service]) }}" class="chip">
                                    {{ $service->name }} in {{ $loc->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endforeach
        </div>
    </div>
</section>

@if ($localities->isNotEmpty())
    <section class="section">
        <div class="container-page">
            <x-section-heading eyebrow="Neighbourhoods" title="Popular localities we work in" align="left" />

            <ul class="mt-10 flex flex-wrap gap-2.5">
                @foreach ($localities as $loc)
                    <li><a href="{{ route('locations.show', $loc) }}" class="chip">{{ $loc->name }}</a></li>
                @endforeach
            </ul>
        </div>
    </section>
@endif

<x-quote-form source="locations-index" />

@endsection