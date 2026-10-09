@extends('layouts.app')

@php
    $site = config('site');
    $city = $location->name;
    $lowerCity = strtolower($city);
@endphp

@push('meta')
    <x-seo :title="$title" :description="$description" :image="$service->image"
           :canonical="route('services.location', [$location, $service])" :schema="$schema" />
@endpush

@section('content')

<x-page-hero
    :eyebrow="$keyword"
    :title="$service->name.' in '.$city"
    :subtitle="\Illuminate\Support\Str::limit(strip_tags($service->description), 190)"
    :image="$service->image"
    :breadcrumbs="$crumbs"
>
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

{{-- ============================== WHY THIS PAGE IS DIFFERENT ============================== --}}
<section class="section">
    <div class="container-page">
        <div class="grid gap-12 lg:grid-cols-12 lg:gap-16">

            <div class="lg:col-span-7">
                <p class="eyebrow mb-3">
                    <x-icon :name="$service->icon" class="w-4 h-4" />
                    {{ $service->name }} in {{ $city }}
                </p>

                <h2 class="text-2xl font-bold sm:text-3xl">
                    {{ $service->name }} across {{ $city }}, handled by our own crew
                </h2>

                <div class="mt-6 space-y-5 text-base leading-relaxed text-ink-600">
                    <p>
                        We handle {{ strtolower($service->name) }} in {{ $city }} every week. Whether it is
                        a {{ $location->name }} household, a shop on the main road or an office moving
                        floors, the job is quoted, packed, loaded and delivered by the same team — our own
                        employees, not a broker forwarding your booking to whoever is free that morning.
                    </p>

                    <div class="prose-nlp">
                        {!! $service->description !!}
                    </div>
                </div>

                @if ($location->description)
                    <h3 class="mt-10 text-xl font-bold text-ink-900">Moving within {{ $city }} and around it</h3>
                    <div class="prose-nlp mt-4 space-y-4 text-base leading-relaxed text-ink-600">
                        @if (str_contains($location->description, '<p>') || str_contains($location->description, '<div>'))
                            {!! $location->description !!}
                        @else
                            {!! nl2br(e($location->description)) !!}
                        @endif
                    </div>
                @endif

                @if ($service->includes)
                    <h3 class="mt-10 text-xl">Included in every {{ strtolower($service->name) }} job in {{ $city }}</h3>
                    <ul class="mt-5 grid gap-3 sm:grid-cols-2">
                        @foreach ($service->includes as $item)
                            <li class="flex items-start gap-3 rounded-xl bg-ink-50 p-4">
                                <x-icon name="check-circle" class="mt-0.5 w-5 h-5 shrink-0 text-emerald-500" />
                                <span class="text-sm text-ink-700">{{ $item }}</span>
                            </li>
                        @endforeach
                    </ul>
                @endif

                @if ($location->localities)
                    <h3 class="mt-10 text-xl">Areas of {{ $city }} we cover</h3>
                    <p class="mt-3 text-sm leading-relaxed text-ink-600">
                        Our {{ strtolower($service->name) }} crews work across the whole of {{ $city }},
                        including:
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
            </div>

            {{-- Sidebar: quote CTA plus the internal-link grid that keeps
                 300 combo pages from becoming orphan pages. --}}
            <aside class="lg:col-span-5">
                <div class="space-y-6 lg:sticky lg:top-28">

                    <div class="card overflow-hidden p-7">
                        <h2 class="text-lg">How much for {{ $lowerCity }}?</h2>
                        <p class="mt-2 text-sm leading-relaxed text-ink-600">
                            We quote on the goods, the floor, lift access and distance — so the honest
                            answer is a number we give you in writing. Here is what shapes it:
                        </p>

                        <dl class="mt-5 space-y-3 text-sm">
                            @foreach ([
                                ['box-open', 'Volume of goods', 'A 1 BHK and a 3 BHK are not the same job. Send photos or a rough list.'],
                                ['building', 'Floors and lift', 'Third floor walk-up is priced differently from a lift apartment.'],
                                ['route', 'Distance', 'Within {city} is cheaper than {city} to the next town.'],
                                ['clock', 'Timing', 'Same-day bookings carry no premium if you call before 11 AM.'],
                            ] as [$icon, $label, $note])
                                <div class="flex gap-3">
                                    <x-icon :name="$icon" class="mt-0.5 w-4 h-4 shrink-0 text-brand-700" />
                                    <div>
                                        <dt class="font-semibold text-ink-800">{{ $label }}</dt>
                                        <dd class="text-ink-600">{{ str_replace('{city}', $city, $note) }}</dd>
                                    </div>
                                </div>
                            @endforeach
                        </dl>

                        <a href="{{ route('contact') }}#get-a-quote" class="btn-accent mt-7 w-full">
                            Get my written quote
                            <x-icon name="arrow-right" class="w-4 h-4" />
                        </a>
                        <p class="mt-3 text-center text-xs text-ink-500">
                            Or call {{ $site['phone_display'] }}
                        </p>
                    </div>

                    {{-- Same city, other services. --}}
                    <div class="card p-7">
                        <h2 class="text-base">Other services in {{ $city }}</h2>
                        <ul class="mt-4 space-y-1">
                            @foreach ($otherServices as $other)
                                <li>
                                    <a href="{{ route('services.location', [$location, $other]) }}"
                                       class="flex items-center justify-between gap-3 rounded-lg px-3 py-2 text-sm text-ink-600 transition hover:bg-ink-50 hover:text-brand-700">
                                        {{ $other->name }}
                                        <x-icon name="chevron-right" class="w-3.5 h-3.5 text-ink-400" />
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    {{-- Same service, other cities. --}}
                    <div class="card p-7">
                        <h2 class="text-base">{{ $service->name }} in other cities</h2>
                        <ul class="mt-4 flex flex-wrap gap-2">
                            @foreach ($otherLocations as $other)
                                <li>
                                    <a href="{{ route('services.location', [$other, $service]) }}" class="chip">
                                        {{ $other->name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </aside>
        </div>
    </div>
</section>

{{-- ============================== LOCAL REVIEWS ============================== --}}
@if ($testimonials->isNotEmpty())
    <section class="section bg-ink-50">
        <div class="container-page">
            <x-section-heading eyebrow="Local reviews" :title="'Customers who moved in '.$city" align="left" />

            <div class="mt-12 grid gap-6 md:grid-cols-2">
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

{{-- ============================== GALLERY / WORK IN ACTION ============================== --}}
@if (isset($galleryImages) && $galleryImages->isNotEmpty())
    <section class="section">
        <div class="container-page">
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
                <div>
                    <p class="eyebrow mb-2">
                        <x-icon name="image" class="w-4 h-4" />
                        Photos from the field
                    </p>
                    <h2 class="text-2xl font-bold sm:text-3xl">{{ $service->name }} in action</h2>
                    <p class="mt-2 text-sm text-ink-600 max-w-xl">
                        Real shifting and packing photos from our own crew handling {{ strtolower($service->name) }} jobs.
                    </p>
                </div>
                <a href="{{ route('gallery') }}" class="btn-outline shrink-0 text-xs">
                    View full gallery
                    <x-icon name="arrow-right" class="w-3.5 h-3.5" />
                </a>
            </div>

            <div class="mt-8 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
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
                        <div class="p-3.5">
                            <p class="font-bold text-xs text-ink-900 line-clamp-1">{{ $img->title }}</p>
                            @if ($img->caption || $img->alt_text)
                                <p class="mt-0.5 text-[11px] text-ink-500 line-clamp-1">{{ $img->caption ?? $img->alt_text }}</p>
                            @endif
                        </div>
                    </button>
                @endforeach
            </div>
        </div>
    </section>
@endif

{{-- ============================== ALL SERVICES IN THIS CITY ============================== --}}
<section class="section bg-ink-50">
    <div class="container-page">
        <x-section-heading :eyebrow="'In '.$city" title="Everything we do in this city" align="left" />

        <ul class="mt-10 grid gap-3 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($services as $svc)
                <li>
                    <a href="{{ route('services.location', [$location, $svc]) }}"
                       @class([
                           'group flex items-center gap-3 rounded-xl border px-4 py-3.5 text-sm font-medium transition',
                           'border-brand-400 bg-brand-50 text-brand-800' => $svc->id === $service->id,
                           'border-ink-200 text-ink-700 hover:border-brand-400 hover:bg-brand-50 hover:text-brand-800' => $svc->id !== $service->id,
                       ])>
                        <span class="inline-flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-white text-brand-700">
                            <x-icon :name="$svc->icon" class="w-4 h-4" />
                        </span>
                        {{ $svc->name }}
                        @if ($svc->id === $service->id)
                            <span class="ml-auto text-xs font-bold text-accent-600">Current page</span>
                        @endif
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</section>

<x-lightbox />

<x-quote-form :source="$service->slug.' in '.$location->slug"
              :heading="'Book '.$service->name.' in '.$city"
              :lead="'Tell us the two addresses in '.$city.' and your goods list. We reply with a firm written price the same day, and that price does not change on the day.'"/>

@endsection