<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DanhGiaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('danh_gias')->truncate();

        $nhan_xet_mau = [
            'Tour tổ chức rất chuyên nghiệp, hướng dẫn viên siêu nhiệt tình và chu đáo!',
            'Đồ ăn ngon, khách sạn sạch sẽ. Lịch trình di chuyển hợp lý không bị mệt.',
            'Gia đình tôi đã có những trải nghiệm tuyệt vời, cảnh quan đẹp ngoài mong đợi.',
            'Giá cả hợp lý so với chất lượng dịch vụ nhận được. Chắc chắn sẽ quay lại ủng hộ VivuTour.',
            'Xe di chuyển êm ái, tài xế cẩn thận. Tuy nhiên thời gian tham quan ở một vài điểm hơi ngắn.',
            'Tuyệt vời! Từ khâu đặt tour đến khi kết thúc mọi thứ đều suôn sẻ, nhân viên hỗ trợ nhiệt tình 24/7.',
            'Một chuyến đi đáng nhớ. Dịch vụ lưu trú cực kỳ sang trọng và thoải mái.',
            'Chương trình tour phong phú, không bị nhàm chán. HDV thuyết minh rất hay và hài hước.',
            'Cảnh sát đẹp, dịch vụ tốt, HDV chụp ảnh siêu có tâm luôn nha mọi người 10 điểm!',
            'Mọi thứ đều hoàn hảo, duy nhất ngày thứ 2 trời hơi mưa nhưng HDV xử lý tình huống đổi lịch trình rất linh hoạt.'
        ];

        $data = [];

        for ($i = 0; $i < 30; $i++) {
            $random_nhan_xet = $nhan_xet_mau[array_rand($nhan_xet_mau)];
            
            $random_date = Carbon::now()->subDays(rand(1, 30))->subHours(rand(1, 24));

            $data[] = [
                'id_tour'       => rand(1, 5),  
                'id_khach_hang' => rand(1, 10), 
                'so_sao'        => rand(4, 5), 
                'noi_dung'      => $random_nhan_xet,
                'created_at'    => $random_date,
                'updated_at'    => $random_date,
            ];
        }

        DB::table('danh_gias')->insert($data);
    }
}