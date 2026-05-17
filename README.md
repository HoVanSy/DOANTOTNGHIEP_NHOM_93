<p align="center">
  <img src="https://img.shields.io/badge/Laravel-10.x-red?logo=laravel" alt="Laravel">
  <img src="https://img.shields.io/badge/Vue-3.3-4FC08D?logo=vuedotjs" alt="Vue">
  <img src="https://img.shields.io/badge/PHP-^8.1-777BB4?logo=php" alt="PHP">
  <img src="https://img.shields.io/badge/MySQL-5.7+-4479A1?logo=mysql" alt="MySQL">
  <img src="https://img.shields.io/badge/License-MIT-yellow" alt="License">
  <img src="https://img.shields.io/badge/Status-Completed-success" alt="Status">
</p>

<h1 align="center">VivuTour - Hệ Thống Quản Lý & Đặt Tour Du Lịch Trực Tuyến</h1>

<p align="center">
  <strong>Đồ Án Tốt Nghiệp - Nhóm 93</strong><br>
  Nền tảng đặt tour du lịch toàn diện với đầy đủ tính năng dành cho khách hàng và quản trị viên.
</p>

---

## 📋 Mục Lục

- [Tổng Quan Dự Án](#-tổng-quan-dự-án)
- [Tính Năng Chính](#-tính-năng-chính)
- [Công Nghệ Sử Dụng](#-công-nghệ-sử-dụng)
- [Kiến Trúc Hệ Thống](#-kiến-trúc-hệ-thống)
- [Yêu Cầu Hệ Thống](#-yêu-cầu-hệ-thống)
- [Hướng Dẫn Cài Đặt](#-hướng-dẫn-cài-đặt)
- [Hướng Dẫn Sử Dụng](#-hướng-dẫn-sử-dụng)
- [Cấu Trúc Thư Mục](#-cấu-trúc-thư-mục)
- [Cơ Sở Dữ Liệu](#-cơ-sở-dữ-liệu)
- [API Endpoints](#-api-endpoints)
- [FAQ & Khắc Phục Lỗi](#-faq--khắc-phục-lỗi)
- [Đóng Góp](#-đóng-góp)
- [Giấy Phép](#-giấy-phép)
- [Liên Hệ & Hỗ Trợ](#-liên-hệ--hỗ-trợ)
- [Công Nhận](#-công-nhận)

---

## 📖 Tổng Quan Dự Án

**VivuTour** là một hệ thống web đặt tour du lịch trực tuyến được phát triển bởi Nhóm 93 trong khuôn khổ đồ án tốt nghiệp. Hệ thống cung cấp giải pháp toàn diện cho cả khách hàng lẫn nhà quản lý tour du lịch.

### 🎯 Mục Tiêu

- Xây dựng nền tảng đặt tour trực tuyến thân thiện, dễ sử dụng
- Tối ưu hóa quy trình quản lý tour, khách hàng và hóa đơn cho doanh nghiệp lữ hành
- Tích hợp thanh toán trực tuyến và các công cụ hỗ trợ khách hàng hiện đại (chatbot AI, Google Login, OTP)
- Cung cấp hệ thống báo cáo thống kê doanh thu trực quan

### 👥 Đối Tượng Người Dùng

| Vai trò | Mô tả |
|---------|-------|
| **Khách hàng (Client)** | Người dùng cuối có thể xem tour, đặt tour, thanh toán, quản lý hồ sơ cá nhân,... |
| **Quản trị viên (Admin)** | Quản lý toàn bộ hệ thống: tour, nhân viên, hóa đơn, khách hàng, thống kê,... |
| **Nhân viên (Staff)** | Nhân viên công ty lữ hành được phân quyền thực hiện các tác vụ quản lý |

---

## ✨ Tính Năng Chính

### 🧑‍💼 Dành Cho Khách Hàng (Client)

| Tính năng | Mô tả |
|-----------|-------|
| 🏠 **Trang chủ** | Banner quảng cáo, ưu đãi hấp dẫn, danh mục tour, tour mới nhất |
| 📋 **Danh sách tour** | Hiển thị tất cả tour, bộ lọc theo tỉnh thành/loại hình |
| 🔍 **Chi tiết tour** | Thông tin đầy đủ: giá người lớn/trẻ em, lịch trình, mô tả, hình ảnh |
| 🔎 **Tìm kiếm tour** | Tìm kiếm theo địa điểm, tỉnh thành, từ khóa |
| 📝 **Đăng ký / Đăng nhập** | Đăng ký tài khoản mới, đăng nhập bằng email hoặc **Google OAuth** |
| 🔐 **Quên mật khẩu** | Khôi phục mật khẩu qua **OTP gửi email** |
| ❤️ **Yêu thích (Wishlist)** | Lưu tour yêu thích để xem sau |
| 🛒 **Giỏ hàng & Đặt tour** | Thêm tour vào giỏ, đặt tour với số lượng người lớn/trẻ em |
| 💳 **Thanh toán MoMo** | Tích hợp cổng thanh toán MoMo (môi trường test) |
| 📄 **Quản lý hóa đơn** | Xem danh sách hóa đơn, chi tiết hóa đơn, hủy hóa đơn |
| ⭐ **Đánh giá & nhận xét** | Đánh giá tour sau khi đặt (số sao + nội dung) |
| 📰 **Blog** | Xem bài viết, tin tức du lịch |
| ❌ **Yêu cầu hủy** | Gửi yêu cầu hủy tour đã đặt |
| 💬 **Chatbot AI** | Trợ lý ảo tư vấn tour tự động (Gemini AI) |
| 👤 **Trang cá nhân** | Cập nhật thông tin profile |

### 🔧 Dành Cho Quản Trị (Admin)

| Tính năng | Mô tả |
|-----------|-------|
| 📊 **Thống kê & Báo cáo** | Dashboard tổng quan, biểu đồ doanh thu (Chart.js) |
| 🏙️ **Quản lý tỉnh thành** | CRUD tỉnh/thành phố, tìm kiếm, đổi trạng thái |
| 🏘️ **Quản lý quận huyện** | CRUD quận/huyện, tìm kiếm, đổi trạng thái |
| 👷 **Quản lý nhân viên** | CRUD nhân viên, gán chức vụ, đổi trạng thái |
| 🗺️ **Quản lý địa điểm** | CRUD địa điểm du lịch, tìm kiếm, đổi trạng thái |
| 🎫 **Quản lý tour** | CRUD tour, quản lý lịch trình tour, đổi trạng thái |
| 📋 **Quản lý hóa đơn** | Xem, xác nhận, hủy hóa đơn, tìm kiếm |
| 👥 **Quản lý khách hàng** | CRUD khách hàng, tìm kiếm, đổi trạng thái |
| 📝 **Quản lý blog** | CRUD bài viết, quản lý nội dung blog |
| 🏷️ **Quản lý khuyến mãi** | Tạo mã giảm giá (coupon), kiểm tra, đổi trạng thái |
| ❌ **Duyệt yêu cầu hủy** | Duyệt/từ chối yêu cầu hủy tour từ khách hàng |
| 🔐 **Phân quyền (RBAC)** | Quản lý chức vụ, chức năng, phân quyền chi tiết |

---

## 🛠 Công Nghệ Sử Dụng

### Frontend

| Công nghệ | Phiên bản | Mục đích |
|-----------|-----------|----------|
| [Vue 3](https://vuejs.org/) | ^3.3.4 | Framework JavaScript xây dựng giao diện |
| [Vue Router](https://router.vuejs.org/) | ^4.3.3 | Định tuyến SPA |
| [Vite](https://vitejs.dev/) | ^4.4.5 | Build tool |
| [Axios](https://axios-http.com/) | ^1.7.2 | HTTP client gọi API |
| [Chart.js](https://www.chartjs.org/) | ^4.5.1 | Biểu đồ thống kê |
| [vue-chartjs](https://vue-chartjs.org/) | ^5.3.1 | Tích hợp Chart.js với Vue |
| [vue3-toastify](https://vue3-toastify.js.org/) | ^0.2.1 | Thông báo toast |
| [@meforma/vue-toaster](https://github.com/meforma/vue-toaster) | ^1.3.0 | Thông báo toast |

### Backend

| Công nghệ | Phiên bản | Mục đích |
|-----------|-----------|----------|
| [Laravel](https://laravel.com/) | ^10.10 | Framework PHP |
| [PHP](https://www.php.net/) | ^8.1 | Ngôn ngữ lập trình |
| [Laravel Sanctum](https://laravel.com/docs/sanctum) | ^3.3 | Xác thực API token |
| [Laravel Socialite](https://laravel.com/docs/socialite) | ^5.27 | Đăng nhập Google OAuth |
| [Laravel Tinker](https://github.com/laravel/tinker) | ^2.8 | REPL tương tác |
| [GuzzleHttp](https://docs.guzzlephp.org/) | ^7.2 | HTTP client (chatbot Gemini) |
| [jenssegers/agent](https://github.com/jenssegers/agent) | ^2.6 | Phát hiện thiết bị |

### Cơ sở dữ liệu

| Công nghệ | Mục đích |
|-----------|----------|
| **MySQL** | Cơ sở dữ liệu quan hệ |
| **Eloquent ORM** | ORM mặc định của Laravel |
| **Laravel Migrations** | Quản lý phiên bản CSDL (29 migrations) |

### Thanh toán

| Cổng thanh toán | Môi trường |
|----------------|------------|
| **MoMo** | Test (sandbox) - `https://test-payment.momo.vn/v2/gateway/api/create` |

### AI & Tích hợp khác

| Dịch vụ | Mục đích |
|---------|----------|
| **Google Gemini API** (gemini-2.5-flash) | Chatbot tư vấn tour thông minh |
| **Google OAuth 2.0** | Đăng nhập bằng tài khoản Google |
| **SMTP Mail** | Gửi OTP, email thông báo |

---

## 🏗 Kiến Trúc Hệ Thống

```
┌─────────────────────────────────────────────────────────────┐
│                     Frontend (Vue 3 SPA)                     │
│  tour_fe-master/  ┌───────────┐  ┌───────────────────────┐  │
│                   │ Vue Router │  │    Components/        │  │
│                   │ (13 admin  │  │  TrangChu, DanhSachTour│  │
│                   │ + 16 client│  │  ChiTietTour, HoaDon  │  │
│                   │   routes)  │  │  Blog, Wishlist, ...  │  │
│                   └─────┬─────┘  └──────────┬────────────┘  │
│                         │                   │               │
│                   ┌─────▼───────────────────▼──────┐        │
│                   │     core/ (Axios HTTP Client)   │        │
│                   │  baseRequest.js (Admin API)      │        │
│                   │  baseRequestClient.js (Client)   │        │
│                   │  chatbotService.js               │        │
│                   └────────────────┬─────────────────┘        │
└────────────────────────────────────┼──────────────────────────┘
                                     │ HTTP (JSON)
┌────────────────────────────────────┼──────────────────────────┐
│              Backend (Laravel 10)  │                           │
│  tour_be-master/   ┌───────────────▼─────────────────┐        │
│                    │         Routes (api.php)          │       │
│                    │  ● account-admin/*               │       │
│                    │  ● admin/* (13 modules)          │       │
│                    │  ● account-client/*              │       │
│                    │  ● client/* (wishlist, cart, ...)│       │
│                    │  ● chatbot/question              │       │
│                    └───────────────┬──────────────────┘       │
│                    ┌───────────────▼──────────────────┐       │
│                    │     Controllers (22 controllers)  │       │
│                    │  TourController, HoaDonController │       │
│                    │  KhachHangController, NhanVien... │       │
│                    │  MomoController, ChatbotController│       │
│                    └───────────────┬──────────────────┘       │
│                    ┌───────────────▼──────────────────┐       │
│                    │     Models (19 Eloquent Models)   │       │
│                    │  Tour, HoaDon, ChiTietHoaDon     │       │
│                    │  KhachHang, NhanVien, Blog, ...  │       │
│                    └───────────────┬──────────────────┘       │
│                    ┌───────────────▼──────────────────┐       │
│                    │        MySQL Database             │       │
│                    │      (29 migration tables)        │       │
│                    └──────────────────────────────────┘       │
└──────────────────────────────────────────────────────────────┘
```

---

## 📋 Yêu Cầu Hệ Thống

### Máy chủ (Server)

| Phần mềm | Phiên bản tối thiểu |
|-----------|-------------------|
| PHP | ^8.1 |
| Composer | 2.x |
| MySQL | 5.7+ |
| Node.js | 16.x+ |
| npm | 8.x+ |
| Web Server | Apache / Nginx |

### Extension PHP yêu cầu

- BCMath PHP Extension
- Ctype PHP Extension
- Fileinfo PHP Extension
- JSON PHP Extension
- Mbstring PHP Extension
- OpenSSL PHP Extension
- PDO PHP Extension
- Tokenizer PHP Extension
- XML PHP Extension
- cURL PHP Extension

---

## 🚀 Hướng Dẫn Cài Đặt

### 1. Clone Repository

```bash
git clone <repository-url>
cd DOANTOTNGHIEP_NHOM_93
```

### 2. Cài Đặt Backend (Laravel)

```bash
cd tour_be-master

# Cài đặt dependencies PHP
composer install

# Copy .env và cấu hình database
cp .env.example .env
```

Mở file `.env` và cấu hình các thông số:

```env
APP_NAME=VivuTour
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=vivutour
DB_USERNAME=root
DB_PASSWORD=

# Google OAuth (đăng ký tại https://console.cloud.google.com/)
GOOGLE_CLIENT_ID=your-google-client-id
GOOGLE_CLIENT_SECRET=your-google-client-secret
GOOGLE_REDIRECT_URL=http://localhost:8000/api/auth/google/callback

# MoMo Test
MOMO_PARTNER_CODE=MOMOBKUN20180529
MOMO_ACCESS_KEY=klm05TvNBzhg7h7j
MOMO_SECRET_KEY=at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa

# Google Gemini API (chatbot)
GEMINI_API_KEY=your-gemini-api-key

# SMTP Mail (gửi OTP)
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-app-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=your-email@gmail.com
MAIL_FROM_NAME="${APP_NAME}"
```

```bash
# Tạo key cho ứng dụng
php artisan key:generate

# Chạy migrations để tạo bảng
php artisan migrate

# (Tuỳ chọn) Chạy seeder dữ liệu mẫu
php artisan db:seed

# Khởi động server
php artisan serve
```

> Backend sẽ chạy tại: `http://localhost:8000`

### 3. Cài Đặt Frontend (Vue 3)

Mở terminal mới:

```bash
cd tour_fe-master

# Cài đặt dependencies
npm install

# Copy file .env cho frontend (nếu cần)
# Khởi động dev server
npm run dev
```

> Frontend sẽ chạy tại: `http://localhost:5173`

### 4. Kiểm Tra Hoạt Động

1. Backend: Truy cập `http://localhost:8000` → Thấy trang Laravel welcome
2. Frontend: Truy cập `http://localhost:5173` → Thấy trang chủ VivuTour
3. API Test: `http://localhost:8000/api/tour/lay-du-lieu-client` → Trả về JSON danh sách tour

---

## 📖 Hướng Dẫn Sử Dụng

### Dành Cho Khách Hàng

1. **Truy cập trang chủ**: Mở `http://localhost:5173` (hoặc URL frontend)
2. **Xem danh sách tour**: Click "Khám Phá Toàn Bộ Tour" hoặc vào menu "Danh sách tour"
3. **Xem chi tiết tour**: Click vào tour để xem thông tin, lịch trình, giá
4. **Đăng ký tài khoản**: Vào "Đăng ký", nhập thông tin và xác thực OTP qua email (hoặc đăng nhập Google)
5. **Đặt tour**: Chọn số lượng người lớn/trẻ em → "Đặt ngay" → Thanh toán qua MoMo
6. **Quản lý hóa đơn**: Vào "Trang cá nhân" → "Hóa đơn của tôi" để xem trạng thái

### Dành Cho Quản Trị

1. **Đăng nhập admin**: Vào `http://localhost:5173/admin/dang-nhap`
2. **Dashboard thống kê**: Xem tổng quan doanh thu, số lượng tour, khách hàng...
3. **Quản lý tour**: Thêm/sửa/xóa tour, quản lý lịch trình
4. **Quản lý hóa đơn**: Xác nhận đơn hàng, theo dõi trạng thái
5. **Phân quyền**: Thiết lập chức vụ và phân quyền cho nhân viên
6. **Khuyến mãi**: Tạo mã giảm giá cho khách hàng

---

## 📁 Cấu Trúc Thư Mục Chi Tiết

### Backend (`tour_be-master/`)

```
tour_be-master/
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       ├── Api/
│   │       │   └── ChatbotController.php     # Chatbot AI (Gemini)
│   │       ├── AccountClientController.php    # Client auth (Google, OTP)
│   │       ├── BlogController.php             # Quản lý blog
│   │       ├── ChiTietChucNangController.php  # Phân quyền chi tiết
│   │       ├── ChucNangController.php         # Quản lý chức năng
│   │       ├── ChucVuController.php           # Quản lý chức vụ
│   │       ├── DanhGiaController.php          # Đánh giá tour
│   │       ├── DiaDiemController.php          # Quản lý địa điểm
│   │       ├── HoaDonController.php           # Quản lý hóa đơn
│   │       ├── KhachHangController.php        # Quản lý khách hàng
│   │       ├── KhuyenMaiController.php        # Quản lý khuyến mãi
│   │       ├── LichTrinhTourController.php    # Lịch trình tour
│   │       ├── MomoController.php             # Thanh toán MoMo
│   │       ├── NhanVienController.php         # Quản lý nhân viên
│   │       ├── QuanHuyenController.php        # Quản lý quận huyện
│   │       ├── ThongKeController.php          # Thống kê báo cáo
│   │       ├── TinhThanhController.php        # Quản lý tỉnh thành
│   │       ├── Tour.php (Controller)          # Quản lý tour
│   │       ├── WishlistController.php         # Yêu thích
│   │       └── YeuCauHuyController.php        # Yêu cầu hủy
│   └── Models/
│       ├── Blog.php
│       ├── ChiTietChucNang.php
│       ├── ChiTietHoaDon.php
│       ├── ChiTietTour.php
│       ├── ChucNang.php
│       ├── ChucVu.php
│       ├── DanhGia.php
│       ├── DiaDiem.php
│       ├── HoaDon.php
│       ├── KhachHang.php
│       ├── KhuyenMai.php
│       ├── LichTrinhTour.php
│       ├── NhanVien.php
│       ├── QuanHuyen.php
│       ├── TinhThanh.php
│       ├── Tour.php
│       ├── User.php
│       ├── Wishlist.php
│       └── Yeucauhuy.php
├── config/                    # Cấu hình Laravel
├── database/
│   └── migrations/            # 29 migration files
├── routes/
│   ├── api.php                # API endpoints chính
│   └── web.php                # Web routes
└── .env.example               # Mẫu cấu hình
```

### Frontend (`tour_fe-master/`)

```
tour_fe-master/
├── src/
│   ├── core/
│   │   ├── baseRequest.js          # Axios client cho Admin API
│   │   ├── baseRequestClient.js    # Axios client cho Client API
│   │   └── chatbotService.js       # Service chatbot
│   ├── router/
│   │   ├── index.js                # Định nghĩa routes (29 routes)
│   │   ├── checkLogin.js           # Middleware kiểm tra admin login
│   │   └── checkLoginClient.js     # Middleware kiểm tra client login
│   ├── layout/
│   │   ├── components/             # MenuClient, FooterClient, ChatbotAI
│   │   ├── wrapper/                # Layout wrappers (client, admin, auth, bill)
│   │   └── imgaes/                 # Hình ảnh tĩnh
│   └── components/
│       ├── Admin/ (13 modules)
│       │   ├── Blog/
│       │   ├── DangNhap/
│       │   ├── DiaDiem/
│       │   ├── HoaDon/
│       │   ├── KhachHang/
│       │   ├── KhuyenMai/
│       │   ├── NhanVien/
│       │   ├── PhanQuyen/
│       │   ├── QuanHuyen/
│       │   ├── ThongKeBaoCao/
│       │   ├── TinhThanh/
│       │   ├── Tour/
│       │   └── YeuCauHuy/
│       └── Client/ (16 modules)
│           ├── Blog/
│           ├── ChiTietTour/
│           ├── DangKy/
│           ├── DangNhap/
│           ├── DanhSachHoaDon/
│           ├── DanhSachTour/
│           ├── GoogleCallback.vue
│           ├── HoaDon/
│           ├── KetQuaThanhToan/
│           ├── QuenMatKhau/
│           ├── TimKiemTour/
│           ├── TrangCaNhan/
│           ├── TrangChu/
│           ├── Wishlist/
│           └── YeuCau/
└── package.json
```

---

## 🗄 Cơ Sở Dữ Liệu

### Danh Sách Bảng (29 migrations)

| # | Bảng | Mô tả |
|---|------|-------|
| 1 | `users` | Người dùng Laravel mặc định |
| 2 | `password_reset_tokens` | Token reset mật khẩu |
| 3 | `failed_jobs` | Jobs thất bại |
| 4 | `personal_access_tokens` | Token Sanctum |
| 5 | `nhan_viens` | Nhân viên |
| 6 | `chuc_vus` | Chức vụ (vai trò) |
| 7 | `dia_diems` | Địa điểm du lịch |
| 8 | `chuc_nangs` | Chức năng hệ thống |
| 9 | `chi_tiet_chuc_nangs` | Phân quyền chi tiết (chức vụ ↔ chức năng) |
| 10 | `tinh_thanhs` | Tỉnh/thành phố |
| 11 | `quan_huyens` | Quận/huyện |
| 12 | `khach_hangs` | Khách hàng |
| 13 | `chi_tiet_tours` | Chi tiết tour (địa điểm & tour) |
| 14 | `hoa_dons` | Hóa đơn |
| 15 | `tours` | Tour du lịch |
| 16 | `chi_tiet_hoa_dons` | Chi tiết hóa đơn (tour trong hóa đơn) |
| 17 | `blogs` | Bài viết blog |
| 18 | `wishlists` | Danh sách yêu thích |
| 19 | `yeu_cau_huys` | Yêu cầu hủy tour |
| 20 | `lich_trinh_tours` | Lịch trình tour |
| 21 | `khuyen_mais` | Mã khuyến mãi |
| 22 | `danh_gias` | Đánh giá tour |

### Mô Hình Quan Hệ Chính

```
Tours ──── LichTrinhTours (1-n)
Tours ──── ChiTietTours ──── DiaDiems (n-n)
Tours ──── DanhGias (1-n)
Tours ──── Wishlists (1-n)

HoaDons ──── ChiTietHoaDons ──── Tours (1-n)
HoaDons ──── KhachHangs (n-1)

NhanViens ──── ChucVus (n-1)
ChucVus ──── ChiTietChucNangs ──── ChucNangs (n-n)

TinhThanhs ──── QuanHuyens (1-n)
KhachHangs ──── YeuCauHuys (1-n)
```

---

## 🔌 API Endpoints

> Base URL: `http://localhost:8000/api`

### 🔐 Xác Thực Admin

| Method | Endpoint | Mô tả |
|--------|----------|-------|
| POST | `/account-admin/login` | Đăng nhập admin |
| POST | `/account-admin/register` | Đăng ký admin |
| POST | `/account-admin/check` | Kiểm tra đăng nhập |
| GET | `/account-admin/dang-xuat` | Đăng xuất |
| GET | `/account-admin/kiem-tra-token-client` | Kiểm tra token |

### 👥 Xác Thực Khách Hàng

| Method | Endpoint | Mô tả |
|--------|----------|-------|
| POST | `/account-client/login` | Đăng nhập |
| POST | `/account-client/register` | Đăng ký |
| POST | `/account-client/gui-otp-dang-ky` | Gửi OTP đăng ký |
| POST | `/account-client/gui-otp` | Gửi OTP quên mật khẩu |
| POST | `/account-client/xac-thuc-otp` | Xác thực OTP |
| POST | `/account-client/tao-mat-khau-moi` | Tạo mật khẩu mới |
| GET | `/auth/google/redirect` | Đăng nhập Google |
| GET | `/auth/google/callback` | Callback Google |

### 🎫 Tour (Client)

| Method | Endpoint | Mô tả |
|--------|----------|-------|
| GET | `/tour/lay-du-lieu-client` | Danh sách tour |
| POST | `/client/tour/lay-chi-tiet-tour/data` | Chi tiết tour |
| POST | `/client/tour/tim-kiem` | Tìm kiếm tour |
| GET | `/client/tour/gia-tour-range` | Khoảng giá tour |

### 🛒 Giỏ Hàng & Hóa Đơn

| Method | Endpoint | Mô tả |
|--------|----------|-------|
| POST | `/client/hoa-don/dat-tour` | Đặt tour |
| POST | `/client/gio-hang/them-vao-gio-hang` | Thêm vào giỏ |
| POST | `/client/gio-hang/xac-nhan-hoa-don` | Xác nhận hóa đơn |
| POST | `/client/hoa-don/lay-danh-sach-hoa-don/data` | DS hóa đơn |
| POST | `/client/hoa-don/doi-trang-thai` | Đổi trạng thái |

### 💳 Thanh Toán MoMo

| Method | Endpoint | Mô tả |
|--------|----------|-------|
| POST | `/momo/atm-payment` | Tạo thanh toán MoMo |
| POST | `/client/momo/ipn` | IPN handler (webhook) |
| GET | `/client/ket-qua-thanh-toan` | Kết quả thanh toán |

### 💬 Chatbot

| Method | Endpoint | Mô tả |
|--------|----------|-------|
| POST | `/chatbot/question` | Gửi câu hỏi cho AI |

### ⭐ Đánh giá

| Method | Endpoint | Mô tả |
|--------|----------|-------|
| GET | `/danh-gia/lay-du-lieu/{id_tour}` | Lấy đánh giá tour |
| POST | `/danh-gia/them-moi` | Thêm đánh giá |

### Admin (CRUD đầy đủ)

| Nhóm | Các endpoint |
|------|-------------|
| `/admin/tinh-thanh/*` | lay-du-lieu, tim, them-moi, xoa, cap-nhat, doi-tinh-trang |
| `/admin/quan-huyen/*` | lay-du-lieu, tim, them-moi, xoa, cap-nhat, doi-tinh-trang |
| `/admin/nhan-vien/*` | lay-du-lieu, tim, them-moi, xoa, cap-nhat, doi-tinh-trang |
| `/admin/dia-diem/*` | lay-du-lieu, tim, them-moi, xoa, cap-nhat, doi-tinh-trang |
| `/admin/tour/*` | lay-du-lieu, tim, them-moi, xoa, cap-nhat, doi-tinh-trang |
| `/admin/lich-trinh/*` | lay-du-lieu, them-moi, cap-nhat, xoa |
| `/admin/hoa-don/*` | lay-du-lieu, doi-tinh-trang, xac-nhan, huy, xoa, tim |
| `/admin/khach-hang/*` | lay-du-lieu, tim, them-moi, xoa, cap-nhat, doi-tinh-trang |
| `/admin/blog/*` | lay-du-lieu, them-moi, cap-nhat, xoa |
| `/admin/khuyen-mai/*` | data, create, update, delete, status |
| `/admin/yeu-cau-huy/*` | lay-du-lieu, duyet, tu-choi |
| `/admin/phan-quyen/*` | cap-quyen, lay-du-lieu, xoa-quyen |
| `/admin/thong-ke/*` | tong-quan, doanh-thu |

---

## ❓ FAQ & Khắc Phục Lỗi

### Lỗi thường gặp

| Vấn đề | Nguyên nhân | Giải pháp |
|--------|-------------|-----------|
| `419 Page Expired` | Thiếu CSRF token | Đảm bảo gọi API qua Axios, bỏ qua CSRF trong `VerifyCsrfToken.php` cho API routes |
| `SQLSTATE[HY000] [1045]` | Sai thông tin DB | Kiểm tra `.env`, đảm bảo database đã được tạo |
| `Class "..." not found` | Chưa chạy `composer dump-autoload` | Chạy `composer dump-autoload` |
| MoMo payment không hoạt động | Sai key/sai endpoint | Kiểm tra MoMo partnerCode, accessKey, secretKey trong Controller |
| Google login lỗi `401` | Chưa cấu hình OAuth | Kiểm tra Google Client ID/Secret, redirect URL trong `.env` |
| Chatbot trả về lỗi | Thiếu hoặc sai Gemini API Key | Cấu hình `GEMINI_API_KEY` trong `.env` |
| OTP không gửi được | Lỗi SMTP | Cấu hình đúng SMTP hoặc dùng mailtrap.io để test |

### Câu hỏi thường gặp

**Q: Làm sao để tạo tài khoản admin đầu tiên?**\
A: Đăng ký qua endpoint `POST /api/account-admin/register` hoặc chạy seeder.

**Q: Làm sao để test thanh toán MoMo?**\
A: Hệ thống đang dùng MoMo test environment. Dùng thông tin test card từ MoMo.

**Q: Làm sao để reset database?**\
A: Chạy `php artisan migrate:fresh` để xóa và tạo lại tất cả bảng.

**Q: Frontend gọi API bị CORS?**\
A: Kiểm tra config `cors.php` và thêm `'supports_credentials' => true`.

---

## 🤝 Đóng Góp

Chúng tôi hoan nghênh mọi đóng góp từ cộng đồng! Vui lòng:

1. Fork repository
2. Tạo branch mới: `git checkout -b feature/ten-tinh-nang`
3. Commit thay đổi: `git commit -m "Thêm tính năng XYZ"`
4. Push lên branch: `git push origin feature/ten-tinh-nang`
5. Tạo Pull Request

### Điều kiện được chấp nhận

- Code tuân theo chuẩn PSR-12 (PHP) và Vue Style Guide
- Có kiểm tra lỗi cơ bản trước khi tạo PR
- Mô tả rõ ràng về thay đổi
- Không chứa thông tin nhạy cảm (key, secret, password)

---

## 📄 Giấy Phép

<!-- Dự án được phân phối dưới giấy phép **MIT License**. Xem file `LICENSE` để biết thêm chi tiết. -->

---

## 📞 Liên Hệ & Hỗ Trợ

| Kênh | Thông tin |
|------|-----------|
| **Trường** | Đại học Duy Tân |
| **Nhóm** | Nhóm 93 - Đồ Án Tốt Nghiệp |
| **GitHub Issues** | Tạo issue trong repository để báo lỗi hoặc yêu cầu tính năng |

---

## 👏 Công Nhận

- **Thầy hướng dẫn**: Giảng viên hướng dẫn đồ án
- **Laravel Framework** - Framework backend xuất sắc
- **Vue.js Team** - Framework frontend mạnh mẽ
- **Google Gemini** - AI chatbot engine
- **MoMo** - Cổng thanh toán
- **Tất cả thành viên Nhóm 93** - Đã đóng góp và phát triển dự án

---

## 📚 Tài Liệu Tham Khảo

- [Laravel Documentation](https://laravel.com/docs/10.x)
- [Vue 3 Documentation](https://vuejs.org/guide/introduction.html)
- [Vue Router Documentation](https://router.vuejs.org/)
- [Vite Documentation](https://vitejs.dev/guide/)
- [Laravel Sanctum](https://laravel.com/docs/10.x/sanctum)
- [Laravel Socialite](https://laravel.com/docs/10.x/socialite)
- [Chart.js Documentation](https://www.chartjs.org/docs/)
- [MoMo Payment API](https://developers.momo.vn/)
- [Google Gemini API](https://ai.google.dev/)

---

## 📝 Lịch Sử Thay Đổi

| Phiên bản | Ngày | Mô tả |
|-----------|------|-------|
| 1.0.0 | 2026-05 | Update... |

## 🐛 Lỗi Đã Biết

- Tính năng VNPay chưa được hoàn thiện (route đã khai báo nhưng chưa có controller)
- Cần cập nhật MoMo secret key từ biến môi trường thay vì hardcode trong controller
- Chatbot chưa hỗ trợ lưu lịch sử hội thoại

---

<p align="center">
  <strong>© 2026 Nhóm 93 - Đồ Án Tốt Nghiệp</strong><br>
  Made with ❤️ by VivuTour Team
</p>
