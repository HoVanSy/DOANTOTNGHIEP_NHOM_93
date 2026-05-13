<template>
    <div class="login-wrapper min-vh-100 d-flex align-items-center justify-content-center py-5">
        <!-- Progress bar chạy ngang màn hình giả lập loading -->
        <div class="pace-custom"></div>
        
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-11 col-md-10 col-lg-7 col-xl-6">
                    
                    <!-- Phần Logo -->
                    <div class="text-center mb-4 animate__animated animate__fadeInDown">
                        <router-link to="/" class="text-decoration-none">
                            <div class="brand-logo-custom">
                                <i class="fa-solid fa-plane-departure brand-icon"></i>
                                <div class="brand-text">
                                    <span class="brand-name">VIET<span class="brand-highlight">TOUR</span></span>
                                    <span class="brand-slogan">Travel & Explore</span>
                                </div>
                            </div>
                        </router-link>
                    </div>

                    <!-- Khối Form Đăng Ký -->
                    <div class="card login-card border-0 shadow-lg rounded-4 animate__animated animate__fadeInUp">
                        <div class="card-body p-4 p-md-5">
                            <div class="text-center mb-4">
                                <h4 class="fw-bold text-dark mb-1">Tạo Tài Khoản</h4>
                                <p class="text-muted small">Chào mừng bạn đến với VietTour - Bắt đầu hành trình ngay!</p>
                            </div>

                            <form @submit.prevent="dangKy" class="row g-3">
                                <!-- Họ và tên -->
                                <div class="col-12">
                                    <label class="form-label-custom">Họ và tên</label>
                                    <div class="input-group-custom">
                                        <i class="fa-solid fa-user input-icon"></i>
                                        <input v-model="dang_ky.ho_ten" type="text" class="form-control custom-input" 
                                            placeholder="Nhập họ và tên của bạn" required>
                                    </div>
                                </div>

                                <!-- Email -->
                                <div class="col-12">
                                    <label class="form-label-custom">Email</label>
                                    <div class="input-group-custom">
                                        <i class="fa-solid fa-envelope input-icon"></i>
                                        <input v-model="dang_ky.email" type="email" class="form-control custom-input" 
                                            placeholder="name@example.com" required>
                                    </div>
                                </div>

                                <!-- Số điện thoại -->
                                <div class="col-md-6">
                                    <label class="form-label-custom">Số điện thoại</label>
                                    <div class="input-group-custom">
                                        <i class="fa-solid fa-phone input-icon"></i>
                                        <input v-model="dang_ky.so_dien_thoai" type="text" class="form-control custom-input" 
                                            placeholder="Nhập số điện thoại" required>
                                    </div>
                                </div>

                                <!-- Giới tính -->
                                <div class="col-md-6">
                                    <label class="form-label-custom">Giới tính</label>
                                    <div class="input-group-custom">
                                        <i class="fa-solid fa-venus-mars input-icon"></i>
                                        <select v-model="dang_ky.gioi_tinh" class="form-select custom-input" required>
                                            <option value="" disabled selected>Chọn giới tính</option>
                                            <option value="0">Nam</option>
                                            <option value="1">Nữ</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Ngày sinh -->
                                <div class="col-md-6">
                                    <label class="form-label-custom">Ngày sinh</label>
                                    <div class="input-group-custom">
                                        <i class="fa-solid fa-calendar-day input-icon"></i>
                                        <input v-model="dang_ky.ngay_sinh" type="date" class="form-control custom-input" required>
                                    </div>
                                </div>

                                <!-- Mật khẩu -->
                                <div class="col-md-6">
                                    <label class="form-label-custom">Mật khẩu</label>
                                    <div class="input-group-custom">
                                        <i class="fa-solid fa-lock input-icon"></i>
                                        <input v-model="dang_ky.password" type="password" class="form-control custom-input" 
                                            placeholder="Tạo mật khẩu" required>
                                    </div>
                                </div>

                                <!-- Địa chỉ / Tỉnh thành -->
                                <div class="col-12">
                                    <label class="form-label-custom">Tỉnh / Thành phố</label>
                                    <div class="input-group-custom">
                                        <i class="fa-solid fa-map-location-dot input-icon"></i>
                                        <select v-model="dang_ky.dia_chi" class="form-select custom-input" required>
                                            <option value="" disabled selected>Chọn Tỉnh / Thành phố</option>
                                            <option v-for="(v, k) in list_tinh_thanh" :key="v.id" :value="v.id">
                                                {{ v.ten_tinh_thanh }}
                                            </option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Checkbox Đồng ý điều khoản -->
                                <div class="col-12 mt-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="termsCheck" required>
                                        <label class="form-check-label font-13 text-muted" for="termsCheck">
                                            Tôi đã đọc và đồng ý với <a href="#" class="text-primary-dark text-decoration-none fw-semibold">Điều khoản & Dịch vụ</a>
                                        </label>
                                    </div>
                                </div>

                                <!-- Button Đăng Ký -->
                                <div class="col-12 mt-4">
                                    <button type="submit" class="btn btn-login w-100 py-2 rounded-pill fw-bold shadow-sm">
                                        <i class="fa-solid fa-user-plus me-2"></i>TẠO TÀI KHOẢN
                                    </button>
                                </div>
                            </form>

                            <!-- Line chia -->
                            <div class="login-separator my-4">
                                <span class="bg-white px-3 text-muted small">Hoặc</span>
                            </div>

                            <!-- Footer Login -->
                            <div class="text-center mt-3 font-14">
                                <span class="text-muted">Đã có tài khoản?</span>
                                <router-link to="/client/dang-nhap" class="fw-bold ms-1 register-link">
                                    Đăng nhập ngay
                                </router-link>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { createToaster } from "@meforma/vue-toaster";
const toaster = createToaster({ position: "top-right" });
import axios from 'axios';
import baseRequest from "../../../core/baseRequestClient";

export default {
    data() {
        return {
            dang_ky: {
                ho_ten: '',
                email: '',
                so_dien_thoai: '',
                gioi_tinh: '',
                password: '',
                ngay_sinh: '',
                dia_chi: ''
            },
            list_tinh_thanh: [],
        };
    },
    mounted() {
        this.loadDataTinhThanh();
    },
    methods: {
        dangKy() {
            axios
                .post('http://127.0.0.1:8000/api/account-client/register', this.dang_ky)
                .then((res) => {
                    if (res.data.status) {
                        toaster.success('Thông báo<br>' + res.data.message);
                        this.$router.push('/client/dang-nhap');
                    } else {
                        toaster.error('Thông báo<br>' + res.data.message);
                    }
                })
                .catch((res) => {
                    if (res.response && res.response.data && res.response.data.errors) {
                        var result = Object.entries(res.response.data.errors);
                        result.forEach((v) => {
                            toaster.error(v[1][0]);
                        });
                    } else {
                        toaster.error("Có lỗi xảy ra trong quá trình đăng ký.");
                    }
                });
        },

        loadDataTinhThanh() {
            baseRequest
                .get('client/tinh-thanh/lay-du-lieu')
                .then((res) => {
                    this.list_tinh_thanh = res.data.tinh_thanh;
                });
        },
    }
}
</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@300;400;500;600;700;800&display=swap');

.login-wrapper {
    font-family: 'Be Vietnam Pro', sans-serif;
    background-color: #f8f7f4;
    background-image: radial-gradient(#e6f5f0 1px, transparent 1px);
    background-size: 20px 20px;
    position: relative;
}

/* ── PROGRESS BAR ── */
.pace-custom {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 4px;
    background: linear-gradient(90deg, #0d7a5f, #e8a020);
    animation: loadingBar 1.5s ease-in-out forwards;
}
@keyframes loadingBar {
    0% { width: 0%; opacity: 1; }
    90% { width: 100%; opacity: 1; }
    100% { width: 100%; opacity: 0; }
}

/* ── LOGO CUSTOM ── */
.brand-logo-custom {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
}
.brand-icon {
    width: 45px;
    height: 45px;
    background-color: #0d7a5f;
    color: #e8a020;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 22px;
    border-radius: 12px 4px 12px 4px;
    box-shadow: 0 4px 10px rgba(13, 122, 95, 0.2);
}
.brand-text {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    line-height: 1;
}
.brand-name {
    font-size: 26px;
    font-weight: 800;
    color: #0d7a5f;
    letter-spacing: 0.5px;
}
.brand-highlight {
    color: #e8a020;
}
.brand-slogan {
    font-size: 11px;
    font-weight: 700;
    color: #6c757d;
    letter-spacing: 1.5px;
    text-transform: uppercase;
    margin-top: 4px;
}

/* ── CARD & FORM ── */
.login-card {
    border-radius: 20px;
}
.form-label-custom {
    font-size: 13px;
    font-weight: 700;
    color: #1a1f2e;
    margin-bottom: 6px;
    display: block;
}

.input-group-custom {
    position: relative;
    display: flex;
    align-items: center;
}
.input-icon {
    position: absolute;
    left: 16px;
    color: #9ca3af;
    font-size: 14px;
    z-index: 10;
}
.custom-input {
    border-radius: 12px;
    border: 1px solid #e5e7eb;
    padding: 10px 10px 10px 42px; /* Dịch text sang phải để nhường chỗ cho icon */
    font-size: 13px;
    font-weight: 500;
    background-color: #f9fafb;
    transition: all 0.2s;
}
.custom-input:focus {
    background-color: #fff;
    border-color: #0d7a5f;
    box-shadow: 0 0 0 4px rgba(13, 122, 95, 0.1);
}

/* Fix hiển thị icon trên thẻ Select */
select.custom-input {
    appearance: none;
    -webkit-appearance: none;
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23343a40' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/%3e%3c/svg%3e");
    background-repeat: no-repeat;
    background-position: right 1rem center;
    background-size: 16px 12px;
}

/* ── Checkbox ── */
.form-check-input:checked {
    background-color: #0d7a5f;
    border-color: #0d7a5f;
}
.form-check-input:focus {
    box-shadow: 0 0 0 0.25rem rgba(13, 122, 95, 0.25);
}

/* ── LINKS ── */
.text-primary-dark {
    color: #0d7a5f;
}
.register-link {
    color: #0d7a5f;
    text-decoration: none;
    transition: 0.2s;
}
.register-link:hover {
    color: #e8a020;
}

/* ── BUTTON ── */
.btn-login {
    background-color: #0d7a5f;
    color: #fff;
    font-size: 14px;
    transition: all 0.3s;
    border: none;
}
.btn-login:hover {
    background-color: #085544;
    transform: translateY(-2px);
    box-shadow: 0 8px 15px rgba(13, 122, 95, 0.2) !important;
}

/* ── LINE SEPARATOR ── */
.login-separator {
    position: relative;
    text-align: center;
}
.login-separator::before {
    content: '';
    position: absolute;
    top: 50%;
    left: 0;
    right: 0;
    height: 1px;
    background-color: #e5e7eb;
    z-index: 1;
}
.login-separator span {
    position: relative;
    z-index: 2;
}

.font-13 { font-size: 13px; }
.font-14 { font-size: 14px; }
</style>