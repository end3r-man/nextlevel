@php
    $galleryItems = [
        [
            'src' => 'images/55.webp',
            'alt' => 'Household packing in Erode',
            'category' => 'Household',
            'title' => 'Multi-Layer Packing',
            'span' => 'lg:col-span-2 lg:row-span-2',
            'aspect' => 'aspect-square lg:aspect-auto',
        ],
        [
            'src' => 'images/g11.webp',
            'alt' => 'Dedicated closed-body truck transit',
            'category' => 'Dedicated Fleet',
            'title' => 'All-Weather Sealed Fleet',
            'span' => 'lg:col-span-2 lg:row-span-1',
            'aspect' => 'aspect-[4/3] lg:aspect-auto',
        ],
        [
            'src' => 'images/g2.webp',
            'alt' => 'Furniture wrapping and protection',
            'category' => 'Protection',
            'title' => 'Edge Guard & Shrink Wrap',
            'span' => 'lg:col-span-1 lg:row-span-1',
            'aspect' => 'aspect-square lg:aspect-auto',
        ],
        [
            'src' => 'images/g3.webp',
            'alt' => 'Office relocation and workstation setup',
            'category' => 'Commercial',
            'title' => 'Corporate IT Equipment',
            'span' => 'lg:col-span-1 lg:row-span-1',
            'aspect' => 'aspect-square lg:aspect-auto',
        ],
        [
            'src' => 'images/g6.webp',
            'alt' => 'Two wheeler bike carrier loading',
            'category' => 'Vehicles',
            'title' => 'Enclosed Bike Transit',
            'span' => 'lg:col-span-2 lg:row-span-1',
            'aspect' => 'aspect-[4/3] lg:aspect-auto',
        ],
        [
            'src' => 'images/g88.webp',
            'alt' => 'Fragile items safe wrapping and cushioning',
            'category' => 'Fragile Care',
            'title' => 'Glassware & Antique Crating',
            'span' => 'lg:col-span-1 lg:row-span-1',
            'aspect' => 'aspect-square lg:aspect-auto',
        ],
        [
            'src' => 'images/g12.webp',
            'alt' => 'Carpentry and furniture reassembly',
            'category' => 'Setup',
            'title' => 'Doorstep Bed Reassembly',
            'span' => 'lg:col-span-1 lg:row-span-1',
            'aspect' => 'aspect-square lg:aspect-auto',
        ],
        [
            'src' => 'images/g1.webp',
            'alt' => 'Loading moving truck safely',
            'category' => 'Loading',
            'title' => 'Systematic Truck Stacking',
            'span' => 'lg:col-span-2 lg:row-span-1',
            'aspect' => 'aspect-[4/3] lg:aspect-auto',
        ],
    ];
@endphp

{{-- =========================================================================
     GALLERY SECTION: Real Moving Operations Portfolio
     Editorial Bento Mosaic with Dark Navy Backdrop & Lightbox Integration
     ========================================================================= --}}
<section class="relative isolate overflow-hidden bg-[#0c2f66] py-24 sm:py-28 lg:py-32 text-white" id="gallery">

    {{-- ================================================================
         ATMOSPHERIC BACKGROUND & HERO GRID TEXTURE
         ================================================================ --}}
    <div class="pointer-events-none absolute inset-0 -z-10 overflow-hidden select-none" aria-hidden="true">
        {{-- Soft Radial Glows --}}
        <div class="absolute -top-40 left-1/3 h-[600px] w-[1000px] -translate-x-1/2 rounded-full bg-blue-500/20 blur-[150px]"></div>
        <div class="absolute -bottom-40 right-1/4 h-[700px] w-[1100px] rounded-full bg-sky-400/15 blur-[160px]"></div>
        <div class="absolute right-0 top-1/2 h-[500px] w-[500px] rounded-full bg-indigo-500/10 blur-[130px]"></div>

        {{-- Subtle Grid Pattern --}}
        <div class="absolute inset-0 opacity-[0.04]"
            style="background-image: linear-gradient(rgba(255,255,255,1) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,1) 1px, transparent 1px); background-size: 64px 64px;">
        </div>

        {{-- Dynamic Route Path SVG --}}
        <svg class="absolute inset-x-0 top-[6%] h-[88%] w-full opacity-15" viewBox="0 0 1440 700" fill="none"
            preserveAspectRatio="none">
            <path d="M-60 520 C180 520 140 140 380 180 C580 210 510 490 730 440 C920 390 850 90 1090 120 C1270 145 1190 470 1520 400"
                stroke="white" stroke-width="1.5" stroke-dasharray="8 12" />
        </svg>

        {{-- Glowing Nodes --}}
        <div class="absolute left-[14%] top-[20%]">
            <div class="h-2.5 w-2.5 rounded-full bg-sky-300 shadow-[0_0_20px_rgba(56,189,248,0.9)]"></div>
            <div class="absolute -inset-2 rounded-full border border-sky-300/30"></div>
        </div>
        <div class="absolute right-[16%] bottom-[20%]">
            <div class="h-2 w-2 rounded-full bg-white/70 shadow-[0_0_18px_rgba(255,255,255,0.8)]"></div>
            <div class="absolute -inset-2 rounded-full border border-white/25"></div>
        </div>
    </div>

    <div class="container mx-auto px-4 sm:px-6 lg:px-8">

        {{-- ================================================================
             SECTION HEADER & GALLERY LINK
             ================================================================ --}}
        <div class="flex flex-col lg:flex-row lg:items-end lg:justify-between gap-8">
            <div class="max-w-2xl">
                {{-- Category Pill Badge --}}
                <div
                    class="inline-flex items-center gap-2 rounded-full border border-white/20 bg-white/10 px-4 py-1.5 text-xs font-bold uppercase tracking-[0.2em] text-white backdrop-blur-md shadow-inner">
                    <span class="h-2 w-2 rounded-full bg-sky-400 animate-pulse"></span>
                    <span>Real Shifting Operations</span>
                </div>

                {{-- Main Headline --}}
                <h2 class="mt-6 text-3xl font-black tracking-tight text-white sm:text-5xl lg:text-6xl leading-[1.1]">
                    Proof in practice.<br />
                    <span class="text-sky-300">Our relocation portfolio.</span>
                </h2>

                <p class="mt-4 text-base text-white/75 sm:text-lg leading-relaxed">
                    Zero stock photos — explore real photographs of our certified packing specialists, dedicated enclosed fleet, and doorstep setup across Tamil Nadu.
                </p>
            </div>

            <div class="shrink-0 flex items-center gap-3">
                <a href="{{ route('gallery') }}"
                    class="inline-flex items-center gap-2 rounded-full bg-white px-7 py-3.5 text-xs sm:text-sm font-black text-[#0c2f66] shadow-xl shadow-black/20 transition-all duration-300 hover:bg-sky-50 hover:scale-105">
                    <span>View All 14+ Photos</span>
                    <x-icon name="arrow-right" class="h-4 w-4 text-[#144b9e]" />
                </a>
            </div>
        </div>

        {{-- ================================================================
             EDITORIAL BENTO MOSAIC (8 CURATED FEATURED TILES)
             ================================================================ --}}
        <div class="mt-14 sm:mt-16 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4 lg:auto-rows-[250px]">

            @foreach ($galleryItems as $item)
                <button type="button"
                    class="group relative overflow-hidden rounded-3xl border border-white/20 bg-slate-900 shadow-xl cursor-pointer text-left transition-all duration-500 hover:-translate-y-1.5 hover:border-white/40 hover:shadow-2xl hover:shadow-blue-950/60 focus:outline-none focus:ring-4 focus:ring-sky-400/40 {{ $item['span'] }} {{ $item['aspect'] }}"
                    data-lightbox-trigger="{{ asset($item['src']) }}"
                    data-lightbox-alt="{{ $item['alt'] }}"
                    aria-label="View photo: {{ $item['alt'] }}">

                    {{-- Image with Smooth Hover Zoom --}}
                    <img src="{{ asset($item['src']) }}" alt="{{ $item['alt'] }}"
                        width="800" height="600" loading="lazy" decoding="async"
                        class="absolute inset-0 h-full w-full object-cover transition-transform duration-700 ease-out group-hover:scale-110 opacity-85 group-hover:opacity-100">

                    {{-- Subtle Cinematic Overlays --}}
                    <div class="absolute inset-0 bg-gradient-to-t from-[#06152b] via-[#06152b]/40 to-transparent"></div>
                    <div class="absolute inset-0 bg-black/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>

                    {{-- Top Category Pill Badge --}}
                    <div class="relative z-10 p-5 flex items-center justify-between">
                        <span class="inline-flex items-center gap-1.5 rounded-full border border-white/25 bg-black/50 px-3 py-1 text-[11px] font-bold text-white backdrop-blur-md shadow-sm">
                            <span class="h-1.5 w-1.5 rounded-full bg-sky-400"></span>
                            {{ $item['category'] }}
                        </span>

                        <div class="flex h-9 w-9 items-center justify-center rounded-xl border border-white/20 bg-white/10 text-white backdrop-blur-md opacity-0 group-hover:opacity-100 transition-all duration-300 transform translate-y-1 group-hover:translate-y-0">
                            <x-icon name="image" class="h-4 w-4 text-sky-300" />
                        </div>
                    </div>

                    {{-- Bottom Information & Enlarge Prompt --}}
                    <div class="absolute inset-x-0 bottom-0 z-10 p-5 sm:p-6">
                        <h3 class="text-base sm:text-lg font-black text-white tracking-tight leading-snug drop-shadow-md">
                            {{ $item['title'] }}
                        </h3>
                        <p class="mt-1 text-xs text-slate-200/90 line-clamp-1">
                            {{ $item['alt'] }}
                        </p>

                        <div class="mt-3 flex items-center gap-1.5 text-[11px] font-bold text-sky-300 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <span>Click to enlarge full photo</span>
                            <span class="transition-transform group-hover:translate-x-1">→</span>
                        </div>
                    </div>

                </button>
            @endforeach

        </div>

        {{-- ================================================================
             BOTTOM TRUST FOOTER
             ================================================================ --}}
        <div class="mt-12 rounded-3xl border border-white/15 bg-white/5 p-6 backdrop-blur-md flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div class="flex items-center gap-3">
                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-white/10 text-sky-300">
                    <x-icon name="shield" class="h-5 w-5" />
                </div>
                <p class="text-xs text-white/80">
                    <strong class="text-white">100% Genuine Site Photography:</strong> Every photo depicts actual Next Level Packers &amp; Movers equipment, staff, and materials.
                </p>
            </div>

            <a href="{{ route('gallery') }}" class="text-xs font-bold text-sky-300 hover:text-white transition shrink-0">
                Explore Complete Photo Archive (14 Images) &rarr;
            </a>
        </div>

    </div>
</section>

<x-lightbox />
