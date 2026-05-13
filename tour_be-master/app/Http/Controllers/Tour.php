<?php

namespace App\Http\Controllers;

use App\Models\ChiTietChucNang;
use App\Models\ChiTietTour;
<<<<<<< HEAD
=======
use App\Models\LichTrinhTour;
>>>>>>> master
use App\Models\Tour as ModelsTour;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class Tour extends Controller
{

    public function getdata()
    {
        $id_chuc_nang   = 41;
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
        $data = ModelsTour::get();
        return response()->json([
            'status' => true,
            'tour'  =>  $data
        ]);
    }

    public function searchTour(Request $request)
    {
        $id_chuc_nang   = 42;
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
        $key = "%" . $request->abc . "%";

        $data   = ModelsTour::where('tieu_de', 'like', $key)
            ->get();
        return response()->json([
            'status' => true,
            'tour'  =>  $data,
        ]);
    }

    public function createTour(Request $request)
    {
        $id_chuc_nang   = 43;
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
        $data   =   $request->all();
        ModelsTour::create($data);
        return response()->json([
            'status'    =>  true,
            'message'   =>  'Đã tạo mới tour thành công!'
        ]);
    }

    public function deleteTour($id)
    {
        $id_chuc_nang   = 44;
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
            ModelsTour::where('id', $id)->delete();
            return response()->json([
                'status'            =>   true,
                'message'           =>   'Xóa tour thành công!',
            ]);
        } catch (Exception $e) {
            Log::info("Lỗi", $e);
            return response()->json([
                'status'            =>   false,
                'message'           =>   'Có lỗi',
            ]);
        }
    }

    public function updateTour(Request $request)
    {
        $id_chuc_nang   = 45;
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
            $data   = $request->all();
            ModelsTour::find($request->id)->update($data);
            return response()->json([
                'status'            =>   true,
                'message'           =>   'Đã cập nhật thành công tour!',
            ]);
        } catch (Exception $e) {
            Log::info("Lỗi", $e);
            return response()->json([
                'status'            =>   false,
                'message'           =>   'Có lỗi',
            ]);
        }
    }

    public function doiTinhTrangTour(Request $request)
    {
        $id_chuc_nang   = 46;
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
            if ($request->tinh_trang == 1) {
                $tinh_trang_moi = 0;
            } else {
                $tinh_trang_moi = 1;
            }
            ModelsTour::where('id', $request->id)->update([
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

    //client
    public function clientGetChiTietTour(Request $request)
    {
        $data = ChiTietTour::join('dia_diems', 'dia_diems.id', 'chi_tiet_tours.id_dia_diem')
            ->join('tours', 'chi_tiet_tours.id_tour', 'tours.id')
            ->join('tinh_thanhs', 'tinh_thanhs.id', 'dia_diems.id_tinh_thanh')
            ->join('quan_huyens', 'quan_huyens.id', 'dia_diems.id_quan_huyen')
            ->where('chi_tiet_tours.id_tour', $request->id)
            ->select(
<<<<<<< HEAD
=======
                'tours.id as id_tour',
>>>>>>> master
                'tours.link_anh as anh_tour',
                'tours.tieu_de as tieu_de_tour',
                'tours.ngay_bat_dau',
                'tours.ngay_ket_thuc',
                'tours.mo_ta',
                'tours.mo_ta_chi_tiet',
                'tours.gia_nguoi_lon',
                'tours.gia_tre_em',
                'dia_diems.*',
                'chi_tiet_tours.*',
                'tinh_thanhs.ten_tinh_thanh',
                'quan_huyens.ten_quan_huyen'
            )->get();
<<<<<<< HEAD
        return response()->json([
            'chi_tiet_tour' =>  $data,
=======
        
        $lich_trinh = [];
        if ($request->id) {
            $lich_trinh = LichTrinhTour::where('id_tour', $request->id)
                ->orderBy('so_ngay')
                ->get();
        }
        
        return response()->json([
            'chi_tiet_tour' =>  $data,
            'lich_trinh' => $lich_trinh,
>>>>>>> master
            'status'        =>  true
        ]);
    }
    public function getDataClient()
    {
        $data = ModelsTour::get();
        return response()->json([
            'status' => true,
            'tour_client'  =>  $data
        ]);
    }

    // Client search tour by keyword
    public function searchTourClient(Request $request)
    {
        $keyword = "%" . $request->keyword . "%";
        $minPrice = $request->min_price ?? 0;
        $maxPrice = $request->max_price ?? PHP_INT_MAX;

        $query = ModelsTour::where('tieu_de', 'like', $keyword)
                ->orWhere('mo_ta', 'like', $keyword)
                ->whereBetween('gia_nguoi_lon', [$minPrice, $maxPrice]);

        $data = $query->get();

        return response()->json([
            'status' => true,
            'tours' => $data,
            'count' => $data->count()
        ]);
    }

    // Get price range for filter
    public function getTourPriceRange()
    {
        $minPrice = ModelsTour::min('gia_nguoi_lon') ?? 0;
        $maxPrice = ModelsTour::max('gia_nguoi_lon') ?? 0;

        return response()->json([
            'status' => true,
            'min_price' => $minPrice,
            'max_price' => $maxPrice
        ]);
    }
}
