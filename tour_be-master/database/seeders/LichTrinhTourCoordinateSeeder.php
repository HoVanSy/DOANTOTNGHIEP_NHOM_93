<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LichTrinhTourCoordinateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Xóa dữ liệu cũ và thêm mới (tùy chọn: bỏ dòng này nếu muốn giữ dữ liệu cũ)
        DB::table('lich_trinh_tours')->truncate();

        // =====================================================
        // TOUR 1: Quảng Nam - Đà Nẵng - Quảng Ngãi
        // =====================================================
        DB::table('lich_trinh_tours')->insert([
            [
                'id_tour' => 1,
                'so_ngay' => 1,
                'tieu_de' => 'Ngày 1: Đà Nẵng - Bà Nà Hills',
                'mo_ta' => 'Đến Đà Nẵng, khám phá Bà Nà Hills, ngắm cảnh từ đỉnh Núi Chúa, tham quan Cầu Vàng nổi tiếng',
                'dia_diem_di' => 'Đà Nẵng',
                'dia_diem_den' => 'Bà Nà Hills',
                'vi_do' => 15.9981,
                'kinh_do' => 107.9983,
                'phuong_tien' => 'Cáp treo',
                'gio_khoi_hanh' => '08:00:00',
                'gio_ket_thuc' => '17:00:00',
                'tinh_trang' => 1,
            ],
            [
                'id_tour' => 1,
                'so_ngay' => 2,
                'tieu_de' => 'Ngày 2: Đà Nẵng - Ngũ Hành Sơn - Hội An',
                'mo_ta' => 'Tham quan Ngũ Hành Sơn, làng đá mỹ nghệ Non Nước, sau đó di chuyển sang Hội An khám phá phố cổ',
                'dia_diem_di' => 'Đà Nẵng',
                'dia_diem_den' => 'Hội An',
                'vi_do' => 15.8801,
                'kinh_do' => 108.3380,
                'phuong_tien' => 'Xe khách',
                'gio_khoi_hanh' => '08:00:00',
                'gio_ket_thuc' => '21:00:00',
                'tinh_trang' => 1,
            ],
            [
                'id_tour' => 1,
                'so_ngay' => 3,
                'tieu_de' => 'Ngày 3: Hội An - Mỹ Sơn',
                'mo_ta' => 'Tham quan Thánh địa Mỹ Sơn - Di sản văn hóa thế giới, làng nghề Trần Hưng Đạo làm đèn lồng',
                'dia_diem_di' => 'Hội An',
                'dia_diem_den' => 'Mỹ Sơn',
                'vi_do' => 15.5042,
                'kinh_do' => 108.2450,
                'phuong_tien' => 'Xe khách',
                'gio_khoi_hanh' => '07:00:00',
                'gio_ket_thuc' => '14:00:00',
                'tinh_trang' => 1,
            ],
            [
                'id_tour' => 1,
                'so_ngay' => 4,
                'tieu_de' => 'Ngày 4: Mỹ Sơn - Quảng Ngãi - Về',
                'mo_ta' => 'Di chuyển đến Quảng Ngãi, tham quan Mộ Túy Bạo, bãi biển Sa Huỳnh, thưởng thức hải sản tươi sống',
                'dia_diem_di' => 'Mỹ Sơn',
                'dia_diem_den' => 'Quảng Ngãi',
                'vi_do' => 15.1204,
                'kinh_do' => 108.8043,
                'phuong_tien' => 'Xe khách',
                'gio_khoi_hanh' => '08:00:00',
                'gio_ket_thuc' => '18:00:00',
                'tinh_trang' => 1,
            ],
        ]);

        // =====================================================
        // TOUR 2: Cao Bằng - Lạng Sơn - Quảng Ninh
        // =====================================================
        DB::table('lich_trinh_tours')->insert([
            [
                'id_tour' => 2,
                'so_ngay' => 1,
                'tieu_de' => 'Ngày 1: Hà Nội - Cao Bằng',
                'mo_ta' => 'Khởi hành từ Hà Nội, di chuyển đến Cao Bằng, tham quan Pác Bó, hang Puong',
                'dia_diem_di' => 'Hà Nội',
                'dia_diem_den' => 'Cao Bằng',
                'vi_do' => 22.1447,
                'kinh_do' => 106.1944,
                'phuong_tien' => 'Xe khách',
                'gio_khoi_hanh' => '06:00:00',
                'gio_ket_thuc' => '18:00:00',
                'tinh_trang' => 1,
            ],
            [
                'id_tour' => 2,
                'so_ngay' => 2,
                'tieu_de' => 'Ngày 2: Cao Bằng - Lạng Sơn',
                'mo_ta' => 'Tham quan Khu du lịch Bản Giốc, thác Bản Giốc, động Ngườm Nya',
                'dia_diem_di' => 'Cao Bằng',
                'dia_diem_den' => 'Lạng Sơn',
                'vi_do' => 21.8536,
                'kinh_do' => 106.7781,
                'phuong_tien' => 'Xe khách',
                'gio_khoi_hanh' => '07:00:00',
                'gio_ket_thuc' => '17:00:00',
                'tinh_trang' => 1,
            ],
            [
                'id_tour' => 2,
                'so_ngay' => 3,
                'tieu_de' => 'Ngày 3: Lạng Sơn - Quảng Ninh',
                'mo_ta' => 'Tham quan đền Mẫu, chợ Đông Kinh, sau đó di chuyển đến Hạ Long',
                'dia_diem_di' => 'Lạng Sơn',
                'dia_diem_den' => 'Hạ Long',
                'vi_do' => 20.9511,
                'kinh_do' => 107.0735,
                'phuong_tien' => 'Xe khách',
                'gio_khoi_hanh' => '08:00:00',
                'gio_ket_thuc' => '14:00:00',
                'tinh_trang' => 1,
            ],
            [
                'id_tour' => 2,
                'so_ngay' => 4,
                'tieu_de' => 'Ngày 4: Hạ Long - Hà Nội',
                'mo_ta' => 'Du thuyền Hạ Long, tham quan động Thiên Cung, hòn Gà Chọi, trở về Hà Nội',
                'dia_diem_di' => 'Hạ Long',
                'dia_diem_den' => 'Hà Nội',
                'vi_do' => 21.0285,
                'kinh_do' => 105.8542,
                'phuong_tien' => 'Xe khách',
                'gio_khoi_hanh' => '12:00:00',
                'gio_ket_thuc' => '18:00:00',
                'tinh_trang' => 1,
            ],
        ]);

        // =====================================================
        // TOUR 3: Trà Vinh - Vĩnh Long - Bạc Liêu
        // =====================================================
        DB::table('lich_trinh_tours')->insert([
            [
                'id_tour' => 3,
                'so_ngay' => 1,
                'tieu_de' => 'Ngày 1: TP.HCM - Trà Vinh',
                'mo_ta' => 'Khởi hành từ TP.HCM, đến Trà Vinh tham quan chùa Ông, chùa Kim Cương',
                'dia_diem_di' => 'TP.HCM',
                'dia_diem_den' => 'Trà Vinh',
                'vi_do' => 9.9387,
                'kinh_do' => 106.1539,
                'phuong_tien' => 'Xe khách',
                'gio_khoi_hanh' => '06:00:00',
                'gio_ket_thuc' => '12:00:00',
                'tinh_trang' => 1,
            ],
            [
                'id_tour' => 3,
                'so_ngay' => 2,
                'tieu_de' => 'Ngày 2: Trà Vinh - Vĩnh Long',
                'mo_ta' => 'Tham quan vườn cây ăn trái, chợ nổi Cái Bè, làng hoa Sa Đéc',
                'dia_diem_di' => 'Trà Vinh',
                'dia_diem_den' => 'Vĩnh Long',
                'vi_do' => 10.0667,
                'kinh_do' => 105.9333,
                'phuong_tien' => 'Xe khách',
                'gio_khoi_hanh' => '08:00:00',
                'gio_ket_thuc' => '17:00:00',
                'tinh_trang' => 1,
            ],
            [
                'id_tour' => 3,
                'so_ngay' => 3,
                'tieu_de' => 'Ngày 3: Vĩnh Long - Bạc Liêu',
                'mo_ta' => 'Tham quan nhà máy xay xát lớn nhất Đông Dương, đồn điền mía, điệu bầu cải lương',
                'dia_diem_di' => 'Vĩnh Long',
                'dia_diem_den' => 'Bạc Liêu',
                'vi_do' => 9.2941,
                'kinh_do' => 105.7242,
                'phuong_tien' => 'Xe khách',
                'gio_khoi_hanh' => '07:00:00',
                'gio_ket_thuc' => '18:00:00',
                'tinh_trang' => 1,
            ],
        ]);

        // =====================================================
        // TOUR 4: Lâm Đồng - Khánh Hòa - Phú Yên
        // =====================================================
        DB::table('lich_trinh_tours')->insert([
            [
                'id_tour' => 4,
                'so_ngay' => 1,
                'tieu_de' => 'Ngày 1: TP.HCM - Đà Lạt',
                'mo_ta' => 'Khởi hành đến Đà Lạt, tham quan thung lũng Tình Yêu, hồ Xuân Hương',
                'dia_diem_di' => 'TP.HCM',
                'dia_diem_den' => 'Đà Lạt',
                'vi_do' => 11.9404,
                'kinh_do' => 108.4418,
                'phuong_tien' => 'Xe khách',
                'gio_khoi_hanh' => '05:00:00',
                'gio_ket_thuc' => '14:00:00',
                'tinh_trang' => 1,
            ],
            [
                'id_tour' => 4,
                'so_ngay' => 2,
                'tieu_de' => 'Ngày 2: Đà Lạt - Nha Trang',
                'mo_ta' => 'Di chuyển đến Nha Trang, tắm biển, tham quan Vinpearl Land',
                'dia_diem_di' => 'Đà Lạt',
                'dia_diem_den' => 'Nha Trang',
                'vi_do' => 12.2388,
                'kinh_do' => 109.1967,
                'phuong_tien' => 'Xe khách',
                'gio_khoi_hanh' => '08:00:00',
                'gio_ket_thuc' => '14:00:00',
                'tinh_trang' => 1,
            ],
            [
                'id_tour' => 4,
                'so_ngay' => 3,
                'tieu_de' => 'Ngày 3: Nha Trang - Phú Yên',
                'mo_ta' => 'Tham quan đầm Ô Loan, tháp Nhạn, bãi Xép, Gành Đá Đĩa',
                'dia_diem_di' => 'Nha Trang',
                'dia_diem_den' => 'Phú Yên',
                'vi_do' => 13.0889,
                'kinh_do' => 109.2744,
                'phuong_tien' => 'Xe khách',
                'gio_khoi_hanh' => '07:00:00',
                'gio_ket_thuc' => '17:00:00',
                'tinh_trang' => 1,
            ],
        ]);

        // =====================================================
        // TOUR 5: Thanh - Nghệ - Tĩnh
        // =====================================================
        DB::table('lich_trinh_tours')->insert([
            [
                'id_tour' => 5,
                'so_ngay' => 1,
                'tieu_de' => 'Ngày 1: Hà Nội - Thanh Hóa',
                'mo_ta' => 'Di chuyển đến Thanh Hóa, tham quan đền Lam Kinh, thác Hiêu',
                'dia_diem_di' => 'Hà Nội',
                'dia_diem_den' => 'Thanh Hóa',
                'vi_do' => 19.8070,
                'kinh_do' => 105.7850,
                'phuong_tien' => 'Xe khách',
                'gio_khoi_hanh' => '06:00:00',
                'gio_ket_thuc' => '12:00:00',
                'tinh_trang' => 1,
            ],
            [
                'id_tour' => 5,
                'so_ngay' => 2,
                'tieu_de' => 'Ngày 2: Thanh Hóa - Nghệ An',
                'mo_ta' => 'Tham quan làng nghề gốm Bát Tràng, di tích Kim Liên, quê Bác',
                'dia_diem_di' => 'Thanh Hóa',
                'dia_diem_den' => 'Vinh',
                'vi_do' => 18.6674,
                'kinh_do' => 105.6894,
                'phuong_tien' => 'Xe khách',
                'gio_khoi_hanh' => '07:00:00',
                'gio_ket_thuc' => '17:00:00',
                'tinh_trang' => 1,
            ],
            [
                'id_tour' => 5,
                'so_ngay' => 3,
                'tieu_de' => 'Ngày 3: Nghệ An - Hà Tĩnh',
                'mo_ta' => 'Tham quan chùa Hương Tích, núi Hồng Lĩnh, đền Cửa Việt',
                'dia_diem_di' => 'Vinh',
                'dia_diem_den' => 'Hà Tĩnh',
                'vi_do' => 18.3428,
                'kinh_do' => 105.9057,
                'phuong_tien' => 'Xe khách',
                'gio_khoi_hanh' => '08:00:00',
                'gio_ket_thuc' => '16:00:00',
                'tinh_trang' => 1,
            ],
        ]);

        // =====================================================
        // TOUR 6: Lào Cai - Lai Châu - Điện Biên
        // =====================================================
        DB::table('lich_trinh_tours')->insert([
            [
                'id_tour' => 6,
                'so_ngay' => 1,
                'tieu_de' => 'Ngày 1: Hà Nội - Lào Cai',
                'mo_ta' => 'Di chuyển đến Lào Cai, tham quan chợ phiên Cốc Lếu, Sapa',
                'dia_diem_di' => 'Hà Nội',
                'dia_diem_den' => 'Lào Cai',
                'vi_do' => 22.4857,
                'kinh_do' => 103.9724,
                'phuong_tien' => 'Xe khách',
                'gio_khoi_hanh' => '06:00:00',
                'gio_ket_thuc' => '14:00:00',
                'tinh_trang' => 1,
            ],
            [
                'id_tour' => 6,
                'so_ngay' => 2,
                'tieu_de' => 'Ngày 2: Lào Cai - Lai Châu',
                'mo_ta' => 'Tham quan đèo Ô Quy Hồ, thung lũng Mường Hoa, Tả Phìn',
                'dia_diem_di' => 'Lào Cai',
                'dia_diem_den' => 'Lai Châu',
                'vi_do' => 22.3955,
                'kinh_do' => 103.4812,
                'phuong_tien' => 'Xe khách',
                'gio_khoi_hanh' => '07:00:00',
                'gio_ket_thuc' => '16:00:00',
                'tinh_trang' => 1,
            ],
            [
                'id_tour' => 6,
                'so_ngay' => 3,
                'tieu_de' => 'Ngày 3: Lai Châu - Điện Biên',
                'mo_ta' => 'Tham quan đồi A1, di tích chiến trường Điện Biên Phủ',
                'dia_diem_di' => 'Lai Châu',
                'dia_diem_den' => 'Điện Biên Phủ',
                'vi_do' => 21.3866,
                'kinh_do' => 103.0130,
                'phuong_tien' => 'Xe khách',
                'gio_khoi_hanh' => '07:00:00',
                'gio_ket_thuc' => '14:00:00',
                'tinh_trang' => 1,
            ],
        ]);

        // =====================================================
        // TOUR 7: Kiên Giang - Cà Mau - Cần Thơ
        // =====================================================
        DB::table('lich_trinh_tours')->insert([
            [
                'id_tour' => 7,
                'so_ngay' => 1,
                'tieu_de' => 'Ngày 1: TP.HCM - Rạch Giá - Hà Tiên',
                'mo_ta' => 'Di chuyển đến Hà Tiên, tham quan Mũi Ngua, động Hang Cua',
                'dia_diem_di' => 'TP.HCM',
                'dia_diem_den' => 'Hà Tiên',
                'vi_do' => 10.2831,
                'kinh_do' => 104.4876,
                'phuong_tien' => 'Xe khách',
                'gio_khoi_hanh' => '06:00:00',
                'gio_ket_thuc' => '14:00:00',
                'tinh_trang' => 1,
            ],
            [
                'id_tour' => 7,
                'so_ngay' => 2,
                'tieu_de' => 'Ngày 2: Hà Tiên - Cà Mau',
                'mo_ta' => 'Di chuyển đến Cà Mau, tham quan đất Mũi, rừng ngập mặn',
                'dia_diem_di' => 'Hà Tiên',
                'dia_diem_den' => 'Cà Mau',
                'vi_do' => 9.1533,
                'kinh_do' => 105.1501,
                'phuong_tien' => 'Xe khách',
                'gio_khoi_hanh' => '07:00:00',
                'gio_ket_thuc' => '17:00:00',
                'tinh_trang' => 1,
            ],
            [
                'id_tour' => 7,
                'so_ngay' => 3,
                'tieu_de' => 'Ngày 3: Cà Mau - Cần Thơ',
                'mo_ta' => 'Di chuyển đến Cần Thơ, tham quan chợ nổi Cái Răng, nhà cổ Bình Thuỷ',
                'dia_diem_di' => 'Cà Mau',
                'dia_diem_den' => 'Cần Thơ',
                'vi_do' => 10.0348,
                'kinh_do' => 105.7872,
                'phuong_tien' => 'Xe khách',
                'gio_khoi_hanh' => '07:00:00',
                'gio_ket_thuc' => '16:00:00',
                'tinh_trang' => 1,
            ],
        ]);

        // =====================================================
        // TOUR 8: Hà Nội - Bắc Ninh - Hải Dương
        // =====================================================
        DB::table('lich_trinh_tours')->insert([
            [
                'id_tour' => 8,
                'so_ngay' => 1,
                'tieu_de' => 'Ngày 1: Hà Nội - Bắc Ninh',
                'mo_ta' => 'Tham quan đền Đô, chùa Phật Tích, làng nghề Đại Bái',
                'dia_diem_di' => 'Hà Nội',
                'dia_diem_den' => 'Bắc Ninh',
                'vi_do' => 21.1248,
                'kinh_do' => 106.3359,
                'phuong_tien' => 'Xe khách',
                'gio_khoi_hanh' => '08:00:00',
                'gio_ket_thuc' => '17:00:00',
                'tinh_trang' => 1,
            ],
            [
                'id_tour' => 8,
                'so_ngay' => 2,
                'tieu_de' => 'Ngày 2: Bắc Ninh - Hải Dương - Hà Nội',
                'mo_ta' => 'Tham quan đền Kiep Bac, chùa Côn Sơn, khu di tích Tứ Mỹ',
                'dia_diem_di' => 'Bắc Ninh',
                'dia_diem_den' => 'Hải Dương',
                'vi_do' => 20.9381,
                'kinh_do' => 106.3200,
                'phuong_tien' => 'Xe khách',
                'gio_khoi_hanh' => '08:00:00',
                'gio_ket_thuc' => '16:00:00',
                'tinh_trang' => 1,
            ],
        ]);

        // =====================================================
        // TOUR 9: Tây Nguyên
        // =====================================================
        DB::table('lich_trinh_tours')->insert([
            [
                'id_tour' => 9,
                'so_ngay' => 1,
                'tieu_de' => 'Ngày 1: TP.HCM - Buôn Ma Thuột',
                'mo_ta' => 'Di chuyển đến Buôn Ma Thuột, tham quan thác Draysap, làng cà phê',
                'dia_diem_di' => 'TP.HCM',
                'dia_diem_den' => 'Buôn Ma Thuột',
                'vi_do' => 12.2388,
                'kinh_do' => 108.0547,
                'phuong_tien' => 'Xe khách',
                'gio_khoi_hanh' => '05:00:00',
                'gio_ket_thuc' => '14:00:00',
                'tinh_trang' => 1,
            ],
            [
                'id_tour' => 9,
                'so_ngay' => 2,
                'tieu_de' => 'Ngày 2: Buôn Ma Thuột - Pleiku',
                'mo_ta' => 'Tham quan hồ T\'Nưng, thác Phú Cần, đồi cà phê',
                'dia_diem_di' => 'Buôn Ma Thuột',
                'dia_diem_den' => 'Pleiku',
                'vi_do' => 13.9833,
                'kinh_do' => 108.0000,
                'phuong_tien' => 'Xe khách',
                'gio_khoi_hanh' => '08:00:00',
                'gio_ket_thuc' => '17:00:00',
                'tinh_trang' => 1,
            ],
            [
                'id_tour' => 9,
                'so_ngay' => 3,
                'tieu_de' => 'Ngày 3: Pleiku - Kon Tum',
                'mo_ta' => 'Tham quan nhà thờ gỗ Kon Tum, nhà rông, cầu treo Đăk Roong',
                'dia_diem_di' => 'Pleiku',
                'dia_diem_den' => 'Kon Tum',
                'vi_do' => 14.3498,
                'kinh_do' => 108.0000,
                'phuong_tien' => 'Xe khách',
                'gio_khoi_hanh' => '08:00:00',
                'gio_ket_thuc' => '16:00:00',
                'tinh_trang' => 1,
            ],
        ]);

        // =====================================================
        // TOUR 10: Quảng Bình - Quảng Trị - Thừa Thiên
        // =====================================================
        DB::table('lich_trinh_tours')->insert([
            [
                'id_tour' => 10,
                'so_ngay' => 1,
                'tieu_de' => 'Ngày 1: Hà Nội - Quảng Bình',
                'mo_ta' => 'Di chuyển đến Đồng Hới, tham quan động Phong Nha, sông Chày',
                'dia_diem_di' => 'Hà Nội',
                'dia_diem_den' => 'Đồng Hới',
                'vi_do' => 17.4673,
                'kinh_do' => 106.5986,
                'phuong_tien' => 'Xe khách',
                'gio_khoi_hanh' => '06:00:00',
                'gio_ket_thuc' => '14:00:00',
                'tinh_trang' => 1,
            ],
            [
                'id_tour' => 10,
                'so_ngay' => 2,
                'tieu_de' => 'Ngày 2: Quảng Bình - Quảng Trị',
                'mo_ta' => 'Tham quan khu di tích địa đạo Vịnh Mốc, bãi tắm Cửa Tùng',
                'dia_diem_di' => 'Đồng Hới',
                'dia_diem_den' => 'Đông Hà',
                'vi_do' => 16.8163,
                'kinh_do' => 106.8333,
                'phuong_tien' => 'Xe khách',
                'gio_khoi_hanh' => '08:00:00',
                'gio_ket_thuc' => '16:00:00',
                'tinh_trang' => 1,
            ],
            [
                'id_tour' => 10,
                'so_ngay' => 3,
                'tieu_de' => 'Ngày 3: Quảng Trị - Huế',
                'mo_ta' => 'Di chuyển đến Huế, tham quan Đại Nội, chùa Thiên Mụ',
                'dia_diem_di' => 'Đông Hà',
                'dia_diem_den' => 'Huế',
                'vi_do' => 16.4637,
                'kinh_do' => 107.5909,
                'phuong_tien' => 'Xe khách',
                'gio_khoi_hanh' => '08:00:00',
                'gio_ket_thuc' => '15:00:00',
                'tinh_trang' => 1,
            ],
        ]);
    }
}

