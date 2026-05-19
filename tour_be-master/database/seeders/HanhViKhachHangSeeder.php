<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Carbon\Carbon;

class HanhViKhachHangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('hanh_vi_khach_hangs')->truncate();

        $faker = Faker::create();

        $danh_sach_hanh_vi = [
            ['loai' => 'view', 'diem' => 1],
            ['loai' => 'favorite', 'diem' => 3],
            ['loai' => 'book', 'diem' => 5],
        ];

        for ($i = 0; $i < 100; $i++) {
            $hanh_vi = $faker->randomElement($danh_sach_hanh_vi);

            DB::table('hanh_vi_khach_hangs')->insert([
                'id_khach_hang' => $faker->numberBetween(1, 17), 
                
                'id_tour'       => $faker->numberBetween(1, 10), 
                
                'loai_hanh_vi'  => $hanh_vi['loai'],
                'diem_so'       => $hanh_vi['diem'],
                
                'created_at'    => Carbon::now()->subDays(rand(1, 30))->subHours(rand(1, 24)),
                'updated_at'    => Carbon::now()->subDays(rand(1, 30)),
            ]);
        }
    }
}