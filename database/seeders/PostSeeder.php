<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        $posts = [
            [
                'title' => 'Moving Cost in Erode: What Actually Drives the Price',
                'image' => 'images/s3.webp',
                'meta_title' => 'Moving Cost in Erode 2026 | What Affects Packers and Movers Charges',
                'meta_description' => 'A practical breakdown of what determines packers and movers charges in Erode — volume, floors, lift access, distance and packing. With real price ranges.',
                'excerpt' => 'Most moving quotes differ by up to 40% for the same job. Here is exactly which four variables move the number, with real Erode price ranges so you can sanity-check a quote before you accept it.',
                'body' => $this->movingCost(),
                'published_at' => now()->subDays(6)->setTime(9, 0),
            ],
            [
                'title' => 'How to Pack a Kitchen Correctly for a House Shift',
                'image' => 'images/s6.webp',
                'meta_title' => 'How to Pack a Kitchen for Shifting | Packing Guide for Movers',
                'meta_description' => 'A step-by-step guide to packing a kitchen safely for a house shift, including glass, appliances, spices and what to keep with you rather than in a carton.',
                'excerpt' => 'The kitchen is where most breakage happens on a house move. Here is the order we pack in, and the small number of things that should never go into a carton at all.',
                'body' => $this->kitchenPacking(),
                'published_at' => now()->subDays(21)->setTime(9, 0),
            ],
            [
                'title' => 'Erode to Coimbatore Shift: Distance, Timing and What to Expect',
                'image' => 'images/s1.webp',
                'meta_title' => 'Erode to Coimbatore Packers and Movers | Distance, Time and Cost',
                'meta_description' => 'Everything about an Erode to Coimbatore house shift — the 90 km route, realistic timing, cost range for each BHK size, and the last-mile problems in Bengaluru and Coimbatore streets.',
                'excerpt' => 'This is one of our most requested routes. Here is the honest picture: what the drive actually takes, why we load in the evening, and what changes the price.',
                'body' => $this->erodeToCoimbatore(),
                'published_at' => now()->subDays(38)->setTime(9, 0),
            ],
            [
                'title' => 'Why Your Moving Quote Changed on Delivery Day (and How to Prevent It)',
                'image' => 'images/s5.webp',
                'meta_title' => 'How to Avoid Hidden Moving Charges | Fixed-Price Moving Quotes',
                'meta_description' => 'Extra charges appear on delivery day because of volume, floor access and last-minute additions. Learn the four legitimate reasons a quote changes and how to lock a fixed price.',
                'excerpt' => 'A quote changing on the day is usually one of four predictable reasons — and three of them can be avoided with a better survey. Here is how to tell a legitimate revision from a billing trick.',
                'body' => $this->quoteChanges(),
                'published_at' => now()->subDays(55)->setTime(9, 0),
            ],
            [
                'title' => 'Office Relocation Checklist: Moving Without Losing a Working Day',
                'image' => 'images/s2.webp',
                'meta_title' => 'Office Relocation Checklist | Moving an Office Without Downtime',
                'meta_description' => 'A practical office relocation checklist covering IT assets, cabling, inventory, weekend sequencing and restart planning, written by movers who do this every week.',
                'excerpt' => 'Around 70% of the office moves we do happen on a Saturday night. Here is the sequence that gets a workplace trading again on Monday morning.',
                'body' => $this->officeChecklist(),
                'published_at' => now()->subDays(72)->setTime(9, 0),
            ],
            [
                'title' => 'House Shifting in Coimbatore: Which Streets Need a Smaller Truck',
                'image' => 'images/why3.webp',
                'meta_title' => 'House Shifting in Coimbatore | Street Access and Vehicle Sizing',
                'meta_description' => 'Why moving in Coimbatore needs a different vehicle depending on the street — RS Puram, Ukkadam, Gandhipuram and the newer layouts compared, with practical access advice.',
                'excerpt' => 'Coimbatore is not one job, it is six. The difference between a smooth move and a truck stuck at 6 PM on a residential street is almost always the street, not the moving company.',
                'body' => $this->coimbatoreAccess(),
                'published_at' => now()->subDays(90)->setTime(9, 0),
            ],
        ];

        foreach ($posts as $post) {
            $post['slug'] = Str::slug($post['title']);
            $post['author'] = 'Next Level Packers & Movers';
            $post['is_published'] = true;
            $post['views'] = 0;

            Post::updateOrCreate(['slug' => $post['slug']], $post);
        }
    }

    private function movingCost(): string
    {
        return <<<'HTML'
<p>If two movers quote very different amounts for the same move, it is almost always because one of them surveyed properly and the other guessed from a phone call. Here is what actually determines the number, in the order of impact.</p>

<h2>1. Volume of goods — the biggest single variable</h2>
<p>Every mover prices by volume. A 1 BHK is roughly 80 to 110 cubic feet, a 2 BHK around 150 to 200, and a 3 BHK around 250 to 320. The vehicle follows the volume: an 8-footer carries about 100 cubic feet of packed load, a 13-footer about 250, a 17-footer about 400.</p>
<p>So a 1 BHK that fits an 8-footer will cost roughly half a 1 BHK that needs a 13-footer. If a quote looks cheap, the honest question is not "are they cheaper" but "what size truck are they actually sending".</p>

<h2>2. Floor and lift access</h2>
<p>There is no lift, or the lift is too small for the sofa, and the flat is on the seventh floor — that is a manual carry. It adds a crew and it adds hours. In Erode's older apartments around Bypass Road and in the older Coimbatore layouts, this is common.</p>
<p>Always give us the floor number of both the pickup and the delivery address. A quote that assumes a lift and a reality without one is the most common reason a final bill is higher than the estimate.</p>

<h2>3. Packing, or transport only</h2>
<p>Packing is a significant part of the total. If you pack yourself, the transport-only rate is meaningfully lower. Both are legitimate — pick whichever suits you.</p>
<ul>
<li>Local 1 BHK, transport only: roughly ₹1,800 to ₹2,500 within Erode</li>
<li>Local 1 BHK, full packing: roughly ₹3,500 to ₹4,500 within Erode</li>
<li>Local 2 BHK, full packing: roughly ₹5,500 to ₹7,500 within Erode</li>
<li>Erode to Coimbatore or Tiruppur, 1 BHK full packing: roughly ₹8,000 to ₹12,000</li>
</ul>

<h2>4. Distance and route</h2>
<p>Beyond roughly 50 km the cost shifts from a flat local rate to a per-kilometre calculation plus a driver allowance. A 90 km Erode to Coimbatore run and a 340 km Erode to Bengaluru run are priced completely differently, and the Bengaluru rate includes two drivers running a night shift.</p>

<h2>What should not affect the price</h2>
<p>Fuel surcharge, toll charges, "extra handling" fees and a loading-time charge that appears on delivery day. If a mover quotes you a rate, that is the rate. If the scope genuinely changes while the truck is loaded — you add a floor of items, or the destination turns out to be six floors with no lift — the mover should tell you and agree the change before proceeding, and you should be free to decline it.</p>

<h2>How to sanity-check a quote</h2>
<p>Ask three things: what size vehicle, how many people on the crew, and is packing included. If you get clear answers to all three, two quotes for the same job should land within about 10% of each other. A quote that is 40% below everyone else is not a bargain, it is a different job.</p>
HTML;
    }

    private function kitchenPacking(): string
    {
        return <<<'HTML'
<p>Most breakage on a house move happens in the kitchen, and almost all of it is avoidable. The reason kitchens are risky is that they contain three different categories of object — hard and breakable, heavy and awkward, and small and easily lost — and most people pack them as if they are all the same.</p>

<h2>Pack in this order</h2>
<p>Start with the things that will not be needed for the first few days, and work towards the everyday crockery. That way the first box you unpack is the one you actually need, and the fragile seasonal items stay buried safely at the bottom.</p>
<ol>
<li><strong>Seasonal and decorative items</strong> — festival ware, glass decor, the good serving bowls. These are the most breakable and the least needed on arrival.</li>
<li><strong>Small appliances</strong> — mixers, grinders, toasters, irons. These go in their own cartons with padding, not loose in a big box.</li>
<li><strong>Large appliances</strong> — fridge, washing machine, microwave. These are moved by the crew on a trolley; do not put loose items inside them, and let us know at booking so we plan the handling.</li>
<li><strong>Dried goods and spices</strong> — leak-proof bags inside double bags, upright, tight, and away from anything that can crush.</li>
<li><strong>Everyday crockery and glass</strong> — wrapped individually, then boxed, then padded between the layers. Not together.</li>
</ol>

<h2>Wrap glass individually, then again</h2>
<p>Wrapping plates together in one sheet is the single most common packing mistake. A stack moves as a single unit, so one chip cracks the entire stack. Wrap every plate and bowl separately, nest them with padding between layers, and never fill a carton more than three-quarters — a full carton is a carton that gets dropped.</p>

<h2>What must not go in a carton at all</h2>
<ul>
<li><strong>Knives, scissors and blades</strong> — these are a genuine safety risk for the crew. Hand them over separately at the start of the job.</li>
<li><strong>Documents, certificates, passports and title deeds</strong> — keep these on your person.</li>
<li><strong>Medicines</strong> — you do not want to unpack a carton searching for a prescription.</li>
<li><strong>Valuables, cash, laptop and chargers</strong> — personally carried, never packed.</li>
<li><strong>Anything with a data source you cannot recreate</strong> — a single-use external drive is not a copy of your data.</li>
</ul>

<h2>Label the carton, not just the room</h2>
<p>Write the room name and a short contents line on every carton — "kitchen upper shelf", "kitchen base jars". A numbered inventory sheet handed to you at delivery makes it obvious at a glance if something is missing, while you are still standing in the doorway.</p>

<h2>One honest note on the fridge</h2>
<p>Modern refrigerators need to stand upright for several hours before you plug them back in after a move. Tell us in advance if a fridge is involved, and follow the manufacturer's guidance on wait time before switching on.</p>
HTML;
    }

    private function erodeToCoimbatore(): string
    {
        return <<<'HTML'
<p>Erode to Coimbatore is one of the two routes we run most often, and one of the most requested moves in Tamil Nadu. It is about 90 km via the NH-47, roughly two hours of driving, which makes it feel like a short hop and get quoted as one.</p>

<h2>Realistic timing</h2>
<p>Two hours is the driving time on a clear road. A real moving job is not two hours. Load, wrap, secure, drive, unload, carry up, reassemble — for a 1 BHK with full packing, budget five to seven hours door to door.</p>
<p>That is why we usually load in the evening and deliver the next morning for this route. You pack once, you carry once, and the household is not sitting with boxes in a half-unpacked flat all day. The same job done in a single day needs a bigger crew and costs more in labour.</p>

<h2>Cost by size</h2>
<ul>
<li>1 BHK, full packing, 13-footer: roughly ₹8,000 to ₹12,000</li>
<li>2 BHK, full packing, 17-footer: roughly ₹12,000 to ₹17,000</li>
<li>3 BHK, full packing, 20/22-footer: roughly ₹17,000 to ₹24,000</li>
<li>Add roughly 15 to 20 percent if either address has no lift and the flat is above the second floor</li>
</ul>

<h2>The last mile matters more than the distance</h2>
<p>Ninety kilometres of highway is the easy part. What decides whether a move goes smoothly is the last two kilometres in Coimbatore, and this is the single biggest reason we survey a delivery address before quoting.</p>
<p>Some parts of the city take a large vehicle comfortably. Others do not:</p>
<ul>
<li><strong>Newer layouts</strong> around Thudiyalur, Perumanallur and the Vellakoil side generally have wide internal roads and turning space.</li>
<li><strong>Older central areas</strong> — RS Puram, Ukkadam, Gandhipuram, parts of Sukkamvaram — have narrow streets, low-hanging service lines and tight corners. A 32-footer physically cannot enter some of these streets.</li>
</ul>
<p>When a vehicle cannot reach the door, the last leg is done with a smaller shuttle truck, and that is a planned part of the job rather than an argument on delivery day. But it is cheaper to know in advance and budget for it in the quote.</p>

<h2>Timing that suits the route</h2>
<p>Avoid the 8 to 10 AM and 5 to 8 PM windows on the NH-47 near Coimbatore. The evening load-and-go schedule naturally avoids the worst of it. If you need a same-day single-day move, start the load by 7 AM.</p>
HTML;
    }

    private function quoteChanges(): string
    {
        return <<<'HTML'
<p>A quote that changes on the day is either a legitimate change in scope, or a billing practice. The difference is usually whether you were told before the work continued. Here is how to tell them apart.</p>

<h2>The four legitimate reasons a quote changes</h2>

<h3>1. The volume is genuinely larger than estimated</h3>
<p>Households regularly underestimate. A "small 2 BHK" with a full study, a decent wardrobe in each room and a lot of books is a 3 BHK by volume. If the goods fill the vehicle, the mover needs a bigger one, and that is a real cost.</p>
<p><strong>Prevention:</strong> count wardrobes, sofas, beds, almirahs, refrigerators, washing machines and the number of boxes you plan to pack. Send us that list and the estimate becomes accurate.</p>

<h3>2. Floor access differs from what was quoted</h3>
<p>The quote assumed a working lift. On the day, the lift is out for maintenance, or the building is six floors with no lift, or the gate is too narrow for the truck. A manual carry up six floors with a crew is a real additional cost.</p>
<p><strong>Prevention:</strong> give us the floor number for both addresses, and check whether the lift will be working on the day. If it might not, quote for the manual carry — it is cheaper to agree it upfront than to argue on delivery day.</p>

<h3>3. The destination changes mid-job</h3>
<p>Plans change. If the new address is not what we quoted for, or a third-floor lift turns out to be a fourth-floor walk-up, the mover has to tell you and agree the revised number before proceeding.</p>
<p><strong>Prevention:</strong> none needed. This is just a real change, and the test is whether you were told before the work continued.</p>

<h3>4. You add scope while the truck is loaded</h3>
<p>You decided to move the almirah too, or you need two extra trips to the godown. That is additional work and additional cost, entirely reasonable.</p>
<p><strong>Prevention:</strong> decide the final list before loading, not during.</p>

<h2>What is not a legitimate reason</h2>
<ul>
<li><strong>Fuel surcharge</strong> — the price quoted should already include it. A fuel surcharge added at the end is a sign the original quote was padded, so you can reasonably expect other additions too.</li>
<li><strong>Toll charges</strong> — these are the mover's cost of doing business, not yours, unless it was stated in the quote.</li>
<li><strong>"Extra handling" with no description</strong> — if there is a specific item that needs different handling, name it and price it. A vague handling charge is not a charge.</li>
<li><strong>A loading-time charge</strong> — unless the quote stated a time limit, there is none.</li>
<li><strong>Charging for stairs you were told about</strong> — if you disclosed the floors and they still quoted, they have already priced it.</li>
</ul>

<h2>The practical protection</h2>
<p>Ask for the quote in writing, with the vehicle size, the number of crew, whether packing is included, and the addresses quoted for, all stated explicitly. Agree that any change to those four things gets discussed and accepted before the work continues.</p>
<p>Ask for a job sheet at the start and a signed copy at the end. It is a small thing, and it settles almost every dispute — because everything is on the page before anybody argues.</p>
HTML;
    }

    private function officeChecklist(): string
    {
        return <<<'HTML'
<p>Most office moves that go badly are not the transport going wrong. It is the discovery, at the new place, that a cable run was never documented or that the server room was packed in the wrong order. Here is the sequence that works.</p>

<h2>Two to three weeks before</h2>
<ul>
<li>Agree a moving date that avoids a pay cycle, a month-end close, a board meeting or an exam week.</li>
<li>Decide who owns the move internally. One project manager, not six departments each talking to the mover.</li>
<li>Take an inventory: what exists, how many, what condition. Photograph server rooms, racks and the cable layout before anyone touches them.</li>
<li>Confirm both addresses with the movers, including floor, lift size, parking and whether the loading bay is reserved.</li>
</ul>

<h2>One week before</h2>
<ul>
<li>Tell IT what is being moved and when. Back up everything, and verify the backup, not just the command.</li>
<li>Label network points at both ends. A label at the wall and the same label at the patch panel saves an afternoon.</li>
<li>Flag anything fragile or unusual — server racks, printers, scanners, water coolers, the tea trolley — rather than assuming the crew will spot it.</li>
<li>Arrange the new premises: power, cooling, network drops, desk space, and access for the movers outside office hours.</li>
</ul>

<h2>Move night</h2>
<p>Sequence matters more than speed:</p>
<ol>
<li><strong>IT and network first</strong> — servers, network points and cabling, while the floor is still clear and there is room to work.</li>
<li><strong>Desks and workstations</strong> — before anything is stacked against a wall.</li>
<li><strong>Partitions and cabins</strong> — while there is still floor space to stand them up.</li>
<li><strong>Heavy furniture and storage</strong> — last, so it goes in where it belongs rather than getting moved twice.</li>
<li><strong>Stationery and consumables</strong> — final, straight into the correct room.</li>
</ol>
<p>Keep one box of immediate essentials — coffee, water, chargers, first aid, a change of clothes for the person on site — and open it first, not last.</p>

<h2>Monday morning</h2>
<ul>
<li>Walk the floor against the inventory before the crew leaves. Discrepancies are easy to settle on the spot and near-impossible a week later.</li>
<li>Get the signed job sheet and the carton inventory list.</li>
<li>Test every network point, every workstation and the printer. Problems found in the first hour are cheap; found on Wednesday are not.</li>
</ul>

<h2>One thing worth deciding early</h2>
<p>Decide what happens to the old office. If the lease has not ended, a lot of companies pack everything into storage. That is almost never the right answer — you pay for storage and you pay again when you move in again. Pack only what you will not use in the first month, and leave the rest.</p>
HTML;
    }

    private function coimbatoreAccess(): string
    {
        return <<<'HTML'
<p>Anyone who has moved in Coimbatore knows the difference between a move that goes smoothly and a move that ends with a truck circling the block at 6 PM. It is almost never the mover. It is the street.</p>

<h2>The vehicle decision, by area</h2>
<p>Coimbatore divides fairly cleanly, and knowing which side of the city you are on tells you what you need.</p>

<h3>Newer layouts — usually easy</h3>
<p>Thudiyalur, Perumanallur, the Vellakoil side and most of the gated township developments have wide internal roads, proper turning circles and enough kerb space to get a 17 or 20-footer into position. These are straightforward.</p>

<h3>Mixed areas — check the specific street</h3>
<p>Valangaiman Street, Ganapathy, parts of Singanalur and Selvapuram vary building by building. Older apartment blocks here may have a narrow internal lane, low-hanging service lines, or a gate the truck has to reverse through. Usually manageable with a 13-footer.</p>

<h3>Older central areas — plan the last leg</h3>
<p>RS Puram, Ukkadam, Sukkamvaram, Saibaba Colony and the tighter streets off Gandhipuram are the hard cases. Two recurring problems:</p>
<ul>
<li><strong>Street width.</strong> A 32-footer or even a 20-footer sometimes cannot enter at all without a police escort and blocking a main road to turn.</li>
<li><strong>Service lines and overhangs.</strong> Low-hanging lines and balconies rule out tall vehicles entirely.</li>
</ul>
<p>Where a large vehicle cannot reach the door, the correct approach is a planned shuttle: the big truck stops at a workable point, goods transfer to a smaller vehicle or a hand cart, and the last stretch is done by the crew. That is normal practice, not a failure — but it needs to be in the quote, and it takes extra time that a careless mover will skip.</p>

<h2>Why this matters for your quote</h2>
<p>When we quote a Coimbatore move we ask for the exact street, not just the locality, and whether there is a lift. That is not us being fussy. It is the difference between an accurate number and a number that grows on delivery day.</p>
<p>If you are comparing quotes, this is a fair question to ask any mover: <em>"What size truck are you sending to my street, and what happens if it cannot get to my gate?"</em> A confident answer is a good sign. "We will manage it on the day" is not.</p>

<h2>Other Coimbatore specifics worth knowing</h2>
<ul>
<li><strong>Lift size.</strong> A modern lift is often the constraint, not the lift at all. A large sofa that fits through a wide front door will not fit in a standard lift, and it will not go up the stairs easily either. Measure the sofa and the lift car.</li>
<li><strong>Parking and loading bays.</strong> Reserve them in advance. A truck parked illegally for two hours is both a risk to the goods and a genuine nuisance to the street.</li>
<li><strong>Society working hours.</strong> Most societies restrict moves to specific hours and often demand a written undertaking. We handle this routinely — just tell us the society's rules when you book.</li>
</ul>
HTML;
    }
}
