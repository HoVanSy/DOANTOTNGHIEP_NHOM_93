<?php

namespace App\Http\Controllers;

use App\Models\ChiTietChucNang;
use App\Models\ChucVu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChucVuController extends Controller
{
    public function getdata()
    {
        $id_chuc_nang   = 25;
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
        $data = ChucVu::get();
        return response()->json([
            'status'    =>  true,
            'chuc_vu'  =>  $data
        ]);
    }
    public function searchChucVu(Request $request)
    {
        $id_chuc_nang   = 26;
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
        $noi_dung   = '%' . $request->abc . '%';
        $data   = ChucVu::where('ten_chuc_vu', 'like', $noi_dung)
            ->get();

        return response()->json([
            'status'    =>  true,
            'data'  =>  $data
        ]);
    }
    public function createChucVu(Request $request)
    {
        $id_chuc_nang   = 27;
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
        if (empty($request->ten_chuc_vu) || trim($request->ten_chuc_vu) === '') {
            return response()->json([
                'status'    => false,
                'message'   => 'Tên chức vụ không được để trống!'
            ]);
        }
        ChucVu::create([
            'ten_chuc_vu'         => $request->ten_chuc_vu,
        ]);
        return response()->json([
            'status'    => true,
            'message'   => 'Thêm mới chức vụ thành công!'
        ]);
    }
    public function updateChucVu(Request $request)
    {
        $id_chuc_nang   = 29;
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
        
        $ten_chuc_vu = ChucVu::where('id', $request->id)->first();
        if ($ten_chuc_vu) {
            $ten_chuc_vu->update([
                'ten_chuc_vu'             => $request->ten_chuc_vu,
            ]);

            return response()->json([
                'status' => true,
                'message' => "Cập Nhật chức vụ thành công!"
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => "Có Lỗi"
            ]);
        }
    }
    public function deleteChucVu($id)
    {
        $id_chuc_nang   = 28;
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
        $ten_chuc_vu = ChucVu::where('id', $id)->first();
        if ($ten_chuc_vu) {
            $ten_chuc_vu->delete();
            return response()->json([
                'status' => true,
                'message' => "Đã xóa chức vụ thành công!"
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => "Có Lỗi"
            ]);
        }
    }
}
