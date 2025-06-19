<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StudentSeeder extends Seeder
{
    public function run()
    {
        DB::table('students')->insert([
            ['name' => 'Nguyễn Văn A', 'class' => 'HG20V7A1', 'student_id' => 'B2104847', 'major' => 'Công nghệ thông tin', 'phone' => '0123456789', 'birthday' => '2002-09-09', 'username' => 'student1', 'password' => Hash::make('123123'), 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
