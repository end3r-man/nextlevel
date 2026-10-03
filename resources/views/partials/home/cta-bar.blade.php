@php
    $site = config('site');
@endphp

{{-- =========================================================================
     CTA RIBBON BAR: 24/7 Support & Direct Phone Quote
     ========================================================================= --}}
<section class="relative isolate overflow-hidden bg-[#144b9e] py-14 sm:py-16 text-white">

    {{-- Hero-matching ambient glows and grid texture --}}
    <div class="pointer-events-none absolute inset-0 -z-10 overflow-hidden" aria-hidden="true">
        <div class="absolute left-1/4 top-[-100px] h-[300px] w-[500px] rounded-full bg-white/[0.08] blur-3xl"></div>
        <div class="absolute right-1/4 bottom-[-100px] h-[300px] w-[500px] rounded-full bg-[#6ea8ff]/20 blur-3xl"></div>

        <div class="absolute inset-0 opacity-[0.06]"
            style="
                background-image:
                    linear-gradient(rgba(255,255,255,.8) 1px, transparent 1px),
                    linear-gradient(90deg, rgba(255,255,255,.8) 1px, transparent 1px);
                background-size: 50px 50px;
                mask-image: linear-gradient(to bottom, transparent, black 20%, black 80%, transparent);
            ">
        </div>
    </div>

    <div class="container-page relative">
        <div class="flex flex-col lg:flex-row items-center justify-between gap-8">
            
            {{-- Left Feature Highlights --}}
            <div class="flex flex-wrap items-center justify-center lg:justify-start gap-5 sm:gap-7">
                <div class="flex items-center gap-2.5">
                    <span class="h-2 w-2 rounded-full bg-white shadow-[0_0_10px_white]"></span>
                    <span class="text-xs sm:text-sm font-bold uppercase tracking-wider text-white/90">24×7 Customer Support</span>
                </div>
                <div class="flex items-center gap-2.5">
                    <span class="h-2 w-2 rounded-full bg-white shadow-[0_0_10px_white]"></span>
                    <span class="text-xs sm:text-sm font-bold uppercase tracking-wider text-white/90">Best Packing Service</span>
                </div>
                <div class="flex items-center gap-2.5">
                    <span class="h-2 w-2 rounded-full bg-white shadow-[0_0_10px_white]"></span>
                    <span class="text-xs sm:text-sm font-bold uppercase tracking-wider text-white/90">Professional Handling</span>
                </div>
                <div class="flex items-center gap-2.5">
                    <span class="h-2 w-2 rounded-full bg-white shadow-[0_0_10px_white]"></span>
                    <span class="text-xs sm:text-sm font-bold uppercase tracking-wider text-white/90">Instant Response</span>
                </div>
            </div>

            {{-- Right Phone Number & Contact CTA --}}
            <div class="flex flex-col sm:flex-row items-center gap-5 shrink-0 text-center lg:text-right">
                <div>
                    <span class="block text-[11px] font-bold tracking-widest uppercase text-white/60">Call For Free Estimate</span>
                    <a href="tel:{{ $site['phone_e164'] }}" class="text-xl sm:text-2xl font-black text-white hover:text-white/80 transition tracking-tight">
                        {{ $site['phone_display'] }}
                    </a>
                </div>
                <a href="{{ route('contact') }}"
                    class="group inline-flex items-center justify-center rounded-full bg-white px-7 py-3.5 text-sm font-bold text-[#144b9e] shadow-xl transition-all duration-200 hover:-translate-y-0.5 hover:bg-white/95">
                    <span>Contact Us</span>
                    <span class="ml-2 flex h-6 w-6 items-center justify-center rounded-full bg-[#144b9e] text-white transition-transform group-hover:translate-x-0.5 text-xs">
                        →
                    </span>
                </a>
            </div>

        </div>
    </div>
</section>

