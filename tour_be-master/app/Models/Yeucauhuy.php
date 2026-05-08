<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class YeuCauHuy extends Model
{
    use HasFactory;

    protected $table = 'yeu_cau_huy'; 

    protected $fillable = [
        'hoa_don_id', 
        'khach_hang_id', 
        'loai_yeu_cau', 
        'ly_do', 
        'ngay_khoi_hanh_moi', 
        'trang_thai', 
        'ghi_chu'
    ];

    // Móc nối để lấy thông tin Hóa Đơn
    public function hoaDon()
    {
        return $this->belongsTo(HoaDon::class, 'hoa_don_id', 'id');
    }

    // Móc nối để lấy thông tin Khách Hàng (nếu cần dùng cho Admin)
    public function khachHang()
    {
        return $this->belongsTo(KhachHang::class, 'khach_hang_id', 'id');
    }
}