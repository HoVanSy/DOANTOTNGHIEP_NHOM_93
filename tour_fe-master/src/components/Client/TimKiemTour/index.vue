<template>
    <div class="bg-light py-5 min-vh-100">
        <div class="container">
            <!-- Tiêu đề -->
            <div class="row mb-4">
                <div class="col-12">
                    <h2 class="fw-bold text-dark">
                        <i class="fa-solid fa-magnifying-glass me-2"></i>Kết quả tìm kiếm cho: "{{ keyword }}"
                    </h2>
                    <p class="text-secondary">Tìm thấy <strong>{{ total_results }}</strong> tour phù hợp</p>
                </div>
            </div>

            <div class="row g-4">
                <div class="col-lg-3">
                    <div class="card border-0 shadow-sm rounded-4 sticky-top" style="top: 80px;">
                        <div class="card-header bg-white border-bottom pt-3 pb-2">
                            <h5 class="fw-bold text-primary mb-0">
                                <i class="fa-solid fa-filter me-2"></i>Bộ lọc
                            </h5>
                        </div>
                        <div class="card-body p-4">
                            <div class="mb-4">
                                <h6 class="fw-bold text-dark mb-3">
                                    <i class="fa-solid fa-tag me-2"></i>Giá tour
                                </h6>
                                <div class="row g-2">
                                    <div class="col-6">
                                        <label class="form-label text-secondary small">Từ (VNĐ)</label>
                                        <input v-model.number="filter_min_price" type="number" class="form-control form-control-sm" 
                                            :min="price_range.min" :placeholder="formatToVND(price_range.min)">
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label text-secondary small">Đến (VNĐ)</label>
                                        <input v-model.number="filter_max_price" type="number" class="form-control form-control-sm"
                                            :max="price_range.max" :placeholder="formatToVND(price_range.max)">
                                    </div>
                                </div>
                                <div class="mt-2">
                                    <small class="text-secondary">
                                        Khoảng giá: <strong>{{ formatToVND(price_range.min) }}</strong> - <strong>{{ formatToVND(price_range.max) }}</strong>
                                    </small>
                                </div>
                            </div>

                            <div class="d-grid gap-2">
                                <button @click="applyFilter()" class="btn btn-primary rounded-3 fw-medium py-2">
                                    <i class="fa-solid fa-check me-2"></i>Áp dụng bộ lọc
                                </button>
                                <button @click="resetFilter()" class="btn btn-outline-secondary rounded-3 fw-medium py-2">
                                    <i class="fa-solid fa-undo me-2"></i>Đặt lại
                                </button>
                            </div>

                            <div class="mt-4 p-3 bg-light rounded-3">
                                <p class="text-secondary small mb-2">
                                    <i class="fa-solid fa-circle-info me-2"></i><strong>Tổng cộng:</strong> {{ filtered_tours.length }} tour
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Danh sách kết quả -->
                <div class="col-lg-9">
                    <div v-if="filtered_tours.length > 0" class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                        <div v-for="tour in filtered_tours" :key="tour.id" class="col">
                            <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden tour-card">
                                <!-- Hình ảnh -->
                                <div class="position-relative tour-img-wrapper">
                                    <router-link :to="`/client/chi-tiet-tour/${tour.id}`" class="text-decoration-none">
                                        <img :src="tour.link_anh" class="card-img-top tour-img w-100" :alt="tour.tieu_de" 
                                            style="height: 200px; object-fit: cover;">
                                    </router-link>
                                    <span class="badge bg-danger position-absolute top-3 end-3">
                                        <i class="fa-solid fa-fire me-1"></i>Hot
                                    </span>
                                </div>

                                <!-- Nội dung -->
                                <div class="card-body d-flex flex-column p-3">
                                    <h6 class="card-title fw-bold text-dark mb-2 tour-title">
                                        <router-link :to="`/client/chi-tiet-tour/${tour.id}`" class="text-decoration-none text-dark hover-primary">
                                            {{ tour.tieu_de }}
                                        </router-link>
                                    </h6>

                                    <!-- Mô tả tour -->
                                    <p class="text-secondary small mb-2" style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                                        {{ tour.mo_ta }}
                                    </p>

                                    <!-- Thông tin tour -->
                                    <div class="mb-2">
                                        <p class="text-secondary small mb-1">
                                            <i class="fa-solid fa-calendar me-1"></i>
                                            {{ formatDate(tour.ngay_bat_dau) }} - {{ formatDate(tour.ngay_ket_thuc) }}
                                        </p>
                                    </div>

                                    <!-- Giá tour -->
                                    <div class="mb-3 mt-auto">
                                        <p class="text-danger fw-bold mb-1">Từ {{ formatToVND(tour.gia_nguoi_lon) }}/người</p>
                                        <small class="text-secondary">Người lớn</small>
                                    </div>

                                    <div class="row g-2">
                                        <div class="col-6">
                                            <router-link :to="`/client/chi-tiet-tour/${tour.id}`" class="btn btn-primary rounded-pill w-100 fw-medium btn-sm">
                                                <i class="fa-solid fa-arrow-right me-1"></i>Xem chi tiết
                                            </router-link>
                                        </div>
                                        <div class="col-6">
                                            <button @click="addToWishlist(tour.id)" class="btn btn-outline-danger rounded-pill w-100 fw-medium btn-sm">
                                                <i class="fa-solid fa-heart"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div v-else class="card border-0 shadow-sm rounded-4 p-5 text-center">
                        <i class="fa-solid fa-magnifying-glass text-muted mb-3" style="font-size: 3rem;"></i>
                        <h5 class="text-dark fw-bold mb-2">Không tìm thấy tour nào</h5>
                        <p class="text-secondary mb-4">Hãy thử tìm kiếm với từ khóa khác hoặc điều chỉnh bộ lọc giá</p>
                        <router-link to="/" class="btn btn-primary rounded-3 px-4">
                            <i class="fa-solid fa-home me-2"></i>Quay về trang chủ
                        </router-link>
                    </div>
                </div>
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
                const payload = {
                    'tour_id': tourId,
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
.min-vh-100 {
    min-height: 100vh;
}

.tour-card {
    transition: all 0.3s ease;
}

.tour-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15) !important;
}

.tour-img-wrapper {
    overflow: hidden;
    height: 200px;
}

.tour-img {
    transition: transform 0.4s ease;
}

.tour-card:hover .tour-img {
    transform: scale(1.08);
}

.tour-title {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    min-height: 2.5em;
    line-height: 1.25;
}

.hover-primary:hover {
    color: #0d6efd !important;
}

.form-control-sm:focus {
    border-color: #0d6efd;
    box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
}
</style>
