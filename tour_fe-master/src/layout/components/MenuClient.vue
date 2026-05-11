<template>
    <div class="bg-white shadow-sm sticky-top">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light bg-white py-2">
                
                <router-link class="navbar-brand py-0 me-lg-4" to="/">
                    <img style="height: 45px; object-fit: contain;" src="../imgaes/logo.png" alt="Logo">
                </router-link>

                <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent2" aria-controls="navbarSupportedContent2"
                    aria-expanded="false" aria-label="Toggle navigation"> 
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse align-items-center" id="navbarSupportedContent2">
                    
                    <ul class="navbar-nav mb-2 mb-lg-0 fw-medium">
                        <li class="nav-item">
                            <router-link to="/" class="nav-link custom-link">
                                Home
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="/client/danh-sach-hoa-don" class="nav-link custom-link">
                                Hoá Đơn
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="/blog" class="nav-link custom-link">
                                Tin tức
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="/yeu-cau" class="nav-link custom-link">
                                Hủy/Đổi
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="/client/wishlist" class="nav-link custom-link">
                                Yêu thích
                            </router-link>
                        </li>
                    </ul>

                    <div class="flex-grow-1 mx-lg-4 my-3 my-lg-0">
                        <div class="search-bar-wrapper bg-light rounded-pill d-flex align-items-center px-3 py-1">
                            <input 
                                v-model="keyword_search" 
                                @keyup.enter="handleSearch()" 
                                type="text" 
                                class="form-control bg-transparent border-0 shadow-none text-dark" 
                                placeholder="Bạn muốn tìm tour đi đâu?..."
                            >
                            <button @click="handleSearch()" class="btn text-primary border-0 rounded-circle" type="button">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </button>
                        </div>
                    </div>

                    <template v-if="is_check == false">
                        <div class="d-flex align-items-center gap-2">
                            <router-link to="/client/dang-nhap" class="btn btn-outline-dark rounded-pill px-4 py-2 fw-medium btn-auth">
                                Đăng Nhập
                            </router-link>
                            <router-link to="/client/dang-ky" class="btn btn-dark rounded-pill px-4 py-2 fw-medium btn-auth text-white">
                                Đăng Ký
                            </router-link>
                        </div>
                    </template>

                    <template v-else>
                        <div class="user-box dropdown">
                            <a class="d-flex align-items-center nav-link dropdown-toggle dropdown-toggle-nocaret text-dark border-0 rounded-pill px-2 py-1 user-pill"
                                href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                
                                <i class="fa-solid fa-circle-user fs-6 text-secondary me-2"></i>
                                
                                <div class="user-info me-2">
                                    <span class="user-name mb-0 fw-semibold font-13">{{ ten_hien_thi }}</span>
                                </div>
                                
                                <i class="fa-solid fa-chevron-down text-secondary font-10"></i>
                            </a>
                            
                            <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 mt-2 rounded-3">
                                <li>
                                    <a v-on:click="trangCaNhan()" class="dropdown-item py-2 text-dark custom-dropdown-item" style="cursor: pointer;">
                                        <i class='bx bx-user-circle me-2 text-primary'></i><span>Trang Cá Nhân</span>
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
            id: ' ',
            keyword_search: ''
        }
    },
    mounted() {
        this.checkLogin();
    },
    methods: {
        handleSearch() {
            if (this.keyword_search.trim()) {
                this.$router.push({
                    name: 'TimKiemTour',
                    query: { keyword: this.keyword_search }
                });
                this.keyword_search = '';
            }
        },
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
.font-13 { font-size: 13px; }
.font-14 { font-size: 14px; }
.font-10 { font-size: 10px; }

.custom-link {
    color: #495057 !important;
    font-size: 14px;
    padding: 8px 0 !important; 
    margin: 0 12px; 
    position: relative;
    background-color: transparent !important;
}

.custom-link:hover {
    color: #0d6efd !important;
}

.custom-link::after {
    content: '';
    position: absolute;
    width: 0;
    height: 2px;
    bottom: 0;
    left: 0;
    background-color: #0d6efd;
    transition: width 0.3s ease;
}

.custom-link:hover::after,
.router-link-active.custom-link::after {
    width: 100%;
}

.router-link-active.custom-link {
    color: #0d6efd !important;
    font-weight: 700;
}

.search-bar-wrapper {
    max-width: 600px; 
    width: 100%;
    border: 1px solid transparent;
    transition: all 0.3s;
}

.search-bar-wrapper:focus-within {
    border-color: #0d6efd;
    background-color: #fff !important;
    box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.15);
}

.search-bar-wrapper input::placeholder {
    color: #adb5bd;
}

.search-bar-wrapper input:focus {
    outline: none;
}


.btn-auth {
    font-size: 14px;
}

.user-pill {
    background-color: #f1f3f5;
    transition: all 0.2s;
}

.user-pill:hover {
    background-color: #e2e6ea; 
}

.custom-dropdown-item {
    font-size: 14px;
    font-weight: 500;
}

.custom-dropdown-item:hover {
    background-color: #f8f9fa;
}
</style>