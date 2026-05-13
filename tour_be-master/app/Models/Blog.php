<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $table = 'blogs';

    protected $fillable = [
        'tieu_de',
        'hinh_anh',
        'noi_dung',
        'slug',
        'tac_gia',
        'tinh_trang',
    ];
}
