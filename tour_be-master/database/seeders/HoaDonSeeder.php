<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HoaDonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('hoa_dons')->delete();

        DB::table('hoa_dons')->truncate();

        DB::table('hoa_dons')->insert([
            [
                'ma_hoa_don' => 'HD001',
                'id_khach_hang' => 1,
                'tong_tien' => 9050000,
                'so_luong_nguoi_lon' => 2,
                'so_luong_tre_em' => 1,
                'tinh_trang' => 1,
            ],
            [
                'ma_hoa_don' => 'HD002',
                'id_khach_hang' => 2,
                'tong_tien' => 6290000,
                'so_luong_nguoi_lon' => 1,
                'so_luong_tre_em' => 0,
                'tinh_trang' => 1,
            ],
            [
                'ma_hoa_don' => 'HD003',
                'id_khach_hang' => 3,
                'tong_tien' => 8790000,
                'so_luong_nguoi_lon' => 2,
                'so_luong_tre_em' => 2,
                'tinh_trang' => 2,
            ],
            [
                'ma_hoa_don' => 'HD004',
                'id_khach_hang' => 4,
                'tong_tien' => 15540000,
                'so_luong_nguoi_lon' => 2,
                'so_luong_tre_em' => 1,
                'tinh_trang' => 1,
            ],
            [
                'ma_hoa_don' => 'HD005',
                'id_khach_hang' => 5,
                'tong_tien' => 5000000,
                'so_luong_nguoi_lon' => 1,
                'so_luong_tre_em' => 0,
                'tinh_trang' => 3,
            ],
        ]);
    }
}
