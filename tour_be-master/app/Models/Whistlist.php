<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Wishlist extends Model
{
    protected $table = 'wishlist';

    protected $fillable = [
        'ma_kh',
        'ma_tour',
    ];

    public function khachHang()
    {
        return $this->belongsTo(KhachHang::class);
    }

    public function tour()
    {
        return $this->belongsTo(Tour::class);
    }
}
