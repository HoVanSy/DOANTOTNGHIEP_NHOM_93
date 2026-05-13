<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class YeuCauHuySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('yeu_cau_huys')->delete();

        DB::table('yeu_cau_huys')->truncate();

        DB::table('yeu_cau_huys')->insert([
            [
                'hoa_don_id' => 1,
                'khach_hang_id' => 1,
                'loai_yeu_cau' => 'huy',
                'ly_do' => 'Lý do hủy tour không phù hợp với lịch trình',
                'trang_thai' => 0,
                'ghi_chu' => 'Chờ xác nhận',
                'ngay_khoi_hanh_moi' => null,
            ],
            [
                'hoa_don_id' => 3,
                'khach_hang_id' => 3,
                'loai_yeu_cau' => 'doi_lich',
                'ly_do' => 'Muốn thay đổi ngày khởi hành',
                'trang_thai' => 1,
                'ghi_chu' => 'Đã duyệt',
                'ngay_khoi_hanh_moi' => '2026-05-20',
            ],
            [
                'hoa_don_id' => 5,
                'khach_hang_id' => 5,
                'loai_yeu_cau' => 'huy',
                'ly_do' => 'Gặp sự cố cá nhân không thể tham gia',
                'trang_thai' => 2,
                'ghi_chu' => 'Đã hoàn tiền',
                'ngay_khoi_hanh_moi' => null,
            ],
        ]);
    }
}
