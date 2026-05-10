<?php

use App\Http\Controllers\ChiTietChucNangController;
use App\Http\Controllers\ChucNangController;
use App\Http\Controllers\ChucVuController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\DiaDiemController;
use App\Http\Controllers\HoaDonController;
use App\Http\Controllers\KhachHangController;
use App\Http\Controllers\NhanVienController;
use App\Http\Controllers\QuanHuyenController;
use App\Http\Controllers\TinhThanhController;
use App\Http\Controllers\Tour;
use App\Models\HoaDon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ChatbotController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\YeuCauHuyController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ThongKeController;

Route::get('/blog/lay-du-lieu', [BlogController::class, 'getDataClient']);
Route::get('/blog/chi-tiet/{id}', [BlogController::class, 'getChiTietBlog']);

Route::post('/client/yeu-cau-huy/tao', [YeuCauHuyController::class, 'createYeuCau']);
Route::get('/client/yeu-cau-huy/lay-danh-sach', [YeuCauHuyController::class, 'getYeuCauClient']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix'  =>  '/account-admin'], function () {
    Route::post('/login', [NhanVienController::class, 'login']);
    Route::post('/register', [NhanVienController::class, 'register']);
    Route::post('/check', [NhanVienController::class, 'check']);
    Route::get('/dang-xuat', [NhanVienController::class, 'logout']);
    Route::get('/dang-xuat-tat-ca', [NhanVienController::class, 'logoutAll']);
    Route::get('/kiem-tra-token-client', [NhanVienController::class, 'checkToken']);
});

Route::group(['prefix'  =>  '/admin'], function () {
    Route::group(['prefix'  =>  '/tinh-thanh'], function () {
        Route::get('/lay-du-lieu', [TinhThanhController::class, 'getData']);
        Route::post('/tim-tinh-thanh', [TinhThanhController::class, 'searchTinhThanh']);
        Route::post('/them-moi-tinh-thanh', [TinhThanhController::class, 'createTinhThanh']);
        Route::delete('/xoa-tinh-thanh/{id}', [TinhThanhController::class, 'deleteTinhThanh']);
        Route::post('/cap-nhat-tinh-thanh', [TinhThanhController::class, 'updateTinhThanh']);
        Route::post('/doi-tinh-trang-tinh-thanh', [TinhThanhController::class, 'doiTinhTrangTinhThanh']);
    });
    Route::group(['prefix'  =>  '/quan-huyen'], function () {
        Route::get('/lay-du-lieu', [QuanHuyenController::class, 'getData']);
        Route::post('/tim-quan-huyen', [QuanHuyenController::class, 'searchQuanHuyen']);
        Route::post('/them-moi-quan-huyen', [QuanHuyenController::class, 'createQuanHuyen']);
        Route::delete('/xoa-quan-huyen/{id}', [QuanHuyenController::class, 'deleteQuanHuyen']);
        Route::post('/cap-nhat-quan-huyen', [QuanHuyenController::class, 'updateQuanHuyen']);
        Route::post('/doi-tinh-trang-quan-huyen', [QuanHuyenController::class, 'doiTinhTrangQuanHuyen']);
    });
    Route::group(['prefix'  =>  '/nhan-vien'], function () {
        Route::get('/lay-du-lieu', [NhanVienController::class, 'getData']);
        Route::post('/tim-nhan-vien', [NhanVienController::class, 'searchNhanVien']);
        Route::post('/them-moi-nhan-vien', [NhanVienController::class, 'createNhanVien']);
        Route::delete('/xoa-nhan-vien/{id}', [NhanVienController::class, 'deleteNhanVien']);
        Route::post('/cap-nhat-nhan-vien', [NhanVienController::class, 'updateNhanVien']);
        Route::post('/doi-tinh-trang-nhan-vien', [NhanVienController::class, 'doiTinhTrangNhanVien']);
    });
    Route::group(['prefix'  =>  '/dia-diem'], function () {
        Route::get('/lay-du-lieu', [DiaDiemController::class, 'getData']);
        Route::post('/tim-dia-diem', [DiaDiemController::class, 'searchDiaDiem']);
        Route::post('/them-moi-dia-diem', [DiaDiemController::class, 'createDiaDiem']);
        Route::delete('/xoa-dia-diem/{id}', [DiaDiemController::class, 'deleteDiaDiem']);
        Route::post('/cap-nhat-dia-diem', [DiaDiemController::class, 'updateDiaDiem']);
        Route::post('/doi-tinh-trang-dia-diem', [DiaDiemController::class, 'doiTinhTrangDiaDiem']);
    });
    Route::group(['prefix'  =>  '/chuc-vu'], function () {
        Route::get('/lay-du-lieu', [ChucVuController::class, 'getData']);
        Route::post('/tim-chuc-vu', [ChucVuController::class, 'searchChucVu']);
        Route::post('/them-moi-chuc-vu', [ChucVuController::class, 'createChucVu']);
        Route::delete('/xoa-chuc-vu/{id}', [ChucVuController::class, 'deleteChucVu']);
        Route::post('/cap-nhat-chuc-vu', [ChucVuController::class, 'updateChucVu']);
    });
    Route::group(['prefix'  =>  '/chi-tiet-chuc-nang'], function () {
        Route::post('/cap-quyen', [ChiTietChucNangController::class, 'capQuyen']);
        Route::post('/lay-du-lieu', [ChiTietChucNangController::class, 'getDatact']);
        Route::post('/xoa-quyen', [ChiTietChucNangController::class, 'xoaQuyen']);
    });
    Route::group(['prefix'  =>  '/chuc-nang'], function () {
        Route::get('/lay-du-lieu', [ChucNangController::class, 'getData']);
        Route::post('/tim-chuc-nang', [ChucNangController::class, 'searchChucNang']);
    });
    Route::group(['prefix'  =>  '/khach-hang'], function () {
        Route::get('/lay-du-lieu', [KhachHangController::class, 'getData']);
        Route::post('/tim-khach-hang', [KhachHangController::class, 'searchKhachHang']);
        Route::post('/them-moi-khach-hang', [KhachHangController::class, 'createKhachHang']);
        Route::delete('/xoa-khach-hang/{id}', [KhachHangController::class, 'deleteKhachHang']);
        Route::post('/cap-nhat-khach-hang', [KhachHangController::class, 'updateKhachHang']);
        Route::post('/doi-tinh-trang-khach-hang', [KhachHangController::class, 'doiTinhTrangKhachHang']);
    });
    Route::group(['prefix'  =>  '/tour'], function () {
        Route::get('/lay-du-lieu', [Tour::class, 'getData']);
        Route::post('/tim-tour', [Tour::class, 'searchTour']);
        Route::post('/them-moi-tour', [Tour::class, 'createTour']);
        Route::delete('/xoa-tour/{id}', [Tour::class, 'deleteTour']);
        Route::post('/cap-nhat-tour', [Tour::class, 'updateTour']);
        Route::post('/doi-tinh-trang-tour', [Tour::class, 'doiTinhTrangTour']);
    });
    Route::group(['prefix'  =>  '/hoa-don'], function () {
        Route::get('/lay-du-lieu', [HoaDonController::class, 'getData']);
        Route::post('/doi-tinh-trang-hoa-don', [HoaDonController::class, 'doiTinhTrangHoaDon']);
        Route::post('/xac-nhan-hoa-don', [HoaDonController::class, 'xacNhanHoaDonAdmin']);
        Route::post('/huy-hoa-don', [HoaDonController::class, 'huyHoaDonAdmin']);
        Route::delete('/xoa-hoa-don/{id}', [HoaDonController::class, 'deleteHoaDon']);
        Route::post('/tim-hoa-don', [HoaDonController::class, 'searchHoaDonAdmin']);
    });
    // Blog
    Route::get('/blog/lay-du-lieu', [BlogController::class, 'getDataAdmin']);
    Route::post('/blog/them-moi', [BlogController::class, 'createBlog']);
    Route::post('/blog/cap-nhat', [BlogController::class, 'updateBlog']);
    Route::delete('/blog/xoa/{id}', [BlogController::class, 'deleteBlog']);

     // Yeu cau huy
    Route::get('/yeu-cau-huy/lay-du-lieu', [YeuCauHuyController::class, 'getYeuCauAdmin']);
    Route::post('/yeu-cau-huy/duyet', [YeuCauHuyController::class, 'duyetYeuCau']);
    Route::post('/yeu-cau-huy/tu-choi', [YeuCauHuyController::class, 'tuChoiYeuCau']);

    // Thong ke bao cao
    Route::get('/thong-ke/tong-quan', [ThongKeController::class, 'getThongKeTongQuan']);
    Route::get('/thong-ke/doanh-thu', [ThongKeController::class, 'getThongKeDoanhThu']);
    // Test route
    Route::get('/test-thong-ke', [ThongKeController::class, 'getThongKeTongQuan']);
});

// Client
Route::group(['prefix'  =>  '/account-client'], function () {
    Route::post('/login', [KhachHangController::class, 'login']);
    Route::post('/register', [KhachHangController::class, 'register']);
    Route::post('/check', [KhachHangController::class, 'check']);
    Route::get('/logout', [KhachHangController::class, 'logout']);
    Route::get('/kiem-tra-token-client', [KhachHangController::class, 'checkToken']);
    Route::get('/profile', [KhachHangController::class, 'getProfile'])->middleware('auth:sanctum');
    Route::post('/update-profile', [KhachHangController::class, 'updateProfile'])->middleware('auth:sanctum');
});

Route::get('/client/lay-du-lieu-tinh-thanh', [TinhThanhController::class, 'getDataClient']);
Route::get('/tour/lay-du-lieu-client', [Tour::class, 'getDataClient']);

// client
Route::group(['prefix'  =>  '/client'], function () {
    Route::post('/hoa-don/dat-tour', [HoaDonController::class, 'datTour']);
    Route::group(['prefix'  =>  '/gio-hang'], function () {
        Route::post('/them-vao-gio-hang', [HoaDonController::class, 'themVaoGioHang']);
        Route::post('/xac-nhan-hoa-don', [HoaDonController::class, 'xacNhanHoaDon']);
        Route::post('/huy-hoa-don-client', [HoaDonController::class, 'huyHoaDon']);
    });
    Route::group(['prefix'  =>  '/tour'], function () {
        Route::get('/lay-du-lieu', [Tour::class, 'getDataClient']);
        Route::post('/lay-chi-tiet-tour/data', [Tour::class, 'clientGetChiTietTour']);
        Route::post('/thanh-toan', [HoaDonController::class, 'thanhToan']);
    });
    Route::group(['prefix'  =>  '/tinh-thanh'], function () {
        Route::get('/lay-du-lieu', [TinhThanhController::class, 'getDataClient']);
    });
    Route::group(['prefix'  =>  '/hoa-don'], function () {
        Route::post('/lay-danh-sach-hoa-don/data', [HoaDonController::class, 'getDataHoaDon']);
        Route::post('/doi-trang-thai', [HoaDonController::class, 'doiTinhTrangHoaDonClient']);
        Route::post('/lay-thong-tin-chi-tiet-hoa-don/data', [HoaDonController::class, 'getDataCTHD']);
    });
    Route::group(['prefix'  =>  '/vnpay'], function () {
// Route::post('/create', [VNPAYController::class, 'store']);
// Route::get('/return', [VNPAYController::class, 'vnpayReturn']);
    });
    Route::group(['prefix'  =>  '/tim-kiem-tour'], function () {
        Route::get('/lay-du-lieu', [DiaDiemController::class, 'getDataClient']);
        Route::post('/lay-du-lieu-tim-kiem', [DiaDiemController::class, 'getDataClientTimKiem']);
    });
    Route::group(['prefix'  =>  '/wishlist'], function () {
        Route::get('/lay-du-lieu', [WishlistController::class, 'getWishlist'])->middleware('auth:sanctum');
        Route::post('/them', [WishlistController::class, 'addToWishlist'])->middleware('auth:sanctum');
        Route::post('/xoa', [WishlistController::class, 'removeFromWishlist'])->middleware('auth:sanctum');
        Route::post('/kiem-tra', [WishlistController::class, 'checkWishlist'])->middleware('auth:sanctum');
    });
});

Route::post('/chatbot/question', [ChatbotController::class, 'handleQuestion']);

// // Route xử lý tạo thanh toán (Gửi sang VNPay) - Có Middleware Auth để bảo mật
// Route::post('/client/vnpay/create', [VNPAYController::class, 'createPayment'])->middleware('auth:sanctum');

// // Route nhận kết quả trả về từ VNPay - Không dùng Middleware Auth vì VNPAY sẽ gọi trực tiếp
// Route::get('/client/vnpay/return', [VNPAYController::class, 'vnpayReturn']);
// Route::resource('payment', VNPAYController::class);