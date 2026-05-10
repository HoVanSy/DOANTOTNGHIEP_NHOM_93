<?php

namespace App\Http\Controllers;

use App\Models\ChiTietChucNang;
use App\Models\HoaDon;
use App\Models\KhachHang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ThongKeController extends Controller
{
    public function getThongKeTongQuan()
    {
        // $id_chuc_nang = 48; // Giả sử ID chức năng thống kê là 48
        // $user = Auth::guard('sanctum')->user();
        // $check = ChiTietChucNang::where('id_chuc_vu', $user->id_chuc_vu)
        //     ->where('id_chuc_nang', $id_chuc_nang)
        //     ->first();
        // if (!$check) {
        //     return response()->json([
        //         'status' => false,
        //         'message' => 'Bạn không đủ quyền truy cập chức năng này!',
        //     ]);
        // }

        // Tổng doanh thu (từ hóa đơn đã thanh toán - tinh_trang = 1)
        $tongDoanhThu = HoaDon::where('tinh_trang', 1)->sum('tong_tien');

        // Hóa đơn thành công (tinh_trang = 1)
        $hoaDonThanhCong = HoaDon::where('tinh_trang', 1)->count();

        // Khách hàng mới trong tháng này
        $thangNay = Carbon::now()->month;
        $namNay = Carbon::now()->year;
        $khachHangMoi = KhachHang::whereMonth('created_at', $thangNay)
            ->whereYear('created_at', $namNay)
            ->count();
        
        // Nếu không có, lấy tổng số khách hàng
        if ($khachHangMoi == 0) {
            $khachHangMoi = KhachHang::count();
        }

        // Hóa đơn hủy (tinh_trang = 2)
        $hoaDonHuy = HoaDon::where('tinh_trang', 2)->count();

        return response()->json([
            'status' => true,
            'data' => [
                'tong_doanh_thu' => $tongDoanhThu,
                'hoa_don_thanh_cong' => $hoaDonThanhCong,
                'khach_hang_moi' => $khachHangMoi,
                'hoa_don_huy' => $hoaDonHuy
            ]
        ]);
    }

    public function getThongKeDoanhThu()
    {
        // $id_chuc_nang = 48;
        // $user = Auth::guard('sanctum')->user();
        // $check = ChiTietChucNang::where('id_chuc_vu', $user->id_chuc_vu)
        //     ->where('id_chuc_nang', $id_chuc_nang)
        //     ->first();
        // if (!$check) {
        //     return response()->json([
        //         'status' => false,
        //         'message' => 'Bạn không đủ quyền truy cập chức năng này!',
        //     ]);
        // }

        // Doanh thu 6 tháng gần nhất
        $doanhThuThang = [];
        $thangLabels = [];

        for ($i = 5; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $thang = $date->month;
            $nam = $date->year;

            $doanhThu = HoaDon::where('tinh_trang', 1)
                ->whereMonth('created_at', $thang)
                ->whereYear('created_at', $nam)
                ->sum('tong_tien');

            $doanhThuThang[] = $doanhThu;
            $thangLabels[] = 'Tháng ' . $thang;
        }

        // Tỉ lệ trạng thái hóa đơn
        $daThanhToan = HoaDon::where('tinh_trang', 1)->count();
        $chuaThanhToan = HoaDon::where('tinh_trang', 0)->count();
        $daHuy = HoaDon::where('tinh_trang', 2)->count();

        return response()->json([
            'status' => true,
            'data' => [
                'thang' => $thangLabels,
                'doanh_thu' => $doanhThuThang,
                'trang_thai' => [
                    $daThanhToan,
                    $chuaThanhToan,
                    $daHuy
                ]
            ]
        ]);
    }
}
