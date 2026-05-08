<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ChucNang extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('chuc_nangs')->delete();

        DB::table('chuc_nangs')->truncate();

        DB::table('chuc_nangs')->insert([
            ['ten_chuc_nang' =>  'Lấy dữ liệu tỉnh thành'],
            ['ten_chuc_nang' =>  'Tìm kiếm tỉnh thành'],
            ['ten_chuc_nang' =>  'Thêm mới tỉnh thành'],
            ['ten_chuc_nang' =>  'Xóa tỉnh thành'],
            ['ten_chuc_nang' =>  'Cập nhật tỉnh thành'],
            ['ten_chuc_nang' =>  'Đổi trạng thái tỉnh thành'],
            ['ten_chuc_nang' =>  'Lấy dữ liệu quận huyện'],
            ['ten_chuc_nang' =>  'Tìm kiếm quận huyện'],
            ['ten_chuc_nang' =>  'Thêm mới quận huyện'],
            ['ten_chuc_nang' =>  'Xóa quận huyện'],
            ['ten_chuc_nang' =>  'Cập nhật quận huyện'],
            ['ten_chuc_nang' =>  'Đổi trạng thái quận huyện'],
            ['ten_chuc_nang' =>  'Lấy dữ liệu nhân viên'],
            ['ten_chuc_nang' =>  'Tìm kiếm nhân viên'],
            ['ten_chuc_nang' =>  'Thêm mới nhân viên'],
            ['ten_chuc_nang' =>  'Xóa nhân viên'],
            ['ten_chuc_nang' =>  'Cập nhật nhân viên'],
            ['ten_chuc_nang' =>  'Đổi trạng thái nhân viên'],
            ['ten_chuc_nang' =>  'Lấy dữ liệu địa điểm'],
            ['ten_chuc_nang' =>  'Tìm kiếm địa điểm'],
            ['ten_chuc_nang' =>  'Thêm mới địa điểm'],
            ['ten_chuc_nang' =>  'Xóa địa điểm'],
            ['ten_chuc_nang' =>  'Cập nhật địa điểm'],
            ['ten_chuc_nang' =>  'Đổi trạng thái địa điểm'],
            ['ten_chuc_nang' =>  'Lấy dữ liệu chức vụ'],
            ['ten_chuc_nang' =>  'Tìm kiếm chức vụ'],
            ['ten_chuc_nang' =>  'Thêm mới chức vụ'],
            ['ten_chuc_nang' =>  'Xóa chức vụ'],
            ['ten_chuc_nang' =>  'Cập nhật chức vụ'],
            ['ten_chuc_nang' =>  'Cấp quyền cho nhân viên'],
            ['ten_chuc_nang' =>  'Lấy dữ liệu đã cấp quyên'],
            ['ten_chuc_nang' =>  'Xóa quyền của nhân viên'],
            ['ten_chuc_nang' =>  'Lấy dữ liệu chức năng'],
            ['ten_chuc_nang' =>  'Tìm kiếm chức năng'],
            ['ten_chuc_nang' =>  'Lấy dữ liệu khách hàng'],
            ['ten_chuc_nang' =>  'Tìm kiếm khách hàng'],
            ['ten_chuc_nang' =>  'Thêm mới khách hàng'],
            ['ten_chuc_nang' =>  'Xóa khách hàng'],
            ['ten_chuc_nang' =>  'Cập nhật khách hàng'],
            ['ten_chuc_nang' =>  'Đổi trạng thái khách hàng'],
            ['ten_chuc_nang' =>  'Lấy dữ liệu Tour'],
            ['ten_chuc_nang' =>  'Tìm kiếm Tour'],
            ['ten_chuc_nang' =>  'Thêm mới Tour'],
            ['ten_chuc_nang' =>  'Xóa Tour'],
            ['ten_chuc_nang' =>  'Cập nhật Tour'],
            ['ten_chuc_nang' =>  'Đổi trạng thái Tour'],
            ['ten_chuc_nang' =>  'Lấy dữ liệu Hóa Đơn'],
            ['ten_chuc_nang' =>  'Xác nhận Hóa Đơn'],
            ['ten_chuc_nang' =>  'Hủy Hóa Đơn'],
            ['ten_chuc_nang' =>  'In Hóa Đơn'],
            ['ten_chuc_nang' =>  'Xóa Hóa Đơn'],
        ]);
    }
}
