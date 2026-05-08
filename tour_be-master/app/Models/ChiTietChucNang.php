<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChiTietChucNang extends Model
{
    use HasFactory;
    protected $table = "chi_tiet_chuc_nangs";
    protected $fillable = [
        "id_chuc_nang",
        "id_chuc_vu",
        "tinh_trang",
    ];
}
