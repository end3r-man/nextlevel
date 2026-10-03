{{-- =========================================================================
     SERVICES SECTION — SPACIOUS EDITORIAL BENTO GRID
     Uncramped, High-Aesthetic Bento Architecture with Category Switching
     ========================================================================= --}}
@php
    $site = config('site');
    $featuredSlugs = [
        'house-shifting',
        'office-shifting',
        'local-shifting',
        'packing-services',
        'two-wheeler-shifting',
        'domestic-movers',
    ];
@endphp

<section id="services" x-data="{ activeTab: 'featured' }"
    class="relative isolate overflow-hidden bg-[#0c2f66] py-24 sm:py-28 lg:py-32">

    {{-- ================================================================
         ATMOSPHERIC BACKGROUND & GLOWING NODES (Matching Hero Style)
         ================================================================ --}}
    <div class="pointer-events-none absolute inset-0 -z-10 overflow-hidden select-none" aria-hidden="true">
        {{-- Soft radial glows --}}
        <div
            class="absolute -top-40 left-1/3 h-[600px] w-[1000px] -translate-x-1/2 rounded-full bg-blue-500/20 blur-[150px]">
        </div>
        <div class="absolute -bottom-40 right-1/4 h-[700px] w-[1100px] rounded-full bg-sky-400/15 blur-[160px]"></div>
        <div class="absolute right-0 top-1/2 h-[500px] w-[500px] rounded-full bg-indigo-500/10 blur-[130px]"></div>

        {{-- Subtle Grid Pattern --}}
        <div class="absolute inset-0 opacity-[0.04]"
            style="background-image: linear-gradient(rgba(255,255,255,1) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,1) 1px, transparent 1px); background-size: 64px 64px;">
        </div>

        {{-- Dynamic Route Path SVG --}}
        <svg class="absolute inset-x-0 top-[6%] h-[88%] w-full opacity-15" viewBox="0 0 1440 700" fill="none"
            preserveAspectRatio="none">
            <path
                d="M-60 520 C180 520 140 140 380 180 C580 210 510 490 730 440 C920 390 850 90 1090 120 C1270 145 1190 470 1520 400"
                stroke="white" stroke-width="1.5" stroke-dasharray="8 12" />
            <path
                d="M-80 120 C160 60 230 330 420 280 C580 240 620 80 800 110 C1010 145 970 380 1170 330 C1300 300 1380 220 1530 220"
                stroke="white" stroke-width="1" stroke-dasharray="4 8" />
        </svg>

        {{-- Glowing Nodes --}}
        <div class="absolute left-[12%] top-[24%]">
            <div class="h-2.5 w-2.5 rounded-full bg-sky-300 shadow-[0_0_20px_rgba(56,189,248,0.9)]"></div>
            <div class="absolute -inset-2 rounded-full border border-sky-300/30"></div>
        </div>
        <div class="absolute right-[16%] bottom-[22%]">
            <div class="h-2 w-2 rounded-full bg-white/70 shadow-[0_0_18px_rgba(255,255,255,0.8)]"></div>
            <div class="absolute -inset-2 rounded-full border border-white/25"></div>
        </div>
    </div>

    <div class="container mx-auto px-4 sm:px-6 lg:px-8">

        {{-- ================================================================
             SECTION HEADER & CATEGORY FILTER TABS
             ================================================================ --}}
        <div class="mx-auto max-w-3xl text-center">
            {{-- Category Pill Badge --}}
            <div
                class="inline-flex items-center gap-2 rounded-full border border-white/20 bg-white/10 px-4 py-1.5 text-xs font-bold uppercase tracking-[0.2em] text-white backdrop-blur-md shadow-inner">
                <span class="h-2 w-2 rounded-full bg-sky-400 animate-pulse"></span>
                <span>Our Moving Solutions</span>
            </div>

            <h2 class="mt-6 text-4xl font-black tracking-tight text-white sm:text-5xl lg:text-6xl leading-[1.08]">
                Everything your move <span class="text-white/50">needs.</span>
            </h2>

            <p class="mx-auto mt-4 max-w-xl text-base text-white/70 sm:text-lg">
                Explore our dedicated services curated with 5-ply defensive packing, verified crews, and sealed transit.
            </p>

            {{-- Category Switcher Tabs --}}
            <div class="mt-8 flex flex-wrap justify-center gap-2.5">
                <button type="button" @click="activeTab = 'featured'"
                    :class="activeTab === 'featured' ?
                        'bg-white text-[#0c2f66] shadow-xl shadow-black/20 font-black scale-105' :
                        'border border-white/15 bg-white/5 text-white/80 hover:bg-white/15 hover:text-white'"
                    class="rounded-full px-5 py-2.5 text-xs font-bold tracking-wide transition-all duration-300 cursor-pointer">
                    ★ Featured Bento
                </button>
                <button type="button" @click="activeTab = 'household'"
                    :class="activeTab === 'household' ?
                        'bg-white text-[#0c2f66] shadow-xl shadow-black/20 font-black scale-105' :
                        'border border-white/15 bg-white/5 text-white/80 hover:bg-white/15 hover:text-white'"
                    class="rounded-full px-5 py-2.5 text-xs font-bold tracking-wide transition-all duration-300 cursor-pointer">
                    🏠 Household Moves
                </button>
                <button type="button" @click="activeTab = 'commercial'"
                    :class="activeTab === 'commercial' ?
                        'bg-white text-[#0c2f66] shadow-xl shadow-black/20 font-black scale-105' :
                        'border border-white/15 bg-white/5 text-white/80 hover:bg-white/15 hover:text-white'"
                    class="rounded-full px-5 py-2.5 text-xs font-bold tracking-wide transition-all duration-300 cursor-pointer">
                    🏢 Commercial &amp; Office
                </button>
                <button type="button" @click="activeTab = 'logistics'"
                    :class="activeTab === 'logistics' ?
                        'bg-white text-[#0c2f66] shadow-xl shadow-black/20 font-black scale-105' :
                        'border border-white/15 bg-white/5 text-white/80 hover:bg-white/15 hover:text-white'"
                    class="rounded-full px-5 py-2.5 text-xs font-bold tracking-wide transition-all duration-300 cursor-pointer">
                    🚚 Logistics &amp; Transport
                </button>
            </div>
        </div>

        {{-- ================================================================
             VIEW 1: FEATURED SPACIOUS BENTO GRID (DEFAULT)
             Clean, uncluttered, roomy layout with clear hierarchy
             ================================================================ --}}
        <div x-show="activeTab === 'featured'" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-3" x-transition:enter-end="opacity-100 translate-y-0"
            class="mt-12 space-y-6">

            {{-- Bento Row 1: Master Hero Tile (7 Cols) + 2 Stacked Tiles (5 Cols) --}}
            <div class="grid gap-6 lg:grid-cols-12">

                {{-- 01. HOUSE SHIFTING — Master Hero Card (Spans 7 Cols) --}}
                @php $house = $services->firstWhere('slug', 'house-shifting') ?? $services->first(); @endphp
                @if ($house)
                    <div
                        class="group relative flex flex-col justify-between overflow-hidden rounded-3xl border border-white/20 bg-slate-900 p-8 sm:p-10 shadow-2xl transition-all duration-500 hover:-translate-y-1.5 hover:border-white/35 lg:col-span-7 min-h-[440px]">
                        {{-- Background Image --}}
                        <img src="{{ asset($house->image) }}" alt="{{ $house->name }}" loading="lazy" decoding="async"
                            class="absolute inset-0 h-full w-full object-cover opacity-60 transition-transform duration-700 ease-out group-hover:scale-105" />
                        <div class="absolute inset-0 bg-gradient-to-t from-[#06152b] via-[#06152b]/55 to-transparent">
                        </div>
                        <div
                            class="absolute inset-0 bg-gradient-to-r from-[#06152b]/85 via-[#06152b]/30 to-transparent">
                        </div>

                        {{-- Top Header Badges --}}
                        <div class="relative z-10 flex items-center justify-between">
                            <span
                                class="inline-flex items-center gap-2 rounded-full border border-white/20 bg-black/40 px-3.5 py-1 text-xs font-bold text-white/90 backdrop-blur-md">
                                <span class="h-2 w-2 rounded-full bg-sky-400"></span>
                                Primary Service
                            </span>

                            <div
                                class="flex h-12 w-12 items-center justify-center rounded-2xl border border-white/20 bg-white/10 text-white backdrop-blur-md shadow-lg transition-transform duration-300 group-hover:scale-110 group-hover:bg-white group-hover:text-[#0c2f66]">
                                <x-icon :name="$house->icon" class="h-6 w-6" />
                            </div>
                        </div>

                        {{-- Bottom Editorial Card --}}
                        <div class="relative z-10 mt-28">
                            <p class="text-xs font-black uppercase tracking-[0.2em] text-sky-300">
                                Household Relocation
                            </p>
                            <h3 class="mt-2 text-2xl sm:text-3xl lg:text-4xl font-black tracking-tight text-white">
                                {{ $house->name }}
                            </h3>
                            <p class="mt-3 max-w-xl text-sm leading-relaxed text-slate-200">
                                {{ $house->excerpt }}
                            </p>

                            {{-- Feature Chips --}}
                            <div class="mt-5 flex flex-wrap gap-2 text-xs font-semibold text-white/90">
                                <span class="rounded-lg bg-white/10 px-3 py-1 border border-white/15 backdrop-blur-sm">
                                    ✓ 5-Ply Defensive Packing
                                </span>
                                <span class="rounded-lg bg-white/10 px-3 py-1 border border-white/15 backdrop-blur-sm">
                                    ✓ Room-by-Room Setup
                                </span>
                                <span class="rounded-lg bg-white/10 px-3 py-1 border border-white/15 backdrop-blur-sm">
                                    ✓ Verified Moving Crew
                                </span>
                            </div>

                            {{-- CTA Button --}}
                            <div class="mt-6 pt-5 border-t border-white/15 flex items-center justify-between">
                                <a href="{{ route('services.show', $house) }}"
                                    class="inline-flex items-center gap-2 rounded-full bg-white px-5 py-2.5 text-xs font-black text-[#0c2f66] shadow-lg transition hover:bg-sky-50 hover:scale-105">
                                    <span>Explore Complete Plan</span>
                                    <x-icon name="arrow-right" class="h-3.5 w-3.5" />
                                </a>
                                <span class="text-xs font-bold text-sky-200">Free In-Home Survey</span>
                            </div>
                        </div>
                    </div>
                @endif

                {{-- Stacked Right Column (5 Cols) --}}
                <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-1 lg:col-span-5">

                    {{-- 02. OFFICE SHIFTING --}}
                    @php $office = $services->firstWhere('slug', 'office-shifting'); @endphp
                    @if ($office)
                        <div
                            class="group relative flex flex-col justify-between overflow-hidden rounded-3xl border border-white/20 bg-slate-900 p-7 shadow-xl transition-all duration-500 hover:-translate-y-1.5 hover:border-white/35 min-h-[210px]">
                            <img src="{{ asset($office->image) }}" alt="{{ $office->name }}" loading="lazy"
                                decoding="async"
                                class="absolute inset-0 h-full w-full object-cover opacity-45 transition-transform duration-700 ease-out group-hover:scale-110" />
                            <div
                                class="absolute inset-0 bg-gradient-to-r from-[#06152b] via-[#06152b]/80 to-transparent">
                            </div>

                            <div class="relative z-10 flex items-center justify-between">
                                <span class="text-[11px] font-black uppercase tracking-wider text-sky-300">Commercial
                                    Relocation</span>
                                <div
                                    class="flex h-10 w-10 items-center justify-center rounded-xl border border-white/20 bg-white/10 text-white backdrop-blur-md">
                                    <x-icon :name="$office->icon" class="h-5 w-5" />
                                </div>
                            </div>

                            <div class="relative z-10 mt-6">
                                <h3 class="text-xl font-black text-white tracking-tight">{{ $office->name }}</h3>
                                <p class="mt-1.5 line-clamp-2 text-xs leading-relaxed text-slate-300">
                                    {{ $office->excerpt }}</p>
                                <a href="{{ route('services.show', $office) }}"
                                    class="mt-4 inline-flex items-center gap-1.5 text-xs font-bold text-sky-300 transition hover:text-white">
                                    <span>Zero-Downtime Weekend Moves</span>
                                    <span>→</span>
                                </a>
                            </div>
                        </div>
                    @endif

                    {{-- 03. LOCAL CITY SHIFTING (High-Contrast White Card) --}}
                    @php $local = $services->firstWhere('slug', 'local-shifting'); @endphp
                    @if ($local)
                        <div
                            class="group relative flex flex-col justify-between overflow-hidden rounded-3xl bg-white p-7 shadow-xl transition-all duration-500 hover:-translate-y-1.5 hover:shadow-2xl min-h-[210px]">
                            <div class="flex items-center justify-between">
                                <span
                                    class="inline-flex items-center gap-1 rounded-full bg-blue-50 px-2.5 py-0.5 text-[11px] font-bold text-[#144b9e]">
                                    Same-Day Move
                                </span>
                                <div
                                    class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-50 text-[#144b9e] transition-colors group-hover:bg-[#144b9e] group-hover:text-white">
                                    <x-icon :name="$local->icon" class="h-5 w-5" />
                                </div>
                            </div>

                            <div class="mt-6">
                                <h3 class="text-xl font-black text-slate-900 tracking-tight">{{ $local->name }}</h3>
                                <p class="mt-1.5 line-clamp-2 text-xs leading-relaxed text-slate-600">
                                    {{ $local->excerpt }}</p>
                                <a href="{{ route('services.show', $local) }}"
                                    class="mt-4 inline-flex items-center gap-1.5 text-xs font-bold text-[#144b9e] transition hover:text-blue-700">
                                    <span>Dedicated City Vehicles</span>
                                    <span>→</span>
                                </a>
                            </div>
                        </div>
                    @endif

                </div>
            </div>

            {{-- Bento Row 2: 3 Balanced Anchor Tiles (4 Cols Each) --}}
            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">

                {{-- 04. PACKING SERVICES (Frosted Blue Glass Accent) --}}
                @php $packing = $services->firstWhere('slug', 'packing-services'); @endphp
                @if ($packing)
                    <div
                        class="group relative flex flex-col justify-between overflow-hidden rounded-3xl border border-white/20 bg-white/10 p-7 text-white backdrop-blur-md transition-all duration-500 hover:-translate-y-1.5 hover:bg-white/15 min-h-[250px]">
                        <div class="flex items-center justify-between">
                            <span class="text-xs font-black uppercase tracking-wider text-sky-200">5-Ply
                                Protection</span>
                            <div
                                class="flex h-10 w-10 items-center justify-center rounded-xl border border-white/20 bg-white/10 text-white backdrop-blur-md transition-colors group-hover:bg-white group-hover:text-[#0c2f66]">
                                <x-icon :name="$packing->icon" class="h-5 w-5" />
                            </div>
                        </div>

                        <div class="mt-8">
                            <h3 class="text-lg font-black tracking-tight text-white">{{ $packing->name }}</h3>
                            <p class="mt-2 line-clamp-2 text-xs leading-relaxed text-white/70">{{ $packing->excerpt }}
                            </p>
                            <a href="{{ route('services.show', $packing) }}"
                                class="mt-5 inline-flex items-center gap-1.5 text-xs font-bold text-sky-300 hover:text-white transition-colors">
                                <span>Bubble wrap, crates &amp; cartons</span>
                                <span>→</span>
                            </a>
                        </div>
                    </div>
                @endif

                {{-- 05. TWO WHEELER SHIFTING (Light Card) --}}
                @php $bike = $services->firstWhere('slug', 'two-wheeler-shifting'); @endphp
                @if ($bike)
                    <div
                        class="group relative flex flex-col justify-between overflow-hidden rounded-3xl bg-white p-7 shadow-xl transition-all duration-500 hover:-translate-y-1.5 hover:shadow-2xl min-h-[250px]">
                        <div class="flex items-center justify-between">
                            <span
                                class="inline-flex items-center gap-1 rounded-full bg-emerald-50 px-2.5 py-0.5 text-[11px] font-bold text-emerald-700">
                                Scratch-Free Guarantee
                            </span>
                            <div
                                class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-50 text-[#144b9e] transition-colors group-hover:bg-[#144b9e] group-hover:text-white">
                                <x-icon :name="$bike->icon" class="h-5 w-5" />
                            </div>
                        </div>

                        <div class="mt-8">
                            <h3 class="text-lg font-black text-slate-900 tracking-tight">{{ $bike->name }}</h3>
                            <p class="mt-2 line-clamp-2 text-xs leading-relaxed text-slate-600">{{ $bike->excerpt }}
                            </p>
                            <a href="{{ route('services.show', $bike) }}"
                                class="mt-5 inline-flex items-center gap-1.5 text-xs font-bold text-[#144b9e] hover:text-blue-700 transition-colors">
                                <span>Enclosed stand packaging</span>
                                <span>→</span>
                            </a>
                        </div>
                    </div>
                @endif

                {{-- 06. INTERCITY & DOMESTIC MOVERS --}}
                @php $domestic = $services->firstWhere('slug', 'domestic-movers') ?? $services->firstWhere('slug', 'relocation-service'); @endphp
                @if ($domestic)
                    <div
                        class="group relative flex flex-col justify-between overflow-hidden rounded-3xl border border-white/20 bg-slate-900 p-7 shadow-xl transition-all duration-500 hover:-translate-y-1.5 hover:border-white/35 min-h-[250px]">
                        <img src="{{ asset($domestic->image) }}" alt="{{ $domestic->name }}" loading="lazy"
                            decoding="async"
                            class="absolute inset-0 h-full w-full object-cover opacity-45 transition-transform duration-700 ease-out group-hover:scale-110" />
                        <div class="absolute inset-0 bg-gradient-to-t from-[#06152b] via-[#06152b]/80 to-transparent">
                        </div>

                        <div class="relative z-10 flex items-center justify-between">
                            <span class="text-xs font-black uppercase tracking-wider text-sky-300">Pan-India
                                Transit</span>
                            <div
                                class="flex h-10 w-10 items-center justify-center rounded-xl border border-white/20 bg-white/10 text-white backdrop-blur-md">
                                <x-icon :name="$domestic->icon" class="h-5 w-5" />
                            </div>
                        </div>

                        <div class="relative z-10 mt-8">
                            <h3 class="text-lg font-black text-white tracking-tight">{{ $domestic->name }}</h3>
                            <p class="mt-2 line-clamp-2 text-xs leading-relaxed text-slate-300">
                                {{ $domestic->excerpt }}</p>
                            <a href="{{ route('services.show', $domestic) }}"
                                class="mt-5 inline-flex items-center gap-1.5 text-xs font-bold text-sky-300 hover:text-white transition-colors">
                                <span>Real-time GPS tracking</span>
                                <span>→</span>
                            </a>
                        </div>
                    </div>
                @endif

            </div>

        </div>

        {{-- ================================================================
             ALL 12 SERVICES QUICK ACCESS BAR
             Lets visitors jump to ANY of the 12 services directly without crowding
             ================================================================ --}}
        <div class="mt-12 rounded-3xl border border-white/15 bg-white/5 p-6 backdrop-blur-md">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                <div>
                    <h4 class="text-sm font-bold text-white uppercase tracking-wider flex items-center gap-2">
                        <span class="h-2 w-2 rounded-full bg-sky-400"></span>
                        Looking for all 12 specialized services?
                    </h4>
                    <p class="text-xs text-white/60 mt-0.5">
                        Direct links to each individual relocation service, pricing and checklist.
                    </p>
                </div>

                <a href="{{ route('services.index') }}"
                    class="inline-flex items-center gap-2 text-xs font-bold text-sky-300 hover:text-white transition">
                    <span>Explore Full Directory</span>
                    <x-icon name="arrow-right" class="h-3.5 w-3.5" />
                </a>
            </div>

            <div class="mt-4 flex flex-wrap gap-2 pt-4 border-t border-white/10">
                @foreach ($services as $srv)
                    <a href="{{ route('services.show', $srv) }}"
                        class="inline-flex items-center gap-1.5 rounded-full border border-white/10 bg-white/5 px-3 py-1.5 text-xs font-medium text-white/80 transition hover:border-sky-300 hover:bg-white/15 hover:text-white">
                        <x-icon :name="$srv->icon" class="h-3.5 w-3.5 text-sky-300" />
                        <span>{{ $srv->name }}</span>
                    </a>
                @endforeach
            </div>
        </div>

        {{-- ================================================================
             BOTTOM CONVERSION CTA BANNER
             ================================================================ --}}
        <div
            class="mt-10 rounded-3xl border border-white/20 bg-gradient-to-r from-blue-600/40 via-sky-500/20 to-white/10 p-7 sm:p-9 text-white backdrop-blur-xl shadow-2xl">
            <div class="flex flex-col gap-6 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <span
                        class="inline-flex items-center gap-2 rounded-full border border-sky-300/30 bg-sky-400/20 px-3.5 py-1 text-xs font-bold uppercase tracking-wider text-sky-200">
                        Custom Requirements?
                    </span>
                    <h3 class="mt-3 text-2xl font-black tracking-tight sm:text-3xl lg:text-4xl">
                        Need a tailored moving solution?
                    </h3>
                    <p class="mt-2 text-sm text-white/70 max-w-xl">
                        Whether it is an intercity industrial shipment, high-rise home relocation, or single fragile
                        antique move, our specialists craft an exact plan with fixed quotes.
                    </p>
                </div>

                <div class="flex flex-wrap items-center gap-3.5">
                    <a href="{{ route('contact') }}#get-a-quote"
                        class="inline-flex items-center gap-2 rounded-full bg-white px-7 py-3.5 text-xs font-black text-[#0c2f66] shadow-xl transition-all duration-300 hover:bg-sky-50 hover:scale-105">
                        <span>Get Free Moving Estimate</span>
                        <x-icon name="arrow-right" class="h-3.5 w-3.5 text-[#144b9e]" />
                    </a>

                    <a href="tel:{{ $site['phone_e164'] }}"
                        class="inline-flex items-center gap-2 rounded-full border border-white/30 bg-white/10 px-6 py-3.5 text-xs font-bold text-white transition hover:bg-white/20">
                        <x-icon name="phone" class="h-3.5 w-3.5 text-sky-300" />
                        <span>Call {{ $site['phone_display'] }}</span>
                    </a>
                </div>
            </div>
        </div>

    </div>
</section>
