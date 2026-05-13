<template>
    <div class="navbar-wrapper shadow-sm sticky-top">
        <div class="container">
            <nav class="navbar navbar-expand-lg py-0">

                <!-- LOGO -->
                <router-link class="navbar-brand py-0 me-lg-4 d-flex align-items-center gap-2 text-decoration-none" to="/">
                    <div class="brand-icon">
                        <i class="fa-solid fa-plane-departure"></i>
                    </div>
                    <div class="brand-text d-flex flex-column justify-content-center">
                        <span class="brand-name">VIVU<span class="brand-highlight">TOUR</span></span>
                        <span class="brand-slogan">Travel & Explore</span>
                    </div>
                </router-link>

                <!-- TOGGLER -->
                <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent2" aria-controls="navbarSupportedContent2"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse align-items-center" id="navbarSupportedContent2">

                    <!-- NAV LINKS -->
                    <ul class="navbar-nav mb-2 mb-lg-0">
                        <li class="nav-item">
                            <router-link to="/" class="nav-link custom-link">Home</router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="/client/danh-sach-hoa-don" class="nav-link custom-link">Hoá Đơn</router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="/blog" class="nav-link custom-link">Tin tức</router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="/yeu-cau" class="nav-link custom-link">Hủy/Đổi</router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="/client/wishlist" class="nav-link custom-link">
                                <i class="fa-regular fa-heart me-1"></i>Yêu thích
                            </router-link>
                        </li>
                    </ul>

                    <!-- SEARCH -->
                    <div class="flex-grow-1 mx-lg-4 my-3 my-lg-0">
                        <div class="search-bar-wrapper d-flex align-items-center">
                            <i class="fa-solid fa-magnifying-glass search-icon"></i>
                            <input
                                v-model="keyword_search"
                                @keyup.enter="handleSearch()"
                                type="text"
                                class="search-input"
                                placeholder="Bạn muốn tìm tour đi đâu?..."
                            >
                            <button @click="handleSearch()" class="search-btn" type="button">
                                Tìm
                            </button>
                        </div>
                    </div>

                    <!-- CHƯA ĐĂNG NHẬP -->
                    <template v-if="is_check == false">
                        <div class="d-flex align-items-center gap-2">
                            <router-link to="/client/dang-nhap" class="btn-outline-auth">
                                Đăng Nhập
                            </router-link>
                            <router-link to="/client/dang-ky" class="btn-fill-auth">
                                Đăng Ký
                            </router-link>
                        </div>
                    </template>

                    <!-- ĐÃ ĐĂNG NHẬP -->
                    <template v-else>
                        <div class="user-box dropdown">
                            <a class="user-pill d-flex align-items-center gap-2 dropdown-toggle dropdown-toggle-nocaret"
                                href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="user-avatar">
                                    <i class="fa-solid fa-user"></i>
                                </div>
                                <span class="user-name">{{ ten_hien_thi }}</span>
                                <i class="fa-solid fa-chevron-down chev-icon"></i>
                            </a>

                            <ul class="dropdown-menu dropdown-menu-end custom-dropdown mt-2">
                                <li class="dropdown-header-info px-3 py-2">
                                    <p class="mb-0 fw-bold text-dark" style="font-size:14px">{{ ten_hien_thi }}</p>
                                    <p class="mb-0 text-muted" style="font-size:12px">Thành viên</p>
                                </li>
                                <li><hr class="dropdown-divider my-1"></li>
                                <li>
                                    <a v-on:click="trangCaNhan()" class="dropdown-item custom-dropdown-item" style="cursor:pointer">
                                        <i class='bx bx-user-circle me-2 text-primary'></i>Trang Cá Nhân
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider my-1"></li>
                                <li>
                                    <a v-on:click="dangXuat()" class="dropdown-item custom-dropdown-item text-danger" style="cursor:pointer">
                                        <i class='bx bx-log-out-circle me-2'></i>Đăng Xuất
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
                        localStorage.removeItem("token_client");
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
@import url('https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@400;500;600;700&display=swap');

/* ── BASE ── */
.navbar-wrapper {
    background: #fff;
    border-bottom: 1px solid #f0ede8;
    font-family: 'Be Vietnam Pro', sans-serif;
}
.navbar {
    min-height: 64px;
}

/* ── NAV LINKS ── */
.custom-link {
    color: #374151 !important;
    font-size: 14px;
    font-weight: 500;
    padding: 6px 0 !important;
    margin: 0 14px;
    position: relative;
    background-color: transparent !important;
    transition: color 0.2s ease;
    white-space: nowrap;
}
.custom-link:hover {
    color: #0d7a5f !important;
}
.custom-link::after {
    content: '';
    position: absolute;
    width: 0;
    height: 2px;
    bottom: -2px;
    left: 0;
    background-color: #0d7a5f;
    border-radius: 2px;
    transition: width 0.25s ease;
}
.custom-link:hover::after,
.router-link-active.custom-link::after {
    width: 100%;
}
.router-link-active.custom-link {
    color: #0d7a5f !important;
    font-weight: 700;
}

/* ── SEARCH BAR ── */
.search-bar-wrapper {
    max-width: 560px;
    width: 100%;
    background: #f5f3ee;
    border: 1.5px solid transparent;
    border-radius: 50px;
    padding: 6px 6px 6px 16px;
    transition: all 0.25s ease;
}
.search-bar-wrapper:focus-within {
    border-color: #0d7a5f;
    background: #fff;
    box-shadow: 0 0 0 3px rgba(13, 122, 95, 0.1);
}
.search-icon {
    color: #9ca3af;
    font-size: 14px;
    flex-shrink: 0;
    margin-right: 8px;
}
.search-bar-wrapper:focus-within .search-icon {
    color: #0d7a5f;
}
.search-input {
    flex: 1;
    border: none;
    outline: none;
    background: transparent;
    font-size: 14px;
    font-family: 'Be Vietnam Pro', sans-serif;
    color: #1a1f2e;
    width: 100%;
}
.search-input::placeholder {
    color: #adb5bd;
}
.search-btn {
    background: #0d7a5f;
    color: #fff;
    border: none;
    border-radius: 50px;
    padding: 7px 20px;
    font-size: 13px;
    font-weight: 600;
    font-family: 'Be Vietnam Pro', sans-serif;
    cursor: pointer;
    transition: background 0.2s;
    white-space: nowrap;
    flex-shrink: 0;
}
.search-btn:hover {
    background: #085544;
}

/* ── AUTH BUTTONS ── */
.btn-outline-auth {
    display: inline-flex;
    align-items: center;
    padding: 8px 20px;
    border-radius: 50px;
    border: 1.5px solid #d1d5db;
    color: #374151;
    font-size: 14px;
    font-weight: 600;
    text-decoration: none;
    font-family: 'Be Vietnam Pro', sans-serif;
    transition: border-color 0.2s, color 0.2s;
    white-space: nowrap;
}
.btn-outline-auth:hover {
    border-color: #0d7a5f;
    color: #0d7a5f;
}
.btn-fill-auth {
    display: inline-flex;
    align-items: center;
    padding: 8px 20px;
    border-radius: 50px;
    background: #0d7a5f;
    color: #fff;
    font-size: 14px;
    font-weight: 600;
    text-decoration: none;
    font-family: 'Be Vietnam Pro', sans-serif;
    transition: background 0.2s, transform 0.15s;
    white-space: nowrap;
}
.btn-fill-auth:hover {
    background: #085544;
    color: #fff;
    transform: translateY(-1px);
}

/* ── USER PILL ── */
.user-pill {
    display: flex;
    align-items: center;
    gap: 8px;
    background: #f5f3ee;
    border-radius: 50px;
    padding: 6px 12px 6px 6px;
    text-decoration: none;
    transition: background 0.2s;
    border: 1.5px solid transparent;
}
.user-pill:hover {
    background: #eae8e3;
    border-color: #d1d5db;
}
.user-avatar {
    width: 30px;
    height: 30px;
    border-radius: 50%;
    background: #0d7a5f;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    font-size: 13px;
    flex-shrink: 0;
}
.user-name {
    font-size: 13px;
    font-weight: 600;
    color: #1a1f2e;
    max-width: 120px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}
.chev-icon {
    font-size: 10px;
    color: #9ca3af;
}

/* ── DROPDOWN ── */
.custom-dropdown {
    border: 1px solid #f0ede8;
    border-radius: 14px;
    box-shadow: 0 8px 30px rgba(0,0,0,0.1);
    padding: 4px 0;
    min-width: 200px;
    overflow: hidden;
}
.dropdown-header-info {
    background: #f5f3ee;
}
.custom-dropdown-item {
    font-size: 14px;
    font-weight: 500;
    padding: 10px 16px;
    display: flex;
    align-items: center;
    gap: 2px;
    transition: background 0.15s;
}
.custom-dropdown-item:hover {
    background-color: #f5f3ee;
}
.brand-icon {
    width: 42px;
    height: 42px;
    background-color: #003C71;
    color: #FFBD00;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
    border-radius: 12px 4px 12px 4px; /* Bo góc vát chéo logo */
    box-shadow: 0 4px 10px rgba(0, 60, 113, 0.2);
}
.brand-text {
    line-height: 1;
}
.brand-name {
    font-size: 22px;
    font-weight: 800;
    color: #003C71;
    letter-spacing: 0.5px;
    font-family: 'Be Vietnam Pro', sans-serif;
}
.brand-highlight {
    color: #FFBD00;
}
.brand-slogan {
    font-size: 10px;
    font-weight: 700;
    color: #6c757d;
    letter-spacing: 1.5px;
    text-transform: uppercase;
    margin-top: 2px;
}
/*LOGO*/

.brand-logo-custom {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
}
.brand-icon {
    width: 40px;
    height: 40px;
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
</style>