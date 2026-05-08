<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{
    use HasFactory;
    protected $table = "tours";
    protected $fillable = [
        'tieu_de',
        'slug',
        'ngay_bat_dau',
        'ngay_ket_thuc',
        'mo_ta',
        'mo_ta_chi_tiet',
        'gia_nguoi_lon',
        'gia_tre_em',
        'tinh_trang',
        'so_luong_khach',
        'is_khach_hang_dat',
        'id_nhan_vien',
        'link_anh',
    ];
}
