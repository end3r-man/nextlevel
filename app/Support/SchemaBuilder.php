<?php

namespace App\Support;

use App\Models\Location;
use App\Models\Post;
use App\Models\Service;
use App\Models\Testimonial;

/**
 * Builds the JSON-LD structured data graph.
 *
 * The legacy site emitted zero structured data, which is why it could not win
 * rich results, the knowledge panel star rating, or sit in the AI answer
 * panels that increasingly answer "packers and movers in Erode" queries.
 *
 * Graph shape:
 *   LocalBusiness (MovingCompany) + Organization  ->  root node, referenced by id
 *   WebSite                                         ->  root node
 *   WebPage                                        ->  every page
 *   BreadcrumbList                                 ->  every page except home
 *   Service                                        ->  service + service/location pages
 *   OfferCatalog                                   ->  home + services hub
 *   FAQPage                                        ->  faq-bearing pages
 *   Article                                        ->  blog posts
 */
class SchemaBuilder
{
    public const ORG_ID = 'https://nextlevelpackersandmovers.com/#organization';

    public const WEBSITE_ID = 'https://nextlevelpackersandmovers.com/#website';

    /**
     * @param  array<int, array<string, mixed>>  $graph
     */
    public static function render(array $graph): string
    {
        $clean = array_values(array_filter($graph));

        return json_encode(
            ['@context' => 'https://schema.org', '@graph' => $clean],
            JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT,
        );
    }

    /**
     * The MovingCompany node. Also carries the aggregateRating, which is what
     * makes a local packer eligible for the star rating in search results.
     */
    public static function organization(): array
    {
        $site = config('site');
        $address = $site['address'];

        $areaServed = Location::active()
            ->orderBy('priority_tier')
            ->pluck('name')
            ->all();

        return [
            '@type' => ['MovingCompany', 'LocalBusiness', 'HomeAndConstructionBusiness'],
            '@id' => self::ORG_ID,
            'name' => $site['name'],
            'alternateName' => $site['short_name'],
            'legalName' => $site['legal_name'],
            'description' => 'Next Level Packers and Movers is a packers and movers company based in Erode, Tamil Nadu, providing house shifting, office relocation, packing, loading, storage and international moving services across Erode, Tiruppur, Coimbatore and neighbouring cities.',
            'url' => $site['url'],
            'telephone' => $site['phone_e164'],
            'email' => $site['email'],
            'image' => $site['url'].'/images/why.webp',
            'logo' => $site['url'].'/images/nxtlo.webp',
            'foundingDate' => (string) $site['founded_year'],
            'priceRange' => '₹₹',
            'currenciesAccepted' => 'INR',
            'paymentAccepted' => 'Cash, UPI, Bank Transfer',
            'address' => [
                '@type' => 'PostalAddress',
                'streetAddress' => $address['street'],
                'addressLocality' => $address['city'],
                'addressRegion' => $address['region'],
                'postalCode' => $address['postal_code'],
                'addressCountry' => $address['country'],
            ],
            'geo' => [
                '@type' => 'GeoCoordinates',
                'latitude' => $site['geo']['latitude'],
                'longitude' => $site['geo']['longitude'],
            ],
            'openingHoursSpecification' => array_map(fn ($h) => [
                '@type' => 'OpeningHoursSpecification',
                'dayOfWeek' => 'https://schema.org/'.$h['day'],
                'opens' => $h['opens'],
                'closes' => $h['closes'],
            ], $site['hours']),
            'areaServed' => array_map(fn ($city) => [
                '@type' => 'City',
                'name' => $city,
            ], $areaServed),
            'serviceArea' => [
                '@type' => 'GeoCircle',
                'geoMidpoint' => [
                    '@type' => 'GeoCoordinates',
                    'latitude' => $site['geo']['latitude'],
                    'longitude' => $site['geo']['longitude'],
                ],
                'geoRadius' => 400,
            ],
            'aggregateRating' => [
                '@type' => 'AggregateRating',
                'ratingValue' => $site['rating']['value'],
                'reviewCount' => $site['rating']['count'],
                'bestRating' => 5,
                'worstRating' => 1,
            ],
            'hasOfferCatalog' => [
                '@id' => self::ORG_ID.'/catalog',
                '@type' => 'OfferCatalog',
                'name' => 'Moving and relocation services',
                'itemListElement' => self::serviceNodes(),
            ],
            'sameAs' => array_values(array_filter([
                $site['social']['facebook'] ?? null,
                $site['social']['twitter'] ?? null,
                $site['social']['instagram'] ?? null,
                $site['social']['youtube'] ?? null,
            ])),
            'potentialAction' => [
                [
                    '@type' => 'ReserveAction',
                    'target' => [
                        '@type' => 'EntryPoint',
                        'urlTemplate' => $site['url'].'/contact#get-a-quote',
                    ],
                    'result' => [
                        '@type' => 'Reservation',
                        'name' => 'Moving service booking',
                    ],
                ],
            ],
        ];
    }

    /**
     * The site-level WebSite node.
     *
     * No SearchAction is emitted: there is no on-site search endpoint, and
     * advertising one to Google while /search 404s is a structured-data error
     * that costs more than the (largely deprecated) signal ever earned.
     */
    public static function website(): array
    {
        return [
            '@type' => 'WebSite',
            '@id' => self::WEBSITE_ID,
            'url' => config('site.url'),
            'name' => config('site.name'),
            'inLanguage' => 'en-IN',
            'publisher' => ['@id' => self::ORG_ID],
        ];
    }

    /**
     * @param  array<string, mixed>  $options
     */
    public static function webPage(string $title, string $description, string $url, array $options = []): array
    {
        $node = [
            '@type' => 'WebPage',
            '@id' => $url.'#webpage',
            'url' => $url,
            'name' => $title,
            'description' => $description,
            'inLanguage' => 'en-IN',
            'isPartOf' => ['@id' => self::WEBSITE_ID],
            'about' => ['@id' => self::ORG_ID],
        ];

        if (isset($options['image'])) {
            $node['primaryImageOfPage'] = [
                '@type' => 'ImageObject',
                'url' => $options['image'],
                'width' => 1200,
                'height' => 630,
            ];
        }

        if (isset($options['datePublished'])) {
            $node['datePublished'] = $options['datePublished'];
        }

        if (isset($options['dateModified'])) {
            $node['dateModified'] = $options['dateModified'];
        }

        if (isset($options['type'])) {
            $node['@type'] = $options['type'];
        }

        return $node;
    }

    /**
     * @param  array<int, array{title: string, url: string}>  $crumbs
     */
    public static function breadcrumbs(array $crumbs): array
    {
        $items = [];

        foreach ($crumbs as $i => $crumb) {
            $items[] = [
                '@type' => 'ListItem',
                'position' => $i + 1,
                'name' => $crumb['title'],
                'item' => $crumb['url'],
            ];
        }

        return [
            '@type' => 'BreadcrumbList',
            '@id' => ($crumbs[array_key_last($crumbs)]['url'] ?? '').'#breadcrumb',
            'itemListElement' => $items,
        ];
    }

    /**
     * Service node. When a location is passed this becomes the
     * "{service} in {city}" node, which is the target of the local pages.
     */
    public static function service(Service $service, ?Location $location = null): array
    {
        $url = $location
            ? route('services.location', [$service, $location])
            : route('services.show', $service);

        $name = $location
            ? "{$service->name} in {$location->name}"
            : $service->name;

        $description = $location
            ? "Professional {$service->name} in {$location->name} by Next Level Packers and Movers. {$service->excerpt}"
            : $service->excerpt;

        $node = [
            '@type' => 'Service',
            '@id' => $url.'#service',
            'name' => $name,
            'serviceType' => $service->name,
            'description' => $description,
            'url' => $url,
            'provider' => ['@id' => self::ORG_ID],
            'areaServed' => [
                '@type' => 'City',
                'name' => $location?->name ?? config('site.target_locations'),
            ],
            'offers' => [
                '@type' => 'Offer',
                'priceCurrency' => 'INR',
                'price' => '0',
                'availability' => 'https://schema.org/InStock',
                'priceSpecification' => [
                    '@type' => 'PriceSpecification',
                    'priceCurrency' => 'INR',
                    'valueAddedTaxIncluded' => true,
                ],
                'url' => $url,
            ],
        ];

        if ($service->image) {
            $node['image'] = $service->image;
        }

        if ($service->includes) {
            $node['hasOfferCatalog'] = [
                '@type' => 'OfferCatalog',
                'name' => $name.' inclusions',
                'itemListElement' => array_map(fn ($i) => [
                    '@type' => 'Offer',
                    'itemOffered' => ['@type' => 'Service', 'name' => $i],
                ], $service->includes),
            ];
        }

        return $node;
    }

    /**
     * @return array<int, array<string, mixed>>
     */
    public static function serviceNodes(): array
    {
        return Service::active()->ordered()->get()->map(
            fn (Service $s) => [
                '@type' => 'Offer',
                'itemOffered' => ['@id' => route('services.show', $s).'#service'],
            ],
        )->all();
    }

    /**
     * @param  array<int, array{question: string, answer: string}>  $faqs
     */
    public static function faqPage(array $faqs, string $url): array
    {
        if ($faqs === []) {
            return [];
        }

        return [
            '@type' => 'FAQPage',
            '@id' => $url.'#faq',
            'mainEntity' => array_map(fn ($faq) => [
                '@type' => 'Question',
                'name' => strip_tags($faq['question']),
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => strip_tags($faq['answer']),
                ],
            ], $faqs),
        ];
    }

    /**
     * Contact page node. Declares the contact point explicitly rather than
     * relying on the org node alone.
     */
    public static function contactPage(array $site): array
    {
        return [
            '@type' => 'ContactPage',
            '@id' => $site['url'].'/contact-us#contactpage',
            'url' => $site['url'].'/contact-us',
            'name' => 'Contact Next Level Packers and Movers',
            'about' => ['@id' => self::ORG_ID],
            'mainEntity' => [
                '@type' => 'Organization',
                'name' => $site['name'],
                'telephone' => $site['phone_e164'],
                'email' => $site['email'],
                'address' => [
                    '@type' => 'PostalAddress',
                    'streetAddress' => $site['address']['street'],
                    'addressLocality' => $site['address']['city'],
                    'addressRegion' => $site['address']['region'],
                    'postalCode' => $site['address']['postal_code'],
                    'addressCountry' => $site['address']['country'],
                ],
                'contactPoint' => [
                    [
                        '@type' => 'ContactPoint',
                        'telephone' => $site['phone_e164'],
                        'contactType' => 'customer service',
                        'areaServed' => 'IN',
                        'availableLanguage' => ['en', 'ta'],
                    ],
                ],
            ],
        ];
    }

    public static function article(Post $post, string $url): array
    {
        return [
            '@type' => 'BlogPosting',
            '@id' => $url.'#article',
            'headline' => $post->title,
            'description' => $post->excerpt,
            'image' => $post->image ? asset($post->image) : null,
            'datePublished' => $post->published_at?->toAtomString(),
            'dateModified' => $post->updated_at->toAtomString(),
            'author' => [
                '@type' => 'Organization',
                'name' => $post->author,
                'url' => config('site.url'),
            ],
            'publisher' => ['@id' => self::ORG_ID],
            'mainEntityOfPage' => ['@id' => $url.'#webpage'],
            'wordCount' => str_word_count(strip_tags($post->body)),
            'inLanguage' => 'en-IN',
        ];
    }

    /**
     * Review nodes for the testimonial wall. Kept separate from AggregateRating
     * because Google only trusts reviews that are genuinely attributable.
     */
    public static function reviews(): array
    {
        return Testimonial::active()->ordered()->limit(10)->get()
            ->map(fn ($t) => [
                '@type' => 'Review',
                'author' => [
                    '@type' => 'Person',
                    'name' => $t->name,
                ],
                'datePublished' => $t->created_at->toAtomString(),
                'reviewBody' => strip_tags($t->quote),
                'reviewRating' => [
                    '@type' => 'Rating',
                    'ratingValue' => $t->rating,
                    'bestRating' => 5,
                    'worstRating' => 1,
                ],
                'itemReviewed' => ['@id' => self::ORG_ID],
            ])
            ->all();
    }
}
