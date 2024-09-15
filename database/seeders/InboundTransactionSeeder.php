<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class InboundTransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Membuat 10 transaksi dummy secara manual

        $inboundTransactions = [
            [
                'order_id' => 1,
                'date' => Carbon::now()->addDays(rand(30, 60))->format('Y-m-d'),  // Tanggal acak antara 1-2 bulan ke depan
                'amount' => DB::table('orders')->where('id', 1)->value('total') / 2,  // 50% dari total order sebagai DP
                'status' => 'DP',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'order_id' => 1,
                'date' => Carbon::now()->addDays(rand(61, 90))->format('Y-m-d'),  // Tanggal acak antara 2-3 bulan ke depan
                'amount' => DB::table('orders')->where('id', 1)->value('total') / 2,  // Sisa 50% dari total order
                'status' => 'Lunas',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'order_id' => 2,
                'date' => Carbon::now()->addDays(rand(30, 60))->format('Y-m-d'),
                'amount' => DB::table('orders')->where('id', 2)->value('total') / 2,
                'status' => 'DP',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'order_id' => 2,
                'date' => Carbon::now()->addDays(rand(61, 90))->format('Y-m-d'),
                'amount' => DB::table('orders')->where('id', 2)->value('total') / 2,
                'status' => 'Lunas',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'order_id' => 3,
                'date' => Carbon::now()->addDays(rand(30, 60))->format('Y-m-d'),
                'amount' => DB::table('orders')->where('id', 3)->value('total') / 2,
                'status' => 'DP',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'order_id' => 3,
                'date' => Carbon::now()->addDays(rand(61, 90))->format('Y-m-d'),
                'amount' => DB::table('orders')->where('id', 3)->value('total') / 2,
                'status' => 'Lunas',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'order_id' => 4,
                'date' => Carbon::now()->addDays(rand(30, 60))->format('Y-m-d'),
                'amount' => DB::table('orders')->where('id', 4)->value('total') / 2,
                'status' => 'DP',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'order_id' => 4,
                'date' => Carbon::now()->addDays(rand(61, 90))->format('Y-m-d'),
                'amount' => DB::table('orders')->where('id', 4)->value('total') / 2,
                'status' => 'Lunas',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'order_id' => 5,
                'date' => Carbon::now()->addDays(rand(30, 60))->format('Y-m-d'),
                'amount' => DB::table('orders')->where('id', 5)->value('total') / 2,
                'status' => 'DP',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'order_id' => 5,
                'date' => Carbon::now()->addDays(rand(61, 90))->format('Y-m-d'),
                'amount' => DB::table('orders')->where('id', 5)->value('total') / 2,
                'status' => 'Lunas',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        // Insert inbound transactions
        DB::table('inbound_transactions')->insert($inboundTransactions);
    }
}
