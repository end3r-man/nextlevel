@extends('layouts.app')

@push('meta')
    <x-seo :title="$title" :description="$description" :image="$post->image"
           type="article" :canonical="route('blog.show', $post)" :schema="$schema"
           :publishedAt="$post->published_at->toAtomString()"
           :modifiedAt="$post->updated_at->toAtomString()" />
@endpush

@section('content')

<x-page-hero
    eyebrow="Moving guide"
    :title="$post->title"
    :subtitle="$post->excerpt"
    :image="$post->image"
    :breadcrumbs="$crumbs"
>
    <div class="mt-8 flex flex-wrap items-center gap-x-6 gap-y-2 text-sm text-ink-500">
        <span class="inline-flex items-center gap-2">
            <x-icon name="user" class="w-4 h-4" />
            {{ $post->author }}
        </span>
        <span class="inline-flex items-center gap-2">
            <x-icon name="calendar" class="w-4 h-4" />
            <time datetime="{{ $post->published_at->toAtomString() }}">{{ $post->published_at->format('d M Y') }}</time>
        </span>
        <span class="inline-flex items-center gap-2">
            <x-icon name="clock" class="w-4 h-4" />
            {{ $post->reading_minutes }} min read
        </span>
    </div>
</x-page-hero>

<article class="section">
    <div class="container-page">
        <div class="grid gap-12 lg:grid-cols-12 lg:gap-16">

            <div class="lg:col-span-8">
                <div class="prose-nlp max-w-none text-base leading-[1.75] text-ink-700">
                    {!! $post->body !!}
                </div>

                <div class="mt-12 flex flex-wrap items-center justify-between gap-4 border-t border-ink-200 pt-8">
                    <p class="text-sm text-ink-500">
                        Written by {{ $post->author }} at {{ config('site')['name'] }}.
                    </p>

                    <div class="flex items-center gap-3">
                        <span class="text-sm text-ink-500">Share this guide</span>
                        <a href="https://wa.me/?text={{ urlencode($post->title.' — '.route('blog.show', $post)) }}"
                           target="_blank" rel="noopener"
                           class="inline-flex h-9 w-9 items-center justify-center rounded-full bg-emerald-50 text-emerald-600 transition hover:bg-emerald-600 hover:text-white"
                           aria-label="Share on WhatsApp">
                            <x-icon name="whatsapp" class="w-4 h-4" />
                        </a>
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('blog.show', $post)) }}"
                           target="_blank" rel="noopener"
                           class="inline-flex h-9 w-9 items-center justify-center rounded-full bg-brand-50 text-brand-700 transition hover:bg-brand-700 hover:text-white"
                           aria-label="Share on Facebook">
                            <x-icon name="facebook" class="w-4 h-4" />
                        </a>
                        <button type="button" data-copy="{{ route('blog.show', $post) }}"
                                class="inline-flex h-9 w-9 items-center justify-center rounded-full bg-ink-50 text-ink-600 transition hover:bg-ink-950 hover:text-white"
                                aria-label="Copy link to this guide">
                            <x-icon name="copy" class="w-4 h-4" />
                        </button>
                    </div>
                </div>

                <div class="mt-8 flex items-center gap-3 rounded-xl bg-ink-50 px-5 py-4">
                    <x-icon name="info" class="w-5 h-5 shrink-0 text-brand-700" />
                    <p class="text-sm text-ink-600">
                        Copies of this guide are useful, but a price has to come from a goods list.
                        <a href="{{ route('contact') }}#get-a-quote" class="font-semibold text-brand-700 underline">
                            Ask for a free written quote
                        </a>.
                    </p>
                </div>
            </div>

            <aside class="lg:col-span-4">
                <div class="lg:sticky lg:top-28 space-y-6">
                    <div class="card overflow-hidden">
                        <img src="{{ asset('images/g9.webp') }}" alt=""
                             width="900" height="560" loading="lazy" decoding="async"
                             class="h-40 w-full object-cover">
                        <div class="p-6">
                            <h2 class="text-base">Need a moving quote?</h2>
                            <p class="mt-2 text-sm leading-relaxed text-ink-600">
                                Tell us your two cities and the goods list. Written price the same day.
                            </p>
                            <a href="{{ route('contact') }}#get-a-quote" class="btn-accent mt-5 w-full">
                                Get a free quote
                                <x-icon name="arrow-right" class="w-4 h-4" />
                            </a>
                            <a href="tel:{{ config('site')['phone_e164'] }}" class="btn-outline mt-2.5 w-full">
                                <x-icon name="phone" class="w-4 h-4" />
                                {{ config('site')['phone_display'] }}
                            </a>
                        </div>
                    </div>

                    @if ($related->isNotEmpty())
                        <div class="card p-6">
                            <h2 class="text-base">More moving guides</h2>
                            <ul class="mt-4 space-y-4">
                                @foreach ($related as $rel)
                                    <li>
                                        <a href="{{ route('blog.show', $rel) }}"
                                           class="group flex gap-3">
                                            <img src="{{ asset($rel->image) }}" alt=""
                                                 width="140" height="100" loading="lazy" decoding="async"
                                                 class="h-14 w-20 shrink-0 rounded-lg object-cover">
                                            <span class="min-w-0">
                                                <span class="line-clamp-2 text-sm font-semibold leading-snug text-ink-800 group-hover:text-brand-700">
                                                    {{ $rel->title }}
                                                </span>
                                                <span class="mt-1 block text-xs text-ink-500">
                                                    {{ $rel->reading_minutes }} min read
                                                </span>
                                            </span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>

                            <a href="{{ route('blog.index') }}" class="mt-5 inline-flex items-center gap-2 text-sm font-semibold text-brand-700">
                                All guides
                                <x-icon name="arrow-right" class="w-4 h-4" />
                            </a>
                        </div>
                    @endif
                </div>
            </aside>
        </div>
    </div>
</article>

@endsection