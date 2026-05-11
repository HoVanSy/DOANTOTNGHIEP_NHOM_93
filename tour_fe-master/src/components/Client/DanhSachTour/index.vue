<template>
    <div class="bg-light py-4 min-vh-100">
        <div class="container">
            
            <div class="row mb-3">
                <div class="col-12">
                    <h3 class="fw-bold text-dark text-uppercase mb-0">DANH SÁCH TOUR</h3>
                    <nav aria-label="breadcrumb">
                    </nav>
                </div>
            </div>

            <div class="row g-4 mt-1">
                <div class="col-lg-3">
                    <div class="card border-0 shadow-sm rounded-4 sticky-top z-1" style="top: 80px;">
                        <div class="card-header bg-white border-bottom pt-4 pb-3">
                            <h5 class="fw-bold text-dark mb-0"><i class="fa-solid fa-filter me-2 text-primary"></i>Bộ Lọc Nâng Cao</h5>
                        </div>
                        <div class="card-body p-4">
                            <div class="mb-4">
                                <label class="fw-semibold text-secondary mb-2 font-14"><i class="fa-solid fa-list-check me-2"></i>Loại hình tour</label>
                                <select v-model="thong_tin.loai_dd" @change="searchTour()" class="form-select border-0 bg-light rounded-3">
                                    <option value="">Tất cả loại hình</option>
                                    <option value="1">Khách sạn nghỉ dưỡng</option>
                                    <option value="2">Nhà Hàng - Ẩm thực</option>
                                    <option value="3">Địa điểm tham quan</option>
                                </select>
                            </div>

                            <div class="mb-4">
                                <label class="fw-semibold text-secondary mb-2 font-14"><i class="fa-solid fa-location-dot me-2"></i>Điểm đến</label>
                                <select v-model="thong_tin.tinh_thanh" @change="searchTour()" class="form-select border-0 bg-light rounded-3">
                                    <option value="">Tất cả tỉnh thành</option>
                                    <option v-for="(value, index) in danh_sach_tinh_thanh" :key="index" :value="value.ten_tinh_thanh">
                                        {{ value.ten_tinh_thanh }}
                                    </option>
                                </select>
                            </div>

                            <div class="mb-4">
                                <label class="fw-semibold text-secondary mb-2 font-14"><i class="fa-regular fa-calendar-days me-2"></i>Ngày đi dự kiến</label>
                                <input v-model="thong_tin.ngay_khoi_hanh" @change="searchTour()" type="date" class="form-control border-0 bg-light rounded-3 text-secondary">
                            </div>


                            <button @click="resetFilter()" class="btn btn-outline-secondary w-100 rounded-pill fw-medium py-2">Xóa bộ lọc</button>
                        </div>
                    </div>
                </div>

                <div class="col-lg-9">
                    
                    <div class="d-flex justify-content-between align-items-center mb-4 bg-white p-3 rounded-4 shadow-sm">
                        <span class="text-dark fw-medium">Chúng tôi tìm thấy <b class="text-primary fs-5">{{ list_danh_sach_tour.length }}</b> kết quả phù hợp.</span>
                    </div>

                    <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3 g-4">
                        <div class="col" v-for="(v, k) in list_danh_sach_tour" :key="v.id || k">
                            <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden tour-card">
                                
                                <div class="position-relative tour-img-wrapper">
                                    <router-link :to="'/client/chi-tiet-tour/' + (v.id || v.id_tour)">
                                        <img :src="v.link_anh || 'https://via.placeholder.com/300x200'" class="card-img-top tour-img" alt="Ảnh Tour">
                                        <div class="position-absolute top-0 start-0 m-2">
                                            <span v-if="v.loai_dia_diem == 1" class="badge bg-info text-dark rounded-pill px-3 py-2 shadow-sm"><i class="fa-solid fa-hotel me-1"></i> Khách sạn</span>
                                            <span v-else-if="v.loai_dia_diem == 2" class="badge bg-warning text-dark rounded-pill px-3 py-2 shadow-sm"><i class="fa-solid fa-utensils me-1"></i> Nhà hàng</span>
                                            <span v-else-if="v.loai_dia_diem == 3" class="badge bg-success rounded-pill px-3 py-2 shadow-sm"><i class="fa-solid fa-camera me-1"></i> Tham quan</span>
                                        </div>
                                    </router-link>
                                </div>

                                <div class="card-body d-flex flex-column p-3">
                                    <div class="mb-2">
                                        <span class="text-secondary font-13"><i class="fa-solid fa-location-dot me-1 text-primary"></i> {{ v.ten_tinh_thanh }}</span>
                                    </div>
                                    
                                    <h6 class="card-title fw-bold text-dark mb-2 tour-title">
                                        <router-link :to="'/client/chi-tiet-tour/' + (v.id || v.id_tour)" class="text-decoration-none text-dark hover-primary">
                                            {{ v.ten_dia_diem || v.tieu_de }}
                                        </router-link>
                                    </h6>
                                    
                                    <p class="card-text text-secondary font-13 text-clamp-2 mb-3">
                                        {{ v.mo_ta || 'Khám phá những trải nghiệm tuyệt vời cùng với hành trình đặc biệt này...' }}
                                    </p>

                                    
                                    
                                    <div class="mt-auto pt-3 border-top d-flex gap-2">
                                        <router-link :to="'/client/chi-tiet-tour/' + (v.id || v.id_tour)" class="btn btn-outline-primary rounded-pill flex-grow-1 fw-medium font-14">
                                            Xem Chi Tiết
                                        </router-link>
                                        
                                        <router-link :to="'/client/chi-tiet-tour/' + (v.id || v.id_tour)" class="btn btn-primary rounded-pill px-4 fw-medium font-14">
                                            Đặt Ngay
                                        </router-link>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div v-if="list_danh_sach_tour.length === 0" class="text-center bg-white p-5 rounded-4 shadow-sm mt-4">
                        <img src="https://cdn-icons-png.flaticon.com/512/7486/7486754.png" alt="No data" style="width: 150px; opacity: 0.5;" class="mb-3">
                        <h5 class="text-secondary">Rất tiếc, không tìm thấy tour nào phù hợp với yêu cầu của bạn.</h5>
                        <p class="text-muted">Vui lòng thử điều chỉnh lại bộ lọc hoặc từ khóa tìm kiếm.</p>
                        <button @click="resetFilter()" class="btn btn-outline-primary rounded-pill mt-3 px-4">Xóa toàn bộ lọc</button>
                    </div>

                </div>
            </div>
        </div>
    </div>
</template>

<script>
import baseRequest from "../../../core/baseRequestClient"; // Nhớ trỏ về baseRequestClient nhé
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
        // Bắt lấy keyword từ URL (nếu user gõ từ thanh tìm kiếm ở Navbar)
        if (this.$route.query.keyword) {
            this.thong_tin.keyword = this.$route.query.keyword;
        }

        this.loadDataTinhThanh();
        
        // Gọi hàm search ngay lần đầu tiên để lấy dữ liệu (có hoặc không có keyword)
        this.searchTour();
    },
    // Chạy lại searchTour nếu URL thay đổi (VD: User lại gõ tìm kiếm tiếp trên Navbar)
    watch: {
        '$route.query.keyword': function (newKeyword) {
            this.thong_tin.keyword = newKeyword || '';
            this.searchTour();
        }
    },
    methods: {
        searchTour() {
            // Thay đổi đường dẫn API nếu backend của bạn khác nhé
            baseRequest
                .post('client/tim-kiem-tour/lay-du-lieu-tim-kiem', this.thong_tin)
                .then((res) => {
                    // Cập nhật lại list theo dữ liệu API trả về
                    if (res.data.status || res.data.tim_kiem) {
                        this.list_danh_sach_tour = res.data.tim_kiem || res.data.dia_diem_client; 
                    } else {
                        // Nếu không tìm thấy hoặc API trả lỗi
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
            this.$router.push({ name: 'TimKiemTour' }); // Xóa keyword trên URL
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
/* Tiện ích tùy chỉnh kích thước chữ */
.font-12 { font-size: 12px; }
.font-13 { font-size: 13px; }
.font-14 { font-size: 14px; }

/* Tùy chỉnh input form select */
.form-select:focus, .form-control:focus {
    box-shadow: none;
    border: 1px solid #0d6efd !important;
}

/* Hiệu ứng di chuột đổi màu xanh cho tiêu đề tour */
.hover-primary {
    transition: color 0.3s ease;
}
.hover-primary:hover {
    color: #0d6efd !important;
}

/* Hiệu ứng nẩy lên và đổ bóng cho cả khung Card Tour */
.tour-card {
    transition: all 0.3s ease;
}
.tour-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
}

/* Cố định khung ảnh và hiệu ứng Zoom ảnh bên trong */
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

/* Ép tiêu đề tour luôn hiển thị 2 dòng (giữ form bằng nhau), dài quá tự hiện dấu 3 chấm */
.tour-title {
    display: -webkit-box;
    line-clamp: 2;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    height: 2.5em; 
}
.text-clamp-3 {
    display: -webkit-box;
    line-clamp: 3;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>