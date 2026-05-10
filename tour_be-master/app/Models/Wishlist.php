<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Wishlist extends Model
{
    protected $table = 'wishlists';

    protected $fillable = [
        'khach_hang_id',
        'tour_id',
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
