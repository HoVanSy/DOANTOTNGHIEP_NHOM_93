<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ChucVu extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('chuc_vus')->delete();

        DB::table('chuc_vus')->truncate();

        DB::table('chuc_vus')->insert([
            ['ten_chuc_vu' =>  'Trưởng phòng'],
            ['ten_chuc_vu' =>  'Marketing'],
            ['ten_chuc_vu' =>  'Điều hành tour'],
            ['ten_chuc_vu' =>  'Hướng dẫn viên'],
            ['ten_chuc_vu' =>  'Kế toán '],
        ]);
    }
}
