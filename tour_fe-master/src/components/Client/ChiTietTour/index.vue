<template lang="">
    <div class="container">
        <div class="row mb-3">
            <div class="d-flex justify-content-between">
                <div class="col-lg-5">
                    <template v-for="(v, k) in tour">
                        <h3 class="title" v-if="k == 0"> {{ tour[0].tieu_de_tour }} </h3>
                    </template>
</div>
</div>
</div>
</div>
<div class="container ">
    <div class="card">
        <div class="card-body">
            <div class="row animate__fadeIn animate__animated">
                <template v-for="(v, k) in tour">
                            <div v-if="k == 0" class="col-lg-7 col-md-12 col-sm-12 left ">
                                <img v-bind:src="tour[0].anh_tour" style="height: 497px; width: 746px" class="img-fluid" alt="image">
                            </div>
                        </template>
                <div class="col-lg-5 col-md-12 col-sm-12 right">
                    <div class="row gy-4">
                        <div class="col-md-12 col-12 small">
                            <div class="row">
                                <template v-for="(v, k) in tour">
                                            <div class="col-6" v-if="k == 0">
                                            <img v-bind:src="tour[1].link_anh" style="height: 167px; width: 251px" class="img-fluid" alt="">
                                            </div>
                                        </template>
                                <template v-for="(v, k) in tour">
                                            <div class="col-6" v-if="k == 0">
                                            <img v-bind:src="tour[2].link_anh" style="height: 167px; width: 251px" class="img-fluid" alt="">
                                            </div>
                                        </template>
                            </div>
                        </div>
                        <template v-for="(v, k) in tour">
                                    <div class="col-md-12 col-12" v-if="k == 0">
                                        <img v-bind:src="tour[0].link_anh" style="height: 305px; width: 550px" class="img-fluid" alt="">
                                    </div>
                                </template>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>
</div>
<div class="overview active">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <section class="section-03 mb-5">
                    <div class="row">
                        <div class="col-md-3 col-12 left">
                            <div class="box-order">
                                <template v-for="(v, k) in tour">
                            <div class="time" v-if="k == 0">
                                <p>Khởi hành <b>ngày {{ formatDate(tour[0].ngay_bat_dau) }}</b></p>
                                <p>Kết thúc <b>ngày {{ formatDate(tour[0].ngay_ket_thuc) }}</b></p>
                                <p>Nơi khởi hành <b> {{ tour[0].ten_tinh_thanh }}</b></p>
                            </div>
                        </template>
                            </div>
                        </div>
                        <div class="col-md-9 col-12 right">
                            <div class="group-services">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="item"><i class="fas fa-car-side me-2"></i><label>Phương tiện di
                                                chuyển</label>
                                            <p>Máy bay</p>
                                        </div>
                                    </div>
                                    <template v-for="(v, k) in tour">
                                        <div class="col-lg-6" v-if="k == 1">
                                            <div class="item"><i class="fas fa-map-marked-alt me-2"></i><label>Điểm tham
                                                    quan&nbsp;</label>
                                                <b>{{ tour[0].ten_dia_diem }}, {{ tour[1].ten_dia_diem }}, {{ tour[2].ten_dia_diem }}</b>
                                            </div>
                                        </div>
                                    </template>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="item"><i class="fas fa-users me-2"></i><label>Đối tượng thích
                                                hợp</label>
                                            <p>Cặp đôi, Gia đình nhiều thế hệ</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="item"><i class="fas fa-utensils me-2"></i><label>Ẩm
                                                thực</label>
                                            <p>Buffet sáng, Đặc sản địa phương</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3">
                                        <div class="item"><i class="fas fa-hotel me-2"></i><label>Khách sạn</label>
                                            <p>Khách sạn 4 sao</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="item"><i class="far fa-clock me-2"></i><label>Thích hợp</label>
                                            <p>Quanh năm</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="item"><i class="far fa-clock me-2"></i><label>Thời gian</label>
                                            <p>5 ngày 4 đêm</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="item"><i class="fas fa-user-tag me-2"></i><label>Ưu
                                                đãi</label>
                                            <p>Đã bao gồm ưu đãi trong giá tour </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <div class="col-12 col-lg-4">
                <div class="card" style="height: 440px; background-color: #FEEEC7;">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-center">
                            <h3 class="mb-0" style="color: #003C71; font-weight: bold;">Thông Tin Đặt Tour</h3>
                        </div>
                        <hr>
                        <form class="row g-3">
                            <div class="col-md-12">
                                <label for="inputFirstName" class="form-label"
                                    style="font-size: large; color: #003C71;">
                                    <h5>Họ Tên</h5>
                                </label>
                            </div>
                            <div class="col-md-12 mt-0">
                                <p class="border border bg-white p-2 rounded" style="font-size: 17px"><i>{{ ten_hien_thi
                                        }}</i></p>
                            </div>
                            <div class="col-md-6">
                                <label for="inputNguoiLon" class="form-label">Người Lớn <h7
                                        style="font-style: italic; font-weight: bold;">(trên 10 tuổi)</h7></label>
                                <div class="input-group input-spinner">
                                    <button @click="decrease('adult')"
                                        style="width: 50px; border-width: 2px; background-color: #FFBD00;"
                                        class="btn btn-white ms-3" type="button" id="button-minus-nguoi-lon"> −
                                    </button>
                                    <input v-model="so_nguoi_lon" type="text" class="form-control text-center">
                                    <button @click="increase('adult')"
                                        style="width: 50px; border-width: 2px; background-color: #FFBD00;"
                                        class="btn btn-white me-3" type="button" id="button-plus-nguoi-lon"> + </button>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="inputTreEm" class="form-label">Trẻ Em <h7
                                        style="font-style: italic; font-weight: bold;">
                                        (dưới 10 tuổi)</h7></label>
                                <div class="input-group input-spinner">
                                    <button @click="decrease('child')"
                                        style="width: 50px; border-width: 2px; background-color: #FFBD00;"
                                        class="btn btn-white ms-3" type="button" id="button-minus-tre-em"> − </button>
                                    <input v-model="so_tre_em" type="text" class="form-control text-center">
                                    <p></p>
                                    <button @click="increase('child')"
                                        style="width: 50px; border-width: 2px; background-color: #FFBD00;"
                                        class="btn btn-white me-3" type="button" id="button-plus-tre-em"> + </button>
                                </div>
                            </div>
                            <div class="col-md-12 mt-4">
                                <div class="row">
                                    <div class="col-md-5 text-start">
                                        <h5>Tổng Giá Tour</h5>
                                    </div>
                                    <div class="col-md-7 text-end">
                                        <h4 style="color: #FFBD00;">{{ formatToVND(tong_tien) }}</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <button @click="themVaoGioHang()" type="button"
                                    style="border-width: 5px; height: 70px; border-radius: 20px; font-size: 15px; width: 183px;"
                                    class="btn btn-outline-secondary">Thêm Vào Giỏ Hàng</button>
                            </div>
                            <div class="col-md-6">
                                <!-- <router-link :to="'/client/hoa-don/' + id_tour" target="_blank"> -->
                                <button @click="datTour()" type="button"
                                    style="border-width: 5px; height: 70px; border-color: #003C71; background-color: white; border-radius: 20px; font-weight: 550; font-size: 15px; width: 183px;"
                                    class="btn">Đặt Ngay
                                </button>
                                <!-- </router-link> -->
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="section-08 mb-5">
        <div class="container">
            <div class="row">
                <div class="col-md-7 col-12 left">
                    <h2 class="mb-4">Chi tiết tour</h2>
                    <div class="tour">
                        <div class="detail-tour">
                            <h3 class="tt">Thông tin chuyến bay</h3>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="detail-tour-inner">
                                        <template v-for="(v, k) in tour">
                                                <div class="date text-center" v-if="(k == 0)">
                                                    <span>Ngày đi - </span>
                                                    <b>{{ formatDate(tour[0].ngay_bat_dau) }}</b>
                                                </div>
                                           </template>
                                        <div class="time mt-2">
                                            <div class="row">
                                                <div class="col-4">08:20</div>
                                                <div class="col-4 text-center">Bay thẳng</div>
                                                <div class="col-4 text-end">09:20</div>
                                            </div>
                                        </div>
                                        <div class="from d-flex justify-content-between align-items-center col-12">
                                            <div class="col-md-4 small text-center"></div>
                                            <div class="row col-md-4"></div>
                                            <div class="col-md-4 small text-center"></div>
                                        </div>
                                        <div class="p-line">
                                            <hr>
                                            <div class="row">
                                                <div class="col-4">
                                                    <span><i class="fas fa-map-marker-alt"></i></span>
                                                </div>
                                                <div class="col-4 text-center">
                                                    <span><i class="fas fa-plane"></i></span>
                                                </div>
                                                <div class="col-4 text-end">
                                                    <span><i class="fas fa-map-marker-alt"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="cb mt-2">Ký hiệu chuyến bay<p> VN8077</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="detail-tour-inner comeback ">
                                        <template v-for="(v, k) in tour">
                                                <div class="date text-center" v-if="(k == 0)">
                                                    <span>Ngày về - </span>
                                                    <b>{{ formatDate(tour[0].ngay_ket_thuc) }}</b>
                                                </div>
                                           </template>
                                        <div class="time mt-2">
                                            <div class="row">
                                                <div class="col-4">11:25</div>
                                                <div class="col-4 text-center">Bay thẳng</div>
                                                <div class="col-4 text-end">12:35</div>
                                            </div>
                                        </div>
                                        <div class="p-line">
                                            <hr>
                                            <div class="row">
                                                <div class="col-4">
                                                    <span><i class="fas fa-map-marker-alt"></i></span>
                                                </div>
                                                <div class="col-4 text-center">
                                                    <span><i class="fas fa-plane"></i></span>
                                                </div>
                                                <div class="col-4 text-end">
                                                    <span><i class="fas fa-map-marker-alt"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="cb mt-2">Ký hiệu chuyến bay<p> VN8066</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="more-info more-info-1 mt-2">
                            <h4 class="tt">Thông tin tập trung</h4>
                            <div class="row">
                                <template v-for="(v, k) in tour">
                                        <div class="col-6" v-if="(k == 0)">
                                            <span>Ngày giờ tập trung</span>
                                            <h6>7:00 AM - Ngày {{ formatDate(tour[0].ngay_bat_dau) }}</h6>
                                        </div>
                                    </template>
                                <div class="col-6">
                                    <div class="block"><span>Nơi tập trung</span></div>
                                    <div class="info">Sân bay</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-1 col-12"></div>
                <div class="col-md-4 col-12">
                    <h2>Giá tour</h2>
                    <div class="row mt-4">
                        <div class="col-6">
                            <h4>Loại Khách</h4>
                            <p>Người lớn (Từ 10 tuổi trở lên)</p>
                            <p>Trẻ em (Dưới 10 tuổi)</p>
                        </div>
                        <div class="col-6">
                            <h4>Giá Tour</h4>
                            <template v-for="(v, k) in tour">
                                    <div v-if="(k == 0)">
                                        <p class="t-price text-danger">{{ formatToVND(tour[0].gia_nguoi_lon) }}</p>
                                    </div>
                                </template>
                            <template v-for="(v, k) in tour">
                                    <div v-if="(k == 0)">
                                        <p class="t-price text-danger">{{ formatToVND(tour[0].gia_tre_em) }}</p>
                                    </div>
                            </template>
                        </div>
                    </div>
                    <h2 class="tt mt-3">Thông tin hướng dẫn viên</h2>
                    <div class="table-price">
                        <div class="more-info more-info-2">
                            <div>Đang cập nhật...</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="container">
        <div class="text-center">
            <h3 class="mb-3">Có Thể Quý Khách Sẽ Thích</h3>
        </div>
        <div class="row">
            <template v-for="(v,k) in list_tour" :key="k">
                    <div class="col-md-3 col-lg-3 col-xl-3 mx-auto" v-if="k > 3 && k < 8">
                        <div class="card border-end shadow-none" style="height: 350px">
                            <a v-bind:href="'/client/chi-tiet-tour/' + v.id">
                                <img v-bind:src="v.link_anh" class="card-img-top" alt="" style="height: 172px;"></a>
                            <div class="card-body">
                                <router-link to="/client/chi-tiet-tour">
                                    <h5 style="height: 50px;" class="card-text tour-item__title mb-1">{{ v.tieu_de }}</h5>
                                </router-link>
                                <hr>
                                <div class="tour-item__price w-100">
                                    <div class="tour-item__price__wrapper">
                                        <div class="tour-item__price--current fix-leftalign"><span
                                                class="tour-item__price--current__number pe-2 mb-0"><i>Chỉ từ {{ formatToVND(v.gia_tre_em) }} / người</i></span>
                                        </div>
                                        <div class="tour-item__price--current mt-2">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="btn-block"><a
                                                            href=""
                                                            class="btn btn-outline-success radius-30">Đặt Ngay</a></div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="btn-block"><a
                                                            v-bind:href="'/client/chi-tiet-tour/' + v.id"
                                                            class="btn btn-outline-info radius-30">Xem
                                                            Chi Tiết</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </template>
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
            id_hoa_don: 0,
            hoadon: {},
            id_tour: 0,
            cttour: {},
            ten_hien_thi: 'Họ tên',
            email: 'Email'
        }
    },
    mounted() {
        this.loadDataChiTietTour();
        this.loadDataTour();
        this.kiemTraDangNhap();
        this.checkLogin();
    },
    computed: {
        totalPrice() {
            return this.adultCount * this.adultPrice + this.childCount * this.childPrice;
        },
    },
    methods: {
        datTour() {
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
                        console.log(this.tour);
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
                    } else {
                        toaster.error('Thông báo<br>' + res.data.message);
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
            this.tong_tien = (this.tour[0].gia_nguoi_lon * this.so_nguoi_lon) +
                (this.tour[0].gia_tre_em * this.so_tre_em);
        },
        formatToVND(number) {
            number = parseInt(number);
            return number.toLocaleString('vi-VN', { style: 'currency', currency: 'VND' });
        },
        formatDate(date) {
            if (!date) return ''; // Kiểm tra nếu không có ngày
            const d = new Date(date);
            const day = String(d.getDate()).padStart(2, '0'); // Lấy ngày, thêm số 0 nếu cần
            const month = String(d.getMonth() + 1).padStart(2, '0'); // Tháng + 1, thêm số 0
            const year = d.getFullYear(); // Lấy năm
            return `${day}/${month}/${year}`; // Trả về chuỗi định dạng dd/mm/yyyy
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
                });
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
<style lang="">

</style>