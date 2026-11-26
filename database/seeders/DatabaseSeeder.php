<?php

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\KnowledgeArticle;
use App\Models\Payment;
use App\Models\Post;
use App\Models\Product;
use App\Models\Setting;
use App\Models\User;
use App\Models\WorkOrder;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        foreach (['admin', 'manager', 'staff'] as $role) {
            Role::findOrCreate($role);
        }

        $admin = User::query()->updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'GridForge Admin',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'phone' => '(303) 555-0101',
            ]
        );
        $admin->assignRole('admin');

        $manager = User::query()->updateOrCreate(
            ['email' => 'manager@gridforgegarage.com'],
            [
                'name' => 'Maya Ortega',
                'password' => Hash::make('password'),
                'role' => 'manager',
                'phone' => '(303) 555-0102',
            ]
        );
        $manager->assignRole('manager');

        $staff = User::query()->updateOrCreate(
            ['email' => 'staff@gridforgegarage.com'],
            [
                'name' => 'Jake Reynolds',
                'password' => Hash::make('password'),
                'role' => 'staff',
                'phone' => '(303) 555-0103',
            ]
        );
        $staff->assignRole('staff');

        $settings = [
            'company_name' => 'GridForge Garage Systems',
            'tagline' => 'Engineered garage storage for American homes',
            'phone' => '(303) 555-0147',
            'email' => 'hello@gridforgegarage.com',
            'address' => '2840 Blake Street, Denver, CO 80205',
            'whatsapp' => '13035550147',
        ];
        foreach ($settings as $key => $value) {
            Setting::setValue($key, $value);
        }

        $products = [
            ['name' => 'Steel Track Rail 48"', 'sku' => 'GF-TRK-48', 'category' => 'slatwall', 'price' => 42.00, 'cost' => 18.00, 'stock_qty' => 120],
            ['name' => 'Slatwall Panel 4x8', 'sku' => 'GF-SLT-48', 'category' => 'slatwall', 'price' => 89.00, 'cost' => 41.00, 'stock_qty' => 48],
            ['name' => 'Overhead Rack 4x8 600lb', 'sku' => 'GF-OH-48', 'category' => 'overhead', 'price' => 329.00, 'cost' => 180.00, 'stock_qty' => 22],
            ['name' => 'Tall Locking Cabinet', 'sku' => 'GF-CAB-TL', 'category' => 'cabinets', 'price' => 549.00, 'cost' => 290.00, 'stock_qty' => 14],
            ['name' => 'Heavy Duty Bike Hook', 'sku' => 'GF-HK-BK', 'category' => 'hooks', 'price' => 24.00, 'cost' => 8.50, 'stock_qty' => 200],
            ['name' => 'Wire Basket Deep', 'sku' => 'GF-BSK-DP', 'category' => 'hooks', 'price' => 36.00, 'cost' => 14.00, 'stock_qty' => 90],
            ['name' => 'Workbench Top 8ft', 'sku' => 'GF-WB-8', 'category' => 'cabinets', 'price' => 410.00, 'cost' => 220.00, 'stock_qty' => 9],
            ['name' => 'Floor Transition Strip', 'sku' => 'GF-FL-TR', 'category' => 'flooring', 'price' => 18.00, 'cost' => 6.00, 'stock_qty' => 150],
        ];
        foreach ($products as $product) {
            Product::query()->updateOrCreate(['sku' => $product['sku']], $product + [
                'description' => $product['name'].' — GridForge inventory for Denver installs.',
                'is_active' => true,
                'unit' => 'each',
            ]);
        }

        $customers = [
            ['name' => 'Allison Crowe', 'email' => 'allison@example.com', 'phone' => '(720) 555-2211', 'city' => 'Denver', 'state' => 'CO', 'zip' => '80205', 'address' => '118 Race Street'],
            ['name' => 'Brian Holt', 'email' => 'brian@example.com', 'phone' => '(303) 555-8832', 'city' => 'Lakewood', 'state' => 'CO', 'zip' => '80226', 'address' => '940 Reed Street'],
            ['name' => 'Priya Shah', 'email' => 'priya@example.com', 'phone' => '(720) 555-4410', 'city' => 'Highlands Ranch', 'state' => 'CO', 'zip' => '80126', 'address' => '4022 Red Mesa Way'],
            ['name' => 'Noah Keller', 'email' => 'noah@example.com', 'phone' => '(303) 555-7720', 'city' => 'Boulder', 'state' => 'CO', 'zip' => '80302', 'address' => '765 Pine Street'],
        ];
        $customerModels = collect($customers)->map(fn ($c) => Customer::query()->updateOrCreate(['email' => $c['email']], $c));

        $jobDefs = [
            ['job_number' => 'GF-2401', 'title' => 'Two-car wall track + bike wall', 'status' => 'completed', 'estimated_value' => 5200, 'actual_value' => 5450],
            ['job_number' => 'GF-2402', 'title' => 'Overhead rack install — Lakewood', 'status' => 'in_progress', 'estimated_value' => 2100, 'actual_value' => 0],
            ['job_number' => 'GF-2403', 'title' => 'Cabinet run + workbench', 'status' => 'scheduled', 'estimated_value' => 7800, 'actual_value' => 0],
            ['job_number' => 'GF-2404', 'title' => 'Full garage makeover consult', 'status' => 'quoted', 'estimated_value' => 11500, 'actual_value' => 0],
            ['job_number' => 'GF-2405', 'title' => 'Slatwall refresh — Boulder', 'status' => 'lead', 'estimated_value' => 1800, 'actual_value' => 0],
        ];

        $workOrders = collect($jobDefs)->map(function ($job, $i) use ($customerModels, $staff, $manager) {
            return WorkOrder::query()->updateOrCreate(
                ['job_number' => $job['job_number']],
                $job + [
                    'customer_id' => $customerModels[$i % $customerModels->count()]->id,
                    'assigned_to' => $i % 2 === 0 ? $staff->id : $manager->id,
                    'description' => 'Demo garage organization project for GridForge ERP.',
                    'priority' => $i === 1 ? 'high' : 'normal',
                    'scheduled_start' => now()->subDays(10 - $i)->toDateString(),
                    'scheduled_end' => now()->subDays(8 - $i)->toDateString(),
                    'address' => $customerModels[$i % $customerModels->count()]->address.', '.$customerModels[$i % $customerModels->count()]->city,
                ]
            );
        });

        $invoice = Invoice::query()->updateOrCreate(
            ['invoice_number' => 'INV-1001'],
            [
                'customer_id' => $customerModels[0]->id,
                'work_order_id' => $workOrders[0]->id,
                'issue_date' => now()->subDays(12)->toDateString(),
                'due_date' => now()->subDays(2)->toDateString(),
                'status' => 'paid',
                'subtotal' => 5000,
                'tax' => 450,
                'total' => 5450,
                'amount_paid' => 5450,
                'notes' => 'Paid in full after install walkthrough.',
            ]
        );

        Payment::query()->updateOrCreate(
            ['reference' => 'PAY-1001'],
            [
                'invoice_id' => $invoice->id,
                'amount' => 5450,
                'method' => 'card',
                'paid_at' => now()->subDays(3)->toDateString(),
                'notes' => 'Final payment',
            ]
        );

        Invoice::query()->updateOrCreate(
            ['invoice_number' => 'INV-1002'],
            [
                'customer_id' => $customerModels[1]->id,
                'work_order_id' => $workOrders[1]->id,
                'issue_date' => now()->subDays(4)->toDateString(),
                'due_date' => now()->addDays(10)->toDateString(),
                'status' => 'sent',
                'subtotal' => 1900,
                'tax' => 171,
                'total' => 2071,
                'amount_paid' => 500,
                'notes' => 'Deposit received.',
            ]
        );

        Appointment::query()->updateOrCreate(
            ['title' => 'Measure — Highlands Ranch', 'starts_at' => now()->addDay()->setTime(8, 30)],
            [
                'customer_id' => $customerModels[2]->id,
                'work_order_id' => $workOrders[2]->id,
                'user_id' => $manager->id,
                'ends_at' => now()->addDay()->setTime(10, 0),
                'status' => 'confirmed',
                'location' => '4022 Red Mesa Way, Highlands Ranch',
                'notes' => 'Bring laser measure and load chart.',
            ]
        );

        Appointment::query()->updateOrCreate(
            ['title' => 'Overhead rack install — Lakewood', 'starts_at' => now()->addDay()->setTime(11, 0)],
            [
                'customer_id' => $customerModels[1]->id,
                'work_order_id' => $workOrders[1]->id,
                'user_id' => $staff->id,
                'ends_at' => now()->addDay()->setTime(14, 0),
                'status' => 'scheduled',
                'location' => '940 Reed Street, Lakewood',
            ]
        );

        $posts = [
            [
                'title' => 'How to Plan Overhead Garage Storage Without Hitting the Door',
                'excerpt' => 'Clearances, opener tracks, and load ratings every Denver homeowner should know.',
                'cover_image' => 'https://images.unsplash.com/photo-1581092918056-0c4c3acd3789?auto=format&fit=crop&w=1200&q=80',
                'body' => "Overhead racks fail when they ignore garage door geometry. Measure opener headroom, track arcs, and vehicle roof heights before you buy.\n\nGridForge marks a safe envelope on site, then anchors into joists with rated lag hardware. Keep seasonal bins toward the rear wall and leave a service gap near the opener motor.",
            ],
            [
                'title' => 'Wall Tracks vs Slatwall: Which Fits a Two-Car Garage?',
                'excerpt' => 'A practical comparison for bikes, yard tools, and sports gear.',
                'cover_image' => 'https://images.unsplash.com/photo-1553413077-190dd305871c?auto=format&fit=crop&w=1200&q=80',
                'body' => "Track systems shine when you want discrete rails and heavy hooks. Slatwall covers broad wall areas and looks finished next to cabinetry.\n\nMany GridForge projects mix both: slatwall behind the sports zone, steel tracks for ladders and wheeled tools.",
            ],
            [
                'title' => 'Cabinets That Survive Colorado Temperature Swings',
                'excerpt' => 'Moisture-aware boxes and finishes for unconditioned garages.',
                'cover_image' => 'https://images.unsplash.com/photo-1615874959474-d609969a20ed?auto=format&fit=crop&w=1200&q=80',
                'body' => "Unconditioned garages expand and contract. We specify moisture-resistant cores, quality hinges, and finishes that handle dry winters and summer heat.\n\nLocking tall cabinets keep chemicals away from kids while a sealed workbench top handles oil and paint.",
            ],
        ];
        foreach ($posts as $i => $post) {
            Post::query()->updateOrCreate(
                ['slug' => Str::slug($post['title'])],
                $post + [
                    'is_published' => true,
                    'published_at' => now()->subDays(20 - $i * 4),
                    'author_id' => $admin->id,
                ]
            );
        }

        $articles = [
            [
                'title' => 'Prep Checklist Before Install Day',
                'category' => 'guides',
                'summary' => 'What homeowners should clear and label before the crew arrives.',
                'body' => "1. Park vehicles outside.\n2. Clear a 4-foot path along install walls.\n3. Label keep / donate / trash piles.\n4. Confirm Wi-Fi for opener apps if relocating sensors.\n5. Note any previously patched drywall.",
            ],
            [
                'title' => 'Common Issue: Rack Feels Soft After Load',
                'category' => 'issues',
                'summary' => 'Usually joist miss or uneven load — here is how we diagnose.',
                'body' => "Softness often means fasteners missed solid lumber or weight concentrated at one corner. We redistribute bins, verify lag engagement, and add sistered blocking when needed.",
            ],
            [
                'title' => 'Admin Manual: Creating a Job in Filament',
                'category' => 'admin',
                'summary' => 'Step-by-step for GridForge staff using the ERP.',
                'body' => "1. Open Admin → Jobs → New.\n2. Assign customer and staff.\n3. Set status to Lead or Quoted.\n4. Add estimated value and address.\n5. Link appointments and invoices once approved.",
            ],
            [
                'title' => 'Troubleshooting: Invoice Balance Not Updating',
                'category' => 'troubleshooting',
                'summary' => 'Payments must be linked to the invoice record.',
                'body' => "Create a Payment against the invoice, then set amount_paid to match sum of payments. Status should move to Partial or Paid. If AI Studio is offline, demo replies still work without API keys.",
            ],
            [
                'title' => 'Guide: Zoning a Two-Car Garage',
                'category' => 'guides',
                'summary' => 'Vehicle lane, sports wall, seasonal overhead, workbench corner.',
                'body' => "Keep the center lane clear for cars. Put daily-use items between waist and shoulder height. Send rarely used bulk overhead. Chemicals go in locking cabinets near the workbench, never on open floor shelves.",
            ],
        ];
        foreach ($articles as $i => $article) {
            KnowledgeArticle::query()->updateOrCreate(
                ['slug' => Str::slug($article['title'])],
                $article + [
                    'sort_order' => $i + 1,
                    'is_published' => true,
                ]
            );
        }
    }
}
