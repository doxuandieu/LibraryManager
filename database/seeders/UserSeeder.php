<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(
            [
                'name' => 'Nguyễn Văn An',
                'email' => 'nva@ctu.edu.vn',
                'phone' => '0123456789',
                'password' => Hash::make('123'),
                'status' => true,
                'created_at' => now(),
                'updated_at' => now()
            ]
        );
    }
}
