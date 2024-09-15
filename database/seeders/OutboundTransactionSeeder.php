<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class OutboundTransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Membuat transaksi outbound dummy terkait dekorasi
        $outboundTransactions = [
            [
                'date' => Carbon::now()->subDays(rand(1, 15))->format('Y-m-d'),  // Tanggal acak dalam 15 hari terakhir
                'title' => 'Pembelian Bunga Segar',
                'description' => 'Pembelian bunga segar untuk dekorasi pernikahan di bulan ini.',
                'amount' => 1500000.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'date' => Carbon::now()->subDays(rand(16, 30))->format('Y-m-d'),
                'title' => 'Pengecatan Ulang Dekorasi Kayu',
                'description' => 'Biaya pengecatan ulang dekorasi kayu untuk acara spesial.',
                'amount' => 800000.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'date' => Carbon::now()->subDays(rand(1, 15))->format('Y-m-d'),
                'title' => 'Pembelian Lampu Dekorasi',
                'description' => 'Pembelian lampu dekorasi untuk memperindah acara malam hari.',
                'amount' => 1200000.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'date' => Carbon::now()->subDays(rand(16, 30))->format('Y-m-d'),
                'title' => 'Penyewaan Tanaman Hias',
                'description' => 'Penyewaan tanaman hias untuk dekorasi pelaminan dan pintu masuk.',
                'amount' => 500000.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'date' => Carbon::now()->subDays(rand(1, 15))->format('Y-m-d'),
                'title' => 'Pembelian Kain Latar Belakang',
                'description' => 'Pembelian kain untuk latar belakang panggung dekorasi utama.',
                'amount' => 700000.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'date' => Carbon::now()->subDays(rand(16, 30))->format('Y-m-d'),
                'title' => 'Pembersihan dan Perawatan Alat Dekorasi',
                'description' => 'Biaya pembersihan dan perawatan alat-alat dekorasi setelah acara besar.',
                'amount' => 600000.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'date' => Carbon::now()->subDays(rand(1, 15))->format('Y-m-d'),
                'title' => 'Pembelian Kursi dan Meja Dekorasi Baru',
                'description' => 'Pembelian kursi dan meja tambahan untuk acara besar.',
                'amount' => 2000000.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'date' => Carbon::now()->subDays(rand(16, 30))->format('Y-m-d'),
                'title' => 'Penyewaan Generator Listrik',
                'description' => 'Penyewaan generator listrik untuk memastikan tidak ada pemadaman selama acara.',
                'amount' => 900000.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'date' => Carbon::now()->subDays(rand(1, 15))->format('Y-m-d'),
                'title' => 'Pembuatan Dekorasi Custom',
                'description' => 'Biaya pembuatan dekorasi khusus untuk acara pernikahan tema vintage.',
                'amount' => 1800000.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'date' => Carbon::now()->subDays(rand(16, 30))->format('Y-m-d'),
                'title' => 'Penggantian Karpet Dekorasi',
                'description' => 'Penggantian karpet dekorasi yang rusak setelah digunakan pada acara outdoor.',
                'amount' => 1100000.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        // Insert outbound transactions
        DB::table('outbound_transactions')->insert($outboundTransactions);
    }
}
