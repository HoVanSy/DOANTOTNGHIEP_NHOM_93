<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChiTietTour extends Model
{
    use HasFactory;
    protected $table = "chi_tiet_tours";
    protected $fillable = [
        'id_tour',
        'id_dia_diem',
        'thanh_tien',
        'tinh_trang',
        //a
    ];
}
