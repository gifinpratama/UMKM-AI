<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UmkmDatabase;
use App\Models\Category;
use App\Models\Product;
use App\Models\Customer;
use App\Models\Transaction;
use App\Models\ActivityLog;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // === ADMIN ===
        User::create([
            'name' => 'Admin UMKM-AI',
            'email' => 'admin@UMKM-AI',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'tenant_id' => null,
            'is_active' => true,
        ]);

        // === SELLER 1: Warung Kopi Nusantara ===
        $tenant1 = 'tenant_' . Str::random(12);
        $seller1 = User::create([
            'name' => 'Budi Santoso',
            'email' => 'seller@UMKM-AI',
            'password' => Hash::make('password'),
            'role' => 'seller',
            'tenant_id' => $tenant1,
            'business_name' => 'Warung Kopi Nusantara',
            'business_type' => 'Makanan & Minuman',
            'phone' => '081234567890',
            'address' => 'Jl. Merdeka No. 10, Jakarta',
            'is_active' => true,
        ]);

        UmkmDatabase::create([
            'user_id' => $seller1->id,
            'tenant_id' => $tenant1,
            'db_name' => 'DB-KOPINUSANTARA',
            'db_description' => 'Database Warung Kopi Nusantara',
            'status' => 'active',
            'created_by' => 1,
        ]);

        // Categories
        $cats1 = [];
        foreach (['Kopi', 'Teh', 'Makanan Ringan', 'Minuman Segar'] as $name) {
            $cats1[] = Category::create([
                'tenant_id' => $tenant1,
                'name' => $name,
                'slug' => Str::slug($name),
            ]);
        }

        // Products
        $products1 = [
            ['name' => 'Kopi Arabika Premium', 'sku' => 'KAP-001', 'category_id' => $cats1[0]->id, 'price' => 25000, 'cost_price' => 12000, 'stock' => 150],
            ['name' => 'Kopi Robusta House Blend', 'sku' => 'KRH-002', 'category_id' => $cats1[0]->id, 'price' => 18000, 'cost_price' => 8000, 'stock' => 200],
            ['name' => 'Es Kopi Susu', 'sku' => 'EKS-003', 'category_id' => $cats1[0]->id, 'price' => 22000, 'cost_price' => 10000, 'stock' => 100],
            ['name' => 'Teh Tarik', 'sku' => 'TT-004', 'category_id' => $cats1[1]->id, 'price' => 15000, 'cost_price' => 5000, 'stock' => 180],
            ['name' => 'Green Tea Latte', 'sku' => 'GTL-005', 'category_id' => $cats1[1]->id, 'price' => 20000, 'cost_price' => 8000, 'stock' => 90],
            ['name' => 'Pisang Goreng Keju', 'sku' => 'PGK-006', 'category_id' => $cats1[2]->id, 'price' => 12000, 'cost_price' => 5000, 'stock' => 60],
            ['name' => 'Roti Bakar Coklat', 'sku' => 'RBC-007', 'category_id' => $cats1[2]->id, 'price' => 15000, 'cost_price' => 6000, 'stock' => 8],
            ['name' => 'Es Jeruk Segar', 'sku' => 'EJS-008', 'category_id' => $cats1[3]->id, 'price' => 10000, 'cost_price' => 3000, 'stock' => 5],
        ];

        $productModels1 = [];
        foreach ($products1 as $p) {
            $p['tenant_id'] = $tenant1;
            $p['is_active'] = true;
            $productModels1[] = Product::create($p);
        }

        // Customers
        $customerNames = ['Andi Wirawan', 'Siti Aminah', 'Rizky Pratama', 'Dewi Lestari', 'Ahmad Fauzi', 'Maya Putri', 'Hendro Gunawan', 'Lina Marlina'];
        $customers1 = [];
        foreach ($customerNames as $cn) {
            $customers1[] = Customer::create([
                'tenant_id' => $tenant1,
                'name' => $cn,
                'email' => Str::slug($cn, '.') . '@gmail.com',
                'phone' => '08' . rand(1000000000, 9999999999),
                'address' => 'Jakarta',
            ]);
        }

        // Transactions (last 60 days)
        $paymentMethods = ['cash', 'transfer', 'ewallet', 'qris'];
        for ($day = 60; $day >= 0; $day--) {
            $numTrx = rand(2, 8);
            for ($t = 0; $t < $numTrx; $t++) {
                $numItems = rand(1, 3);
                $items = [];
                $subtotal = 0;
                for ($i = 0; $i < $numItems; $i++) {
                    $prod = $productModels1[array_rand($productModels1)];
                    $qty = rand(1, 3);
                    $itemTotal = $qty * $prod->price;
                    $items[] = [
                        'product_id' => $prod->id,
                        'name' => $prod->name,
                        'quantity' => $qty,
                        'price' => $prod->price,
                        'subtotal' => $itemTotal,
                    ];
                    $subtotal += $itemTotal;
                }

                $discount = rand(0, 1) ? rand(1000, 5000) : 0;
                $total = $subtotal - $discount;
                $customer = $customers1[array_rand($customers1)];

                Transaction::create([
                    'tenant_id' => $tenant1,
                    'transaction_code' => 'TRX-KOPI-' . now()->subDays($day)->format('Ymd') . '-' . str_pad($t + 1, 4, '0', STR_PAD_LEFT),
                    'customer_id' => $customer->id,
                    'customer_name' => $customer->name,
                    'items' => $items,
                    'subtotal' => $subtotal,
                    'discount' => $discount,
                    'tax' => 0,
                    'total' => $total,
                    'payment_method' => $paymentMethods[array_rand($paymentMethods)],
                    'status' => 'completed',
                    'created_at' => now()->subDays($day)->addHours(rand(7, 21)),
                    'updated_at' => now()->subDays($day)->addHours(rand(7, 21)),
                ]);

                $customer->increment('total_purchases', $total);
                $customer->increment('total_transactions');
                $customer->update(['last_purchase_at' => now()->subDays($day)]);
            }
        }

        // === SELLER 2: Toko Fashion Trendy ===
        $tenant2 = 'tenant_' . Str::random(12);
        $seller2 = User::create([
            'name' => 'Anisa Putri',
            'email' => 'anisa@UMKM-AI',
            'password' => Hash::make('password'),
            'role' => 'seller',
            'tenant_id' => $tenant2,
            'business_name' => 'Trendy Fashion Store',
            'business_type' => 'Fashion',
            'phone' => '087654321098',
            'address' => 'Jl. Sudirman No. 25, Bandung',
            'is_active' => true,
        ]);

        UmkmDatabase::create([
            'user_id' => $seller2->id,
            'tenant_id' => $tenant2,
            'db_name' => 'DB-TRENDYFASHION',
            'db_description' => 'Database Trendy Fashion Store',
            'status' => 'active',
            'created_by' => 1,
        ]);

        $cats2 = [];
        foreach (['Kaos', 'Kemeja', 'Celana', 'Aksesoris'] as $name) {
            $cats2[] = Category::create([
                'tenant_id' => $tenant2,
                'name' => $name,
                'slug' => Str::slug($name),
            ]);
        }

        $fashionProducts = [
            ['name' => 'Kaos Polos Premium', 'sku' => 'KPP-001', 'category_id' => $cats2[0]->id, 'price' => 89000, 'cost_price' => 35000, 'stock' => 200],
            ['name' => 'Kemeja Flanel', 'sku' => 'KF-002', 'category_id' => $cats2[1]->id, 'price' => 150000, 'cost_price' => 60000, 'stock' => 75],
            ['name' => 'Celana Chino Slim', 'sku' => 'CCS-003', 'category_id' => $cats2[2]->id, 'price' => 180000, 'cost_price' => 80000, 'stock' => 50],
            ['name' => 'Topi Baseball', 'sku' => 'TB-004', 'category_id' => $cats2[3]->id, 'price' => 55000, 'cost_price' => 20000, 'stock' => 120],
        ];

        foreach ($fashionProducts as $p) {
            $p['tenant_id'] = $tenant2;
            $p['is_active'] = true;
            Product::create($p);
        }

        // === SELLER 3 ===
        $tenant3 = 'tenant_' . Str::random(12);
        $seller3 = User::create([
            'name' => 'Joko Widodo',
            'email' => 'joko@UMKM-AI',
            'password' => Hash::make('password'),
            'role' => 'seller',
            'tenant_id' => $tenant3,
            'business_name' => 'Toko Elektronik Jaya',
            'business_type' => 'Elektronik',
            'phone' => '089876543210',
            'address' => 'Jl. Gajah Mada No. 5, Surabaya',
            'is_active' => true,
        ]);

        UmkmDatabase::create([
            'user_id' => $seller3->id,
            'tenant_id' => $tenant3,
            'db_name' => 'DB-ELEKTRONIKJAYA',
            'db_description' => 'Database Toko Elektronik Jaya',
            'status' => 'active',
            'created_by' => 1,
        ]);

        // Activity logs
        ActivityLog::create(['user_id' => 1, 'action' => 'system_init', 'description' => 'Sistem UMKM-AI berhasil diinisialisasi', 'created_at' => now()->subDays(5)]);
        ActivityLog::create(['user_id' => 1, 'action' => 'create_seller', 'description' => 'Admin membuat seller: Warung Kopi Nusantara', 'created_at' => now()->subDays(4)]);
        ActivityLog::create(['user_id' => 1, 'action' => 'create_seller', 'description' => 'Admin membuat seller: Trendy Fashion Store', 'created_at' => now()->subDays(3)]);
        ActivityLog::create(['user_id' => 1, 'action' => 'create_seller', 'description' => 'Admin membuat seller: Toko Elektronik Jaya', 'created_at' => now()->subDays(2)]);
    }
}
