@php
    $site = config('site');
    // Fallback collection if database testimonials are not loaded
    $sampleTestimonials = [
        [
            'name' => 'Prakash',
            'location' => 'Erode to Perundurai',
            'designation' => 'Homeowner',
            'service' => 'House Shifting',
            'quote' =>
                'Moved a 3 BHK from Chithode to Perundurai Road. The packing was genuinely careful — the kitchen and the TV were wrapped in 5-ply protective sheets and nothing broke. Delivery was right on schedule. Worth every rupee.',
            'avatar' => 'images/rv1.png',
            'rating' => 5,
        ],
        [
            'name' => 'Ajith Selvan',
            'location' => 'Coimbatore',
            'designation' => 'Business Owner',
            'service' => 'Office Shifting',
            'quote' =>
                'We shifted our corporate office over the weekend and were completely operational by Monday morning. They handled our server racks and workstations with exceptional care. Well organized, zero downtime.',
            'avatar' => 'images/rev2.png',
            'rating' => 5,
        ],
        [
            'name' => 'Ramesh',
            'location' => 'Tiruppur',
            'designation' => 'Factory Owner',
            'service' => 'Industrial Relocation',
            'quote' =>
                'Relocated our textile unit from Avinashi Road to Palladam Road. Heavy machinery was custom crated and reinstalled cleanly. They timed the shutdown to the hour and saved us days of production downtime.',
            'avatar' => 'images/aut3.png',
            'rating' => 5,
        ],
    ];
@endphp

{{-- =========================================================================
     TESTIMONIALS SECTION: Royal Blue Hero Theme with Ambient Grid & Route Lines
     ========================================================================= --}}
<section class="relative isolate overflow-hidden bg-[#144b9e] py-24 sm:py-28 lg:py-32 text-white" id="reviews">

    {{-- ================================================================
         HERO-MATCHING BACKGROUND DESIGN & GLOWS
         ================================================================ --}}
    <div class="pointer-events-none absolute inset-0 -z-10 overflow-hidden select-none" aria-hidden="true">

        {{-- Soft Radial Glows --}}
        <div
            class="absolute left-1/2 top-[-240px] h-[700px] w-[1000px] -translate-x-1/2 rounded-full bg-white/[0.08] blur-3xl">
        </div>
        <div
            class="absolute bottom-[-300px] left-1/2 h-[700px] w-[1100px] -translate-x-1/2 rounded-full bg-[#6ea8ff]/15 blur-3xl">
        </div>
        <div class="absolute right-0 top-1/3 h-[500px] w-[500px] rounded-full bg-sky-400/10 blur-[130px]"></div>

        {{-- Hero Grid Texture --}}
        <div class="absolute inset-0 opacity-[0.07]"
            style="
                background-image:
                    linear-gradient(rgba(255,255,255,.8) 1px, transparent 1px),
                    linear-gradient(90deg, rgba(255,255,255,.8) 1px, transparent 1px);
                background-size: 70px 70px;
                mask-image: linear-gradient(
                    to bottom,
                    transparent,
                    black 15%,
                    black 75%,
                    transparent
                );
            ">
        </div>

        {{-- Route / Map Circles --}}
        <div
            class="absolute -left-[240px] top-1/2 h-[640px] w-[640px] -translate-y-1/2 rounded-full border border-white/[0.06]">
        </div>
        <div
            class="absolute -left-[160px] top-1/2 h-[480px] w-[480px] -translate-y-1/2 rounded-full border border-white/[0.05]">
        </div>
        <div class="absolute -right-[240px] top-[20%] h-[600px] w-[600px] rounded-full border border-white/[0.06]">
        </div>

        {{-- Decorative Route Lines --}}
        <svg class="absolute left-0 top-[12%] h-[75%] w-full opacity-20 pointer-events-none" viewBox="0 0 1440 700"
            fill="none" preserveAspectRatio="none">
            <path
                d="M-80 570 C120 570 110 180 330 210 C500 235 470 520 650 470 C820 420 760 130 980 160 C1160 185 1080 500 1510 430"
                stroke="white" stroke-width="1.5" stroke-dasharray="7 11" />
            <path
                d="M-100 120 C180 60 250 350 440 300 C600 255 650 80 830 110 C1050 150 1020 390 1210 350 C1320 325 1390 250 1510 250"
                stroke="white" stroke-width="1" stroke-dasharray="3 12" />
        </svg>

        {{-- Route Nodes --}}
        <div class="absolute left-[15%] top-[25%]">
            <div class="h-2.5 w-2.5 rounded-full bg-white/70 shadow-[0_0_20px_rgba(255,255,255,.9)]"></div>
            <div class="absolute -inset-2 rounded-full border border-white/20"></div>
        </div>
        <div class="absolute right-[18%] bottom-[25%]">
            <div class="h-2 w-2 rounded-full bg-sky-300 shadow-[0_0_18px_rgba(56,189,248,.8)]"></div>
            <div class="absolute -inset-2 rounded-full border border-sky-300/30"></div>
        </div>

        {{-- Vignette Overlay --}}
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_center,transparent_20%,rgba(5,30,75,.28)_100%)]">
        </div>
    </div>

    <div class="container mx-auto px-4 sm:px-6 lg:px-8">

        {{-- ================================================================
             SECTION HEADER & RATING SUMMARY
             ================================================================ --}}
        <div class="flex flex-col lg:flex-row lg:items-end lg:justify-between gap-8">
            <div class="max-w-2xl">
                {{-- Category Pill Badge --}}
                <div
                    class="inline-flex items-center gap-2 rounded-full border border-white/20 bg-white/10 px-4 py-1.5 text-xs font-bold uppercase tracking-[0.2em] text-white backdrop-blur-md shadow-inner">
                    <span class="h-2 w-2 rounded-full bg-amber-400 animate-pulse"></span>
                    <span>Verified Customer Reviews</span>
                </div>

                {{-- Main Headline --}}
                <h2 class="mt-6 text-3xl font-black tracking-tight text-white sm:text-5xl lg:text-6xl leading-[1.1]">
                    Real families, real moves.<br />
                    <span class="text-sky-300">Hear what they say.</span>
                </h2>

                <p class="mt-4 text-base text-white/75 sm:text-lg leading-relaxed">
                    Over 8,500 homes, offices, and commercial spaces relocated across South India with certified
                    five-star care and zero hidden charges.
                </p>
            </div>

            {{-- Frosted Rating Summary Card --}}
            <div
                class="flex items-center gap-5 rounded-3xl border border-white/20 bg-white/10 p-6 backdrop-blur-xl shadow-2xl shrink-0">
                <div class="text-center">
                    <span class="text-4xl font-black text-white leading-none">
                        {{ $site['rating']['value'] ?? '4.9' }}
                    </span>
                    <div class="flex items-center justify-center gap-1 text-amber-300 mt-1.5">
                        @for ($i = 0; $i < 5; $i++)
                            <x-icon name="star" class="h-4 w-4 fill-amber-300 text-amber-300" />
                        @endfor
                    </div>
                </div>

                <div class="border-l border-white/20 pl-5">
                    <span class="text-sm font-bold text-white block">
                        Rated {{ $site['rating']['value'] ?? '4.9' }} / 5.0
                    </span>
                    <span class="text-xs text-sky-200 mt-0.5 block font-medium">
                        Over {{ number_format($site['rating']['count'] ?? 850) }}+ Verified Reviews
                    </span>
                    <span class="inline-flex items-center gap-1 text-[11px] text-emerald-300 font-semibold mt-1">
                        <x-icon name="shield" class="h-3 w-3" />
                        100% Genuine Client Feedback
                    </span>
                </div>
            </div>
        </div>

        {{-- ================================================================
             TESTIMONIALS CARDS (3-COLUMN BENTO TILES)
             ================================================================ --}}
        <div class="mt-14 sm:mt-16 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">

            @php
                $displayTestimonials =
                    !empty($testimonials) && $testimonials->isNotEmpty() ? $testimonials : collect($sampleTestimonials);
            @endphp

            @foreach ($displayTestimonials as $index => $item)
                @php
                    $isModel = $item instanceof \App\Models\Testimonial;
                    $name = $isModel ? $item->name : $item['name'];
                    $location = $isModel ? $item->location ?? 'Tamil Nadu' : $item['location'];
                    $designation = $isModel ? $item->designation ?? 'Verified Client' : $item['designation'];
                    $quote = $isModel ? $item->quote : $item['quote'];
                    $rating = $isModel ? $item->rating ?? 5 : $item['rating'] ?? 5;
                    $avatar = $isModel
                        ? $item->image ?? ($sampleTestimonials[$index]['avatar'] ?? 'images/rv1.png')
                        : $item['avatar'];
                    $serviceTag = $isModel
                        ? $item->service->name ?? 'House Shifting'
                        : $item['service'] ?? 'Household Move';
                @endphp

                <figure
                    class="group relative flex flex-col justify-between overflow-hidden rounded-3xl border border-white/20 bg-white/10 p-8 text-white backdrop-blur-xl shadow-xl transition-all duration-300 hover:-translate-y-2 hover:bg-white/[0.16] hover:border-white/35 hover:shadow-2xl hover:shadow-blue-950/50">

                    {{-- Background Watermark Quote Icon --}}
                    <x-icon name="quote"
                        class="absolute right-6 top-6 h-14 w-14 text-white/[0.07] transition-transform duration-500 group-hover:scale-125 group-hover:text-white/[0.14] pointer-events-none select-none" />

                    {{-- Card Header: Rating Stars & Verified Pill --}}
                    <div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-1 text-amber-300">
                                @for ($s = 0; $s < $rating; $s++)
                                    <x-icon name="star" class="h-4 w-4 fill-amber-300 text-amber-300" />
                                @endfor
                            </div>

                            <span
                                class="inline-flex items-center gap-1 rounded-full border border-emerald-400/30 bg-emerald-400/20 px-2.5 py-0.5 text-[11px] font-bold text-emerald-300 backdrop-blur-sm">
                                <x-icon name="check-circle" class="h-3 w-3 text-emerald-300" />
                                Verified Move
                            </span>
                        </div>

                        {{-- Service Chip --}}
                        <div class="mt-4">
                            <span
                                class="rounded-lg bg-white/10 px-2.5 py-1 text-[11px] font-semibold text-sky-200 border border-white/10">
                                {{ $serviceTag }}
                            </span>
                        </div>

                        {{-- Testimonial Quote --}}
                        <blockquote class="mt-5 text-sm sm:text-base leading-relaxed text-slate-100 font-normal">
                            &ldquo;{{ $quote }}&rdquo;
                        </blockquote>
                    </div>

                    {{-- Card Footer: Author Profile --}}
                    <figcaption class="mt-8 flex items-center gap-3.5 border-t border-white/15 pt-5">
                        <img src="{{ asset($avatar) }}" alt="{{ $name }}" width="44" height="44"
                            loading="lazy" decoding="async"
                            class="h-11 w-11 rounded-full object-cover border-2 border-white/30 shadow-md shrink-0">

                        <div class="min-w-0 flex-1">
                            <p class="truncate font-black text-white text-base leading-tight">
                                {{ $name }}
                            </p>
                            <p class="truncate text-xs text-sky-200/90 mt-0.5 font-medium">
                                {{ $designation }} &bull; {{ $location }}
                            </p>
                        </div>
                    </figcaption>

                </figure>
            @endforeach

        </div>

        {{-- ================================================================
             BOTTOM ACTION BUTTONS
             ================================================================ --}}
        <div class="mt-14 sm:mt-16 text-center flex flex-wrap items-center justify-center gap-4">
            <a href="{{ route('testimonials') }}"
                class="inline-flex items-center justify-center gap-2 rounded-full bg-white px-8 py-3.5 text-xs sm:text-sm font-black text-[#144b9e] shadow-xl shadow-blue-950/20 transition-all duration-300 hover:bg-sky-50 hover:scale-105">
                <span>Read All Customer Reviews</span>
                <x-icon name="arrow-right" class="h-4 w-4" />
            </a>

            <a href="{{ route('contact') }}#get-a-quote"
                class="inline-flex items-center justify-center gap-2 rounded-full border border-white/30 bg-white/10 px-7 py-3.5 text-xs sm:text-sm font-bold text-white transition hover:bg-white/20">
                <span>Book Your Relocation</span>
                <x-icon name="external" class="h-4 w-4 text-sky-300" />
            </a>
        </div>

    </div>
</section>
