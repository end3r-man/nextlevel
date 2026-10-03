@php
    $site = config('site');
    $services = \App\Models\Service::active()->ordered()->limit(6)->get();
    $locations = \App\Models\Location::active()->primary()->get();
@endphp

<footer class="bg-ink-950 text-ink-300">
    {{-- Primary money cities. Linking these properly (instead of leaving the
         legacy location list as inert <li> text) is the main internal-linking
         win for the "packers and movers in {city}" searches. --}}
    <div class="border-b border-white/10 bg-white/5">
        <div class="container-page py-10">
            <h2 class="mb-5 text-sm font-bold tracking-[0.16em] text-white uppercase">
                Packers and Movers in Tamil Nadu &amp; Karnataka
            </h2>
            <ul class="flex flex-wrap gap-x-2 gap-y-2">
                @foreach ($locations as $loc)
                    <li>
                        <a href="{{ route('locations.show', $loc) }}"
                           class="inline-block rounded-lg bg-white/5 px-3.5 py-2 text-sm text-ink-300 transition hover:bg-accent-500 hover:text-white">
                            Packers and Movers in {{ $loc->name }}
                        </a>
                    </li>
                @endforeach
                <li>
                    <a href="{{ route('locations.index') }}"
                       class="inline-block rounded-lg border border-white/20 px-3.5 py-2 text-sm font-semibold text-white transition hover:border-accent-500 hover:text-accent-400">
                        All locations →
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <div class="container-page py-14">
        <div class="grid gap-10 md:grid-cols-2 lg:grid-cols-12 lg:gap-8">
            <div class="lg:col-span-4">
                <img src="{{ asset('images/nxtlo.webp') }}" alt="{{ $site['name'] }}"
                     width="180" height="48" class="mb-5 h-12 w-auto rounded bg-white/5 p-1">
                <p class="mb-6 max-w-sm text-sm leading-relaxed">
                    Professional packers and movers in Erode, Tiruppur and Coimbatore since {{ $site['founded_year'] }}.
                    House shifting, office relocation, packing, storage and international moving — with a written
                    quote that does not change on the day.
                </p>

                <ul class="space-y-3 text-sm">
                    <li>
                        <a href="tel:{{ $site['phone_e164'] }}" class="inline-flex items-center gap-3 transition hover:text-accent-400">
                            <x-icon name="phone" class="w-4 h-4 text-accent-500" />
                            {{ $site['phone_display'] }}
                        </a>
                    </li>
                    <li>
                        <a href="mailto:{{ $site['email'] }}" class="inline-flex items-center gap-3 transition hover:text-accent-400">
                            <x-icon name="mail" class="w-4 h-4 text-accent-500" />
                            {{ $site['email'] }}
                        </a>
                    </li>
                    <li class="flex items-start gap-3">
                        <x-icon name="pin" class="mt-0.5 w-4 h-4 shrink-0 text-accent-500" />
                        <span>
                            {{ $site['address']['street'] }},<br>
                            {{ $site['address']['locality'] }}, {{ $site['address']['city'] }} — {{ $site['address']['postal_code'] }}<br>
                            {{ $site['address']['region'] }}
                        </span>
                    </li>
                </ul>
            </div>

            <div class="lg:col-span-2">
                <h3 class="mb-4 text-sm font-bold tracking-wide text-white uppercase">Quick links</h3>
                <ul class="space-y-2.5 text-sm">
                    <li><a href="{{ route('home') }}" class="transition hover:text-accent-400">Home</a></li>
                    <li><a href="{{ route('about') }}" class="transition hover:text-accent-400">About Us</a></li>
                    <li><a href="{{ route('services.index') }}" class="transition hover:text-accent-400">Our Services</a></li>
                    <li><a href="{{ route('locations.index') }}" class="transition hover:text-accent-400">Service Locations</a></li>
                    <li><a href="{{ route('testimonials') }}" class="transition hover:text-accent-400">Client Reviews</a></li>
                    <li><a href="{{ route('gallery') }}" class="transition hover:text-accent-400">Gallery</a></li>
                    <li><a href="{{ route('blog.index') }}" class="transition hover:text-accent-400">Blog</a></li>
                    <li><a href="{{ route('faq') }}" class="transition hover:text-accent-400">FAQ</a></li>
                    <li><a href="{{ route('contact') }}" class="transition hover:text-accent-400">Contact</a></li>
                </ul>
            </div>

            <div class="lg:col-span-3">
                <h3 class="mb-4 text-sm font-bold tracking-wide text-white uppercase">Our Services</h3>
                <ul class="space-y-2.5 text-sm">
                    @foreach ($services as $service)
                        <li>
                            <a href="{{ route('services.show', $service) }}" class="transition hover:text-accent-400">
                                {{ $service->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="lg:col-span-3">
                <h3 class="mb-4 text-sm font-bold tracking-wide text-white uppercase">Get a free quote</h3>
                <p class="mb-5 text-sm leading-relaxed">
                    Send us your two cities, the floors involved and your preferred date. We reply with a written
                    price the same day.
                </p>
                <div class="space-y-3">
                    <a href="{{ route('contact') }}#get-a-quote" class="btn-accent w-full">
                        Request a quote
                        <x-icon name="arrow-right" class="w-4 h-4" />
                    </a>
                    <a href="{{ $site['whatsapp_url'] }}"
                       target="_blank" rel="noopener" class="btn w-full border-2 border-emerald-500 text-emerald-400 hover:bg-emerald-500 hover:text-white">
                        <x-icon name="whatsapp" class="w-4 h-4" />
                        Chat on WhatsApp
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="border-t border-white/10">
        <div class="container-page flex flex-col items-center justify-between gap-3 py-6 text-sm sm:flex-row">
            <p class="m-0">
                &copy; {{ now()->year }} {{ $site['name'] }}. All rights reserved.
            </p>
            <p class="m-0 text-ink-400">
                Serving Erode, Tiruppur, Coimbatore, Salem, Trichy, Namakkal, Karur, Dharmapuri &amp; Bengaluru
            </p>
        </div>
    </div>
</footer>
