<template>
    <div class="chi-tiet-page">
        <div class="container py-5" v-if="tour.length > 0">
            
            <!-- ── TIÊU ĐỀ TOUR ── -->
            <div class="row mb-4">
                <div class="col-12">
                    <span class="section-tag">Chi tiết hành trình</span>
                    <h2 class="section-title mt-1">{{ tour[0].tieu_de_tour }}</h2>
                </div>
            </div>

            <!-- ── ALBUM ẢNH ── -->
            <div class="row g-3 mb-5 animate__animated animate__fadeIn">
                <div class="col-lg-8">
                    <div class="img-wrapper main-img-box rounded-4 overflow-hidden">
                        <img :src="tour[0].anh_tour" class="w-100 h-100 object-fit-cover" alt="Main">
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="row g-3 h-100">
                        <div class="col-6 col-lg-12">
                            <div class="img-wrapper sub-img-box rounded-4 overflow-hidden">
                                <img v-if="tour[1]" :src="tour[1].link_anh" class="w-100 h-100 object-fit-cover" alt="Sub 1">
                            </div>
                        </div>
                        <div class="col-6 col-lg-12">
                            <div class="img-wrapper sub-img-box rounded-4 overflow-hidden">
                                <img v-if="tour[2]" :src="tour[2].link_anh" class="w-100 h-100 object-fit-cover" alt="Sub 2">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-4">
                <!-- ── CỘT TRÁI: THÔNG TIN CHI TIẾT ── -->
                <div class="col-lg-8">
                    <!-- Thông tin tổng quan -->
                    <div class="info-card rounded-4 p-4 mb-4">
                        <div class="row align-items-center mb-4">
                            <div class="col-md-6 border-end-custom">
                                <h5 class="info-label mb-3"><i class="fa-regular fa-calendar-check me-2"></i>Lịch Trình Chuyến Đi</h5>
                                <div class="d-flex flex-column gap-2">
                                    <p class="mb-0 text-muted">Khởi hành: <b class="text-dark ms-2">{{ formatDate(tour[0].ngay_bat_dau) }}</b></p>
                                    <p class="mb-0 text-muted">Kết thúc: <b class="text-dark ms-2">{{ formatDate(tour[0].ngay_ket_thuc) }}</b></p>
                                    <p class="mb-0 text-muted">Điểm đi: <b class="text-dark ms-2">{{ tour[0].ten_tinh_thanh }}</b></p>
                                </div>
                            </div>
                            <div class="col-md-6 ps-md-4 mt-3 mt-md-0">
                                <div class="row g-3">
                                    <div class="col-6">
                                        <small class="text-muted d-block">Di chuyển</small>
                                        <b class="text-dark font-15">Máy bay</b>
                                    </div>
                                    <div class="col-6">
                                        <small class="text-muted d-block">Ẩm thực</small>
                                        <b class="text-dark font-15">Buffet, Đặc sản</b>
                                    </div>
                                    <div class="col-6">
                                        <small class="text-muted d-block">Lưu trú</small>
                                        <b class="text-dark font-15">Khách sạn 4 sao</b>
                                    </div>
                                    <div class="col-6">
                                        <small class="text-muted d-block">Đối tượng</small>
                                        <b class="text-dark font-15">Gia đình, Cặp đôi</b>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="highlight-box rounded-3 p-3">
                            <i class="fas fa-map-marked-alt text-primary-dark me-2"></i>
                            <span class="text-muted">Điểm tham quan:</span> 
                            <b class="ms-1 text-dark">{{ tour[0].ten_dia_diem }}<span v-if="tour[1]">, {{ tour[1].ten_dia_diem }}</span><span v-if="tour[2]">, {{ tour[2].ten_dia_diem }}</span></b>
                        </div>
                    </div>

                    <!-- Chuyến bay -->
                    <div class="info-card rounded-4 p-4 mb-4">
                        <h5 class="info-label mb-4">Thông Tin Chuyến Bay</h5>
                        <div class="row g-4">
                            <div class="col-md-6 border-end-custom">
                                <div class="flight-badge-go mb-3">Chiều đi - {{ formatDate(tour[0].ngay_bat_dau) }}</div>
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <span class="fs-4 fw-bold text-dark">08:20</span>
                                    <div class="flight-line flex-grow-1 mx-3">
                                        <i class="fas fa-plane"></i>
                                    </div>
                                    <span class="fs-4 fw-bold text-dark">09:20</span>
                                </div>
                                <div class="text-muted font-14">
                                    <span>VN8077 • Tập trung: 07:00 AM</span>
                                </div>
                            </div>
                            <div class="col-md-6 ps-md-4">
                                <div class="flight-badge-back mb-3">Chiều về - {{ formatDate(tour[0].ngay_ket_thuc) }}</div>
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <span class="fs-4 fw-bold text-dark">11:25</span>
                                    <div class="flight-line flex-grow-1 mx-3">
                                        <i class="fas fa-plane text-success"></i>
                                    </div>
                                    <span class="fs-4 fw-bold text-dark">12:35</span>
                                </div>
                                <div class="text-muted font-14">
                                    <span>VN8066 • Bay thẳng</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Mô tả -->
                    <div class="info-card rounded-4 p-4">
                        <h5 class="info-label mb-3">Giới Thiệu Hành Trình</h5>
                        <p class="text-description mb-0">{{ tour[0].mo_ta }}</p>
                    </div>
                </div>

                <!-- ── CỘT PHẢI: FORM ĐẶT TOUR (Sticky) ── -->
                <div class="col-lg-4">
                    <div class="booking-card rounded-4 shadow-lg sticky-top" style="top: 100px; z-index: 10;">
                        <div class="booking-header text-center p-4">
                            <h5 class="fw-bold text-white mb-1">ĐẶT CHUYẾN ĐI</h5>
                            <span class="tour-id-tag">Mã tour: #{{ tour[0].id_tour }}</span>
                        </div>
                        
                        <div class="p-4">
                            <div class="price-summary d-flex justify-content-between mb-4">
                                <div class="text-center flex-grow-1">
                                    <small class="text-muted d-block mb-1">Người lớn</small>
                                    <span class="price-val">{{ formatToVND(tour[0].gia_nguoi_lon) }}</span>
                                </div>
                                <div class="divider-vertical"></div>
                                <div class="text-center flex-grow-1">
                                    <small class="text-muted d-block mb-1">Trẻ em</small>
                                    <span class="price-val">{{ formatToVND(tour[0].gia_tre_em) }}</span>
                                </div>
                            </div>

                            <form @submit.prevent>
                                <div class="mb-3">
                                    <label class="form-label-custom">Khách hàng</label>
                                    <input type="text" class="form-control custom-input" :value="ten_hien_thi" readonly>
                                </div>

                                <div class="passenger-selector mb-3">
                                    <label class="form-label-custom">Số lượng hành khách</label>
                                    <!-- Người lớn -->
                                    <div class="d-flex justify-content-between align-items-center mb-3 p-2 border rounded-3">
                                        <span class="font-14 fw-medium text-dark">Người lớn <small class="d-block text-muted font-11">Trên 10 tuổi</small></span>
                                        <div class="counter-control">
                                            <button @click="decrease('adult')" type="button" class="count-btn">−</button>
                                            <input v-model="so_nguoi_lon" type="text" class="count-input" readonly>
                                            <button @click="increase('adult')" type="button" class="count-btn">+</button>
                                        </div>
                                    </div>
                                    <!-- Trẻ em -->
                                    <div class="d-flex justify-content-between align-items-center p-2 border rounded-3">
                                        <span class="font-14 fw-medium text-dark">Trẻ em <small class="d-block text-muted font-11">Dưới 10 tuổi</small></span>
                                        <div class="counter-control">
                                            <button @click="decrease('child')" type="button" class="count-btn">−</button>
                                            <input v-model="so_tre_em" type="text" class="count-input" readonly>
                                            <button @click="increase('child')" type="button" class="count-btn">+</button>
                                        </div>
                                    </div>
                                </div>

                                <div class="total-section d-flex justify-content-between align-items-center mb-4">
                                    <span class="fw-bold text-dark">TỔNG CỘNG</span>
                                    <span class="total-price">{{ formatToVND(tong_tien) }}</span>
                                </div>

                                <div class="d-grid gap-2">
                                    <button @click="thanhToanATM()" class="btn-momo-filled w-100 mb-3">
                                        <img src="https://homepage.momocdn.net/fileuploads/svg/momo-file-240411162904.svg" alt="">
                                        Thanh toán bằng MoMo
                                        </button>
                                    <div class="row g-2">
                                        <div class="col-6">
                                            <button @click="themVaoGioHang()" class="btn-action btn-cart w-100">
                                                <i class="fa-solid fa-cart-plus me-1"></i> Thanh toán sau
                                            </button>
                                        </div>
                                        <div class="col-6">
                                            <button @click="themVaoWishlist()" class="btn-action btn-wish w-100">
                                                <i class="fa-solid fa-heart me-1"></i> Yêu thích
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ── TOUR LIÊN QUAN ── -->
            <div class="mt-5 pt-5 border-top">
                <div class="section-header text-center mb-5">
                    <span class="section-tag">Khám phá thêm</span>
                    <h3 class="section-title">Có Thể Bạn Sẽ Thích</h3>
                </div>
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
                    <div class="col" v-for="(v, k) in list_tour.slice(0, 4)" :key="v.id">
                        <div class="tour-card h-100 rounded-4 overflow-hidden border">
                            <div class="tour-img-wrapper">
                                <router-link :to="'/client/chi-tiet-tour/' + v.id">
                                    <img :src="v.link_anh" class="tour-img" alt="Tour">
                                </router-link>
                            </div>
                            <div class="tour-body p-3">
                                <h6 class="tour-title mb-2">
                                    <router-link :to="'/client/chi-tiet-tour/' + v.id" class="text-decoration-none text-dark hover-primary">
                                        {{ v.tieu_de }}
                                    </router-link>
                                </h6>
                                <p class="text-danger fw-bold mb-3">Chỉ từ {{ formatToVND(v.gia_tre_em) }}</p>
                                <router-link :to="'/client/chi-tiet-tour/' + v.id" class="tour-btn w-100 py-1">Xem Chi Tiết</router-link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- Loading State -->
        <div v-else class="container d-flex flex-column justify-content-center align-items-center" style="height: 70vh;">
            <div class="spinner-grow text-success mb-3" role="status"></div>
            <p class="text-muted fw-medium">Đang tải hành trình tuyệt đẹp của bạn...</p>
        </div>
    </div>
</template>

<script>
import axios from "axios";
import baseRequest from "../../../core/baseRequestClient";
import { createToaster } from "@meforma/vue-toaster";
const toaster = createToaster({ position: "top-right" });

export default {
    data() {
        return {
            tour: [],
            list_tour: [],
            so_nguoi_lon: 0,
            so_tre_em: 0,
            tong_tien: 0,
            is_login: false,
            ten_hien_thi: 'Chưa đăng nhập'
        }
    },
    mounted() {
        this.loadDataChiTietTour();
        this.loadDataTour();
        this.kiemTraDangNhap();
        this.checkLogin();
    },
    methods: {
        thanhToanATM() {
        if (this.so_nguoi_lon === 0 && this.so_tre_em === 0) {
            toaster.warning("Vui lòng chọn số lượng hành khách!");
            return;
        }

        if (!this.is_login) {
            toaster.error("Bạn cần đăng nhập trước khi thanh toán!");
            this.$router.push('/client/dang-nhap');
            return;
        }

        const payload = {
            id: this.tour[0].id_tour, 
            tong_tien: this.tong_tien
        };

        axios.post("http://127.0.0.1:8000/api/momo/atm-payment", payload, {
            headers: { Authorization: 'Bearer ' + localStorage.getItem("token_client") }
        })
        .then((res) => {
            console.log("RESPONSE MOMO:", res.data);

            if (res.data.status && res.data.payUrl) {
                window.location.href = res.data.payUrl;
            } else {
                toaster.error("MoMo lỗi: " + JSON.stringify(res.data));
            }
        })
        .catch((error) => {
            console.error("Chi tiết lỗi:", error.response?.data); 
            toaster.error("Lỗi khi kết nối với cổng thanh toán!");
        });
    },
        kiemTraDangNhap() {
            axios
                .get("http://127.0.0.1:8000/api/account-client/kiem-tra-token-client", {
                    headers: {
                        Authorization: 'Bearer ' + localStorage.getItem("token_client")
                    }
                })
                .then((res) => {
                    this.is_login = res.data.status;
                });
        },
        loadDataChiTietTour() {
            var url = window.location.href;
            var arr = url.split('/');
            var gui_di = {
                id: arr[arr.length - 1]
            }
            baseRequest
                .post('client/tour/lay-chi-tiet-tour/data', gui_di)
                .then((res) => {
                    if (res.data.status) {
                        this.tour = res.data.chi_tiet_tour;
                    } else {
                        toaster.error('Thông báo<br>' + res.data.message);
                    }
                });
        },
        loadDataTour() {
            baseRequest
                .get('tour/lay-du-lieu-client')
                .then((res) => {
                    if (res.data.status) {
                        this.list_tour = res.data.tour_client;
                    }
                });
        },
        increase(type) {
            if (type === 'adult') {
                this.so_nguoi_lon++;
            } else if (type === 'child') {
                this.so_tre_em++;
            }
            this.calculateTotal();
        },
        decrease(type) {
            if (type === 'adult' && this.so_nguoi_lon > 0) {
                this.so_nguoi_lon--;
            } else if (type === 'child' && this.so_tre_em > 0) {
                this.so_tre_em--;
            }
            this.calculateTotal();
        },
        calculateTotal() {
            this.tong_tien = (this.tour[0].gia_nguoi_lon * this.so_nguoi_lon) + (this.tour[0].gia_tre_em * this.so_tre_em);
        },
        formatToVND(number) {
            if (!number) return '0 ₫';
            number = parseInt(number);
            return number.toLocaleString('vi-VN', { style: 'currency', currency: 'VND' });
        },
        formatDate(date) {
            if (!date) return ''; 
            const d = new Date(date);
            const day = String(d.getDate()).padStart(2, '0');
            const month = String(d.getMonth() + 1).padStart(2, '0');
            const year = d.getFullYear(); 
            return `${day}/${month}/${year}`; 
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
                        this.ten_hien_thi = localStorage.getItem('ho_ten_client');
                    }
                });
        },
        themVaoWishlist() {
            if (this.is_login) {
                var payload = {
                    'tour_id': this.tour[0].id_tour,
                };
                axios
                    .post("http://127.0.0.1:8000/api/client/wishlist/them", payload, {
                        headers: {
                            Authorization: 'Bearer ' + localStorage.getItem("token_client")
                        }
                    })
                    .then((res) => {
                        if (res.data.status) {
                            toaster.success(res.data.message);
                            this.$router.push('/client/wishlist');
                        } else {
                            toaster.error(res.data.message);
                        }
                    });
            } else {
                toaster.error("Bạn cần đăng nhập trước!");
                this.$router.push('/client/dang-nhap');
            }
        },
        themVaoGioHang() {
            if (this.so_nguoi_lon === 0 && this.so_tre_em === 0) {
                toaster.error("Vui lòng chọn số lượng hành khách (người lớn hoặc trẻ em)!");
                return; 
            }

            if (this.is_login) {
                var payload = {
                    'gia_nguoi_lon': parseInt(this.tour[0].gia_nguoi_lon) || 0,
                    'gia_tre_em': parseInt(this.tour[0].gia_tre_em) || 0,
                    'so_nguoi_lon': parseInt(this.so_nguoi_lon) || 0,
                    'so_tre_em': parseInt(this.so_tre_em) || 0,
                    'id_tour': this.tour[0].id_tour || this.tour[0].id, 
                };

                console.log("Dữ liệu gửi lên server:", payload);

                axios
                    .post("http://127.0.0.1:8000/api/client/gio-hang/them-vao-gio-hang", payload, {
                        headers: {
                            Authorization: 'Bearer ' + localStorage.getItem("token_client")
                        }
                    })
                    .then((res) => {
                        if (res.data.status) {
                            toaster.success(res.data.message);
                            this.so_nguoi_lon = 0;
                            this.so_tre_em = 0;
                            this.tong_tien = 0;
                        } else {
                            toaster.error(res.data.message);
                        }
                    })
                    .catch((err) => {
                        console.error("Lỗi API:", err.response?.data);
                        toaster.error("Có lỗi xảy ra hoặc dữ liệu gửi đi không hợp lệ!");
                    });
            } else {
                toaster.error("Bạn cần đăng nhập trước!");
                this.$router.push('/client/dang-nhap');
            }
        }
    },
}
</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@300;400;500;600;700;800&display=swap');

/* ── BASE ── */
.chi-tiet-page {
    font-family: 'Be Vietnam Pro', sans-serif;
    background: #f8f7f4;
    min-height: 100vh;
}

/* ── UI COMPONENTS ── */
.section-tag {
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 2px;
    text-transform: uppercase;
    color: #0d7a5f;
    background: rgba(13, 122, 95, 0.1);
    padding: 4px 12px;
    border-radius: 50px;
}
.section-title {
    font-size: 32px;
    font-weight: 800;
    color: #1a1f2e;
}

/* ── IMAGES ── */
.main-img-box { height: 450px; }
.sub-img-box { height: 217px; }
.img-wrapper img {
    transition: transform 0.6s ease;
}
.img-wrapper:hover img { transform: scale(1.05); }

/* ── INFO CARDS ── */
.info-card {
    background: #fff;
    border: 1px solid #eeebe5;
}
.info-label {
    font-size: 18px;
    font-weight: 700;
    color: #0d7a5f;
}
.border-end-custom {
    border-right: 1px solid #f0ede8;
}
.highlight-box {
    background: #f1f8f6;
    border-left: 4px solid #0d7a5f;
}
.text-primary-dark { color: #0d7a5f; }
.text-description {
    line-height: 1.8;
    color: #4b5563;
    font-size: 15px;
}

/* ── FLIGHT ── */
.flight-badge-go {
    background: #e6f5f0;
    color: #0d7a5f;
    padding: 6px 15px;
    border-radius: 50px;
    font-weight: 700;
    font-size: 12px;
    display: inline-block;
}
.flight-badge-back {
    background: #fff8eb;
    color: #e8a020;
    padding: 6px 15px;
    border-radius: 50px;
    font-weight: 700;
    font-size: 12px;
    display: inline-block;
}
.flight-line {
    height: 2px;
    background: #e5e7eb;
    position: relative;
    text-align: center;
}
.flight-line i {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background: #fff;
    padding: 0 10px;
}

/* ── BOOKING CARD (Sticky) ── */
.booking-card {
    background: #fff;
    border: none;
    overflow: hidden;
}
.booking-header {
    background: #0d7a5f;
}
.tour-id-tag {
    font-size: 11px;
    color: rgba(255,255,255,0.8);
    letter-spacing: 1px;
}
.price-val {
    font-size: 18px;
    font-weight: 800;
    color: #dc3545;
}
.divider-vertical {
    width: 1px;
    background: #eee;
}
.form-label-custom {
    font-size: 13px;
    font-weight: 700;
    color: #1a1f2e;
    margin-bottom: 8px;
}
.custom-input {
    border-radius: 8px;
    border: 1px solid #e5e7eb;
    padding: 10px;
    font-weight: 600;
    background-color: #f9fafb !important;
}

/* Counter Control */
.counter-control {
    display: flex;
    align-items: center;
    background: #f3f4f6;
    border-radius: 50px;
    padding: 4px;
}
.count-btn {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    border: none;
    background: #fff;
    font-weight: bold;
    transition: 0.2s;
}
.count-btn:hover { background: #0d7a5f; color: #fff; }
.count-input {
    width: 40px;
    border: none;
    background: transparent;
    text-align: center;
    font-weight: 700;
}

.total-price {
    font-size: 24px;
    font-weight: 800;
    color: #dc3545;
}

.btn-book-now {
    background: #0d7a5f;
    color: #fff;
    border: none;
    padding: 15px;
    border-radius: 12px;
    font-weight: 700;
    transition: 0.3s;
    width: 100%;
}
.btn-book-now:hover { background: #085544; transform: translateY(-2px); }

.btn-action {
    border: 1.5px solid;
    padding: 10px;
    border-radius: 10px;
    font-weight: 600;
    font-size: 13px;
    transition: 0.2s;
    background: transparent;
}
.btn-cart { border-color: #e8a020; color: #e8a020; }
.btn-cart:hover { background: #e8a020; color: #fff; }
.btn-wish { border-color: #ff4757; color: #ff4757; }
.btn-wish:hover { background: #ff4757; color: #fff; }

/* ── TOUR RELATED CARDS (Kế thừa style cũ) ── */
.tour-card {
    background: #fff;
    transition: transform 0.3s ease;
}
.tour-card:hover { transform: translateY(-5px); box-shadow: 0 10px 30px rgba(0,0,0,0.08); }
.tour-img-wrapper { height: 160px; overflow: hidden; }
.tour-img { width: 100%; height: 100%; object-fit: cover; transition: 0.5s; }
.tour-card:hover .tour-img { transform: scale(1.1); }
.tour-title {
    font-size: 14px;
    font-weight: 700;
    height: 2.6em;
    overflow: hidden;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
}
.tour-btn {
    display: block;
    text-align: center;
    text-decoration: none;
    border: 1.5px solid #0d7a5f;
    color: #0d7a5f;
    border-radius: 50px;
    font-size: 12px;
    font-weight: 700;
}
.tour-btn:hover { background: #0d7a5f; color: #fff; }
.hover-primary:hover { color: #0d7a5f !important; }

/* Responsive */
@media (max-width: 991px) {
    .border-end-custom { border-right: none; }
}

.btn-momo-filled, .btn-momo-outlined, .btn-momo-soft {
  display: flex; align-items: center; justify-content: center;
  gap: 10px; padding: 13px 20px;
  border-radius: 12px; font-size: 15px; font-weight: 500;
  cursor: pointer; border: none; transition: all 0.2s;
}

.btn-momo-filled { background: #ae2070; color: #fff; }
.btn-momo-filled:hover { background: #921a5f; }
.btn-momo-outlined { background: #fff; color: #ae2070; border: 1.5px solid #ae2070; }
.btn-momo-outlined:hover { background: #fdf0f6; }
.btn-momo-soft { background: #fdf0f6; color: #ae2070; border: 0.5px solid #f0b8d4; justify-content: space-between; }
.btn-momo-soft:hover { background: #fce0ee; }
[class^="btn-momo"] img { width: 28px; height: 28px; border-radius: 6px; }
.btn-momo-soft small { font-size: 12px; color: #c96b9e; }
</style>