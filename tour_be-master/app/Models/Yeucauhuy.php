<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class YeuCauHuy extends Model
{
    protected $table = 'yeu_cau_huy';

    protected $fillable = [
        'ma_hd',
        'ma_kh',
        'loai_yc',
        'ly_do_yc',
        'trang_thai_yc',
        'ghi_chu_yc',
        'ngay_kh_moi',
    ];

    public function hoaDon()
    {
        return $this->belongsTo(HoaDon::class);
    }

    public function khachHang()
    {
        return $this->belongsTo(KhachHang::class);
    }
}
