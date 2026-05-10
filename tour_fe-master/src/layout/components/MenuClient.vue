<template>
    <div class="bg-white shadow-sm sticky-top">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light bg-white py-1">
                
                <router-link class="navbar-brand py-0" to="/">
                    <img style="height: 45px; object-fit: contain;" src="../imgaes/logo.png" alt="Logo">
                </router-link>

                <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent2" aria-controls="navbarSupportedContent2"
                    aria-expanded="false" aria-label="Toggle navigation"> 
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent2">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 fw-medium gap-1">
                        <li class="nav-item">
                            <router-link to="/" class="nav-link custom-link rounded px-3 py-2">
                                <i class="bx bx-home-alt me-1"></i> Home
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="/client/danh-sach-hoa-don" class="nav-link custom-link rounded px-3 py-2">
                                <i class="fa-solid fa-bag-shopping me-1"></i> Hoá Đơn
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="/blog" class="nav-link custom-link rounded px-3 py-2">
                                <i class="fa-solid fa-newspaper me-1"></i> Blog tin tức
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="/yeu-cau" class="nav-link custom-link rounded px-3 py-2">
                                <i class="fa-solid fa-rotate me-1"></i> Hủy / Đổi lịch
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="/yeu-thich" class="nav-link custom-link rounded px-3 py-2">
                                <i class="fa-solid fa-heart me-1"></i> Yêu thích
                            </router-link>
                        </li>
                    </ul>

                    <template v-if="is_check == false">
                        <div class="d-flex align-items-center gap-2">
                            <router-link to="/client/dang-nhap" class="btn btn-sm btn-outline-secondary radius-30 px-3 py-1 fw-medium">
                                <i class="bx bx-lock me-1"></i> Login
                            </router-link>
                            <router-link to="/client/dang-ky" class="btn btn-sm btn-secondary radius-30 px-3 py-1 fw-medium text-white">
                                <i class="bx bx-user me-1"></i> Register
                            </router-link>
                        </div>
                    </template>

                    <template v-else>
                        <div class="user-box dropdown">
                            <a class="d-flex align-items-center nav-link dropdown-toggle dropdown-toggle-nocaret text-dark border rounded-pill px-3 py-1 user-pill"
                                href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                
                                <i class="fa-solid fa-circle-user fs-5 text-secondary me-2"></i>
                                
                                <div class="user-info me-2">
                                    <span class="user-name mb-0 fw-bold font-14">{{ ten_hien_thi }}</span>
                                </div>
                                
                                <i class="fa-solid fa-chevron-down text-secondary font-10"></i>
                            </a>
                            
                            <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 mt-2">
                                <li>
                                    <a v-on:click="trangCaNhan()" class="dropdown-item py-2 text-secondary custom-dropdown-item" style="cursor: pointer;">
                                        <i class='bx bx-user-circle me-2'></i><span>Trang Cá Nhân</span>
                                    </a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <a v-on:click="dangXuat()" class="dropdown-item py-2 text-danger custom-dropdown-item" style="cursor: pointer;">
                                        <i class='bx bx-log-out-circle me-2'></i><span>Đăng Xuất</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </template>
                </div>
            </nav>
        </div>
    </div>
</template>

<script>
import baseRequestClient from '../../core/baseRequestClient';
import { createToaster } from "@meforma/vue-toaster";
import axios from "axios";
const toaster = createToaster({ position: "top-right" });

export default {
    data() {
        return {
            ten_hien_thi: 'Chưa đăng nhập',
            is_check: false,
            id: ' '
        }
    },
    mounted() {
        this.checkLogin();
    },
    methods: {
        dangXuat() {
            baseRequestClient
                .get('account-client/logout')
                .then((res) => {
                    if (res.data.status) {
                        toaster.success('Thông báo<br>' + res.data.message);
                        localStorage.removeItem("token_client"); // Clear token khi đăng xuất
                        localStorage.removeItem("ho_ten_client");
                        this.is_check = false;
                        this.$router.push('/client/dang-nhap');
                    } else {
                        toaster.error('Thông báo<br>' + res.data.message);
                    }
                });
        },

        checkLogin() {
            axios
                .get('http://127.0.0.1:8000/api/account-client/kiem-tra-token-client', {
                    headers: {
                        Authorization: 'Bearer ' + localStorage.getItem("token_client")
                    }
                })
                .then((res) => {
                    if (res.data.status) {
                        this.is_check = true;
                        this.ten_hien_thi = localStorage.getItem('ho_ten_client');
                    }
                })
                .catch(() => {
                    this.is_check = false;
                });
        },
        
        trangCaNhan() {
            this.$router.push('/client/trang-ca-nhan');
        }
    },
}
</script>

<style scoped>
/* Tiện ích font size */
.font-14 { font-size: 14px; }
.font-10 { font-size: 10px; }

/* Màu mặc định của menu là màu xám trung tính */
.custom-link {
    color: #000000 !important;
    transition: all 0.2s ease-in-out;
    font-size: 15px; /* Giảm nhẹ font chữ menu */
}

/* Hiệu ứng hover: Nền xám nhạt, chữ đậm màu hơn */
.custom-link:hover {
    background-color: #f8f9fa;
    color: #212529 !important;
}

/* Đang ở trang nào thì bôi đậm trang đó */
.router-link-active.custom-link {
    color: #212529 !important;
    font-weight: 700;
    background-color: #f1f3f5;
}

/* Khung user pill hover */
.user-pill {
    transition: all 0.2s;
    background-color: #f8f9fa;
}
.user-pill:hover {
    background-color: #e9ecef;
}

/* Nút dropdown */
.custom-dropdown-item:hover {
    background-color: #f8f9fa;
}

/* Bo góc cho các nút đăng nhập / đăng ký */
.radius-30 {
    border-radius: 30px !important;
}
</style>