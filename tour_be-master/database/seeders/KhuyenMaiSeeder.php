<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KhuyenMaiSeeder extends Seeder
{
    public function run()
    {
        DB::table('khuyen_mais')->insert([
            [
                'ma_code'            => 'VIVU2026',
                'loai'               => 1, // Giảm 10%
                'gia_tri'            => 10,
                'don_hang_toi_thieu' => 1000000,
                'ngay_ket_thuc'      => '2026-12-31',
                'tinh_trang'         => 1,
            ],
            [
                'ma_code'            => 'CHAOHE',
                'loai'               => 2, // Giảm 200.000đ
                'gia_tri'            => 200000,
                'don_hang_toi_thieu' => 500000,
                'ngay_ket_thuc'      => '2026-08-31',
                'tinh_trang'         => 1,
            ],
            [
                'ma_code'            => 'LUXURY50',
                'loai'               => 1, // Giảm 50% cho đơn lớn
                'gia_tri'            => 50,
                'don_hang_toi_thieu' => 10000000,
                'ngay_ket_thuc'      => '2026-12-31',
                'tinh_trang'         => 1,
            ],
            [
                'ma_code'            => 'HET_HAN',
                'loai'               => 2, 
                'gia_tri'            => 50000,
                'don_hang_toi_thieu' => 0,
                'ngay_ket_thuc'      => '2025-01-01', // Mã này để test lỗi hết hạn
                'tinh_trang'         => 1,
            ],
        ]);
    }
}