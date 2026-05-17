<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    // Lấy danh sách blog cho client
    public function getDataClient()
    {
        $data = Blog::where('tinh_trang', 1)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'status' => true,
            'data' => $data
        ]);
    }

    // Lấy chi tiết blog
    public function getChiTietBlog($id)
    {
        $blog = Blog::find($id);

        return response()->json([
            'status' => true,
            'data' => $blog
        ]);
    }

    // Lấy danh sách blog cho admin
    public function getDataAdmin()
    {
        $data = Blog::orderBy('created_at', 'desc')->get();

        return response()->json([
            'status' => true,
            'data' => $data
        ]);
    }

    // Tạo blog mới
    public function createBlog(Request $request)
    {
        Blog::create([
            'tieu_de' => $request->tieu_de,
            'hinh_anh' => $request->hinh_anh,
            'noi_dung' => $request->noi_dung,
            'slug' => \Illuminate\Support\Str::slug($request->tieu_de),
            'tac_gia' => $request->tac_gia,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Tạo blog thành công!'
        ]);
    }

    // Cập nhật blog
    public function updateBlog(Request $request)
    {
        $blog = Blog::find($request->id);
        $blog->update([
            'tieu_de' => $request->tieu_de,
            'hinh_anh' => $request->hinh_anh,
            'noi_dung' => $request->noi_dung,
            'slug' => \Illuminate\Support\Str::slug($request->tieu_de),
            'tac_gia' => $request->tac_gia,
            'tinh_trang' => $request->tinh_trang,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Cập nhật blog thành công!'
        ]);
    }

    // Xóa blog
    public function deleteBlog($id)
    {
        Blog::find($id)->delete();

        return response()->json([
            'status' => true,
            'message' => 'Xóa blog thành công!'
        ]);
    }

    public function layTinTucMoiNhat()
    {
        $data = Blog::where('tinh_trang', 1) 
                    ->orderBy('id', 'desc') 
                    ->take(4)
                    ->get();

        return response()->json([
            'status' => true,
            'data'   => $data
        ]);
    }
}
