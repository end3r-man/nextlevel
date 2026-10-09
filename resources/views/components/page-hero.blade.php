@props([
    'title',
    'subtitle' => null,
    'image' => null,
    'breadcrumbs' => [],
    'eyebrow' => null,
    'showGalleryLink' => true,
])

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

    // Pick a random image for background and for the featured visual card
    $heroBgImage = $image && $image !== 'images/about-bg.webp' ? $image : $heroPool[array_rand($heroPool)];
    $heroFeaturedImage = $heroPool[array_rand($heroPool)];
@endphp

<header class="relative overflow-hidden bg-[#040d1e] text-white">
    {{-- Ambient multi-layered lighting and texture --}}
    <div class="absolute inset-0 pointer-events-none">
        <img src="{{ asset($heroBgImage) }}" alt="" aria-hidden="true" width="1600" height="600"
            fetchpriority="high" decoding="async" class="h-full w-full object-cover opacity-15 filter blur-sm">
        <div class="absolute inset-0 bg-gradient-to-r from-[#040d1e] via-[#040d1e]/90 to-[#071738]/80"></div>
        <div class="absolute inset-0 bg-radial from-brand-600/10 via-transparent to-transparent"></div>
        <div class="absolute -top-40 right-0 h-96 w-96 rounded-full bg-accent-500/15 blur-3xl"></div>
        <div class="absolute -bottom-40 left-1/4 h-96 w-96 rounded-full bg-brand-500/20 blur-3xl"></div>
    </div>

    <div class="container-page relative py-12 sm:py-16 lg:py-20">
        <div class="grid gap-10 lg:grid-cols-12 lg:gap-12 lg:items-center">

            {{-- Left column: Breadcrumbs, Eyebrow, Title, Subtitle, Actions --}}
            <div class="{{ $showGalleryLink && ! request()->routeIs('gallery') ? 'lg:col-span-7 xl:col-span-7' : 'lg:col-span-12' }}">
                @if ($breadcrumbs)
                    <nav aria-label="Breadcrumb" class="mb-5">
                        <ol class="flex flex-wrap items-center gap-2 text-xs sm:text-sm text-ink-300">
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
                    <div class="mb-4 inline-flex items-center gap-2 rounded-full border border-accent-500/30 bg-accent-500/10 px-3.5 py-1.5 text-xs font-bold uppercase tracking-wider text-accent-400 backdrop-blur-md">
                        <span class="h-1.5 w-1.5 rounded-full bg-accent-400 animate-pulse"></span>
                        <span>{{ $eyebrow }}</span>
                    </div>
                @endif

                <h1 class="text-3xl font-extrabold tracking-tight text-white sm:text-4xl lg:text-5xl lg:leading-[1.12]">
                    {{ $title }}
                </h1>

                @if ($subtitle)
                    <p class="mt-4 sm:mt-5 max-w-2xl text-base leading-relaxed text-slate-300 sm:text-lg">
                        {{ $subtitle }}
                    </p>
                @endif

                @if ($slot->isNotEmpty())
                    <div class="mt-6 sm:mt-8">
                        {{ $slot }}
                    </div>
                @endif

                {{-- Trust mini-pills strip --}}
                <div class="mt-8 flex flex-wrap items-center gap-4 border-t border-white/10 pt-6 text-xs text-slate-300">
                    <div class="flex items-center gap-2">
                        <x-icon name="check-circle" class="w-4 h-4 text-emerald-400" />
                        <span>Own Verified Fleet</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <x-icon name="shield" class="w-4 h-4 text-accent-400" />
                        <span>Full Transit Cover</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <x-icon name="users" class="w-4 h-4 text-sky-400" />
                        <span>Direct Full-Time Crew</span>
                    </div>
                </div>
            </div>

            {{-- Right column: Interactive Glass Showcase Card linking to Gallery --}}
            @if ($showGalleryLink && ! request()->routeIs('gallery'))
                <div class="lg:col-span-5 xl:col-span-5">
                    <div class="relative mx-auto max-w-md lg:max-w-none">
                        {{-- Ambient card glow aura --}}
                        <div class="absolute -inset-1.5 rounded-3xl bg-gradient-to-r from-accent-500/30 via-brand-500/30 to-emerald-500/20 blur-xl opacity-60 transition duration-500 group-hover:opacity-100"></div>

                        <a href="{{ route('gallery') }}"
                           class="group relative block overflow-hidden rounded-3xl border border-white/15 bg-white/5 p-3 shadow-2xl backdrop-blur-xl transition duration-500 hover:-translate-y-1.5 hover:border-accent-400/60 hover:shadow-glow-accent"
                           title="Click to explore our full photo gallery">
                            <div class="relative aspect-[4/3] sm:aspect-[16/11] w-full overflow-hidden rounded-2xl bg-ink-950">
                                <img src="{{ asset($heroFeaturedImage) }}"
                                     alt="Next Level Packers and Movers live operations photo"
                                     width="800" height="550"
                                     loading="eager" decoding="async"
                                     class="h-full w-full object-cover transition duration-700 group-hover:scale-108">
                                <div class="absolute inset-0 bg-gradient-to-t from-[#040d1e]/90 via-[#040d1e]/20 to-transparent"></div>

                                {{-- Top Floating Tag: Live Snapshot Status --}}
                                <div class="absolute top-3 left-3 flex items-center gap-2 rounded-full bg-ink-950/80 px-3 py-1.5 text-[11px] font-semibold text-white backdrop-blur-md border border-white/15 shadow-sm">
                                    <span class="flex h-2 w-2 rounded-full bg-emerald-400 animate-pulse"></span>
                                    <span>Real Work Snapshot</span>
                                </div>

                                {{-- Top Right Floating Badge: Star Rating --}}
                                <div class="absolute top-3 right-3 flex items-center gap-1 rounded-full bg-accent-500/90 px-2.5 py-1 text-[11px] font-bold text-white shadow-sm backdrop-blur-md">
                                    <x-icon name="star" class="w-3 h-3" />
                                    <span>4.9 / 5</span>
                                </div>

                                {{-- Bottom Glass Control Bar linking to Gallery --}}
                                <div class="absolute inset-x-3 bottom-3 flex items-center justify-between rounded-xl bg-ink-950/85 p-3 backdrop-blur-md border border-white/15 text-white transition duration-300 group-hover:bg-ink-900/95 group-hover:border-accent-400/40">
                                    <div class="min-w-0 pr-2">
                                        <p class="text-[11px] font-bold uppercase tracking-wider text-accent-400">Field Operations</p>
                                        <p class="truncate text-xs font-semibold text-white">Photographed on real shifts</p>
                                    </div>

                                    <span class="inline-flex shrink-0 items-center gap-1.5 rounded-lg bg-accent-500 px-3 py-1.5 text-xs font-bold text-white shadow-soft transition group-hover:bg-accent-400 group-hover:scale-105">
                                        <span>Gallery</span>
                                        <x-icon name="arrow-right" class="w-3.5 h-3.5 transition group-hover:translate-x-0.5" />
                                    </span>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            @endif

        </div>
    </div>
</header>
