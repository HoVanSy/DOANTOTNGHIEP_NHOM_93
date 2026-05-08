<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChiTietHoaDon extends Model
{
    use HasFactory;

    protected $table = "chi_tiet_hoa_dons";
    protected $fillable = [
        "id_hoa_don",
        "id_tour",
        "thanh_tien",
        "tinh_trang"
    ];
    public function tour()
    {
        return $this->belongsTo(Tour::class, 'id_tour', 'id');
    }
}
