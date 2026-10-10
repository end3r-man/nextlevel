@props(['name', 'class' => 'w-5 h-5', 'label' => null])

@php
    // Generated map: ['icons' => ['ph:map-pin-fill' => [...]], 'aliases' => ['pin' => 'ph:map-pin-fill']]
    $map = require base_path('resources/icons.php');
    $icons = $map['icons'];
    $aliases = $map['aliases'];

    // Accept either a short alias ("pin") or a fully qualified name ("ph:map-pin-fill").
    $key = $aliases[$name] ?? $name;
    $icon = $icons[$key] ?? null;

    // Unknown icons must fail loudly in development but never break a page.
    if ($icon === null && !app()->isProduction()) {
        logger()->warning("[icon] unknown icon '{$name}' — not found in resources/icons.php. Run `npm run icons`.");
    }
@endphp

@if ($icon)
    <svg {{ $attributes->merge(['class' => $class]) }} xmlns="http://www.w3.org/2000/svg"
        viewBox="0 0 {{ $icon['width'] }} {{ $icon['height'] }}" width="{{ $icon['width'] }}"
        height="{{ $icon['height'] }}" fill="currentColor"
        @if ($label) role="img" aria-label="{{ $label }}" @else aria-hidden="true" focusable="false" @endif>{!! $icon['body'] !!}</svg>
@endif
