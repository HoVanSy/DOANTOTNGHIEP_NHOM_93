<?php

namespace App\Http\Controllers;

use App\Models\ChiTietChucNang;
use App\Models\DiaDiem;
use App\Models\TinhThanh;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class DiaDiemController extends Controller
{
    public function getdata()
    {
        $id_chuc_nang   = 19;
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
        $data = DiaDiem::join('tinh_thanhs', 'tinh_thanhs.id', 'dia_diems.id_tinh_thanh')
            ->join('quan_huyens', 'quan_huyens.id', 'dia_diems.id_quan_huyen')
            ->select('dia_diems.*', 'tinh_thanhs.ten_tinh_thanh', 'quan_huyens.ten_quan_huyen')
            ->get();
        return response()->json([
            'status'    =>  true,
            'dia_diem'  =>  $data
        ]);
    }
    public function searchDiaDiem(Request $request)
    {
        $id_chuc_nang   = 20;
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

        $data   = DiaDiem::join('tinh_thanhs', 'tinh_thanhs.id', 'dia_diems.id_tinh_thanh')
            ->join('quan_huyens', 'quan_huyens.id', 'dia_diems.id_quan_huyen')
            ->where('ten_dia_diem', 'like', $key)
            ->orWhere('slug', 'like', $key)
            ->orWhere('gia_tien', 'like', $key)
            ->orWhere('ten_tinh_thanh', 'like', $key)
            ->orWhere('ten_quan_huyen', 'like', $key)
            ->get();
        return response()->json([
            'status'    =>  true,
            'dia_diem'  =>  $data,
        ]);
    }

    public function createDiaDiem(Request $request)
    {
        $id_chuc_nang   = 21;
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
        DiaDiem::create($data);
        return response()->json([
            'status'    =>  true,
            'message'   =>  'Đã tạo mới địa điểm thành công!'
        ]);
    }

    public function deleteDiaDiem($id)
    {
        $id_chuc_nang   = 22;
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
            DiaDiem::where('id', $id)->delete();
            return response()->json([
                'status'            =>   true,
                'message'           =>   'Xóa địa điểm thành công!',
            ]);
        } catch (Exception $e) {
            Log::info("Lỗi", $e);
            return response()->json([
                'status'            =>   false,
                'message'           =>   'Có lỗi',
            ]);
        }
    }

    public function updateDiaDiem(Request $request)
    {
        $id_chuc_nang   = 23;
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
            DiaDiem::find($request->id)->update($data);
            return response()->json([
                'status'            =>   true,
                'message'           =>   'Đã cập nhật thành công địa điểm!',
            ]);
        } catch (Exception $e) {
            Log::info("Lỗi", $e);
            return response()->json([
                'status'            =>   false,
                'message'           =>   'Có lỗi',
            ]);
        }
    }

    public function doiTinhTrangDiaDiem(Request $request)
    {
        $id_chuc_nang   = 24;
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
            if ($request->is_open == 1) {
                $tinh_trang_moi = 0;
            } else {
                $tinh_trang_moi = 1;
            }
            DiaDiem::where('id', $request->id)->update([
                'is_open'    =>  $tinh_trang_moi
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
    public function getDataClient()
    {
        $data = DiaDiem::join('tinh_thanhs', 'tinh_thanhs.id', 'dia_diems.id_tinh_thanh')
            ->select('dia_diems.*', 'tinh_thanhs.ten_tinh_thanh')
            ->get();
        // join('tinh_thanhs', 'tinh_thanhs.id','dia_diems.id_tinh_thanh')
        //                 ->join('quan_huyens', 'quan_huyens.id','dia_diems.id_quan_huyen')
        //                 ->select('dia_diems.*','tinh_thanhs.ten_tinh_thanh','quan_huyens.ten_quan_huyen')


        return response()->json([
            'status'        =>  true,
            'dia_diem_client'  =>  $data,
        ]);
    }
    public function getDataClientTimKiem(Request $request)
    {
        // $key = "%" . $request->abc . "%";
        $query = DiaDiem::join('tinh_thanhs', 'tinh_thanhs.id', 'dia_diems.id_tinh_thanh');
        if (!empty($request->loai_dd)) {
            $query->where('loai_dia_diem', $request->loai_dd);
        }
        if (!empty($request->tinh_thanh)) {
            $key2 = "%" . $request->tinh_thanh . "%";
            $query->where('ten_tinh_thanh', 'like', $key2);
        }
        if (!empty($request->min_price)) {
            $query->where('gia_tien', '>=', $request->min_price);
        }
        if (!empty($request->max_price)) {
            $query->where('gia_tien', '<=', $request->max_price);
        }
        // Note: ngay_khoi_hanh, so_ngay, so_nguoi not available in DiaDiem model
        $data = $query->select('dia_diems.*', 'tinh_thanhs.ten_tinh_thanh')->get();

        return response()->json([
            'status'    =>  true,
            'tim_kiem'  =>  $data
        ]);
    }
}
