@extends('layouts.app')

@php
    $site = config('site');
@endphp

@push('meta')
    <x-seo :title="$title" :description="$description" :image="$service->image"
           :canonical="route('services.show', $service)" :schema="$schema" />
@endpush

@section('content')

<x-page-hero
    eyebrow="Service"
    :title="$service->name"
    :subtitle="$service->excerpt"
    :image="$service->image"
    :breadcrumbs="$crumbs"
>
    <div class="mt-8 flex flex-col gap-3 sm:flex-row sm:items-center">
        <a href="{{ route('contact') }}#get-a-quote" class="btn-accent">
            Get a free quote for {{ strtolower($service->name) }}
            <x-icon name="arrow-right" class="w-4 h-4" />
        </a>
        <a href="tel:{{ $site['phone_e164'] }}" class="btn-ghost-light">
            <x-icon name="phone" class="w-4 h-4" />
            {{ $site['phone_display'] }}
        </a>
    </div>
</x-page-hero>

{{-- ============================== OVERVIEW ============================== --}}
<section class="section">
    <div class="container-page">
        <div class="grid gap-12 lg:grid-cols-12 lg:gap-16">

            <div class="lg:col-span-7">
                <p class="eyebrow mb-3">
                    <x-icon :name="$service->icon" class="w-4 h-4" />
                    {{ $service->name }} in {{ implode(', ', $site['target_locations']) }}
                </p>

                <h2 class="text-2xl font-bold sm:text-3xl">What {{ strtolower($service->name) }} involves</h2>

                {{-- Service descriptions are plain paragraphs written to read
                     naturally. nl2br keeps the seeded line breaks without
                     allowing any HTML through from user-editable content. --}}
                <div class="mt-6 space-y-5 text-base leading-relaxed text-ink-600">
                    {!! nl2br(e($service->description)) !!}
                </div>

                @if ($service->includes)
                    <h3 class="mt-10 text-xl">What is included as standard</h3>
                    <ul class="mt-5 grid gap-3 sm:grid-cols-2">
                        @foreach ($service->includes as $item)
                            <li class="flex items-start gap-3 rounded-xl bg-ink-50 p-4">
                                <x-icon name="check-circle" class="mt-0.5 w-5 h-5 shrink-0 text-emerald-500" />
                                <span class="text-sm text-ink-700">{{ $item }}</span>
                            </li>
                        @endforeach
                    </ul>
                @endif

                @if ($service->benefits)
                    <h3 class="mt-10 text-xl">Why customers choose us for this</h3>
                    <div class="mt-5 grid gap-4 sm:grid-cols-2">
                        @foreach ($service->benefits as $benefit)
                            <div class="card p-5">
                                <x-icon name="check" class="w-5 h-5 text-accent-500" />
                                <p class="mt-2.5 text-sm leading-relaxed text-ink-700">{{ $benefit }}</p>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            {{-- Sidebar: local availability is the commercial point of this
                 page. 300 combo pages exist to serve exactly this block. --}}
            <aside class="lg:col-span-5">
                <div class="lg:sticky lg:top-28 space-y-6">
                    <div class="card overflow-hidden p-7">
                        <h2 class="text-lg">Get this service in your city</h2>
                        <p class="mt-2 text-sm text-ink-600">
                            Local crews, local rates, and a written quote the same day.
                        </p>

                        <ul class="mt-5 space-y-2">
                            @foreach ($targetLocations as $loc)
                                <li>
                                    <a href="{{ route('services.location', [$loc, $service]) }}"
                                       class="flex items-center justify-between gap-3 rounded-xl border border-ink-200 px-4 py-3 text-sm font-medium text-ink-700 transition hover:border-brand-400 hover:bg-brand-50 hover:text-brand-800">
                                        {{ $service->name }} in {{ $loc->name }}
                                        <x-icon name="arrow-right" class="w-4 h-4 shrink-0 text-accent-500" />
                                    </a>
                                </li>
                            @endforeach
                        </ul>

                        <a href="{{ route('contact') }}#get-a-quote" class="btn-accent mt-6 w-full">
                            Request a quote
                            <x-icon name="arrow-right" class="w-4 h-4" />
                        </a>
                    </div>

                    @if ($locations->isNotEmpty())
                        <div class="card p-7">
                            <h2 class="text-base">We also cover</h2>
                            <ul class="mt-4 flex flex-wrap gap-2">
                                @foreach ($locations as $loc)
                                    <li>
                                        <a href="{{ route('locations.show', $loc) }}" class="chip">{{ $loc->name }}</a>
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

{{-- ============================== FAQ ============================== --}}
@if ($service->faqs)
    <section class="section bg-ink-50">
        <div class="container-page">
            <div class="grid gap-12 lg:grid-cols-12 lg:gap-16">
                <div class="lg:col-span-4">
                    <p class="eyebrow mb-3">
                        <x-icon name="info" class="w-4 h-4" />
                        FAQ
                    </p>
                    <h2 class="text-2xl font-bold sm:text-3xl">{{ $service->name }} questions</h2>
                    <p class="mt-4 text-sm leading-relaxed text-ink-600">
                        The things customers ask before booking {{ strtolower($service->name) }}.
                    </p>
                </div>

                <div class="lg:col-span-8" data-accordion="single">
                    @foreach ($service->faqs as $faq)
                        <div class="border-b border-ink-200 last:border-0">
                            <h3>
                                <button type="button" data-accordion-trigger aria-expanded="false"
                                        class="flex w-full items-start justify-between gap-6 py-5 text-left">
                                    <span class="font-semibold text-ink-900">{{ $faq['question'] }}</span>
                                    <span class="inline-flex mt-0.5 h-8 w-8 shrink-0 items-center justify-center rounded-full bg-white text-brand-700 transition">
                                        <x-icon name="chevron-down" data-accordion-icon class="w-4 h-4" />
                                    </span>
                                </button>
                            </h3>
                            <div class="hidden pb-6">
                                <p class="text-sm leading-relaxed text-ink-600">{{ $faq['answer'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endif

{{-- ============================== REVIEWS FOR THIS SERVICE ============================== --}}
@if ($testimonials->isNotEmpty())
    <section class="section">
        <div class="container-page">
            <x-section-heading eyebrow="Reviews" title="What customers say about this service" align="left" />

            <div class="mt-12 grid gap-6 md:grid-cols-2 lg:grid-cols-3">
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

{{-- ============================== RELATED SERVICES ============================== --}}
<section class="section bg-ink-50">
    <div class="container-page">
        <x-section-heading eyebrow="Related" title="People also ask for" align="left" />

        <div class="mt-12 grid gap-5 sm:grid-cols-2 lg:grid-cols-4">
            @foreach ($related as $rel)
                <a href="{{ route('services.show', $rel) }}" class="card-hover group p-6" data-reveal>
                    <span class="inline-flex h-11 w-11 items-center justify-center rounded-xl bg-brand-50 text-brand-700">
                        <x-icon :name="$rel->icon" class="w-5 h-5" />
                    </span>
                    <h3 class="mt-4 text-base">{{ $rel->name }}</h3>
                    <p class="mt-2 line-clamp-2 text-xs leading-relaxed text-ink-600">{{ $rel->excerpt }}</p>
                    <span class="mt-4 inline-flex items-center gap-2 text-xs font-semibold text-brand-700">
                        Learn more
                        <x-icon name="arrow-right" class="w-3.5 h-3.5 transition group-hover:translate-x-1" />
                    </span>
                </a>
            @endforeach
        </div>
    </div>
</section>

<x-quote-form :source="'service: '.$service->slug"
              :heading="'Get a quote for '.strtolower($service->name)" />

@endsection