<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuanHuyen extends Model
{
    use HasFactory;
    protected $table = "quan_huyens";
    protected $fillable = [
        'ten_quan_huyen',
        'id_tinh_thanh',
        'tinh_trang',
    ];
}
