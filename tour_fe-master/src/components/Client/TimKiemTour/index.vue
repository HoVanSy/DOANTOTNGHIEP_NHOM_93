<template>
    <div class="search-page py-4">
        <div class="container mt-3">
            <!-- ── SECTION HEADER ── -->
            <div class="section-header mb-4">
                <span class="section-tag">Kết quả tìm kiếm</span>
                <h2 class="section-title">
                    <i class="fa-solid fa-magnifying-glass me-2"></i>Hành trình cho: "{{ keyword }}"
                </h2>
                <p class="text-muted small">Tìm thấy <strong>{{ total_results }}</strong> tour phù hợp với yêu cầu của bạn</p>
                <div class="header-line"></div>
            </div>

            <div class="row g-4 mt-1">
                <!-- ── BỘ LỌC BÊN TRÁI ── -->
                <div class="col-lg-3">
                    <div class="filter-card rounded-4 p-4 shadow-sm border-0 sticky-top" style="top: 100px; z-index: 10;">
                        <h5 class="info-label mb-4">
                            <i class="fa-solid fa-filter me-2"></i>Lọc Theo Giá
                        </h5>

                        <div class="filter-group mb-4">
                            <div class="row g-2">
                                <div class="col-6">
                                    <label class="form-label-custom">Từ (VNĐ)</label>
                                    <input v-model.number="filter_min_price" type="number" class="form-control custom-input" 
                                        :min="price_range.min" :placeholder="price_range.min">
                                </div>
                                <div class="col-6">
                                    <label class="form-label-custom">Đến (VNĐ)</label>
                                    <input v-model.number="filter_max_price" type="number" class="form-control custom-input"
                                        :max="price_range.max" :placeholder="price_range.max">
                                </div>
                            </div>
                            <div class="mt-3 p-2 rounded-3 bg-light border">
                                <small class="text-muted d-block font-11">Khoảng giá hệ thống:</small>
                                <small class="text-dark fw-bold font-12">
                                    {{ formatToVND(price_range.min) }} - {{ formatToVND(price_range.max) }}
                                </small>
                            </div>
                        </div>

                        <div class="d-grid gap-2">
                            <button @click="applyFilter()" class="btn-book-now py-2">
                                <i class="fa-solid fa-check me-2"></i>Áp dụng
                            </button>
                            <button @click="resetFilter()" class="btn-reset py-2">
                                <i class="fa-solid fa-undo me-2"></i>Đặt lại
                            </button>
                        </div>

                        <div class="mt-4 pt-3 border-top">
                            <p class="text-muted font-12 mb-0">
                                <i class="fa-solid fa-circle-info me-2 text-primary-dark"></i>
                                Hiển thị <strong>{{ filtered_tours.length }}</strong> kết quả
                            </p>
                        </div>
                    </div>
                </div>

                <!-- ── DANH SÁCH KẾT QUẢ ── -->
                <div class="col-lg-9">
                    <div v-if="filtered_tours.length > 0" class="row row-cols-1 row-cols-md-2 row-cols-xl-3 g-3">
                        <div v-for="tour in filtered_tours" :key="tour.id" class="col">
                            <div class="tour-card h-100 rounded-3 overflow-hidden border-0 shadow-sm bg-white">
                                <!-- Hình ảnh -->
                                <div class="position-relative tour-img-wrapper">
                                    <router-link :to="`/client/chi-tiet-tour/${tour.id}`">
                                        <img :src="tour.link_anh" class="tour-img" :alt="tour.tieu_de">
                                        <div class="badge-overlay position-absolute top-0 end-0 m-2">
                                            <span class="badge-hot"><i class="fa-solid fa-fire me-1"></i>Hot</span>
                                        </div>
                                    </router-link>
                                </div>

                                <!-- Nội dung -->
                                <div class="card-body d-flex flex-column p-3">
                                    <h6 class="tour-title fw-bold mb-2">
                                        <router-link :to="`/client/chi-tiet-tour/${tour.id}`" class="text-decoration-none text-dark hover-primary">
                                            {{ tour.tieu_de }}
                                        </router-link>
                                    </h6>

                                    <p class="tour-desc text-muted mb-3">
                                        {{ tour.mo_ta }}
                                    </p>

                                    <div class="tour-info-meta mb-3">
                                        <div class="font-12 text-muted mb-1">
                                            <i class="fa-solid fa-calendar-alt me-1 text-primary-dark"></i>
                                            {{ formatDate(tour.ngay_bat_dau) }} - {{ formatDate(tour.ngay_ket_thuc) }}
                                        </div>
                                    </div>

                                    <!-- Giá tour -->
                                    <div class="price-section mt-auto mb-3">
                                        <span class="font-11 text-muted d-block">Giá từ</span>
                                        <span class="price-value text-danger fw-bold">
                                            {{ formatToVND(tour.gia_nguoi_lon) }}
                                        </span>
                                        <small class="text-muted">/người</small>
                                    </div>

                                    <div class="d-flex gap-2">
                                        <router-link :to="`/client/chi-tiet-tour/${tour.id}`" class="btn-detail flex-grow-1">
                                            Chi tiết
                                        </router-link>
                                        <button @click="addToWishlist(tour.id)" class="btn-wish-sm">
                                            <i class="fa-solid fa-heart"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- ── EMPTY STATE ── -->
                    <div v-else class="empty-state text-center py-5 rounded-4 bg-white shadow-sm">
                        <div class="icon-box mb-3">
                            <i class="fa-solid fa-magnifying-glass fa-3x text-muted opacity-25"></i>
                        </div>
                        <h5 class="text-secondary fw-bold">Không tìm thấy kết quả</h5>
                        <p class="text-muted small">Hãy thử tìm kiếm với từ khóa khác hoặc điều chỉnh lại bộ lọc giá.</p>
                        <router-link to="/" class="btn-primary-custom mt-2">
                            <i class="fa-solid fa-home me-2"></i>Về trang chủ
                        </router-link>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
/* ... Logic Script Giữ Nguyên ... */
import axios from "axios";
import baseRequest from "../../../core/baseRequestClient";
import { createToaster } from "@meforma/vue-toaster";
const toaster = createToaster({ position: "top-right" });

export default {
    data() {
        return {
            keyword: '',
            search_results: [],
            filtered_tours: [],
            filter_min_price: 0,
            filter_max_price: null,
            price_range: {
                min: 0,
                max: 0
            },
            is_login: false
        }
    },
    computed: {
        total_results() {
            return this.search_results.length;
        }
    },
    mounted() {
        this.keyword = this.$route.query.keyword || '';
        this.getPriceRange();
        if (this.keyword) {
            this.searchTours();
        }
        this.checkLogin();
    },
    methods: {
        searchTours() {
            if (!this.keyword.trim()) return;
            const payload = {
                keyword: this.keyword,
                min_price: 0,
                max_price: 999999999
            };
            baseRequest
                .post('client/tour/tim-kiem', payload)
                .then((res) => {
                    if (res.data.status) {
                        this.search_results = res.data.tours || [];
                        this.filtered_tours = this.search_results;
                        this.filter_min_price = this.price_range.min;
                        this.filter_max_price = this.price_range.max;
                    } else {
                        toaster.error('Tìm kiếm thất bại: ' + res.data.message);
                    }
                })
                .catch((err) => {
                    console.error('Error:', err);
                    toaster.error('Lỗi khi tìm kiếm tour');
                });
        },
        getPriceRange() {
            baseRequest
                .get('client/tour/gia-tour-range')
                .then((res) => {
                    if (res.data.status) {
                        this.price_range.min = res.data.min_price || 0;
                        this.price_range.max = res.data.max_price || 0;
                        this.filter_min_price = this.price_range.min;
                        this.filter_max_price = this.price_range.max;
                    }
                })
                .catch((err) => {
                    console.error('Error getting price range:', err);
                });
        },
        applyFilter() {
            this.filtered_tours = this.search_results.filter(tour => {
                const price = tour.gia_nguoi_lon;
                const minOk = this.filter_min_price === 0 || price >= this.filter_min_price;
                const maxOk = this.filter_max_price === null || price <= this.filter_max_price;
                return minOk && maxOk;
            });
            if (this.filtered_tours.length === 0) {
                toaster.info('Không tìm thấy tour trong khoảng giá này');
            } else {
                toaster.success(`Tìm thấy ${this.filtered_tours.length} tour`);
            }
        },
        resetFilter() {
            this.filter_min_price = this.price_range.min;
            this.filter_max_price = this.price_range.max;
            this.filtered_tours = this.search_results;
            toaster.success('Đã đặt lại bộ lọc');
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
                    this.is_login = res.data.status;
                })
                .catch(() => {
                    this.is_login = false;
                });
        },
        addToWishlist(tourId) {
            if (this.is_login) {
                const payload = { 'tour_id': tourId };
                axios
                    .post("http://127.0.0.1:8000/api/client/wishlist/them", payload, {
                        headers: {
                            Authorization: 'Bearer ' + localStorage.getItem("token_client")
                        }
                    })
                    .then((res) => {
                        if (res.data.status) {
                            toaster.success(res.data.message);
                        } else {
                            toaster.error(res.data.message);
                        }
                    })
                    .catch(() => {
                        toaster.error('Lỗi khi thêm vào danh sách yêu thích');
                    });
            } else {
                toaster.error("Bạn cần đăng nhập trước!");
                this.$router.push('/client/dang-nhap');
            }
        }
    }
}
</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@300;400;500;600;700;800&display=swap');

.search-page {
    font-family: 'Be Vietnam Pro', sans-serif;
    background: #f8f7f4;
    min-height: 100vh;
}

/* ── HEADER ── */
.section-tag {
    font-size: 10px;
    font-weight: 700;
    letter-spacing: 1.8px;
    text-transform: uppercase;
    color: #0d7a5f;
    background: rgba(13, 122, 95, 0.1);
    padding: 4px 12px;
    border-radius: 50px;
}
.section-title {
    font-size: 26px;
    font-weight: 800;
    color: #1a1f2e;
    margin-top: 8px;
}
.header-line {
    width: 50px;
    height: 3px;
    background: #0d7a5f;
    border-radius: 50px;
    margin-top: 12px;
}

/* ── FILTER ── */
.filter-card {
    background: #fff;
    border: 1px solid #f0ede8;
}
.info-label {
    font-size: 17px;
    font-weight: 700;
    color: #0d7a5f;
}
.form-label-custom {
    font-size: 11px;
    font-weight: 700;
    color: #1a1f2e;
    margin-bottom: 6px;
    display: block;
}
.custom-input {
    border-radius: 8px;
    border: 1px solid #e5e7eb;
    padding: 8px;
    font-size: 13px;
    background-color: #f9fafb;
}

/* ── TOUR CARDS ── */
.tour-card {
    transition: all 0.3s ease;
    border: 1px solid #f0ede8 !important;
}
.tour-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.08) !important;
}
.tour-img-wrapper {
    height: 165px;
    overflow: hidden;
}
.tour-img {
    height: 100%;
    width: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
}
.tour-card:hover .tour-img {
    transform: scale(1.08);
}

.badge-hot {
    background: #dc3545;
    color: #fff;
    font-size: 10px;
    font-weight: 700;
    padding: 4px 10px;
    border-radius: 50px;
    box-shadow: 0 4px 8px rgba(0,0,0,0.15);
}

.tour-title {
    font-size: 15px;
    line-height: 1.4;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    height: 2.8em;
}
.tour-desc {
    font-size: 13px;
    line-height: 1.5;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

/* ── BUTTONS ── */
.btn-detail {
    display: flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
    border: 1.5px solid #0d7a5f;
    color: #0d7a5f;
    border-radius: 50px;
    font-size: 12px;
    font-weight: 700;
    padding: 6px;
}
.btn-detail:hover { background: #0d7a5f; color: #fff; }

.btn-wish-sm {
    background: #fff;
    color: #dc3545;
    border: 1.5px solid #ffeded;
    border-radius: 50px;
    width: 34px;
    height: 34px;
}
.btn-wish-sm:hover { background: #dc3545; color: #fff; }

.btn-book-now {
    background: #0d7a5f;
    color: #fff;
    border: none;
    border-radius: 50px;
    font-weight: 700;
    font-size: 13px;
}

.btn-reset {
    background: transparent;
    color: #6b7280;
    border: 1.5px solid #e5e7eb;
    border-radius: 50px;
    font-weight: 600;
    font-size: 13px;
}

.btn-primary-custom {
    display: inline-block;
    background: #0d7a5f;
    color: #fff;
    padding: 10px 24px;
    border-radius: 50px;
    font-weight: 600;
    text-decoration: none;
}

.hover-primary:hover { color: #0d7a5f !important; }
.text-primary-dark { color: #0d7a5f; }
.font-11 { font-size: 11px; }
.font-12 { font-size: 12px; }

/* ── EMPTY STATE ── */
.empty-state {
    background: #fff;
    border: 1px dashed #e5e7eb;
}
</style>