<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AuthorBookSeeder extends Seeder
{
    public function run()
    {
        DB::table('authors_books')->insert([
            ['book_id' => 1, 'author_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['book_id' => 2, 'author_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['book_id' => 3, 'author_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['book_id' => 4, 'author_id' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['book_id' => 5, 'author_id' => 5, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
