@php
    $site = config('site');
@endphp

@if ($faqs->isNotEmpty())
    {{-- =========================================================================
         FREQUENTLY ASKED QUESTIONS SECTION: Clear Answers, No Jargon
         Interactive Modern Accordion with Ambient Background & Help Desk Card
         ========================================================================= --}}
    <section class="relative isolate overflow-hidden bg-slate-50/80 py-24 sm:py-28 lg:py-32" id="faq">

        {{-- ================================================================
             AMBIENT BACKGROUND & GRAPHIC ACCENTS
             ================================================================ --}}
        <div class="pointer-events-none absolute inset-0 -z-10 overflow-hidden select-none" aria-hidden="true">
            {{-- Soft Ambient Glows --}}
            <div class="absolute -top-32 right-1/4 h-[500px] w-[700px] rounded-full bg-blue-100/50 blur-[130px]"></div>
            <div class="absolute -bottom-32 left-1/4 h-[550px] w-[800px] rounded-full bg-sky-100/50 blur-[140px]"></div>

            {{-- Subtle Dot Grid Pattern --}}
            <div class="absolute inset-0 opacity-[0.3]"
                style="background-image: radial-gradient(circle, #cbd5e1 1px, transparent 1px); background-size: 28px 28px;">
            </div>

            {{-- Watermark Typography --}}
            <div
                class="absolute -right-8 top-1/2 -translate-y-1/2 text-[14rem] font-black tracking-tighter text-slate-200/35 sm:text-[18rem] lg:text-[22rem] select-none">
                FAQ
            </div>
        </div>

        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid gap-12 lg:grid-cols-12 lg:gap-16 items-start">

                {{-- ============================================================
                     LEFT COLUMN: EDITORIAL PITCH & STICKY HELP DESK CARD
                     ============================================================ --}}
                <div class="lg:col-span-4 lg:sticky lg:top-28">

                    {{-- Category Pill Badge --}}
                    <div
                        class="inline-flex items-center gap-2.5 rounded-full border border-blue-200 bg-blue-50/90 px-4 py-1.5 text-xs font-bold uppercase tracking-[0.2em] text-[#144b9e] shadow-sm">
                        <span class="relative flex h-2 w-2">
                            <span class="absolute inline-flex h-full w-full animate-ping rounded-full bg-blue-400 opacity-75"></span>
                            <span class="relative inline-flex h-2 w-2 rounded-full bg-[#144b9e]"></span>
                        </span>
                        <span>Knowledge Base &amp; FAQ</span>
                    </div>

                    {{-- Main Headline --}}
                    <h2 class="mt-6 text-3xl font-black tracking-tight text-slate-900 sm:text-4xl lg:text-5xl leading-[1.12]">
                        Everything to know <br />
                        <span class="text-[#144b9e]">before moving.</span>
                    </h2>

                    <p class="mt-4 text-sm sm:text-base leading-relaxed text-slate-600">
                        Honest, straightforward answers regarding written quotes, 5-ply defensive packing materials, insurance policies, and move timelines across Tamil Nadu.
                    </p>

                    {{-- Senior Move Coordinator Help Desk Card --}}
                    <div class="mt-8 rounded-3xl border border-blue-100 bg-white p-7 shadow-xl shadow-blue-900/5 transition-all duration-300 hover:shadow-2xl hover:border-blue-200">
                        <div class="flex items-center gap-3">
                            <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-blue-50 border border-blue-100 text-[#144b9e]">
                                <x-icon name="phone" class="h-6 w-6" />
                            </div>
                            <div>
                                <h3 class="text-base font-bold text-slate-900">Have a specific question?</h3>
                                <p class="text-xs text-slate-500 mt-0.5">Talk to our move coordinator</p>
                            </div>
                        </div>

                        <p class="mt-4 text-xs leading-relaxed text-slate-600">
                            Get an instantaneous estimate or schedule a quick video survey with zero booking pressure.
                        </p>

                        <div class="mt-6 flex flex-col gap-3">
                            <a href="tel:{{ $site['phone_e164'] }}"
                                class="inline-flex w-full items-center justify-center gap-2 rounded-2xl bg-[#144b9e] py-3.5 px-5 text-xs font-black text-white shadow-lg shadow-blue-900/20 transition hover:bg-[#0f3c80] hover:scale-[1.02]">
                                <x-icon name="phone" class="h-3.5 w-3.5 text-sky-300" />
                                <span>Call {{ $site['phone_display'] }}</span>
                            </a>

                            <a href="{{ $site['whatsapp_url'] }}" target="_blank" rel="noopener noreferrer"
                                class="inline-flex w-full items-center justify-center gap-2 rounded-2xl border border-emerald-200 bg-emerald-50/80 py-3 px-5 text-xs font-bold text-emerald-800 transition hover:bg-emerald-100">
                                <x-icon name="whatsapp" class="h-3.5 w-3.5 text-emerald-600" />
                                <span>Quick WhatsApp Chat</span>
                            </a>

                            <a href="{{ route('faq') }}"
                                class="inline-flex w-full items-center justify-center gap-2 rounded-2xl border border-slate-200 bg-slate-50 py-3 px-5 text-xs font-bold text-slate-700 transition hover:bg-slate-100 hover:text-[#144b9e]">
                                <span>View Full FAQ Hub</span>
                                <x-icon name="arrow-right" class="h-3.5 w-3.5 text-[#144b9e]" />
                            </a>
                        </div>
                    </div>

                </div>

                {{-- ============================================================
                     RIGHT COLUMN: INTERACTIVE ACCORDION CARDS
                     Clean, elevated separate cards with smooth icon transitions
                     ============================================================ --}}
                <div class="lg:col-span-8 space-y-4" data-accordion="single">

                    @foreach ($faqs as $index => $faq)
                        <div class="rounded-3xl border border-slate-200/90 bg-white p-6 sm:p-7 shadow-sm transition-all duration-300 hover:border-blue-300 hover:shadow-xl hover:shadow-blue-900/5">

                            {{-- Accordion Trigger --}}
                            <button type="button" data-accordion-trigger aria-expanded="false"
                                class="group flex w-full items-start justify-between gap-4 text-left cursor-pointer focus:outline-none">

                                <div class="flex items-start gap-3.5">
                                    <span class="inline-flex h-7 w-7 shrink-0 items-center justify-center rounded-xl bg-blue-50 border border-blue-100 text-xs font-black text-[#144b9e] transition-colors group-hover:bg-[#144b9e] group-hover:text-white">
                                        {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
                                    </span>

                                    <h3 class="text-base sm:text-lg font-bold text-slate-900 leading-snug transition-colors group-hover:text-[#144b9e]">
                                        {{ $faq->question }}
                                    </h3>
                                </div>

                                <span class="inline-flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-slate-50 text-[#144b9e] border border-slate-200/80 shadow-sm transition-transform duration-300 group-hover:bg-blue-50">
                                    <x-icon name="chevron-down" data-accordion-icon class="h-4 w-4 transition-transform duration-300" />
                                </span>
                            </button>

                            {{-- Accordion Panel (Sibling to trigger) --}}
                            <div class="hidden pt-4 border-t border-slate-100 mt-4 pl-10 pr-2">
                                <p class="text-sm leading-relaxed text-slate-600 font-normal">
                                    {{ $faq->answer }}
                                </p>

                                <div class="mt-3 flex items-center gap-1.5 text-[11px] font-semibold text-emerald-600">
                                    <x-icon name="check-circle" class="h-3.5 w-3.5" />
                                    <span>Next Level Guaranteed Service Policy</span>
                                </div>
                            </div>

                        </div>
                    @endforeach

                </div>

            </div>

            {{-- ================================================================
                 BOTTOM ESTIMATE CALLOUT BAR
                 ================================================================ --}}
            <div
                class="mt-14 rounded-3xl border border-blue-100 bg-gradient-to-r from-blue-50/90 via-white to-sky-50/90 p-6 sm:p-8 shadow-sm">
                <div class="flex flex-col gap-5 sm:flex-row sm:items-center sm:justify-between">
                    <div class="flex items-center gap-4">
                        <div
                            class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-[#144b9e] text-white shadow-md shadow-blue-900/20">
                            <x-icon name="shield" class="h-6 w-6" />
                        </div>
                        <div>
                            <h4 class="text-base font-bold text-slate-900">
                                Ready to experience stress-free shifting?
                            </h4>
                            <p class="text-xs text-slate-500 mt-0.5">
                                Lock your preferred moving slot today &bull; 100% fixed line-item pricing guarantee
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
                            <span>Call {{ $site['phone_display'] }}</span>
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endif
