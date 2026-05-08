<?php

namespace App\Http\Controllers;

use App\Models\ChiTietChucNang;
use App\Models\ChiTietHoaDon;
use App\Models\HoaDon;
use App\Models\KhachHang;
use App\Models\Tour;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class HoaDonController extends Controller
{
    public function getData()
    {
        $id_chuc_nang   = 47;
        $user   = Auth::guard('sanctum')->user();
        $check  =   ChiTietChucNang::where('id_chuc_vu', $user->id_chuc_vu)
            ->where('id_chuc_nang', $id_chuc_nang)
            ->first();
        if (!$check) {
            return response()->json([
                'status'    =>  false,
                'message'   =>  'Bạn không đủ quyền truy cập chức năng này!',
            ]);
        }
        $data   = HoaDon::join('khach_hangs', 'hoa_dons.id_khach_hang', 'khach_hangs.id')
            ->select('hoa_dons.*', 'khach_hangs.ho_ten')
            ->get();
        return response()->json([
            'status'    => true,
            'data'    =>  $data
        ]);
    }

    public function datTour(Request $request)
    {
        $dataTour = $request->all();
        $tong_tien = $dataTour['so_nguoi_lon'] * $dataTour['gia_nguoi_lon'] + $dataTour['so_tre_em'] * $dataTour['gia_tre_em'];
        $khach_hang =   Auth::guard('sanctum')->user();

        if ($dataTour['gia_nguoi_lon'] <= 0 || $dataTour['so_tre_em'] <= 0) {
            return response()->json([
                'status'    =>  false,
                'message'   =>  'Số lượng người lớn hoặc trẻ em phải lớn hơn 0!',
            ]);
        } else {
            $hd = HoaDon::create([
                'ma_hoa_don'                    =>  Str::uuid(),
                'id_khach_hang'                 =>  $khach_hang->id,
                'tong_tien'                     =>  $tong_tien,
                'so_luong_nguoi_lon'            =>  $dataTour['so_nguoi_lon'],
                'so_luong_tre_em'               =>  $dataTour['so_tre_em'],
                'tinh_trang'                    =>  1
            ]);

            ChiTietHoaDon::create([
                'id_hoa_don'    =>  $hd->id,
                'id_tour'       =>  $request->id_tour,
                'thanh_tien'    =>  $hd->tong_tien,
                'tinh_trang'    => 0
            ]);

            return response()->json([
                'status'    =>  true,
                'message'   =>  'Đã đặt tour thành công!',
            ]);
        }
    }

    public function getDataHoaDon(Request $request)
    {
        $khachHang = \Illuminate\Support\Facades\Auth::guard('sanctum')->user();
        
        $data = HoaDon::where('id_khach_hang', $khachHang->id)
                      ->with('chiTietHoaDons.tour') 
                      ->orderBy('created_at', 'desc')
                      ->get();

        return response()->json([
            'status' => true,
            'danh_sach_hoa_don' => $data
        ]);
    }

    public function doiTinhTrangHoaDonClient(Request $request)
    {
        try {
            if ($request->tinh_trang == 1) {
                $tinh_trang_moi = 0;
            } else {
                $tinh_trang_moi = 1;
            }
            HoaDon::where('id', $request->id)->update([
                'tinh_trang'    =>  $tinh_trang_moi
            ]);
            return response()->json([
                'status'            =>   true,
                'message'           =>   'Đã đổi trạng thái thành công',
            ]);
        } catch (Exception $e) {
            Log::info("Lỗi", $e);
            return response()->json([
                'status'            =>   false,
                'message'           =>   'Có lỗi',
            ]);
        }
    }

    public function getDataCTHD(Request $request)
    {
        $data = ChiTietHoaDon::join('hoa_dons', 'hoa_dons.id', 'chi_tiet_hoa_dons.id_hoa_don')
            ->join('tours', 'chi_tiet_hoa_dons.id_tour', 'tours.id')
            ->where('hoa_dons.id', $request->id)
            ->select('chi_tiet_hoa_dons.*', 'hoa_dons.*', 'tours.tieu_de', 'tours.gia_nguoi_lon', 'tours.gia_tre_em')
            ->get();
        return response()->json([
            'chi_tiet_hoa_don' =>  $data,
            'status'        =>  true
        ]);
    }

    public function themVaoGioHang(Request $request)
    {
        $dataTour = $request->all();
        $tong_tien = $dataTour['so_nguoi_lon'] * $dataTour['gia_nguoi_lon'] + $dataTour['so_tre_em'] * $dataTour['gia_tre_em'];
        $khach_hang =   Auth::guard('sanctum')->user();

        if ($dataTour['gia_nguoi_lon'] <= 0 || $dataTour['so_tre_em'] <= 0) {
            return response()->json([
                'status'    =>  false,
                'message'   =>  'Số lượng người lớn hoặc trẻ em phải lớn hơn 0!',
            ]);
        } else {
            $hd = HoaDon::create([
                'ma_hoa_don'                    =>  Str::uuid(),
                'id_khach_hang'                 =>  $khach_hang->id,
                'tong_tien'                     =>  $tong_tien,
                'so_luong_nguoi_lon'            =>  $dataTour['so_nguoi_lon'],
                'so_luong_tre_em'               =>  $dataTour['so_tre_em'],
                'tinh_trang'                    =>  0
            ]);

            ChiTietHoaDon::create([
                'id_hoa_don'    =>  $hd->id,
                'id_tour'       =>  $request->id_tour,
                'thanh_tien'    =>  $hd->tong_tien,
                'tinh_trang'    => 0
            ]);

            return response()->json([
                'status'    =>  true,
                'message'   =>  'Thêm vào giỏ hàng thành công!',
            ]);
        }
    }

    public function xacNhanHoaDon(Request $request)
    {
        try {
            if ($request->tinh_trang == 0) {
                $tinh_trang_moi = 1;
            }
            HoaDon::where('id', $request->id)->update([
                'tinh_trang'    =>  $tinh_trang_moi
            ]);
            return response()->json([
                'status'            =>   true,
                'message'           =>   'Đã xác nhận thành công',
            ]);
        } catch (Exception $e) {
            Log::info("Lỗi", $e);
            return response()->json([
                'status'            =>   false,
                'message'           =>   'Có lỗi',
            ]);
        }
    }

    public function huyHoaDon(Request $request)
    {
        try {
            if ($request->tinh_trang == 0) {
                $tinh_trang_moi = 2;
            }
            HoaDon::where('id', $request->id)->update([
                'tinh_trang'    =>  $tinh_trang_moi
            ]);
            return response()->json([
                'status'            =>   true,
                'message'           =>   'Hủy thành công! Bạn có thể đặt lại tour này!',
            ]);
        } catch (Exception $e) {
            Log::info("Lỗi", $e);
            return response()->json([
                'status'            =>   false,
                'message'           =>   'Có lỗi',
            ]);
        }
    }

    public function xacNhanHoaDonAdmin(Request $request)
    {
        $id_chuc_nang   = 48;
        $user   = Auth::guard('sanctum')->user();
        $check  =   ChiTietChucNang::where('id_chuc_vu', $user->id_chuc_vu)
            ->where('id_chuc_nang', $id_chuc_nang)
            ->first();
        if (!$check) {
            return response()->json([
                'status'    =>  false,
                'message'   =>  'Bạn không đủ quyền truy cập chức năng này!',
            ]);
        } else {
            try {
                if ($request->tinh_trang == 0) {
                    $tinh_trang_moi = 1;
                }
                HoaDon::where('id', $request->id)->update([
                    'tinh_trang'    =>  $tinh_trang_moi
                ]);
                return response()->json([
                    'status'            =>   true,
                    'message'           =>   'Đã xác nhận thành công',
                ]);
            } catch (Exception $e) {
                Log::info("Lỗi", $e);
                return response()->json([
                    'status'            =>   false,
                    'message'           =>   'Có lỗi',
                ]);
            }
        }
    }

    public function huyHoaDonAdmin(Request $request)
    {
        $id_chuc_nang   = 49;
        $user   = Auth::guard('sanctum')->user();
        $check  =   ChiTietChucNang::where('id_chuc_vu', $user->id_chuc_vu)
            ->where('id_chuc_nang', $id_chuc_nang)
            ->first();
        if (!$check) {
            return response()->json([
                'status'    =>  false,
                'message'   =>  'Bạn không đủ quyền truy cập chức năng này!',
            ]);
        } else {
            try {
                if ($request->tinh_trang == 0) {
                    $tinh_trang_moi = 2;
                }
                HoaDon::where('id', $request->id)->update([
                    'tinh_trang'    =>  $tinh_trang_moi
                ]);
                return response()->json([
                    'status'            =>   true,
                    'message'           =>   'Đã hủy thành công',
                ]);
            } catch (Exception $e) {
                Log::info("Lỗi", $e);
                return response()->json([
                    'status'            =>   false,
                    'message'           =>   'Có lỗi',
                ]);
            }
        }
    }

    public function deleteHoaDon($id)
    {
        $id_chuc_nang   = 51;
        $user   =  Auth::guard('sanctum')->user();
        $check  =   ChiTietChucNang::where('id_chuc_vu', $user->id_chuc_vu)
            ->where('id_chuc_nang', $id_chuc_nang)
            ->first();
        if (!$check) {
            return response()->json([
                'status'    =>  false,
                'message'   =>  'Bạn không đủ quyền truy cập chức năng này!',
            ]);
        }
        try {
            HoaDon::where('id', $id)->delete();
            return response()->json([
                'status'            =>   true,
                'message'           =>   'Xóa hóa đơn thành công!',
            ]);
        } catch (Exception $e) {
            Log::info("Lỗi", $e);
            return response()->json([
                'status'            =>   false,
                'message'           =>   'Có lỗi',
            ]);
        }
    }

    public function searchHoaDonAdmin(Request $request)
    {
        $key = "%" . $request->abc . "%";

        $data   = HoaDon::join('khach_hangs', 'khach_hangs.id', 'hoa_dons.id_khach_hang')
            ->select('khach_hangs.ho_ten', 'hoa_dons.*')
            ->where('khach_hangs.ho_ten', 'like', $key)
            ->get();
        return response()->json([
            'data'  =>  $data,
            'status' => true
        ]);
    }
}
