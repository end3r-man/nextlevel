@props([
    'title',
    'subtitle' => null,
    'image' => null,
    'breadcrumbs' => [],
    'eyebrow' => null,
])

<header class="relative overflow-hidden bg-ink-950">
    <div class="absolute inset-0">
        @if ($image)
            <img src="{{ asset($image) }}" alt="" aria-hidden="true"
                 width="1600" height="600" fetchpriority="high" decoding="async"
                 class="h-full w-full object-cover opacity-35">
        @endif
        <div class="absolute inset-0 bg-gradient-to-br from-ink-950 via-ink-950/90 to-brand-950/70"></div>
    </div>

    <div class="container-page relative py-16 sm:py-20 lg:py-24">
        @if ($breadcrumbs)
            <nav aria-label="Breadcrumb" class="mb-6">
                <ol class="flex flex-wrap items-center gap-2 text-sm text-ink-300">
                    @foreach ($breadcrumbs as $crumb)
                        <li class="flex items-center gap-2">
                            @if (! $loop->last && ! empty($crumb['url']))
                                <a href="{{ $crumb['url'] }}" class="transition hover:text-accent-400">{{ $crumb['title'] }}</a>
                            @else
                                <span class="font-medium text-white" aria-current="page">{{ $crumb['title'] }}</span>
                            @endif
                            @if (! $loop->last)
                                <x-icon name="chevron-right" class="w-3.5 h-3.5 text-ink-500" />
                            @endif
                        </li>
                    @endforeach
                </ol>
            </nav>
        @endif

        @if ($eyebrow)
            <p class="eyebrow-light mb-4">{{ $eyebrow }}</p>
        @endif

        <h1 class="max-w-4xl text-3xl font-bold text-white sm:text-4xl lg:text-5xl lg:leading-[1.1]">
            {{ $title }}
        </h1>

        @if ($subtitle)
            <p class="mt-5 max-w-2xl text-base leading-relaxed text-ink-300 sm:text-lg">
                {{ $subtitle }}
            </p>
        @endif

        {{ $slot }}
    </div>
</header>
