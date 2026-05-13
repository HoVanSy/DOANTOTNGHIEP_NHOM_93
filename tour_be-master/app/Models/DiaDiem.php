<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiaDiem extends Model
{
    use HasFactory;
    protected $table = "dia_diems";
    protected $fillable = [
        'ten_dia_diem',
        'slug',
        'loai_dia_diem',
        'gia_tien',
        'is_open',
        'id_tinh_thanh',
        'id_quan_huyen',
        'toa_do_x',
        'toa_do_y',
        'link_anh',
    ];
}
