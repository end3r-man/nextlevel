<?php

namespace Database\Seeders;

use App\Models\GalleryImage;
use App\Models\Service;
use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class ContentSeeder extends Seeder
{
    public function run(): void
    {
        $this->seedTestimonials();
        $this->seedGallery();
    }

    private function seedTestimonials(): void
    {
        $services = Service::pluck('id', 'slug');

        $testimonials = [
            [
                'name' => 'Prakash',
                'location' => 'Erode',
                'designation' => 'Homeowner',
                'quote' => 'Moved a 3 BHK from Chithode to Perundurai Road. The packing was genuinely careful — the kitchen and the TV were wrapped properly and nothing broke. Delivery was on time, not approximate. Worth the money.',
                'rating' => 5,
                'service_id' => $services['house-shifting'] ?? null,
                'sort_order' => 1,
            ],
            [
                'name' => 'Ajith Selvan',
                'location' => 'Coimbatore',
                'designation' => 'Business Owner',
                'quote' => 'We shifted our office over a weekend and were trading again on Monday. They handled the servers and workstations properly and the seating was back in place before we came in. Well organised and reasonably priced.',
                'rating' => 5,
                'service_id' => $services['office-shifting'] ?? null,
                'sort_order' => 2,
            ],
            [
                'name' => 'Ramesh',
                'location' => 'Tiruppur',
                'designation' => 'Factory Owner',
                'quote' => 'Moved a full knitting unit from Avinashi Road to the new shed in Palladam Road. Machines were crated and reinstalled properly. They planned the shutdown to the hour and we lost almost no production time.',
                'rating' => 5,
                'service_id' => $services['office-shifting'] ?? null,
                'sort_order' => 3,
            ],
            [
                'name' => 'Deepa',
                'location' => 'Erode',
                'designation' => 'Homeowner',
                'quote' => 'Used their storage facility for about six weeks between our old house and the new flat. Goods stayed clean and dry through the monsoon, and delivery to the new place was done properly. Very reliable people.',
                'rating' => 5,
                'service_id' => $services['storage-facility'] ?? null,
                'sort_order' => 4,
            ],
            [
                'name' => 'Sathish',
                'location' => 'Erode to Coimbatore',
                'designation' => 'Homeowner',
                'quote' => 'Erode to Coimbatore, loaded in the evening and delivered the next morning as promised. Driver shared his number before loading, which made tracking easy. No complaints at all.',
                'rating' => 5,
                'service_id' => $services['local-shifting'] ?? null,
                'sort_order' => 5,
            ],
            [
                'name' => 'Priya',
                'location' => 'Tiruppur',
                'designation' => 'Homeowner',
                'quote' => 'Moved just a sofa and a mattress within Tiruppur. I expected them to quote a full truck and they did not. Arrived on time, took ten minutes, charged fairly. Rare to see that honesty.',
                'rating' => 5,
                'service_id' => $services['local-shifting'] ?? null,
                'sort_order' => 6,
            ],
            [
                'name' => 'Karthik',
                'location' => 'Bengaluru',
                'designation' => 'Software Professional',
                'quote' => 'Moved from Erode to Whitefield. They planned the last mile for the actual Bengaluru street instead of just sending a big truck, which is why nothing got stuck. Good people to deal with on a long move.',
                'rating' => 5,
                'service_id' => $services['domestic-movers'] ?? null,
                'sort_order' => 7,
            ],
            [
                'name' => 'Lakshmi',
                'location' => 'Salem',
                'designation' => 'Homeowner',
                'quote' => 'International shifting to Dubai. The documentation and valuation were done properly, which mattered because that is where most people get stuck at customs. Everything cleared without a problem.',
                'rating' => 5,
                'service_id' => $services['international-shifting'] ?? null,
                'sort_order' => 8,
            ],
            [
                'name' => 'Mohan',
                'location' => 'Erode',
                'designation' => 'Homeowner',
                'quote' => 'Two-wheeler shifting done properly with a proper carrier and wheel chock, not just someone tying the bike to a truck. Small detail but it is the difference between the bike arriving and not arriving.',
                'rating' => 5,
                'service_id' => $services['two-wheeler-shifting'] ?? null,
                'sort_order' => 9,
            ],
            [
                'name' => 'Anitha',
                'location' => 'Erode',
                'designation' => 'Homeowner',
                'quote' => 'Booked door to door and they genuinely did everything — packing, loading, delivery, unpacking, even clearing the debris. I did not have to do a single thing on moving day except sign the sheet.',
                'rating' => 5,
                'service_id' => $services['door-to-door-service'] ?? null,
                'sort_order' => 10,
            ],
        ];

        foreach ($testimonials as $t) {
            Testimonial::updateOrCreate(['name' => $t['name']], array_merge($t, [
                'is_featured' => true,
                'is_active' => true,
            ]));
        }
    }

    private function seedGallery(): void
    {
        $images = [
            ['images/55.webp', 'Truck Loading At Client Home', 'Next Level crew loading packed cartons onto a closed-body truck at a house in Erode'],
            ['images/g1.webp', 'Professional Packing In Progress', 'Technicians wrapping household goods in bubble wrap during a packing job in Erode'],
            ['images/g2.webp', 'Cartons Sealed And Numbered', 'Numbered and sealed cartons ready for transport after a house shifting job'],
            ['images/g3.webp', 'Sofa Padding And Strapping', 'A sofa edge-padded and strapped with belts before loading into the vehicle'],
            ['images/g4.webp', 'Office Relocation', 'Office workstations being labelled and dismantled for a weekend corporate move in Coimbatore'],
            ['images/g5.webp', 'Vehicle Loading', 'Loading a packed vehicle for a Tiruppur to Erode house shifting move'],
            ['images/g6.webp', 'Two Wheeler On Carrier', 'A motorcycle secured on a dedicated bike carrier for two-wheeler shifting'],
            ['images/g7.webp', 'Warehouse Storage Stacks', 'Palletised goods wrapped and stacked in our Erode storage facility'],
            ['images/g88.webp', 'House Shifting Crew At Work', 'Our moving crew handling furniture and goods at a client residence'],
            ['images/g9.webp', 'Packing Materials And Cartons', 'Cartons, bubble wrap and packing material prepared for a relocation'],
            ['images/g10.webp', 'Unloading At Destination', 'Unloading goods and reassembling furniture at the destination home'],
            ['images/g11.webp', 'Large Household Move', 'A full household consignment prepared for a long-distance domestic move'],
            ['images/g12.webp', 'Furniture Dismantling', 'Our carpenter team dismantling a wardrobe for safe transport'],
            ['images/g13.webp', 'Goods Ready For Delivery', 'Packed goods secured and ready for delivery to the new address'],
        ];

        foreach ($images as $index => [$file, $title, $alt]) {
            GalleryImage::updateOrCreate(
                ['image' => $file],
                [
                    'title' => $title,
                    'alt_text' => $alt,
                    'is_active' => true,
                    'sort_order' => $index + 1,
                ],
            );
        }
    }
}
