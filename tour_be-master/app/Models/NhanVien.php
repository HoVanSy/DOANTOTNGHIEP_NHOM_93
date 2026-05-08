<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class NhanVien extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = "nhan_viens";
    protected $fillable = [
        'ho_ten',
        'ma_nhan_vien',
        'email',
        'so_dien_thoai',
        'password',
        'ngay_sinh',
        'id_chuc_vu',
        'tinh_trang',
        'is_master'
    ];
}
