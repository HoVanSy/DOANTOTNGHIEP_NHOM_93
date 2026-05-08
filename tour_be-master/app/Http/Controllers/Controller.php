<?php

namespace App\Http\Controllers;

use App\Models\ChiTietChucNang;
use App\Models\HoaDon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    public function getdata()
    {
        $data = HoaDon::get();
        return response()->json([
            'status'    =>  true,
            'hoa_don'  =>  $data
        ]);
    }
}
