<template>
    <header class="admin-header shadow-sm bg-white sticky-top">
        <div class="d-flex align-items-center justify-content-between px-3 px-md-4 py-2 h-100">
            
            <div class="topbar-logo">
                <router-link to="/admin/nhan-vien" class="text-decoration-none">
                    <div class="brand-logo-custom">
                        <i class="fa-solid fa-user-shield brand-icon"></i>
                        <div class="brand-text d-none d-sm-flex">
                            <span class="brand-name">VIVU<span class="brand-highlight">TOUR</span></span>
                            <span class="brand-slogan">Admin Portal</span>
                        </div>
                    </div>
                </router-link>
            </div>

            <div class="top-menu ms-auto d-flex align-items-center gap-3">
                
                <div class="d-none d-md-flex align-items-center gap-3 me-3">
                    <a href="#" class="nav-icon position-relative text-muted">
                        <i class="fa-regular fa-bell fs-5"></i>
                        <span class="alert-badge bg-danger">7</span>
                    </a>
                    <a href="#" class="nav-icon position-relative text-muted">
                        <i class="fa-regular fa-comment fs-5"></i>
                        <span class="alert-badge bg-primary">8</span>
                    </a>
                </div>

                <div class="vr d-none d-md-block text-muted"></div>

                <template v-if="is_check == false">
                    <router-link to="/admin/dang-nhap" class="text-decoration-none">
                        <button class="btn btn-admin-login rounded-pill px-4" type="button">
                            <i class="fa-solid fa-lock me-2"></i> Đăng Nhập
                        </button>
                    </router-link>
                </template>

                <template v-else>
                    <div class="user-box dropdown">
                        <a class="d-flex align-items-center nav-link dropdown-toggle-nocaret text-decoration-none" 
                           href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <div class="user-avatar bg-primary-dark text-white fw-bold d-flex align-items-center justify-content-center rounded-circle">
                                {{ ten_hien_thi.charAt(0).toUpperCase() }}
                            </div>
                            
                            <div class="user-info ps-2 d-none d-md-block">
                                <p class="user-name mb-0 fw-bold text-dark">{{ ten_hien_thi }}</p>
                                <p class="designation mb-0 text-muted small font-12">Quản trị viên</p>
                            </div>
                            <i class="fa-solid fa-chevron-down ms-3 text-muted small d-none d-md-block"></i>
                        </a>

                        <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-3 rounded-3 p-2">
                            <li class="px-2 py-1 mb-1">
                                <span class="d-block text-muted small fw-bold text-uppercase letter-spacing">Tài khoản</span>
                            </li>
                            <li>
                                <a @click="dangXuat()" class="dropdown-item py-2 rounded-2 custom-dropdown-item cursor-pointer">
                                    <i class="fa-solid fa-right-from-bracket me-2 text-muted"></i>Đăng xuất
                                </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider my-2">
                            </li>
                            <li>
                                <a @click="dangXuatAll()" class="dropdown-item py-2 rounded-2 text-danger custom-dropdown-item cursor-pointer bg-light-danger">
                                    <i class="fa-solid fa-power-off me-2"></i>Đăng xuất tất cả thiết bị
                                </a>
                            </li>
                        </ul>
                    </div>
                </template>
            </div>
        </div>
    </header>
</template>

<script>
import axios from "axios";
import baseRequest from '../../core/baseRequest';
import { createToaster } from "@meforma/vue-toaster";
const toaster = createToaster({ position: "top-right" });

export default {
    data() {
        return {
            ten_hien_thi: 'Chưa đăng nhập',
            is_check: false,
        }
    },
    mounted() {
        this.checkLogin();
    },
    methods: {
        dangXuat() {
            baseRequest
                .get('account-admin/dang-xuat')
                .then((res) => {
                    if (res.data.status) {
                        toaster.success('Thông báo<br>' + res.data.message);
                        this.$router.push('/admin/dang-nhap');
                    } else {
                        toaster.error('Thông báo<br>' + res.data.message);
                    }
                });
        },
        dangXuatAll() {
            baseRequest
                .get('account-admin/dang-xuat-tat-ca')
                .then((res) => {
                    if (res.data.status) {
                        toaster.success('Thông báo<br>' + res.data.message);
                        this.$router.push('/admin/dang-nhap');
                    } else {
                        toaster.error('Thông báo<br>' + res.data.message);
                    }
                });
        },
        checkLogin() {
            axios
                .get('http://127.0.0.1:8000/api/account-admin/kiem-tra-token-client', {
                    headers: {
                        Authorization: 'Bearer ' + localStorage.getItem("token")
                    }
                })
                .then((res) => {
                    if (res.data.status) {
                        this.is_check = true;
                        this.ten_hien_thi = localStorage.getItem('ho_ten') || 'Admin';
                    }
                })
                .catch(() => {
                    this.is_check = false;
                });
        },
    },
}
</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@300;400;500;600;700;800&display=swap');

/* ── HEADER CƠ BẢN ── */
.admin-header {
    font-family: 'Be Vietnam Pro', sans-serif;
    height: 70px;
    border-bottom: 1px solid #f0ede8;
    z-index: 1000;
}

/* ── LOGO ADMIN ── */
.brand-logo-custom {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
}
.brand-icon {
    width: 40px;
    height: 40px;
    background-color: #1a1f2e; /* Xanh than đậm */
    color: #e8a020;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 18px;
    border-radius: 10px 3px 10px 3px;
    box-shadow: 0 4px 8px rgba(26, 31, 46, 0.15);
}
.brand-text {
    flex-direction: column;
    align-items: flex-start;
    line-height: 1;
}
.brand-name {
    font-size: 22px;
    font-weight: 800;
    color: #1a1f2e;
    letter-spacing: 0.5px;
}
.brand-highlight {
    color: #0d7a5f;
}
.brand-slogan {
    font-size: 10px;
    font-weight: 700;
    color: #dc3545;
    letter-spacing: 1.5px;
    text-transform: uppercase;
    margin-top: 3px;
}

/* ── ICON THÔNG BÁO ── */
.nav-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 38px;
    height: 38px;
    border-radius: 50%;
    background-color: #f8f9fa;
    transition: 0.2s;
}
.nav-icon:hover {
    background-color: #e2e8f0;
    color: #1a1f2e !important;
}
.alert-badge {
    position: absolute;
    top: -2px;
    right: -2px;
    font-size: 10px;
    font-weight: bold;
    color: white;
    width: 18px;
    height: 18px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    border: 2px solid #fff;
}

/* ── KHU VỰC USER ── */
.user-avatar {
    width: 42px;
    height: 42px;
    font-size: 18px;
    background-color: #1a1f2e;
}
.text-primary-dark {
    background-color: #0d7a5f !important;
}
.dropdown-toggle-nocaret::after {
    display: none;
}
.cursor-pointer {
    cursor: pointer;
}

/* ── DROPDOWN MENU ── */
.dropdown-menu {
    min-width: 240px;
}
.custom-dropdown-item {
    font-size: 14px;
    font-weight: 500;
    color: #4b5563;
    transition: 0.2s;
}
.custom-dropdown-item:hover {
    background-color: #f1f5f9;
    color: #1a1f2e;
}
.bg-light-danger {
    background-color: #fef2f2 !important;
}
.bg-light-danger:hover {
    background-color: #fee2e2 !important;
}
.letter-spacing {
    letter-spacing: 1px;
}

/* ── BUTTON LOGIN ── */
.btn-admin-login {
    background-color: #1a1f2e;
    color: #fff;
    font-weight: 600;
    font-size: 14px;
    transition: 0.3s;
}
.btn-admin-login:hover {
    background-color: #0d7a5f;
    color: #fff;
    transform: translateY(-1px);
    box-shadow: 0 4px 10px rgba(13, 122, 95, 0.2);
}

.font-12 { font-size: 12px; }
</style>