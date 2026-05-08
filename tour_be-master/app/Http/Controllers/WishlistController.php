<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    // Lấy danh sách wishlist của khách hàng
    public function getWishlist(Request $request)
    {
        $khachHang = $request->user();
        $wishlists = Wishlist::with('tour')
            ->where('khach_hang_id', $khachHang->id)
            ->get();

        return response()->json([
            'status' => true,
            'data' => $wishlists
        ]);
    }

    // Thêm vào wishlist
    public function addToWishlist(Request $request)
    {
        $khachHang = $request->user();

        $exists = Wishlist::where('khach_hang_id', $khachHang->id)
            ->where('tour_id', $request->tour_id)
            ->first();

        if ($exists) {
            return response()->json([
                'status' => false,
                'message' => 'Tour đã có trong danh sách yêu thích!'
            ]);
        }

        Wishlist::create([
            'khach_hang_id' => $khachHang->id,
            'tour_id' => $request->tour_id,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Thêm vào wishlist thành công!'
        ]);
    }

    // Xóa khỏi wishlist
    public function removeFromWishlist(Request $request)
    {
        $khachHang = $request->user();

        Wishlist::where('khach_hang_id', $khachHang->id)
            ->where('tour_id', $request->tour_id)
            ->delete();

        return response()->json([
            'status' => true,
            'message' => 'Xóa khỏi wishlist thành công!'
        ]);
    }

    // Kiểm tra tour có trong wishlist không
    public function checkWishlist(Request $request)
    {
        $khachHang = $request->user();

        $exists = Wishlist::where('khach_hang_id', $khachHang->id)
            ->where('tour_id', $request->tour_id)
            ->exists();

        return response()->json([
            'status' => true,
            'is_wishlist' => $exists
        ]);
    }
}
