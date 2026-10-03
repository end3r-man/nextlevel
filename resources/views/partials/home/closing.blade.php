@php
    $site = config('site');
@endphp

{{-- =========================================================================
     CLOSING CTA: High-Impact Conversion Banner
     ========================================================================= --}}
<section class="relative isolate overflow-hidden bg-[#144b9e] py-20 sm:py-28 text-white text-center">

    {{-- Hero-matching ambient glows and grid texture --}}
    <div class="pointer-events-none absolute inset-0 -z-10 overflow-hidden" aria-hidden="true">
        <div class="absolute left-1/2 top-[-200px] h-[600px] w-[900px] -translate-x-1/2 rounded-full bg-white/[0.08] blur-3xl"></div>
        <div class="absolute bottom-[-200px] left-1/2 h-[600px] w-[1000px] -translate-x-1/2 rounded-full bg-[#6ea8ff]/20 blur-3xl"></div>

        {{-- Grid texture --}}
        <div class="absolute inset-0 opacity-[0.06]"
            style="
                background-image:
                    linear-gradient(rgba(255,255,255,.8) 1px, transparent 1px),
                    linear-gradient(90deg, rgba(255,255,255,.8) 1px, transparent 1px);
                background-size: 60px 60px;
                mask-image: linear-gradient(to bottom, transparent, black 20%, black 80%, transparent);
            ">
        </div>

        {{-- Subtle route rings --}}
        <div class="absolute -left-[250px] top-1/2 h-[600px] w-[600px] -translate-y-1/2 rounded-full border border-white/[0.06]"></div>
        <div class="absolute -right-[250px] top-1/2 h-[600px] w-[600px] -translate-y-1/2 rounded-full border border-white/[0.06]"></div>
    </div>

    <div class="container-page relative">
        <div class="flex flex-col items-center max-w-3xl mx-auto">
            <div class="inline-flex items-center gap-2 rounded-full border border-white/20 bg-white/10 px-4 py-1.5 text-xs font-semibold uppercase tracking-[0.16em] text-white/90 backdrop-blur-sm">
                <span class="h-2 w-2 rounded-full bg-white"></span>
                Same-Day Free Assessment
            </div>

            <h2 class="mt-6 text-3xl font-black tracking-tight text-white sm:text-5xl md:text-6xl leading-[1.08]">
                Ready for a Stress-Free Move?
            </h2>

            <p class="mt-5 text-base sm:text-lg text-white/75 leading-relaxed max-w-2xl">
                Get a firm, fixed written quotation today. Our verified in-house team is ready to deliver an effortless shifting experience across Tamil Nadu.
            </p>

            <div class="mt-9 flex flex-col sm:flex-row items-center justify-center gap-3.5 w-full">
                <a href="#get-a-quote"
                   class="group inline-flex w-full sm:w-auto items-center justify-center rounded-full bg-white px-8 py-4 text-sm font-bold text-[#144b9e] shadow-xl shadow-black/10 transition-all duration-200 hover:-translate-y-0.5 hover:bg-white/95 cursor-pointer">
                    <span>Get Free Written Quote</span>
                    <span class="ml-2 flex h-6 w-6 items-center justify-center rounded-full bg-[#144b9e] text-white transition-transform group-hover:translate-x-0.5 text-xs">
                        →
                    </span>
                </a>

                <a href="tel:{{ $site['phone_e164'] }}"
                   class="inline-flex w-full sm:w-auto items-center justify-center gap-2 rounded-full border border-white/25 bg-white/10 px-8 py-4 text-sm font-semibold text-white backdrop-blur-sm transition-all duration-200 hover:-translate-y-0.5 hover:bg-white/15">
                    <x-icon name="phone" class="w-4 h-4 text-white" />
                    <span>Call {{ $site['phone_display'] }}</span>
                </a>

                <a href="{{ $site['whatsapp_url'] }}" target="_blank" rel="noopener"
                   class="inline-flex w-full sm:w-auto items-center justify-center gap-2 rounded-full bg-[#25D366] px-7 py-4 text-sm font-bold text-white shadow-lg transition-all duration-200 hover:-translate-y-0.5 hover:bg-[#20bd5a]">
                    <x-icon name="whatsapp" class="w-4 h-4" />
                    <span>WhatsApp</span>
                </a>
            </div>

            <p class="mt-8 text-xs text-white/55">
                ⭐ Rated {{ $site['rating']['value'] }}/5 across {{ number_format($site['rating']['count']) }}+ Google Reviews &middot; ISO Certified &middot; GST Registered
            </p>
        </div>
    </div>
</section>

