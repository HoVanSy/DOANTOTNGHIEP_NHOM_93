<template>
    <div class="login-wrapper min-vh-100 d-flex align-items-center justify-content-center">
        <div class="pace-custom"></div>
        
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-11 col-md-8 col-lg-5 col-xl-4">
                    
                    <div class="text-center mb-4 animate__animated animate__fadeInDown">
                        <router-link to="/" class="text-decoration-none">
                            <div class="brand-logo-custom">
                                <i class="fa-solid fa-plane-departure brand-icon"></i>
                                <div class="brand-text">
                                    <span class="brand-name">VIVU <span class="brand-highlight">TOUR</span></span>
                                    <span class="brand-slogan">Travel & Explore</span>
                                </div>
                            </div>
                        </router-link>
                    </div>

                    <div class="card login-card border-0 shadow-lg rounded-4 animate__animated animate__fadeInUp">
                        <div class="card-body p-4 p-md-5">
                            <div class="text-center mb-4">
                                <h4 class="fw-bold text-dark mb-1">Đăng Nhập</h4>
                                <p class="text-muted small">Chào mừng bạn quay trở lại với VietTour</p>
                            </div>

                            <form @submit.prevent="dangNhap" class="row g-3">
                                <div class="col-12">
                                    <label class="form-label-custom">Email đăng nhập</label>
                                    <div class="input-group-custom">
                                        <i class="fa-solid fa-envelope input-icon"></i>
                                        <input v-model="dang_nhap.email" type="email" class="form-control custom-input" 
                                            placeholder="name@example.com" required>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <label class="form-label-custom">Mật khẩu</label>
                                    <div class="input-group-custom">
                                        <i class="fa-solid fa-lock input-icon"></i>
                                        <input v-model="dang_nhap.password" type="password" class="form-control custom-input" 
                                            placeholder="Nhập mật khẩu" required>
                                    </div>
                                </div>

                                <div class="col-12 d-flex justify-content-between align-items-center mt-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="rememberMe" checked>
                                        <label class="form-check-label font-13 text-muted" for="rememberMe">
                                            Ghi nhớ đăng nhập
                                        </label>
                                    </div>
                                    <router-link to="/quen-mat-khau" class="text-decoration-none font-13 fw-semibold forgot-link">
                                        Quên mật khẩu?
                                    </router-link>
                                </div>

                                <div class="col-12 mt-4">
                                    <button type="submit" class="btn btn-login w-100 py-2 rounded-pill fw-bold shadow-sm">
                                        ĐĂNG NHẬP
                                        <i class="fa-solid fa-arrow-right ms-2"></i>
                                    </button>
                                </div>
                            </form>

                            <div class="login-separator my-4">
                                <span class="bg-white px-3 text-muted small fw-bold">Hoặc tiếp tục với</span>
                            </div>

                            <button @click="dangNhapGoogle" type="button" class="btn btn-google w-100 py-2 rounded-pill fw-bold shadow-sm d-flex align-items-center justify-content-center">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/c/c1/Google_%22G%22_logo.svg" alt="Google" class="me-2 google-icon">
                                Google
                            </button>

                            <div class="text-center mt-4 pt-2 font-14">
                                <span class="text-muted">Bạn chưa có tài khoản?</span>
                                <router-link to="/client/dang-ky" class="fw-bold ms-1 register-link">
                                    Đăng ký ngay
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
import axios from 'axios';
import { createToaster } from "@meforma/vue-toaster";
const toaster = createToaster({ position: "top-right" });

export default {
    data() {
        return {
            dang_nhap: {
                email: '',
                password: ''
            },
            id: ''
        }
    },
    mounted() {
        this.checkToken();
    },
    methods: {
        dangNhap() {
            axios
                .post('http://127.0.0.1:8000/api/account-client/login', this.dang_nhap)
                .then((res) => {
                    if (res.data.status) {
                        toaster.success('Đăng nhập thành công!');
                        var arr = res.data.token_client.split("|");
                        localStorage.setItem('token_client', arr[1]);
                        
                        this.checkToken();
                        
                        this.id = localStorage.getItem('id');
                        this.$router.push('/');
                    } else {
                        toaster.error('Lỗi: ' + res.data.message);
                    }
                })
                .catch((err) => {
                    console.error(err);
                    toaster.error('Có lỗi xảy ra, vui lòng thử lại sau.');
                });
        },

        dangNhapGoogle() {
            // Chuyển hướng trình duyệt sang API của Backend (Laravel Socialite)
            // Thay đường dẫn này bằng đúng route xử lý đăng nhập Google ở backend của bạn
            window.location.href = 'http://127.0.0.1:8000/api/auth/google/redirect';
        },

        checkToken() {
            const token = localStorage.getItem('token_client');
            if(!token) return;

            axios
                .post('http://127.0.0.1:8000/api/account-client/check', {}, {
                    headers: {
                        Authorization: 'Bearer ' + token
                    }
                })
                .then((res) => {
                    if (res.status === 200 && res.data.ho_ten_client) {
                        localStorage.setItem('ho_ten_client', res.data.ho_ten_client);
                        this.$router.push('/');
                    }
                })
                .catch((err) => {
                    if (err.response && err.response.status === 401) {
                        localStorage.removeItem('token_client');
                    }
                });
        },
    },
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
    padding: 12px 12px 12px 42px;
    font-size: 14px;
    font-weight: 500;
    background-color: #f9fafb;
    transition: all 0.2s;
}
.custom-input:focus {
    background-color: #fff;
    border-color: #0d7a5f;
    box-shadow: 0 0 0 4px rgba(13, 122, 95, 0.1);
    outline: none;
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
.forgot-link {
    color: #0d7a5f;
    transition: 0.2s;
}
.forgot-link:hover {
    color: #e8a020;
}
.register-link {
    color: #e8a020;
    text-decoration: none;
    transition: 0.2s;
}
.register-link:hover {
    color: #0d7a5f;
}

/* ── BUTTONS ── */
.btn-login {
    background-color: #0d7a5f;
    color: #fff;
    font-size: 15px;
    transition: all 0.3s;
    border: none;
}
.btn-login:hover {
    background-color: #085544;
    transform: translateY(-2px);
    box-shadow: 0 8px 15px rgba(13, 122, 95, 0.2) !important;
}

/* CSS cho Nút Google */
.btn-google {
    background-color: #fff;
    color: #3c4043;
    border: 1px solid #dadce0;
    font-size: 14px;
    transition: all 0.2s ease-in-out;
}
.btn-google:hover {
    background-color: #f8f9fa;
    border-color: #d2e3fc;
    box-shadow: 0 1px 2px 0 rgba(60,64,67,0.3), 0 1px 3px 1px rgba(60,64,67,0.15) !important;
    transform: translateY(-1px);
}
.google-icon {
    width: 20px;
    height: 20px;
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