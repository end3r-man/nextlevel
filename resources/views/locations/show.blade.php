@extends('layouts.app')

@php
    $site = config('site');
    $city = $location->name;
@endphp

@push('meta')
    <x-seo :title="$title" :description="$description" :image="$location->image" :canonical="route('locations.show', $location)" :schema="$schema" />
@endpush

@section('content')

    <x-page-hero eyebrow="Local service" title="Packers and Movers in {{ $city }}" :subtitle="$location->excerpt" :image="$location->image"
        :breadcrumbs="$crumbs">
        <div class="mt-8 flex flex-col gap-3 sm:flex-row sm:items-center">
            <a href="{{ route('contact') }}#get-a-quote" class="btn-accent">
                Get a free quote in {{ $city }}
                <x-icon name="arrow-right" class="w-4 h-4" />
            </a>
            <a href="tel:{{ $site['phone_e164'] }}" class="btn-ghost-light">
                <x-icon name="phone" class="w-4 h-4" />
                {{ $site['phone_display'] }}
            </a>
        </div>
    </x-page-hero>

    {{-- ============================== LOCAL OVERVIEW ============================== --}}
    <section class="section">
        <div class="container-page">
            <div class="grid gap-12 lg:grid-cols-12 lg:gap-16">

                <div class="lg:col-span-7">
                    <p class="eyebrow mb-3">
                        <x-icon name="pin" class="w-4 h-4" />
                        {{ $city }}, {{ $location->state }}
                    </p>

                    <h2 class="text-2xl font-bold sm:text-3xl">
                        Moving in and out of {{ $city }} with a crew that is already here
                    </h2>

                    @if ($location->description)
                        <div class="prose-nlp mt-6 space-y-4 text-base leading-relaxed text-ink-600">
                            @if (str_contains($location->description, '<p>') || str_contains($location->description, '<div>'))
                                {!! $location->description !!}
                            @else
                                {!! nl2br(e($location->description)) !!}
                            @endif
                        </div>
                    @endif

                    <div class="mt-9 grid gap-4 sm:grid-cols-3">
                        @foreach ([['truck', 'Move booked', 'Packed, loaded and delivered by our own employees'], ['shield', 'Insured', 'Transit cover included on every job, settled on the job sheet'], ['clock', 'Same day', 'Call before 11 AM for a same-day move in {city}']] as [$icon, $label, $note])
                            <div class="rounded-2xl bg-ink-50 p-5">
                                <x-icon :name="$icon" class="w-6 h-6 text-brand-700" />
                                <p class="mt-3 text-sm font-bold text-ink-900">{{ $label }}</p>
                                <p class="mt-1.5 text-xs leading-relaxed text-ink-600">
                                    {{ str_replace('{city}', $city, $note) }}</p>
                            </div>
                        @endforeach
                    </div>

                    @if ($location->localities)
                        <h3 class="mt-12 text-xl">Areas of {{ $city }} we cover</h3>
                        <p class="mt-3 text-sm leading-relaxed text-ink-600">
                            If your street is not on this list, ask us anyway. We will tell you straight away
                            whether we can reach you properly on the day.
                        </p>
                        <ul class="mt-5 flex flex-wrap gap-2">
                            @foreach ($location->localities as $locality)
                                <li class="chip">
                                    <x-icon name="pin" class="w-3.5 h-3.5 text-accent-500" />
                                    {{ $locality }}
                                </li>
                            @endforeach
                        </ul>
                    @endif

                    @if ($location->popular_routes)
                        <h3 class="mt-12 text-xl">Routes we run from {{ $city }}</h3>
                        <ul class="mt-5 grid gap-3 sm:grid-cols-2">
                            @foreach ($location->popular_routes as $route)
                                <li
                                    class="flex items-center gap-3 rounded-xl border border-ink-200 px-4 py-3.5 text-sm text-ink-700">
                                    <x-icon name="route" class="w-4 h-4 shrink-0 text-accent-500" />
                                    {{ $route }}
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>

                <aside class="lg:col-span-5">
                    <div class="space-y-6 lg:sticky lg:top-28">
                        <div class="card p-7">
                            <h2 class="text-lg">Services in {{ $city }}</h2>
                            <p class="mt-2 text-sm text-ink-600">
                                Tap a service for {{ $city }}-specific pricing and coverage.
                            </p>

                            <ul class="mt-5 space-y-2">
                                @foreach ($services as $service)
                                    <li>
                                        <a href="{{ route('services.location', [$location, $service]) }}"
                                            class="group flex items-center gap-3 rounded-xl border border-ink-200 px-4 py-3 transition hover:border-brand-400 hover:bg-brand-50">
                                            <span
                                                class="inline-flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-ink-50 text-brand-700 transition group-hover:bg-white">
                                                <x-icon :name="$service->icon" class="w-4 h-4" />
                                            </span>
                                            <span
                                                class="min-w-0 flex-1 truncate text-sm font-medium text-ink-800 group-hover:text-brand-800">
                                                {{ $service->name }}
                                            </span>
                                            <x-icon name="arrow-right"
                                                class="w-4 h-4 shrink-0 text-accent-500 transition group-hover:translate-x-0.5" />
                                        </a>
                                    </li>
                                @endforeach
                            </ul>

                            <a href="{{ route('contact') }}#get-a-quote" class="btn-accent mt-6 w-full">
                                Get a free quote
                                <x-icon name="arrow-right" class="w-4 h-4" />
                            </a>
                        </div>

                        @if ($nearby->isNotEmpty())
                            <div class="card p-7">
                                <h2 class="text-base">We also cover nearby</h2>
                                <ul class="mt-4 flex flex-wrap gap-2">
                                    @foreach ($nearby as $other)
                                        <li>
                                            <a href="{{ route('locations.show', $other) }}" class="chip">
                                                <x-icon name="pin" class="w-3.5 h-3.5 text-accent-500" />
                                                {{ $other->name }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                </aside>
            </div>
        </div>
    </section>

    {{-- ============================== LOCAL REVIEWS ============================== --}}
    @if ($testimonials->isNotEmpty())
        <section class="section bg-ink-50">
            <div class="container-page">
                <x-section-heading eyebrow="Local reviews" title="Moves we have completed in {{ $city }}" />

                <div class="mt-12 grid gap-6 md:grid-cols-3">
                    @foreach ($testimonials as $t)
                        <figure class="card flex flex-col p-7" data-reveal>
                            <div class="flex gap-0.5 text-accent-500" aria-label="{{ $t->rating }} out of 5 stars">
                                @for ($i = 0; $i < $t->rating; $i++)
                                    <x-icon name="star" class="w-4 h-4" />
                                @endfor
                            </div>
                            <blockquote class="mt-4 flex-1 text-sm leading-relaxed text-ink-700">{{ $t->quote }}
                            </blockquote>
                            <figcaption class="mt-6 border-t border-ink-100 pt-5">
                                <p class="font-bold text-ink-900">{{ $t->name }}</p>
                                <p class="text-xs text-ink-500">
                                    {{ $t->designation }}{{ $t->location ? ' · ' . $t->location : '' }}</p>
                            </figcaption>
                        </figure>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <x-quote-form :source="'location: ' . $location->slug" :heading="'Get a moving quote in ' . $city" :lead="'Tell us where you are moving in ' .
        $city .
        ' and where to. We reply with a firm written price the same day.'" />

@endsection
