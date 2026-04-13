<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            // --- FULL BIKES (Units) ---
            [
                "name" => "Polygon Siskiu T8",
                "description" => "A high-performance full suspension trail bike ready for an adventure. Built with ALX alloy frame and durable components.",
                "price" => 28500000,
                "stock" => 15,
                "categories" => "unit",
                "status" => "available",
                "image" => null,
            ],
            [
                "name" => "Trek Marlin 7 Gen 3",
                "description" => "Your best friend on the trail and your daily commuter. Upgraded RockShox fork and Shimano Deore drivetrain.",
                "price" => 13500000,
                "stock" => 8,
                "categories" => "unit",
                "status" => "available",
                "image" => null,
            ],
            [
                "name" => "Specialized Stumpjumper EVO Elite Alloy",
                "description" => "The ultimate alloy trail bike. Built to go full gas through the roughest terrain, featuring SWAT door integration.",
                "price" => 55000000,
                "stock" => 3,
                "categories" => "unit",
                "status" => "available",
                "image" => null,
            ],
            [
                "name" => "Santa Cruz Hightower 3",
                "description" => "The Hightower remains our greatest hits engineering. Lower-link VPP suspension means big hit capabilities.",
                "price" => 80000000,
                "stock" => 1,
                "categories" => "unit",
                "status" => "available",
                "image" => null,
            ],
            [
                "name" => "Giant Trance X Advanced Pro 29",
                "description" => "From chunky rock gardens to fast, flowy singletrack. Lightweight carbon frame with adjustable geometry.",
                "price" => 65000000,
                "stock" => 0,
                "categories" => "unit",
                "status" => "unavailable",
                "image" => null,
            ],
            [
                "name" => "Polygon Collosus N9",
                "description" => "An enduro beast built to tackle the most demanding descents of EWS tracks. High-pivot suspension design.",
                "price" => 48000000,
                "stock" => 5,
                "categories" => "unit",
                "status" => "available",
                "image" => null,
            ],
            [
                "name" => "Cannondale Scalpel HT Carbon 3",
                "description" => "A whole new breed of cross-country hardtail. The purest form of racing speed with a Lefty Ocho fork.",
                "price" => 32000000,
                "stock" => 7,
                "categories" => "unit",
                "status" => "available",
                "image" => null,
            ],
            [
                "name" => "Scott Spark RC Team Issue AXS",
                "description" => "World Championship proven full suspension cross-country race bike. Features wireless shifting.",
                "price" => 78000000,
                "stock" => 2,
                "categories" => "unit",
                "status" => "available",
                "image" => null,
            ],

            // --- SPAREPARTS ---
            [
                "name" => "Shimano Deore XT M8100 Rear Derailleur",
                "description" => "12-speed rear derailleur offering fast and precise shifting performance. Perfect for aggressive mountain biking.",
                "price" => 1500000,
                "stock" => 20,
                "categories" => "sparepart",
                "status" => "available",
                "image" => null,
            ],
            [
                "name" => "Maxxis Minion DHF Tire 29x2.5",
                "description" => "The standard for aggressive all-mountain and enduro riding. Featuring EXO protection and 3C MaxxTerra compound.",
                "price" => 850000,
                "stock" => 42,
                "categories" => "sparepart",
                "status" => "available",
                "image" => null,
            ],
            [
                "name" => "RockShox Recon Silver RL Fork",
                "description" => "Air spring suspension fork with Motion Control damping offering reliable performance and plush feel.",
                "price" => 4200000,
                "stock" => 12,
                "categories" => "sparepart",
                "status" => "available",
                "image" => null,
            ],
            [
                "name" => "SRAM GX Eagle 12-Speed Cassette",
                "description" => "10-52T wide range cassette providing a 520% gear range. Perfect for steep climbs and high-speed descents.",
                "price" => 2800000,
                "stock" => 18,
                "categories" => "sparepart",
                "status" => "available",
                "image" => null,
            ],
            [
                "name" => "Fox 36 Factory GRIP2 Fork",
                "description" => "The undisputed all-mountain champion fork. Featuring Kashima coating and highly tunable GRIP2 damper.",
                "price" => 15500000,
                "stock" => 4,
                "categories" => "sparepart",
                "status" => "available",
                "image" => null,
            ],
            [
                "name" => "Shimano XTR M9120 4-Piston Brakeset",
                "description" => "Top-tier hydraulic disc brakes delivering uncompromised stopping power for enduro and downhill riders.",
                "price" => 8200000,
                "stock" => 6,
                "categories" => "sparepart",
                "status" => "available",
                "image" => null,
            ],
            [
                "name" => "Crankbrothers Stamp 7 Flat Pedals",
                "description" => "Premium flat pedals with optimal size interface. Forged aluminum body with 10 adjustable pins per side.",
                "price" => 1850000,
                "stock" => 25,
                "categories" => "sparepart",
                "status" => "available",
                "image" => null,
            ],
            [
                "name" => "Ergon GA2 Grips",
                "description" => "Excellent tactile feel. Super-soft, UV stable rubber compound exclusively manufactured in Germany.",
                "price" => 450000,
                "stock" => 55,
                "categories" => "sparepart",
                "status" => "available",
                "image" => null,
            ],
            [
                "name" => "Race Face Chester Handlebar",
                "description" => "Tough, 35mm aluminum handlebar built to withstand severe abuse on the roughest gravity trails.",
                "price" => 650000,
                "stock" => 14,
                "categories" => "sparepart",
                "status" => "available",
                "image" => null,
            ],
            [
                "name" => "RockShox Reverb Stealth Dropper Post",
                "description" => "Internally routed dropper seatpost featuring completely redesigned internals for a smoother drop.",
                "price" => 5500000,
                "stock" => 8,
                "categories" => "sparepart",
                "status" => "available",
                "image" => null,
            ],
            
            // --- EQUIPMENT ---
            [
                "name" => "Muc-Off Nano Tech Bike Cleaner 1L",
                "description" => "Advanced nano-technology cleaning fluid that cuts through dirt, oil and grime leaving your bike shining.",
                "price" => 250000,
                "stock" => 100,
                "categories" => "equipment",
                "status" => "available",
                "image" => null,
            ],
            [
                "name" => "Giro Fixture MIPS Helmet",
                "description" => "Confident mountain bike style and breezy ventilation combine in a compact design that complements nearly any ride.",
                "price" => 1200000,
                "stock" => 25,
                "categories" => "equipment",
                "status" => "available",
                "image" => null,
            ],
            [
                "name" => "Fox Racing Defend Gloves",
                "description" => "A perfect mix of lightweight top hand material and a minimal, yet extremely durable palm.",
                "price" => 550000,
                "stock" => 30,
                "categories" => "equipment",
                "status" => "available",
                "image" => null,
            ],
            [
                "name" => "Park Tool PCS-10.3 Repair Stand",
                "description" => "Professional quality mechanic's repair stand perfectly equipped for home maintenance and tuning.",
                "price" => 3500000,
                "stock" => 12,
                "categories" => "equipment",
                "status" => "available",
                "image" => null,
            ]
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
