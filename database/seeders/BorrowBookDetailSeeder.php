<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BorrowBookDetailSeeder extends Seeder
{
    public function run()
    {
        DB::table('borrow_book_details')->insert([
            ['borrow_book_id' => 1, 'book_id' => 1, 'quantity' => 1, 'created_at' => '2024-11-20 02:04:46', 'updated_at' => '2024-11-20 02:04:46'],
            ['borrow_book_id' => 2, 'book_id' => 3, 'quantity' => 1, 'created_at' => '2024-11-20 02:05:52', 'updated_at' => '2024-11-20 02:05:52'],
            ['borrow_book_id' => 3, 'book_id' => 3, 'quantity' => 1, 'created_at' => '2024-11-20 02:09:23', 'updated_at' => '2024-11-20 02:09:23'],
            ['borrow_book_id' => 3, 'book_id' => 1, 'quantity' => 1, 'created_at' => '2024-11-20 02:09:23', 'updated_at' => '2024-11-20 02:09:23'],
        ]);
    }
}
