<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReceiptDetailSeeder extends Seeder
{
    public function run()
    {
        DB::table('receipt_details')->insert([
            ['receipt_id' => 1, 'book_id' => 5, 'quantity' => 10, 'importPrice' => 50000, 'created_at' => now(), 'updated_at' => now()],
            ['receipt_id' => 2, 'book_id' => 1, 'quantity' => 10, 'importPrice' => 200000, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
