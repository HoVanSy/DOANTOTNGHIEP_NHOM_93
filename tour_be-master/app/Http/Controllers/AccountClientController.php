<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KhachHang;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

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
}