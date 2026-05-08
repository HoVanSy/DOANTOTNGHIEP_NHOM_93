<?php

namespace App\Http\Controllers;

use App\Models\HoaDon;
use App\Models\YeuCauHuy;
use Illuminate\Http\Request;

class YeuCauHuyController extends Controller
{
    // Tạo yêu cầu hủy/đổi lịch
    public function createYeuCau(Request $request)
    {
        $khachHang = $request->user();

        YeuCauHuy::create([
            'hoa_don_id' => $request->hoa_don_id,
            'khach_hang_id' => $khachHang->id,
            'loai_yeu_cau' => $request->loai_yeu_cau,
            'ly_do' => $request->ly_do,
            'ngay_khoi_hanh_moi' => $request->ngay_khoi_hanh_moi,
            'trang_thai' => 0,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Yêu cầu đã được gửi thành công!'
        ]);
    }

    // Lấy danh sách yêu cầu của khách hàng
    public function getYeuCauClient(Request $request)
    {
        $khachHang = $request->user();

        $data = YeuCauHuy::with(['hoaDon', 'khachHang'])
            ->where('khach_hang_id', $khachHang->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'status' => true,
            'data' => $data
        ]);
    }

    // Lấy danh sách yêu cầu cho admin
    public function getYeuCauAdmin()
    {
        $data = YeuCauHuy::with(['hoaDon.khachHang', 'khachHang'])
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'status' => true,
            'data' => $data
        ]);
    }

    // Duyệt yêu cầu
    public function duyetYeuCau(Request $request)
    {
        $yeuCau = YeuCauHuy::find($request->id);
        $yeuCau->trang_thai = 1;
        $yeuCau->ghi_chu = $request->ghi_chu;
        $yeuCau->save();

        // Nếu là yêu cầu đổi lịch
        if ($yeuCau->loai_yeu_cau == 'doi_lich') {
            HoaDon::where('id', $yeuCau->hoa_don_id)->update([
                'ngay_khoi_hanh' => $yeuCau->ngay_khoi_hanh_moi
            ]);
        }
        // Nếu là yêu cầu hủy
        else if ($yeuCau->loai_yeu_cau == 'huy') {
            HoaDon::where('id', $yeuCau->hoa_don_id)->update([
                'tinh_trang' => 2
            ]);
        }

        return response()->json([
            'status' => true,
            'message' => 'Đã duyệt yêu cầu thành công!'
        ]);
    }

    // Từ chối yêu cầu
    public function tuChoiYeuCau(Request $request)
    {
        $yeuCau = YeuCauHuy::find($request->id);
        $yeuCau->trang_thai = 2;
        $yeuCau->ghi_chu = $request->ghi_chu;
        $yeuCau->save();

        return response()->json([
            'status' => true,
            'message' => 'Đã từ chối yêu cầu!'
        ]);
    }
}
