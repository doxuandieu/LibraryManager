<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AuthorsSeeder extends Seeder
{
    public function run()
    {
        DB::table('authors')->insert([
            ['name' => 'J.K. Rowling', 'birthday' => '1965-07-31', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'George R.R. Martin', 'birthday' => '1948-09-20', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'J.R.R. Tolkien', 'birthday' => '1892-01-03', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'O Henry', 'birthday' => '1766-03-01', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Nguyễn Du', 'birthday' => '1766-01-03', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
