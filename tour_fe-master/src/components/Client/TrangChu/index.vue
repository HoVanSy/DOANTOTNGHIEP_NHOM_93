<template>
    <div class="home-page">

        <!-- ── CAROUSEL ── -->
        <div id="carouselExampleControls" class="carousel slide mb-0" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img :src="slide1" class="d-block w-100 object-fit-cover banner-img" alt="Slide 1">
                    <div class="carousel-overlay"></div>
                    <div class="carousel-caption-custom">
                        <span class="caption-tag">Khám phá Việt Nam</span>
                        <h2 class="caption-title">Hành trình tuyệt đẹp<br>chờ đón bạn</h2>
                    </div>
                </div>
                <div class="carousel-item">
                    <img :src="slide2" class="d-block w-100 object-fit-cover banner-img" alt="Slide 2">
                    <div class="carousel-overlay"></div>
                    <div class="carousel-caption-custom">
                        <span class="caption-tag">Trải nghiệm mới</span>
                        <h2 class="caption-title">Khám phá thiên nhiên<br>hoang sơ kỳ vĩ</h2>
                    </div>
                </div>
                <div class="carousel-item">
                    <img :src="slide3" class="d-block w-100 object-fit-cover banner-img" alt="Slide 3">
                    <div class="carousel-overlay"></div>
                    <div class="carousel-caption-custom">
                        <span class="caption-tag">Tour hạng sang</span>
                        <h2 class="caption-title">Luxury travel<br>dành riêng cho bạn</h2>
                    </div>
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

        <div class="container main-container">

            <!-- ── CTA BANNER ── -->
            <div class="row mb-5 mt-4">
                <div class="col-12">
                    <div class="cta-banner rounded-4 p-5 text-center">
                        <p class="cta-label">Sẵn sàng lên đường?</p>
                        <h4 class="fw-bold mb-4">Bạn đã sẵn sàng cho chuyến đi tiếp theo?</h4>
                        <router-link to="/client/danh-sach-tour" class="cta-btn">
                            <i class="fa-solid fa-magnifying-glass me-2"></i>
                            Khám Phá Toàn Bộ Tour Ngay
                        </router-link>
                    </div>
                </div>
            </div>

            <!-- ── ƯU ĐÃI HẤP DẪN ── -->
            <div class="mb-5">
                <div class="section-header text-center mb-4">
                    <span class="section-tag">Dành riêng cho bạn</span>
                    <h3 class="section-title">Ưu Đãi Hấp Dẫn</h3>
                </div>
                <div class="row row-cols-1 row-cols-md-3 g-4">
                    <div class="col">
                        <div class="promo-card rounded-4 overflow-hidden">
                            <img :src="offer1" class="card-img-top" alt="Offer 1">
                            <div class="promo-overlay">
                                <span class="promo-badge">Giảm 30%</span>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="promo-card rounded-4 overflow-hidden">
                            <img :src="offer2" class="card-img-top" alt="Offer 2">
                            <div class="promo-overlay">
                                <span class="promo-badge">Hè 2025</span>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="promo-card rounded-4 overflow-hidden">
                            <img :src="offer3" class="card-img-top" alt="Offer 3">
                            <div class="promo-overlay">
                                <span class="promo-badge">Combo tiết kiệm</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ── KHÁM PHÁ HÀNH TRÌNH ── -->
            <div class="mb-5">
                <div class="section-header text-center mb-4">
                    <span class="section-tag">Phong cách du lịch</span>
                    <h3 class="section-title">Khám Phá Hành Trình</h3>
                </div>
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
                    <div class="col">
                        <router-link to="/client/danh-sach-tour" class="text-decoration-none">
                            <div class="category-card rounded-4 overflow-hidden">
                                <img src="../image/image4.jpg" class="cat-img" alt="Category">
                                <div class="cat-overlay">
                                    <div class="cat-icon"><i class="fa-solid fa-place-of-worship"></i></div>
                                    <h5 class="cat-title">Du lịch hành hương</h5>
                                </div>
                            </div>
                        </router-link>
                    </div>
                    <div class="col">
                        <router-link to="/client/danh-sach-tour" class="text-decoration-none">
                            <div class="category-card rounded-4 overflow-hidden">
                                <img src="../image/image2.jpg" class="cat-img" alt="Category">
                                <div class="cat-overlay">
                                    <div class="cat-icon"><i class="fa-solid fa-umbrella-beach"></i></div>
                                    <h5 class="cat-title">Trải nghiệm Relax</h5>
                                </div>
                            </div>
                        </router-link>
                    </div>
                    <div class="col">
                        <router-link to="/client/danh-sach-tour" class="text-decoration-none">
                            <div class="category-card rounded-4 overflow-hidden">
                                <img src="../image/image6.jpg" class="cat-img" alt="Category">
                                <div class="cat-overlay">
                                    <div class="cat-icon"><i class="fa-solid fa-gem"></i></div>
                                    <h5 class="cat-title">Du lịch hạng sang</h5>
                                </div>
                            </div>
                        </router-link>
                    </div>
                    <div class="col">
                        <router-link to="/client/danh-sach-tour" class="text-decoration-none">
                            <div class="category-card rounded-4 overflow-hidden">
                                <img src="../image/image1.jpg" class="cat-img" alt="Category">
                                <div class="cat-overlay">
                                    <div class="cat-icon"><i class="fa-solid fa-compass"></i></div>
                                    <h5 class="cat-title">Hành trình độc đáo</h5>
                                </div>
                            </div>
                        </router-link>
                    </div>
                </div>
            </div>

            <!-- ── TOUR MỚI NHẤT ── -->
            <div class="mb-5">
                <div class="d-flex justify-content-between align-items-end mb-4">
                    <div>
                        <span class="section-tag d-block mb-1">Cập nhật mới nhất</span>
                        <h3 class="section-title mb-0">Tour Mới Nhất</h3>
                    </div>
                    <router-link to="/client/danh-sach-tour" class="view-all-link">
                        Xem tất cả <i class="fa-solid fa-arrow-right ms-1"></i>
                    </router-link>
                </div>

                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
                    <div class="col" v-for="(v, k) in list_tour.slice(0, 8)" :key="v.id || k">
                        <div class="tour-card h-100 rounded-4 overflow-hidden">
                            <div class="tour-img-wrapper">
                                <img :src="v.link_anh" class="tour-img" alt="Ảnh Tour">
                            </div>
                            <div class="tour-body d-flex flex-column p-3">
                                <h6 class="tour-title fw-bold mb-2">
                                    <router-link :to="'/client/chi-tiet-tour/' + v.id" class="text-decoration-none text-dark hover-primary">
                                        {{ v.tieu_de }}
                                    </router-link>
                                </h6>
                                <p class="tour-desc text-clamp-3 mb-3">{{ v.mo_ta }}</p>
                                <div class="mt-auto pt-3 border-top text-center">
                                    <router-link :to="'/client/chi-tiet-tour/' + v.id" class="tour-btn w-100">
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
import slide1 from '../../../layout/imgaes/ld1.png';
import slide2 from '../../../layout/imgaes/ld2.png';
import slide3 from '../../../layout/imgaes/ld3.png';
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
@import url('https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@300;400;500;600;700;800&display=swap');

/* ── BASE ── */
.home-page {
    font-family: 'Be Vietnam Pro', sans-serif;
    background: #f8f7f4;
}
.main-container {
    padding-top: 0;
    padding-bottom: 48px;
}

/* ── CAROUSEL ── */
.banner-img {
    height: 480px;
}
.carousel-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(to top, rgba(10, 25, 18, 0.70) 0%, rgba(10, 25, 18, 0.10) 60%);
}
.carousel-caption-custom {
    position: absolute;
    bottom: 64px;
    left: 56px;
    text-align: left;
}
.caption-tag {
    display: inline-block;
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 2px;
    text-transform: uppercase;
    color: #e8a020;
    background: rgba(232, 160, 32, 0.15);
    border: 1px solid rgba(232, 160, 32, 0.35);
    padding: 5px 14px;
    border-radius: 50px;
    margin-bottom: 12px;
}
.caption-title {
    font-size: 42px;
    font-weight: 700;
    color: #fff;
    line-height: 1.2;
    text-shadow: 0 2px 12px rgba(0,0,0,0.3);
}

/* ── CTA BANNER ── */
.cta-banner {
    background: #fff;
    border: 1px solid #e8e5df;
    position: relative;
    overflow: hidden;
    box-shadow: 0 4px 24px rgba(0,0,0,0.06);
}
.cta-banner::before {
    content: '';
    position: absolute;
    top: -50px; right: -50px;
    width: 200px; height: 200px;
    border-radius: 50%;
    background: #e6f5f0;
    opacity: 0.6;
}
.cta-banner::after {
    content: '';
    position: absolute;
    bottom: -40px; left: -40px;
    width: 160px; height: 160px;
    border-radius: 50%;
    background: #fef3e0;
    opacity: 0.7;
}
.cta-label {
    font-size: 12px;
    font-weight: 700;
    letter-spacing: 2px;
    text-transform: uppercase;
    color: #0d7a5f;
    position: relative;
    z-index: 1;
    margin-bottom: 8px;
}
.cta-banner h4 {
    font-size: 22px;
    color: #1a1f2e;
    position: relative;
    z-index: 1;
}
.cta-btn {
    display: inline-flex;
    align-items: center;
    background: #0d7a5f;
    color: #fff;
    padding: 14px 40px;
    border-radius: 50px;
    font-size: 15px;
    font-weight: 600;
    text-decoration: none;
    transition: background 0.2s, transform 0.15s;
    position: relative;
    z-index: 1;
}
.cta-btn:hover {
    background: #085544;
    color: #fff;
    transform: translateY(-2px);
}

/* ── SECTION HEADERS ── */
.section-tag {
    font-size: 12px;
    font-weight: 700;
    letter-spacing: 2px;
    text-transform: uppercase;
    color: #0d7a5f;
}
.section-title {
    font-size: 28px;
    font-weight: 700;
    color: #1a1f2e;
    margin-bottom: 0;
}

/* ── PROMO CARDS ── */
.promo-card {
    position: relative;
    cursor: pointer;
    transition: transform 0.3s ease;
}
.promo-card:hover {
    transform: translateY(-5px);
}
.promo-card .card-img-top {
    display: block;
    width: 100%;
    transition: transform 0.5s ease;
}
.promo-card:hover .card-img-top {
    transform: scale(1.04);
}
.promo-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(to top, rgba(10,20,15,0.5) 0%, transparent 60%);
    border-radius: inherit;
    display: flex;
    align-items: flex-end;
    padding: 18px;
}
.promo-badge {
    background: #e8a020;
    color: #fff;
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 1px;
    text-transform: uppercase;
    padding: 5px 14px;
    border-radius: 50px;
}

/* ── CATEGORY CARDS ── */
.category-card {
    position: relative;
    height: 250px;
    cursor: pointer;
}
.cat-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
    transition: transform 0.5s ease;
}
.category-card:hover .cat-img {
    transform: scale(1.1);
}
.cat-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(to top, rgba(10,20,15,0.78) 0%, transparent 55%);
    display: flex;
    flex-direction: column;
    justify-content: flex-end;
    padding: 20px;
}
.cat-icon {
    width: 38px;
    height: 38px;
    background: rgba(255,255,255,0.15);
    backdrop-filter: blur(6px);
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    font-size: 16px;
    margin-bottom: 10px;
}
.cat-title {
    color: #fff;
    font-size: 16px;
    font-weight: 700;
    margin-bottom: 0;
    line-height: 1.3;
}

.view-all-link {
    color: #0d7a5f;
    font-size: 14px;
    font-weight: 600;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    transition: gap 0.2s, color 0.2s;
}
.view-all-link:hover {
    color: #085544;
    gap: 10px;
}

/* ── TOUR CARDS ── */
.tour-card {
    background: #fff;
    border: 1px solid #f0ede8;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    display: flex;
    flex-direction: column;
}
.tour-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 16px 40px rgba(0,0,0,0.1) !important;
}
.tour-img-wrapper {
    height: 180px;
    overflow: hidden;
}
.tour-img {
    height: 100%;
    width: 100%;
    object-fit: cover;
    display: block;
    transition: transform 0.5s ease;
}
.tour-card:hover .tour-img {
    transform: scale(1.08);
}
.tour-body {
    padding: 14px;
}
.tour-title {
    font-size: 14px;
    font-weight: 700;
    color: #1a1f2e;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    height: 2.6em;
    line-height: 1.3;
    margin-bottom: 8px;
}
.tour-desc {
    font-size: 13px;
    color: #6b7280;
    line-height: 1.6;
}
.tour-btn {
    display: block;
    text-align: center;
    padding: 10px 16px;
    border-radius: 50px;
    border: 1.5px solid #0d7a5f;
    color: #0d7a5f;
    font-size: 13px;
    font-weight: 600;
    text-decoration: none;
    transition: background 0.2s, color 0.2s;
    background: transparent;
    font-family: 'Be Vietnam Pro', sans-serif;
}
.tour-btn:hover {
    background: #0d7a5f;
    color: #fff;
}

.hover-primary {
    transition: color 0.2s ease;
}
.hover-primary:hover {
    color: #0d7a5f !important;
}

/* ── TEXT CLAMP ── */
.text-clamp-3 {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>