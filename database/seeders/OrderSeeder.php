<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $orders = [
            [
                'name' => 'Ahmad Setiawan',
                'telephone' => '08123456789',
                'address' => 'Jl. Sunan Giri No. 1, Jurangombo Selatan, Kota Magelang 56123',
                'marital_address' => 'Jl. Melati No. 5, Magelang Utara, Kota Magelang 56115',
                'date' => Carbon::now()->addDays(rand(1, 30))->format('Y-m-d'), // Tanggal acak dalam 1 bulan terakhir
                'total' => 0,  // Akan diupdate setelah insert order items
                'discount' => 0,
                'grand_total' => 0,  // Akan diupdate setelah insert order items
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Siti Nurhaliza',
                'telephone' => '08123456780',
                'address' => 'Jl. Ksatrian No. 2, Rejowinangun Selatan, Kota Magelang 56124',
                'marital_address' => 'Jl. Pahlawan No. 10, Mertoyudan, Kota Magelang 56172',
                'date' => Carbon::now()->addDays(rand(1, 30))->format('Y-m-d'),
                'total' => 0,
                'discount' => 0,
                'grand_total' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Budi Santoso',
                'telephone' => '08123456781',
                'address' => 'Jl. Diponegoro No. 3, Potrobangsan, Kota Magelang 56116',
                'marital_address' => 'Jl. Ahmad Yani No. 8, Tidar Selatan, Kota Magelang 56123',
                'date' => Carbon::now()->addDays(rand(1, 30))->format('Y-m-d'),
                'total' => 0,
                'discount' => 0,
                'grand_total' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Ratna Dewi',
                'telephone' => '08123456782',
                'address' => 'Jl. Merapi No. 4, Tidar Utara, Kota Magelang 56125',
                'marital_address' => 'Jl. Tentara Pelajar No. 12, Magersari, Kota Magelang 56117',
                'date' => Carbon::now()->addDays(rand(1, 30))->format('Y-m-d'),
                'total' => 0,
                'discount' => 0,
                'grand_total' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Andi Wijaya',
                'telephone' => '08123456783',
                'address' => 'Jl. Kenari No. 5, Kedungsari, Kota Magelang 56126',
                'marital_address' => 'Jl. Cempaka No. 15, Kramat Selatan, Kota Magelang 56118',
                'date' => Carbon::now()->addDays(rand(1, 30))->format('Y-m-d'),
                'total' => 0,
                'discount' => 0,
                'grand_total' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        // Insert orders
        DB::table('orders')->insert($orders);

        // Mengambil ID order yang telah diinsert untuk digunakan pada order items
        $orderIds = DB::table('orders')->pluck('id')->toArray();

        // Order Items Seeder
        $orderItems = [
            [
                'order_id' => $orderIds[0],
                'catalog_id' => 1,
                'quantity' => 2,
                'unit_price' => 1000000,
                'total_price' => 1000000 * 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'order_id' => $orderIds[4],
                'catalog_id' => 2,
                'quantity' => 1,
                'unit_price' => 2000000,
                'total_price' => 2000000 * 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'order_id' => $orderIds[1],
                'catalog_id' => 3,
                'quantity' => 3,
                'unit_price' => 2500000,
                'total_price' => 2500000 * 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'order_id' => $orderIds[3],
                'catalog_id' => 4,
                'quantity' => 1,
                'unit_price' => 3000000,
                'total_price' => 3000000 * 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'order_id' => $orderIds[2],
                'catalog_id' => 5,
                'quantity' => 2,
                'unit_price' => 3500000,
                'total_price' => 3500000 * 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'order_id' => $orderIds[2],
                'catalog_id' => 6,
                'quantity' => 3,
                'unit_price' => 10000,
                'total_price' => 10000 * 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'order_id' => $orderIds[3],
                'catalog_id' => 7,
                'quantity' => 4,
                'unit_price' => 20000,
                'total_price' => 20000 * 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'order_id' => $orderIds[1],
                'catalog_id' => 8,
                'quantity' => 1,
                'unit_price' => 150000,
                'total_price' => 150000 * 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'order_id' => $orderIds[4],
                'catalog_id' => 9,
                'quantity' => 2,
                'unit_price' => 50000,
                'total_price' => 50000 * 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'order_id' => $orderIds[0],
                'catalog_id' => 10,
                'quantity' => 1,
                'unit_price' => 20000,
                'total_price' => 20000 * 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        // Insert order items
        DB::table('order_items')->insert($orderItems);

        // Menghitung total untuk setiap order dan memperbarui total dan grand total
        foreach ($orderIds as $orderId) {
            $orderTotal = DB::table('order_items')->where('order_id', $orderId)->sum('total_price');
            DB::table('orders')->where('id', $orderId)->update([
                'total' => $orderTotal,
                'grand_total' => $orderTotal,  // Tanpa diskon untuk contoh ini
            ]);
        }
    }
}
