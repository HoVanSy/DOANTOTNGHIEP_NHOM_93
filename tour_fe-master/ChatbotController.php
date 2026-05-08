<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ChatbotController extends Controller
{
    /**
     * Xử lý câu hỏi từ chatbot
     */
    public function handleQuestion(Request $request)
    {
        try {
            $message = $request->input('message');
            $context = $request->input('context', []);

            // Phân tích ý định của câu hỏi
            $intent = $this->analyzeIntent($message);

            // Truy vấn database dựa trên ý định
            $response = $this->getResponseFromDatabase($intent, $message);

            return response()->json([
                'success' => true,
                'message' => $response,
                'intent' => $intent,
                'timestamp' => now()
            ]);

        } catch (\Exception $e) {
            Log::error('Chatbot error: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Xin lỗi, có lỗi xảy ra. Vui lòng thử lại sau.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Phân tích ý định của câu hỏi
     */
    private function analyzeIntent($message)
    {
        $message = strtolower($message);

        // Các từ khóa cho từng ý định
        $intents = [
            'tour_info' => ['tour', 'du lịch', 'đà nẵng', 'nha trang', 'phú quốc', 'sapa', 'hạ long'],
            'booking' => ['đặt', 'booking', 'đăng ký', 'thanh toán', 'giá'],
            'hotel' => ['khách sạn', 'hotel', 'lưu trú', 'ở đâu'],
            'itinerary' => ['lịch trình', 'itinerary', 'đi đâu', 'thăm quan'],
            'faq' => ['faq', 'câu hỏi', 'thường gặp', 'chính sách', 'hủy', 'thanh toán'],
            'contact' => ['liên hệ', 'hotline', 'điện thoại', 'email'],
            'price' => ['giá', 'price', 'tiền', 'chi phí'],
            'promotion' => ['khuyến mãi', 'giảm giá', 'sale', 'ưu đãi']
        ];

        foreach ($intents as $intent => $keywords) {
            foreach ($keywords as $keyword) {
                if (strpos($message, $keyword) !== false) {
                    return $intent;
                }
            }
        }

        return 'general';
    }

    /**
     * Lấy phản hồi từ database dựa trên ý định
     */
    private function getResponseFromDatabase($intent, $originalMessage)
    {
        switch ($intent) {
            case 'tour_info':
                return $this->getTourInfo($originalMessage);

            case 'booking':
                return $this->getBookingInfo();

            case 'hotel':
                return $this->getHotelInfo($originalMessage);

            case 'itinerary':
                return $this->getItineraryInfo();

            case 'faq':
                return $this->getFAQInfo($originalMessage);

            case 'contact':
                return $this->getContactInfo();

            case 'price':
                return $this->getPriceInfo();

            case 'promotion':
                return $this->getPromotionInfo();

            default:
                return $this->getGeneralResponse();
        }
    }

    /**
     * Lấy thông tin tour
     */
    private function getTourInfo($message)
    {
        $message = strtolower($message);

        // Tìm tour theo địa điểm
        $destinations = [
            'đà nẵng' => 'Đà Nẵng',
            'nha trang' => 'Nha Trang',
            'phú quốc' => 'Phú Quốc',
            'sapa' => 'Sapa',
            'hạ long' => 'Hạ Long'
        ];

        foreach ($destinations as $keyword => $destination) {
            if (strpos($message, $keyword) !== false) {
                // Truy vấn database để lấy tour theo địa điểm
                $tours = DB::table('tour')
                    ->where('tieu_de', 'like', '%' . $destination . '%')
                    ->orWhere('mo_ta', 'like', '%' . $destination . '%')
                    ->limit(3)
                    ->get(['id', 'tieu_de', 'mo_ta', 'gia_tour']);

                if ($tours->count() > 0) {
                    $response = "Các tour {$destination} hiện có:\n\n";
                    foreach ($tours as $tour) {
                        $response .= "🏖️ {$tour->tieu_de}\n";
                        $response .= "💰 Giá: " . number_format($tour->gia_tour) . "đ\n";
                        $response .= "📝 {$tour->mo_ta}\n\n";
                    }
                    $response .= "Bạn muốn biết thêm chi tiết tour nào?";
                    return $response;
                }
            }
        }

        // Nếu không tìm thấy tour cụ thể, lấy tour phổ biến
        $tours = DB::table('tour')
            ->where('trang_thai', 1)
            ->orderBy('luot_xem', 'desc')
            ->limit(3)
            ->get(['id', 'tieu_de', 'mo_ta', 'gia_tour']);

        $response = "Các tour phổ biến hiện tại:\n\n";
        foreach ($tours as $tour) {
            $response .= "🏖️ {$tour->tieu_de}\n";
            $response .= "💰 Giá: " . number_format($tour->gia_tour) . "đ\n\n";
        }
        $response .= "Bạn quan tâm đến tour nào cụ thể?";

        return $response;
    }

    /**
     * Lấy thông tin đặt tour
     */
    private function getBookingInfo()
    {
        return "Để đặt tour, bạn cần cung cấp thông tin sau:\n\n" .
               "📋 Thông tin cần thiết:\n" .
               "• Tên tour bạn muốn đặt\n" .
               "• Số lượng người lớn và trẻ em\n" .
               "• Ngày khởi hành mong muốn\n" .
               "• Thông tin liên hệ (họ tên, SĐT, email)\n\n" .
               "💳 Phương thức thanh toán:\n" .
               "• Chuyển khoản ngân hàng\n" .
               "• Thanh toán thẻ tín dụng\n" .
               "• Thanh toán tiền mặt tại văn phòng\n\n" .
               "📞 Hotline: 0935532543\n" .
               "🌐 Website: vivutour.com\n\n" .
               "Bạn muốn đặt tour nào?";
    }

    /**
     * Lấy thông tin khách sạn
     */
    private function getHotelInfo($message)
    {
        $message = strtolower($message);

        // Có thể mở rộng để tìm khách sạn theo địa điểm
        return "Chúng tôi cung cấp dịch vụ đặt phòng khách sạn chất lượng:\n\n" .
               "🏨 Các hạng khách sạn:\n" .
               "• Khách sạn 5 sao: Novotel, InterContinental, Marriott\n" .
               "• Khách sạn 4 sao: Vinpearl, Pullman, Mercure\n" .
               "• Khách sạn 3 sao: Các resort ven biển\n\n" .
               "📍 Địa điểm phổ biến:\n" .
               "• Đà Nẵng: Sơn Trà, Mỹ Khê, Ngũ Hành Sơn\n" .
               "• Nha Trang: Trần Phú, Louisiane Brewhouse\n" .
               "• Phú Quốc: Vinpearl Resort, Sailing Club\n\n" .
               "💰 Giá phòng từ 800.000đ/đêm\n\n" .
               "Bạn muốn đặt khách sạn ở đâu và thời gian nào?";
    }

    /**
     * Lấy thông tin lịch trình
     */
    private function getItineraryInfo()
    {
        return "Tôi có thể giúp bạn lên lịch trình du lịch tùy chỉnh!\n\n" .
               "📝 Thông tin cần thiết:\n" .
               "• Điểm đến bạn muốn đi\n" .
               "• Số ngày lưu trú\n" .
               "• Sở thích: biển, núi, văn hóa, ẩm thực...\n" .
               "• Ngân sách dự kiến\n\n" .
               "🎯 Ví dụ lịch trình:\n" .
               "📅 Tour Đà Nẵng 3 ngày 2 đêm:\n" .
               "Ngày 1: Đón sân bay → Check-in khách sạn → Tham quan Bà Nà Hills\n" .
               "Ngày 2: Sơn Trà Peninsula → Hội An cổ trấn\n" .
               "Ngày 3: Ngũ Hành Sơn → Tiễn sân bay\n\n" .
               "Bạn muốn lên lịch trình cho điểm đến nào?";
    }

    /**
     * Lấy thông tin FAQ
     */
    private function getFAQInfo($message)
    {
        $message = strtolower($message);

        if (strpos($message, 'hủy') !== false || strpos($message, 'cancel') !== false) {
            return "📋 Chính sách hủy tour:\n\n" .
                   "• Hủy trước 15 ngày: Hoàn 100% tiền cọc\n" .
                   "• Hủy trước 7-14 ngày: Hoàn 70% tiền cọc\n" .
                   "• Hủy trước 3-6 ngày: Hoàn 50% tiền cọc\n" .
                   "• Hủy trong 3 ngày: Không hoàn tiền cọc\n\n" .
                   "⚠️ Lưu ý: Phí hủy do đối tác cung cấp dịch vụ (khách sạn, vé máy bay...) sẽ được trừ vào tiền hoàn.";
        }

        if (strpos($message, 'thanh toán') !== false || strpos($message, 'payment') !== false) {
            return "💳 Phương thức thanh toán:\n\n" .
                   "• Chuyển khoản: STK 123456789, Ngân hàng Vietcombank, Chủ tài khoản: Công ty TNHH VivuTour\n" .
                   "• Thẻ tín dụng: Visa, Mastercard, JCB\n" .
                   "• Thanh toán tại văn phòng: 32 Xuân Diệu, Đà Nẵng\n" .
                   "• Ví điện tử: Momo, ZaloPay, ViettelPay\n\n" .
                   "📅 Thời hạn thanh toán: Đặt cọc 30% khi đăng ký, thanh toán 70% còn lại trước 7 ngày khởi hành.";
        }

        if (strpos($message, 'bảo hiểm') !== false) {
            return "🛡️ Bảo hiểm du lịch:\n\n" .
                   "• Bao gồm trong tất cả tour của VivuTour\n" .
                   "• Phạm vi bảo hiểm: Tai nạn, ốm đau, mất mát hành lý\n" .
                   "• Mức bảo hiểm: 20.000.000đ/người/vụ\n" .
                   "• Đối tác: Bảo Việt, Prudential\n\n" .
                   "📋 Quy trình khi có sự cố: Liên hệ hotline 1900 XXX XXX để được hướng dẫn.";
        }

        return "❓ Các câu hỏi thường gặp:\n\n" .
               "1. Chính sách hủy tour?\n" .
               "2. Phương thức thanh toán?\n" .
               "3. Có bảo hiểm du lịch không?\n" .
               "4. Hướng dẫn viên có tiếng Anh không?\n" .
               "5. Có thể thay đổi lịch trình không?\n" .
               "6. Chính sách cho trẻ em?\n\n" .
               "Bạn muốn biết về vấn đề nào cụ thể?";
    }

    /**
     * Lấy thông tin liên hệ
     */
    private function getContactInfo()
    {
        return "📞 Thông tin liên hệ VivuTour:\n\n" .
               "🏢 Văn phòng chính:\n" .
               "32 Xuân Diệu, Phường Phước Ninh\n" .
               "Quận Hải Châu, TP. Đà Nẵng\n\n" .
               "📱 Hotline: 0935 532 543\n" .
               "📞 Điện thoại: (0236) 3 888 999\n" .
               "📧 Email: vivutour@gmail.com\n" .
               "🌐 Website: www.vivutour.com\n\n" .
               "🕒 Giờ làm việc:\n" .
               "Thứ 2 - Thứ 6: 8:00 - 17:30\n" .
               "Thứ 7 - Chủ nhật: 8:00 - 12:00\n\n" .
               "Bạn cần hỗ trợ gì khác không?";
    }

    /**
     * Lấy thông tin giá
     */
    private function getPriceInfo()
    {
        return "💰 Bảng giá tour VivuTour:\n\n" .
               "🏖️ Tour nội địa:\n" .
               "• Tour 2 ngày 1 đêm: 1.500.000 - 2.500.000đ\n" .
               "• Tour 3 ngày 2 đêm: 2.500.000 - 4.500.000đ\n" .
               "• Tour 4 ngày 3 đêm: 3.500.000 - 6.500.000đ\n\n" .
               "✈️ Tour nước ngoài:\n" .
               "• Đông Nam Á: 15.000.000 - 25.000.000đ\n" .
               "• Châu Á: 20.000.000 - 35.000.000đ\n" .
               "• Châu Âu: 45.000.000 - 80.000.000đ\n\n" .
               "🏨 Khách sạn:\n" .
               "• 3 sao: 800.000 - 1.200.000đ/đêm\n" .
               "• 4 sao: 1.500.000 - 2.500.000đ/đêm\n" .
               "• 5 sao: 3.000.000 - 8.000.000đ/đêm\n\n" .
               "💡 Giá có thể thay đổi theo mùa và số lượng người. Liên hệ để nhận báo giá chính xác!";
    }

    /**
     * Lấy thông tin khuyến mãi
     */
    private function getPromotionInfo()
    {
        return "🎉 Chương trình khuyến mãi hiện tại:\n\n" .
               "🔥 Ưu đãi đặc biệt:\n" .
               "• Giảm 15% cho đoàn từ 15 người trở lên\n" .
               "• Miễn phí trẻ em dưới 6 tuổi\n" .
               "• Giảm 10% khi đặt tour trước 45 ngày\n" .
               "• Tặng voucher 500.000đ cho khách hàng cũ\n\n" .
               "📅 Khuyến mãi theo tháng:\n" .
               "• Tháng 1-2: Tour mùa đông giá ưu đãi\n" .
               "• Tháng 3-5: Tour mùa xuân giảm 12%\n" .
               "• Tháng 6-8: Tour biển mùa hè\n" .
               "• Tháng 9-11: Tour mùa thu lá vàng\n" .
               "• Tháng 12: Tour năm mới giảm sốc\n\n" .
               "🎁 Combo tiết kiệm:\n" .
               "• Tour + Khách sạn: Tiết kiệm 20%\n" .
               "• Tour + Vé máy bay: Giảm 500.000đ\n\n" .
               "📞 Gọi ngay 0935 532 543 để nhận ưu đãi!";
    }

    /**
     * Phản hồi chung
     */
    private function getGeneralResponse()
    {
        return "👋 Xin chào! Tôi là trợ lý AI của VivuTour.\n\n" .
               "Tôi có thể giúp bạn:\n\n" .
               "🏖️ Tư vấn và đặt tour du lịch\n" .
               "🏨 Gợi ý khách sạn phù hợp\n" .
               "📅 Lên lịch trình cá nhân hóa\n" .
               "💰 Tư vấn giá cả và khuyến mãi\n" .
               "❓ Trả lời câu hỏi thường gặp\n" .
               "📞 Cung cấp thông tin liên hệ\n\n" .
               "Bạn cần hỗ trợ gì cụ thể? Ví dụ:\n" .
               "• \"Tour Đà Nẵng giá bao nhiêu?\"\n" .
               "• \"Cách đặt tour online?\"\n" .
               "• \"Khách sạn ở Nha Trang?\"\n" .
               "• \"Chính sách hủy tour?\"";
    }
}