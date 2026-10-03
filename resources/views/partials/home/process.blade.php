@php
    $site = config('site');
@endphp

{{-- =========================================================================
     PROCESS SECTION: 3-Step Simple & Reliable Moving Journey
     Interactive visual timeline matching Hero and Bento design aesthetics
     ========================================================================= --}}
<section class="relative isolate overflow-hidden bg-slate-50/80 py-24 sm:py-28 lg:py-32" id="process">

    {{-- ================================================================
         ATMOSPHERIC BACKGROUND & ROUTE ACCENTS
         ================================================================ --}}
    <div class="pointer-events-none absolute inset-0 -z-10 overflow-hidden select-none" aria-hidden="true">
        {{-- Soft Glows --}}
        <div class="absolute -top-32 right-1/4 h-[500px] w-[700px] rounded-full bg-blue-100/60 blur-[130px]"></div>
        <div class="absolute -bottom-32 left-1/4 h-[550px] w-[800px] rounded-full bg-sky-100/60 blur-[140px]"></div>

        {{-- Subtle Grid Pattern --}}
        <div class="absolute inset-0 opacity-[0.3]"
            style="background-image: radial-gradient(circle, #cbd5e1 1px, transparent 1px); background-size: 28px 28px;">
        </div>

        {{-- Giant Watermark Typography --}}
        <div
            class="absolute -right-6 top-1/2 -translate-y-1/2 text-[14rem] font-black tracking-tighter text-slate-200/35 sm:text-[18rem] lg:text-[22rem] select-none">
            03
        </div>
    </div>

    <div class="container mx-auto px-4 sm:px-6 lg:px-8">

        {{-- ================================================================
             SECTION HEADER
             ================================================================ --}}
        <div class="mx-auto max-w-3xl text-center">
            {{-- Category Pill Badge --}}
            <div
                class="inline-flex items-center gap-2.5 rounded-full border border-blue-200 bg-blue-50/90 px-4 py-1.5 text-xs font-bold uppercase tracking-[0.2em] text-[#144b9e] shadow-sm">
                <span class="relative flex h-2 w-2">
                    <span class="absolute inline-flex h-full w-full animate-ping rounded-full bg-blue-400 opacity-75"></span>
                    <span class="relative inline-flex h-2 w-2 rounded-full bg-[#144b9e]"></span>
                </span>
                <span>The Moving Journey</span>
            </div>

            {{-- Main Headline --}}
            <h2 class="mt-6 text-3xl font-black tracking-tight text-slate-900 sm:text-5xl lg:text-6xl leading-[1.1]">
                Relocation made simple in <br />
                <span class="text-[#144b9e]">3 proven steps.</span>
            </h2>

            <p class="mx-auto mt-4 max-w-2xl text-base text-slate-600 sm:text-lg leading-relaxed">
                From your initial survey to final room placement and reassembly, our certified full-time crew delivers complete peace of mind at every milestone.
            </p>
        </div>

        {{-- ================================================================
             3-STEP TIMELINE CARDS
             Connected with visual route trajectory on desktop
             ================================================================ --}}
        <div class="relative mt-16 sm:mt-20">

            {{-- Decorative Connecting Route Line (Desktop Only) --}}
            <div class="hidden lg:block absolute top-1/2 left-[15%] right-[15%] -translate-y-12 h-0.5 border-t-2 border-dashed border-blue-200 -z-0" aria-hidden="true"></div>

            <div class="grid gap-8 lg:grid-cols-3 relative z-10">

                {{-- ------------------------------------------------------------
                     STEP 01: SURVEY & ESTIMATE
                     ------------------------------------------------------------ --}}
                <div
                    class="group relative flex flex-col justify-between rounded-3xl border border-slate-200/90 bg-white p-8 sm:p-9 shadow-xl shadow-slate-900/5 transition-all duration-300 hover:-translate-y-2 hover:border-blue-300 hover:shadow-2xl hover:shadow-blue-900/10">

                    {{-- Top Step Identifier Header --}}
                    <div>
                        <div class="flex items-center justify-between">
                            <span class="inline-flex items-center gap-1.5 rounded-full border border-blue-100 bg-blue-50 px-3 py-1 text-[11px] font-bold uppercase tracking-wider text-[#144b9e]">
                                Phase 01 &bull; Consultation
                            </span>
                            <span class="text-3xl font-black tracking-tight text-slate-200 group-hover:text-[#144b9e]/30 transition-colors">
                                01
                            </span>
                        </div>

                        {{-- Icon Container --}}
                        <div class="mt-6 flex h-16 w-16 items-center justify-center rounded-2xl bg-blue-50 border border-blue-100 text-[#144b9e] shadow-sm transition-transform duration-300 group-hover:scale-110 group-hover:bg-[#144b9e] group-hover:text-white">
                            <x-icon name="clipboard" class="h-8 w-8" />
                        </div>

                        {{-- Card Content --}}
                        <h3 class="mt-6 text-xl font-black text-slate-900 group-hover:text-[#144b9e] transition-colors">
                            Instant Survey &amp; Fixed Quote
                        </h3>

                        <p class="mt-3 text-sm leading-relaxed text-slate-600">
                            Share your moving requirements via video survey or an in-person home visit. We provide a transparent, line-item written quotation with zero hidden charges.
                        </p>

                        {{-- Mini Highlights Checklist --}}
                        <ul class="mt-6 space-y-2 border-t border-slate-100 pt-5 text-xs text-slate-600">
                            <li class="flex items-center gap-2">
                                <x-icon name="check-circle" class="h-4 w-4 shrink-0 text-emerald-600" />
                                <span>Free on-site or video survey</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <x-icon name="check-circle" class="h-4 w-4 shrink-0 text-emerald-600" />
                                <span>Fixed contract-bound written price</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <x-icon name="check-circle" class="h-4 w-4 shrink-0 text-emerald-600" />
                                <span>Zero advance booking pressure</span>
                            </li>
                        </ul>
                    </div>

                    {{-- Card Footer Badge --}}
                    <div class="mt-8 flex items-center justify-between border-t border-slate-100 pt-4 text-xs font-semibold text-slate-500">
                        <span class="text-[#144b9e]">Fast Response: &lt; 30 Mins</span>
                        <span class="text-slate-400">Step 1 of 3</span>
                    </div>

                </div>

                {{-- ------------------------------------------------------------
                     STEP 02: DEFENSIVE 5-PLY PACKING
                     ------------------------------------------------------------ --}}
                <div
                    class="group relative flex flex-col justify-between rounded-3xl border border-blue-200 bg-white p-8 sm:p-9 shadow-xl shadow-blue-900/5 transition-all duration-300 hover:-translate-y-2 hover:border-blue-400 hover:shadow-2xl hover:shadow-blue-900/15">

                    {{-- Top Step Identifier Header --}}
                    <div>
                        <div class="flex items-center justify-between">
                            <span class="inline-flex items-center gap-1.5 rounded-full border border-sky-200 bg-sky-50 px-3 py-1 text-[11px] font-bold uppercase tracking-wider text-sky-700">
                                Phase 02 &bull; Protection
                            </span>
                            <span class="text-3xl font-black tracking-tight text-slate-200 group-hover:text-[#144b9e]/30 transition-colors">
                                02
                            </span>
                        </div>

                        {{-- Icon Container --}}
                        <div class="mt-6 flex h-16 w-16 items-center justify-center rounded-2xl bg-[#144b9e] text-white shadow-md shadow-blue-900/20 transition-transform duration-300 group-hover:scale-110">
                            <x-icon name="package" class="h-8 w-8" />
                        </div>

                        {{-- Card Content --}}
                        <h3 class="mt-6 text-xl font-black text-slate-900 group-hover:text-[#144b9e] transition-colors">
                            5-Ply Defensive Packing
                        </h3>

                        <p class="mt-3 text-sm leading-relaxed text-slate-600">
                            Our uniformed moving specialists arrive on time with premium bubble wrap, corrugated sheets, foam edge protectors, and custom wooden crating for delicate items.
                        </p>

                        {{-- Mini Highlights Checklist --}}
                        <ul class="mt-6 space-y-2 border-t border-slate-100 pt-5 text-xs text-slate-600">
                            <li class="flex items-center gap-2">
                                <x-icon name="check-circle" class="h-4 w-4 shrink-0 text-emerald-600" />
                                <span>Multi-layer bubble &amp; stretch film</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <x-icon name="check-circle" class="h-4 w-4 shrink-0 text-emerald-600" />
                                <span>Custom crates for glass &amp; heirlooms</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <x-icon name="check-circle" class="h-4 w-4 shrink-0 text-emerald-600" />
                                <span>Verified staff (zero day labor)</span>
                            </li>
                        </ul>
                    </div>

                    {{-- Card Footer Badge --}}
                    <div class="mt-8 flex items-center justify-between border-t border-slate-100 pt-4 text-xs font-semibold text-slate-500">
                        <span class="text-emerald-600 flex items-center gap-1 font-bold">
                            <x-icon name="shield" class="h-3.5 w-3.5" />
                            Transit Insured Packing
                        </span>
                        <span class="text-slate-400">Step 2 of 3</span>
                    </div>

                </div>

                {{-- ------------------------------------------------------------
                     STEP 03: TRANSIT & REASSEMBLY
                     ------------------------------------------------------------ --}}
                <div
                    class="group relative flex flex-col justify-between rounded-3xl border border-slate-200/90 bg-white p-8 sm:p-9 shadow-xl shadow-slate-900/5 transition-all duration-300 hover:-translate-y-2 hover:border-blue-300 hover:shadow-2xl hover:shadow-blue-900/10">

                    {{-- Top Step Identifier Header --}}
                    <div>
                        <div class="flex items-center justify-between">
                            <span class="inline-flex items-center gap-1.5 rounded-full border border-blue-100 bg-blue-50 px-3 py-1 text-[11px] font-bold uppercase tracking-wider text-[#144b9e]">
                                Phase 03 &bull; Destination
                            </span>
                            <span class="text-3xl font-black tracking-tight text-slate-200 group-hover:text-[#144b9e]/30 transition-colors">
                                03
                            </span>
                        </div>

                        {{-- Icon Container --}}
                        <div class="mt-6 flex h-16 w-16 items-center justify-center rounded-2xl bg-blue-50 border border-blue-100 text-[#144b9e] shadow-sm transition-transform duration-300 group-hover:scale-110 group-hover:bg-[#144b9e] group-hover:text-white">
                            <x-icon name="truck" class="h-8 w-8" />
                        </div>

                        {{-- Card Content --}}
                        <h3 class="mt-6 text-xl font-black text-slate-900 group-hover:text-[#144b9e] transition-colors">
                            Sealed Transit &amp; Setup
                        </h3>

                        <p class="mt-3 text-sm leading-relaxed text-slate-600">
                            Your goods travel in dedicated closed GPS vehicles directly to your destination. We unload, place furniture in your chosen rooms, reassemble beds, and haul away debris.
                        </p>

                        {{-- Mini Highlights Checklist --}}
                        <ul class="mt-6 space-y-2 border-t border-slate-100 pt-5 text-xs text-slate-600">
                            <li class="flex items-center gap-2">
                                <x-icon name="check-circle" class="h-4 w-4 shrink-0 text-emerald-600" />
                                <span>Dedicated closed container truck</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <x-icon name="check-circle" class="h-4 w-4 shrink-0 text-emerald-600" />
                                <span>Room placement &amp; bed reassembly</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <x-icon name="check-circle" class="h-4 w-4 shrink-0 text-emerald-600" />
                                <span>Complete packing debris haul-away</span>
                            </li>
                        </ul>
                    </div>

                    {{-- Card Footer Badge --}}
                    <div class="mt-8 flex items-center justify-between border-t border-slate-100 pt-4 text-xs font-semibold text-slate-500">
                        <span class="text-[#144b9e] font-bold">Turnkey Move-In Ready</span>
                        <span class="text-slate-400">Step 3 of 3</span>
                    </div>

                </div>

            </div>

        </div>

        {{-- ================================================================
             BOTTOM CONVERSION & ACTION BAR
             ================================================================ --}}
        <div
            class="mt-14 rounded-3xl border border-blue-100 bg-gradient-to-r from-blue-50/90 via-white to-sky-50/90 p-6 sm:p-8 shadow-sm">
            <div class="flex flex-col gap-5 sm:flex-row sm:items-center sm:justify-between">
                <div class="flex items-center gap-4">
                    <div
                        class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-[#144b9e] text-white shadow-md shadow-blue-900/20">
                        <x-icon name="house" class="h-6 w-6" />
                    </div>
                    <div>
                        <h4 class="text-base font-bold text-slate-900">
                            Ready to schedule your stress-free move?
                        </h4>
                        <p class="text-xs text-slate-500 mt-0.5">
                            Lock your preferred moving date with zero cancellation fees &bull; Instant written estimate
                        </p>
                    </div>
                </div>

                <div class="flex flex-wrap items-center gap-3">
                    <a href="{{ route('contact') }}#get-a-quote"
                        class="inline-flex items-center gap-2 rounded-full border border-slate-300 bg-white px-5 py-2.5 text-xs font-bold text-slate-700 transition hover:border-[#144b9e] hover:text-[#144b9e] shadow-sm">
                        <span>Calculate Cost</span>
                        <x-icon name="arrow-right" class="h-3.5 w-3.5" />
                    </a>

                    <a href="tel:{{ $site['phone_e164'] }}"
                        class="inline-flex items-center gap-2 rounded-full bg-[#144b9e] px-6 py-2.5 text-xs font-extrabold text-white shadow-lg shadow-blue-900/25 transition hover:bg-[#0f3c80] hover:scale-105">
                        <x-icon name="phone" class="h-3.5 w-3.5 text-sky-300" />
                        <span>Call {{ $site['phone_display'] }}</span>
                    </a>
                </div>
            </div>
        </div>

    </div>
</section>
