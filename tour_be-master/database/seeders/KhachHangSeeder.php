<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KhachHangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('khach_hangs')->delete();

        DB::table('khach_hangs')->truncate();

        DB::table('khach_hangs')->insert([
<<<<<<< HEAD
            ['ho_ten' => 'Bùi Xuân Huấn', 'email' =>  'HuanBui@gmail.com', 'so_dien_thoai' => '999125634', 'password' => bcrypt('123456'), 'ngay_sinh' => '2000-04-13', 'dia_chi' => '12', 'gioi_tinh' => '1'],
            ['ho_ten' => 'Ngô Bá Khá', 'email' =>  'KhaNgo1@gmail.com', 'so_dien_thoai' => '511236589', 'password' => bcrypt('123456'), 'ngay_sinh' => '2000-04-14', 'dia_chi' => '23', 'gioi_tinh' => '1'],
            ['ho_ten' => 'Lê Văn Phú', 'email' =>  'PhuLe77@gmail.com', 'so_dien_thoai' => '598423655', 'password' => bcrypt('123456'), 'ngay_sinh' => '2000-04-15', 'dia_chi' => '13', 'gioi_tinh' => '1'],
            ['ho_ten' => 'Dương Minh Tuyền', 'email' =>  'TuyenTuyen2@gmail.com', 'so_dien_thoai' => '905786551', 'password' => bcrypt('123456'), 'ngay_sinh' => '2000-04-16', 'dia_chi' => '14', 'gioi_tinh' => '1'],
            ['ho_ten' => 'Nguyễn Anh Dũng', 'email' =>  'DungNguyen112@gmail.com', 'so_dien_thoai' => '853695478', 'password' => bcrypt('123456'), 'ngay_sinh' => '2000-04-17', 'dia_chi' => '15', 'gioi_tinh' => '1'],
            ['ho_ten' => 'Lê Song Thăng', 'email' =>  'SongSong113@gmail.com', 'so_dien_thoai' => '536987421', 'password' => bcrypt('123456'), 'ngay_sinh' => '2000-04-18', 'dia_chi' => '24', 'gioi_tinh' => '1'],
            ['ho_ten' => 'Nguyễn Xuân Mai', 'email' =>  'Xuanbake58@gmail.com', 'so_dien_thoai' => '598746321', 'password' => bcrypt('123456'), 'ngay_sinh' => '2000-04-19', 'dia_chi' => '25', 'gioi_tinh' => '1'],
            ['ho_ten' => 'Văn Khả Như', 'email' =>  'KhaNhu4@gmail.com', 'so_dien_thoai' => '905147896', 'password' => bcrypt('123456'), 'ngay_sinh' => '2000-04-20', 'dia_chi' => '26', 'gioi_tinh' => '0'],
            ['ho_ten' => 'Trần Khánh Linh', 'email' =>  'LinhLinh56@gmail.com', 'so_dien_thoai' => '522147895', 'password' => bcrypt('123456'), 'ngay_sinh' => '2000-04-21', 'dia_chi' => '16', 'gioi_tinh' => '0'],
            ['ho_ten' => 'Lý Mạc Sầu', 'email' =>  'LyMac89@gmail.com', 'so_dien_thoai' => '905145222', 'password' => bcrypt('123456'), 'ngay_sinh' => '2000-04-22', 'dia_chi' => '17', 'gioi_tinh' => '0'],
            ['ho_ten' => 'Dương Văn Quá', 'email' =>  'DuongQua@gmail.com', 'so_dien_thoai' => '809745632', 'password' => bcrypt('123456'), 'ngay_sinh' => '2000-04-23', 'dia_chi' => '18', 'gioi_tinh' => '1'],
            ['ho_ten' => 'Trần Luân Đôn', 'email' =>  'LuanDon99@gmail.com', 'so_dien_thoai' => '702769845', 'password' => bcrypt('123456'), 'ngay_sinh' => '2000-04-24', 'dia_chi' => '19', 'gioi_tinh' => '1'],
            ['ho_ten' => 'Mai Qua Pháp', 'email' =>  'QuaPhapp@gmail.com', 'so_dien_thoai' => '705069845', 'password' => bcrypt('123456'), 'ngay_sinh' => '2000-04-25', 'dia_chi' => '5', 'gioi_tinh' => '0'],
            ['ho_ten' => 'Thái Cô Nương', 'email' =>  'CoNuonggg@gmail.com', 'so_dien_thoai' => '211456987', 'password' => bcrypt('123456'), 'ngay_sinh' => '2000-04-26', 'dia_chi' => '6', 'gioi_tinh' => '0'],
            ['ho_ten' => 'Phan Mỵ Châu', 'email' =>  'MyChau123@gmail.com', 'so_dien_thoai' => '704123698', 'password' => bcrypt('123456'), 'ngay_sinh' => '2000-04-27', 'dia_chi' => '11', 'gioi_tinh' => '0'],
            ['ho_ten' => 'Mai Xuân Tùng', 'email' =>  'maitung801@gmail.com', 'so_dien_thoai' => '0971515624', 'password' => bcrypt('123456'), 'ngay_sinh' => '2003-10-23', 'dia_chi' => '11', 'gioi_tinh' => '1'],
=======
            // 5 tháng trước - khách hàng ban đầu
            ['ho_ten' => 'Bùi Xuân Huấn', 'email' => 'HuanBui@gmail.com', 'so_dien_thoai' => '999125634', 'password' => bcrypt('123456'), 'ngay_sinh' => '2000-04-13', 'dia_chi' => '12', 'gioi_tinh' => '1', 'created_at' => now()->subMonths(5)],
            ['ho_ten' => 'Ngô Bá Khá', 'email' => 'KhaNgo1@gmail.com', 'so_dien_thoai' => '511236589', 'password' => bcrypt('123456'), 'ngay_sinh' => '2000-04-14', 'dia_chi' => '23', 'gioi_tinh' => '1', 'created_at' => now()->subMonths(5)],
            // 4 tháng trước - tăng trưởng
            ['ho_ten' => 'Lê Văn Phú', 'email' => 'PhuLe77@gmail.com', 'so_dien_thoai' => '598423655', 'password' => bcrypt('123456'), 'ngay_sinh' => '2000-04-15', 'dia_chi' => '13', 'gioi_tinh' => '1', 'created_at' => now()->subMonths(4)],
            ['ho_ten' => 'Dương Minh Tuyền', 'email' => 'TuyenTuyen2@gmail.com', 'so_dien_thoai' => '905786551', 'password' => bcrypt('123456'), 'ngay_sinh' => '2000-04-16', 'dia_chi' => '14', 'gioi_tinh' => '1', 'created_at' => now()->subMonths(4)],
            // 3 tháng trước
            ['ho_ten' => 'Nguyễn Anh Dũng', 'email' => 'DungNguyen112@gmail.com', 'so_dien_thoai' => '853695478', 'password' => bcrypt('123456'), 'ngay_sinh' => '2000-04-17', 'dia_chi' => '15', 'gioi_tinh' => '1', 'created_at' => now()->subMonths(3)],
            ['ho_ten' => 'Lê Song Thăng', 'email' => 'SongSong113@gmail.com', 'so_dien_thoai' => '536987421', 'password' => bcrypt('123456'), 'ngay_sinh' => '2000-04-18', 'dia_chi' => '24', 'gioi_tinh' => '1', 'created_at' => now()->subMonths(3)],
            // 2 tháng trước - tăng mạnh
            ['ho_ten' => 'Nguyễn Xuân Mai', 'email' => 'Xuanbake58@gmail.com', 'so_dien_thoai' => '598746321', 'password' => bcrypt('123456'), 'ngay_sinh' => '2000-04-19', 'dia_chi' => '25', 'gioi_tinh' => '0', 'created_at' => now()->subMonths(2)],
            ['ho_ten' => 'Văn Khả Như', 'email' => 'KhaNhu4@gmail.com', 'so_dien_thoai' => '905147896', 'password' => bcrypt('123456'), 'ngay_sinh' => '2000-04-20', 'dia_chi' => '26', 'gioi_tinh' => '0', 'created_at' => now()->subMonths(2)],
            ['ho_ten' => 'Trần Khánh Linh', 'email' => 'LinhLinh56@gmail.com', 'so_dien_thoai' => '522147895', 'password' => bcrypt('123456'), 'ngay_sinh' => '2000-04-21', 'dia_chi' => '16', 'gioi_tinh' => '0', 'created_at' => now()->subMonths(2)],
            // 1 tháng trước
            ['ho_ten' => 'Lý Mạc Sầu', 'email' => 'LyMac89@gmail.com', 'so_dien_thoai' => '905145222', 'password' => bcrypt('123456'), 'ngay_sinh' => '2000-04-22', 'dia_chi' => '17', 'gioi_tinh' => '0', 'created_at' => now()->subMonths(1)],
            // Tháng này - khách hàng mới
            ['ho_ten' => 'Dương Văn Quá', 'email' => 'DuongQua@gmail.com', 'so_dien_thoai' => '809745632', 'password' => bcrypt('123456'), 'ngay_sinh' => '2000-04-23', 'dia_chi' => '18', 'gioi_tinh' => '1', 'created_at' => now()],
            ['ho_ten' => 'Trần Luân Đôn', 'email' => 'LuanDon99@gmail.com', 'so_dien_thoai' => '702769845', 'password' => bcrypt('123456'), 'ngay_sinh' => '2000-04-24', 'dia_chi' => '19', 'gioi_tinh' => '1', 'created_at' => now()],
            ['ho_ten' => 'Mai Qua Pháp', 'email' => 'QuaPhapp@gmail.com', 'so_dien_thoai' => '705069845', 'password' => bcrypt('123456'), 'ngay_sinh' => '2000-04-25', 'dia_chi' => '5', 'gioi_tinh' => '0', 'created_at' => now()->subDays(5)],
            ['ho_ten' => 'Thái Cô Nương', 'email' => 'CoNuonggg@gmail.com', 'so_dien_thoai' => '211456987', 'password' => bcrypt('123456'), 'ngay_sinh' => '2000-04-26', 'dia_chi' => '6', 'gioi_tinh' => '0', 'created_at' => now()->subDays(3)],
            ['ho_ten' => 'Phan Mỵ Châu', 'email' => 'MyChau123@gmail.com', 'so_dien_thoai' => '704123698', 'password' => bcrypt('123456'), 'ngay_sinh' => '2000-04-27', 'dia_chi' => '11', 'gioi_tinh' => '0', 'created_at' => now()->subDays(2)],
>>>>>>> master
        ]);
    }
}
