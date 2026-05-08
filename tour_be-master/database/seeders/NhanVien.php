<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NhanVien extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('nhan_viens')->delete();

        DB::table('nhan_viens')->truncate();

        DB::table('nhan_viens')->insert([
            ['ho_ten' => 'Lê Thảo Vy', 'ma_nhan_vien' =>  '101', 'email' => 'ThaoVy123@gmail.com', 'so_dien_thoai' => '905123456', 'password' => bcrypt('123456'), 'ngay_sinh' => '2000-04-13', 'id_chuc_vu' => '1'],
            ['ho_ten' => 'Nguyễn Thành Trung ', 'ma_nhan_vien' =>  '102', 'email' => 'TrungTrung2@gmail.com', 'so_dien_thoai' => '905456123', 'password' => bcrypt('123456'), 'ngay_sinh' => '2000-04-14', 'id_chuc_vu' => '3'],
            ['ho_ten' => 'Nguyễn Văn Hoàng Phúc ', 'ma_nhan_vien' =>  '201', 'email' => 'PhucNguyen99@gmail.com', 'so_dien_thoai' => '375957894', 'password' => bcrypt('123456'), 'ngay_sinh' => '2000-04-15', 'id_chuc_vu' => '1'],
            ['ho_ten' => 'Phan Nguyễn Bảo Nguyên', 'ma_nhan_vien' =>  '202', 'email' => 'NguyenNguyen67@gmail.com', 'so_dien_thoai' => '935455897', 'password' => bcrypt('123456'), 'ngay_sinh' => '2000-04-16', 'id_chuc_vu' => '2'],
            ['ho_ten' => 'Nguyễn Phương Thuỳ', 'ma_nhan_vien' =>  '203', 'email' => 'ThuyNguyen@gmail.com', 'so_dien_thoai' => '588125469', 'password' => bcrypt('123456'), 'ngay_sinh' => '2000-04-17', 'id_chuc_vu' => '1'],
            ['ho_ten' => 'Lê Xuân', 'ma_nhan_vien' =>  '301', 'email' => 'Xuan@gmail.com', 'so_dien_thoai' => '357452163', 'password' => bcrypt('123456'), 'ngay_sinh' => '2000-04-18', 'id_chuc_vu' => '1'],
            ['ho_ten' => 'Tùng', 'ma_nhan_vien' =>  '302', 'email' => 'Tung@gmail.com', 'so_dien_thoai' => '905184763', 'password' => bcrypt('123456'), 'ngay_sinh' => '2000-04-19', 'id_chuc_vu' => '1'],
            ['ho_ten' => 'Hưng', 'ma_nhan_vien' =>  '303', 'email' => 'Hung@gmail.com', 'so_dien_thoai' => '911025634', 'password' => bcrypt('123456'), 'ngay_sinh' => '2000-04-20', 'id_chuc_vu' => '1'],
            ['ho_ten' => 'Đạt', 'ma_nhan_vien' =>  '401', 'email' => 'Dat@gmail.com', 'so_dien_thoai' => '589158779', 'password' => bcrypt('123456'), 'ngay_sinh' => '2000-04-21', 'id_chuc_vu' => '1'],
            ['ho_ten' => 'Hà Thuỳ Dương', 'ma_nhan_vien' =>  '402', 'email' => 'DuongHa55@gmail.com', 'so_dien_thoai' => '905798886', 'password' => bcrypt('123456'), 'ngay_sinh' => '2000-04-22', 'id_chuc_vu' => '2'],
            ['ho_ten' => 'Nguyễn Quốc Việt ', 'ma_nhan_vien' =>  '403', 'email' => 'VietNguyen79@gmail.com', 'so_dien_thoai' => '897546921', 'password' => bcrypt('123456'), 'ngay_sinh' => '2000-04-23', 'id_chuc_vu' => '4'],
            ['ho_ten' => 'Lê Thị Ngọc Ánh', 'ma_nhan_vien' =>  '404', 'email' => 'NgocAnh009@gmail.com', 'so_dien_thoai' => '988745698', 'password' => bcrypt('123456'), 'ngay_sinh' => '2000-04-24', 'id_chuc_vu' => '3'],
            ['ho_ten' => 'Hoàng Thanh Mai', 'ma_nhan_vien' =>  '502', 'email' => 'MaiHoang7@gmail.com', 'so_dien_thoai' => '905433655', 'password' => bcrypt('123456'), 'ngay_sinh' => '2000-04-25', 'id_chuc_vu' => '5'],
            ['ho_ten' => 'Nguyễn Thị Thanh Tuyền', 'ma_nhan_vien' =>  '503', 'email' => 'TuyenThanh@gmail.com', 'so_dien_thoai' => '935458792', 'password' => bcrypt('123456'), 'ngay_sinh' => '2000-04-26', 'id_chuc_vu' => '4'],
            ['ho_ten' => 'Trương Hoàng Khả Ngân', 'ma_nhan_vien' =>  '504', 'email' => 'NganHoang56@gmail.com', 'so_dien_thoai' => '954698721', 'password' => bcrypt('123456'), 'ngay_sinh' => '2000-04-27', 'id_chuc_vu' => '5'],
        ]);
    }
}
