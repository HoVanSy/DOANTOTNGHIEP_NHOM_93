<?php

namespace App\Http\Controllers;

use App\Models\LichTrinhTour;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LichTrinhTourController extends Controller
{
    public function getLichTrinh($tour_id)
    {
        try {
            $lichTrinh = LichTrinhTour::where('id_tour', $tour_id)
                ->orderBy('so_ngay')
                ->get();
            
            return response()->json([
                'status' => true,
                'lich_trinh' => $lichTrinh
            ]);
        } catch (\Exception $e) {
            Log::error('Error getData lich trinh: ' . $e->getMessage());
            return response()->json([
                'status' => false,
                'message' => 'Lỗi khi lấy dữ liệu lịch trình'
            ]);
        }
    }
    
    public function createLichTrinh(Request $request)
    {
        try {
            $data = $request->all();
            $lichTrinh = LichTrinhTour::create($data);
            
            return response()->json([
                'status' => true,
                'message' => 'Thêm lịch trình thành công',
                'lich_trinh' => $lichTrinh
            ]);
        } catch (\Exception $e) {
            Log::error('Error create lich trinh: ' . $e->getMessage());
            return response()->json([
                'status' => false,
                'message' => 'Lỗi khi thêm lịch trình: ' . $e->getMessage()
            ]);
        }
    }
    
    public function updateLichTrinh(Request $request)
    {
        try {
            $lichTrinh = LichTrinhTour::find($request->id);
            if (!$lichTrinh) {
                return response()->json([
                    'status' => false,
                    'message' => 'Không tìm thấy lịch trình'
                ]);
            }
            
            $lichTrinh->update($request->all());
            
            return response()->json([
                'status' => true,
                'message' => 'Cập nhật lịch trình thành công',
                'lich_trinh' => $lichTrinh
            ]);
        } catch (\Exception $e) {
            Log::error('Error update lich trinh: ' . $e->getMessage());
            return response()->json([
                'status' => false,
                'message' => 'Lỗi khi cập nhật lịch trình'
            ]);
        }
    }
    
    public function deleteLichTrinh($id)
    {
        try {
            $lichTrinh = LichTrinhTour::find($id);
            if (!$lichTrinh) {
                return response()->json([
                    'status' => false,
                    'message' => 'Không tìm thấy lịch trình'
                ]);
            }
            
            $lichTrinh->delete();
            
            return response()->json([
                'status' => true,
                'message' => 'Xóa lịch trình thành công'
            ]);
        } catch (\Exception $e) {
            Log::error('Error delete lich trinh: ' . $e->getMessage());
            return response()->json([
                'status' => false,
                'message' => 'Lỗi khi xóa lịch trình'
            ]);
        }
    }
}
