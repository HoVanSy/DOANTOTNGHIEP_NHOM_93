<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class KhachHang extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = "khach_hangs";
    protected $fillable = [
        "ho_ten",
        "email",
        "so_dien_thoai",
        "password",
        "ngay_sinh",
        "tinh_trang",
        "dia_chi",
        "gioi_tinh",
        "google_id",
        "otp", 
        "otp_expire",
    ];
}
