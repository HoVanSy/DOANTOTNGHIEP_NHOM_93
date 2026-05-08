<?php

namespace App\Http\Controllers;

use App\Http\Requests\KhachHangDangKyRequest;
use App\Models\ChiTietChucNang;
use App\Models\KhachHang;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Jenssegers\Agent\Agent;

class KhachHangController extends Controller
{
    public function index()
    {
        return view();
    }

    public function register(KhachHangDangKyRequest $request)
    {
        $user = KhachHang::where('email', $request->email)->first();

        if ($user) {
            return response()->json([
                'message'   =>  'Email đã tồn tại!',
                'status'    =>  false
            ]);
        }else{
            KhachHang::create([
                'email'         =>      $request->email,
                'ho_ten'        =>      $request->ho_ten,
                'password'      =>      bcrypt($request->password),
                'so_dien_thoai' =>      $request->so_dien_thoai,
                'dia_chi'       =>      $request->dia_chi,
                'ngay_sinh'     =>      $request->ngay_sinh,
                'gioi_tinh'     =>      $request->gioi_tinh,
            ]);
        }

        return response()->json([
            'message'   =>  'Đăng ký thành công!',
            'status'    =>  true
        ]);
    }

    public function login(Request $request)
    {
        $check  = Auth::guard('khach_hang')->attempt(['email' => $request->email, 'password' => $request->password]);
        // check sẽ trả về true hoặc false
        if ($check == true) {  // có
            // Lấy thông tin người đã đăng nhập
            $user  = Auth::guard('khach_hang')->user();
            $token = $user->createToken('api-token-client')->plainTextToken;
            return response()->json([
                'message'           =>  'Đăng nhập thành công!',
                'status'            =>  true,
                'token_client'      =>  $token,
                'user'              =>  $user,
                'id'                =>  $user->id
            ]);
        } else {
            return response()->json([
                'message'   =>  'Đăng nhập thất bại!',
                'status'    =>  false
            ]);
        }
    }

    // public function check(Request $request)
    // {
    //     $user = Auth::guard('sanctum')->user();
    //     if ($user) {
    //         $agent = new Agent();
    //         $device     = $agent->device();
    //         $os         = $agent->platform();
    //         $browser    = $agent->browser();

    //         $check_user =  DB::table('personal_access_tokens')
    //             ->where('id', $user->currentAccessToken()->id)
    //             ->first();

    //         if ($check_user->tokenable_type === "App\\Models\\KhachHang") {
    //             $user  = Auth::guard('khach_hang')->user();
    //             DB::table('personal_access_tokens')
    //                 ->where('id', $user->currentAccessToken()->id)
    //                 ->update([
    //                     'ip'            =>  request()->ip(),
    //                     'device'        =>  $device,
    //                     'os'            =>  $os,
    //                     'trinh_duyet'   =>  $browser,
    //                 ]);
    //             return response()->json([
    //                 'email'             =>  $user->email,
    //                 'ho_ten_client'     =>  $user->ho_ten,
    //                 'list'              =>  $user->tokens,
    //                 'id'                =>  $user->id
    //             ], 200);
    //         }

    //         return response()->json([
    //             'message'   =>  'Bạn cần đăng nhập!',
    //             'status'    =>  false,
    //         ], 401);
    //     } else {
    //         return response()->json([
    //             'message'   =>  'Bạn cần đăng nhập!',
    //             'status'    =>  false,
    //         ], 401);
    //     }
    // }
    public function check(Request $request)
    {
        $user = Auth::guard('sanctum')->user();
        
        if ($user) {
            $currentToken = $user->currentAccessToken();

            if ($currentToken && $currentToken->tokenable_type === "App\\Models\\KhachHang") {
                
                // (Tuỳ chọn) Lấy thông tin thiết bị, nếu bạn chưa cài package Agent thì có thể ẩn 3 dòng này đi
                // $agent = new \Jenssegers\Agent\Agent();
                // $device = $agent->device();
                // $os = $agent->platform();
                // $browser = $agent->browser();

                // Cập nhật thông tin IP vào bảng token
                \DB::table('personal_access_tokens')
                    ->where('id', $currentToken->id)
                    ->update([
                        'ip'            =>  request()->ip(),
                        // 'device'        =>  $device ?? null,
                        // 'os'            =>  $os ?? null,
                        // 'trinh_duyet'   =>  $browser ?? null,
                    ]);

                // Trả về dữ liệu cho VueJS
                return response()->json([
                    'email'             =>  $user->email,
                    'ho_ten_client'     =>  $user->ho_ten,
                    'list'              =>  $user->tokens,
                    'id'                =>  $user->id
                ], 200);
            }

            return response()->json([
                'message'   =>  'Token không hợp lệ!',
                'status'    =>  false,
            ], 401);
        } 

        return response()->json([
            'message'   =>  'Bạn cần đăng nhập!',
            'status'    =>  false,
        ], 401);
    }

    public function logout()
    {
        $user = Auth::guard('sanctum')->user();
        if ($user) {
            $check_user =  DB::table('personal_access_tokens')
                ->where('id', $user->currentAccessToken()->id)
                ->first();
            if ($check_user->tokenable_type === "App\\Models\\KhachHang") {
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

    public function checkToken()
    {
        // Lấy thông tin từ Authorization : 'Bearer ' gửi lên
        $user = Auth::guard('sanctum')->user();
        if ($user && $user instanceof \App\Models\KhachHang) {
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

    public function getdata()
    {
        $id_chuc_nang   = 35;
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
        $data = KhachHang::join('tinh_thanhs', 'tinh_thanhs.id', 'khach_hangs.dia_chi')
            ->select('khach_hangs.*', 'tinh_thanhs.ten_tinh_thanh')
            ->get();
        return response()->json([
            'status'    =>  true,
            'khach_hang'  =>  $data
        ]);
    }

    public function searchKhachHang(Request $request)
    {
        $id_chuc_nang   = 36;
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

        $data   = KhachHang::where('ho_ten', 'like', $key)
            ->orWhere('email', 'like', $key)
            ->orWhere('so_dien_thoai', 'like', $key)
            ->orWhere('ngay_sinh', 'like', $key)
            ->get();
        return response()->json([
            'status'    =>  true,
            'khach_hang'  =>  $data,
        ]);
    }

    public function createKhachHang(Request $request)
    {
        $id_chuc_nang   = 37;
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
        KhachHang::create($data);
        return response()->json([
            'status'    =>  true,
            'message'   =>  'Đã tạo mới khách hàng thành công!'
        ]);
    }

    public function deleteKhachHang($id)
    {
        $id_chuc_nang   = 38;
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
            KhachHang::where('id', $id)->delete();
            return response()->json([
                'status'            =>   true,
                'message'           =>   'Xóa khách hàng thành công!',
            ]);
        } catch (Exception $e) {
            Log::info("Lỗi", $e);
            return response()->json([
                'status'            =>   false,
                'message'           =>   'Có lỗi',
            ]);
        }
    }

    public function updateKhachHang(Request $request)
    {
        $id_chuc_nang   = 39;
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
            KhachHang::find($request->id)->update($data);
            return response()->json([
                'status'            =>   true,
                'message'           =>   'Đã cập nhật thành công khách hàng!',
            ]);
        } catch (Exception $e) {
            Log::info("Lỗi", $e);
            return response()->json([
                'status'            =>   false,
                'message'           =>   'Có lỗi',
            ]);
        }
    }

    public function doiTinhTrangKhachHang(Request $request)
    {
        $id_chuc_nang   = 40;
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
            KhachHang::where('id', $request->id)->update([
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
