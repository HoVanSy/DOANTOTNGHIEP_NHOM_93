<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LichTrinhTour extends Model
{
    use HasFactory;
    protected $table = "lich_trinh_tours";
    protected $fillable = [
        'id_tour',
        'so_ngay',
        'tieu_de',
        'mo_ta',
        'dia_diem_di',
        'dia_diem_den',
        'phuong_tien',
        'gio_khoi_hanh',
        'gio_ket_thuc',
        'anh_lich_trinh',
        'tinh_trang',
    ];
    
    public function tour()
    {
        return $this->belongsTo(Tour::class, 'id_tour', 'id');
    }
}
