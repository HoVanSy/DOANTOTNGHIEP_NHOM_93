<?php

namespace App\Http\Controllers;

use App\Models\ChiTietChucNang;
use App\Models\ChucNang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChucNangController extends Controller
{
    public function getData()
    {
        $id_chuc_nang   = 33;
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
        $data = ChucNang::get();
        return response()->json([
            'status'    =>  true,
            'chuc_nang' => $data
        ]);
    }
    public function searchChucNang(Request $request)
    {
        $id_chuc_nang   = 34;
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
        $data   = ChucNang::where('ten_chuc_nang', 'like', $noi_dung)
                           ->get();

        return response()->json([
            'status'    =>  true,
            'data'  =>  $data
        ]);

    }
}
