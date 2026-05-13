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
<<<<<<< HEAD
            [
                'ma_hoa_don' => 'HD001',
                'id_khach_hang' => 1,
                'tong_tien' => 9050000,
=======
            // 5 tháng trước - doanh thu thấp ban đầu
            [
                'ma_hoa_don' => 'HD001',
                'id_khach_hang' => 1,
                'tong_tien' => 8500000,
>>>>>>> master
                'so_luong_nguoi_lon' => 2,
                'so_luong_tre_em' => 1,
                'tinh_trang' => 1,
                'created_at' => now()->subMonths(5),
            ],
            [
                'ma_hoa_don' => 'HD002',
                'id_khach_hang' => 2,
<<<<<<< HEAD
                'tong_tien' => 6290000,
                'so_luong_nguoi_lon' => 1,
                'so_luong_tre_em' => 0,
                'tinh_trang' => 1,
                'created_at' => now()->subMonths(4),
            ],
            [
                'ma_hoa_don' => 'HD003',
                'id_khach_hang' => 3,
                'tong_tien' => 8790000,
                'so_luong_nguoi_lon' => 2,
                'so_luong_tre_em' => 2,
                'tinh_trang' => 2,
                'created_at' => now()->subMonths(3),
            ],
            [
                'ma_hoa_don' => 'HD004',
                'id_khach_hang' => 4,
                'tong_tien' => 15540000,
=======
                'tong_tien' => 6200000,
                'so_luong_nguoi_lon' => 1,
                'so_luong_tre_em' => 0,
                'tinh_trang' => 1,
                'created_at' => now()->subMonths(5),
            ],
            // 4 tháng trước - tăng trưởng
            [
                'ma_hoa_don' => 'HD003',
                'id_khach_hang' => 3,
                'tong_tien' => 9500000,
                'so_luong_nguoi_lon' => 2,
                'so_luong_tre_em' => 1,
                'tinh_trang' => 1,
                'created_at' => now()->subMonths(4),
            ],
            [
                'ma_hoa_don' => 'HD004',
                'id_khach_hang' => 4,
                'tong_tien' => 12500000,
                'so_luong_nguoi_lon' => 3,
                'so_luong_tre_em' => 1,
                'tinh_trang' => 1,
                'created_at' => now()->subMonths(4),
            ],
            // 3 tháng trước - tiếp tục tăng
            [
                'ma_hoa_don' => 'HD005',
                'id_khach_hang' => 5,
                'tong_tien' => 7800000,
                'so_luong_nguoi_lon' => 2,
                'so_luong_tre_em' => 0,
                'tinh_trang' => 1,
                'created_at' => now()->subMonths(3),
            ],
            [
                'ma_hoa_don' => 'HD006',
                'id_khach_hang' => 6,
                'tong_tien' => 15600000,
                'so_luong_nguoi_lon' => 4,
                'so_luong_tre_em' => 2,
                'tinh_trang' => 1,
                'created_at' => now()->subMonths(3),
            ],
            // 2 tháng trước - tăng mạnh
            [
                'ma_hoa_don' => 'HD007',
                'id_khach_hang' => 7,
                'tong_tien' => 10500000,
>>>>>>> master
                'so_luong_nguoi_lon' => 2,
                'so_luong_tre_em' => 1,
                'tinh_trang' => 1,
                'created_at' => now()->subMonths(2),
            ],
            [
<<<<<<< HEAD
                'ma_hoa_don' => 'HD005',
                'id_khach_hang' => 5,
                'tong_tien' => 5000000,
                'so_luong_nguoi_lon' => 1,
                'so_luong_tre_em' => 0,
                'tinh_trang' => 3,
=======
                'ma_hoa_don' => 'HD008',
                'id_khach_hang' => 8,
                'tong_tien' => 18900000,
                'so_luong_nguoi_lon' => 5,
                'so_luong_tre_em' => 1,
                'tinh_trang' => 1,
                'created_at' => now()->subMonths(2),
            ],
            [
                'ma_hoa_don' => 'HD009',
                'id_khach_hang' => 9,
                'tong_tien' => 6400000,
                'so_luong_nguoi_lon' => 1,
                'so_luong_tre_em' => 1,
                'tinh_trang' => 2, // Hủy
                'created_at' => now()->subMonths(2),
            ],
            // 1 tháng trước - cao nhất
            [
                'ma_hoa_don' => 'HD010',
                'id_khach_hang' => 10,
                'tong_tien' => 22000000,
                'so_luong_nguoi_lon' => 4,
                'so_luong_tre_em' => 2,
                'tinh_trang' => 1,
                'created_at' => now()->subMonths(1),
            ],
            [
                'ma_hoa_don' => 'HD011',
                'id_khach_hang' => 11,
                'tong_tien' => 8700000,
                'so_luong_nguoi_lon' => 2,
                'so_luong_tre_em' => 0,
                'tinh_trang' => 1,
                'created_at' => now()->subMonths(1),
            ],
            [
                'ma_hoa_don' => 'HD012',
                'id_khach_hang' => 12,
                'tong_tien' => 5100000,
                'so_luong_nguoi_lon' => 1,
                'so_luong_tre_em' => 0,
                'tinh_trang' => 3, // Chưa thanh toán
>>>>>>> master
                'created_at' => now()->subMonths(1),
            ],
        ]);
    }
}
