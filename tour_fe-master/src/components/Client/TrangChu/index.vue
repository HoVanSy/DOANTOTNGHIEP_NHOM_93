<template>
    <div class="row">
        <div id="carouselExampleControlsNoTouching" class="carousel slide" data-bs-touch="false">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img :src="slide1" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img :src="slide2" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img :src="slide3" class="d-block w-100" alt="...">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControlsNoTouching"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControlsNoTouching"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
    <div class="container">
        <div class="row mt-5">
            <div class="col-lg-12">
                <router-link to="/client/danh-sach-tour">
                    <button type="button" class="btn btn-info form-control px-5 bg-gradient-scooter text-dark ms-auto">
                        <h2 class="mt-2">TÌM KIẾM TOUR CỦA BẠN<i class="fa-solid fa-magnifying-glass ms-2 py-3"></i>
                        </h2>
                    </button>
                </router-link>
            </div>
        </div>

    </div>

    <div class="container mt-5">
        <h2>ƯU ĐÃI</h2>
        <div class="row row-cols-1 row-cols-md-1 row-cols-lg-3 row-cols-xl-3">
            <div class="col">
                <div class="card">
                    <img :src="offer1" class="card-img-top" alt="...">
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <img :src="offer2" class="card-img-top" alt="...">
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <img :src="offer3" class="card-img-top" alt="...">
                </div>
            </div>
        </div>
        <hr>
        <h2>KHÁM PHÁ</h2>
        <hr>
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 row-cols-xl-4">
            <div class="col">
                <router-link to="/client/danh-sach-tour">
                    <div class="card bg-dark text-white">
                        <img src="../image/image4.jpg" class="card-img" alt="...">
                        <div class="card-img-overlay">
                            <h4 class="card-title text-white" style="margin-top: 330px;">Du lịch kết hợp hành hương</h4>
                        </div>
                    </div>
                </router-link>
            </div>
            <div class="col">
                <router-link to="/client/danh-sach-tour">
                    <div class="card bg-dark text-white">
                        <img src="../image/image2.jpg" class="card-img" alt="...">
                        <div class="card-img-overlay">
                            <h4 class="card-title text-white" style="margin-top: 330px;">Tour trải nghiệm mới mẻ, relax</h4>
                        </div>
                    </div>
                </router-link>
            </div>
            <div class="col">
                <router-link to="/client/danh-sach-tour">
                    <div class="card bg-dark text-white">
                        <img src="../image/image6.jpg" class="card-img" alt="...">
                        <div class="card-img-overlay">
                            <h4 class="card-title text-white" style="margin-top: 330px;">Trải nghiệm du lịch hạng sang
                            </h4>
                        </div>
                    </div>
                </router-link>
            </div>
            <div class="col">
                <router-link to="/client/danh-sach-tour">
                    <div class="card bg-dark text-white">
                        <img src="../image/image1.jpg" class="card-img" alt="...">
                        <div class="card-img-overlay">
                            <h4 class="card-title text-white" style="margin-top: 330px;">Tour mới - Hành trình độc đáo
                            </h4>
                        </div>
                    </div>
                </router-link>
            </div>
        </div>
        <h2>DANH SÁCH TOUR</h2>
        <hr>
        <div class="row">
            <template v-for="(v, k) in list_tour">
                <div class="col-md-3 col-lg-3 col-xl-3 mx-auto" v-if="k < 8" :key="k">
                    <div class="card border-end shadow-none">
                        <a v-bind:href="'/client/chi-tiet-tour/' + v.id">
                            <img v-bind:src="v.link_anh" class="card-img-top" alt="" style="height: 172px;">
                        </a>
                        <div class="card-body">
                            <h5 style="height: 60px;" class="card-title mx-auto">{{ v.tieu_de }}</h5>
                            <p style="height: 165px;" class="card-text">{{ v.mo_ta }}</p>
                            <hr>
                            <div class="d-flex align-items-center gap-2">
                                <a style="width: 330px;" v-bind:href="'/client/chi-tiet-tour/' + v.id"
                                    class="btn btn-outline-info px-5"><i class="fa-solid fa-arrow-right"></i>Xem Chi
                                    Tiết</a>
                            </div>
                        </div>
                        <!-- <div class="card-footer bg-white"> <small class="text-muted">
                                <h6>Last updated 3 mins ago</h6>
                            </small>
                        </div> -->
                    </div>
                </div>
            </template>
        </div>
        <div class="row text-end mb-4">
            <div class="col">
                <router-link to="/client/danh-sach-tour">
                    <button type="button" class="btn btn-outline-primary px-5">Xem tất cả <i
                            class="fa-solid fa-arrow-right ms-1"></i></button>
                </router-link>
            </div>
        </div>
        <!-- <h2>GÓI ƯU ĐÃI ĐẶC BIỆT</h2>
        <hr>
        <div class="col">
            <div class="card mb-3">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="https://media.travel.com.vn/LastMinute/lm_240620080927_681129_TRANG%20AN%20(4).jpg"
                            class="card-img-top" alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">This is a wider card with supporting text below as a natural lead-in to
                                additional content. This content is a little bit longer.</p>
                            <p class="card-text"><small class="text-body-secondary">Last updated 3 mins ago</small></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <h2>ĐIỂM ĐẾN YÊU THÍCH</h2>
        <hr>
        <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
            <div class="col">
                <div class="card radius-10">
                    <div class="card-body" style="position: relative;">
                        <div class="d-flex align-items-center">
                            <h6>Ghi chi đó ghi</h6>
                        </div>
                        <img src="https://media.travel.com.vn/LastMinute/lm_240620080927_681129_TRANG%20AN%20(4).jpg"
                            class="card-img-top" alt="...">
                        <div class="resize-triggers">
                            <div class="expand-trigger mt-2">
                                <div style="width: 311px; height: 143px;">
                                    <h6>Ghi chi đó ghi</h6>
                                </div>
                            </div>
                            <div class="contract-trigger"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
    </div>
</template>
<script>
import baseRequest from "../../../core/baseRequestClient";
import { createToaster } from "@meforma/vue-toaster";
import slide1 from '../../../layout/imgaes/Book now.png';
import slide2 from '../../../layout/imgaes/Thiết kế chưa có tên.png';
import slide3 from '../../../layout/imgaes/www.reallygreatsite.com.png';
import offer1 from '../../../layout/imgaes/ưu đãi 1.png';
import offer2 from '../../../layout/imgaes/ưu đãi 2.png';
import offer3 from '../../../layout/imgaes/ưu đãi 3.png';
const toaster = createToaster({ position: "top-right" });
export default {
    data() {
        return {
            slide1,
            slide2,
            slide3,
            offer1,
            offer2,
            offer3,
            list_tour: [],
            list_tinh_thanh: [],
            tt_tim: {},
        }
    },
    mounted() {
        this.loadDataTour();
    },
    methods: {
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
        chuyenTrang() {
            this.$router.push('/client/danh-sach-tour');
        }
    },
}
</script>
<style></style>