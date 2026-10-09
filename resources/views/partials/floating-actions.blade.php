@php
    $site = config('site');
@endphp

{{-- Sticky conversion actions. On mobile the call button must clear the
     WhatsApp button and the browser chrome, hence the split positioning. --}}
<div class="pointer-events-none fixed right-4 bottom-4 z-40 flex flex-col gap-3 sm:right-6 sm:bottom-6">

    <a href="{{ $site['whatsapp_url'] }}" target="_blank" rel="noopener"
        class="pointer-events-auto inline-flex h-14 w-14 items-center justify-center rounded-full bg-[#25D366] text-white shadow-lift transition hover:scale-105 hover:bg-[#1eb455] sm:h-15 sm:w-15"
        aria-label="Chat with us on WhatsApp">
        <x-icon name="whatsapp" class="h-7 w-7" />
    </a>
</div>

<div class="pointer-events-none fixed left-4 bottom-4 z-40 flex flex-col gap-3 sm:right-6 sm:bottom-6">

    <a href="tel:{{ $site['phone_e164'] }}"
        class="ring-ripple pointer-events-auto inline-flex h-14 w-14 items-center justify-center rounded-full bg-brand-700 text-white shadow-lift transition hover:scale-105 hover:bg-brand-800 sm:h-15 sm:w-15"
        aria-label="Call {{ $site['phone_display'] }}">
        <x-icon name="phone" class="h-6 w-6" />
    </a>
</div>
