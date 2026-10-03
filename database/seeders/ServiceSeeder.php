<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            [
                'name' => 'House Shifting',
                'icon' => 'ph:house-line-fill',
                'image' => 'images/s1.webp',
                'excerpt' => 'Door-to-door house shifting with careful packing, padded handling and on-time delivery — for 1 BHK apartments to large villas.',
                'benefits' => [
                    'Trained crew assigned to your move, not a random daily-wage team',
                    'Multi-layer packing: bubble wrap, corrugated rolls, stretch film and cartons',
                    'Sofa, mattress and TV handled with dedicated padding and straps',
                    'Furniture dismantled and reassembled by our own carpenters',
                    'Delivery window confirmed in advance, not a vague "sometime that day"',
                ],
                'includes' => [
                    'Loading and unloading',
                    'Complete packing and unpacking',
                    'Furniture dismantling and reassembly',
                    'Vehicle allocation (13 ft to 32 ft)',
                    'Insurance coverage on transit',
                ],
                'faqs' => [
                    [
                        'question' => 'How much does house shifting cost in Erode?',
                        'answer' => 'A local 1 BHK move within Erode typically starts around ₹3,500 and depends on floor level, lift availability, volume of goods and whether you need full packing. Inter-city moves are priced by distance and vehicle size. We always confirm the rate in writing before we load anything.',
                    ],
                    [
                        'question' => 'Do you provide packing materials?',
                        'answer' => 'Yes. We supply cartons, bubble wrap, stretch wrap, packing paper, tape and blankets. You can also use our packing service only, without the transport, if you prefer to load the vehicle yourself.',
                    ],
                    [
                        'question' => 'Is my furniture safe from damage?',
                        'answer' => 'We pad every edge, wrap in blankets and secure with straps. Transit insurance is included as standard, and any damage found at delivery is settled from the same job sheet without you chasing paperwork afterwards.',
                    ],
                    [
                        'question' => 'How far in advance should I book?',
                        'answer' => 'Two to three days is usually enough for local moves. For month-end and month-start weekends, book a week ahead — that is when Erode, Tiruppur and Coimbatore demand peaks sharply.',
                    ],
                ],
            ],
            [
                'name' => 'Office Shifting',
                'icon' => 'ph:buildings-fill',
                'image' => 'images/s2.webp',
                'excerpt' => 'Office and commercial relocation with weekend and night schedules so your business keeps trading while we move.',
                'benefits' => [
                    'Night and weekend shifts so zero working hours are lost',
                    'Systems, servers and workstations handled by IT-experienced crew',
                    'Labelled and colour-coded crates so rebuild order is obvious',
                    'Cable mapping and re-termination by our own technicians',
                    'Single-point project manager for the whole relocation',
                ],
                'includes' => [
                    'Workstation and cabin dismantling',
                    'IT asset handling and re-termination',
                    'Furniture and partition relocation',
                    'Inventory sheet before and after',
                    'Post-move re-setup assistance',
                ],
                'faqs' => [
                    [
                        'question' => 'Can you move our office over a weekend?',
                        'answer' => 'Yes. Around 70% of our office moves happen on Saturday night or Sunday. We plan the sequence in advance so the office is back in working order by Monday morning.',
                    ],
                    [
                        'question' => 'How do you protect computers and servers?',
                        'answer' => 'Desktops, monitors and servers are wrapped in ESD-safe anti-static material, then boxed and kept in the passenger cabin rather than under cargo. Network points are labelled on both ends so reconnection is mechanical, not guesswork.',
                    ],
                    [
                        'question' => 'Do you handle large commercial premises?',
                        'answer' => 'We handle showrooms, clinics, coaching centres, factories, hotels and institutional shifts. For anything above roughly 5,000 sq ft we do a site survey first and give you a phased plan.',
                    ],
                ],
            ],
            [
                'name' => 'Local Shifting',
                'icon' => 'ph:arrows-left-right-bold',
                'image' => 'images/s3.webp',
                'excerpt' => 'Same-city moving across Erode, Tiruppur and Coimbatore with small-vehicle options for short hops and single items.',
                'benefits' => [
                    'Small 8–14 ft vehicles for single-room and few-item moves',
                    'Two-person crew for moves that do not need a full truck',
                    'Flexible same-day booking when stock is available',
                    'Short-haul pricing — no minimum distance charge',
                    'Ideal for intercity transfers between a few neighbourhoods',
                ],
                'includes' => [
                    'Same-day scheduling',
                    'Small and large vehicle options',
                    'Basic padding and blankets',
                    'Basic loading and unloading',
                    'Short-haul transit insurance',
                ],
                'faqs' => [
                    [
                        'question' => 'Is there a minimum charge for local shifting?',
                        'answer' => 'No. Single-item moves like a sofa, mattress or a few cartons are quoted on their own volume, not on a full-truck rate. Tell us what you are moving and we will size the vehicle to it.',
                    ],
                    [
                        'question' => 'How quickly can you do a local move?',
                        'answer' => 'For Erode, Tiruppur and Coimbatore we can usually turn up the same day if you call before 11 AM. We hold a small fleet back for exactly this.',
                    ],
                    [
                        'question' => 'Do you move within a single apartment complex?',
                        'answer' => 'Yes, and it is charged as a local move. Floor and lift access are the main cost drivers, so tell us the floor numbers up front for an accurate quote.',
                    ],
                ],
            ],
            [
                'name' => 'International Shifting',
                'icon' => 'ph:globe-hemisphere-west-fill',
                'image' => 'images/s4.webp',
                'excerpt' => 'Overseas relocation to the Gulf, UK, US, Singapore and Australia — customs paperwork, export packing and door delivery.',
                'benefits' => [
                    'Export-grade packing that meets destination customs standards',
                    'Customs documentation, valuation and clearance handled end to end',
                    'Air freight for urgent and high-value shipments',
                    'Sea freight consolidation for cost-sensitive, larger volumes',
                    'Destination-agent coordination for delivery abroad',
                ],
                'includes' => [
                    'Export packing and crating',
                    'Customs documentation and valuation',
                    'Air and sea freight booking',
                    'Airway bill and customs clearance',
                    'Destination delivery coordination',
                ],
                'faqs' => [
                    [
                        'question' => 'Which countries do you ship to?',
                        'answer' => 'Regularly to the UAE, Saudi Arabia, Qatar, Oman, Kuwait, the UK, the US, Singapore, Malaysia and Australia. We also handle other destinations on request, subject to freight availability.',
                    ],
                    [
                        'question' => 'How long does international shifting take?',
                        'answer' => 'Air freight is typically 5 to 10 days door to door for the Gulf and 12 to 20 days for the UK and US. Sea freight takes 25 to 40 days. Transit insurance is arranged for every consignment.',
                    ],
                    [
                        'question' => 'Will my goods clear customs?',
                        'answer' => 'We prepare the documentation and valuation properly, which is where most claims fail. If customs still raises a query, our agent works it with the destination customs authority until it is released.',
                    ],
                ],
            ],
            [
                'name' => 'Loading and Unloading',
                'icon' => 'ph:truck-fill',
                'image' => 'images/s5.webp',
                'excerpt' => 'Labour-only loading and unloading with hydraulic trolleys, ramps and trained handlers for shops, warehouses and homes.',
                'benefits' => [
                    'Hydraulic trolley, ramp and stacking equipment on every job',
                    'Crew trained to handle appliances and heavy furniture safely',
                    'Manpower-only booking if you already have a vehicle',
                    'Shops and warehouses: hourly or shift-based billing',
                    'Minimal dwell time — we clear the goods and move on',
                ],
                'includes' => [
                    'Trained loading crew',
                    'Trolley, ramp and equipment',
                    'Careful stacking and securing',
                    'Unloading at destination',
                    'Debris-safe handling',
                ],
                'faqs' => [
                    [
                        'question' => 'Can I hire your men without your vehicle?',
                        'answer' => 'Yes. We do labour-only jobs for businesses that own their own trucks. We quote by man-hours or by shift and bring our own trolleys and ramps.',
                    ],
                    [
                        'question' => 'How many workers do I get?',
                        'answer' => 'One skilled handler per roughly 150 kg is the safe ratio, with a supervisor added above about eight men. For heavy appliances we add extra hands automatically.',
                    ],
                    [
                        'question' => 'Do you handle shop shutters and heavy machinery?',
                        'answer' => 'Yes, including rolling shutters, godowns, cold-storage items and shop fixtures. Give us the weights so we send the right equipment.',
                    ],
                ],
            ],
            [
                'name' => 'Packing Services',
                'icon' => 'ph:package-fill',
                'image' => 'images/s6.webp',
                'excerpt' => 'Professional packing and unpacking using bubble wrap, corrugated rolls, cartons and shrink wrap — pack-only or full service.',
                'benefits' => [
                    'Material chosen per item, not one-size-fits-all',
                    'Fragile and glassware individually wrapped and boxed',
                    'Clothing folded and boxed; wardrobes disassembled and packed separately',
                    'Documented inventory with carton numbering',
                    'Unpacking and reassembly at the new place',
                ],
                'includes' => [
                    'All packing materials',
                    'Item-wise wrapping and boxing',
                    'Carton numbering and inventory list',
                    'Unpacking and debris removal',
                    'Sofa and mattress bagging',
                ],
                'faqs' => [
                    [
                        'question' => 'What packing materials do you use?',
                        'answer' => 'Five-layer corrugated cartons, bubble wrap, stretch film, foam sheets, packing paper, tape, blankets and mesh for furniture. For export we use the heavier grade customs expects.',
                    ],
                    [
                        'question' => 'Can I use only your packing service?',
                        'answer' => 'Yes. Many customers pack with us and move with their own vehicle, or with another transporter. We charge packing as a standalone service.',
                    ],
                    [
                        'question' => 'How long does packing a 2 BHK take?',
                        'answer' => 'Roughly three to four hours for a 2 BHK with a full crew, more if you have a lot of fragile items or a wall full of books.',
                    ],
                ],
            ],
            [
                'name' => 'Domestic Movers',
                'icon' => 'ph:truck-fill',
                'image' => 'images/s7.webp',
                'excerpt' => 'Long-distance domestic relocation across Tamil Nadu and beyond, with dedicated vehicles and GPS-tracked transit.',
                'benefits' => [
                    'Dedicated one-vehicle-per-household policy — no mixing',
                    'GPS-tracked vehicles with driver contact shared upfront',
                    'Transit insurance declared to the full value',
                    'Route planned for night driving on long haul',
                    'Written delivery commitment with a compensation clause',
                ],
                'includes' => [
                    'Dedicated closed-body vehicle',
                    'GPS tracking',
                    'Transit insurance',
                    'Long-haul crew',
                    'Written delivery commitment',
                ],
                'faqs' => [
                    [
                        'question' => 'How far do you travel for domestic moving?',
                        'answer' => 'Anywhere within Tamil Nadu and to neighbouring states, plus Bengaluru, Hyderabad, Pune, Mumbai, Chennai and Goa. We also run all-India routes on request.',
                    ],
                    [
                        'question' => 'Do you mix goods from different households?',
                        'answer' => 'No. Your household gets a dedicated vehicle with a dedicated crew. This is a deliberate policy — shared cargo is the most common reason for damage claims.',
                    ],
                    [
                        'question' => 'How do I track my shipment?',
                        'answer' => 'We share the vehicle number and driver number before loading, and the truck is GPS-tracked for the whole journey. You will also get the driver number to call directly.',
                    ],
                ],
            ],
            [
                'name' => 'Door to Door Service',
                'icon' => 'ph:door-open-fill',
                'image' => 'images/s8.webp',
                'excerpt' => 'Complete end-to-end relocation — we pick up from your door and deliver to the door at the destination, unpacked and set up.',
                'benefits' => [
                    'We load from your door, not just the gate or the lobby',
                    'Unpacked, reassembled and arranged at the new place',
                    'Debris from packing removed and disposed of',
                    'Single point of accountability for the whole move',
                    'Written checklist signed at both ends',
                ],
                'includes' => [
                    'Pickup from the source door',
                    'Full packing, loading and transport',
                    'Delivery to the destination door',
                    'Unpacking and arrangement',
                    'Debris disposal',
                ],
                'faqs' => [
                    [
                        'question' => 'What exactly does door to door include?',
                        'answer' => 'Loading starts at your door step rather than the gate. At the destination we deliver to the door, unpack, reassemble furniture and remove the packing debris. There is nothing left for you to do.',
                    ],
                    [
                        'question' => 'Do you move items to the correct rooms?',
                        'answer' => 'Yes, if you label them before we start. Our crew places each carton in the room you specify and hands you the inventory sheet at the end.',
                    ],
                    [
                        'question' => 'Is door to door more expensive?',
                        'answer' => 'It costs slightly more than a transport-only booking because it includes packing, unpacking and debris removal. It is almost always better value than hiring labour separately.',
                    ],
                ],
            ],
            [
                'name' => 'Storage Facility',
                'icon' => 'ph:warehouse-fill',
                'image' => 'images/s9.webp',
                'excerpt' => 'Short and long-term warehouse storage in Erode with palletised, insured, pest-controlled and CCTV-monitored storage.',
                'benefits' => [
                    'Short-term and long-term storage on monthly billing',
                    'Goods palletised and stacked, never floor-stacked',
                    'Pest control, dust protection and CCTV monitoring',
                    'Fire-safety compliant godown with clear aisles',
                    'Inventory maintained so nothing is misplaced or lost',
                ],
                'includes' => [
                    'Palletised storage',
                    'Pest and dust protection',
                    'CCTV surveillance',
                    'Fire-safety compliant premises',
                    'Flexible monthly billing',
                ],
                'faqs' => [
                    [
                        'question' => 'How is storage charged?',
                        'answer' => 'Monthly, based on the volume of goods rather than a flat per-item fee. There is a minimum one-month charge and no deposit beyond one month\'s rent.',
                    ],
                    [
                        'question' => 'Is my furniture safe in long-term storage?',
                        'answer' => 'Goods are palletised, wrapped and stacked off the floor. Our Erode facility is pest-controlled, dust-protected and under CCTV, which covers the usual long-term risks of monsoon and infestation.',
                    ],
                    [
                        'question' => 'Can I access my goods during storage?',
                        'answer' => 'Yes, during working hours with prior notice so we can bring your items to the loading bay. We try to keep to same-day access.',
                    ],
                ],
            ],
            [
                'name' => 'Two Wheeler Shifting',
                'icon' => 'ph:motorcycle-fill',
                'image' => 'images/s10.webp',
                'excerpt' => 'Specialist scooter, motorcycle and cycle shifting with a dedicated bike carrier, wheel chocks and destination delivery.',
                'benefits' => [
                    'Purpose-built multi-bike carrier, not improvised strapping',
                    'Wheel chocks and engine-bay covers, fuel drained as required',
                    'Separate from four-wheeler cargo so it is never crushed',
                    'Delivered directly to the new address, licence permitting',
                    'Popular for student and employee relocations',
                ],
                'includes' => [
                    'Multi-bike carrier vehicle',
                    'Wheel chocks and covers',
                    'Fuel draining where required',
                    'Door delivery within city',
                    'Single-job pricing',
                ],
                'faqs' => [
                    [
                        'question' => 'How do you transport a motorcycle safely?',
                        'answer' => 'The bike rides in a dedicated carrier with a wheel chock and an engine-bay cover, strapped at four points. It never shares a load with household furniture.',
                    ],
                    [
                        'question' => 'Do you carry scooters and cycles too?',
                        'answer' => 'Scooters and motorcycles go on the carrier. Cycles are packed, strapped and carried in the same vehicle as your household goods.',
                    ],
                    [
                        'question' => 'Do I need to be present for delivery?',
                        'answer' => 'Not always. If you authorise a delivery in writing we can drop the bike at the destination, but we do need someone over 18 to receive it for the handover record.',
                    ],
                ],
            ],
            [
                'name' => 'Transport Service',
                'icon' => 'ph:truck-fill',
                'image' => 'images/s11.webp',
                'excerpt' => 'Goods transport for businesses — factory to warehouse, shop to godown, and event material — with owned fleet and insured carriers.',
                'benefits' => [
                    'Owned fleet plus verified contracted carriers',
                    'Open-body, container and flat-body options',
                    'Route-optimised multi-stop deliveries',
                    'POD with photo proof on every drop',
                    'Monthly contracts for regular business volumes',
                ],
                'includes' => [
                    'Multi-stop deliveries',
                    'Open, container and flat-body vehicles',
                    'Photo proof of delivery',
                    'Proof of delivery documentation',
                    'Monthly contract billing',
                ],
                'faqs' => [
                    [
                        'question' => 'Do you provide monthly contracts?',
                        'answer' => 'Yes. Businesses running regular movements typically start on a monthly arrangement with committed volumes, a fixed rate card and a priority slot for urgent dispatches.',
                    ],
                    [
                        'question' => 'Will I get proof of delivery?',
                        'answer' => 'Every delivery gets a signed POD with a timestamp and a photograph, sent to you the same day. Disputes are settled against that record.',
                    ],
                    [
                        'question' => 'What vehicle types are available?',
                        'answer' => 'Open-body trucks for loose goods, container bodies for protected loads, flat bodies for project cargo and mini-trucks for small consignments.',
                    ],
                ],
            ],
            [
                'name' => 'Relocation Service',
                'icon' => 'ph:barcode-fill',
                'image' => 'images/s12.webp',
                'excerpt' => 'Full-service corporate and expatriate relocation — destination support, address change help, settling-in assistance and unpacking.',
                'benefits' => [
                    'One point of contact from survey to final unpacking',
                    'Relocation survey before you sign, so nothing is missed',
                    'Household move, storage and settling-in support combined',
                    'Address change and utility setup assistance',
                    'Documentation help for the new city or country',
                ],
                'includes' => [
                    'Pre-move survey and plan',
                    'Complete packing and transport',
                    'Temporary storage if required',
                    'Unpacking and setup at destination',
                    'Settling-in assistance',
                ],
                'faqs' => [
                    [
                        'question' => 'What does full relocation cover?',
                        'answer' => 'Everything between the survey and the last carton being unpacked. If the move needs an intermediate storage period, that is planned in from the start rather than added mid-way.',
                    ],
                    [
                        'question' => 'Can you help with address change and utilities?',
                        'answer' => 'Within Tamil Nadu and major cities we help with address change for post, bank, insurance and vehicle records, and we can coordinate electricity, gas and internet connections.',
                    ],
                    [
                        'question' => 'Do you handle corporate relocation for employees?',
                        'answer' => 'Yes, and it is usually more cost-effective because a larger volume lets us negotiate a better rate. We invoice your HR team directly against a rate card if that is simpler for you.',
                    ],
                ],
            ],
        ];

        foreach ($services as $index => $service) {
            $name = $service['name'];
            unset($service['name']);

            $service['description'] = $this->buildDescription(
                $name,
                $service['excerpt'],
                $service['benefits'],
                $service['includes'],
            );

            Service::updateOrCreate(
                ['slug' => Str::slug($name)],
                array_merge($service, [
                    'name' => $name,
                    'primary_keyword' => match ($name) {
                        'House Shifting' => 'house shifting',
                        'Office Shifting' => 'office shifting',
                        'Local Shifting' => 'local shifting',
                        'International Shifting' => 'international moving',
                        'Loading and Unloading' => 'loading and unloading services',
                        'Packing Services' => 'packing services',
                        'Domestic Movers' => 'domestic movers',
                        'Door to Door Service' => 'door to door packing and moving',
                        'Storage Facility' => 'storage facility',
                        'Two Wheeler Shifting' => 'two wheeler shifting',
                        'Transport Service' => 'goods transport service',
                        'Relocation Service' => 'relocation services',
                        default => 'packers and movers',
                    },
                    'sort_order' => $index + 1,
                    'is_active' => true,
                ]),
            );
        }
    }

    /**
     * Compose the long-form service body from the structured data above.
     * Every service gets a different intro, list content and locality block, so
     * no two service pages share boilerplate.
     */
    private function buildDescription(string $name, string $excerpt, array $benefits, array $includes): string
    {
        $intro = match ($name) {
            'House Shifting' => 'Moving home is the kind of job people put off for years and then have to do in four days. Our house shifting service exists to take that week off your hands. Whether you are going from a 1 BHK in Erode to a larger flat in Coimbatore, or a rented house in Tiruppur to your own place in Erode, we send a trained crew, pack properly, load carefully and deliver when we said we would.',
            'Office Shifting' => 'An office move is not a house move with desks instead of sofas. The value of the business is in the work, not the furniture, so the job is planned around not losing working hours. We move offices on Saturdays, Sundays and nights, we sequence the move so the floor is usable again as soon as possible, and we handle servers, workstations and cabling as the specialist work it is rather than as cargo.',
            'Local Shifting' => 'Not every move needs a truck. A sofa to a first floor, a mattress to a new room, a few cartons across town — that is a local shifting job, and quoting it like a full household move is how you end up paying twice what the job is worth. We size the vehicle and the crew to the actual volume, which is why our local rates in Erode, Tiruppur and Coimbatore are honest ones.',
            'International Shifting' => 'Overseas moving fails at the paperwork far more often than it fails on the road. A consignment held up at customs is a consignment that keeps costing you. We prepare the export packing, valuation and documentation properly, book the freight, and work with our destination agent until the goods are actually released and delivered — not just handed to a forwarder and forgotten.',
            'Loading and Unloading' => 'Sometimes the hard part of a move is not the journey, it is the two hours of getting a sofa up six flights and a fridge out of a jammed kitchen. That is a labour job, and it is one we take on its own. If you already have a vehicle and you need hands, trolleys and someone who knows how to move a heavy appliance without damaging it, this is the service for you.',
            'Packing Services' => 'Good packing is the difference between arriving with your things and arriving with your things plus an insurance claim. We pack to the item, not to the box — bubble wrap for glass, foam sheets for the corners that actually get hit, mesh and blankets for furniture, and tight double-bagging for anything that leaks. You can book packing on its own with no transport, which is genuinely useful if you are moving with your own vehicle.',
            'Domestic Movers' => "A long-distance move is a test of planning, not of driving. The distance between Erode and Bengaluru is about 340 km; between Erode and Coimbatore, 90. We plan domestic moves around your household rather than our route: a dedicated vehicle, a dedicated crew, a written delivery window, and the driver's number before we load so you can reach the truck yourself at any point.",
            'Door to Door Service' => 'Door to door is the version of this job where you do nothing. We load from your door, not the gate. We deliver to the door at the new place, unpack, reassemble the furniture, put things in the rooms you labelled, and take the packing debris away with us. It costs a little more than transport alone and it is almost always better value than hiring labour separately and hoping it goes well.',
            'Storage Facility' => 'There are two moments when a storage facility is genuinely necessary rather than a luxury: you have taken possession of a new place but cannot move in yet, and you are between two business premises. We hold goods in our own Erode godown for both, palletised and off the floor, in a pest-controlled and monitored building, on simple monthly billing, and we bring your items back out when you are ready.',
            'Two Wheeler Shifting' => 'A motorcycle is a cheap vehicle to buy and an expensive one to damage, because the damage is usually done in the two seconds it takes to strap it to a truck that was not built for it. We use a dedicated multi-bike carrier with a wheel chock and an engine-bay cover, strapped at four points, and the bike never shares a load with your household furniture.',
            'Transport Service' => 'Not everything that needs moving is a household. Business inventory, godown stock, factory materials, shop fittings and event equipment all need to move on a schedule, with proof that they arrived. We run an owned fleet plus verified contracted carriers, with open-body, container and flat-body options, multi-stop routes, and a photo proof of delivery on every single drop.',
            'Relocation Service' => 'Full relocation is the complete version: one contact from the first survey to the last carton being unpacked, covering the move, any storage in between, and the settling-in tasks afterwards. It suits corporate moves, expatriate moves, and anyone who does not want to be the project manager of their own shifting for three weeks.',
            default => $excerpt,
        };

        $includeList = implode('', array_map(fn ($i) => "<li>{$i}</li>", $includes));
        $benefitList = implode('', array_map(fn ($b) => "<li>{$b}</li>", $benefits));

        $coverage = 'We run this service across Erode, Tiruppur and Coimbatore as our primary markets, and out to Salem, Trichy, Namakkal, Karur, Dharmapuri and Bengaluru. The same crew, the same equipment and the same written rate apply everywhere — we are not reselling your job to whoever happens to have a free vehicle that week.';

        $closing = 'If you want a firm price rather than an estimate, call us on +91 93635 55311 or send an enquiry with your two cities, the floors involved and your preferred date. We will give you a written quote, and we do not change it on the day.';

        return <<<HTML
<p>{$intro}</p>

<h2>What is included in our {$name} service</h2>
<ul>{$includeList}</ul>

<h2>Why customers choose us for {$name}</h2>
<ul>{$benefitList}</ul>

<h2>{$name} in Erode, Tiruppur and Coimbatore</h2>
<p>{$coverage}</p>

<h2>Getting a quote for {$name}</h2>
<p>{$closing}</p>
HTML;
    }
}
