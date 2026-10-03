@php
    $site = config('site');
@endphp

{{-- =========================================================================
     ABOUT SECTION — "THE NEXT LEVEL DIFFERENCE"
     Editorial Light Bento Grid Showcase & Brand Legacy
     ========================================================================= --}}
<section id="about" class="relative isolate overflow-hidden bg-white py-24 sm:py-28 lg:py-32">

    {{-- ================================================================
         DECORATIVE LIGHT BACKGROUND & AMBIENT ACCENTS
         ================================================================ --}}
    <div class="pointer-events-none absolute inset-0 -z-10 overflow-hidden select-none" aria-hidden="true">
        {{-- Subtle radial glows --}}
        <div class="absolute -top-32 right-1/4 h-[500px] w-[700px] rounded-full bg-blue-50/80 blur-[120px]"></div>
        <div class="absolute -bottom-32 left-1/4 h-[600px] w-[800px] rounded-full bg-sky-50/80 blur-[140px]"></div>

        {{-- Subtle Dot Grid Pattern --}}
        <div class="absolute inset-0 opacity-[0.4]"
            style="background-image: radial-gradient(circle, #cbd5e1 1px, transparent 1px); background-size: 28px 28px;">
        </div>

        {{-- Giant Brand Watermark --}}
        <div
            class="absolute -right-12 -top-12 text-[14rem] font-black tracking-tighter text-slate-100/60 sm:text-[20rem] lg:text-[26rem] select-none">
            NL
        </div>
    </div>

    <div class="container mx-auto px-4 sm:px-6 lg:px-8">

        {{-- ================================================================
             SECTION HEADER
             ================================================================ --}}
        <div class="mx-auto max-w-3xl text-center">
            {{-- Category Pill Badge --}}
            <div
                class="inline-flex items-center gap-2.5 rounded-full border border-blue-100 bg-blue-50/90 px-4 py-1.5 text-xs font-bold uppercase tracking-[0.2em] text-[#144b9e] shadow-sm">
                <span class="relative flex h-2 w-2">
                    <span class="absolute inline-flex h-full w-full animate-ping rounded-full bg-blue-400 opacity-75"></span>
                    <span class="relative inline-flex h-2 w-2 rounded-full bg-[#144b9e]"></span>
                </span>
                <span>The Next Level Difference</span>
            </div>

            {{-- Main Headline --}}
            <h2 class="mt-6 text-3xl font-black tracking-tight text-slate-900 sm:text-5xl lg:text-6xl leading-[1.1]">
                We don't just move boxes.<br />
                <span class="text-[#144b9e]">We move your life forward.</span>
            </h2>

            <p class="mx-auto mt-5 max-w-2xl text-base text-slate-600 sm:text-lg leading-relaxed">
                Founded with a mission to eliminate relocation anxiety, we blend certified packing crews, 5-layer protective materials, and guaranteed on-time doorstep delivery.
            </p>
        </div>

        {{-- ================================================================
             MAIN BENTO GRID (TOP ROW: STORY BANNER + CREDIBILITY CARD)
             ================================================================ --}}
        <div class="mt-14 grid gap-6 lg:grid-cols-12 lg:items-stretch">

            {{-- ------------------------------------------------------------
                 BENTO 1: VISUAL STORY BANNER (7 Cols)
                 ------------------------------------------------------------ --}}
            <div class="group relative flex flex-col justify-between overflow-hidden rounded-3xl border border-slate-200/90 bg-slate-900 p-7 sm:p-10 shadow-xl lg:col-span-7 transition-all duration-500 hover:shadow-2xl hover:border-slate-300">
                {{-- Background Image with subtle zoom --}}
                <img src="{{ asset('images/abt.webp') }}" alt="Next Level Packers and Movers professional team in action"
                    width="1000" height="700" loading="lazy" decoding="async"
                    class="absolute inset-0 h-full w-full object-cover opacity-45 transition-transform duration-700 ease-out group-hover:scale-105 group-hover:opacity-55" />

                {{-- Vignette Gradients --}}
                <div class="absolute inset-0 bg-gradient-to-t from-[#06152b] via-[#06152b]/65 to-transparent"></div>
                <div class="absolute inset-0 bg-gradient-to-r from-[#06152b]/80 via-transparent to-transparent"></div>

                {{-- Top Bar in Card --}}
                <div class="relative z-10 flex items-center justify-between gap-4">
                    <div class="inline-flex items-center gap-2 rounded-full border border-white/20 bg-black/40 px-3.5 py-1.5 text-xs font-semibold tracking-wide text-white backdrop-blur-md">
                        <x-icon name="medal" class="h-4 w-4 text-sky-400" />
                        <span>Verified Relocation Experts</span>
                    </div>

                    <a href="{{ route('about') }}"
                        class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full border border-white/20 bg-white/10 text-white backdrop-blur-md transition-all duration-300 group-hover:bg-[#144b9e] group-hover:border-transparent group-hover:scale-110 shadow-lg"
                        title="Read our full story">
                        <x-icon name="arrow-right" class="h-4 w-4" />
                    </a>
                </div>

                {{-- Bottom Content in Card --}}
                <div class="relative z-10 mt-32 sm:mt-40">
                    <p class="text-xs font-black uppercase tracking-[0.2em] text-sky-300">
                        Our Core Philosophy
                    </p>
                    <h3 class="mt-2 text-2xl font-black text-white sm:text-3xl lg:text-4xl leading-tight">
                        Every item holds memories. Every move deserves absolute precision.
                    </h3>
                    <p class="mt-3 text-sm text-slate-200 leading-relaxed max-w-xl">
                        From delicate glassware and antique furniture to corporate workstations, our trained team handles every step with dedicated care and modern packing methods.
                    </p>

                    {{-- Feature Badges --}}
                    <div class="mt-6 flex flex-wrap gap-2.5">
                        <span class="inline-flex items-center gap-1.5 rounded-xl border border-white/15 bg-white/10 px-3 py-1.5 text-xs font-semibold text-white backdrop-blur-sm">
                            <x-icon name="check-circle" class="h-3.5 w-3.5 text-sky-400" />
                            5-Layer Packing System
                        </span>
                        <span class="inline-flex items-center gap-1.5 rounded-xl border border-white/15 bg-white/10 px-3 py-1.5 text-xs font-semibold text-white backdrop-blur-sm">
                            <x-icon name="check-circle" class="h-3.5 w-3.5 text-sky-400" />
                            Direct Fleet Transit
                        </span>
                        <span class="inline-flex items-center gap-1.5 rounded-xl border border-white/15 bg-white/10 px-3 py-1.5 text-xs font-semibold text-white backdrop-blur-sm">
                            <x-icon name="check-circle" class="h-3.5 w-3.5 text-sky-400" />
                            Zero Hidden Costs
                        </span>
                    </div>
                </div>
            </div>

            {{-- ------------------------------------------------------------
                 BENTO 2: EXPERIENCE & NUMERICAL IMPACT CARD (5 Cols)
                 ------------------------------------------------------------ --}}
            <div class="relative flex flex-col justify-between overflow-hidden rounded-3xl border border-slate-200/90 bg-slate-50/70 p-7 sm:p-10 text-slate-900 shadow-xl backdrop-blur-sm lg:col-span-5 transition-all duration-500 hover:shadow-2xl hover:border-blue-200">
                {{-- Decorative Ambient Glow --}}
                <div class="pointer-events-none absolute -right-20 -top-20 h-60 w-60 rounded-full bg-blue-100/70 blur-3xl"></div>
                <div class="pointer-events-none absolute -bottom-24 -left-24 h-60 w-60 rounded-full bg-sky-100/70 blur-3xl"></div>

                {{-- Top Stat Badge & Metric --}}
                <div class="relative z-10">
                    <div class="flex items-center justify-between">
                        <span class="inline-flex items-center gap-1.5 rounded-full border border-blue-200 bg-blue-100/60 px-3 py-1 text-xs font-bold uppercase tracking-wider text-[#144b9e]">
                            <span class="h-1.5 w-1.5 rounded-full bg-[#144b9e]"></span>
                            Track Record
                        </span>
                        <div class="flex items-center gap-1 text-amber-400">
                            @for ($i = 0; $i < 5; $i++)
                                <x-icon name="star" class="h-4 w-4 fill-current" />
                            @endfor
                        </div>
                    </div>

                    <div class="mt-6 flex items-baseline gap-2">
                        <span class="text-6xl font-black tracking-tight text-slate-900 sm:text-7xl lg:text-8xl">10</span>
                        <span class="text-4xl font-black text-[#144b9e] sm:text-5xl">+</span>
                    </div>
                    <p class="mt-1 text-lg font-bold text-slate-900">Years of Relocation Mastery</p>
                    <p class="mt-2 text-sm text-slate-600 leading-relaxed">
                        A decade of trust, executing seamless relocations for households, corporate hubs, and industrial operations across India.
                    </p>
                </div>

                {{-- Bottom Stat Metrics Grid --}}
                <div class="relative z-10 mt-8 grid grid-cols-2 gap-4 border-t border-slate-200 pt-6">
                    <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                        <div class="flex items-center gap-2 text-[#144b9e]">
                            <x-icon name="users" class="h-4 w-4" />
                            <span class="text-xs font-bold uppercase tracking-wider text-slate-500">Served</span>
                        </div>
                        <p class="mt-2 text-2xl font-black tracking-tight text-slate-900 sm:text-3xl">8,500+</p>
                        <p class="text-xs text-slate-500">Satisfied Clients</p>
                    </div>

                    <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                        <div class="flex items-center gap-2 text-emerald-600">
                            <x-icon name="shield" class="h-4 w-4" />
                            <span class="text-xs font-bold uppercase tracking-wider text-slate-500">Safety</span>
                        </div>
                        <p class="mt-2 text-2xl font-black tracking-tight text-slate-900 sm:text-3xl">99.4%</p>
                        <p class="text-xs text-slate-500">Damage-Free Rate</p>
                    </div>
                </div>
            </div>

        </div>

        {{-- ================================================================
             THREE CORE PRINCIPLES (BENTO ROW: 3 CARDS)
             ================================================================ --}}
        <div class="mt-6 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">

            {{-- Principle 01 --}}
            <div class="group relative flex flex-col justify-between overflow-hidden rounded-3xl border border-slate-200/90 bg-white p-8 shadow-md transition-all duration-300 hover:-translate-y-1.5 hover:border-blue-300 hover:shadow-xl hover:shadow-blue-500/5">
                <div class="relative z-10">
                    <div class="flex items-center justify-between">
                        <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-blue-50 border border-blue-100 text-[#144b9e] shadow-inner transition-transform group-hover:scale-110 group-hover:bg-[#144b9e] group-hover:text-white">
                            <x-icon name="shield" class="h-6 w-6" />
                        </div>
                        <span class="rounded-full border border-slate-200 bg-slate-50 px-3 py-1 text-xs font-black text-slate-500">
                            01
                        </span>
                    </div>

                    <h3 class="mt-6 text-xl font-bold text-slate-900 transition-colors group-hover:text-[#144b9e]">
                        Careful by Default
                    </h3>

                    <p class="mt-2.5 text-sm text-slate-600 leading-relaxed">
                        Multi-layer bubble cushioning, heavy-duty edge guards, and custom crating ensure total protection for every fragile item.
                    </p>
                </div>

                <div class="relative z-10 mt-6 pt-4 border-t border-slate-100 flex items-center gap-2 text-xs font-bold text-[#144b9e]">
                    <span>Premium Packaging Standard</span>
                    <x-icon name="check" class="h-3.5 w-3.5" />
                </div>
            </div>

            {{-- Principle 02 --}}
            <div class="group relative flex flex-col justify-between overflow-hidden rounded-3xl border border-slate-200/90 bg-white p-8 shadow-md transition-all duration-300 hover:-translate-y-1.5 hover:border-blue-300 hover:shadow-xl hover:shadow-blue-500/5">
                <div class="relative z-10">
                    <div class="flex items-center justify-between">
                        <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-blue-50 border border-blue-100 text-[#144b9e] shadow-inner transition-transform group-hover:scale-110 group-hover:bg-[#144b9e] group-hover:text-white">
                            <x-icon name="truck" class="h-6 w-6" />
                        </div>
                        <span class="rounded-full border border-slate-200 bg-slate-50 px-3 py-1 text-xs font-black text-slate-500">
                            02
                        </span>
                    </div>

                    <h3 class="mt-6 text-xl font-bold text-slate-900 transition-colors group-hover:text-[#144b9e]">
                        Built Around Reliability
                    </h3>

                    <p class="mt-2.5 text-sm text-slate-600 leading-relaxed">
                        Dedicated fleet logistics, strict timeline adherence, and direct coordination from pickup right through to doorstep unboxing.
                    </p>
                </div>

                <div class="relative z-10 mt-6 pt-4 border-t border-slate-100 flex items-center gap-2 text-xs font-bold text-[#144b9e]">
                    <span>Direct Transit Guarantee</span>
                    <x-icon name="check" class="h-3.5 w-3.5" />
                </div>
            </div>

            {{-- Principle 03 --}}
            <div class="group relative flex flex-col justify-between overflow-hidden rounded-3xl border border-slate-200/90 bg-white p-8 shadow-md transition-all duration-300 hover:-translate-y-1.5 hover:border-blue-300 hover:shadow-xl hover:shadow-blue-500/5 sm:col-span-2 lg:col-span-1">
                <div class="relative z-10">
                    <div class="flex items-center justify-between">
                        <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-blue-50 border border-blue-100 text-[#144b9e] shadow-inner transition-transform group-hover:scale-110 group-hover:bg-[#144b9e] group-hover:text-white">
                            <x-icon name="handshake" class="h-6 w-6" />
                        </div>
                        <span class="rounded-full border border-slate-200 bg-slate-50 px-3 py-1 text-xs font-black text-slate-500">
                            03
                        </span>
                    </div>

                    <h3 class="mt-6 text-xl font-bold text-slate-900 transition-colors group-hover:text-[#144b9e]">
                        Focused on Your Journey
                    </h3>

                    <p class="mt-2.5 text-sm text-slate-600 leading-relaxed">
                        Upfront transparent estimates with no hidden surprise costs. We tailor every relocation plan to your exact timeline and budget.
                    </p>
                </div>

                <div class="relative z-10 mt-6 pt-4 border-t border-slate-100 flex items-center gap-2 text-xs font-bold text-[#144b9e]">
                    <span>100% Transparent Pricing</span>
                    <x-icon name="check" class="h-3.5 w-3.5" />
                </div>
            </div>

        </div>

        {{-- ================================================================
             BOTTOM ACTION / QUICK CONTACT RIBBON
             ================================================================ --}}
        <div class="mt-10 rounded-2xl border border-blue-100 bg-gradient-to-r from-blue-50/80 via-white to-sky-50/80 p-5 sm:p-6 shadow-sm">
            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <div class="flex items-center gap-3.5">
                    <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-full bg-[#144b9e] text-white shadow-md shadow-blue-900/20">
                        <x-icon name="phone" class="h-5 w-5" />
                    </div>
                    <div>
                        <p class="text-sm font-bold text-slate-900">
                            Planning a move soon? <span class="text-[#144b9e] font-semibold">Speak directly with our senior move manager.</span>
                        </p>
                        <p class="text-xs text-slate-500">
                            Free on-site or virtual survey &bull; Instant accurate moving quotation
                        </p>
                    </div>
                </div>

                <div class="flex flex-wrap items-center gap-3">
                    <a href="{{ route('about') }}"
                        class="inline-flex items-center gap-2 rounded-full border border-slate-300 bg-white px-5 py-2.5 text-xs font-bold text-slate-700 transition-all duration-300 hover:border-[#144b9e] hover:text-[#144b9e] shadow-sm">
                        <span>Read Full Story</span>
                        <x-icon name="arrow-right" class="h-3.5 w-3.5" />
                    </a>

                    <a href="tel:{{ $site['phone_e164'] }}"
                        class="inline-flex items-center gap-2 rounded-full bg-[#144b9e] px-5 py-2.5 text-xs font-extrabold text-white shadow-lg shadow-blue-900/25 transition-all duration-300 hover:bg-[#0f3c80] hover:scale-105">
                        <x-icon name="phone" class="h-3.5 w-3.5 text-sky-300" />
                        <span>{{ $site['phone_display'] }}</span>
                    </a>
                </div>
            </div>
        </div>

    </div>
</section>

