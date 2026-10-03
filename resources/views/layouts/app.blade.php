<!DOCTYPE html>
<html lang="en-IN" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- The legacy <head> sat inside <body> and the html lang was "zxx",
         which is not a language code. Both fixed. --}}

    <link rel="icon" type="image/png" sizes="180x180" href="{{ asset('images/favicon-180.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/favicon-180.png') }}">
    <link rel="manifest" href="{{ asset('site.webmanifest') }}">

    @stack('meta')
    @stack('schema')

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @if (config('site.analytics.google_id'))
        <script async src="https://www.googletagmanager.com/gtag/js?id={{ config('site.analytics.google_id') }}"></script>
        <script>
            window.dataLayer = window.dataLayer || [];

            function gtag() {
                dataLayer.push(arguments);
            }
            gtag('js', new Date());
            gtag('config', '{{ config('site.analytics.google_id') }}');
        </script>
    @endif
</head>

<body class="min-h-screen bg-white font-sans text-ink-600">

    <a href="#main"
        class="sr-only focus:not-sr-only focus:fixed focus:top-4 focus:left-4 focus:z-[100] focus:rounded-lg focus:bg-brand-700 focus:px-5 focus:py-3 focus:text-white">
        Skip to content
    </a>

    @include('partials.header')

    <main id="main">
        @yield('content')
    </main>

    @include('partials.footer')
    @include('partials.floating-actions')

    @stack('scripts')
</body>

</html>
