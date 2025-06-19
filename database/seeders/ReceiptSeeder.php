<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReceiptSeeder extends Seeder
{
    public function run()
    {
        DB::table('receipts')->insert([
            ['date' => '2024-11-20 09:03:38', 'receiver' => 'Thủ thư', 'created_at' => now(), 'updated_at' => now()],
            ['date' => '2024-11-20 09:12:23', 'receiver' => 'Thủ thư', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
