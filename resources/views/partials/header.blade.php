@php
    $site = config('site');
    $route = Route::currentRouteName();

    $nav = [
        ['name' => 'home', 'label' => 'Home', 'url' => route('home')],
        ['name' => 'about', 'label' => 'About Us', 'url' => route('about')],
        ['name' => 'services.index', 'label' => 'Services', 'url' => route('services.index'), 'children' => true],
        ['name' => 'locations.index', 'label' => 'Locations', 'url' => route('locations.index'), 'children' => true],
        ['name' => 'gallery', 'label' => 'Gallery', 'url' => route('gallery')],
        ['name' => 'testimonials', 'label' => 'Reviews', 'url' => route('testimonials')],
        ['name' => 'blog.index', 'label' => 'Blog', 'url' => route('blog.index')],
        ['name' => 'contact', 'label' => 'Contact', 'url' => route('contact')],
    ];

    $active = match (true) {
        str_starts_with((string) $route, 'services') => 'services.index',
        str_starts_with((string) $route, 'locations') => 'locations.index',
        str_starts_with((string) $route, 'blog') => 'blog.index',
        default => $route,
    };

    $topLocations = \App\Models\Location::active()->primary()->limit(6)->get();
@endphp


<header data-sticky-header class="sticky top-0 z-50 border-b border-slate-100 bg-white">

    <div class="container-page">

        <div class="flex h-[82px] items-center">

            {{-- =================================================
                LOGO BLOCK
            ================================================== --}}
            <a href="{{ route('home') }}" class="group flex shrink-0 items-center" aria-label="{{ $site['name'] }} — home">
                <img src="{{ asset('images/nxtlo.webp') }}" alt="{{ $site['name'] }}" width="180" height="48"
                    class="h-11 w-auto transition-transform duration-200 group-hover:scale-[1.02]">
            </a>


            {{-- Vertical divider --}}
            <div class="mx-7 hidden h-9 w-px bg-slate-200 xl:block"></div>


            {{-- =================================================
                NAVIGATION
            ================================================== --}}
            <nav class="hidden flex-1 items-center xl:flex" aria-label="Main navigation">

                @foreach ($nav as $item)

                    @if ($item['children'] ?? false)
                        <div class="group relative">

                            <a href="{{ $item['url'] }}" @class([
                                'relative inline-flex items-center gap-1.5 px-4 py-3 text-[13px] font-semibold transition',
                                'text-[#144b9e]' => $active === $item['name'],
                                'text-slate-600 hover:text-[#144b9e]' => $active !== $item['name'],
                            ])>
                                {{ $item['label'] }}

                                <x-icon name="chevron-down"
                                    class="h-3.5 w-3.5 transition-transform duration-200 group-hover:rotate-180" />

                                @if ($active === $item['name'])
                                    <span
                                        class="absolute bottom-0 left-4 right-4 h-0.5 rounded-full bg-[#144b9e]"></span>
                                @endif
                            </a>


                            {{-- Dropdown --}}
                            <div
                                class="invisible absolute left-0 top-full w-72 pt-4 opacity-0 transition-all duration-200 group-hover:visible group-hover:opacity-100 group-focus-within:visible group-focus-within:opacity-100">
                                <div
                                    class="rounded-2xl border border-slate-100 bg-white p-2 shadow-[0_20px_50px_rgba(15,23,42,0.12)]">

                                    @if ($item['name'] === 'services.index')
                                        @foreach (\App\Models\Service::active()->ordered()->get() as $s)
                                            <a href="{{ route('services.show', $s) }}"
                                                class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm text-slate-600 transition hover:bg-[#144b9e]/5 hover:text-[#144b9e]">
                                                <span
                                                    class="flex h-8 w-8 items-center justify-center rounded-lg bg-[#144b9e]/10">
                                                    <x-icon :name="$s->icon" class="h-4 w-4 text-[#144b9e]" />
                                                </span>

                                                {{ $s->name }}
                                            </a>
                                        @endforeach

                                        <a href="{{ route('services.index') }}"
                                            class="mt-1 flex items-center justify-center gap-2 rounded-xl bg-[#144b9e] px-3 py-2.5 text-xs font-bold text-white">
                                            View All Services
                                            <x-icon name="arrow-right" class="h-3.5 w-3.5" />
                                        </a>
                                    @else
                                        @foreach ($topLocations as $loc)
                                            <a href="{{ route('locations.show', $loc) }}"
                                                class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm text-slate-600 transition hover:bg-[#144b9e]/5 hover:text-[#144b9e]">
                                                <span
                                                    class="flex h-8 w-8 items-center justify-center rounded-lg bg-[#144b9e]/10">
                                                    <x-icon name="pin" class="h-4 w-4 text-[#144b9e]" />
                                                </span>

                                                {{ $loc->name }}
                                            </a>
                                        @endforeach

                                        <a href="{{ route('locations.index') }}"
                                            class="mt-1 flex items-center justify-center gap-2 rounded-xl bg-[#144b9e] px-3 py-2.5 text-xs font-bold text-white">
                                            View All Locations
                                            <x-icon name="arrow-right" class="h-3.5 w-3.5" />
                                        </a>
                                    @endif

                                </div>
                            </div>

                        </div>
                    @else
                        <a href="{{ $item['url'] }}" @class([
                            'relative px-4 py-3 text-[13px] font-semibold transition',
                            'text-[#144b9e]' => $active === $item['name'],
                            'text-slate-600 hover:text-[#144b9e]' => $active !== $item['name'],
                        ])>
                            {{ $item['label'] }}

                            @if ($active === $item['name'])
                                <span class="absolute bottom-0 left-4 right-4 h-0.5 rounded-full bg-[#144b9e]"></span>
                            @endif
                        </a>
                    @endif

                @endforeach

            </nav>


            {{-- =================================================
                RIGHT SIDE
            ================================================== --}}
            <div class="ml-auto flex items-center gap-3">

                {{-- Phone --}}
                <a href="tel:{{ $site['phone_e164'] }}" class="hidden items-center gap-2 text-right lg:flex">
                    <span class="flex h-9 w-9 items-center justify-center rounded-full bg-[#144b9e]/10 text-[#144b9e]">
                        <x-icon name="phone" class="h-4 w-4" />
                    </span>

                    <span class="hidden xl:block">
                        <span class="block text-[10px] font-medium uppercase tracking-wider text-slate-400">
                            Call Us
                        </span>

                        <span class="block text-xs font-bold text-slate-700">
                            {{ $site['phone_display'] }}
                        </span>
                    </span>
                </a>


                {{-- Quote --}}
                <a href="{{ route('contact') }}#get-a-quote"
                    class="hidden h-11 items-center gap-2 rounded-full bg-[#144b9e] px-5 text-xs font-bold text-white shadow-md shadow-[#144b9e]/20 transition hover:-translate-y-0.5 hover:bg-[#103d80] md:inline-flex">
                    Get a Quote

                    <x-icon name="arrow-up-right" class="h-4 w-4" />
                </a>


                {{-- Mobile menu --}}
                <button type="button" data-nav-open
                    class="inline-flex h-11 w-11 items-center justify-center rounded-xl bg-[#144b9e] text-white transition hover:bg-[#103d80] xl:hidden"
                    aria-label="Open menu" aria-controls="mobile-nav" aria-expanded="false">
                    <x-icon name="menu" class="h-5 w-5" />
                </button>

            </div>

        </div>

    </div>


    {{-- =========================================================
        MOBILE DRAWER
    ========================================================== --}}
    <div id="mobile-nav" data-nav-panel aria-hidden="true" class="fixed inset-0 z-[60] hidden xl:hidden">

        <div class="absolute inset-0 bg-slate-950/60 backdrop-blur-sm" data-nav-close></div>

        <div class="absolute inset-y-0 right-0 flex w-full max-w-sm flex-col bg-white shadow-2xl">

            <div class="flex h-20 items-center justify-between border-b border-slate-100 px-6">

                <img src="{{ asset('images/nxtlo.webp') }}" alt="{{ $site['name'] }}" width="150" height="40"
                    class="h-9 w-auto">

                <button type="button" data-nav-close
                    class="flex h-10 w-10 items-center justify-center rounded-full bg-slate-100 text-slate-700 transition hover:bg-[#144b9e]/10 hover:text-[#144b9e]"
                    aria-label="Close menu">
                    <x-icon name="close" class="h-5 w-5" />
                </button>

            </div>

            <div class="flex-1 overflow-y-auto px-5 py-6">

                @foreach ($nav as $item)
                    <a href="{{ $item['url'] }}" @class([
                        'mb-1 flex items-center justify-between rounded-xl px-4 py-4 text-[15px] font-semibold transition',
                        'bg-[#144b9e]/10 text-[#144b9e]' => $active === $item['name'],
                        'text-slate-700 hover:bg-slate-50' => $active !== $item['name'],
                    ])>
                        {{ $item['label'] }}

                        <x-icon name="chevron-right" class="h-4 w-4 opacity-40" />
                    </a>
                @endforeach

            </div>

            <div class="border-t border-slate-100 p-5">

                <a href="{{ route('contact') }}#get-a-quote"
                    class="flex h-13 w-full items-center justify-center gap-2 rounded-xl bg-[#144b9e] text-sm font-bold text-white">
                    Get a Free Quote

                    <x-icon name="arrow-right" class="h-4 w-4" />
                </a>

                <a href="tel:{{ $site['phone_e164'] }}"
                    class="mt-3 flex h-13 w-full items-center justify-center gap-2 rounded-xl border border-slate-200 text-sm font-semibold text-slate-700">
                    <x-icon name="phone" class="h-4 w-4 text-[#144b9e]" />
                    {{ $site['phone_display'] }}
                </a>

            </div>

        </div>

    </div>

</header>
