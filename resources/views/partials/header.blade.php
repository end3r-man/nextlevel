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

                <a href="https://www.youtube.com/@nextlevelpackersandmovers" target="_blank"
                    class="max-md:flex hidden size-11 items-center justify-center rounded-xl bg-[#144b9e] text-xs font-bold text-white shadow-md shadow-[#144b9e]/20 transition hover:-translate-y-0.5 hover:bg-[#103d80]">
                    <svg xmlns="http://www.w3.org/2000/svg" class="size-8" viewBox="0 0 24 24">
                        <path d="M0 0h24v24H0z" fill="none" />
                        <g fill="currentColor" fill-rule="evenodd" clip-rule="evenodd">
                            <path
                                d="M10.386 8.357A.75.75 0 0 0 9.25 9v6a.75.75 0 0 0 1.136.643l5-3a.75.75 0 0 0 0-1.286zM13.542 12l-2.792 1.675v-3.35z" />
                            <path
                                d="M17.03 4.641a64.5 64.5 0 0 0-10.06 0l-2.241.176a2.975 2.975 0 0 0-2.703 2.475a28.6 28.6 0 0 0 0 9.416a2.975 2.975 0 0 0 2.703 2.475l2.24.176c3.349.262 6.713.262 10.062 0l2.24-.176a2.975 2.975 0 0 0 2.703-2.475c.52-3.117.52-6.299 0-9.416a2.975 2.975 0 0 0-2.703-2.475zM7.087 6.137a63 63 0 0 1 9.828 0l2.24.175c.676.053 1.229.56 1.34 1.228a27 27 0 0 1 0 8.92a1.475 1.475 0 0 1-1.34 1.228l-2.24.175a63 63 0 0 1-9.828 0l-2.24-.175a1.475 1.475 0 0 1-1.34-1.228a27 27 0 0 1 0-8.92a1.475 1.475 0 0 1 1.34-1.228z" />
                        </g>
                    </svg>

                </a>

                <a href="https://www.instagram.com/next_level_packers_" target="_blank"
                    class="max-md:flex hidden size-11 items-center justify-center rounded-xl bg-[#144b9e] text-xs font-bold text-white shadow-md shadow-[#144b9e]/20 transition hover:-translate-y-0.5 hover:bg-[#103d80]">
                    <svg xmlns="http://www.w3.org/2000/svg" class="size-5" viewBox="0 0 24 24">
                        <path d="M0 0h24v24H0z" fill="none" />
                        <path fill="currentColor" fill-rule="evenodd"
                            d="M7.465 1.066C8.638 1.012 9.012 1 12 1s3.362.013 4.534.066s1.972.24 2.672.511c.733.277 1.398.71 1.948 1.27c.56.549.992 1.213 1.268 1.947c.272.7.458 1.5.512 2.67C22.988 8.639 23 9.013 23 12s-.013 3.362-.066 4.535c-.053 1.17-.24 1.97-.512 2.67a5.4 5.4 0 0 1-1.268 1.949c-.55.56-1.215.992-1.948 1.268c-.7.272-1.5.458-2.67.512c-1.174.054-1.548.066-4.536.066s-3.362-.013-4.535-.066c-1.17-.053-1.97-.24-2.67-.512a5.4 5.4 0 0 1-1.949-1.268a5.4 5.4 0 0 1-1.269-1.948c-.271-.7-.457-1.5-.511-2.67C1.012 15.361 1 14.987 1 12s.013-3.362.066-4.534s.24-1.972.511-2.672a5.4 5.4 0 0 1 1.27-1.948a5.4 5.4 0 0 1 1.947-1.269c.7-.271 1.5-.457 2.67-.511m8.98 1.98c-1.16-.053-1.508-.064-4.445-.064s-3.285.011-4.445.064c-1.073.049-1.655.228-2.043.379c-.513.2-.88.437-1.265.822a3.4 3.4 0 0 0-.822 1.265c-.151.388-.33.97-.379 2.043c-.053 1.16-.064 1.508-.064 4.445s.011 3.285.064 4.445c.049 1.073.228 1.655.379 2.043c.176.477.457.91.822 1.265c.355.365.788.646 1.265.822c.388.151.97.33 2.043.379c1.16.053 1.507.064 4.445.064s3.285-.011 4.445-.064c1.073-.049 1.655-.228 2.043-.379c.513-.2.88-.437 1.265-.822c.365-.355.646-.788.822-1.265c.151-.388.33-.97.379-2.043c.053-1.16.064-1.508.064-4.445s-.011-3.285-.064-4.445c-.049-1.073-.228-1.655-.379-2.043c-.2-.513-.437-.88-.822-1.265a3.4 3.4 0 0 0-1.265-.822c-.388-.151-.97-.33-2.043-.379m-5.85 12.345a3.669 3.669 0 0 0 4-5.986a3.67 3.67 0 1 0-4 5.986M8.002 8.002a5.654 5.654 0 1 1 7.996 7.996a5.654 5.654 0 0 1-7.996-7.996m10.906-.814a1.337 1.337 0 1 0-1.89-1.89a1.337 1.337 0 0 0 1.89 1.89"
                            clip-rule="evenodd" />
                    </svg>
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
