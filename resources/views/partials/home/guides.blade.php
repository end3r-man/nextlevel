@if ($posts->isNotEmpty())
    {{-- =========================================================================
         MOVING GUIDES & CHECKLISTS: Educational Authority Articles
         ========================================================================= --}}
    <section class="relative overflow-hidden bg-white py-24 sm:py-28 lg:py-32" id="guides">

        {{-- Subtle ambient glow --}}
        <div class="pointer-events-none absolute inset-0 -z-10 overflow-hidden" aria-hidden="true">
            <div class="absolute left-0 top-1/2 h-80 w-80 -translate-y-1/2 rounded-full bg-[#144b9e]/[0.025] blur-3xl"></div>
        </div>

        <div class="container-page">
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
                <div class="max-w-2xl">
                    <div class="inline-flex items-center gap-2 rounded-full border border-[#144b9e]/20 bg-[#144b9e]/5 px-4 py-1.5 backdrop-blur-sm">
                        <span class="h-2 w-2 rounded-full bg-[#144b9e]"></span>
                        <span class="text-xs font-bold uppercase tracking-[0.16em] text-[#144b9e]">
                            Relocation Knowledge Hub
                        </span>
                    </div>

                    <h2 class="mt-5 text-3xl font-black tracking-tight text-[#081b35] sm:text-4xl md:text-5xl">
                        Helpful Moving Guides &amp; <span class="text-[#144b9e]">Checklists</span>
                    </h2>

                    <p class="mt-4 text-base leading-relaxed text-slate-600 sm:text-lg">
                        Practical tips and step-by-step checklists to make packing, decluttering, and settling into your new place seamless.
                    </p>
                </div>

                <div class="shrink-0">
                    <a href="{{ route('blog.index') }}"
                        class="group inline-flex items-center justify-center gap-2 rounded-full border border-slate-200 bg-white px-7 py-3.5 text-sm font-semibold text-[#081b35] shadow-sm transition-all duration-200 hover:-translate-y-0.5 hover:border-[#144b9e]/40 hover:bg-[#144b9e]/5 hover:text-[#144b9e]">
                        <span>Read All Guides</span>
                        <x-icon name="arrow-right" class="w-4 h-4 text-[#144b9e] transition group-hover:translate-x-1" />
                    </a>
                </div>
            </div>

            {{-- Articles Grid --}}
            <div class="mt-14 grid gap-8 md:grid-cols-3">
                @foreach ($posts as $post)
                    <article class="group flex flex-col overflow-hidden rounded-3xl border border-slate-200/90 bg-white shadow-sm transition-all duration-300 hover:-translate-y-1.5 hover:border-[#144b9e]/30 hover:shadow-xl hover:shadow-[#144b9e]/10">
                        <div class="h-52 overflow-hidden bg-slate-100 relative">
                            <img src="{{ asset($post->image) }}" alt="{{ $post->title }}"
                                 width="640" height="420" loading="lazy" decoding="async"
                                 class="h-full w-full object-cover transition duration-700 group-hover:scale-105">
                            <span class="absolute bottom-3 left-3 rounded-full bg-[#081b35]/80 px-3 py-1 text-[11px] font-bold text-white backdrop-blur-sm">
                                ⏱️ {{ $post->reading_minutes }} min read
                            </span>
                        </div>

                        <div class="flex flex-1 flex-col p-7 justify-between">
                            <div>
                                <p class="text-xs font-bold uppercase tracking-wider text-[#144b9e]">
                                    {{ $post->published_at->format('d M Y') }}
                                </p>
                                <h3 class="mt-2.5 text-lg font-bold text-[#081b35] leading-snug group-hover:text-[#144b9e] transition duration-200">
                                    <a href="{{ route('blog.show', $post) }}">
                                        {{ $post->title }}
                                    </a>
                                </h3>
                                <p class="mt-3 line-clamp-2 text-sm text-slate-600 leading-relaxed">
                                    {{ $post->excerpt }}
                                </p>
                            </div>

                            <div class="mt-6 pt-5 border-t border-slate-100 flex items-center justify-between">
                                <a href="{{ route('blog.show', $post) }}"
                                   class="group/btn inline-flex items-center gap-2 text-sm font-bold text-[#144b9e] transition duration-200 group-hover:gap-3">
                                    <span>Read Full Guide</span>
                                    <span class="flex h-6 w-6 items-center justify-center rounded-full bg-[#144b9e]/10 text-[#144b9e] transition-transform group-hover/btn:translate-x-0.5">
                                        →
                                    </span>
                                </a>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>
@endif

