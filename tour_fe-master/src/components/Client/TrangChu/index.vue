<template>
    <div>
        <div id="carouselExampleControls" class="carousel slide mb-5" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img :src="slide1" class="d-block w-100 object-fit-cover banner-img" alt="Slide 1">
                </div>
                <div class="carousel-item">
                    <img :src="slide2" class="d-block w-100 object-fit-cover banner-img" alt="Slide 2">
                </div>
                <div class="carousel-item">
                    <img :src="slide3" class="d-block w-100 object-fit-cover banner-img" alt="Slide 3">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

        <div class="container">
            <div class="row mb-5 mt-4">
                <div class="col-12">
                    <div class="search-banner rounded-4 p-5 text-center shadow-sm border">
                        <h4 class="fw-bold text-dark mb-4">Bạn đã sẵn sàng cho chuyến đi tiếp theo?</h4>
                        <router-link to="/client/danh-sach-tour" class="btn btn-primary rounded-pill px-5 py-3 fw-medium search-btn">
                            <i class="fa-solid fa-magnifying-glass me-2 text-white"></i> <span class="text-white">Khám Phá Toàn Bộ Tour Ngay</span>
                        </router-link>
                    </div>
                </div>
            </div>

            <div class="mb-5">
                <h3 class="fw-bold text-dark mb-4 text-center text-uppercase">Ưu Đãi Hấp Dẫn</h3>
                <div class="row row-cols-1 row-cols-md-3 g-4">
                    <div class="col">
                        <div class="card border-0 shadow-sm rounded-4 overflow-hidden promo-card">
                            <img :src="offer1" class="card-img-top" alt="Offer 1">
                        </div>
                    </div>
                    <div class="col">
                        <div class="card border-0 shadow-sm rounded-4 overflow-hidden promo-card">
                            <img :src="offer2" class="card-img-top" alt="Offer 2">
                        </div>
                    </div>
                    <div class="col">
                        <div class="card border-0 shadow-sm rounded-4 overflow-hidden promo-card">
                            <img :src="offer3" class="card-img-top" alt="Offer 3">
                        </div>
                    </div>
                </div>
            </div>

            <div class="mb-5">
                <h3 class="fw-bold text-dark mb-4 text-center text-uppercase">Khám Phá Hành Trình</h3>
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
                    <div class="col">
                        <router-link to="/client/danh-sach-tour" class="text-decoration-none">
                            <div class="card bg-dark text-white border-0 rounded-4 overflow-hidden category-card h-100">
                                <img src="../image/image4.jpg" class="card-img object-fit-cover h-100 opacity-75" alt="Category">
                                <div class="card-img-overlay d-flex flex-column justify-content-end p-4">
                                    <h5 class="card-title fw-bold text-light mb-0">Du lịch hành hương</h5>
                                </div>
                            </div>
                        </router-link>
                    </div>
                    <div class="col">
                        <router-link to="/client/danh-sach-tour" class="text-decoration-none">
                            <div class="card bg-dark text-white border-0 rounded-4 overflow-hidden category-card h-100">
                                <img src="../image/image2.jpg" class="card-img object-fit-cover h-100 opacity-75" alt="Category">
                                <div class="card-img-overlay d-flex flex-column justify-content-end p-4">
                                    <h5 class="card-title fw-bold text-light mb-0">Trải nghiệm Relax</h5>
                                </div>
                            </div>
                        </router-link>
                    </div>
                    <div class="col">
                        <router-link to="/client/danh-sach-tour" class="text-decoration-none">
                            <div class="card bg-dark text-white border-0 rounded-4 overflow-hidden category-card h-100">
                                <img src="../image/image6.jpg" class="card-img object-fit-cover h-100 opacity-75" alt="Category">
                                <div class="card-img-overlay d-flex flex-column justify-content-end p-4">
                                    <h5 class="card-title fw-bold text-light mb-0">Du lịch hạng sang</h5>
                                </div>
                            </div>
                        </router-link>
                    </div>
                    <div class="col">
                        <router-link to="/client/danh-sach-tour" class="text-decoration-none">
                            <div class="card bg-dark text-white border-0 rounded-4 overflow-hidden category-card h-100">
                                <img src="../image/image1.jpg" class="card-img object-fit-cover h-100 opacity-75" alt="Category">
                                <div class="card-img-overlay d-flex flex-column justify-content-end p-4">
                                    <h5 class="card-title fw-bold text-light mb-0">Hành trình độc đáo</h5>
                                </div>
                            </div>
                        </router-link>
                    </div>
                </div>
            </div>

            <div class="mb-5">
                <div class="d-flex justify-content-between align-items-end mb-4">
                    <h3 class="fw-bold text-dark mb-0 text-uppercase">Tour Mới Nhất</h3>
                    <router-link to="/client/danh-sach-tour" class="text-primary text-decoration-none fw-medium hover-primary">
                        Xem tất cả <i class="fa-solid fa-arrow-right ms-1"></i>
                    </router-link>
                </div>

                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
                    <div class="col" v-for="(v, k) in list_tour.slice(0, 8)" :key="v.id || k">
                        <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden tour-card">
                            <div class="position-relative tour-img-wrapper">
                                <img :src="v.link_anh" class="card-img-top tour-img" alt="Ảnh Tour">
                            </div>
                            <div class="card-body d-flex flex-column p-3">
                                <h6 class="card-title fw-bold text-dark mb-2 tour-title">
                                    <router-link :to="'/client/chi-tiet-tour/' + v.id" class="text-decoration-none text-dark hover-primary">
                                        {{ v.tieu_de }}
                                    </router-link>
                                </h6>
                                <p class="card-text text-secondary font-13 text-clamp-3 mb-3">{{ v.mo_ta }}</p>
                                
                                <div class="mt-auto pt-3 border-top text-center">
                                    <router-link :to="'/client/chi-tiet-tour/' + v.id" class="btn btn-outline-primary rounded-pill w-100 fw-medium font-14">
                                        Xem Chi Tiết
                                    </router-link>
                                </div>
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

<style scoped>
/* Tiện ích tùy chỉnh */
.font-13 { font-size: 13px; }
.font-14 { font-size: 14px; }

/* Banner ảnh Carousel */
.banner-img {
    height: 450px; 
}

/* Đổ bóng cho text đè lên ảnh */
.text-shadow {
    text-shadow: 1px 1px 4px rgba(0,0,0,0.8);
}

/* Hiệu ứng di chuột cho các liên kết chữ */
.hover-primary {
    transition: color 0.3s ease;
}
.hover-primary:hover {
    color: #0d6efd !important;
}

/* Hiệu ứng thẻ Promo Card */
.promo-card {
    transition: transform 0.3s ease;
    cursor: pointer;
}
.promo-card:hover {
    transform: translateY(-5px);
}

/* Hiệu ứng thẻ Category Khám Phá */
.category-card {
    height: 250px;
    cursor: pointer;
}
.category-card img {
    transition: transform 0.5s ease;
}
.category-card:hover img {
    transform: scale(1.1);
}

/* Hiệu ứng thẻ Tour Card */
.tour-card {
    transition: all 0.3s ease;
}
.tour-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
}
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
.tour-card:hover .tour-img {
    transform: scale(1.1);
}

.text-clamp-3 {
    display: -webkit-box;
    line-clamp: 3;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
.tour-title {
    display: -webkit-box;
    line-clamp: 2;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    height: 2.5em; /* Giữ khung luôn cố định dù chữ có 1 dòng */
}
</style>