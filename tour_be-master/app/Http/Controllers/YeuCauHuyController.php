<?php

namespace App\Http\Controllers;

use App\Models\HoaDon;
use App\Models\YeuCauHuy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 

class YeuCauHuyController extends Controller
{
    // Tạo yêu cầu hủy/đổi lịch
    public function createYeuCau(Request $request)
    {
        $khachHang = Auth::guard('sanctum')->user();

        if (!$khachHang) {
            return response()->json([
                'status' => false,
                'message' => 'Vui lòng đăng nhập để thực hiện chức năng này!'
            ], 401);
        }

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
        $khachHang = \Illuminate\Support\Facades\Auth::guard('sanctum')->user();

        if (!$khachHang) {
            return response()->json([
                'status' => false,
                'message' => 'Vui lòng đăng nhập để xem lịch sử!'
            ], 401);
        }

        try {
            $data = \App\Models\YeuCauHuy::with(['hoaDon.chiTietHoaDons.tour'])
                ->where('khach_hang_id', $khachHang->id)
                ->orderBy('created_at', 'desc')
                ->get();

            return response()->json([
                'status' => true,
                'data' => $data
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Lỗi Database: ' . $e->getMessage()
            ], 500);
        }
    }

    // Lấy danh sách yêu cầu cho admin
    public function getYeuCauAdmin()
    {
        try {
            $data = \App\Models\YeuCauHuy::with(['hoaDon.chiTietHoaDons.tour', 'khachHang'])
                ->orderBy('created_at', 'desc')
                ->get();

            return response()->json([
                'status' => true,
                'data' => $data
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Lỗi Database: ' . $e->getMessage()
            ], 500); 
        }
    }

    // Admin: Duyệt yêu cầu
    public function duyetYeuCau(Request $request)
    {
        $yeuCau = \App\Models\YeuCauHuy::find($request->id);
        
        if (!$yeuCau) {
            return response()->json(['status' => false, 'message' => 'Không tìm thấy yêu cầu này!']);
        }

        //Đã Duyệt (1)
        $yeuCau->trang_thai = 1;
        $yeuCau->ghi_chu = $request->ghi_chu;
        $yeuCau->save();

        if ($yeuCau->loai_yeu_cau == 'huy') {
            // Cập nhật tình trạng hóa đơn thành Đã Hủy (2)
            \App\Models\HoaDon::where('id', $yeuCau->hoa_don_id)->update([
                'tinh_trang' => 2 
            ]);
            
        } else if ($yeuCau->loai_yeu_cau == 'doi_lich') {
            
        }

        return response()->json([
            'status' => true,
            'message' => 'Đã duyệt yêu cầu và cập nhật Hóa đơn thành công!'
        ]);
    }

    // Admin: Từ chối yêu cầu
    public function tuChoiYeuCau(Request $request)
    {
        $yeuCau = \App\Models\YeuCauHuy::find($request->id);
        
        if (!$yeuCau) {
            return response()->json(['status' => false, 'message' => 'Không tìm thấy yêu cầu này!']);
        }

        // Cập nhật trạng thái của bảng Yêu Cầu thành Từ Chối (2)
        $yeuCau->trang_thai = 2;
        $yeuCau->ghi_chu = $request->ghi_chu;
        $yeuCau->save();

        // Lưu ý: Từ chối thì không đụng chạm gì đến Hóa Đơn, mọi thứ vẫn giữ nguyên như cũ.

        return response()->json([
            'status' => true,
            'message' => 'Đã từ chối yêu cầu!'
        ]);
    }
}