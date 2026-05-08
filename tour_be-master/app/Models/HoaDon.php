<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HoaDon extends Model
{
    use HasFactory;

    protected $table = "hoa_dons";
    protected $fillable = [
        "ma_hoa_don",
        "id_khach_hang",
        "tong_tien",
        "so_luong_nguoi_lon",
        "so_luong_tre_em",
        "tinh_trang"
    ];
}
