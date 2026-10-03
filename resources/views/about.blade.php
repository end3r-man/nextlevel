@extends('layouts.app')

@push('meta')
    <x-seo :title="$title" :description="$description" image="images/about-bg.webp"
           :canonical="route('about')" :schema="$schema" />
@endpush

@section('content')

<x-page-hero
    eyebrow="About us"
    title="A packers and movers company built on doing what we said"
    subtitle="We have been moving households and businesses across Tamil Nadu since {{ config('site')['founded_year'] }}. No broker chains, no surprise charges on delivery day."
    image="images/about-bg.webp"
    :breadcrumbs="$crumbs"
/>

{{-- ============================== STORY ============================== --}}
<section class="section">
    <div class="container-page">
        <div class="grid gap-12 lg:grid-cols-12 lg:gap-16">
            <div class="lg:col-span-7">
                <p class="eyebrow mb-3">
                    <x-icon name="book" class="w-4 h-4" />
                    Our story
                </p>
                <h2 class="text-2xl font-bold sm:text-3xl">How Next Level started</h2>

                <div class="prose-nlp mt-6 space-y-5 text-base leading-relaxed text-ink-600">
                    <p>
                        Next Level Packers and Movers began in {{ config('site')['founded_year'] }} with one
                        truck and a simple observation: most people in Erode were not unhappy about moving,
                        they were anxious about being let down. Prices changed after the goods were loaded.
                        Nobody answered the phone on delivery day. Damage was denied because there was no
                        proper job sheet.
                    </p>
                    <p>
                        So we built the company around the opposite of that. One vehicle per household,
                        written quotes that hold, crews we employ ourselves, and a job sheet signed at both
                        ends. It is a slower way to run a moving business than bidding for jobs at 2 AM
                        with a rate you cannot honour. It is also why
                        {{ number_format($stats['moves']) }}+ households and businesses have handed us their
                        belongings since.
                    </p>
                    <p>
                        Today we operate from {{ config('site')['address']['street'] }},
                        {{ config('site')['address']['locality'] }}, Erode, with dedicated crews serving Erode,
                        Tiruppur and Coimbatore and
                        scheduled runs across Tamil Nadu and into Karnataka. We still do the unglamorous
                        parts ourselves — the packing, the loading, the reassembly and the cleanup — because
                        that is where a move is actually won or lost.
                    </p>
                </div>
            </div>

            <aside class="lg:col-span-5">
                <div class="card p-7 sm:p-8 lg:sticky lg:top-28">
                    <h2 class="text-lg">Facts about us</h2>

                    <dl class="mt-6 space-y-5">
                        @foreach ([
                            ['calendar', 'Established', config('site')['founded_year'].' · '.($stats['years']+1).' years trading'],
                            ['users', 'Crews on payroll', $stats['crew'].' trained movers, no daily-wage sub-contracting'],
                            ['truck', 'Moves completed', number_format($stats['moves']).' house and office relocations'],
                            ['pin', 'Cities covered', $stats['cities'].' towns across Tamil Nadu and Karnataka'],
                            ['warehouse', 'Storage', 'Covered warehouse in Erode for short and long-term storage'],
                            ['star', 'Google rating', $stats['rating'].' out of 5 from '.number_format($stats['reviews']).' reviews'],
                        ] as [$icon, $label, $value])
                            <div class="flex gap-4">
                                <span class="inline-flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-brand-50 text-brand-700">
                                    <x-icon :name="$icon" class="w-5 h-5" />
                                </span>
                                <div class="min-w-0">
                                    <dt class="text-sm font-bold text-ink-900">{{ $label }}</dt>
                                    <dd class="mt-0.5 text-sm text-ink-600">{{ $value }}</dd>
                                </div>
                            </div>
                        @endforeach
                    </dl>
                </div>
            </aside>
        </div>
    </div>
</section>

{{-- ============================== VALUES ============================== --}}
<section class="section bg-ink-50">
    <div class="container-page">
        <x-section-heading
            eyebrow="What we stand for"
            title="Mission, vision and the values behind the quotes"
            align="left"
        />

        <div class="mt-12 grid gap-6 md:grid-cols-3">
            @foreach ([
                ['clipboard', 'Our mission', 'To provide seamless relocation experiences through professional handling, secure packing, timely delivery and customer-focused service — so that every move is efficient, careful and genuinely stress-free.'],
                ['star', 'Our vision', 'To become the most trusted moving company across Tamil Nadu: the first name people reach when a family is moving, and the one businesses re-book without being asked.'],
                ['handshake', 'Our values', 'Integrity, reliability and transparency. We tell you the real cost up front, we turn up when we said we would, and we settle damage from the same job sheet instead of making you chase it.'],
            ] as [$icon, $heading, $body])
                <div class="card p-8" data-reveal>
                    <span class="inline-flex h-12 w-12 items-center justify-center rounded-xl bg-accent-50 text-accent-600">
                        <x-icon :name="$icon" class="w-6 h-6" />
                    </span>
                    <h3 class="mt-5 text-xl">{{ $heading }}</h3>
                    <p class="mt-3 text-sm leading-relaxed text-ink-600">{{ $body }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ============================== TEAM / PROMISE ============================== --}}
<section class="section">
    <div class="container-page">
        <div class="grid items-center gap-12 lg:grid-cols-2 lg:gap-16">
            <div data-reveal>
                <p class="eyebrow mb-3">
                    <x-icon name="shield" class="w-4 h-4" />
                    Our promise to you
                </p>
                <h2 class="text-2xl font-bold sm:text-3xl lg:leading-[1.12]">
                    The four things we will always do
                </h2>
                <p class="mt-5 text-base leading-relaxed text-ink-600">
                    If we ever break one of these, tell us and we will put it right. That is the whole
                    business model.
                </p>

                <ol class="mt-9 space-y-6">
                    @foreach ([
                        ['Give you one written price and keep it', 'No fuel surcharge at the end, no toll charge added on arrival, no "extra handling". If the scope genuinely changes we stop and get your agreement in writing before continuing.'],
                        ['Send our own employees', 'The crew loading your furniture are on our payroll and trained by us. We do not auction your job to the cheapest driver available that morning.'],
                        ['Use one vehicle for one household', 'Your goods never travel mixed with another family\'s. Shared cargo is the number one cause of damage on moving day.'],
                        ['Answer the phone ourselves', 'One office, in Erode, staffed by people who can open your booking and see what was agreed. If we miss you, we call back the same day.'],
                    ] as $i => [$heading, $body])
                        <li class="flex gap-5">
                            <span class="inline-flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-brand-700 font-bold text-white">
                                {{ $i + 1 }}
                            </span>
                            <div>
                                <h3 class="text-base font-bold text-ink-900">{{ $heading }}</h3>
                                <p class="mt-1.5 text-sm leading-relaxed text-ink-600">{{ $body }}</p>
                            </div>
                        </li>
                    @endforeach
                </ol>
            </div>

            <div class="relative" data-reveal="1">
                <div class="overflow-hidden rounded-3xl">
                    <img src="{{ asset('images/g1.webp') }}"
                         alt="Packing crew loading a closed container truck for a house shifting job in Erode"
                         width="720" height="900" loading="lazy" decoding="async"
                         class="h-full w-full object-cover">
                </div>

                <div class="absolute -bottom-6 left-4 rounded-2xl bg-white p-6 shadow-lift sm:left-8">
                    <div class="flex items-center gap-1 text-accent-500" aria-label="Rated {{ $stats['rating'] }} out of 5">
                        @for ($i = 0; $i < 5; $i++)
                            <x-icon name="star" class="w-5 h-5" />
                        @endfor
                    </div>
                    <p class="mt-2 text-3xl font-bold text-ink-950">{{ $stats['rating'] }}<span class="text-base font-medium text-ink-500">/5</span></p>
                    <p class="mt-1 text-sm text-ink-500">{{ number_format($stats['reviews']) }} Google reviews</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ============================== SERVICES STRIP ============================== --}}
<section class="section bg-ink-950">
    <div class="container-page">
        <div class="max-w-3xl">
            <p class="eyebrow-light mb-3">
                <x-icon name="truck" class="w-4 h-4" />
                What we do
            </p>
            <h2 class="text-2xl font-bold text-white sm:text-3xl">Services built around how people actually move</h2>
        </div>

        <ul class="mt-12 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
            @foreach ($services as $service)
                <li>
                    <a href="{{ route('services.show', $service) }}"
                       class="group flex h-full flex-col rounded-2xl bg-white/5 p-6 transition hover:bg-white/10">
                        <span class="inline-flex h-11 w-11 items-center justify-center rounded-xl bg-accent-500/15 text-accent-400">
                            <x-icon :name="$service->icon" class="w-5 h-5" />
                        </span>
                        <span class="mt-4 font-bold text-white">{{ $service->name }}</span>
                        <span class="mt-2 line-clamp-2 text-sm text-ink-500">{{ $service->excerpt }}</span>
                    </a>
                </li>
            @endforeach
        </ul>

        <div class="mt-10">
            <a href="{{ route('services.index') }}" class="btn-ghost-light">
                All services
                <x-icon name="arrow-right" class="w-4 h-4" />
            </a>
        </div>
    </div>
</section>

{{-- ============================== REVIEWS ============================== --}}
@if ($testimonials->isNotEmpty())
    <section class="section">
        <div class="container-page">
            <x-section-heading eyebrow="Client reviews" title="Recent feedback from recent moves" />

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

<x-quote-form source="about" heading="Planning a move? Get a written price" />

@endsection