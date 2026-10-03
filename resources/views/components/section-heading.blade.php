@props([
    'eyebrow' => null,
    'title',
    'lead' => null,
    'align' => 'center',
])

<div @class([
    'max-w-3xl',
    'mx-auto text-center' => $align === 'center',
    'text-left' => $align !== 'center',
])>
    @if ($eyebrow)
        <p class="eyebrow mb-3">
            <x-icon name="truck" class="w-4 h-4" />
            {{ $eyebrow }}
        </p>
    @endif

    <h2 class="text-2xl font-bold sm:text-3xl lg:text-[2.6rem] lg:leading-[1.12]">
        {{ $title }}
    </h2>

    @if ($lead)
        <p class="mt-5 text-base leading-relaxed text-ink-600 sm:text-lg">
            {{ $lead }}
        </p>
    @endif
</div>
