{{-- =========================================================================
     OUR NETWORK OVER TAMILNADU: Primary City Hubs + Complete 25-City Grid
     ========================================================================= --}}
<section class="relative overflow-hidden bg-white py-24 sm:py-28 lg:py-32" id="locations">

    {{-- Subtle ambient glow --}}
    <div class="pointer-events-none absolute inset-0 -z-10 overflow-hidden" aria-hidden="true">
        <div class="absolute -left-20 top-1/2 h-80 w-80 -translate-y-1/2 rounded-full bg-[#144b9e]/[0.025] blur-3xl"></div>
    </div>

    <div class="container-page">
        
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
            <div class="max-w-2xl">
                <div class="inline-flex items-center gap-2 rounded-full border border-[#144b9e]/20 bg-[#144b9e]/5 px-4 py-1.5 backdrop-blur-sm">
                    <span class="h-2 w-2 rounded-full bg-[#144b9e]"></span>
                    <span class="text-xs font-bold uppercase tracking-[0.16em] text-[#144b9e]">
                        Regional Network Coverage
                    </span>
                </div>

                <h2 class="mt-5 text-3xl font-black tracking-tight text-[#081b35] sm:text-4xl md:text-5xl">
                    Our Network Across <span class="text-[#144b9e]">Tamil Nadu &amp; South India</span>
                </h2>

                <p class="mt-4 text-base leading-relaxed text-slate-600 sm:text-lg">
                    Dedicated moving routes connecting all major towns and cities across Tamil Nadu and Bangalore with verified in-house teams.
                </p>
            </div>

            <div class="shrink-0">
                <a href="{{ route('locations.index') }}"
                    class="group inline-flex items-center justify-center gap-2 rounded-full border border-slate-200 bg-white px-7 py-3.5 text-sm font-semibold text-[#081b35] shadow-sm transition-all duration-200 hover:-translate-y-0.5 hover:border-[#144b9e]/40 hover:bg-[#144b9e]/5 hover:text-[#144b9e]">
                    <span>View All Locations Hub</span>
                    <x-icon name="arrow-right" class="w-4 h-4 text-[#144b9e] transition group-hover:translate-x-1" />
                </a>
            </div>
        </div>

        {{-- Primary Core City Hubs (Tier 1 Priority) --}}
        <div class="mt-14 grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($primaryLocations as $loc)
                <div class="rounded-3xl border border-slate-200/90 bg-[#f6f8fc] p-8 shadow-sm flex flex-col justify-between transition-all duration-300 hover:border-[#144b9e]/30 hover:bg-white hover:shadow-xl hover:shadow-[#144b9e]/10 group">
                    <div>
                        <div class="flex items-center justify-between">
                            <span class="inline-flex h-12 w-12 items-center justify-center rounded-2xl bg-[#144b9e]/10 text-[#144b9e] transition duration-300 group-hover:bg-[#144b9e] group-hover:text-white shadow-sm">
                                <x-icon name="pin" class="w-6 h-6" />
                            </span>
                            <span class="inline-flex items-center gap-1.5 rounded-full bg-[#144b9e]/10 px-3 py-1 text-xs font-bold text-[#144b9e]">
                                <span class="h-1.5 w-1.5 rounded-full bg-[#144b9e]"></span>
                                Primary Hub
                            </span>
                        </div>

                        <h3 class="mt-6 text-xl font-bold text-[#081b35] group-hover:text-[#144b9e] transition duration-200">
                            Packers and Movers in {{ $loc->name }}
                        </h3>

                        <p class="mt-3 text-sm text-slate-600 leading-relaxed line-clamp-3">
                            {{ $loc->excerpt }}
                        </p>
                    </div>

                    <div class="mt-8 pt-5 border-t border-slate-200/80 flex items-center justify-between">
                        <a href="{{ route('locations.show', $loc) }}"
                           class="inline-flex items-center gap-2 text-sm font-bold text-[#144b9e] transition group-hover:gap-3">
                            <span>Explore {{ $loc->name }} Rates</span>
                            <x-icon name="arrow-right" class="w-4 h-4 transition group-hover:translate-x-1" />
                        </a>
                        <span class="text-xs text-slate-400 font-medium">Local &amp; Outstation</span>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Complete Regional Network (Original 25 Cities) --}}
        <div class="mt-14 rounded-[2rem] border border-slate-200/90 bg-[#f6f8fc] p-8 sm:p-10 shadow-sm">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-b border-slate-200/90 pb-6">
                <div>
                    <h3 class="text-lg sm:text-xl font-black text-[#081b35]">
                        Our Full Network Coverage ({{ $allLocations->count() }} Cities &amp; Towns)
                    </h3>
                    <p class="mt-1 text-xs sm:text-sm text-slate-600">
                        Click any town or city below for direct local service rates and instant booking.
                    </p>
                </div>

                {{-- Live Quick Filter Input --}}
                <div class="relative max-w-xs w-full">
                    <input type="text" data-location-filter
                           placeholder="Search city (e.g. Salem, Karur)..."
                           class="w-full rounded-full border border-slate-200 bg-white px-4 py-2.5 pl-10 text-xs font-medium text-[#081b35] outline-none transition focus:border-[#144b9e] focus:ring-4 focus:ring-[#144b9e]/10 shadow-sm">
                    <span class="absolute left-3.5 top-3 text-slate-400">
                        <x-icon name="pin" class="w-4 h-4" />
                    </span>
                </div>
            </div>

            {{-- All City Chips (All 25 Location links with sparkle emoji) --}}
            <ul class="mt-7 flex flex-wrap gap-3" data-location-list>
                @foreach ($allLocations as $loc)
                    <li data-city-name="{{ strtolower($loc->name) }}">
                        <a href="{{ route('locations.show', $loc) }}"
                           class="inline-flex items-center gap-2 rounded-full border border-slate-200/90 bg-white px-4 py-2.5 text-xs font-semibold text-slate-700 shadow-sm transition-all duration-200 hover:-translate-y-0.5 hover:border-[#144b9e]/40 hover:bg-[#144b9e]/5 hover:text-[#144b9e]">
                            <span class="text-[#144b9e]">📍</span>
                            <span>Packers and Movers in {{ $loc->name }}</span>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>

    </div>
</section>

