<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KhachHang;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

class AccountClientController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required'
        ]);

        $khachHang = KhachHang::where('email', $request->email)->first();

        if (!$khachHang || !Hash::check($request->password, $khachHang->password)) {
            return response()->json([
                'status'  => false,
                'message' => 'Tài khoản hoặc mật khẩu không chính xác!'
            ]);
        }

        $token = $khachHang->createToken('token_client')->plainTextToken;

        return response()->json([
            'status'       => true,
            'message'      => 'Đăng nhập thành công',
            'token_client' => $token, 
            'khach_hang'   => $khachHang 
        ]);
    }

    public function checkTokenClient(Request $request)
    {
        $user = Auth::guard('sanctum')->user(); 

        if ($user) {
            return response()->json([
                'status'        => true,
                'ho_ten_client' => $user->ho_ten, 
                'khach_hang'    => $user 
            ], 200);
        }

        return response()->json([
            'status'  => false,
            'message' => 'Token không hợp lệ hoặc đã hết hạn'
        ], 401);
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->stateless()->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();
            
            $khachHang = KhachHang::updateOrCreate(
                ['email' => $googleUser->email], 
                [
                    'ho_ten'    => $googleUser->name,
                    'google_id' => $googleUser->id,
                    // 'password'  => bcrypt(Str::random(16)) 
                ]
            );

            $token = $khachHang->createToken('token_client')->plainTextToken;

            $frontend_url = 'https://ability-winking-defendant.ngrok-free.dev/client/google-callback';
            
            return redirect()->to($frontend_url . '?token=' . $token . '&name=' . urlencode($khachHang->ho_ten));

        } catch (\Exception $e) {
            \Log::error('Google Login Error: ' . $e->getMessage());
            return redirect()->to(' https://ability-winking-defendant.ngrok-free.dev/client/dang-nhap?error=google_failed');
        }
    }

    public function guiOTP(Request $request)
    {
        $kh = KhachHang::where('email', $request->email)->first();
        if (!$kh) {
            return response()->json(['status' => false, 'message' => 'Email không tồn tại trong hệ thống!']);
        }

        $otp = rand(100000, 999999);
        $kh->otp = $otp;
        $kh->otp_expire = Carbon::now()->addMinutes(5);
        $kh->save();

        Mail::send('emails.otp', ['otp' => $otp], function($message) use ($kh) {
            $message->to($kh->email)->subject('Mã xác nhận khôi phục mật khẩu - VivuTour');
        });

        return response()->json(['status' => true, 'message' => 'Mã OTP đã được gửi đến email của bạn!']);
    }

    public function xacThucOTP(Request $request)
    {
        $kh = KhachHang::where('email', $request->email)->first();
        if (!$kh || $kh->otp != $request->otp) {
            return response()->json(['status' => false, 'message' => 'Mã OTP không chính xác!']);
        }
        if (Carbon::now()->greaterThan($kh->otp_expire)) {
            return response()->json(['status' => false, 'message' => 'Mã OTP đã hết hạn!']);
        }

        return response()->json(['status' => true, 'message' => 'Xác thực thành công. Vui lòng nhập mật khẩu mới.']);
    }

    public function taoMatKhauMoi(Request $request)
    {
        $kh = KhachHang::where('email', $request->email)->first();
        if (!$kh || $kh->otp != $request->otp) {
            return response()->json(['status' => false, 'message' => 'Lỗi bảo mật. Yêu cầu không hợp lệ!']);
        }

        $kh->password = Hash::make($request->password_new);
        $kh->otp = null;
        $kh->otp_expire = null;
        $kh->save();

        return response()->json(['status' => true, 'message' => 'Đổi mật khẩu thành công! Bạn có thể đăng nhập.']);
    }

    public function guiOtpDangKy(Request $request)
    {
        $checkEmail = KhachHang::where('email', $request->email)->first();
        if ($checkEmail) {
            return response()->json(['status' => false, 'message' => 'Email này đã được sử dụng!']);
        }

        $otp = rand(100000, 999999);

        // Lưu OTP vào Cache với "chìa khóa" là email của khách, thời hạn 5 phút
        Cache::put('otp_register_' . $request->email, $otp, now()->addMinutes(5));

        // Gửi mail
        Mail::send('emails.otp_register', ['otp' => $otp], function($message) use ($request) {
            $message->to($request->email)->subject('Mã xác nhận đăng ký tài khoản - VivuTour');
        });

        return response()->json(['status' => true, 'message' => 'Mã OTP đã được gửi đến email của bạn.']);
    }

    // 2. Hàm Đăng ký (Đã được nâng cấp kiểm tra OTP)
    public function register(Request $request)
    {
        // 1. Lấy mã OTP trong Cache ra để đối chiếu
        $cachedOtp = Cache::get('otp_register_' . $request->email);

        // 2. Nếu Cache trống (hết hạn) hoặc mã khách nhập không khớp
        if (!$cachedOtp || $cachedOtp != $request->otp) {
            return response()->json(['status' => false, 'message' => 'Mã OTP không chính xác hoặc đã hết hạn!']);
        }

        // 3. Nếu đúng mã OTP -> Tạo tài khoản thật lưu vào Database
        $khach_hang = KhachHang::create([
            'ho_ten'        => $request->ho_ten,
            'email'         => $request->email,
            'so_dien_thoai' => $request->so_dien_thoai,
            'gioi_tinh'     => $request->gioi_tinh,
            'ngay_sinh'     => $request->ngay_sinh,
            'dia_chi'       => $request->dia_chi,
            'password'      => Hash::make($request->password),
        ]);

        // 4. Xóa OTP trong Cache đi cho sạch sẽ
        Cache::forget('otp_register_' . $request->email);

        return response()->json(['status' => true, 'message' => 'Đăng ký tài khoản thành công!']);
    }
}