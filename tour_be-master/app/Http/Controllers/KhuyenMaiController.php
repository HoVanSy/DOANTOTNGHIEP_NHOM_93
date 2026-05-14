<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KhuyenMai;

class KhuyenMaiController extends Controller
{
    public function checkCoupon(Request $request) {
        $now = now()->format('Y-m-d');
        $coupon = KhuyenMai::where('ma_code', $request->code)
                        ->where('ngay_ket_thuc', '>=', $now)
                        ->where('tinh_trang', 1)
                        ->first();

        if (!$coupon) {
            return response()->json(['status' => false, 'message' => 'Mã không tồn tại hoặc hết hạn!']);
        }

        if ($request->tong_tien < $coupon->don_hang_toi_thieu) {
            return response()->json([
                'status' => false, 
                'message' => 'Đơn hàng tối thiểu phải từ ' . number_format($coupon->don_hang_toi_thieu) . 'đ'
            ]);
        }

        // Tính số tiền được giảm
        $so_tien_giam = 0;
        if ($coupon->loai == 1) { // Giảm theo %
            $so_tien_giam = ($request->tong_tien * $coupon->gia_tri) / 100;
        } else { // Giảm theo số tiền cố định
            $so_tien_giam = $coupon->gia_tri;
        }

        return response()->json([
            'status' => true,
            'so_tien_giam' => $so_tien_giam,
            'message' => 'Áp dụng mã thành công!'
        ]);
    }
    public function getData() {
        $data = KhuyenMai::all();
        return response()->json(['data' => $data]);
    }

    public function createKhuyenMai(Request $request) {
        KhuyenMai::create($request->all());
        return response()->json(['status' => true, 'message' => 'Thêm mới thành công!']);
    }

    public function updateKhuyenMai(Request $request) {
        $item = KhuyenMai::find($request->id);
        $item->update($request->all());
        return response()->json(['status' => true, 'message' => 'Cập nhật thành công!']);
    }

    public function deleteKhuyenMai(Request $request) {
        KhuyenMai::find($request->id)->delete();
        return response()->json(['status' => true, 'message' => 'Đã xóa mã khuyến mãi!']);
    }

    public function doiTrangThai(Request $request) {
        $item = KhuyenMai::find($request->id);
        $item->tinh_trang = !$item->tinh_trang;
        $item->save();
        return response()->json(['status' => true, 'message' => 'Đã đổi trạng thái!']);
    }
}
