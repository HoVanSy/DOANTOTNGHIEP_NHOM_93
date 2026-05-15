<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ChiTietChucNang extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('chi_tiet_chuc_nangs')->whereIn('id_chuc_vu', [1, 2, 3, 4, 5])->delete();

        $phan_quyen = [
            1 => range(1, 51),

            // Chức vụ 2: Marketing (Tỉnh thành, Quận huyện, Địa điểm, Tour)
            2 => array_merge(range(1, 12), range(19, 24), range(41, 46)),

            // Chức vụ 3: Điều hành tour (Tỉnh thành, Quận huyện, Địa điểm, Khách hàng, Tour, Hóa đơn)
            3 => array_merge(range(1, 12), range(19, 24), range(35, 51)),

            // Chức vụ 4: Hướng dẫn viên (Chỉ lấy dữ liệu và tìm kiếm: Địa điểm, Tour)
            4 => [19, 20, 41, 42],

            // Chức vụ 5: Kế toán (Khách hàng, Hóa đơn)
            5 => array_merge(range(35, 40), range(47, 51)),
        ];

        $data_insert = [];
        $now = Carbon::now();

        foreach ($phan_quyen as $id_chuc_vu => $danh_sach_chuc_nang) {
            foreach ($danh_sach_chuc_nang as $id_chuc_nang) {
                $data_insert[] = [
                    'id_chuc_nang' => $id_chuc_nang,
                    'id_chuc_vu'   => $id_chuc_vu,
                    'tinh_trang'   => 1, 
                    'created_at'   => $now,
                    'updated_at'   => $now,
                ];
            }
        }

        // 4. Insert toàn bộ vào Database
        DB::table('chi_tiet_chuc_nangs')->insert($data_insert);
    }
}