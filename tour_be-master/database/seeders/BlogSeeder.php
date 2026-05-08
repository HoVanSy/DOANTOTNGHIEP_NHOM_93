<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('blogs')->delete();

        DB::table('blogs')->truncate();

        DB::table('blogs')->insert([
            [
                'tieu_de' => 'Khám phá vẻ đẹp Hội An xưa',
                'hinh_anh' => 'https://images2.thanhnien.vn/528068263637045248/2023/4/4/hoi-an-1680591517857660432696.jpg',
                'noi_dung' => 'Hội An là một trong những thành phố cổ kính nhất Việt Nam, nổi tiếng với kiến trúc cổ xưa và những con đường lát đá vôi. Du khách có thể thăm các cửa hàng nhỏ, thử quần áo may sẵn, thưởng thức ẩm thực địa phương và tham quan các điểm di tích lịch sử.',
                'slug' => 'kham-pha-ve-dep-hoi-an-xua',
                'tac_gia' => 'Nguyễn Văn A',
                'tinh_trang' => 1,
            ],
            [
                'tieu_de' => 'Tour núi rừng Tây Bắc đầy hấp dẫn',
                'hinh_anh' => 'https://cdn.tgdd.vn/Files/2021/07/03/1365444/kham-pha-6-dia-diem-du-lich-lao-cai-dep-tho-mong-huu-tinh-202107031904164318.jpg',
                'noi_dung' => 'Vùng Tây Bắc Việt Nam là điểm đến lý tưởng cho những ai yêu thích thiên nhiên hoang sơ. Với những đặc trưng địa hình núi cao, thung lũng sâu, đây là nơi lý tưởng để tham gia các hoạt động du lịch mạo hiểm như leo núi, chèo thuyền kayak.',
                'slug' => 'tour-nui-rung-tay-bac-day-hap-dan',
                'tac_gia' => 'Trần Thị B',
                'tinh_trang' => 1,
            ],
            [
                'tieu_de' => 'Ẩm thực miền Tây Nam Bộ không thể bỏ lỡ',
                'hinh_anh' => 'https://ik.imagekit.io/tvlk/blog/2021/10/du-lich-ca-mau-1.jpg',
                'noi_dung' => 'Miền Tây Nam Bộ nổi tiếng với những món ăn đặc sản phong phú và hương vị độc đáo. Từ bánh mỳ Cà Mau cho đến các món ăn từ cua, tôm, cá, tất cả đều mang đặc trưng riêng của vùng đất này.',
                'slug' => 'am-thuc-mien-tay-nam-bo-khong-the-bo-lo',
                'tac_gia' => 'Lê Văn C',
                'tinh_trang' => 1,
            ],
            [
                'tieu_de' => 'Những trải nghiệm tuyệt vời ở Đà Nẵng',
                'hinh_anh' => 'https://cdn.thuvienphapluat.vn/uploads/tintuc/2024/01/06/thanh-pho-ha-noi.jpg',
                'noi_dung' => 'Đà Nẵng là một thành phố ven biển với những bãi biển đẹp và cơ sở hạ tầng du lịch hiện đại. Du khách có thể tham quan những điểm du lịch nổi tiếng như bán đảo Sơn Trà, hang Hải Vân, và các bảo tàng.',
                'slug' => 'nhung-trai-nghiem-tuyet-voi-o-da-nang',
                'tac_gia' => 'Phạm Văn D',
                'tinh_trang' => 1,
            ],
            [
                'tieu_de' => 'Hà Nội - Thủ đô lâu đời và phong phú',
                'hinh_anh' => null,
                'noi_dung' => 'Hà Nội là thủ đô ngàn năm văn hiến của Việt Nam. Với những di tích lịch sử, những ngôi chùa cổ kính, phố cổ và nền ẩm thực phong phú, Hà Nội là nơi không nên bỏ lỡ.',
                'slug' => 'ha-noi-thu-do-lau-doi-va-phong-phu',
                'tac_gia' => 'Hoàng Văn E',
                'tinh_trang' => 1,
            ],
        ]);
    }
}
