@php
    $site = config('site');
    $mapsQuery = urlencode($site['legal_name'] . ', ' . $site['address']['street'] . ', ' . $site['address']['city']);
@endphp

{{-- =========================================================================
     CONTACT INFORMATION CARDS: Mobile, Email & Regional Headquarters
     White Background Bento Layout matching Hero and Site Design Aesthetics
     ========================================================================= --}}
<section class="relative isolate overflow-hidden bg-white py-24 sm:py-28 lg:py-32" id="contact-channels">

    {{-- ================================================================
         AMBIENT LIGHT BACKGROUND & GRAPHIC ACCENTS
         ================================================================ --}}
    <div class="pointer-events-none absolute inset-0 -z-10 overflow-hidden select-none" aria-hidden="true">
        {{-- Soft Glows --}}
        <div class="absolute -top-32 right-1/4 h-[500px] w-[700px] rounded-full bg-blue-100/50 blur-[130px]"></div>
        <div class="absolute -bottom-32 left-1/4 h-[550px] w-[800px] rounded-full bg-sky-100/50 blur-[140px]"></div>

        {{-- Subtle Grid Pattern --}}
        <div class="absolute inset-0 opacity-[0.3]"
            style="background-image: radial-gradient(circle, #cbd5e1 1px, transparent 1px); background-size: 28px 28px;">
        </div>

        {{-- Giant Watermark Typography --}}
        <div
            class="absolute -right-6 top-1/2 -translate-y-1/2 text-[14rem] font-black tracking-tighter text-slate-100 sm:text-[18rem] lg:text-[22rem] select-none">
            24/7
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
                <span>Direct Contact Channels</span>
            </div>

            {{-- Main Headline --}}
            <h2 class="mt-6 text-3xl font-black tracking-tight text-slate-900 sm:text-5xl lg:text-6xl leading-[1.1]">
                Get in touch with our <br />
                <span class="text-[#144b9e]">moving specialists.</span>
            </h2>

            <p class="mx-auto mt-4 max-w-2xl text-base text-slate-600 sm:text-lg leading-relaxed">
                Reach our team anytime for instantaneous written quotations, slot reservations, video surveys, or transit tracking updates.
            </p>
        </div>

        {{-- ================================================================
             3 ELEVATED BENTO CONTACT CARDS
             ================================================================ --}}
        <div class="mt-14 sm:mt-16 grid gap-8 lg:grid-cols-3">

            {{-- ------------------------------------------------------------
                 CARD 1: PHONE & WHATSAPP SUPPORT
                 ------------------------------------------------------------ --}}
            <div
                class="group relative flex flex-col justify-between rounded-3xl border border-slate-200/90 bg-slate-50/60 p-8 sm:p-9 shadow-sm transition-all duration-300 hover:-translate-y-2 hover:bg-white hover:border-blue-300 hover:shadow-2xl hover:shadow-blue-900/10">

                <div>
                    {{-- Header Row: Tag & Live Indicator --}}
                    <div class="flex items-center justify-between">
                        <span class="inline-flex items-center gap-1.5 rounded-full border border-blue-100 bg-blue-50 px-3 py-1 text-[11px] font-bold uppercase tracking-wider text-[#144b9e]">
                            Direct Call Desk
                        </span>
                        <span class="inline-flex items-center gap-1.5 text-[11px] font-bold text-emerald-600">
                            <span class="relative flex h-2 w-2">
                                <span class="absolute inline-flex h-full w-full animate-ping rounded-full bg-emerald-400 opacity-75"></span>
                                <span class="relative inline-flex h-2 w-2 rounded-full bg-emerald-500"></span>
                            </span>
                            Available Now
                        </span>
                    </div>

                    {{-- Icon Squircle --}}
                    <div class="mt-6 flex h-16 w-16 items-center justify-center rounded-2xl bg-blue-50 border border-blue-100 text-[#144b9e] shadow-sm transition-transform duration-300 group-hover:scale-110 group-hover:bg-[#144b9e] group-hover:text-white">
                        <x-icon name="phone" class="h-8 w-8" />
                    </div>

                    {{-- Card Titles --}}
                    <h3 class="mt-6 text-xl font-black text-slate-900 group-hover:text-[#144b9e] transition-colors">
                        Phone &amp; WhatsApp
                    </h3>

                    <p class="mt-2 text-xs leading-relaxed text-slate-500">
                        Immediate telephonic assistance, move coordinator assignment, and real-time transit status.
                    </p>

                    {{-- Phone Link --}}
                    <div class="mt-6">
                        <a href="tel:{{ $site['phone_e164'] }}"
                            class="inline-block text-2xl font-black text-[#144b9e] hover:text-[#0f3c80] transition tracking-tight">
                            {{ $site['phone_display'] }}
                        </a>
                        <p class="mt-1 text-xs text-slate-400 font-medium">6:00 AM &ndash; 10:00 PM &bull; All 7 Days</p>
                    </div>
                </div>

                {{-- Card Actions Footer --}}
                <div class="mt-8 border-t border-slate-200/80 pt-5">
                    <a href="{{ $site['whatsapp_url'] }}" target="_blank" rel="noopener noreferrer"
                        class="inline-flex w-full items-center justify-center gap-2 rounded-2xl border border-emerald-200 bg-emerald-50/80 px-4 py-3 text-xs font-bold text-emerald-800 transition hover:bg-emerald-100 hover:border-emerald-300">
                        <x-icon name="whatsapp" class="h-4 w-4 text-emerald-600" />
                        <span>Chat on WhatsApp</span>
                    </a>
                </div>

            </div>

            {{-- ------------------------------------------------------------
                 CARD 2: WRITTEN ESTIMATES & CORPORATE EMAIL
                 ------------------------------------------------------------ --}}
            <div
                class="group relative flex flex-col justify-between rounded-3xl border border-blue-200 bg-white p-8 sm:p-9 shadow-xl shadow-blue-900/5 transition-all duration-300 hover:-translate-y-2 hover:border-blue-400 hover:shadow-2xl hover:shadow-blue-900/15">

                <div>
                    {{-- Header Row: Tag & SLA Badge --}}
                    <div class="flex items-center justify-between">
                        <span class="inline-flex items-center gap-1.5 rounded-full border border-sky-200 bg-sky-50 px-3 py-1 text-[11px] font-bold uppercase tracking-wider text-sky-700">
                            Written Quotations
                        </span>
                        <span class="text-[11px] font-semibold text-slate-500">
                            Response &lt; 30 Mins
                        </span>
                    </div>

                    {{-- Icon Squircle --}}
                    <div class="mt-6 flex h-16 w-16 items-center justify-center rounded-2xl bg-[#144b9e] text-white shadow-md shadow-blue-900/20 transition-transform duration-300 group-hover:scale-110">
                        <x-icon name="mail" class="h-8 w-8" />
                    </div>

                    {{-- Card Titles --}}
                    <h3 class="mt-6 text-xl font-black text-slate-900 group-hover:text-[#144b9e] transition-colors">
                        Official Email Desk
                    </h3>

                    <p class="mt-2 text-xs leading-relaxed text-slate-500">
                        Submit inventory item lists, corporate tenders, and detailed household relocation inquiries.
                    </p>

                    {{-- Email Link --}}
                    <div class="mt-6">
                        <a href="mailto:{{ $site['email'] }}"
                            class="inline-block text-base sm:text-lg font-bold text-slate-900 hover:text-[#144b9e] transition break-all tracking-tight">
                            {{ $site['email'] }}
                        </a>
                        <p class="mt-1 text-xs text-slate-400 font-medium">Contract-bound written quotes</p>
                    </div>
                </div>

                {{-- Card Actions Footer --}}
                <div class="mt-8 border-t border-slate-100 pt-5">
                    <a href="mailto:{{ $site['email'] }}?subject=Moving%20Quote%20Request"
                        class="inline-flex w-full items-center justify-center gap-2 rounded-2xl bg-[#144b9e] px-4 py-3 text-xs font-bold text-white shadow-md shadow-blue-900/20 transition hover:bg-[#0f3c80]">
                        <x-icon name="mail" class="h-4 w-4 text-sky-300" />
                        <span>Send Move Inventory</span>
                    </a>
                </div>

            </div>

            {{-- ------------------------------------------------------------
                 CARD 3: HEADQUARTERS & LOGISTICS HUB
                 ------------------------------------------------------------ --}}
            <div
                class="group relative flex flex-col justify-between rounded-3xl border border-slate-200/90 bg-slate-50/60 p-8 sm:p-9 shadow-sm transition-all duration-300 hover:-translate-y-2 hover:bg-white hover:border-blue-300 hover:shadow-2xl hover:shadow-blue-900/10">

                <div>
                    {{-- Header Row: Tag & Status --}}
                    <div class="flex items-center justify-between">
                        <span class="inline-flex items-center gap-1.5 rounded-full border border-blue-100 bg-blue-50 px-3 py-1 text-[11px] font-bold uppercase tracking-wider text-[#144b9e]">
                            Dispatch Center
                        </span>
                        <span class="text-[11px] font-semibold text-slate-500">
                            Erode HQ
                        </span>
                    </div>

                    {{-- Icon Squircle --}}
                    <div class="mt-6 flex h-16 w-16 items-center justify-center rounded-2xl bg-blue-50 border border-blue-100 text-[#144b9e] shadow-sm transition-transform duration-300 group-hover:scale-110 group-hover:bg-[#144b9e] group-hover:text-white">
                        <x-icon name="pin" class="h-8 w-8" />
                    </div>

                    {{-- Card Titles --}}
                    <h3 class="mt-6 text-xl font-black text-slate-900 group-hover:text-[#144b9e] transition-colors">
                        Central Operations
                    </h3>

                    <p class="mt-2 text-xs leading-relaxed text-slate-500">
                        Fleet hub and logistics terminal serving Erode, Tiruppur, Coimbatore &amp; all South India.
                    </p>

                    {{-- Address Details --}}
                    <div class="mt-6">
                        <address class="not-italic text-sm font-semibold text-slate-700 leading-relaxed">
                            {{ $site['address']['street'] }},<br />
                            {{ $site['address']['locality'] }}, {{ $site['address']['city'] }} &ndash; {{ $site['address']['postal_code'] }}
                        </address>
                        <p class="mt-1 text-xs text-slate-400 font-medium">Tamil Nadu, India</p>
                    </div>
                </div>

                {{-- Card Actions Footer --}}
                <div class="mt-8 border-t border-slate-200/80 pt-5">
                    <a href="https://www.google.com/maps/search/?api=1&query={{ $mapsQuery }}" target="_blank" rel="noopener noreferrer"
                        class="inline-flex w-full items-center justify-center gap-2 rounded-2xl border border-slate-300 bg-white px-4 py-3 text-xs font-bold text-slate-700 transition hover:border-[#144b9e] hover:text-[#144b9e] shadow-sm">
                        <x-icon name="external" class="h-3.5 w-3.5" />
                        <span>Open in Google Maps</span>
                    </a>
                </div>

            </div>

        </div>

        {{-- ================================================================
             BOTTOM ESTIMATE CALLOUT BAR
             ================================================================ --}}
        <div
            class="mt-14 rounded-3xl border border-blue-100 bg-gradient-to-r from-blue-50/90 via-slate-50 to-sky-50/90 p-6 sm:p-8 shadow-sm">
            <div class="flex flex-col gap-5 sm:flex-row sm:items-center sm:justify-between">
                <div class="flex items-center gap-4">
                    <div
                        class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-[#144b9e] text-white shadow-md shadow-blue-900/20">
                        <x-icon name="check-circle" class="h-6 w-6" />
                    </div>
                    <div>
                        <h4 class="text-base font-bold text-slate-900">
                            Need a custom moving quote right now?
                        </h4>
                        <p class="text-xs text-slate-500 mt-0.5">
                            Fill our quick 2-minute estimation form with zero booking fee &bull; 100% fixed transparent quotes
                        </p>
                    </div>
                </div>

                <div class="flex flex-wrap items-center gap-3">
                    <a href="{{ route('contact') }}#get-a-quote"
                        class="inline-flex items-center gap-2 rounded-full border border-slate-300 bg-white px-5 py-2.5 text-xs font-bold text-slate-700 transition hover:border-[#144b9e] hover:text-[#144b9e] shadow-sm">
                        <span>Get Free Quote</span>
                        <x-icon name="arrow-right" class="h-3.5 w-3.5" />
                    </a>

                    <a href="tel:{{ $site['phone_e164'] }}"
                        class="inline-flex items-center gap-2 rounded-full bg-[#144b9e] px-6 py-2.5 text-xs font-extrabold text-white shadow-lg shadow-blue-900/25 transition hover:bg-[#0f3c80] hover:scale-105">
                        <x-icon name="phone" class="h-3.5 w-3.5 text-sky-300" />
                        <span>Call Support Desk</span>
                    </a>
                </div>
            </div>
        </div>

    </div>
</section>
