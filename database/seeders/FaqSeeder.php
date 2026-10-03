<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    public function run(): void
    {
        $faqs = [
            [
                'category' => 'general',
                'question' => 'How much do packers and movers charge in Erode?',
                'answer' => 'A local 1 BHK move within Erode starts around ₹3,500 and a 2 BHK around ₹5,500 to ₹7,500. Inter-city moves are priced by distance and vehicle size — Erode to Coimbatore or Tiruppur is typically ₹8,000 to ₹12,000 for a 1 BHK with full packing. The three things that move the price most are volume, floor and lift access, and whether you need packing. We confirm the rate in writing before loading anything, and we do not add charges on the day.',
            ],
            [
                'category' => 'general',
                'question' => 'How do I get a free quote for my move?',
                'answer' => 'Call us on +91 93635 55311 or fill the enquiry form on this page with your name, phone number, the two cities and your preferred moving date. We come back with a written quote the same day. For moves inside Erode, Tiruppur or Coimbatore we can usually give you a firm price on the phone itself.',
            ],
            [
                'category' => 'general',
                'question' => 'Are your moving charges really fixed, or do they change on the day?',
                'answer' => 'Fixed. The price we quote is the price you pay. We do not add a fuel surcharge, a toll charge or an "extra handling" fee on the delivery day. If the scope genuinely changes on the day — for example, you add a floor of items while we are already loaded — we agree the revised amount with you before we proceed, and you can decline it.',
            ],
            [
                'category' => 'general',
                'question' => 'How far in advance should I book my move?',
                'answer' => 'Two to three days is enough for local moves. For month-end and month-start weekends, book a week ahead because that is when Erode, Tiruppur and Coimbatore demand peaks and vehicles are committed. International moves should be booked two to three weeks ahead because of customs documentation and freight booking.',
            ],
            [
                'category' => 'general',
                'question' => 'Do you provide packing materials, or do I have to buy them?',
                'answer' => 'We provide them as part of the packing service. Cartons, bubble wrap, stretch film, packing paper, tape, blankets and mesh for furniture are all included, and we bring enough for the volume we are told. You do not need to buy anything yourself.',
            ],
            [
                'category' => 'general',
                'question' => 'Is my furniture insured during the move?',
                'answer' => 'Transit insurance is included as standard and is declared to the full value of the consignment. If damage is found at the time of delivery it is settled from the same job sheet, so you are not chasing a separate claim weeks later.',
            ],
            [
                'category' => 'general',
                'question' => 'Do you mix goods from different households in one vehicle?',
                'answer' => 'No. Your household gets a dedicated vehicle with a dedicated crew. Shared cargo is the most common reason goods get damaged, so we have a deliberate no-sharing policy on every domestic move.',
            ],
            [
                'category' => 'general',
                'question' => 'What areas do you cover?',
                'answer' => 'We are based in Erode and cover Erode, Tiruppur and Coimbatore as our primary cities, plus Salem, Trichy, Namakkal, Karur, Dharmapuri and Bengaluru. We also handle international moves to the Gulf, UK, US, Singapore, Malaysia and Australia.',
            ],
            [
                'category' => 'general',
                'question' => 'Can I track my vehicle while it is in transit?',
                'answer' => 'Yes. We share the vehicle number and driver number before loading, the truck is GPS-tracked for the whole journey, and you can call the driver directly. For long-haul moves we also agree a delivery window with you in advance.',
            ],
            [
                'category' => 'general',
                'question' => 'What should I keep with me on moving day?',
                'answer' => 'Keep all documents, certificates, medicines, valuables, laptops, chargers and any keys or remotes with you personally — do not pack them in a carton. Carry a copy of your ID and the new address details, and keep the inventory sheet we hand over at delivery until you have checked everything through.',
            ],
            [
                'category' => 'general',
                'question' => 'Do you move showrooms, factories and institutions?',
                'answer' => 'Yes, and a large part of our business. We move showrooms, textile and knitting units, engineering plants, clinics, hospitals, coaching centres, schools and offices. Anything above roughly 5,000 sq ft gets a site survey first so we can give you a phased plan and a realistic shutdown window.',
            ],
            [
                'category' => 'general',
                'question' => 'How long have you been in business?',
                'answer' => 'Since 2015, and we have been operating out of Chithode in Erode for the whole of that period. We are a local company with our own storage facility and a crew we know, rather than a broker forwarding your job to whoever is free that day.',
            ],
        ];

        foreach ($faqs as $index => $faq) {
            Faq::updateOrCreate(
                ['question' => $faq['question']],
                array_merge($faq, ['is_active' => true, 'sort_order' => $index + 1]),
            );
        }
    }
}
