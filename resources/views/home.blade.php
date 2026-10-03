@extends('layouts.app')

@push('meta')
    <x-seo :title="$title" :description="$description" image="images/og-default.png" :canonical="route('home')" :schema="$schema" />
@endpush

@section('content')
    {{-- 1. Hero & Fast Estimator Calculator --}}
    @include('partials.home.hero')

    {{-- 2. Scrolling Service Marquee Ticker --}}
    @include('partials.home.marquee-strip')

    {{-- 3. 5-Pillar Guarantees Ribbon --}}
    {{-- @include('partials.home.trust-ticker') --}}

    {{-- 4. About Us Section (Story, Legacy & Credentials) --}}
    @include('partials.home.about-section')

    {{-- 5. Complete 12-Service Visual Showcase with Category Filters --}}
    @include('partials.home.services')

    {{-- 6. Why Choose Us (Mission, Vision, Values Tabs) --}}
    @include('partials.home.why-us')

    {{-- 7. Stats Counter Banner (10K+ Moves, 50+ Crew, 10+ Yrs) --}}
    @include('partials.home.stats-banner')

    {{-- 8. 3-Step Simple Moving Process --}}
    @include('partials.home.process')

    {{-- 9. Verified Client Reviews & Testimonials --}}
    @include('partials.home.testimonials')

    {{-- 10. Enquiry Form / Lead Capture --}}
    <x-quote-form source="home" />

    {{-- 11. Our Network Over Tamil Nadu (25 Cities) --}}
    @include('partials.home.locations')

    {{-- 12. 24/7 Support & Call CTA Bar --}}
    @include('partials.home.cta-bar')

    {{-- 13. Contact Information Cards (Phone, Email, Office) --}}
    @include('partials.home.contact-cards')

    {{-- 14. Real Shifting Photo Gallery with Lightbox --}}
    @include('partials.home.gallery')

    {{-- 15. Frequently Asked Questions --}}
    @include('partials.home.faq')

    {{-- 17. Final High-Impact Conversion Banner --}}
    @include('partials.home.closing')
@endsection
