<template>
    <div class="container">
        <div class="row">
            <h1 style="color: #003C71;">Tiêu đề tour</h1>
        </div>
        <div class="row">
            <h3 class="ms-2">Đánh giá tour</h3>
        </div>
        <div class="row">
            <template v-for="(v,k) in list_tour">
                <div class="col-12 col-lg-8">
                    <div class="card" style="height: 500px;">
                        <img v-bind:src="v.link_anh"
                            class="card-img-top" alt="...">
                    </div>
                </div>
            </template>
            <div class="col-12 col-lg-4">
                <div class="card" style="height: 500px; background-color: #FEEEC7;">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-center">
                            <h3 class="mb-0" style="color: #003C71; font-weight: bold;">Thông Tin Đặt Tour</h3>
                        </div>
                        <hr>
                        <form class="row g-3">
                            <div class="col-md-12">
                                <label for="inputFirstName" class="form-label"
                                    style="font-size: large; color: #003C71;">Họ
                                    Tên</label>
                                <input type="text" class="form-control" id="inputFirstName" placeholder="Nhập họ tên"
                                    style="font-style: italic;">
                            </div>
                            <div class="col-md-12">
                                <label for="inputEmail" class="form-label"
                                    style="font-size: large; color: #003C71;">Email</label>
                                <input type="email" class="form-control" id="inputEmail" placeholder="Nhập Email"
                                    style="font-style: italic;">
                            </div>
                            <div class="col-md-6">
                                <label for="inputNguoiLon" class="form-label">Người Lớn<h7
                                        style="font-style: italic; font-weight: bold;">(trên 10 tuổi)</h7></label>
                                <div class="input-group input-spinner">
                                    <button style="width: 50px; border-width: 2px; background-color: #FFBD00;"
                                        class="btn btn-white ms-3" type="button" id="button-minus-nguoi-lon"> −
                                    </button>
                                    <input type="text" class="form-control text-center" value="1">
                                    <button style="width: 50px; border-width: 2px; background-color: #FFBD00;"
                                        class="btn btn-white me-3" type="button" id="button-plus-nguoi-lon"> + </button>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="inputTreEm" class="form-label">Trẻ Em<h7
                                        style="font-style: italic; font-weight: bold;">
                                        (dưới 10 tuổi)</h7></label>
                                <div class="input-group input-spinner">
                                    <button style="width: 50px; border-width: 2px; background-color: #FFBD00;"
                                        class="btn btn-white ms-3" type="button" id="button-minus-tre-em"> − </button>
                                    <input type="text" class="form-control text-center" value="1">
                                    <button style="width: 50px; border-width: 2px; background-color: #FFBD00;"
                                        class="btn btn-white me-3" type="button" id="button-plus-tre-em"> + </button>
                                </div>
                            </div>
                            <div class="col-md-12 mt-4">
                                <div class="row">
                                    <div class="col-md-5 text-start">
                                        <h5>Tổng Giá Tour</h5>
                                    </div>
                                    <div class="col-md-7 text-end">
                                        <h4 style="color: #FFBD00;">72.000.000 VNĐ</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <button type="button"
                                    style="border-width: 5px; height: 70px; border-radius: 20px; font-size: 21px; width: 183px;"
                                    class="btn btn-outline-secondary">Liên Hệ Tư Vấn</button>
                            </div>
                            <div class="col-md-6">
                                <router-link to="/client/hoa-don">
                                    <button type="button"
                                        style="border-width: 5px; height: 70px; border-color: #003C71; background-color: white; border-radius: 20px; font-weight: 550; font-size: 21px; width: 183px;"
                                        class="btn">Đặt Ngay</button>
                                </router-link>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-lg-8">
                <div class="card radius-10 border-start border-0 border-3 border-warning">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <div class="row">
                                    <div class="col">
                                        <h2 class="card-title">Thông tin tour</h2>
                                    </div>
                                    <div class="col">
                                        <h2 class="card-title">Thông tin tour</h2>
                                    </div>
                                    <div class="col">
                                        <h2 class="card-title">Thông tin tour</h2>
                                    </div>
                                </div>
                                <hr style="width: 815px;">
                                <h4>Chi tiết tour</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-lg-8">
                <div class="card radius-10 border-start border-0 border-3 border-warning">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <div class="row">
                                    <div class="col">
                                        <h2 class="card-title">Mô tả</h2>
                                    </div>
                                </div>
                                <hr style="width: 815px;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import baseRequest from "../../../core/baseRequestClient";
import { createToaster } from "@meforma/vue-toaster";
const toaster = createToaster({ position: "top-right" });
export default {
    data() {
        return {
            tour: [],
            list_tour: [],
        }
    },
    mounted() {
        // this.loadDataChiTietTour();
        this.loadDataTour();
        // this.kiemTraDangNhap();
    },
    methods: {
        loadDataTour() {
            baseRequest.get("client/tour/lay-du-lieu").then((res) => {
                if (res.data.status) {
                    this.list_tour = res.data.tour_client;
                    console.log(this.list_tour)
                } else {
                    toaster.error("Thông báo<br>" + res.data.message);
                }
            });
        },
        loadDataChiTietTour() {
            var url = window.location.href;
            var arr = url.split('/');
            var gui_di = {
                id: arr[arr.length - 1]
            }
            baseRequest
                .post('/client/tour/lay-chi-tiet-tour/data', gui_di)
                .then((res) => {
                    if (res.data.status) {
                        this.tour = res.data.chi_tiet_tour;
                        console.log(this.tour);
                    } else {
                        toaster.error('Thông báo<br>' + res.data.message);
                    }
                });
        },
    }
}
</script>
<style></style>