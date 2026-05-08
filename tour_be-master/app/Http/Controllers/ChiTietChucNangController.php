<?php

namespace App\Http\Controllers;

use App\Models\ChiTietChucNang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChiTietChucNangController extends Controller
{
    public function capQuyen(Request $request)
    {
        $id_chuc_nang   = 30;
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
        $quyen = ChiTietChucNang::where('id_chuc_vu', $request->id_chuc_vu)
            ->where('id_chuc_nang', $request->id_chuc_nang)
            ->first();
        if ($quyen) {
            return response()->json([
                'status'  => false,
                'message' => 'Quyền đã tồn tại!',
            ]);
        }

        ChiTietChucNang::create([
            'id_chuc_nang'      => $request->id_chuc_nang,
            'id_chuc_vu'        => $request->id_chuc_vu,
        ]);


        return response()->json([
            'status'    =>  true,
            'message'   =>  'Đã phân quyền thành công!'
        ]);
    }

    public function getDatact(Request $request)
    {
        $id_chuc_nang   = 31;
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
        $data   = ChiTietChucNang::join('chuc_nangs', 'chi_tiet_chuc_nangs.id_chuc_nang', 'chuc_nangs.id')
            ->join('chuc_vus', 'chi_tiet_chuc_nangs.id_chuc_vu', 'chuc_vus.id')
            ->select('chi_tiet_chuc_nangs.*', 'chuc_nangs.ten_chuc_nang', 'chuc_vus.ten_chuc_vu')
            ->get();

        return response()->json([
            'status'    =>  true,
            'chi_tiet_phan_quyen'    =>  $data,
        ]);
    }

    public function xoaQuyen(Request $request)
    {
        $id_chuc_nang   = 32;
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
        ChiTietChucNang::where('id', $request->id)->delete();

        return response()->json([
            'status'    =>  true,
            'message'   =>  'Đã xoá phân quyền thành công!'
        ]);
    }
}
