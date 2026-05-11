<template>
    <div class="bg-light py-4 min-vh-100">
        <div class="container" v-if="tour.length > 0">
            
            <div class="row mb-3">
                <div class="col-12">
                    <h2 class="fw-bold text-dark">{{ tour[0].tieu_de_tour }}</h2>
                </div>
            </div>

            <div class="row g-2 mb-4 animate__animated animate__fadeIn">
                <div class="col-lg-7 col-md-12">
                    <img :src="tour[0].anh_tour" class="img-fluid rounded-3 w-100 object-fit-cover main-img" alt="Hình ảnh tour chính">
                </div>
                <div class="col-lg-5 col-md-12">
                    <div class="row g-2 h-100">
                        <div class="col-6">
                            <img v-if="tour[1]" :src="tour[1].link_anh" class="img-fluid rounded-3 w-100 object-fit-cover sub-img" alt="Ảnh phụ 1">
                        </div>
                        <div class="col-6">
                            <img v-if="tour[2]" :src="tour[2].link_anh" class="img-fluid rounded-3 w-100 object-fit-cover sub-img" alt="Ảnh phụ 2">
                        </div>
                        <div class="col-12">
                            <img :src="tour[0].link_anh" class="img-fluid rounded-3 w-100 object-fit-cover sub-img-large" alt="Ảnh phụ 3">
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-4">
                <div class="col-lg-8">
                    <div class="card border-0 shadow-sm rounded-4 mb-4">
                        <div class="card-body p-4">
                            <div class="row mb-4">
                                <div class="col-md-5 border-end pe-4">
                                    <h5 class="fw-bold mb-3 text-primary"><i class="fa-regular fa-calendar-check me-2"></i>Lịch Trình</h5>
                                    <p class="mb-2"><span class="text-secondary">Khởi hành:</span> <b>{{ formatDate(tour[0].ngay_bat_dau) }}</b></p>
                                    <p class="mb-2"><span class="text-secondary">Kết thúc:</span> <b>{{ formatDate(tour[0].ngay_ket_thuc) }}</b></p>
                                    <p class="mb-0"><span class="text-secondary">Khởi hành từ:</span> <b>{{ tour[0].ten_tinh_thanh }}</b></p>
                                </div>
                                <div class="col-md-7 ps-md-4 mt-3 mt-md-0">
                                    <div class="row g-3">
                                        <div class="col-sm-6">
                                            <p class="text-secondary mb-1"><i class="fas fa-car-side me-2"></i>Di chuyển</p>
                                            <b class="font-14">Máy bay</b>
                                        </div>
                                        <div class="col-sm-6">
                                            <p class="text-secondary mb-1"><i class="fas fa-users me-2"></i>Đối tượng</p>
                                            <b class="font-14">Cặp đôi, Gia đình</b>
                                        </div>
                                        <div class="col-sm-6">
                                            <p class="text-secondary mb-1"><i class="fas fa-utensils me-2"></i>Ẩm thực</p>
                                            <b class="font-14">Buffet, Đặc sản</b>
                                        </div>
                                        <div class="col-sm-6">
                                            <p class="text-secondary mb-1"><i class="fas fa-hotel me-2"></i>Lưu trú</p>
                                            <b class="font-14">Khách sạn 4 sao</b>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="bg-light rounded-3 p-3 text-dark font-14">
                                <i class="fas fa-map-marked-alt text-primary me-2"></i>
                                <b>Điểm tham quan: </b> 
                                {{ tour[0].ten_dia_diem }}<span v-if="tour[1]">, {{ tour[1].ten_dia_diem }}</span><span v-if="tour[2]">, {{ tour[2].ten_dia_diem }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="card border-0 shadow-sm rounded-4 mb-4">
                        <div class="card-body p-4">
                            <h4 class="fw-bold mb-4">Chi tiết chuyến bay</h4>
                            <div class="row g-4">
                                <div class="col-md-6 border-end-md">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <span class="badge bg-primary text-white px-3 py-2 rounded-pill">Ngày đi - {{ formatDate(tour[0].ngay_bat_dau) }}</span>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center fw-bold fs-5 my-3">
                                        <span>08:20</span>
                                        <div class="d-flex flex-column align-items-center text-secondary font-12 w-100 px-3">
                                            <span>Bay thẳng</span>
                                            <hr class="w-100 my-1 border-2">
                                            <i class="fas fa-plane"></i>
                                        </div>
                                        <span>09:20</span>
                                    </div>
                                    <div class="text-secondary font-14">
                                        <p class="mb-1">Ký hiệu chuyến bay: <b>VN8077</b></p>
                                        <p class="mb-0">Tập trung: <b>07:00 AM tại Sân bay</b></p>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <span class="badge bg-success text-white px-3 py-2 rounded-pill">Ngày về - {{ formatDate(tour[0].ngay_ket_thuc) }}</span>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center fw-bold fs-5 my-3">
                                        <span>11:25</span>
                                        <div class="d-flex flex-column align-items-center text-secondary font-12 w-100 px-3">
                                            <span>Bay thẳng</span>
                                            <hr class="w-100 my-1 border-2">
                                            <i class="fas fa-plane text-success"></i>
                                        </div>
                                        <span>12:35</span>
                                    </div>
                                    <div class="text-secondary font-14">
                                        <p class="mb-1">Ký hiệu chuyến bay: <b>VN8066</b></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card border-0 shadow rounded-4 sticky-top z-1" style="top: 80px;">
                        <div class="card-header bg-white border-bottom-0 pt-3 pb-0 text-center">
                            <h5 class="fw-bold text-primary mb-0">THÔNG TIN ĐẶT TOUR</h5>
                            <p class="text-secondary font-12 mt-1 mb-0">Mã tour: <b>#{{ tour[0].id_tour }}</b></p>
                        </div>
                        
                        <div class="card-body p-3">
                            <div class="d-flex justify-content-between align-items-center bg-light px-3 py-2 rounded-3 mb-3">
                                <div>
                                    <p class="mb-0 font-12 text-secondary">Người lớn</p>
                                    <span class="text-danger fw-bold font-14">{{ formatToVND(tour[0].gia_nguoi_lon) }}</span>
                                </div>
                                <div class="text-end border-start ps-3">
                                    <p class="mb-0 font-12 text-secondary">Trẻ em</p>
                                    <span class="text-danger fw-bold font-14">{{ formatToVND(tour[0].gia_tre_em) }}</span>
                                </div>
                            </div>

                            <form>
                                <div class="mb-3">
                                    <label class="form-label fw-bold text-dark font-13 mb-1">Khách hàng đặt</label>
                                    <input type="text" class="form-control form-control-sm bg-light" :value="ten_hien_thi" readonly>
                                </div>

                                <div class="row g-2 mb-3">
                                    <div class="col-12">
                                        <label class="form-label fw-bold text-dark d-flex justify-content-between font-13 mb-1">
                                            <span>Người lớn <small class="text-secondary fw-normal">(trên 10T)</small></span>
                                        </label>
                                        <div class="input-group input-group-sm">
                                            <button @click="decrease('adult')" class="btn btn-outline-secondary px-3" type="button">−</button>
                                            <input v-model="so_nguoi_lon" type="text" class="form-control text-center fw-bold bg-white" readonly>
                                            <button @click="increase('adult')" class="btn btn-outline-secondary px-3" type="button">+</button>
                                        </div>
                                    </div>

                                    <div class="col-12 mt-2">
                                        <label class="form-label fw-bold text-dark d-flex justify-content-between font-13 mb-1">
                                            <span>Trẻ em <small class="text-secondary fw-normal">(dưới 10T)</small></span>
                                        </label>
                                        <div class="input-group input-group-sm">
                                            <button @click="decrease('child')" class="btn btn-outline-secondary px-3" type="button">−</button>
                                            <input v-model="so_tre_em" type="text" class="form-control text-center fw-bold bg-white" readonly>
                                            <button @click="increase('child')" class="btn btn-outline-secondary px-3" type="button">+</button>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center border-top pt-2 mb-3">
                                    <span class="mb-0 text-dark fw-bold font-14">TỔNG TIỀN</span>
                                    <h4 class="mb-0 text-danger fw-bold">{{ formatToVND(tong_tien) }}</h4>
                                </div>

                                <div class="d-grid gap-2">
                                    <button @click="datTour()" type="button" class="btn btn-primary rounded-3 fw-bold shadow-sm py-2">
                                        ĐẶT TOUR NGAY
                                    </button>

                                    <div class="row g-2">
                                        <div class="col-6">
                                            <button @click="themVaoGioHang()" type="button" class="btn btn-warning w-100 rounded-3 fw-bold text-white shadow-sm py-2 font-13">
                                                <i class="fa-solid fa-cart-plus me-1"></i> Giỏ Hàng
                                            </button>
                                        </div>
                                        <div class="col-6">
                                            <button @click="themVaoWishlist()" type="button" class="btn text-white w-100 rounded-3 fw-bold shadow-sm py-2 font-13" style="background-color: #ff4757;">
                                                <i class="fa-solid fa-heart me-1"></i> Yêu Thích
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-12">
                    <div class="card border-0 shadow-sm rounded-4">
                        <div class="card-body p-4">
                            <h5 class="fw-bold mb-3 text-primary"><i class="fas fa-info-circle me-2"></i>Mô tả tour</h5>
                            <p class="text-secondary mb-0">{{ tour[0].mo_ta }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-5 pt-4 border-top">
                <h3 class="fw-bold text-dark mb-4 text-center">Có Thể Quý Khách Sẽ Thích</h3>
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
                    <div class="col" v-for="(v, k) in list_tour.slice(0, 4)" :key="v.id">
                        <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden tour-card">
                            <div class="position-relative tour-img-wrapper">
                                <router-link :to="'/client/chi-tiet-tour/' + v.id">
                                    <img :src="v.link_anh" class="card-img-top tour-img" alt="Ảnh Tour">
                                </router-link>
                            </div>
                            <div class="card-body d-flex flex-column p-3">
                                <h6 class="card-title fw-bold text-dark mb-2 tour-title">
                                    <router-link :to="'/client/chi-tiet-tour/' + v.id" class="text-decoration-none text-dark hover-primary">
                                        {{ v.tieu_de }}
                                    </router-link>
                                </h6>
                                <p class="text-danger fw-bold mt-auto mb-3">Chỉ từ {{ formatToVND(v.gia_tre_em) }}</p>
                                <div class="row g-2">
                                    <div class="col-6">
                                        <router-link :to="'/client/chi-tiet-tour/' + v.id" class="btn btn-outline-primary rounded-pill w-100 fw-medium font-14 py-1">Xem</router-link>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div v-else class="container d-flex justify-content-center align-items-center" style="height: 50vh;">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
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
        datTour() {
            if (this.so_nguoi_lon === 0 && this.so_tre_em === 0) {
                toaster.warning("Vui lòng chọn số lượng hành khách!");
                return;
            }
            if (this.is_login) {
                var payload = {
                    'gia_nguoi_lon': this.tour[0].gia_nguoi_lon,
                    'gia_tre_em': this.tour[0].gia_tre_em,
                    'so_nguoi_lon': this.so_nguoi_lon,
                    'so_tre_em': this.so_tre_em,
                    'id_tour': this.tour[0].id_tour,
                };
                axios
                    .post("http://127.0.0.1:8000/api/client/hoa-don/dat-tour", payload, {
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
                    });
            } else {
                toaster.error("Bạn cần đăng nhập trước khi đặt tour!");
                this.$router.push('/client/dang-nhap');
            }
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
            if (this.is_login) {
                var payload = {
                    'gia_nguoi_lon': this.tour[0].gia_nguoi_lon,
                    'gia_tre_em': this.tour[0].gia_tre_em,
                    'so_nguoi_lon': this.so_nguoi_lon,
                    'so_tre_em': this.so_tre_em,
                    'id_tour': this.tour[0].id_tour,
                };
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
                            toaster.error(res.data.message)
                        }
                    });
            } else {
                toaster.error("Bạn cần đăng nhập trước!");
                this.$router.push('/client/dang-nhap');
            }
        },
    },
}
</script>

<style scoped>
.font-12 { font-size: 12px; }
.font-14 { font-size: 14px; }

/* Khu vực Album ảnh */
.main-img {
    height: 400px;
}
.sub-img {
    height: 195px;
}
.sub-img-large {
    height: 195px;
}

/* Card Tour liên quan */
.tour-img-wrapper {
    height: 180px;
    overflow: hidden;
}
.tour-img {
    height: 100%;
    width: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
}
.tour-card {
    transition: all 0.3s ease;
}
.tour-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
}
.tour-card:hover .tour-img {
    transform: scale(1.1);
}
.tour-title {
    display: -webkit-box;
    line-clamp: 2;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    height: 2.5em;
}
.hover-primary:hover {
    color: #0d6efd !important;
}

/* Ẩn bớt border ở màn hình nhỏ */
@media (min-width: 768px) {
    .border-end-md {
        border-right: 1px solid #dee2e6;
    }
}

</style>