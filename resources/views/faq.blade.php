@extends('layouts.app')

@push('meta')
    <x-seo :title="$title" :description="$description" image="images/og-default.png"
           :canonical="route('faq')" :schema="$schema" />
@endpush

@section('content')

<x-page-hero
    eyebrow="FAQ"
    title="Answers to the questions we are asked every week"
    subtitle="Rates, timings, packing, insurance and coverage — answered honestly. If your question is not here, call the office and ask a person."
    image="images/about-bg.webp"
    :breadcrumbs="$crumbs"
/>

{{-- ============================== QUICK ANSWERS ============================== --}}
<section class="section !py-12">
    <div class="container-page">
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
            @foreach ([
                ['quote', 'How much does it cost?', 'A 1 BHK local move with full packing starts around ₹3,500. Bigger homes and intercity runs are quoted on the goods list.'],
                ['clock', 'How soon can you come?', 'Same day in Erode, Tiruppur and Coimbatore if you call before 11 AM. Two to three days is comfortable for planned moves.'],
                ['shield', 'Is my stuff insured?', 'Yes. Transit insurance is included in every move and is settled against the same job sheet, not quietly dropped later.'],
                ['box-open', 'Do you pack?', 'Yes — bubble wrap and blankets for glass and furniture, and unlabelled boxes are never used. You can also pack yourself and we will load.'],
            ] as [$icon, $q, $a])
                <div class="card p-6">
                    <span class="inline-flex h-10 w-10 items-center justify-center rounded-lg bg-accent-50 text-accent-600">
                        <x-icon :name="$icon" class="w-5 h-5" />
                    </span>
                    <h2 class="mt-4 text-base">{{ $q }}</h2>
                    <p class="mt-2 text-sm leading-relaxed text-ink-600">{{ $a }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ============================== FULL FAQ ============================== --}}
<section class="section !pt-4">
    <div class="container-page">
        <div class="grid gap-12 lg:grid-cols-12 lg:gap-16">

            <div class="lg:col-span-4">
                <div class="lg:sticky lg:top-28">
                    <p class="eyebrow mb-3">
                        <x-icon name="info" class="w-4 h-4" />
                        All questions
                    </p>
                    <h2 class="text-2xl font-bold sm:text-3xl">{{ $faqs->count() }} questions, answered</h2>
                    <p class="mt-4 text-sm leading-relaxed text-ink-600">
                        Everything below is also published as FAQ structured data so search engines can
                        quote us directly.
                    </p>

                    <div class="card mt-7 p-6">
                        <p class="text-sm leading-relaxed text-ink-600">
                            Still unsure? Tell us your two cities and your goods list and we will give you
                            a firm written price the same day.
                        </p>
                        <a href="{{ route('contact') }}#get-a-quote" class="btn-primary mt-5 w-full">
                            Get a written quote
                            <x-icon name="arrow-right" class="w-4 h-4" />
                        </a>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-8" data-accordion="single">
                @forelse ($faqs as $faq)
                    <div class="border-b border-ink-200 last:border-0">
                        <h3>
                            <button type="button" data-accordion-trigger aria-expanded="false"
                                    class="flex w-full items-start justify-between gap-6 py-5 text-left">
                                <span class="font-semibold text-ink-900">{{ $faq->question }}</span>
                                <span class="inline-flex mt-0.5 h-8 w-8 shrink-0 items-center justify-center rounded-full bg-ink-50 text-brand-700 transition">
                                    <x-icon name="chevron-down" data-accordion-icon class="w-4 h-4" />
                                </span>
                            </button>
                        </h3>
                        <div class="hidden pb-6">
                            <div class="text-sm leading-relaxed text-ink-600">
                                {!! nl2br(e($faq->answer)) !!}
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-ink-600">No questions have been published yet.</p>
                @endforelse
            </div>
        </div>
    </div>
</section>

{{-- ============================== SERVICES + LOCATIONS ============================== --}}
<section class="section bg-ink-50">
    <div class="container-page">
        <div class="grid gap-10 lg:grid-cols-2 lg:gap-12">

            <div>
                <h2 class="text-xl font-bold">Services people ask about</h2>
                <p class="mt-2 text-sm text-ink-600">Each service has its own page with full detail.</p>

                <ul class="mt-6 grid gap-2.5 sm:grid-cols-2">
                    @foreach ($services as $service)
                        <li>
                            <a href="{{ route('services.show', $service) }}"
                               class="chip w-full justify-between">
                                {{ $service->name }}
                                <x-icon name="arrow-right" class="w-3.5 h-3.5" />
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div>
                <h2 class="text-xl font-bold">Where we operate</h2>
                <p class="mt-2 text-sm text-ink-600">Local pages with local rates and timings.</p>

                <ul class="mt-6 flex flex-wrap gap-2.5">
                    @foreach ($locations as $loc)
                        <li>
                            <a href="{{ route('locations.show', $loc) }}" class="chip">
                                <x-icon name="pin" class="w-3.5 h-3.5 text-accent-500" />
                                {{ $loc->name }}
                            </a>
                        </li>
                    @endforeach
                    <li>
                        <a href="{{ route('locations.index') }}" class="chip font-bold text-brand-700">
                            View all 25 locations
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

<x-quote-form source="faq" heading="Still have a question?" showImage="false"
              lead="Ask it on the form and we will answer it directly, or call the office for the quickest response." />

@endsection