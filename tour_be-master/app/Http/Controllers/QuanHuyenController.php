<?php

namespace App\Http\Controllers;

use App\Models\ChiTietChucNang;
use App\Models\QuanHuyen;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class QuanHuyenController extends Controller
{

    public function getdata(){
        $id_chuc_nang   = 7;
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
        $data = QuanHuyen::join('tinh_thanhs', 'quan_huyens.id_tinh_thanh','tinh_thanhs.id')
                        ->select('quan_huyens.*','tinh_thanhs.ten_tinh_thanh')
                        ->get();
        return response()->json([
            'status'    =>  true,
            'quan_huyen'  =>  $data
        ]);
    }
    public function searchQuanHuyen(Request $request)
    {
        $id_chuc_nang   = 8;
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

        $data   = QuanHuyen::join('tinh_thanhs', 'quan_huyens.id_tinh_thanh','tinh_thanhs.id')
                            ->select('quan_huyens.*','tinh_thanhs.ten_tinh_thanh')
                            ->where('ten_quan_huyen', 'like', $key)
                            ->orWhere('ten_quan_huyen', 'like', $key)
                            ->orWhere('ten_tinh_thanh', 'like', $key)
                            ->get();

        return response()->json([
            'status'    =>  true,
            'quan_huyen'  =>  $data,
        ]);
    }

    public function createQuanHuyen(Request $request)
    {
        $id_chuc_nang   = 9;
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
        QuanHuyen::create($data);
        return response()->json([
            'status'    =>  true,
            'message'   =>  'Đã tạo mới Quận/Huyện thành công!'
        ]);
    }

    public function deleteQuanHuyen($id)
    {
        $id_chuc_nang   = 10;
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
            QuanHuyen::where('id', $id)->delete();
            return response()->json([
                'status'            =>   true,
                'message'           =>   'Xóa Quận/Huyện thành công!',
            ]);
        } catch (Exception $e) {
            Log::info("Lỗi", $e);
            return response()->json([
                'status'            =>   false,
                'message'           =>   'Có lỗi',
            ]);
        }
    }

    public function updateQuanHuyen(Request $request)
    {
        $id_chuc_nang   = 11;
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
            QuanHuyen::find($request->id)->update($data);
            return response()->json([
                'status'            =>   true,
                'message'           =>   'Đã cập nhật thành công Quận/Huyện',
            ]);
        } catch (Exception $e) {
            Log::info("Lỗi", $e);
            return response()->json([
                'status'            =>   false,
                'message'           =>   'Có lỗi',
            ]);
        }
    }

    public function doiTinhTrangQuanHuyen(Request $request)
    {
        $id_chuc_nang   = 12;
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
            if($request->tinh_trang == 1){
                $tinh_trang_moi = 0;
            } else {
                $tinh_trang_moi = 1;
            }
            QuanHuyen::where('id', $request->id)->update([
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
}
