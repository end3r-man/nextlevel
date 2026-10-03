@php
    $site = config('site');
@endphp

{{-- =========================================================================
     WHY CHOOSE US — CINEMATIC PANORAMIC SHOWCASE
     Full-Bleed Landscape Backdrop with Floating Content Bento Card
     ========================================================================= --}}
<section id="why" class="relative isolate overflow-hidden bg-slate-900 py-16 sm:py-20 lg:py-28">

    {{-- ================================================================
         CINEMATIC PANORAMIC BACKDROP & LIGHTING
         ================================================================ --}}
    <div class="pointer-events-none absolute inset-0 -z-10 overflow-hidden select-none" aria-hidden="true">
        {{-- High-Res Panoramic Landscape Photograph --}}
        <img src="{{ asset('images/why-us-bg.jpg') }}"
            alt="Next Level Packers and Movers dedicated fleet transit on highway"
            width="1920" height="1080"
            loading="lazy" decoding="async"
            class="h-full w-full object-cover object-center lg:object-[center_right] transition-transform duration-1000 ease-out scale-100" />

        {{-- Cinematic Contrast Gradients --}}
        {{-- Left-to-right fade for text contrast on the card and backdrop --}}
        <div class="absolute inset-0 bg-gradient-to-r from-slate-950/85 via-slate-950/50 to-slate-950/20 lg:from-slate-950/80 lg:via-slate-950/30 lg:to-transparent"></div>

        {{-- Top & bottom vignette fades for smooth section boundary transitions --}}
        <div class="absolute inset-x-0 top-0 h-32 bg-gradient-to-b from-slate-950/70 to-transparent"></div>
        <div class="absolute inset-x-0 bottom-0 h-32 bg-gradient-to-t from-slate-950/80 to-transparent"></div>

        {{-- Subtle Grid Pattern Accent (Hero Theme Alignment) --}}
        <div class="absolute inset-0 opacity-[0.06]"
            style="background-image: linear-gradient(rgba(255,255,255,0.7) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,0.7) 1px, transparent 1px); background-size: 64px 64px;">
        </div>

        {{-- Route Trajectory SVG Curves --}}
        <svg class="absolute inset-0 h-full w-full opacity-20 pointer-events-none" viewBox="0 0 1440 800" fill="none" preserveAspectRatio="none">
            <path d="M-50 480 C200 480 250 150 550 200 C800 240 750 600 1050 520 C1250 470 1350 250 1500 260"
                stroke="white" stroke-width="1.5" stroke-dasharray="8 12" />
        </svg>
    </div>

    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid gap-10 lg:grid-cols-12 lg:items-center">

            {{-- ============================================================
                 LEFT COLUMN: FLOATING SIGNATURE CONTENT CARD
                 Clean, authoritative, high-contrast white card matching design reference
                 ============================================================ --}}
            <div class="lg:col-span-7 xl:col-span-6">
                <div class="relative overflow-hidden rounded-3xl border border-white/80 bg-white/95 p-7 sm:p-10 lg:p-12 shadow-2xl shadow-slate-950/40 backdrop-blur-xl transition-all duration-300">

                    {{-- Card Glow Accent --}}
                    <div class="pointer-events-none absolute -right-20 -top-20 h-56 w-56 rounded-full bg-blue-100/60 blur-3xl" aria-hidden="true"></div>

                    {{-- Eyebrow Category Pill Badge --}}
                    <div class="inline-flex items-center gap-2 rounded-full border border-blue-200 bg-blue-50/90 px-3.5 py-1 text-xs font-bold uppercase tracking-[0.2em] text-[#144b9e] shadow-sm">
                        <span class="relative flex h-2 w-2">
                            <span class="absolute inline-flex h-full w-full animate-ping rounded-full bg-blue-400 opacity-75"></span>
                            <span class="relative inline-flex h-2 w-2 rounded-full bg-[#144b9e]"></span>
                        </span>
                        <span>The Next Level Difference</span>
                    </div>

                    {{-- Main Headline --}}
                    <h2 class="mt-5 text-3xl font-black tracking-tight text-slate-900 sm:text-4xl lg:text-[2.65rem] leading-[1.12]">
                        Why choose <br class="hidden sm:inline" />
                        <span class="text-[#144b9e]">Next Level Packers?</span>
                    </h2>

                    {{-- Intro Body Paragraph --}}
                    <p class="mt-4 text-sm leading-relaxed text-slate-600 sm:text-base">
                        Relocation is more than transporting boxes — it is safely moving your life's valuables. Since {{ $site['founded_year'] }}, Next Level has replaced moving stress with verified full-time crews, 5-ply defensive packaging, and dedicated sealed GPS fleet across Tamil Nadu.
                    </p>

                    {{-- Core Value Checklist (Reference Image Style with Circular Check Icons) --}}
                    <div class="mt-8 space-y-4">

                        {{-- Item 1: Pricing --}}
                        <div class="group flex items-start gap-3.5">
                            <div class="flex h-7 w-7 shrink-0 items-center justify-center rounded-full bg-blue-50 text-[#144b9e] border border-blue-200 transition-colors group-hover:bg-[#144b9e] group-hover:text-white">
                                <x-icon name="check-circle" class="h-4 w-4" />
                            </div>
                            <div>
                                <h3 class="text-sm font-bold text-slate-900 group-hover:text-[#144b9e] transition-colors">
                                    100% Guaranteed Written Pricing
                                </h3>
                                <p class="text-xs text-slate-500 leading-normal mt-0.5">
                                    Fixed, line-item contract with zero hidden fees, route surcharges, or delivery-day extortion.
                                </p>
                            </div>
                        </div>

                        {{-- Item 2: Protection --}}
                        <div class="group flex items-start gap-3.5">
                            <div class="flex h-7 w-7 shrink-0 items-center justify-center rounded-full bg-blue-50 text-[#144b9e] border border-blue-200 transition-colors group-hover:bg-[#144b9e] group-hover:text-white">
                                <x-icon name="check-circle" class="h-4 w-4" />
                            </div>
                            <div>
                                <h3 class="text-sm font-bold text-slate-900 group-hover:text-[#144b9e] transition-colors">
                                    5-Ply Defensive Damage Protection
                                </h3>
                                <p class="text-xs text-slate-500 leading-normal mt-0.5">
                                    High-density bubble wrap, heavy-duty corrugated cartons, edge guards &amp; custom wooden crates.
                                </p>
                            </div>
                        </div>

                        {{-- Item 3: Crew --}}
                        <div class="group flex items-start gap-3.5">
                            <div class="flex h-7 w-7 shrink-0 items-center justify-center rounded-full bg-blue-50 text-[#144b9e] border border-blue-200 transition-colors group-hover:bg-[#144b9e] group-hover:text-white">
                                <x-icon name="check-circle" class="h-4 w-4" />
                            </div>
                            <div>
                                <h3 class="text-sm font-bold text-slate-900 group-hover:text-[#144b9e] transition-colors">
                                    Zero Day Laborers — Verified Full-Time Crew
                                </h3>
                                <p class="text-xs text-slate-500 leading-normal mt-0.5">
                                    Background-checked, uniformed shifting specialists skilled in fragile electronics, glassware &amp; heavy appliances.
                                </p>
                            </div>
                        </div>

                        {{-- Item 4: Dedicated Transit --}}
                        <div class="group flex items-start gap-3.5">
                            <div class="flex h-7 w-7 shrink-0 items-center justify-center rounded-full bg-blue-50 text-[#144b9e] border border-blue-200 transition-colors group-hover:bg-[#144b9e] group-hover:text-white">
                                <x-icon name="check-circle" class="h-4 w-4" />
                            </div>
                            <div>
                                <h3 class="text-sm font-bold text-slate-900 group-hover:text-[#144b9e] transition-colors">
                                    Dedicated Sealed GPS Fleet
                                </h3>
                                <p class="text-xs text-slate-500 leading-normal mt-0.5">
                                    Your belongings travel in dedicated enclosed vehicles. No shared cargo, zero roadside transshipment.
                                </p>
                            </div>
                        </div>

                        {{-- Item 5: Reassembly --}}
                        <div class="group flex items-start gap-3.5">
                            <div class="flex h-7 w-7 shrink-0 items-center justify-center rounded-full bg-blue-50 text-[#144b9e] border border-blue-200 transition-colors group-hover:bg-[#144b9e] group-hover:text-white">
                                <x-icon name="check-circle" class="h-4 w-4" />
                            </div>
                            <div>
                                <h3 class="text-sm font-bold text-slate-900 group-hover:text-[#144b9e] transition-colors">
                                    Complete Doorstep Reassembly &amp; Placement
                                </h3>
                                <p class="text-xs text-slate-500 leading-normal mt-0.5">
                                    Room-by-room positioning, bed and wardrobe reassembly, and full packing debris haul-away.
                                </p>
                            </div>
                        </div>

                    </div>

                    {{-- Call-To-Action Button Row (Matching Reference Button Style) --}}
                    <div class="mt-9 pt-6 border-t border-slate-100 flex flex-col sm:flex-row sm:items-center gap-3.5">
                        <a href="{{ route('contact') }}#get-a-quote"
                            class="inline-flex items-center justify-center gap-2.5 rounded-2xl bg-[#144b9e] px-7 py-3.5 text-xs sm:text-sm font-black text-white shadow-xl shadow-blue-900/30 transition-all duration-300 hover:bg-[#0f3c80] hover:scale-[1.02] hover:shadow-2xl">
                            <span>Get Free Shifting Quote</span>
                            <x-icon name="external" class="h-4 w-4 text-sky-300" />
                        </a>

                        <a href="tel:{{ $site['phone_e164'] }}"
                            class="inline-flex items-center justify-center gap-2 rounded-2xl border border-slate-200 bg-slate-50 px-5 py-3.5 text-xs sm:text-sm font-bold text-slate-700 transition hover:bg-slate-100 hover:text-[#144b9e] hover:border-blue-200">
                            <x-icon name="phone" class="h-4 w-4 text-[#144b9e]" />
                            <span>{{ $site['phone_display'] }}</span>
                        </a>
                    </div>

                    {{-- Trust Micro-footer --}}
                    <div class="mt-4 flex items-center justify-between text-[11px] text-slate-400 font-medium">
                        <span class="flex items-center gap-1.5 text-emerald-600 font-semibold">
                            <x-icon name="shield" class="h-3.5 w-3.5" />
                            100% Transit Insured Service
                        </span>
                        <span>Free On-Site or Video Survey</span>
                    </div>

                </div>
            </div>

            {{-- ============================================================
                 RIGHT COLUMN: AMBIENT FLOATING PROOF PILLS OVER THE PANORAMIC VIEW
                 Highlights credentials, stats, and real-time fleet guarantee
                 ============================================================ --}}
            <div class="hidden lg:flex lg:col-span-5 xl:col-span-6 flex-col justify-between h-full min-h-[520px] py-4">

                {{-- Top Floating Rating Badge --}}
                <div class="self-end">
                    <div class="inline-flex items-center gap-3 rounded-2xl border border-white/25 bg-slate-900/60 p-4 text-white shadow-2xl backdrop-blur-md transition-all duration-300 hover:border-white/40 hover:bg-slate-900/70 hover:scale-105">
                        <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-amber-400/20 border border-amber-300/40 text-amber-300">
                            <x-icon name="star" class="h-6 w-6 fill-amber-400 text-amber-400" />
                        </div>
                        <div>
                            <div class="flex items-center gap-1.5">
                                <span class="text-base font-black text-white">4.9 / 5.0</span>
                                <span class="text-xs text-amber-300 font-bold">★★★★★</span>
                            </div>
                            <p class="text-xs text-slate-200 mt-0.5">
                                8,500+ Verified Relocations
                            </p>
                        </div>
                    </div>
                </div>

                {{-- Middle Live GPS & Direct Fleet Badge --}}
                <div class="self-center">
                    <div class="inline-flex items-center gap-3.5 rounded-2xl border border-white/20 bg-black/45 px-5 py-3.5 text-white shadow-2xl backdrop-blur-md transition-all duration-300 hover:border-sky-400/40 hover:bg-black/60 hover:scale-105">
                        <div class="relative flex h-3 w-3">
                            <span class="absolute inline-flex h-full w-full animate-ping rounded-full bg-emerald-400 opacity-75"></span>
                            <span class="relative inline-flex h-3 w-3 rounded-full bg-emerald-500"></span>
                        </div>
                        <div>
                            <p class="text-xs font-black tracking-wide text-white uppercase">
                                Real-Time GPS Tracking Fleet
                            </p>
                            <p class="text-[11px] text-slate-300 mt-0.5">
                                Direct route &bull; Zero intermediate hub offloading
                            </p>
                        </div>
                    </div>
                </div>

                {{-- Bottom Damage-Free Guarantee Badge --}}
                <div class="self-end">
                    <div class="inline-flex items-center gap-4 rounded-2xl border border-white/25 bg-slate-900/70 p-4 text-white shadow-2xl backdrop-blur-md transition-all duration-300 hover:border-white/40 hover:bg-slate-900/80 hover:scale-105">
                        <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-[#144b9e]/50 border border-blue-400/30 text-sky-300">
                            <x-icon name="medal" class="h-6 w-6" />
                        </div>
                        <div>
                            <div class="flex items-baseline gap-1">
                                <span class="text-xl font-black text-white">99.4%</span>
                                <span class="text-xs font-semibold text-emerald-400">Damage-Free Rate</span>
                            </div>
                            <p class="text-xs text-slate-300 mt-0.5">
                                10+ Years of Safe Shifting
                            </p>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</section>
