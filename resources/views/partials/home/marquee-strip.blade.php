{{-- =========================================================================
     MARQUEE STRIP: Moving Services Ticker
     ========================================================================= --}}
<div class="group relative overflow-hidden border-y border-[#144b9e]/10
           bg-white py-4 select-none">

    {{-- Subtle background glow --}}
    <div
        class="pointer-events-none absolute inset-y-0 left-1/2
               w-96 -translate-x-1/2
               bg-[#144b9e]/[0.025] blur-3xl">
    </div>

    {{-- Left fade --}}
    <div
        class="pointer-events-none absolute inset-y-0 left-0 z-10 w-20
               bg-gradient-to-r from-white to-transparent">
    </div>

    {{-- Right fade --}}
    <div
        class="pointer-events-none absolute inset-y-0 right-0 z-10 w-20
               bg-gradient-to-l from-white to-transparent">
    </div>


    <div class="relative flex items-center whitespace-nowrap animate-marquee">

        @for ($loop = 0; $loop < 2; $loop++)
            <div class="flex shrink-0 items-center gap-7 pr-7">

                {{-- House Shifting --}}
                <div class="inline-flex items-center gap-3">
                    <span
                        class="flex h-7 w-7 items-center justify-center
                               rounded-full bg-[#144b9e]/[0.08]">
                        <span class="h-2 w-2 rounded-full bg-[#144b9e]"></span>
                    </span>

                    <span
                        class="text-sm font-bold uppercase
                               tracking-[0.08em] text-[#144b9e]/90
                               sm:text-[15px]">
                        House Shifting
                    </span>
                </div>


                {{-- Separator --}}
                <span class="h-1 w-1 rounded-full bg-[#144b9e]/25"></span>


                {{-- Office Shifting --}}
                <div class="inline-flex items-center gap-3">
                    <span
                        class="flex h-7 w-7 items-center justify-center
                               rounded-full bg-[#144b9e]/[0.08]">
                        <span class="h-2 w-2 rounded-full bg-[#144b9e]"></span>
                    </span>

                    <span
                        class="text-sm font-bold uppercase
                               tracking-[0.08em] text-[#144b9e]/90
                               sm:text-[15px]">
                        Office Shifting
                    </span>
                </div>


                <span class="h-1 w-1 rounded-full bg-[#144b9e]/25"></span>


                {{-- Local Shifting --}}
                <div class="inline-flex items-center gap-3">
                    <span
                        class="flex h-7 w-7 items-center justify-center
                               rounded-full bg-[#144b9e]/[0.08]">
                        <span class="h-2 w-2 rounded-full bg-[#144b9e]"></span>
                    </span>

                    <span
                        class="text-sm font-bold uppercase
                               tracking-[0.08em] text-[#144b9e]/90
                               sm:text-[15px]">
                        Local Shifting
                    </span>
                </div>


                <span class="h-1 w-1 rounded-full bg-[#144b9e]/25"></span>


                {{-- Domestic Relocation --}}
                <div class="inline-flex items-center gap-3">
                    <span
                        class="flex h-7 w-7 items-center justify-center
                               rounded-full bg-[#144b9e]/[0.08]">
                        <span class="h-2 w-2 rounded-full bg-[#144b9e]"></span>
                    </span>

                    <span
                        class="text-sm font-bold uppercase
                               tracking-[0.08em] text-[#144b9e]/90
                               sm:text-[15px]">
                        Domestic Relocation
                    </span>
                </div>


                <span class="h-1 w-1 rounded-full bg-[#144b9e]/25"></span>


                {{-- Packing --}}
                <div class="inline-flex items-center gap-3">
                    <span
                        class="flex h-7 w-7 items-center justify-center
                               rounded-full bg-[#144b9e]/[0.08]">
                        <span class="h-2 w-2 rounded-full bg-[#144b9e]"></span>
                    </span>

                    <span
                        class="text-sm font-bold uppercase
                               tracking-[0.08em] text-[#144b9e]/90
                               sm:text-[15px]">
                        Professional Packing
                    </span>
                </div>


                <span class="h-1 w-1 rounded-full bg-[#144b9e]/25"></span>


                {{-- Loading --}}
                <div class="inline-flex items-center gap-3">
                    <span
                        class="flex h-7 w-7 items-center justify-center
                               rounded-full bg-[#144b9e]/[0.08]">
                        <span class="h-2 w-2 rounded-full bg-[#144b9e]"></span>
                    </span>

                    <span
                        class="text-sm font-bold uppercase
                               tracking-[0.08em] text-[#144b9e]/90
                               sm:text-[15px]">
                        Loading &amp; Unloading
                    </span>
                </div>


                <span class="h-1 w-1 rounded-full bg-[#144b9e]/25"></span>


                {{-- Two Wheeler --}}
                <div class="inline-flex items-center gap-3">
                    <span
                        class="flex h-7 w-7 items-center justify-center
                               rounded-full bg-[#144b9e]/[0.08]">
                        <span class="h-2 w-2 rounded-full bg-[#144b9e]"></span>
                    </span>

                    <span
                        class="text-sm font-bold uppercase
                               tracking-[0.08em] text-[#144b9e]/90
                               sm:text-[15px]">
                        Two Wheeler Shifting
                    </span>
                </div>


                <span class="h-1 w-1 rounded-full bg-[#144b9e]/25"></span>


                {{-- Storage --}}
                <div class="inline-flex items-center gap-3">
                    <span
                        class="flex h-7 w-7 items-center justify-center
                               rounded-full bg-[#144b9e]/[0.08]">
                        <span class="h-2 w-2 rounded-full bg-[#144b9e]"></span>
                    </span>

                    <span
                        class="text-sm font-bold uppercase
                               tracking-[0.08em] text-[#144b9e]/90
                               sm:text-[15px]">
                        Storage Facility
                    </span>
                </div>


                <span class="h-1 w-1 rounded-full bg-[#144b9e]/25"></span>

            </div>
        @endfor

    </div>
</div>
