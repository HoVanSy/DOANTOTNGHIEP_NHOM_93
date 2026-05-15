<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DanhGia;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\PersonalAccessToken;

class DanhGiaController extends Controller
{
    public function getDanhGia($id_tour)
    {
        $data = DB::table('danh_gias')
            ->join('khach_hangs', 'danh_gias.id_khach_hang', '=', 'khach_hangs.id')
            ->where('danh_gias.id_tour', $id_tour)
            ->select('danh_gias.*', 'khach_hangs.ho_ten as ten_khach_hang')
            ->orderBy('danh_gias.id', 'desc')
            ->get();

        $trung_binh = DB::table('danh_gias')->where('id_tour', $id_tour)->avg('so_sao');

        return response()->json([
            'status' => true,
            'list'   => $data,
            'avg'    => $trung_binh ? round($trung_binh, 1) : 0
        ]);
    }

    public function store(Request $request)
    {
        // Ràng buộc dữ liệu
        $request->validate([
            'id_tour'       => 'required|integer',
            'so_sao'        => 'required|integer|min:1|max:5',
            'noi_dung'      => 'required|string|max:1000',
        ], [
            'so_sao.min'        => 'Vui lòng chọn ít nhất 1 sao để đánh giá.',
            'noi_dung.required' => 'Vui lòng nhập nội dung trải nghiệm của bạn.',
            'noi_dung.max'      => 'Nội dung đánh giá không được vượt quá 1000 ký tự.'
        ]);

        $token = PersonalAccessToken::findToken($request->bearerToken());

        if (!$token) {
            return response()->json([
                'status' => false, 
                'message' => 'Lỗi xác thực: Không tìm thấy Token hợp lệ!'
            ], 401);
        }

        $id_khach_hang = $token->tokenable_id;

        DanhGia::create([
            'id_tour'       => $request->id_tour,
            'id_khach_hang' => $id_khach_hang, 
            'so_sao'        => $request->so_sao,
            'noi_dung'      => $request->noi_dung,
        ]);

        return response()->json([
            'status'  => true, 
            'message' => 'Cảm ơn bạn đã gửi đánh giá!'
        ]);
    }
}