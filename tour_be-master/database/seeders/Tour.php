<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Tour extends Seeder
{
    public function run(): void
    {
        DB::table('tours')->delete();

        DB::table('tours')->truncate();

        DB::table('tours')->insert([
            ['tieu_de' => 'Tour Quảng Nam - Đà Nẵng - Quảng Ngãi ', 'ngay_bat_dau' => '2000-04-13', 'ngay_ket_thuc' => '2000-04-22', 'mo_ta' => 'Tour du lịch Quảng Nam - Đà Nẵng - Quảng Ngãi là một hành trình thú vị qua các tỉnh miền Trung Việt Nam, mang đến cho du khách cảnh quan thiên nhiên đa dạng, di sản văn hóa lịch sử phong phú và những trải nghiệm ẩm thực đặc sắc.', 'gia_nguoi_lon' => '9050000', 'gia_tre_em' => '500000', 'link_anh' => 'https://images2.thanhnien.vn/528068263637045248/2023/4/4/hoi-an-1680591517857660432696.jpg'],
            ['tieu_de' => 'Tour Cao Bằng - Lạng Sơn - Quảng Ninh', 'ngay_bat_dau' => '2000-04-14', 'ngay_ket_thuc' => '2000-04-23', 'mo_ta' => 'Tour du lịch Cao Bằng - Lạng Sơn - Quảng Ninh mang đến cho du khách một cơ hội tuyệt vời để khám phá và trải nghiệm cảnh đẹp thiên nhiên hùng vĩ cùng với sự đa dạng văn hóa của các dân tộc thiểu số phía Đông Bắc Việt Nam', 'gia_nguoi_lon' => '6290000', 'gia_tre_em' => '600000', 'link_anh' => 'https://hnm.1cdn.vn/2023/10/03/1(2).jpg'],
            ['tieu_de' => 'Tour Trà Vinh - Vĩnh Long - Bạc Liêu ', 'ngay_bat_dau' => '2000-04-15', 'ngay_ket_thuc' => '2000-04-24', 'mo_ta' => 'Tour du lịch Trà Vinh - Vĩnh Long - Bạc Liêu mang đến cho du khách những trải nghiệm sâu sắc về các hoạt động nông nghiệp, thiên nhiên nước sông, và thưởng thức ẩm thực đặc sản ven sông biển tại các tỉnh miền Tây Nam Bộ Việt Nam.', 'gia_nguoi_lon' => '8790000', 'gia_tre_em' => '870000', 'link_anh' => 'https://static.kinhtedothi.vn/w960/images/upload/2022/08/31/dulichbaclieu.png'],
            ['tieu_de' => 'Tour Lâm Đồng - Khánh Hòa - Phú Yên', 'ngay_bat_dau' => '2000-04-16', 'ngay_ket_thuc' => '2000-04-25', 'mo_ta' => 'Tour du lịch Lâm Đồng - Khánh Hòa - Phú Yên là một hành trình đầy hấp dẫn qua các tỉnh miền Trung và Nam Trung Bộ Việt Nam, mang đến cho du khách những trải nghiệm đa dạng về thiên nhiên, văn hóa và lịch sử của các vùng đất này.', 'gia_nguoi_lon' => '7770000', 'gia_tre_em' => '700000', 'link_anh' => 'https://cdn.tgdd.vn/Files/2023/09/23/1548714/du-lich-phu-yen-cam-nang-du-lich-va-18-dia-diem-dep-hap-dan-202309231338450969.jpg'],
            ['tieu_de' => 'Tour Thanh - Nghệ - Tĩnh', 'ngay_bat_dau' => '2000-04-17', 'ngay_ket_thuc' => '2000-04-26', 'mo_ta' => 'Tour du lịch Thanh - Nghệ - Tĩnh là một hành trình thú vị qua các tỉnh miền Trung Bắc Việt Nam. Du khách sẽ được chiêm ngưỡng những cảnh quan thiên nhiên hùng vĩ, tham quan các di tích lịch sử và thưởng thức các sản phẩm ẩm thực đặc trưng .', 'gia_nguoi_lon' => '8888000', 'gia_tre_em' => '880000', 'link_anh' => 'https://cdn.tgdd.vn/Files/2021/11/29/1401088/top-40-dia-diem-du-lich-nghe-an-dep-noi-tieng-nhat-202308051426265312.jpg'],
            ['tieu_de' => 'Tour Lào Cai - Lai Châu - Điện Biên ', 'ngay_bat_dau' => '2000-04-18', 'ngay_ket_thuc' => '2000-04-27', 'mo_ta' => 'Tour du lịch Lào Cai - Lai Châu - Điện Biên là một hành trình thú vị qua các tỉnh miền núi phía Tây Bắc Việt Nam, nơi du khách có thể khám phá vẻ đẹp hoang sơ của thiên nhiên núi rừng cùng với những nét văn hóa đặc sắc của các dân tộc vùng cao.', 'gia_nguoi_lon' => '6900000', 'gia_tre_em' => '700000', 'link_anh' => 'https://cdn.tgdd.vn/Files/2021/07/03/1365444/kham-pha-6-dia-diem-du-lich-lao-cai-dep-tho-mong-huu-tinh-202107031904164318.jpg'],
            ['tieu_de' => 'Tour Kiên Giang - Cà Mau - Cần Thơ ', 'ngay_bat_dau' => '2000-04-19', 'ngay_ket_thuc' => '2000-04-22', 'mo_ta' => 'Tour du lịch Kiên Giang - Cà Mau - Cần Thơ là một hành trình thú vị qua các tỉnh miền Tây Nam Bộ Việt Nam, nơi du khách có thể khám phá vẻ đẹp thiên nhiên đa dạng từ biển đảo đến vùng đồng bằng sông nước và các nét văn hóa đặc trưng.', 'gia_nguoi_lon' => '10790000', 'gia_tre_em' => '1000000', 'link_anh' => 'https://ik.imagekit.io/tvlk/blog/2021/10/du-lich-ca-mau-1.jpg'],
            ['tieu_de' => 'Tour Hà Nội - Bắc Ninh - Hải Dương', 'ngay_bat_dau' => '2000-04-20', 'ngay_ket_thuc' => '2000-04-23', 'mo_ta' => 'Tour du lịch Hà Nội - Bắc Ninh - Hải Dương mang đến cho du khách một hành trình khám phá văn hóa, lịch sử và thiên nhiên của miền Bắc Việt Nam. Du khách sẽ được tham quan các đền chùa cổ và trải nghiệm văn hóa đặc trưng của từng địa phương', 'gia_nguoi_lon' => '12000000', 'gia_tre_em' => '1200000', 'link_anh' => 'https://cdn.thuvienphapluat.vn/uploads/tintuc/2024/01/06/thanh-pho-ha-noi.jpg'],
            ['tieu_de' => 'Tour Tây Nguyên ', 'ngay_bat_dau' => '2000-04-15', 'ngay_ket_thuc' => '2000-04-24', 'mo_ta' => 'Tour du lịch Tây Nguyên là một hành trình thú vị và đầy sắc màu qua các tỉnh thuộc vùng Tây Nguyên. Vùng đất này nổi tiếng với nền văn hóa đa dạng của các dân tộc thiểu số, cảnh quan thiên nhiên hùng vĩ và các điểm đến lịch sử, tôn giáo đặc biệt.', 'gia_nguoi_lon' => '5000000', 'gia_tre_em' => '500000', 'link_anh' => 'https://static.vinwonders.com/production/thoi-tiet-mang-den-1.jpg'],
            ['tieu_de' => 'Tour Bình - Trị - Thiên ', 'ngay_bat_dau' => '2000-04-16', 'ngay_ket_thuc' => '2000-04-25', 'mo_ta' => 'Tour du lịch Quảng Bình - Quảng Trị - Thừa Thiên mang đến cho du khách một hành trình khám phá về những di sản văn hóa lâu đời, tham quan các di tích lịch sử và thưởng thức vẻ đẹp thiên nhiên hoang sơ của các địa phương miền Trung Việt Nam.', 'gia_nguoi_lon' => '5790000', 'gia_tre_em' => '570000', 'link_anh' => 'https://www.vietnambooking.com/wp-content/uploads/2018/08/dulich-quang-binh-kham-pha-vuong-quoc-cua-nhung-hang-dong-ki-bi-22-8-2018-1.jpg'],
        ]);
    }
}
