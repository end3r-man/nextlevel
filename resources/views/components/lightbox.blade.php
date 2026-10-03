{{--
    Site-wide lightbox. Included once per page that has a gallery or marquee.
    initLightbox() binds to the first [data-lightbox] it finds and wires up the
    triggers, prev/next, keyboard and focus handling.
--}}
<div data-lightbox class="fixed inset-0 z-[70] hidden flex-col items-center justify-center gap-4 bg-ink-950/95 p-4"
     role="dialog" aria-modal="true" aria-label="Image viewer" aria-hidden="true">

    <button type="button" data-lightbox-close
            class="absolute top-5 right-5 inline-flex h-11 w-11 items-center justify-center rounded-full bg-white/10 text-white transition hover:bg-white hover:text-ink-950"
            aria-label="Close image viewer">
        <x-icon name="close" class="w-6 h-6" />
    </button>

    <button type="button" data-lightbox-prev
            class="absolute top-1/2 left-3 -translate-y-1/2 inline-flex h-11 w-11 items-center justify-center rounded-full bg-white/10 text-white transition hover:bg-white hover:text-ink-950"
            aria-label="Previous image">
        <x-icon name="arrow-left" class="w-5 h-5" />
    </button>

    {{-- aria-hidden: the caption below carries the description, so announcing
         the image too would read the same alt text twice. --}}
    <img data-lightbox-image src="" alt="" aria-hidden="true"
         class="max-h-[78vh] max-w-full rounded-2xl object-contain">

    <div class="flex items-center gap-4">
        <p data-lightbox-caption class="max-w-lg text-center text-sm text-ink-300"></p>
        <p data-lightbox-counter class="shrink-0 text-xs text-ink-500 tabular-nums"></p>
    </div>

    <button type="button" data-lightbox-next
            class="absolute top-1/2 right-3 -translate-y-1/2 inline-flex h-11 w-11 items-center justify-center rounded-full bg-white/10 text-white transition hover:bg-white hover:text-ink-950"
            aria-label="Next image">
        <x-icon name="arrow-right" class="w-5 h-5" />
    </button>
</div>