@extends('layouts.app')

@push('meta')
    <x-seo :title="$title" :description="$description" image="images/og-default.png"
           :canonical="route('testimonials')" :schema="$schema" />
@endpush

@section('content')

<x-page-hero
    eyebrow="Client reviews"
    title="What our customers say"
    subtitle="Rated {{ config('site')['rating']['value'] }} out of 5 across {{ number_format(config('site')['rating']['count']) }} reviews. These are completed jobs, in the cities we actually work in."
    image="images/about-bg.webp"
    :breadcrumbs="$crumbs"
/>

{{-- ============================== RATING SUMMARY ============================== --}}
<section class="section !py-12">
    <div class="container-page">
        <div class="card grid gap-8 p-8 sm:p-10 lg:grid-cols-12 lg:items-center">
            <div class="lg:col-span-4">
                <div class="flex items-center gap-1 text-accent-500" aria-label="Rated {{ config('site')['rating']['value'] }} out of 5">
                    @for ($i = 0; $i < 5; $i++)
                        <x-icon name="star" class="w-6 h-6" />
                    @endfor
                </div>

                <p class="mt-4 text-5xl font-bold text-ink-950">
                    {{ config('site')['rating']['value'] }}<span class="text-2xl font-medium text-ink-500">/5</span>
                </p>

                <p class="mt-2 text-sm text-ink-600">
                    Based on {{ number_format(config('site')['rating']['count']) }} Google reviews
                </p>
            </div>

            <div class="lg:col-span-8 lg:border-l lg:border-ink-200 lg:pl-10">
                <p class="text-base leading-relaxed text-ink-700">
                    People judge a moving company on whether anything broke, whether the price changed
                    halfway through, and whether anyone answered the phone on delivery day. That is the
                    bar we hold ourselves to, and these are the customers who told us we cleared it.
                </p>

                <div class="mt-6 flex flex-wrap gap-3">
                    <a href="tel:{{ config('site')['phone_e164'] }}" class="btn-primary">
                        <x-icon name="phone" class="w-4 h-4" />
                        Call {{ config('site')['phone_display'] }}
                    </a>
                    <a href="{{ route('gallery') }}" class="btn-outline">
                        See our work
                        <x-icon name="arrow-right" class="w-4 h-4" />
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ============================== ALL REVIEWS ============================== --}}
<section class="section !pt-4">
    <div class="container-page">
        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            @foreach ($testimonials as $t)
                <figure class="card flex flex-col p-7" data-reveal>
                    <x-icon name="quote" class="w-7 h-7 text-accent-200" />

                    <blockquote class="mt-4 flex-1 text-sm leading-relaxed text-ink-700">{{ $t->quote }}</blockquote>

                    <div class="mt-5 flex gap-0.5 text-accent-500" aria-label="{{ $t->rating }} out of 5 stars">
                        @for ($i = 0; $i < $t->rating; $i++)
                            <x-icon name="star" class="w-3.5 h-3.5" />
                        @endfor
                    </div>

                    <figcaption class="mt-5 flex items-center gap-4 border-t border-ink-100 pt-5">
                        <span class="inline-flex h-11 w-11 shrink-0 items-center justify-center rounded-full bg-brand-100 font-bold text-brand-700">
                            {{ strtoupper(substr($t->name, 0, 1)) }}
                        </span>
                        <div class="min-w-0">
                            <p class="truncate font-bold text-ink-900">{{ $t->name }}</p>
                            <p class="truncate text-xs text-ink-500">
                                {{ $t->designation }}{{ $t->location ? ' · '.$t->location : '' }}
                            </p>
                        </div>
                    </figcaption>
                </figure>
            @endforeach
        </div>

        <p class="mt-10 text-center text-sm text-ink-500">
            {{ $testimonials->count() }} reviews shown. Every job sheet is available to verify a claim.
        </p>
    </div>
</section>

<x-quote-form source="reviews" showImage="false"
              heading="Want to be the next review on this page?"
              lead="Book a move and tell us afterwards. We would rather earn the review than buy it." />

@endsection