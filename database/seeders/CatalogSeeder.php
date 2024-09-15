<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CatalogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('catalogs')->insert([
            [
                'name' => 'Dekorasi Lamaran',
                'category' => 'Decoration',
                'description' => 'Dekorasi Lamaran',
                'image' => json_encode(['public/storage/catalogs/01J6Q0NB8BTAGBXGS5JCZG5WS4.jpg']),
                'price' => 1000000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Dekorasi Pernikahan 8 Meter',
                'category' => 'Decoration',
                'description' => 'Dekorasi Pernikahan 8 Meter',
                'image' => json_encode(['catalogs/01J6A00EXVGWXCGTM6WA9STV7.jpg']),
                'price' => 2000000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Dekorasi Pernikahan 10 Meter',
                'category' => 'Decoration',
                'description' => 'Dekorasi Pernikahan 10 Meter',

                'image' => json_encode(['catalogs/01J6A00EXVGWXCGTM6WA9STV7.jpg']),
                'price' => 2500000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Dekorasi Pernikahan 12 Meter',
                'category' => 'Decoration',
                'description' => 'Dekorasi Pernikahan 12 Meter',

                'image' => json_encode(['catalogs/01J6A00EXVGWXCGTM6WA9STV7.jpg']),
                'price' => 3000000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Dekorasi Pernikahan 15 Meter',
                'category' => 'Decoration',
                'description' => 'Dekorasi Pernikahan 15 Meter',

                'image' => json_encode(['catalogs/01J6A00EXVGWXCGTM6WA9STV7.jpg']),
                'price' => 3500000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Karpet Jalan',
                'category' => 'Additional Item',
                'description' => 'Karpet Jalan Per Meter',
                'image' => json_encode(['catalogs/01J6A00EXVGWXCGTM6WA9STV7.jpg']),
                'price' => 10000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Kursi Tiffany',
                'category' => 'Additional Item',
                'description' => 'Kursi Tiffany',
                'image' => json_encode(['catalogs/01J6A00EXVGWXCGTM6WA9STV7.jpg']),
                'price' => 20000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Ac Portable',
                'category' => 'Additional Item',
                'description' => 'Ac Portable',
                'image' => json_encode(['catalogs/01J6A00EXVGWXCGTM6WA9STV7.jpg']),
                'price' => 150000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Blower',
                'category' => 'Additional Item',
                'description' => 'Blower',
                'image' => json_encode(['catalogs/01J6A00EXVGWXCGTM6WA9STV7.jpg']),
                'price' => 20000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Kain Backdrop',
                'category' => 'Additional Item',
                'description' => 'Kain Backdrop Per Meter',
                'image' => json_encode(['catalogs/01J6A00EXVGWXCGTM6WA9STV7.jpg']),
                'price' => 20000,
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ]);
    }
}
