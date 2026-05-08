<template>
    <div style="height: 800px;" class="container">
        <div class="row">
            <div class="col-12 col-lg-3">
                <div class="card1" style="height: 0px;">
                    <div class="card1-body">
                        <div class="">
                            <h4 class=" text-black text-center">Tìm kiếm</h4>
                        </div>
                        <hr>
                        <div class="fm-menu mt-2">
                            <div class="list-group list-group-flush">
                                <div class="start-to-stop mb-3">
                                    <h5 class="point-start-title s-title">Loại hình tour</h5><select
                                        v-model="thong_tin.loai_dd" @change="searchTour()"
                                        class="form-control dropdown Filter" name="TourKindId">
                                        <option value="">Tất cả</option>
                                        <option value="1">Khách sạn</option>
                                        <option value="2">Nhà Hàng</option>
                                        <option value="3">Địa điểm tham quan</option>
                                    </select>
                                </div>
                                <div class="start-to-stop mb-3 ">
                                    <h5 class="point-start-title s-title">Chọn tỉnh đến</h5>
                                    <select v-model="thong_tin.tinh_thanh" @change="searchTour()"
                                        class="form-control dropdown Filter">
                                        <option value="">Tất cả</option>
                                        <option v-for="(value, index) in danh_sach_tinh_thanh" :key="index">
                                            {{ value.ten_tinh_thanh }}
                                        </option>
                                    </select>
                                    <!-- <div class="text-end mt-2">
                                        <button v-on:click="searchTour()"
                                            class="btn btn-primary bg-gradient-scooter">
                                             <i class="ms-2 fa-solid fa-magnifying-glass"></i>
                                        </button>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-9">
                <div class="card">
                    <div class="card-body">
                        <div class="card-header bg-gradient-scooter">
                            <h4 class="text-center text-white mt-2">Chúng tôi tìm thấy <strong>{{
                                list_danh_sach_tour.length }}</strong> tours
                                cho Quý khách. </h4>
                        </div>
                        <hr>
                        <div class="table-responsive-chieudoc" style="max-height: 600px;">
                            <div class="row mt-3">
                                <template v-for="(v, k) in list_danh_sach_tour" :key="k">
                                    <div class="row g-0">
                                        <div class="col-md-4">
                                            <img v-bind:src="v.link_anh" style="height: 190px;" alt="..."
                                                class="card-img">
                                        </div>
                                        <div class="col-md-8">
                                            <div class="card-body">
                                                <router-link to="">
                                                    <h5 class="card-title">{{ v.ten_dia_diem }}</h5>
                                                </router-link>
                                                <p class="card-text">Rio de Janeiro được mệnh danh là thành phố giữa núi
                                                    và biển
                                                    với những bãi biển cát trắng trải dài, thảm thực vật của Vườn quốc
                                                    gia Tijuca và Vườn bách thảo, đỉnh núi Corcovado (với bức tượng chúa
                                                    Kitô nổi tiếng.</p>
                                                <div class="row">
                                                    <div class="col-lg-6 mt-3">
                                                        <h6>Nơi đến: {{ v.ten_tinh_thanh }}</h6>
                                                        <div class="col-lg-12 ">
                                                            <h6 v-if="v.loai_dia_diem == 1">Loại địa điểm: Khách sạn
                                                            </h6>
                                                            <h6 v-if="v.loai_dia_diem == 2">Loại địa điểm: Nhà hàng</h6>
                                                            <h6 v-if="v.loai_dia_diem == 3">Loại địa điểm: Tham quan
                                                            </h6>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <span class="text-center">
                                                            <h5>{{ formatToVND(v.gia_nguoi_lon) }}</h5>
                                                        </span>
                                                        <div class="btn-book "><a href="#" title="Đặt ngay"
                                                                class="btn btn-primary bg-gradient-scooter form-control btn-sm btnOptionTour">Đặt
                                                                ngay</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                </template>
                            </div>
                        </div>
                        <!-- <div class="row mt-3">
                            <template v-for="(v, k) in list_danh_sach_tour" :key="k">
                                <div class="col-md-4 col-lg-4 col-xl-4 mx-auto">
                                    <div class="card border-end shadow-none">
                                        <a v-bind:href="'/client/chi-tiet-tour/' + v.id_tinh_thanh">
                                            <img v-bind:src="v.link_anh" style="height: 165px;"
                                                class="img-fluid w-100 mt-3" alt="">
                                            <div></div>
                                        </a>
                                        <div class="card-body">
                                            <router-link to="/client/chi-tiet-tour">
                                                <h5 style="height: 60px;" class="card-text tour-item__title mb-1">
                                                    {{ v.ten_dia_diem }}</h5>
                                            </router-link>
                                            <p style="height: 150px;" class="card-text">Rio de Janeiro được mệnh danh là
                                                thành phố giữa núi và biển
                                                với những bãi biển cát trắng trải dài, thảm thực vật của Vườn quốc gia
                                                Tijuca và Vườn bách thảo, đỉnh núi Corcovado (với bức tượng chúa Kitô
                                                nổi
                                                tiếng)</p>
                                            <p class="tour-item__departure mb-3">
                                            <h6>Nơi đến: {{ v.ten_tinh_thanh }}</h6><span class="font-weight-bold">
                                            </span>
                                            </p>
                                            
                                                <div class="col-lg-12 text-nowrap">
                                                    <p>
                                                        <h6 v-if="v.loai_dia_diem == 1">Loại địa điểm: Khách sạn</h6>
                                                        <h6 v-if="v.loai_dia_diem == 2">Loại địa điểm: Nhà hàng</h6>
                                                        <h6 v-if="v.loai_dia_diem == 3">Loại địa điểm: Tham quan</h6>
                                                    </p>
                                                </div>
                                            <hr>
                                            <div class="tour-item__price w-100">
                                                <div class="tour-item__price__wrapper">
                                                    <div class="row">
                                                        <div class="tour-item__price--current fix-leftalign"><span
                                                                class="tour-item__price--current__number pe-2 mb-0"><h5>4.990.000&nbsp;₫ </h5></span>
                                                        </div>
                                                    </div>
                                                    <div class="tour-item__price--current mt-2">
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div class="btn-book "><a href="#" title="Đặt ngay"
                                                                        class="btn btn-primary bg-gradient-scooter form-control btn-sm btnOptionTour">Đặt
                                                                        ngay</a>
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
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import baseRequest from "../../../core/baseRequest";
import { createToaster } from "@meforma/vue-toaster";
const toaster = createToaster({ position: "top-right" });
export default {
    data() {
        return {
            tt_tim_kiem: {},
            list_danh_sach_tour: [],
            diem_den: {},
            thong_tin: {},
            danh_sach_tinh_thanh: [],
            // list_danh_sach_tour     :   [],
        }
    },
    mounted() {
        this.loadDataDanhSach();
        this.loadDataTinhThanh();
    },
    methods: {
        loadDataDanhSach() {
            baseRequest
                .get('client/tim-kiem-tour/lay-du-lieu')
                .then((res) => {
                    this.list_danh_sach_tour = res.data.dia_diem_client;
                    console.log(this.list_danh_sach_tour)
                });
        },
        searchTour() {
            baseRequest
                .post('client/tim-kiem-tour/lay-du-lieu-tim-kiem', this.thong_tin)
                .then((res) => {
                    if (res.data.status) {
                        this.list_danh_sach_tour = res.data.tim_kiem;
                    }
                });
        },
        loadDataTinhThanh() {
            baseRequest
                .get('client/lay-du-lieu-tinh-thanh')
                .then((res) => {
                    this.danh_sach_tinh_thanh = res.data.tinh_thanh;
                });
        },
        // locDanhSach() {
        //     baseRequest
        //          .post('client/tim-kiem-tour/lay-du-lieu-den', this.diem_den)
        //          .then((res) => {
        //             if(res.data.status){
        //                 this.list_danh_sach_tour = res.data.dia_diem_client_den;
        //             }else{
        //                 toaster.error('Thông báo<br>' + res.data.message);
        //             }
        //          });
        //  },

        formatToVND(number) {
            number = parseInt(number);
            return number.toLocaleString('vi-VN', { style: 'currency', currency: 'VND' });
        },
    },
}
</script>
<style>
.table-responsive-chieudoc {
    overflow-y: auto;
    /* Cho phép cuộn dọc */
    overflow-x: hidden;
    /* Ẩn cuộn ngang */
}


/* Style cho thẻ card */
.card1 {
    background: transparent;
    /* Màu nền sáng */
    border-radius: 10px;
    /* Bo tròn góc */
    box-shadow: none;
    /* Đổ bóng nhẹ */
    padding: 20px;
    margin-top: 20px;
}

/* Style cho tiêu đề */
.card1 h4 {
    font-size: 1.5rem;
    /* Kích thước chữ */
    font-weight: bold;
    /* Chữ đậm */
    color: #343a40;
    /* Màu chữ tối */
    margin-bottom: 10px;
}

/* Style cho các phần tử con bên trong */
.card1-body {
    padding: 20px;
}

.s-title {
    font-size: 1.1rem;
    /* Kích thước chữ của tiêu đề nhỏ */
    font-weight: 600;
    color: #007acc;
    /* Màu xanh nổi bật */
    margin-bottom: 10px;
}

/* Style cho dropdown */
.dropdown.Filter {
    border-radius: 8px;
    /* Bo góc cho dropdown */
    border: 1px solid #ced4da;
    /* Viền màu trung tính */
    padding: 10px;
    transition: all 0.3s ease;
    /* Hiệu ứng khi hover */
}

.dropdown.Filter:hover {
    border-color: #007acc;
    /* Thay đổi màu viền khi hover */
    box-shadow: 0 2px 5px rgba(0, 122, 204, 0.2);
    /* Đổ bóng */
}

/* Style cho nút bấm */
.btn-primary:hover {
    background-color: #0056b3;
    /* Đổi màu nền khi hover */
    color: #f00303;
    /* Màu chữ */
    transform: scale(1.05);
    /* Phóng to nhẹ nút khi hover */
    transition: all 0.3s ease;
    /* Hiệu ứng chuyển đổi mượt */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    /* Đổ bóng nút khi hover */
}

/* Style cho nhóm danh sách */
.list-group-flush {
    margin-top: 10px;
}

.start-to-stop {
    margin-bottom: 15px;
}

/* Style cho khoảng cách cuối */
.text-end {
    margin-top: 10px;
}
</style>