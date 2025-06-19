<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('book_categories')->insert([
            ['category_name' => 'Khoa học'],
            ['category_name' => 'Văn học'],
            ['category_name' => 'Sinh học'],
            ['category_name' => 'Kinh tế'],
            ['category_name' => 'Ngoại ngữ'],
            ['category_name' => 'Công nghệ'],
            ['category_name' => 'Đời sống'],
            ['category_name' => 'Truyện'],
        ]);
    }
}
