<?php

namespace App\Http\Controllers;

use App\Models\ChiTietChucNang;
use App\Models\ChiTietTour;
use App\Models\LichTrinhTour;
use App\Models\Tour;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class TourController extends Controller
{

    public function getdata()
    {
        $id_chuc_nang   = 41;
        $user   =  Auth::guard('sanctum')->user();
        $check  =   ChiTietChucNang::where('id_chuc_vu', $user->id_chuc_vu)
            ->where('id_chuc_nang', $id_chuc_nang)
            ->first();
        if (!$check) {
            return response()->json([
                'status'    =>  false,
                'message'   =>  'Bạn không đủ quyền truy cập chức năng này!',
            ]);
        }
        $data = Tour::get();
        return response()->json([
            'status' => true,
            'tour'  =>  $data
        ]);
    }

    public function searchTour(Request $request)
    {
        $id_chuc_nang   = 42;
        $user   =  Auth::guard('sanctum')->user();
        $check  =   ChiTietChucNang::where('id_chuc_vu', $user->id_chuc_vu)
            ->where('id_chuc_nang', $id_chuc_nang)
            ->first();
        if (!$check) {
            return response()->json([
                'status'    =>  false,
                'message'   =>  'Bạn không đủ quyền truy cập chức năng này!',
            ]);
        }
        $key = "%" . $request->abc . "%";

        $data   = Tour::where('tieu_de', 'like', $key)
            ->get();
        return response()->json([
            'status' => true,
            'tour'  =>  $data,
        ]);
    }

    public function createTour(Request $request)
    {
        $id_chuc_nang   = 43;
        $user   =  Auth::guard('sanctum')->user();
        $check  =   ChiTietChucNang::where('id_chuc_vu', $user->id_chuc_vu)
            ->where('id_chuc_nang', $id_chuc_nang)
            ->first();
        if (!$check) {
            return response()->json([
                'status'    =>  false,
                'message'   =>  'Bạn không đủ quyền truy cập chức năng này!',
            ]);
        }
        $data   =   $request->all();
        Tour::create($data);
        return response()->json([
            'status'    =>  true,
            'message'   =>  'Đã tạo mới tour thành công!'
        ]);
    }

    public function deleteTour($id)
    {
        $id_chuc_nang   = 44;
        $user   =  Auth::guard('sanctum')->user();
        $check  =   ChiTietChucNang::where('id_chuc_vu', $user->id_chuc_vu)
            ->where('id_chuc_nang', $id_chuc_nang)
            ->first();
        if (!$check) {
            return response()->json([
                'status'    =>  false,
                'message'   =>  'Bạn không đủ quyền truy cập chức năng này!',
            ]);
        }
        try {
            Tour::where('id', $id)->delete();
            return response()->json([
                'status'            =>   true,
                'message'           =>   'Xóa tour thành công!',
            ]);
        } catch (Exception $e) {
            Log::info("Lỗi", $e);
            return response()->json([
                'status'            =>   false,
                'message'           =>   'Có lỗi',
            ]);
        }
    }

    public function updateTour(Request $request)
    {
        $id_chuc_nang   = 45;
        $user   =  Auth::guard('sanctum')->user();
        $check  =   ChiTietChucNang::where('id_chuc_vu', $user->id_chuc_vu)
            ->where('id_chuc_nang', $id_chuc_nang)
            ->first();
        if (!$check) {
            return response()->json([
                'status'    =>  false,
                'message'   =>  'Bạn không đủ quyền truy cập chức năng này!',
            ]);
        }
        try {
            $data   = $request->all();
            Tour::find($request->id)->update($data);
            return response()->json([
                'status'            =>   true,
                'message'           =>   'Đã cập nhật thành công tour!',
            ]);
        } catch (Exception $e) {
            Log::info("Lỗi", $e);
            return response()->json([
                'status'            =>   false,
                'message'           =>   'Có lỗi',
            ]);
        }
    }

    public function doiTinhTrangTour(Request $request)
    {
        $id_chuc_nang   = 46;
        $user   =  Auth::guard('sanctum')->user();
        $check  =   ChiTietChucNang::where('id_chuc_vu', $user->id_chuc_vu)
            ->where('id_chuc_nang', $id_chuc_nang)
            ->first();
        if (!$check) {
            return response()->json([
                'status'    =>  false,
                'message'   =>  'Bạn không đủ quyền truy cập chức năng này!',
            ]);
        }
        try {
            if ($request->tinh_trang == 1) {
                $tinh_trang_moi = 0;
            } else {
                $tinh_trang_moi = 1;
            }
            Tour::where('id', $request->id)->update([
                'tinh_trang'    =>  $tinh_trang_moi
            ]);
            return response()->json([
                'status'            =>   true,
                'message'           =>   'Đã đổi trạng thái thành công',
            ]);
        } catch (Exception $e) {
            Log::info("Lỗi", $e);
            return response()->json([
                'status'            =>   false,
                'message'           =>   'Có lỗi',
            ]);
        }
    }

    //client
    public function clientGetChiTietTour(Request $request)
    {
        $data = ChiTietTour::join('dia_diems', 'dia_diems.id', 'chi_tiet_tours.id_dia_diem')
            ->join('tours', 'chi_tiet_tours.id_tour', 'tours.id')
            ->join('tinh_thanhs', 'tinh_thanhs.id', 'dia_diems.id_tinh_thanh')
            ->join('quan_huyens', 'quan_huyens.id', 'dia_diems.id_quan_huyen')
            ->where('chi_tiet_tours.id_tour', $request->id)
            ->select(
                'tours.id as id_tour',
                'tours.link_anh as anh_tour',
                'tours.tieu_de as tieu_de_tour',
                'tours.ngay_bat_dau',
                'tours.ngay_ket_thuc',
                'tours.mo_ta',
                'tours.mo_ta_chi_tiet',
                'tours.gia_nguoi_lon',
                'tours.gia_tre_em',
                'dia_diems.*',
                'chi_tiet_tours.*',
                'tinh_thanhs.ten_tinh_thanh',
                'quan_huyens.ten_quan_huyen'
            )->get();
        
        $lich_trinh = [];
        if ($request->id) {
            $lich_trinh = LichTrinhTour::where('id_tour', $request->id)
                ->orderBy('so_ngay')
                ->get();
        }
        
        return response()->json([
            'chi_tiet_tour' =>  $data,
            'lich_trinh' => $lich_trinh,
            'status'        =>  true
        ]);
    }
    public function getDataClient()
    {
        $data = Tour::get();
        return response()->json([
            'status' => true,
            'tour_client'  =>  $data
        ]);
    }

    // Client search tour by keyword
    public function searchTourClient(Request $request)
    {
        $keyword = "%" . $request->keyword . "%";
        $minPrice = $request->min_price ?? 0;
        $maxPrice = $request->max_price ?? PHP_INT_MAX;

        $query = Tour::where('tieu_de', 'like', $keyword)
                ->orWhere('mo_ta', 'like', $keyword)
                ->whereBetween('gia_nguoi_lon', [$minPrice, $maxPrice]);

        $data = $query->get();

        return response()->json([
            'status' => true,
            'tours' => $data,
            'count' => $data->count()
        ]);
    }

    // Get price range for filter
    public function getTourPriceRange()
    {
        $minPrice = Tour::min('gia_nguoi_lon') ?? 0;
        $maxPrice = Tour::max('gia_nguoi_lon') ?? 0;

        return response()->json([
            'status' => true,
            'min_price' => $minPrice,
            'max_price' => $maxPrice
        ]);
    }

    public function ghiNhanHanhVi(Request $request)
    {
        $khach_hang = Auth::guard('sanctum')->user();
        if (!$khach_hang) {
            return response()->json(['status' => false]); // Khách vãng lai thì không lưu
        }

        $diem_cong = 1; // Mặc định là view
        if ($request->loai_hanh_vi == 'favorite') $diem_cong = 3;
        if ($request->loai_hanh_vi == 'book') $diem_cong = 5;

        // Kiểm tra xem khách đã từng tương tác với tour này chưa
        $hanh_vi = DB::table('hanh_vi_khach_hangs')
            ->where('id_khach_hang', $khach_hang->id)
            ->where('id_tour', $request->id_tour)
            ->first();

        if ($hanh_vi) {
            // Nếu đã từng xem/thích, thì CỘNG DỒN điểm lên
            DB::table('hanh_vi_khach_hangs')
                ->where('id', $hanh_vi->id)
                ->update([
                    'diem_so' => $hanh_vi->diem_so + $diem_cong,
                    'loai_hanh_vi' => $request->loai_hanh_vi,
                    'updated_at' => now()
                ]);
        } else {
            // Nếu lần đầu tương tác, tạo mới record
            DB::table('hanh_vi_khach_hangs')->insert([
                'id_khach_hang' => $khach_hang->id,
                'id_tour'       => $request->id_tour,
                'loai_hanh_vi'  => $request->loai_hanh_vi,
                'diem_so'       => $diem_cong,
                'created_at'    => now(),
                'updated_at'    => now()
            ]);
        }

        return response()->json(['status' => true]);
    }

    public function layTourGoiY()
    {
        $khach_hang = Auth::guard('sanctum')->user();
        
        if (!$khach_hang) {
            $tourGoiY = Tour::where('tinh_trang', 1)->orderBy('id', 'desc')->limit(4)->get();
            return response()->json(['status' => true, 'data' => $tourGoiY]);
        }

        // tìm Tour khách hàng có ĐIỂM CAO NHẤT trong lịch sử hành vi
        $tourYeuThichNhat = DB::table('hanh_vi_khach_hangs')
            ->where('id_khach_hang', $khach_hang->id)
            ->orderBy('diem_so', 'desc')
            ->first();

        if (!$tourYeuThichNhat) {
            $tourGoiY = Tour::where('tinh_trang', 1)->inRandomOrder()->limit(4)->get();
            return response()->json(['status' => true, 'data' => $tourGoiY]);
        }

        // Tìm giá tiền của tour được thích nhất đó
        $tourGoc = Tour::find($tourYeuThichNhat->id_tour);
        
        if (!$tourGoc) {
            $tourGoiY = Tour::where('tinh_trang', 1)->inRandomOrder()->limit(4)->get();
            return response()->json(['status' => true, 'data' => $tourGoiY]);
        }

        // Thiết lập vùng giá tương đồng (Biên độ dao động 30% so với giá gốc)
        $gia_goc = $tourGoc->gia_nguoi_lon;
        $gia_min = $gia_goc * 0.7; // Rẻ hơn tối đa 30%
        $gia_max = $gia_goc * 1.3; // Đắt hơn tối đa 30%

        // truy vấn các Tour CÙNG PHÂN KHÚC GIÁ (loại trừ tour đã xem)
        $tourGoiY = Tour::where('tinh_trang', 1)
            ->whereBetween('gia_nguoi_lon', [$gia_min, $gia_max])
            ->where('id', '!=', $tourGoc->id)
            ->limit(4)
            ->get();

        //Nếu không đủ 4 tour cùng tầm giá, bù thêm bằng tour mới nhất
        if ($tourGoiY->count() < 4) {
            $soLuongCanBu = 4 - $tourGoiY->count();
            $tourBu = Tour::where('tinh_trang', 1)
                ->whereNotBetween('gia_nguoi_lon', [$gia_min, $gia_max]) 
                ->where('id', '!=', $tourGoc->id)
                ->orderBy('id', 'desc')
                ->limit($soLuongCanBu)
                ->get();
            
            $tourGoiY = $tourGoiY->merge($tourBu);
        }

        return response()->json([
            'status' => true,
            'data'   => $tourGoiY
        ]);
    }
}
