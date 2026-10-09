<section class="relative isolate overflow-hidden bg-[#144b9e]">

    {{-- =========================================================
        BACKGROUND DESIGN
    ========================================================== --}}
    <div class="pointer-events-none absolute inset-0 -z-10 overflow-hidden" aria-hidden="true">

        {{-- Soft radial glows --}}
        <div
            class="absolute left-1/2 top-[-280px] h-[700px] w-[1000px] -translate-x-1/2 rounded-full bg-white/[0.07] blur-3xl">
        </div>
        <div
            class="absolute bottom-[-350px] left-1/2 h-[700px] w-[1100px] -translate-x-1/2 rounded-full bg-[#6ea8ff]/10 blur-3xl">
        </div>

        {{-- Grid texture --}}
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

        {{-- Route / map rings --}}
        <div
            class="absolute -left-[280px] top-1/2 h-[720px] w-[720px] -translate-y-1/2 rounded-full border border-white/[0.07]">
        </div>
        <div
            class="absolute -left-[190px] top-1/2 h-[540px] w-[540px] -translate-y-1/2 rounded-full border border-white/[0.06]">
        </div>
        <div
            class="absolute -left-[110px] top-1/2 h-[380px] w-[380px] -translate-y-1/2 rounded-full border border-white/[0.05]">
        </div>

        <div class="absolute -right-[280px] top-[18%] h-[680px] w-[680px] rounded-full border border-white/[0.06]">
        </div>
        <div class="absolute -right-[190px] top-[25%] h-[500px] w-[500px] rounded-full border border-white/[0.05]">
        </div>

        {{-- Decorative route lines --}}
        <svg class="absolute left-0 top-[18%] h-[65%] w-full opacity-[0.18]" viewBox="0 0 1440 700" fill="none"
            preserveAspectRatio="none">
            <path
                d="M-80 570 C120 570 110 180 330 210 C500 235 470 520 650 470 C820 420 760 130 980 160 C1160 185 1080 500 1510 430"
                stroke="white" stroke-width="1.5" stroke-dasharray="7 11" />
            <path
                d="M-100 120 C180 60 250 350 440 300 C600 255 650 80 830 110 C1050 150 1020 390 1210 350 C1320 325 1390 250 1510 250"
                stroke="white" stroke-width="1" stroke-dasharray="3 12" />
        </svg>

        {{-- Route nodes --}}
        <div class="absolute left-[14%] top-[27%]">
            <div class="h-2.5 w-2.5 rounded-full bg-white/60 shadow-[0_0_25px_rgba(255,255,255,.7)]"></div>
            <div class="absolute inset-[-8px] rounded-full border border-white/20"></div>
        </div>

        <div class="absolute right-[18%] top-[32%]">
            <div class="h-2 w-2 rounded-full bg-white/50 shadow-[0_0_20px_rgba(255,255,255,.7)]"></div>
            <div class="absolute inset-[-7px] rounded-full border border-white/20"></div>
        </div>

        <div class="absolute left-[22%] bottom-[23%]">
            <div class="h-2 w-2 rounded-full bg-white/40"></div>
            <div class="absolute inset-[-7px] rounded-full border border-white/15"></div>
        </div>

        <div class="absolute right-[12%] bottom-[20%]">
            <div class="h-2.5 w-2.5 rounded-full bg-white/50"></div>
            <div class="absolute inset-[-8px] rounded-full border border-white/15"></div>
        </div>

        {{-- Diagonal lines --}}
        <div
            class="absolute -right-[10%] top-[42%] h-px w-[45%] rotate-[-22deg] bg-gradient-to-r from-transparent via-white/10 to-transparent">
        </div>
        <div
            class="absolute -left-[10%] top-[62%] h-px w-[40%] rotate-[18deg] bg-gradient-to-r from-transparent via-white/10 to-transparent">
        </div>

        {{-- Subtle vignette --}}
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_center,transparent_20%,rgba(5,30,75,.22)_100%)]">
        </div>
    </div>

    {{-- =========================================================
        HERO CONTENT
    ========================================================== --}}
    <div class="mx-auto max-w-6xl px-6 pb-20 pt-24 text-center sm:pb-28 sm:pt-36 lg:pb-32">

        {{-- Brand badge --}}
        <div class="flex justify-center">
            <div
                class="inline-flex items-center gap-2 rounded-full border border-white/20 bg-white/10 px-4 py-1.5 text-xs font-semibold uppercase tracking-[0.16em] text-white/90 backdrop-blur-sm">
                <span class="h-2 w-2 rounded-full bg-emerald-400"></span>
                Trusted Moving Partner
            </div>
        </div>

        {{-- Main heading --}}
        <h1 class="mx-auto mt-6 max-w-5xl text-center font-black tracking-tight text-white">
            <span
                class="block text-5xl sm:text-7xl md:text-8xl lg:text-9xl uppercase tracking-wider text-transparent bg-clip-text bg-gradient-to-r from-white via-white/90 to-white/70">
                Next Level
            </span>
            <span
                class="mt-3 block text-xl font-medium tracking-widest uppercase text-white/80 sm:text-3xl md:text-4xl">
                Packers & Movers <span class="text-white/50 font-light">|</span> Erode & Tamil Nadu
            </span>
        </h1>

        {{-- Tagline --}}
        <p class="mt-6 text-xl font-bold text-white sm:text-2xl">
            Stress-Free Shifting Starts Here
        </p>


        {{-- CTA buttons --}}
        <div class="mt-9 flex flex-col items-center justify-center gap-3 sm:flex-row">
            <a href="#quote"
                class="group inline-flex w-full sm:w-auto items-center justify-center rounded-full bg-white px-8 py-3.5 text-sm font-bold text-[#144b9e] shadow-xl shadow-black/10 transition-all duration-200 hover:-translate-y-0.5 hover:bg-white/95 focus-visible:outline focus-visible:outline-2 focus-visible:outline-white">
                Get Free Quote
                <span
                    class="ml-2 flex h-6 w-6 items-center justify-center rounded-full bg-[#144b9e] text-white transition-transform group-hover:translate-x-0.5">
                    →
                </span>
            </a>

            <a href="tel:+919363555311"
                class="inline-flex w-full sm:w-auto items-center justify-center rounded-full border border-white/25 bg-white/10 px-8 py-3.5 text-sm font-semibold text-white backdrop-blur-sm transition-all duration-200 hover:-translate-y-0.5 hover:bg-white/15 focus-visible:outline focus-visible:outline-2 focus-visible:outline-white">
                Call +91 93635 55311
            </a>
        </div>

        {{-- Trust points --}}
        <div
            class="mx-auto mt-10 flex max-w-3xl flex-wrap items-center justify-center gap-x-7 gap-y-3 text-sm text-white/70">
            <span class="flex items-center gap-2">
                <span class="font-bold text-white">✓</span>
                Professional Packing
            </span>

            <span class="hidden h-4 w-px bg-white/20 sm:block"></span>

            <span class="flex items-center gap-2">
                <span class="font-bold text-white">✓</span>
                Safe Transportation
            </span>

            <span class="hidden h-4 w-px bg-white/20 sm:block"></span>

            <span class="flex items-center gap-2">
                <span class="font-bold text-white">✓</span>
                Door-to-Door Delivery
            </span>
        </div>

        {{-- Stats grid --}}
        <div
            class="mx-auto mt-16 grid max-w-3xl grid-cols-2 overflow-hidden rounded-3xl border border-white/15 bg-white/[0.07] backdrop-blur-sm sm:grid-cols-4">
            <div class="px-5 py-6">
                <p class="text-2xl font-black text-white sm:text-3xl">10+</p>
                <p class="mt-1 text-xs text-white/50">Years Experience</p>
            </div>

            <div class="border-l border-white/10 px-5 py-6">
                <p class="text-2xl font-black text-white sm:text-3xl">10K+</p>
                <p class="mt-1 text-xs text-white/50">Successful Moves</p>
            </div>

            <div class="border-t border-white/10 px-5 py-6 sm:border-l sm:border-t-0">
                <p class="text-2xl font-black text-white sm:text-3xl">50+</p>
                <p class="mt-1 text-xs text-white/50">Moving Professionals</p>
            </div>

            <div class="border-l border-white/10 border-t px-5 py-6 sm:border-t-0">
                <p class="text-2xl font-black text-white sm:text-3xl">25+</p>
                <p class="mt-1 text-xs text-white/50">Service Locations</p>
            </div>
        </div>

        {{-- Locations list --}}
        <div class="mt-12 text-center">
            <p class="text-[11px] font-semibold uppercase tracking-[0.25em] text-white/35">
                Serving Across Tamil Nadu & Beyond
            </p>

            <p class="mt-3 text-sm text-white/55">
                Erode · Tiruchengode · Namakkal · Salem · Coimbatore · Tiruppur · Karur · Chennai · Bangalore
            </p>
        </div>

    </div>
</section>
