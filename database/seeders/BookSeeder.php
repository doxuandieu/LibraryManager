<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookSeeder extends Seeder
{
    public function run()
    {
        DB::table('books')->insert([
            ['book_name' => 'Harry Potter and the Sorcerer\'s Stone', 'publish_year' => 1997, 'total_pages' => 309, 'price' => 200000, 'stock' => 18, 'address' => 'KhuA/D1/T1', 'book_type' => 1, 'book_code' => 'HPSS', 'category_id' => 8, 'publisher_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['book_name' => 'A Game of Thrones', 'publish_year' => 1996, 'total_pages' => 694, 'price' => 260000, 'stock' => 10, 'address' => 'KhuB/D1/T1', 'book_type' => 0, 'book_code' => 'AGOT', 'category_id' => 8, 'publisher_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['book_name' => 'The Lord of the Rings', 'publish_year' => 1954, 'total_pages' => 1178, 'price' => 300000, 'stock' => 8, 'address' => 'KhuC/D1/T1', 'book_type' => 1, 'book_code' => 'TLOR', 'category_id' => 8, 'publisher_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['book_name' => 'Chiếc lá cuối cùng', 'publish_year' => 2022, 'total_pages' => 336, 'price' => 150000, 'stock' => 10, 'address' => 'KhuD/D1/T1', 'book_type' => 0, 'book_code' => 'CLCC', 'category_id' => 2, 'publisher_id' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['book_name' => 'Truyện Kiều', 'publish_year' => 2015, 'total_pages' => 160, 'price' => 50000, 'stock' => 20, 'address' => 'KhuE/D1/T1', 'book_type' => 0, 'book_code' => 'TK1', 'category_id' => 2, 'publisher_id' => 4, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
