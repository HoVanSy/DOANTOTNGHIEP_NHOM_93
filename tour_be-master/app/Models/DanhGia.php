<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DanhGia extends Model
{
    use HasFactory;

    protected $table = 'danh_gias';

    protected $fillable = [
        'id_tour',
        'id_khach_hang',
        'so_sao',
        'noi_dung',
    ];
}