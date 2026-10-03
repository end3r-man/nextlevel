@extends('layouts.app')

@push('meta')
    <x-seo :title="$title" :description="$description" image="images/og-default.png"
           :canonical="route('blog.index')" :schema="$schema" />
@endpush

@section('content')

<x-page-hero
    eyebrow="Moving guides"
    title="Moving tips from people who do this every day"
    subtitle="Costs, packing techniques, relocation planning and route advice — written by the crew, not copied from a listicle."
    image="images/about-bg.webp"
    :breadcrumbs="$crumbs"
/>

<section class="section">
    <div class="container-page">
        {{-- Lead article gets full width, the rest form a grid. --}}
        @if ($posts->isNotEmpty())
            @php $lead = $posts->first(); @endphp

            <article class="card overflow-hidden lg:grid lg:grid-cols-12" data-reveal>
                <a href="{{ route('blog.show', $lead) }}" class="block lg:col-span-6">
                    <img src="{{ asset($lead->image) }}" alt="{{ $lead->title }}"
                         width="900" height="560" loading="lazy" decoding="async"
                         class="h-64 w-full object-cover lg:h-full">
                </a>

                <div class="flex flex-col justify-center p-7 sm:p-10 lg:col-span-6">
                    <p class="text-xs font-semibold tracking-wide text-accent-600 uppercase">
                        Latest guide · {{ $lead->published_at->format('d M Y') }} · {{ $lead->reading_minutes }} min read
                    </p>
                    <h2 class="mt-3 text-2xl font-bold leading-snug sm:text-3xl">
                        <a href="{{ route('blog.show', $lead) }}" class="transition hover:text-brand-700">
                            {{ $lead->title }}
                        </a>
                    </h2>
                    <p class="mt-4 text-base leading-relaxed text-ink-600">{{ $lead->excerpt }}</p>
                    <a href="{{ route('blog.show', $lead) }}" class="btn-primary mt-7 self-start">
                        Read the guide
                        <x-icon name="arrow-right" class="w-4 h-4" />
                    </a>
                </div>
            </article>
        @endif

        <div class="mt-12 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($posts->skip(1) as $post)
                <article class="card-hover group flex flex-col overflow-hidden" data-reveal>
                    <a href="{{ route('blog.show', $post) }}" class="block h-44 overflow-hidden bg-ink-100">
                        <img src="{{ asset($post->image) }}" alt="{{ $post->title }}"
                             width="900" height="560" loading="lazy" decoding="async"
                             class="h-full w-full object-cover transition duration-500 group-hover:scale-105">
                    </a>

                    <div class="flex flex-1 flex-col p-6">
                        <p class="text-xs font-semibold tracking-wide text-ink-500 uppercase">
                            {{ $post->published_at->format('d M Y') }} · {{ $post->reading_minutes }} min read
                        </p>

                        <h2 class="mt-3 text-lg leading-snug">
                            <a href="{{ route('blog.show', $post) }}" class="transition hover:text-brand-700">
                                {{ $post->title }}
                            </a>
                        </h2>

                        <p class="mt-3 line-clamp-3 flex-1 text-sm leading-relaxed text-ink-600">{{ $post->excerpt }}</p>

                        <a href="{{ route('blog.show', $post) }}"
                           class="mt-5 inline-flex items-center gap-2 text-sm font-semibold text-brand-700">
                            Read more
                            <x-icon name="arrow-right" class="w-4 h-4 transition group-hover:translate-x-1" />
                        </a>
                    </div>
                </article>
            @endforeach
        </div>

        {{-- Paginated archives are crawlable (robots.txt does not block
             query strings), so ?page=2 can rank on its own. --}}
        @if ($posts->hasPages())
            <nav class="mt-12 flex flex-wrap items-center justify-center gap-2" aria-label="Blog pagination">
                @if ($posts->onFirstPage())
                    <span class="btn-outline !px-4 !py-2 text-sm opacity-50" aria-disabled="true">Previous</span>
                @else
                    <a href="{{ $posts->previousPageUrl() }}" class="btn-outline !px-4 !py-2 text-sm">Previous</a>
                @endif

                @foreach ($posts->getUrlRange(1, $posts->lastPage()) as $page => $url)
                    @if ($page == $posts->currentPage())
                        <span aria-current="page" class="btn-primary !px-4 !py-2 text-sm">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" class="btn-outline !px-4 !py-2 text-sm">{{ $page }}</a>
                    @endif
                @endforeach

                @if ($posts->hasMorePages())
                    <a href="{{ $posts->nextPageUrl() }}" class="btn-outline !px-4 !py-2 text-sm">Next</a>
                @else
                    <span class="btn-outline !px-4 !py-2 text-sm opacity-50" aria-disabled="true">Next</span>
                @endif
            </nav>
        @endif
    </div>
</section>

<x-quote-form source="blog-index" showImage="false"
              heading="Reading about moving is cheaper than moving badly"
              lead="But if you would rather not, just tell us your two addresses and we will price it properly." />

@endsection