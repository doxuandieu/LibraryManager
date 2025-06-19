<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class BorrowBookSeeder extends Seeder
{
    public function run()
    {
        DB::table('borrow_books')->insert([
            ['student_code' => '00001', 'student_name' => 'Nguyễn Văn A', 'quantity' => 1, 'beginDate' => '2024-11-16 00:00:00', 'endDate' => '2024-11-19 00:00:00', 'created_at' => now(), 'updated_at' => now(), 'status' => 1],
            ['student_code' => '00002', 'student_name' => 'Nguyễn Văn B', 'quantity' => 1, 'beginDate' => '2024-11-17 00:00:00', 'endDate' => '2024-11-19 00:00:00', 'created_at' => now(), 'updated_at' => now(), 'status' => 1],
            ['student_code' => '00004', 'student_name' => 'Nguyễn Văn D', 'quantity' => 2, 'beginDate' => '2024-11-18 00:00:00', 'endDate' => '2024-11-20 00:00:00', 'created_at' => now(), 'updated_at' => now(), 'status' => 0],
        ]);
    }
}
