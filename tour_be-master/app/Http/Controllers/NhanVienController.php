<?php

namespace App\Http\Controllers;

use App\Models\ChiTietChucNang;
use App\Models\NhanVien;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Jenssegers\Agent\Agent;

class NhanVienController extends Controller
{
    public function getdata(){
        $id_chuc_nang   = 13;
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
        $data = NhanVien::join('chuc_vus', 'chuc_vus.id', 'nhan_viens.id_chuc_vu')
                        ->select('nhan_viens.*', 'chuc_vus.ten_chuc_vu')
                        ->get();
        return response()->json([
            'status'    =>  true,
            'nhan_vien'  =>  $data
        ]);
    }
    public function searchNhanVien(Request $request)
    {
        $id_chuc_nang   = 14;
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

        $data   = NhanVien::where('ho_ten', 'like', $key)
                            ->orWhere('ma_nhan_vien', 'like', $key)
                            ->orWhere('email', 'like', $key)
                            ->orWhere('so_dien_thoai', 'like', $key)
                            ->orWhere('ngay_sinh', 'like', $key)
                            ->get();
        return response()->json([
            'status'    =>  true,
            'nhan_vien'  =>  $data,
        ]);
    }

    public function createNhanVien(Request $request)
    {
        $id_chuc_nang   = 15;
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
        NhanVien::create($data);
        return response()->json([
            'status'    =>  true,
            'message'   =>  'Đã tạo mới nhân viên thành công!'
        ]);
    }

    public function deleteNhanVien($id)
    {
        $id_chuc_nang   = 16;
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
            NhanVien::where('id', $id)->delete();
            return response()->json([
                'status'            =>   true,
                'message'           =>   'Xóa nhân viên thành công!',
            ]);
        } catch (Exception $e) {
            Log::info("Lỗi", $e);
            return response()->json([
                'status'            =>   false,
                'message'           =>   'Có lỗi',
            ]);
        }
    }

    public function updateNhanVien(Request $request)
    {
        $id_chuc_nang   = 17;
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
            NhanVien::find($request->id)->update($data);
            return response()->json([
                'status'            =>   true,
                'message'           =>   'Đã cập nhật thành công nhân viên!',
            ]);
        } catch (Exception $e) {
            Log::info("Lỗi", $e);
            return response()->json([
                'status'            =>   false,
                'message'           =>   'Có lỗi',
            ]);
        }
    }

    public function doiTinhTrangNhanVien(Request $request)
    {
        $id_chuc_nang   = 18;
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
            NhanVien::where('id', $request->id)->update([
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

    public function login(Request $request)
    {
        $check  = Auth::guard('nhan_vien')->attempt(['email' => $request->email, 'password' => $request->password]);
        // check sẽ trả về true hoặc false
        if ($check == true) {  // có
            // Lấy thông tin người đã đăng nhập
            $user  = Auth::guard('nhan_vien')->user();
            $token = $user->createToken('api-token-nhanvien')->plainTextToken;
            return response()->json([
                'message'   =>  'Đăng nhập thành công!',
                'status'    =>  true,
                'token'     =>  $token,
                'user'      =>  $user,
            ]);
        } else {
            return response()->json([
                'message'   =>  'Đăng nhập không thành công!',
                'status'    =>  false
            ]);
        }
    }

    public function check(Request $request)
    {
        $user = Auth::guard('sanctum')->user();
        if ($user) {
            $agent = new Agent();
            $device     = $agent->device();
            $os         = $agent->platform();
            $browser    = $agent->browser();

            $check_user =  DB::table('personal_access_tokens')
                ->where('id', $user->currentAccessToken()->id)
                ->first();

            if ($check_user->tokenable_type === "App\\Models\\NhanVien") {
                DB::table('personal_access_tokens')
                    ->where('id', $user->currentAccessToken()->id)
                    ->update([
                        'ip'            =>  request()->ip(),
                        'device'        =>  $device,
                        'os'            =>  $os,
                        'trinh_duyet'   =>  $browser,
                    ]);
                return response()->json([
                    'email'     =>  $user->email,
                    'ho_ten'    =>  $user->ho_ten,
                    'list'      =>  $user->tokens,
                ], 200);
            }

            return response()->json([
                'message'   =>  'Bạn Chưa Đăng Nhập ADMIN',
                'status'    =>  false,
            ], 401);
        } else {
            return response()->json([
                'message'   =>  'Bạn Cần Đăng Nhập Hệ Thống',
                'status'    =>  false,
            ], 401);
        }
    }

    public function logout()
    {
        $user = Auth::guard('sanctum')->user();
        if ($user) {
            $check_user =  DB::table('personal_access_tokens')
                            ->where('id', $user->currentAccessToken()->id)
                            ->first();
            if($check_user->tokenable_type === "App\\Models\\NhanVien") {
                DB::table('personal_access_tokens')
                    ->where('id', $user->currentAccessToken()->id)
                    ->delete();
                return response()->json([
                    'message'   =>  'Đăng xuất thành công!',
                    'status'    =>  true,
                ], 200);
            }

            return response()->json([
                'message'   =>  'Bạn cần đăng nhập!',
                'status'    =>  false,
            ], 401);
        } else {
            return response()->json([
                'message'   =>  'Bạn cần đăng nhập!',
                'status'    =>  false,
            ]);
        }
    }

    public function logoutAll()
    {
        $user = Auth::guard('sanctum')->user();
        if ($user) {
            $tokens = $user->tokens;
            foreach ($tokens as $key => $value) {
                $value->delete();
            }

            return response()->json([
                'message'   =>  'Đã đăng xuất tất cả thành công!',
                'status'    =>  true,
            ]);
        } else {
            return response()->json([
                'message'   =>  'Bạn cần đăng nhập hệ thống',
                'status'    =>  false,
            ]);
        }
    }
    public function checkToken()
    {
        // Lấy thông tin từ Authorization : 'Bearer ' gửi lên
        $user = Auth::guard('sanctum')->user();
        if($user && $user instanceof \App\Models\NhanVien) {
            return response()->json([
                'status'    =>  true,
                'message'   =>  "Oke, bạn có thể đi qua",
            ]);
        } else {
            return response()->json([
                'status'    =>  false,
                'message'   =>  "Bạn cần đăng nhập hệ thống trước",
            ]);
        }
    }

}
