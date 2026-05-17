<template>
    <div class="tour-list-page py-4">
        <div class="container mt-3">
            
            <!-- ── SECTION HEADER ── -->
            <div class="section-header mb-4">
                <span class="section-tag">Khám phá Việt Nam</span>
                <h2 class="section-title">Danh Sách Tour Chờ Bạn</h2>
                <div class="header-line"></div>
            </div>

            <div class="row g-4 mt-1">
                <!-- ── BỘ LỌC BÊN TRÁI ── -->
                <div class="col-lg-3">
                    <div class="filter-card rounded-4 p-4 shadow-sm border-0 sticky-top" style="top: 100px; z-index: 10;">
                        <h5 class="info-label mb-4">
                            <i class="fa-solid fa-filter me-2"></i>Bộ Lọc Tìm Kiếm
                        </h5>

                        <div class="filter-group mb-3">
                            <label class="form-label-custom">Loại hình tour</label>
                            <select v-model="thong_tin.loai_dd" @change="searchTour()" class="form-select custom-input">
                                <option value="">Tất cả loại hình</option>
                                <option value="1">Khách sạn nghỉ dưỡng</option>
                                <option value="2">Nhà Hàng - Ẩm thực</option>
                                <option value="3">Địa điểm tham quan</option>
                            </select>
                        </div>

                        <div class="filter-group mb-3">
                            <label class="form-label-custom">Điểm đến</label>
                            <select v-model="thong_tin.tinh_thanh" @change="searchTour()" class="form-select custom-input">
                                <option value="">Tất cả tỉnh thành</option>
                                <option v-for="(value, index) in danh_sach_tinh_thanh" :key="index" :value="value.ten_tinh_thanh">
                                    {{ value.ten_tinh_thanh }}
                                </option>
                            </select>
                        </div>

                        <button @click="resetFilter()" class="btn-reset w-100">
                            <i class="fa-solid fa-rotate-left me-2"></i>Thiết lập lại
                        </button>
                    </div>
                </div>

                <!-- ── DANH SÁCH TOUR ── -->
                <div class="col-lg-9">
                    <div class="results-bar d-flex justify-content-between align-items-center mb-4 p-3 rounded-3">
                        <span class="text-dark fw-medium">
                            Tìm thấy <b class="text-primary-dark fs-5">{{ list_danh_sach_tour.length }}</b> kết quả phù hợp
                        </span>
                        <div v-if="thong_tin.keyword" class="search-keyword badge bg-light text-dark p-2 border">
                            Từ khóa: "{{ thong_tin.keyword }}"
                        </div>
                    </div>

                    <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3 g-3">
                        <div class="col" v-for="(v, k) in list_danh_sach_tour" :key="v.id || k">
                            <div class="tour-card h-100 rounded-3 overflow-hidden border-0 shadow-sm bg-white">
                                
                                <div class="position-relative tour-img-wrapper">
                                    <router-link :to="'/client/chi-tiet-tour/' + (v.id || v.id_tour)">
                                        <img :src="v.link_anh || 'https://via.placeholder.com/300x200'" class="tour-img" alt="Ảnh Tour">
                                        <div class="badge-overlay position-absolute top-0 start-0 m-2">
                                            <span v-if="v.loai_dia_diem == 1" class="badge-type b-hotel"><i class="fa-solid fa-hotel"></i></span>
                                            <span v-else-if="v.loai_dia_diem == 2" class="badge-type b-food"><i class="fa-solid fa-utensils"></i></span>
                                            <span v-else class="badge-type b-view"><i class="fa-solid fa-camera"></i></span>
                                        </div>
                                    </router-link>
                                </div>

                                <div class="card-body d-flex flex-column p-3">
                                    <div class="mb-1">
                                        <span class="text-muted font-12"><i class="fa-solid fa-location-dot me-1 text-primary-dark"></i> {{ v.ten_tinh_thanh }}</span>
                                    </div>
                                    
                                    <h6 class="tour-title fw-bold mb-2">
                                        <router-link :to="'/client/chi-tiet-tour/' + (v.id || v.id_tour)" class="text-decoration-none text-dark hover-primary">
                                            {{ v.ten_dia_diem || v.tieu_de }}
                                        </router-link>
                                    </h6>
                                    
                                    <p class="tour-desc text-muted mb-3">
                                        {{ v.mo_ta || 'Trải nghiệm hành trình du lịch đẳng cấp cùng chúng tôi...' }}
                                    </p>

                                    <div class="mt-auto pt-2 border-top d-flex gap-2">
                                        <router-link :to="'/client/chi-tiet-tour/' + (v.id || v.id_tour)" class="btn-detail flex-grow-1">
                                            Chi tiết
                                        </router-link>
                                        <router-link :to="'/client/chi-tiet-tour/' + (v.id || v.id_tour)" class="btn-book-sm">
                                            Đặt Ngay
                                        </router-link>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- ── EMPTY STATE ── -->
                    <div v-if="list_danh_sach_tour.length === 0" class="empty-state text-center py-5 rounded-4 bg-white shadow-sm mt-2">
                        <div class="icon-box mb-3">
                            <i class="fa-solid fa-magnifying-glass-location fa-3x text-muted opacity-25"></i>
                        </div>
                        <h5 class="text-secondary fw-bold">Không tìm thấy tour phù hợp</h5>
                        <p class="text-muted small">Hãy thử thay đổi bộ lọc hoặc từ khóa tìm kiếm khác nhé!</p>
                        <button @click="resetFilter()" class="btn-primary-custom mt-2">Xóa toàn bộ lọc</button>
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
            list_danh_sach_tour: [],
            danh_sach_tinh_thanh: [],
            thong_tin: {
                loai_dd: '',
                tinh_thanh: '',
                min_price: '',
                max_price: '',
                ngay_khoi_hanh: '',
                so_ngay: '',
                so_nguoi: '',
                keyword: ''
            },
        }
    },
    mounted() {
        if (this.$route.query.keyword) {
            this.thong_tin.keyword = this.$route.query.keyword;
        }
        this.loadDataTinhThanh();
        this.searchTour();
    },
    watch: {
        '$route.query.keyword': function (newKeyword) {
            this.thong_tin.keyword = newKeyword || '';
            this.searchTour();
        }
    },
    methods: {
        searchTour() {
            baseRequest
                .post('client/tim-kiem-tour/lay-du-lieu-tim-kiem', this.thong_tin)
                .then((res) => {
                    if (res.data.status || res.data.tim_kiem) {
                        this.list_danh_sach_tour = res.data.tim_kiem || res.data.dia_diem_client; 
                    } else {
                        this.list_danh_sach_tour = [];
                    }
                })
                .catch((err) => {
                    console.error("Lỗi lấy dữ liệu:", err);
                    this.list_danh_sach_tour = [];
                });
        },
        loadDataTinhThanh() {
            baseRequest
                .get('client/lay-du-lieu-tinh-thanh')
                .then((res) => {
                    this.danh_sach_tinh_thanh = res.data.tinh_thanh;
                });
        },
        resetFilter() {
            this.thong_tin = {
                loai_dd: '',
                tinh_thanh: '',
                min_price: '',
                max_price: '',
                ngay_khoi_hanh: '',
                so_ngay: '',
                so_nguoi: '',
                keyword: ''
            };
            this.$router.push({ path: this.$route.path }); 
            this.searchTour();
        },
        formatToVND(number) {
            number = parseInt(number) || 0;
            return number.toLocaleString('vi-VN', { style: 'currency', currency: 'VND' });
        },
    },
}
</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@300;400;500;600;700;800&display=swap');

.tour-list-page {
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
    font-size: 13px;
    font-weight: 700;
    color: #1a1f2e;
    margin-bottom: 6px;
    display: block;
}
.custom-input {
    border-radius: 10px;
    border: 1px solid #e5e7eb;
    padding: 8px;
    font-size: 13px;
    background-color: #f9fafb;
}

/* ── RESULTS BAR ── */
.results-bar {
    background: #fff;
    border: 1px solid #f0ede8;
}
.text-primary-dark { color: #0d7a5f; }

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

.badge-type {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    font-size: 12px;
    box-shadow: 0 4px 8px rgba(0,0,0,0.2);
}
.b-hotel { background: #0dcaf0; }
.b-food { background: #ffc107; }
.b-view { background: #198754; }

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
    transition: 0.3s;
    padding: 6px;
}
.btn-detail:hover { background: #0d7a5f; color: #fff; }

.btn-book-sm {
    background: #0d7a5f;
    color: #fff;
    border: none;
    padding: 6px 15px;
    border-radius: 50px;
    font-weight: 700;
    font-size: 12px;
    text-decoration: none;
    display: flex;
    align-items: center;
}

.btn-reset {
    background: transparent;
    color: #6b7280;
    border: 1.5px solid #e5e7eb;
    border-radius: 50px;
    font-weight: 600;
    font-size: 13px;
    padding: 8px;
    transition: 0.2s;
}
.btn-reset:hover { border-color: #0d7a5f; color: #0d7a5f; }

.btn-primary-custom {
    background: #0d7a5f;
    color: #fff;
    border: none;
    padding: 10px 24px;
    border-radius: 50px;
    font-weight: 600;
    font-size: 14px;
}

.hover-primary:hover { color: #0d7a5f !important; }
.font-12 { font-size: 12px; }

/* ── EMPTY STATE ── */
.empty-state {
    background: #fff;
    border: 1px dashed #e5e7eb;
}
</style>