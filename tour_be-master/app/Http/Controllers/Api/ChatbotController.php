<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Tour;

class ChatbotController extends Controller
{
    public function handleQuestion(Request $request)
    {
        $request->validate([
            'question' => 'required|string'
        ]);

        $question = $request->input('question');
        $apiKey = env('GEMINI_API_KEY');

        // Lấy danh sách các tour đang hoạt động (tinh_trang = 1)
        $tours = Tour::where('tinh_trang', 1)->limit(10)->get(); 
        
        $tourContext = "Dưới đây là danh sách các tour đang mở bán trên hệ thống:\n";
        
        if ($tours->isEmpty()) {
            $tourContext .= "- Hiện tại chưa có tour nào.\n";
        } else {
            foreach ($tours as $tour) {
                $giaNguoiLon = number_format($tour->gia_nguoi_lon, 0, ',', '.');
                $giaTreEm = number_format($tour->gia_tre_em, 0, ',', '.');
                
                $tourContext .= "- Tên Tour: {$tour->tieu_de}\n";
                $tourContext .= "  + Giá người lớn: {$giaNguoiLon} VNĐ | Giá trẻ em: {$giaTreEm} VNĐ\n";
                $tourContext .= "  + Lịch trình: Khởi hành {$tour->ngay_bat_dau} - Kết thúc {$tour->ngay_ket_thuc}\n";
                $tourContext .= "  + Điểm nổi bật: {$tour->mo_ta}\n";
                $tourContext .= "------------------------\n";
            }
        }

        $systemPrompt = "Bạn là trợ lý ảo AI của hệ thống du lịch VivuTour. Nhiệm vụ của bạn là tư vấn tour cho khách hàng dựa trên dữ liệu hệ thống cung cấp. Hãy trả lời thân thiện, nhiệt tình, chào mời hấp dẫn và KHÔNG bịa đặt thông tin ngoài dữ liệu được cung cấp.\n\n";
        
        $finalPrompt = $systemPrompt . "DỮ LIỆU HỆ THỐNG:\n" . $tourContext . "\n\nCÂU HỎI CỦA KHÁCH: " . $question;

        $response = Http::withoutVerifying()
            ->withHeaders([
                'Content-Type' => 'application/json',
            ])->post("https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash:generateContent?key={$apiKey}", [
                'contents' => [
                    [
                        'parts' => [
                            ['text' => $finalPrompt]
                        ]
                    ]
                ]
            ]);

        if ($response->successful()) {
            $data = $response->json();
            $answer = $data['candidates'][0]['content']['parts'][0]['text'] ?? 'Xin lỗi, tôi chưa tìm được câu trả lời phù hợp.';
        } else {
            // $answer = 'Hệ thống tư vấn đang bảo trì, bạn vui lòng thử lại sau ít phút nhé.';
            $answer = 'Lỗi từ Google: ' . $response->body();
        }

        return response()->json([
            'success' => true,
            'data' => $answer
        ]);
    }
}