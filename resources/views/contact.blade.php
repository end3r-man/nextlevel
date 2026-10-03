@extends('layouts.app')

@php
    $site = config('site');
    $mapQuery = urlencode($site['address']['street'].', '.$site['address']['locality'].', '.$site['address']['city']);
@endphp

@push('meta')
    <x-seo :title="$title" :description="$description" image="images/og-default.png"
           :canonical="route('contact')" :schema="$schema" />
@endpush

@section('content')

<x-page-hero
    eyebrow="Contact us"
    title="Talk to a real person, not a form queue"
    subtitle="Call the office, message us on WhatsApp, or send the form below. Enquiries answered between 6 AM and 10 PM, every day."
    image="images/og-default.png"
    :breadcrumbs="$crumbs"
/>

{{-- ============================== CONTACT METHODS ============================== --}}
<section class="section">
    <div class="container-page">
        <div class="grid gap-6 md:grid-cols-3">
            <a href="tel:{{ $site['phone_e164'] }}" class="card-hover group p-7" data-reveal>
                <span class="inline-flex h-12 w-12 items-center justify-center rounded-xl bg-brand-50 text-brand-700 transition group-hover:bg-brand-700 group-hover:text-white">
                    <x-icon name="phone" class="w-6 h-6" />
                </span>
                <h2 class="mt-5 text-lg">Call the office</h2>
                <p class="mt-2 text-sm leading-relaxed text-ink-600">
                    Fastest way to get a price. Someone in our Erode office picks up and can quote on the
                    call if you have your two addresses to hand.
                </p>
                <span class="mt-4 inline-flex items-center gap-2 font-bold text-brand-700">
                    {{ $site['phone_display'] }}
                    <x-icon name="arrow-right" class="w-4 h-4 transition group-hover:translate-x-1" />
                </span>
            </a>

            <a href="{{ $site['whatsapp_url'] }}" target="_blank" rel="noopener" class="card-hover group p-7" data-reveal="1">
                <span class="inline-flex h-12 w-12 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600 transition group-hover:bg-emerald-600 group-hover:text-white">
                    <x-icon name="whatsapp" class="w-6 h-6" />
                </span>
                <h2 class="mt-5 text-lg">WhatsApp us</h2>
                <p class="mt-2 text-sm leading-relaxed text-ink-600">
                    Send photos of your goods, your floor number and the lift situation. We reply with an
                    estimate, then a written quote once we know the volume.
                </p>
                <span class="mt-4 inline-flex items-center gap-2 font-bold text-emerald-600">
                    Open WhatsApp
                    <x-icon name="external" class="w-4 h-4 transition group-hover:translate-x-1" />
                </span>
            </a>

            <a href="mailto:{{ $site['email'] }}" class="card-hover group p-7" data-reveal="2">
                <span class="inline-flex h-12 w-12 items-center justify-center rounded-xl bg-accent-50 text-accent-600 transition group-hover:bg-accent-500 group-hover:text-white">
                    <x-icon name="mail" class="w-6 h-6" />
                </span>
                <h2 class="mt-5 text-lg">Email us</h2>
                <p class="mt-2 text-sm leading-relaxed text-ink-600">
                    Best for corporate relocations, tender documents and anything where you want a written
                    record of the conversation.
                </p>
                <span class="mt-4 inline-block break-all font-bold text-brand-700">
                    {{ $site['email'] }}
                </span>
            </a>
        </div>
    </div>
</section>

{{-- ============================== NAP + HOURS + MAP ============================== --}}
<section class="section bg-ink-50">
    <div class="container-page">
        <div class="grid gap-10 lg:grid-cols-12 lg:gap-12">

            <div class="lg:col-span-5">
                <h2 class="text-2xl font-bold sm:text-3xl">Where to find us</h2>

                <div class="card mt-7 p-7">
                    <h3 class="flex items-center gap-3 text-base">
                        <span class="inline-flex h-10 w-10 items-center justify-center rounded-lg bg-brand-50 text-brand-700">
                            <x-icon name="pin" class="w-5 h-5" />
                        </span>
                        Office address
                    </h3>

                    <address class="mt-4 text-sm leading-relaxed text-ink-600 not-italic">
                        <strong class="block text-ink-900">{{ $site['name'] }}</strong>
                        {{ $site['address']['street'] }}<br>
                        {{ $site['address']['locality'] }},<br>
                        {{ $site['address']['city'] }} {{ $site['address']['postal_code'] }}<br>
                        {{ $site['address']['region'] }}, {{ $site['address']['country'] }}
                    </address>

                    <a href="https://www.google.com/maps/search/?api=1&query={{ $mapQuery }}"
                       target="_blank" rel="noopener"
                       class="mt-5 inline-flex items-center gap-2 text-sm font-semibold text-brand-700">
                        Get directions
                        <x-icon name="external" class="w-4 h-4" />
                    </a>
                </div>

                <div class="card mt-6 p-7">
                    <h3 class="flex items-center gap-3 text-base">
                        <span class="inline-flex h-10 w-10 items-center justify-center rounded-lg bg-brand-50 text-brand-700">
                            <x-icon name="clock" class="w-5 h-5" />
                        </span>
                        Opening hours
                    </h3>

                    <dl class="mt-5 space-y-2.5 text-sm">
                        @foreach ($site['hours'] as $day)
                            <div class="flex items-center justify-between gap-4">
                                <dt class="text-ink-600">{{ $day['day'] }}</dt>
                                <dd class="font-semibold text-ink-900 tabular-nums">
                                    {{ \Illuminate\Support\Carbon::createFromFormat('H:i', $day['opens'])->format('g:i A') }} –
                                    {{ \Illuminate\Support\Carbon::createFromFormat('H:i', $day['closes'])->format('g:i A') }}
                                </dd>
                            </div>
                        @endforeach
                    </dl>

                    <p class="mt-5 rounded-lg bg-ink-50 px-4 py-3 text-xs leading-relaxed text-ink-600">
                        Moving day bookings need at least 24 hours notice. Same-day moves are possible in
                        Erode, Tiruppur and Coimbatore if you call before 11 AM and the volume is small.
                    </p>
                </div>
            </div>

            <div class="lg:col-span-7">
                {{-- No third-party map embed: it would cost ~900 KB, set cookies
                     before consent and tank the Core Web Vitals we are chasing.
                     Instead we hand off to Google Maps on click and keep a fast,
                     server-rendered coverage panel on the page. --}}
                <div class="card relative overflow-hidden p-2">
                    <div class="relative overflow-hidden rounded-2xl bg-ink-950 p-8 sm:p-10">
                        <img src="{{ asset('images/stat-bg.webp') }}" alt="" aria-hidden="true"
                             width="1600" height="183" loading="lazy" decoding="async"
                             class="absolute inset-x-0 top-0 w-full opacity-25">

                        <div class="relative">
                            <p class="eyebrow-light mb-3">
                                <x-icon name="pin" class="w-4 h-4" />
                                Find our office
                            </p>
                            <h3 class="text-xl text-white sm:text-2xl">{{ $site['address']['locality'] }}, {{ $site['address']['city'] }}</h3>
                            <p class="mt-3 max-w-md text-sm leading-relaxed text-ink-300">
                                We are on {{ $site['address']['street'] }}, a few minutes from
                                {{ $site['address']['city'] }} central. The warehouse and loading bay are
                                at the same site, so you are welcome to visit and see the vehicles before
                                you book anything.
                            </p>

                            <dl class="mt-8 grid gap-5 sm:grid-cols-3">
                                @foreach ([
                                    ['phone', 'Phone', $site['phone_display']],
                                    ['mail', 'Email', $site['email']],
                                    ['clock', 'Open today', \Illuminate\Support\Carbon::createFromFormat('H:i', collect($site['hours'])->firstWhere('day', now()->format('l'))['opens'])->format('g:i A').' – '.\Illuminate\Support\Carbon::createFromFormat('H:i', collect($site['hours'])->firstWhere('day', now()->format('l'))['closes'])->format('g:i A')],
                                ] as [$icon, $label, $value])
                                    <div class="rounded-xl bg-white/5 p-4">
                                        <dt class="flex items-center gap-2 text-xs font-semibold tracking-wide text-ink-400 uppercase">
                                            <x-icon :name="$icon" class="w-3.5 h-3.5" />
                                            {{ $label }}
                                        </dt>
                                        <dd class="mt-1.5 text-sm font-bold break-words text-white">{{ $value }}</dd>
                                    </div>
                                @endforeach
                            </dl>

                            <a href="https://www.google.com/maps/search/?api=1&query={{ $mapQuery }}"
                               target="_blank" rel="noopener" class="btn-accent mt-8">
                                Open in Google Maps
                                <x-icon name="external" class="w-4 h-4" />
                            </a>
                        </div>
                    </div>
                </div>

                {{-- Service coverage, internal links. --}}
                <div class="card mt-6 p-7">
                    <h3 class="flex items-center gap-3 text-base">
                        <span class="inline-flex h-10 w-10 items-center justify-center rounded-lg bg-accent-50 text-accent-600">
                            <x-icon name="truck" class="w-5 h-5" />
                        </span>
                        Areas we cover
                    </h3>
                    <p class="mt-3 text-sm leading-relaxed text-ink-600">
                        Our crews are based in Erode and work out of {{ implode(', ', $site['target_locations']) }}
                        daily. Pick a city for local rates, or send us an enquiry and we will tell you
                        plainly if we are the right fit for your route.
                    </p>

                    <ul class="mt-5 flex flex-wrap gap-2">
                        @foreach ($site['target_locations'] as $city)
                            @continue(\Illuminate\Support\Str::lower($city) === 'erode')
                            <li>
                                <a href="{{ route('locations.index') }}" class="chip">{{ $city }}</a>
                            </li>
                        @endforeach
                        <li><a href="{{ route('locations.index') }}" class="chip">All 25 locations</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ============================== QUOTE FORM ============================== --}}
<x-quote-form source="contact" heading="Request your free written quote"
              lead="Fill this in and we will call you back, usually within the hour during working time. Every field marked with a line is required." />

@endsection