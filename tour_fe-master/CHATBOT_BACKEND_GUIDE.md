# Hướng dẫn tích hợp Chatbot AI vào Laravel Backend

## Tổng quan

Chatbot AI sẽ đọc câu hỏi của khách hàng, phân tích ý định, truy vấn database và trả về câu trả lời phù hợp từ dữ liệu thật.

## Bước 1: Thêm Controller

### 1.1 Tạo file controller

Đặt file `ChatbotController.php` vào thư mục `app/Http/Controllers/Api/`

### 1.2 Thêm route

Trong file `routes/api.php`, thêm:

```php
use App\Http\Controllers\Api\ChatbotController;

Route::post('/chatbot/question', [ChatbotController::class, 'handleQuestion']);
```

## Bước 2: Cấu hình Database

### 2.1 Đảm bảo có bảng `tour`

Controller đã sử dụng bảng `tour` với các trường:

- `id`: ID tour
- `tieu_de`: Tiêu đề tour
- `mo_ta`: Mô tả tour
- `gia_tour`: Giá tour
- `trang_thai`: Trạng thái (1 = active)
- `luot_xem`: Lượt xem (để sắp xếp tour phổ biến)

### 2.2 Cấu trúc bảng tour mẫu:

```sql
CREATE TABLE tour (
    id INT PRIMARY KEY AUTO_INCREMENT,
    tieu_de VARCHAR(255) NOT NULL,
    mo_ta TEXT,
    gia_tour DECIMAL(10,2),
    trang_thai TINYINT DEFAULT 1,
    luot_xem INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
```

## Bước 3: Test API

### 3.1 Test với Postman

```
POST http://127.0.0.1:8000/api/chatbot/question
Content-Type: application/json
Authorization: Bearer {your_token}

{
    "message": "Tour Đà Nẵng giá bao nhiêu?",
    "context": {
        "sessionId": "session_123",
        "userId": null
    }
}
```

### 3.2 Response mẫu:

```json
{
  "success": true,
  "message": "Các tour Đà Nẵng hiện có:\n\n🏖️ Tour Đà Nẵng 3 ngày 2 đêm\n💰 Giá: 2,500,000đ\n📝 Khám phá Bà Nà Hills, Sơn Trà, Hội An...\n\nBạn muốn biết thêm chi tiết?",
  "intent": "tour_info",
  "timestamp": "2024-01-01T10:00:00.000000Z"
}
```

## Bước 4: Tùy chỉnh Logic

### 4.1 Thêm ý định mới

Trong method `analyzeIntent()`, thêm từ khóa mới:

```php
'intents' => [
    'new_intent' => ['từ khóa 1', 'từ khóa 2', 'từ khóa 3'],
    // ...
]
```

### 4.2 Thêm method xử lý

Tạo method mới trong `getResponseFromDatabase()`:

```php
case 'new_intent':
    return $this->getNewIntentInfo($originalMessage);
```

### 4.3 Mở rộng database queries

Thêm các truy vấn phức tạp hơn:

- Tìm tour theo khoảng giá
- Lọc theo ngày khởi hành
- Tìm khách sạn theo rating
- Tính toán khuyến mãi

## Bước 5: Cải thiện AI

### 5.1 Sử dụng NLP Libraries

```php
// Cài đặt package NLP
composer require nlp-tools/nlp-tools

// Hoặc tích hợp với Dialogflow/Google Cloud NLP
composer require google/cloud-dialogflow
```

### 5.2 Machine Learning

- Sử dụng TensorFlow/PyTorch để phân tích ý định
- Training model trên dữ liệu lịch sử chat
- Recommendation system dựa trên lịch sử người dùng

## Bước 6: Bảo mật và Monitoring

### 6.1 Rate Limiting

```php
// Trong route
Route::middleware(['throttle:60,1'])->post('/chatbot/question', [ChatbotController::class, 'handleQuestion']);
```

### 6.2 Logging

```php
// Ghi log các câu hỏi và phản hồi
Log::info('Chatbot question', [
    'message' => $message,
    'intent' => $intent,
    'response' => $response,
    'ip' => request()->ip()
]);
```

### 6.3 Validation

```php
$request->validate([
    'message' => 'required|string|max:1000',
    'context' => 'nullable|array'
]);
```

## Bước 7: Tối ưu hiệu suất

### 7.1 Cache responses

```php
$cacheKey = 'chatbot_' . md5($message . $intent);
return Cache::remember($cacheKey, 3600, function() use ($intent, $message) {
    return $this->getResponseFromDatabase($intent, $message);
});
```

### 7.2 Database Indexing

```sql
CREATE INDEX idx_tour_tieu_de ON tour(tieu_de);
CREATE INDEX idx_tour_trang_thai ON tour(trang_thai);
CREATE INDEX idx_tour_luot_xem ON tour(luot_xem);
```

## Các tính năng đã implement

✅ **Phân tích ý định câu hỏi tự động**

- Nhận diện từ khóa trong câu hỏi
- Phân loại ý định: tour, booking, hotel, FAQ, etc.

✅ **Truy vấn database thông minh**

- Tìm tour theo địa điểm
- Lấy thông tin giá cả
- Trả lời FAQ từ database

✅ **Phản hồi đa dạng**

- Thông tin tour cụ thể
- Hướng dẫn đặt tour
- Chính sách và quy định
- Thông tin liên hệ

✅ **Xử lý lỗi**

- Fallback responses
- Logging errors
- User-friendly error messages

## Test Cases

### Tour Information

- "Tour Đà Nẵng" → Liệt kê tour Đà Nẵng
- "Tour Phú Quốc giá bao nhiêu?" → Thông tin giá tour Phú Quốc
- "Tour 3 ngày 2 đêm" → Tour theo thời gian

### Booking

- "Cách đặt tour?" → Hướng dẫn đặt tour
- "Thanh toán như thế nào?" → Phương thức thanh toán

### FAQ

- "Chính sách hủy tour?" → Thông tin hủy tour
- "Có bảo hiểm không?" → Thông tin bảo hiểm

### General

- "Xin chào" → Lời chào và giới thiệu dịch vụ
- "Cảm ơn" → Phản hồi lịch sự

## Monitoring và Analytics

### Metrics cần theo dõi:

- Số lượng câu hỏi/ngày
- Tỷ lệ ý định được nhận diện chính xác
- Thời gian phản hồi trung bình
- Các câu hỏi phổ biến nhất
- Tỷ lệ chuyển đổi (chat → booking)

### Tools:

- Laravel Telescope (debugging)
- Laravel Horizon (queue monitoring)
- Google Analytics (user behavior)
- Custom dashboards cho chatbot metrics
