<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PublisherSeeder extends Seeder
{
    public function run()
    {
        DB::table('publishers')->insert([
            ['name' => 'Giáo dục Việt Nam', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Trẻ', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Kim Đồng', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Văn Học', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
