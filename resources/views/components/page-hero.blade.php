@props(['title', 'subtitle' => null, 'image' => null, 'breadcrumbs' => [], 'eyebrow' => null])

@php
    $heroPool = [
        'images/55.webp',
        'images/g1.webp',
        'images/g2.webp',
        'images/g3.webp',
        'images/g4.webp',
        'images/g5.webp',
        'images/g6.webp',
        'images/g7.webp',
        'images/g88.webp',
        'images/g9.webp',
        'images/g10.webp',
        'images/g11.webp',
        'images/g12.webp',
        'images/g13.webp',
        'images/whyy.webp',
        'images/why3.webp',
        'images/why.webp',
        'images/s1.webp',
        'images/s2.webp',
        'images/s3.webp',
        'images/s4.webp',
        'images/s5.webp',
        'images/s6.webp',
        'images/s7.webp',
        'images/s8.webp',
        'images/s9.webp',
        'images/s10.webp',
        'images/s11.webp',
        'images/s12.webp',
        'images/abt.webp',
    ];

    // Pick a random image from the pool, or use the specific image if provided and non-generic
    $heroBgImage = $image && $image !== 'images/about-bg.webp' ? $image : $heroPool[array_rand($heroPool)];
@endphp

<header class="relative overflow-hidden bg-ink-950 text-white">
    {{-- Full-bleed random background image with rich gradient overlay --}}
    <div class="absolute inset-0">
        <img src="{{ asset($heroBgImage) }}" alt="" aria-hidden="true" width="1600" height="600"
            fetchpriority="high" decoding="async" class="h-full w-full object-cover transition duration-1000">
        <div class="absolute inset-0 bg-gradient-to-r from-ink-950 via-ink-950/90 to-brand-950/70"></div>
        <div class="absolute inset-0 bg-radial from-transparent via-ink-950/40 to-ink-950"></div>
    </div>

    <div class="container-page relative py-16 sm:py-20 lg:py-24">
        @if ($breadcrumbs)
            <nav aria-label="Breadcrumb" class="mb-6">
                <ol class="flex flex-wrap items-center gap-2 text-sm text-ink-300">
                    @foreach ($breadcrumbs as $crumb)
                        <li class="flex items-center gap-2">
                            @if (!$loop->last && !empty($crumb['url']))
                                <a href="{{ $crumb['url'] }}"
                                    class="transition hover:text-accent-400">{{ $crumb['title'] }}</a>
                            @else
                                <span class="font-medium text-white" aria-current="page">{{ $crumb['title'] }}</span>
                            @endif
                            @if (!$loop->last)
                                <x-icon name="chevron-right" class="w-3.5 h-3.5 text-ink-500" />
                            @endif
                        </li>
                    @endforeach
                </ol>
            </nav>
        @endif

        @if ($eyebrow)
            <p class="eyebrow-light mb-4">{{ $eyebrow }}</p>
        @endif

        <h1 class="max-w-4xl text-3xl font-bold tracking-tight text-white sm:text-4xl lg:text-5xl lg:leading-[1.12]">
            {{ $title }}
        </h1>

        @if ($subtitle)
            <p class="mt-5 max-w-2xl text-base leading-relaxed text-ink-300 sm:text-lg">
                {{ $subtitle }}
            </p>
        @endif

        {{ $slot }}
    </div>
</header>
