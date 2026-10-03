<?php

declare(strict_types=1);

/*
|--------------------------------------------------------------------------
| Site / business identity
|--------------------------------------------------------------------------
|
| Single source of truth for Name-Address-Phone (NAP) data. This is the most
| consistency-sensitive data on the site: Google matches a business profile to
| a page by exact NAP agreement, and the same values feed the header, the
| footer, the contact page, the tel: links and the LocalBusiness JSON-LD.
| Change it here and it changes everywhere consistently.
|
*/

return [

    'name' => env('SITE_NAME', 'Next Level Packers and Movers'),

    'legal_name' => env('SITE_LEGAL_NAME', 'Next Level Packers and Movers'),

    'url' => env('SITE_URL', 'https://nextlevelpackersandmovers.com'),

    // Short brand used where space is tight (mobile nav, watermark).
    'short_name' => 'Next Level Packers & Movers',

    'tagline' => 'Stress-Free Shifting Starts Here',

    'phone_display' => '+91 93635 55311',

    'phone_e164' => '+919363555311',

    'phone_raw' => '9363555311',

    'whatsapp_number' => '919363555311',

    // Deep link with a pre-filled enquiry message. Highest-converting contact
    // channel in India for this trade, so it appears in the header, footer and
    // as a floating action on every page.
    'whatsapp_url' => 'https://wa.me/919363555311?text='.rawurlencode(
        'Hi, I am interested in Next Level Packers and Movers services. Please share details.'
    ),

    'email' => 'nextlevelpackersandmovers@gmail.com',

    'address' => [
        'street' => 'Sakthi Main Road, Nadapalayam, Chithode',
        'locality' => 'Chithode',
        'city' => 'Erode',
        'region' => 'Tamil Nadu',
        'postal_code' => '638102',
        'country' => 'IN',
    ],

    'geo' => [
        'latitude' => 11.3436,
        'longitude' => 77.7195,
    ],

    'hours' => [
        ['day' => 'Monday', 'opens' => '06:00', 'closes' => '22:00'],
        ['day' => 'Tuesday', 'opens' => '06:00', 'closes' => '22:00'],
        ['day' => 'Wednesday', 'opens' => '06:00', 'closes' => '22:00'],
        ['day' => 'Thursday', 'opens' => '06:00', 'closes' => '22:00'],
        ['day' => 'Friday', 'opens' => '06:00', 'closes' => '22:00'],
        ['day' => 'Saturday', 'opens' => '06:00', 'closes' => '22:00'],
        ['day' => 'Sunday', 'opens' => '07:00', 'closes' => '21:00'],
    ],

    'social' => [
        'facebook' => env('SOCIAL_FACEBOOK', ''),
        'twitter' => env('SOCIAL_TWITTER', ''),
        'instagram' => env('SOCIAL_INSTAGRAM', ''),
        'youtube' => env('SOCIAL_YOUTUBE', ''),
    ],

    'founded_year' => 2015,

    'rating' => [
        'value' => 4.9,
        'count' => 850,
    ],

    'primary_keyword' => 'packers and movers',

    'target_locations' => ['Erode', 'Tiruppur', 'Coimbatore'],

    /*
    |----------------------------------------------------------------------
    | Lead notification
    |----------------------------------------------------------------------
    */

    'leads' => [
        'notify_email' => env('LEAD_NOTIFY_EMAIL', 'nextlevelpackersandmovers@gmail.com'),
    ],

    'analytics' => [
        'google_id' => env('GOOGLE_ANALYTICS_ID', ''),
    ],

];
