<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KhuyenMai extends Model
{
    // Khai báo đúng tên bảng trong database của bạn
    protected $table = 'khuyen_mais'; 

    protected $fillable = [
        'ma_code',
        'loai',
        'gia_tri',
        'don_hang_toi_thieu',
        'ngay_ket_thuc',
        'tinh_trang',
    ];
}