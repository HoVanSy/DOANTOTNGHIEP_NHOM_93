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
                    <div class="dropdown notification-dropdown">
                        <a href="#" class="nav-icon position-relative text-muted" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-regular fa-bell fs-5"></i>
                            <span v-if="so_luong_thong_bao > 0" class="alert-badge bg-danger animate__animated animate__heartBeat animate__infinite">{{ so_luong_thong_bao }}</span>
                        </a>
                        
                        <ul class="dropdown-menu dropdown-menu-end shadow border-0 rounded-4 mt-3" style="width: 340px; padding: 0; overflow: hidden;">
                            <li class="bg-primary-dark text-white fw-bold px-4 py-3 d-flex justify-content-between align-items-center">
                                <span><i class="fa-solid fa-bell me-2"></i>Thông báo mới</span>
                                <span class="badge bg-white text-dark rounded-pill">{{ so_luong_thong_bao }}</span>
                            </li>
                            
                            <div class="notification-list" style="max-height: 350px; overflow-y: auto;">
                                <template v-if="so_luong_thong_bao > 0">
                                    <li v-for="(tb, index) in list_thong_bao" :key="index" class="border-bottom">
                                        <router-link to="/admin/yeucauhuy" class="dropdown-item py-3 px-4 notification-item text-wrap">
                                            <div class="d-flex align-items-start">
                                                <div class="icon-circle bg-light-danger text-danger me-3 flex-shrink-0 mt-1">
                                                    <i class="fa-solid fa-rotate-left"></i>
                                                </div>
                                                <div>
                                                    <h6 class="mb-1 font-13 fw-bold text-dark">Yêu cầu hủy Tour</h6>
                                                    <p class="mb-1 font-12 text-muted" style="line-height: 1.4;">
                                                        Khách hàng <b class="text-dark">{{ tb.khach_hang?.ho_ten || 'Không tên' }}</b> vừa gửi yêu cầu hủy hóa đơn <b class="text-danger">#{{ tb.id_hoa_don ? tb.id_hoa_don.toString().substring(0,8) : 'N/A' }}</b>
                                                    </p>
                                                    <small class="text-primary font-11"><i class="fa-regular fa-clock me-1"></i>{{ formatDate(tb.created_at) }}</small>
                                                </div>
                                            </div>
                                        </router-link>
                                    </li>
                                </template>
                                
                                <li v-else class="text-center py-5 text-muted font-13">
                                    <i class="fa-regular fa-bell-slash fa-3x mb-3 opacity-25 d-block"></i>
                                    Không có thông báo nào cần xử lý.
                                </li>
                            </div>
                            
                            <li>
                                <router-link to="/admin/yeu-cau-huy" class="dropdown-item text-center fw-bold py-3 bg-light border-top view-all-btn">
                                    Xem tất cả yêu cầu <i class="fa-solid fa-arrow-right ms-1"></i>
                                </router-link>
                            </li>
                        </ul>
                    </div>
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
            list_thong_bao: [],
            so_luong_thong_bao: 0,
            intervalId: null, // Biến lưu bộ đếm thời gian
        }
    },
    mounted() {
        this.checkLogin();
        this.loadThongBao();
        this.intervalId = setInterval(this.loadThongBao, 15000);
    },
    beforeUnmount() {
        clearInterval(this.intervalId);
    },
    methods: {
        loadThongBao() {
            const token = localStorage.getItem("token");
            if (!token) return;

            axios.get("http://127.0.0.1:8000/api/admin/yeu-cau-huy/lay-du-lieu", {
                headers: { Authorization: 'Bearer ' + token }
            })
            .then((res) => {
                if (res.data.status) {
                    const data = res.data.data || res.data.yeu_cau || [];
                    
                    const danhSachCho = data.filter(item => item.trang_thai == 0);
                    
                    this.list_thong_bao = danhSachCho;
                    this.so_luong_thong_bao = danhSachCho.length;
                }
            })
            .catch((err) => {
                console.error("Lỗi tải thông báo:", err);
            });
        },
        formatDate(date) {
            if (!date) return ''; 
            const d = new Date(date);
            const time = d.toLocaleTimeString('vi-VN', { hour: '2-digit', minute: '2-digit' });
            const day = String(d.getDate()).padStart(2, '0'); 
            const month = String(d.getMonth() + 1).padStart(2, '0'); 
            return `${time} - ${day}/${month}`; 
        },
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

.bg-primary-dark {
    background-color: #0d7a5f !important;
}
.text-primary-dark {
    color: #0d7a5f !important;
}

/* Biểu tượng chuông rung rinh khi có thông báo */
.animate__heartBeat {
    animation-duration: 1.5s;
}

/* Định dạng các mục thông báo */
.notification-item {
    transition: all 0.2s;
    background-color: #fff;
}
.notification-item:hover {
    background-color: #f8f9fa;
}

.icon-circle {
    width: 35px;
    height: 35px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 14px;
}
.bg-light-danger { background-color: #fee2e2; }

/* Custom Scrollbar cho danh sách thông báo */
.notification-list::-webkit-scrollbar {
    width: 5px;
}
.notification-list::-webkit-scrollbar-thumb {
    background-color: #cbd5e1;
    border-radius: 10px;
}

.view-all-btn:hover {
    background-color: #e6f5f0 !important;
}

/* Các tiện ích chữ */
.font-11 { font-size: 11px; }
.font-12 { font-size: 12px; }
.font-13 { font-size: 13px; }
</style>