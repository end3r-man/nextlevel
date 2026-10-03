{{-- =========================================================================
     STATS BANNER: 4 Core Milestones with Original Brand Badges
     ========================================================================= --}}
<section class="relative isolate overflow-hidden bg-[#144b9e] py-16 sm:py-20 text-white">

    {{-- Hero-matching ambient glows and grid texture --}}
    <div class="pointer-events-none absolute inset-0 -z-10 overflow-hidden" aria-hidden="true">
        <div
            class="absolute left-1/2 top-[-200px] h-[500px] w-[800px] -translate-x-1/2 rounded-full bg-white/[0.07] blur-3xl">
        </div>
        <div
            class="absolute bottom-[-200px] left-1/2 h-[500px] w-[900px] -translate-x-1/2 rounded-full bg-[#6ea8ff]/15 blur-3xl">
        </div>

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
        <div
            class="absolute -left-[200px] top-1/2 h-[500px] w-[500px] -translate-y-1/2 rounded-full border border-white/[0.06]">
        </div>
        <div
            class="absolute -right-[200px] top-1/2 h-[500px] w-[500px] -translate-y-1/2 rounded-full border border-white/[0.06]">
        </div>
    </div>

    <div class="container-page relative">
        <div class="grid grid-cols-2 gap-4 sm:gap-6 lg:grid-cols-4">

            <div
                class="group flex flex-col sm:flex-row items-center sm:items-start text-center sm:text-left gap-4 rounded-3xl border border-white/15 bg-white/[0.08] p-6 backdrop-blur-md transition-all duration-300 hover:-translate-y-1 hover:bg-white/[0.12] hover:border-white/25">
                <div
                    class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-white/10 p-2.5 border border-white/20 shadow-inner">
                    <img src="{{ asset('images/c1.png') }}" alt="Transportation icon" width="48" height="48"
                        class="h-9 w-9 object-contain brightness-0 invert">
                </div>
                <div>
                    <span class="text-3xl font-black text-white" data-counter="10000"
                        data-counter-suffix="+">10,000+</span>
                    <p class="text-xs text-white/70 font-medium mt-1">Successful Moves</p>
                </div>
            </div>

            <div
                class="group flex flex-col sm:flex-row items-center sm:items-start text-center sm:text-left gap-4 rounded-3xl border border-white/15 bg-white/[0.08] p-6 backdrop-blur-md transition-all duration-300 hover:-translate-y-1 hover:bg-white/[0.12] hover:border-white/25">
                <div
                    class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-white/10 p-2.5 border border-white/20 shadow-inner">
                    <img src="{{ asset('images/c2.png') }}" alt="Team icon" width="48" height="48"
                        class="h-9 w-9 object-contain brightness-0 invert">
                </div>
                <div>
                    <span class="text-3xl font-black text-white" data-counter="50" data-counter-suffix="+">50+</span>
                    <p class="text-xs text-white/70 font-medium mt-1">Expert Crew Members</p>
                </div>
            </div>

            <div
                class="group flex flex-col sm:flex-row items-center sm:items-start text-center sm:text-left gap-4 rounded-3xl border border-white/15 bg-white/[0.08] p-6 backdrop-blur-md transition-all duration-300 hover:-translate-y-1 hover:bg-white/[0.12] hover:border-white/25">
                <div
                    class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-white/10 p-2.5 border border-white/20 shadow-inner">
                    <img src="{{ asset('images/c3.png') }}" alt="Experience icon" width="48" height="48"
                        class="h-9 w-9 object-contain brightness-0 invert">
                </div>
                <div>
                    <span class="text-3xl font-black text-white" data-counter="10" data-counter-suffix="+">10+</span>
                    <p class="text-xs text-white/70 font-medium mt-1">Years Experience</p>
                </div>
            </div>

            <div
                class="group flex flex-col sm:flex-row items-center sm:items-start text-center sm:text-left gap-4 rounded-3xl border border-white/15 bg-white/[0.08] p-6 backdrop-blur-md transition-all duration-300 hover:-translate-y-1 hover:bg-white/[0.12] hover:border-white/25">
                <div
                    class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-white/10 p-2.5 border border-white/20 shadow-inner">
                    <img src="{{ asset('images/c4.png') }}" alt="Customers icon" width="48" height="48"
                        class="h-9 w-9 object-contain brightness-0 invert">
                </div>
                <div>
                    <span class="text-3xl font-black text-white" data-counter="8500"
                        data-counter-suffix="+">8,500+</span>
                    <p class="text-xs text-white/70 font-medium mt-1">Satisfied Families</p>
                </div>
            </div>

        </div>
    </div>
</section>
