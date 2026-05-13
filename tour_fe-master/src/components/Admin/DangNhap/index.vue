<template>
    <div class="admin-login-wrapper min-vh-100 d-flex align-items-center justify-content-center">
        <!-- Vệt màu trang trí phía trên -->
        <div class="top-accent"></div>

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-11 col-md-8 col-lg-5 col-xl-4">
                    
                    <!-- Phần Logo Admin -->
                    <div class="text-center mb-4 animate__animated animate__fadeInDown">
                        <div class="brand-logo-custom">
                            <!-- Icon Khiên bảo mật tượng trưng cho Admin -->
                            <i class="fa-solid fa-user-shield brand-icon"></i>
                            <div class="brand-text">
                                <span class="brand-name">VIET<span class="brand-highlight">TOUR</span></span>
                                <span class="brand-slogan">Admin Portal</span>
                            </div>
                        </div>
                    </div>

                    <!-- Khối Form Đăng Nhập -->
                    <div class="card login-card border-0 shadow-lg rounded-4 animate__animated animate__fadeInUp">
                        <div class="card-body p-4 p-md-5">
                            <div class="text-center mb-4">
                                <h4 class="fw-bold text-dark mb-1">Đăng Nhập Quản Trị</h4>
                                <p class="text-muted small">Vui lòng nhập thông tin để truy cập hệ thống</p>
                            </div>

                            <form @submit.prevent="dangNhap" class="row g-3">
                                <!-- Email Input -->
                                <div class="col-12">
                                    <label class="form-label-custom">Email quản trị</label>
                                    <div class="input-group-custom">
                                        <i class="fa-solid fa-envelope input-icon"></i>
                                        <input v-model="dang_nhap.email" type="email" class="form-control custom-input" 
                                            placeholder="admin@viettour.com" required>
                                    </div>
                                </div>

                                <!-- Password Input -->
                                <div class="col-12">
                                    <label class="form-label-custom">Mật khẩu</label>
                                    <div class="input-group-custom">
                                        <i class="fa-solid fa-lock input-icon"></i>
                                        <input v-model="dang_nhap.password" type="password" class="form-control custom-input" 
                                            placeholder="Nhập mật khẩu" required>
                                    </div>
                                </div>

                                <!-- Button Đăng Nhập -->
                                <div class="col-12 mt-4 pt-2">
                                    <button type="submit" class="btn btn-admin-login w-100 py-2 rounded-pill fw-bold shadow-sm">
                                        <i class="fa-solid fa-right-to-bracket me-2"></i> ĐĂNG NHẬP
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    
                    <!-- Footer Admin -->
                    <div class="text-center mt-4 text-muted font-12 opacity-75">
                        &copy; 2024 VietTour Management System. All rights reserved.
                    </div>

                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import { createToaster } from "@meforma/vue-toaster";
const toaster = createToaster({ position: "top-right" });

export default {
    data() {
        return {
            dang_nhap: {},
        }
    },
    mounted() {
        this.checkToken();
    },
    methods: {
        dangNhap() {
            axios
                .post('http://127.0.0.1:8000/api/account-admin/login', this.dang_nhap)
                .then((res) => {
                    if (res.data.status) {
                        toaster.success('Thông báo<br>' + res.data.message);
                        var arr = res.data.token.split("|");
                        localStorage.setItem('token', arr[1]);
                        this.checkToken();
                        this.$router.push('/admin/nhan-vien');
                    } else {
                        toaster.error('Thông báo<br>' + res.data.message);
                    }
                })
                .catch(() => {
                    toaster.error('Đăng nhập thất bại, vui lòng kiểm tra lại thông tin.');
                });
        },
        checkToken() {
            const token = localStorage.getItem('token');
            if(!token) return;

            axios
                .post('http://127.0.0.1:8000/api/account-admin/check', {}, {
                    headers: {
                        Authorization: 'Bearer ' + token
                    }
                })
                .then((res) => {
                    localStorage.setItem('ho_ten', res.data.ho_ten);
                    if (res.status === 200) {
                        this.list_token = res.data.list;
                        this.$router.push('/admin/nhan-vien');
                    } 
                    if (res.status === 401) {
                        toaster.error('Thông báo<br>' + res.message);
                    }
                })
                .catch(() => {
                    // Xử lý lỗi ngầm nếu token sai hoặc hết hạn
                });
        },
    },
}
</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@300;400;500;600;700;800&display=swap');

.admin-login-wrapper {
    font-family: 'Be Vietnam Pro', sans-serif;
    background-color: #f1f5f9; /* Nền xám xanh nhẹ mang tính kỹ thuật/quản trị */
    position: relative;
    overflow: hidden;
}

/* ── HIỆU ỨNG TRANG TRÍ ── */
.top-accent {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 6px;
    background: linear-gradient(90deg, #0d7a5f, #10b981, #e8a020);
}

/* ── LOGO ADMIN CUSTOM ── */
.brand-logo-custom {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 12px;
}
.brand-icon {
    width: 48px;
    height: 48px;
    background-color: #1a1f2e; /* Đổi màu xanh cực đậm cho Admin */
    color: #e8a020;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
    border-radius: 14px 4px 14px 4px;
    box-shadow: 0 4px 12px rgba(26, 31, 46, 0.2);
}
.brand-text {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    line-height: 1;
}
.brand-name {
    font-size: 28px;
    font-weight: 800;
    color: #1a1f2e;
    letter-spacing: 0.5px;
}
.brand-highlight {
    color: #0d7a5f;
}
.brand-slogan {
    font-size: 12px;
    font-weight: 700;
    color: #dc3545; /* Slogan màu đỏ cảnh báo hệ thống Admin */
    letter-spacing: 2px;
    text-transform: uppercase;
    margin-top: 4px;
}

/* ── CARD & FORM ── */
.login-card {
    border-radius: 20px;
    border-top: 1px solid #fff;
}
.form-label-custom {
    font-size: 13px;
    font-weight: 700;
    color: #4b5563;
    margin-bottom: 8px;
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
    padding: 12px 12px 12px 42px; /* Dịch text sang phải cho icon */
    font-size: 14px;
    font-weight: 500;
    background-color: #f9fafb;
    transition: all 0.2s;
}
.custom-input:focus {
    background-color: #fff;
    border-color: #0d7a5f;
    box-shadow: 0 0 0 4px rgba(13, 122, 95, 0.1);
}

/* ── BUTTON ── */
.btn-admin-login {
    background-color: #1a1f2e; 
    color: #fff;
    font-size: 14px;
    transition: all 0.3s;
    border: none;
    letter-spacing: 1px;
}
.btn-admin-login:hover {
    background-color: #0d7a5f; 
    transform: translateY(-2px);
    box-shadow: 0 8px 15px rgba(13, 122, 95, 0.25) !important;
}

.font-12 { font-size: 12px; }
</style>