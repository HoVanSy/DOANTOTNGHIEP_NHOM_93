<template>
    <div class="chi-tiet-page">
        <div class="container py-5" v-if="tour.length > 0">
            
            <!-- ── TIÊU ĐỀ TOUR ── -->
            <div class="row mb-4">
                <div class="col-12">
                    <span class="section-tag">Chi tiết hành trình</span>
                    <h2 class="section-title mt-1">{{ tour[0].tieu_de_tour }}</h2>
                </div>
            </div>

            <!-- ── ALBUM ẢNH ── -->
            <div class="row g-3 mb-5 animate__animated animate__fadeIn">
                <div class="col-lg-8">
                    <div class="img-wrapper main-img-box rounded-4 overflow-hidden">
                        <img :src="tour[0].anh_tour" class="w-100 h-100 object-fit-cover" alt="Main">
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="row g-3 h-100">
                        <div class="col-6 col-lg-12">
                            <div class="img-wrapper sub-img-box rounded-4 overflow-hidden">
                                <img v-if="tour[1]" :src="tour[1].link_anh" class="w-100 h-100 object-fit-cover" alt="Sub 1">
                            </div>
                        </div>
                        <div class="col-6 col-lg-12">
                            <div class="img-wrapper sub-img-box rounded-4 overflow-hidden">
                                <img v-if="tour[2]" :src="tour[2].link_anh" class="w-100 h-100 object-fit-cover" alt="Sub 2">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-4">
                <div class="col-lg-8">
                    <div class="info-card rounded-4 p-4 mb-4">
                        <div class="row align-items-center mb-4">
                            <div class="col-md-6 border-end-custom">
                                <h5 class="info-label mb-3"><i class="fa-regular fa-calendar-check me-2"></i>Lịch Trình Chuyến Đi</h5>
                                <div class="d-flex flex-column gap-2">
                                    <p class="mb-0 text-muted">Khởi hành: <b class="text-dark ms-2">{{ formatDate(tour[0].ngay_bat_dau) }}</b></p>
                                    <p class="mb-0 text-muted">Kết thúc: <b class="text-dark ms-2">{{ formatDate(tour[0].ngay_ket_thuc) }}</b></p>
                                    <p class="mb-0 text-muted">Điểm đi: <b class="text-dark ms-2">{{ tour[0].ten_tinh_thanh }}</b></p>
                                </div>
                            </div>
                            <div class="col-md-6 ps-md-4 mt-3 mt-md-0">
                                <div class="row g-3">
                                    <div class="col-6">
                                        <small class="text-muted d-block">Di chuyển</small>
                                        <b class="text-dark font-15">Máy bay</b>
                                    </div>
                                    <div class="col-6">
                                        <small class="text-muted d-block">Ẩm thực</small>
                                        <b class="text-dark font-15">Buffet, Đặc sản</b>
                                    </div>
                                    <div class="col-6">
                                        <small class="text-muted d-block">Lưu trú</small>
                                        <b class="text-dark font-15">Khách sạn 4 sao</b>
                                    </div>
                                    <div class="col-6">
                                        <small class="text-muted d-block">Đối tượng</small>
                                        <b class="text-dark font-15">Gia đình, Cặp đôi</b>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="highlight-box rounded-3 p-3">
                            <i class="fas fa-map-marked-alt text-primary-dark me-2"></i>
                            <span class="text-muted">Điểm tham quan:</span> 
                            <b class="ms-1 text-dark">{{ tour[0].ten_dia_diem }}<span v-if="tour[1]">, {{ tour[1].ten_dia_diem }}</span><span v-if="tour[2]">, {{ tour[2].ten_dia_diem }}</span></b>
                        </div>
                    </div>
                    <!-- ── MAP LỊCH TRÌNH TOUR ── -->
                    <div class="info-card rounded-4 p-4 mb-4" v-if="lich_trinh.length > 0">
                        <h5 class="info-label mb-3">
                            <i class="fas fa-map-marked-alt me-2"></i>Bản Đồ Lịch Trình
                        </h5>
                        <div id="map-container-client" class="map-container rounded-3 overflow-hidden mb-3"></div>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="text-muted font-13">
                                <i class="fas fa-route me-1"></i>{{ lich_trinh.length }} điểm dừng
                            </span>
                        </div>
                    </div>

                    <!-- ── LỊCH TRÌNH CHI TIẾT TỪNG NGÀY ── -->
                    <div class="info-card rounded-4 p-4 mb-4" v-if="lich_trinh.length > 0">
                        <h5 class="info-label mb-4">
                            <i class="fas fa-list-alt me-2"></i>Lịch Trình Chi Tiết
                        </h5>
                        <div class="timeline-container">
                            <div v-for="(item, index) in lich_trinh" :key="index" class="timeline-item">
                                <div class="timeline-marker" :style="{ backgroundColor: getMarkerColor(index) }">
                                    {{ index + 1 }}
                                </div>
                                <div class="timeline-content">
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <div>
                                            <h6 class="mb-1 fw-bold text-dark">{{ item.tieu_de }}</h6>
                                            <span class="badge-day">Ngày {{ item.so_ngay }}</span>
                                        </div>
                                        <div class="text-end">
                                            <small class="text-muted d-block">
                                                <i class="fas fa-clock me-1"></i>{{ item.gio_khoi_hanh || '07:00' }} - {{ item.gio_ket_thuc || '18:00' }}
                                            </small>
                                        </div>
                                    </div>
                                    <p class="text-muted mb-2 font-14" v-if="item.mo_ta">{{ item.mo_ta }}</p>
                                    <div class="d-flex flex-wrap gap-2 align-items-center">
                                        <span class="info-tag">
                                            <i class="fas fa-map-marker-alt me-1"></i>{{ item.dia_diem_di }}
                                        </span>
                                        <i class="fas fa-arrow-right text-muted"></i>
                                        <span class="info-tag">
                                            <i class="fas fa-flag-checkered me-1"></i>{{ item.dia_diem_den }}
                                        </span>
                                        <span class="info-tag" v-if="item.phuong_tien">
                                            <i class="fas fa-vehicle me-1"></i>{{ item.phuong_tien }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Chuyến bay -->
                    <div class="info-card rounded-4 p-4 mb-4">
                        <h5 class="info-label mb-4">Thông Tin Chuyến Bay</h5>
                        <div class="row g-4">
                            <div class="col-md-6 border-end-custom">
                                <div class="flight-badge-go mb-3">Chiều đi - {{ formatDate(tour[0].ngay_bat_dau) }}</div>
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <span class="fs-4 fw-bold text-dark">08:20</span>
                                    <div class="flight-line flex-grow-1 mx-3">
                                        <i class="fas fa-plane"></i>
                                    </div>
                                    <span class="fs-4 fw-bold text-dark">09:20</span>
                                </div>
                                <div class="text-muted font-14">
                                    <span>VN8077 • Tập trung: 07:00 AM</span>
                                </div>
                            </div>
                            <div class="col-md-6 ps-md-4">
                                <div class="flight-badge-back mb-3">Chiều về - {{ formatDate(tour[0].ngay_ket_thuc) }}</div>
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <span class="fs-4 fw-bold text-dark">11:25</span>
                                    <div class="flight-line flex-grow-1 mx-3">
                                        <i class="fas fa-plane text-success"></i>
                                    </div>
                                    <span class="fs-4 fw-bold text-dark">12:35</span>
                                </div>
                                <div class="text-muted font-14">
                                    <span>VN8066 • Bay thẳng</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Mô tả -->
                    <div class="info-card rounded-4 p-4">
                        <h5 class="info-label mb-3">Giới Thiệu Hành Trình</h5>
                        <p class="text-description mb-0">{{ tour[0].mo_ta }}</p>
                    </div>
                </div>

                <!-- ── CỘT PHẢI: FORM ĐẶT TOUR (Sticky) ── -->
                <div class="col-lg-4">
                    <div class="booking-card rounded-4 shadow-lg sticky-top" style="top: 70px; z-index: 10;">
                        <div class="booking-header text-center p-2">
                            <h6 class="fw-bold text-dark mb-0">ĐẶT CHUYẾN ĐI</h6>
                            <small class="text-dark-50 font-11">Mã tour: #{{ tour[0].id_tour }}</small>
                        </div>
                        
                        <div class="p-3">
                            <div class="price-summary d-flex justify-content-between mb-3 bg-light rounded-3 p-2">
                                <div class="text-center flex-grow-1">
                                    <small class="text-muted d-block font-11">Người lớn</small>
                                    <span class="price-val font-13 fw-bold">{{ formatToVND(tour[0].gia_nguoi_lon) }}</span>
                                </div>
                                <div class="divider-vertical mx-2"></div>
                                <div class="text-center flex-grow-1">
                                    <small class="text-muted d-block font-11">Trẻ em</small>
                                    <span class="price-val font-13 fw-bold">{{ formatToVND(tour[0].gia_tre_em) }}</span>
                                </div>
                            </div>

                            <form @submit.prevent>
                                <div class="mb-2">
                                    <label class="form-label-custom font-12 mb-1">Khách hàng</label>
                                    <input type="text" class="form-control custom-input py-1 font-13" :value="ten_hien_thi" readonly>
                                </div>

                                <div class="passenger-selector mb-3">
                                    <label class="form-label-custom font-12 mb-1">Số lượng hành khách</label>
                                    <div class="d-flex justify-content-between align-items-center mb-1 p-2 border rounded-3">
                                        <span class="font-12 fw-medium text-dark">Người lớn <small class="text-muted font-10">/Trên 10t</small></span>
                                        <div class="counter-control">
                                            <button @click="decrease('adult')" type="button" class="count-btn">−</button>
                                            <input v-model="so_nguoi_lon" type="text" class="count-input font-13" readonly>
                                            <button @click="increase('adult')" type="button" class="count-btn">+</button>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center p-2 border rounded-3">
                                        <span class="font-12 fw-medium text-dark">Trẻ em <small class="text-muted font-10">/Dưới 10t</small></span>
                                        <div class="counter-control">
                                            <button @click="decrease('child')" type="button" class="count-btn">−</button>
                                            <input v-model="so_tre_em" type="text" class="count-input font-13" readonly>
                                            <button @click="increase('child')" type="button" class="count-btn">+</button>
                                        </div>
                                    </div>
                                </div>

                                <div class="promo-section mb-3">
                                    <label class="form-label-custom font-12 mb-1">Mã khuyến mãi</label>
                                    <div class="input-group input-group-sm">
                                        <input v-model="ma_khuyen_mai" type="text" class="form-control custom-input" placeholder="Nhập mã..." :disabled="is_applied">
                                        <button @click="apMaKhuyenMai()" class="btn btn-warning px-3" type="button" :disabled="is_applied">
                                            {{ is_applied ? 'OK' : 'Áp dụng' }}
                                        </button>
                                    </div>
                                    <div v-if="thong_bao_km" :class="is_applied ? 'text-success' : 'text-danger'" class="font-11 mt-1 fw-medium">
                                        {{ thong_bao_km }}
                                    </div>
                                </div>

                                <div class="border-top pt-2 mb-3">
                                    <div class="d-flex justify-content-between font-12 mb-1">
                                        <span class="text-muted">Tạm tính:</span>
                                        <span class="text-dark fw-bold">{{ formatToVND(tong_tien + so_tien_giam) }}</span>
                                    </div>
                                    <div v-if="is_applied" class="d-flex justify-content-between font-12 mb-1">
                                        <span class="text-muted">Giảm giá:</span>
                                        <span class="text-danger fw-bold">- {{ formatToVND(so_tien_giam) }}</span>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center mt-2">
                                        <span class="fw-bold text-dark font-13">TỔNG CỘNG</span>
                                        <span class="total-price fs-5 text-danger">{{ formatToVND(tong_tien) }}</span>
                                    </div>
                                </div>

                                <div class="d-grid gap-2">
                                    <button @click="moFormXacNhan()" class="btn-momo-filled w-100 py-2 mb-1 font-14">
                                        <img src="https://homepage.momocdn.net/fileuploads/svg/momo-file-240411162904.svg" width="20" alt="">
                                        Thanh toán MoMo
                                    </button>
                                    
                                    <div class="row g-2">
                                        <div class="col-6">
                                            <button @click="themVaoGioHang()" class="btn-action btn-cart w-100">
                                                <i class="fa-solid fa-cart-plus me-1"></i> Thanh toán sau
                                            </button>
                                        </div>
                                        <div class="col-6">
                                            <button @click="themVaoWishlist()" class="btn-action btn-wish w-100">
                                                <i class="fa-solid fa-heart me-1"></i> Yêu thích
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ── ĐÁNH GIÁ ── -->
            <div class="tour-reviews-section mt-5">
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-header bg-white border-bottom-0 pt-4 pb-3">
                        <h5 class="fw-bold text-dark mb-0">
                            <i class="fa-solid fa-star text-warning me-2"></i>Đánh Giá Từ Khách Hàng
                        </h5>
                    </div>
                    
                    <div class="card-body p-4">
                        <div class="row g-4">
                            
                            <div class="col-lg-5 border-end-lg pe-lg-4">
                                <div class="rating-summary text-center bg-light rounded-4 p-4 mb-4">
                                    <h1 class="display-3 fw-bold text-dark mb-0">{{ trung_binh_sao }}</h1>
                                    <div class="text-warning font-18 mb-2">
                                        <i v-for="n in 5" :key="n" class="fa-star" :class="n <= Math.round(trung_binh_sao) ? 'fa-solid' : 'fa-regular'"></i>
                                    </div>
                                    <p class="text-muted mb-0">Dựa trên {{ list_danh_gia.length }} lượt đánh giá</p>
                                </div>

                                <div class="review-form">
                                    <h6 class="fw-bold mb-3">Gửi đánh giá của bạn</h6>
                                    <form @submit.prevent="guiDanhGia">
                                        <div class="mb-3 d-flex align-items-center">
                                            <span class="text-muted me-3 font-14">Bạn chấm mấy sao?</span>
                                            <div class="star-rating-input" @mouseleave="hover_sao = 0">
                                                <i v-for="n in 5" :key="n" 
                                                class="fa-star font-18 cursor-pointer" 
                                                :class="n <= (hover_sao || form_danh_gia.so_sao) ? 'fa-solid text-warning' : 'fa-regular text-muted'"
                                                @mouseover="hover_sao = n"
                                                @click="form_danh_gia.so_sao = n">
                                                </i>
                                            </div>
                                        </div>
                                        
                                        <div class="mb-3">
                                            <textarea v-model="form_danh_gia.noi_dung" class="form-control custom-input" rows="4" placeholder="Chia sẻ trải nghiệm của bạn về tour này nhé..." required></textarea>
                                        </div>
                                        
                                        <button type="submit" class="btn btn-primary-dark w-100 rounded-pill fw-bold" :disabled="form_danh_gia.so_sao === 0 || is_submitting">
                                            <i class="fa-solid fa-paper-plane me-2"></i>{{ is_submitting ? 'ĐANG GỬI...' : 'GỬI ĐÁNH GIÁ' }}
                                        </button>
                                    </form>
                                </div>
                            </div>

                            <div class="col-lg-7 ps-lg-4">
                                <div class="review-list pe-2" style="max-height: 500px; overflow-y: auto;">
                                    
                                    <div v-if="list_danh_gia.length === 0" class="text-center py-5 text-muted">
                                        <i class="fa-regular fa-comment-dots fa-3x mb-3 opacity-25"></i>
                                        <p>Chưa có đánh giá nào. Hãy là người đầu tiên đánh giá tour này!</p>
                                    </div>

                                    <div v-for="(v, k) in list_danh_gia" :key="k" class="review-item mb-4 pb-4 border-bottom">
                                        <div class="d-flex align-items-start">
                                            <div class="avatar-circle me-3 bg-light-success text-primary-dark fw-bold">
                                                {{ v.ten_khach_hang.charAt(0).toUpperCase() }}
                                            </div>
                                            <div class="flex-grow-1">
                                                <div class="d-flex justify-content-between align-items-center mb-1">
                                                    <h6 class="mb-0 fw-bold text-dark">{{ v.ten_khach_hang }}</h6>
                                                    <small class="text-muted font-12">{{ formatDate(v.created_at) }}</small>
                                                </div>
                                                <div class="text-warning font-12 mb-2">
                                                    <i v-for="n in 5" :key="n" class="fa-star" :class="n <= v.so_sao ? 'fa-solid' : 'fa-regular'"></i>
                                                </div>
                                                <p class="text-secondary font-14 mb-0" style="white-space: pre-line;">{{ v.noi_dung }}</p>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ── TOUR LIÊN QUAN ── -->
            <div class="mt-5 pt-5 border-top">
                <div class="section-header text-center mb-5">
                    <h3 class="section-title">Có Thể Bạn Sẽ Thích</h3>
                </div>
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
                    <div class="col" v-for="(v, k) in list_tour.slice(0, 4)" :key="v.id">
                        <div class="tour-card h-100 rounded-4 overflow-hidden border">
                            <div class="tour-img-wrapper">
                                <router-link :to="'/client/chi-tiet-tour/' + v.id">
                                    <img :src="v.link_anh" class="tour-img" alt="Tour">
                                </router-link>
                            </div>
                            <div class="tour-body p-3">
                                <h6 class="tour-title mb-2">
                                    <router-link :to="'/client/chi-tiet-tour/' + v.id" class="text-decoration-none text-dark hover-primary">
                                        {{ v.tieu_de }}
                                    </router-link>
                                </h6>
                                <p class="text-danger fw-bold mb-3">Chỉ từ {{ formatToVND(v.gia_tre_em) }}</p>
                                <router-link :to="'/client/chi-tiet-tour/' + v.id" class="tour-btn w-100 py-1">Xem Chi Tiết</router-link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- Loading State -->
        <div v-else class="container d-flex flex-column justify-content-center align-items-center" style="height: 70vh;">
            <div class="spinner-grow text-success mb-3" role="status"></div>
            <p class="text-muted fw-medium">Đang tải hành trình tuyệt đẹp của bạn...</p>
        </div>
    </div>

    <div class="modal fade" id="modalXacNhanThanhToan" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content rounded-4 border-0 shadow">
                <div class="modal-header border-bottom-0 pb-0 pt-4 px-4">
                    <h5 class="modal-title fw-bold text-dark">
                        <i class="fa-solid fa-address-card text-primary-dark me-2"></i>Xác nhận thông tin liên lạc
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                
                <div class="modal-body p-4">
                    <div class="alert alert-info border-0 bg-light-success text-dark rounded-3 font-13 mb-4 d-flex align-items-center">
                        <i class="fa-solid fa-circle-check text-primary-dark fs-5 me-3"></i>
                        <div>Vui lòng kiểm tra và cập nhật thông tin liên lạc chính xác để chúng tôi có thể hỗ trợ và gửi vé điện tử cho bạn!</div>
                    </div>

                    <div class="row g-4">
                        <div class="col-md-6">
                            <label class="form-label-custom font-13 mb-2">Họ và tên (*)</label>
                            <input v-model="form_lien_he.ho_ten" type="text" class="form-control custom-input py-2" placeholder="Ví dụ: Nguyễn Văn A">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label-custom font-13 mb-2">Số điện thoại (*)</label>
                            <input v-model="form_lien_he.sdt" type="text" class="form-control custom-input py-2" placeholder="Ví dụ: 0901234567">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label-custom font-13 mb-2">Email (*)</label>
                            <input v-model="form_lien_he.email" type="email" class="form-control custom-input py-2" placeholder="Ví dụ: email@example.com">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label-custom font-13 mb-2">Địa chỉ hiện tại</label>
                            <input v-model="form_lien_he.dia_chi" type="text" class="form-control custom-input py-2" placeholder="Ví dụ: 123 Lê Lợi, TP.HCM">
                        </div>
                    </div>
                </div>
                
                <div class="modal-footer border-top-0 pt-0 pb-4 px-4 d-flex justify-content-end">
                    <button type="button" class="btn btn-light rounded-pill px-4 fw-medium" data-bs-dismiss="modal">Hủy bỏ</button>
                    <button @click="tienHanhThanhToanMomo()" type="button" class="btn btn-primary-dark rounded-pill px-4 fw-bold">
                        Tiếp tục thanh toán <i class="fa-solid fa-arrow-right ms-2"></i>
                    </button>
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
            tour: [],
            list_tour: [],
            lich_trinh: [],
            so_nguoi_lon: 0,
            so_tre_em: 0,
            tong_tien: 0,
            is_login: false,
            ten_hien_thi: 'Chưa đăng nhập',
            map: null,
            markers: [],
            routeLines: [],
            markerColors: ['#0d7a5f', '#e8a020', '#dc3545', '#6f42c1', '#17a2b8', '#28a745'],

            ma_khuyen_mai: '',
            so_tien_giam: 0,
            is_applied: false,
            thong_bao_km: '',

            id_tour: this.$route.params.id || window.location.href.split('/').pop(),
            list_danh_gia: [],
            trung_binh_sao: 0,
            hover_sao: 0,
            is_submitting: false,
            form_danh_gia: {
                so_sao: 0,
                noi_dung: ''
            },
            user_login: {},

            modal_xac_nhan: null,
            form_lien_he: {
                ho_ten: '',
                sdt: '',
                email: '',
                dia_chi: ''
            }
        }
    },
    computed: {
        tong_tien_tam_tinh() {
            if (!this.tour[0]) return 0;
            return (this.so_nguoi_lon * this.tour[0].gia_nguoi_lon) + 
                (this.so_tre_em * this.tour[0].gia_tre_em);
        },
        tong_tien_phai_tra() {
            let total = this.tong_tien_tam_tinh - this.so_tien_giam;
            return total > 0 ? total : 0;
        }
    },
    mounted() {
        this.loadDataChiTietTour();
        this.loadDataTour();
        this.kiemTraDangNhap();
        this.loadDanhGia();
    },
    watch: {
        lich_trinh: {
            handler: function(newVal) {
                console.log('Lịch trình data changed:', newVal);
                if (newVal && newVal.length > 0) {
                    this.$nextTick(() => {
                        console.log('Init map with data:', newVal);
                        this.initMap();
                    });
                }
            },
            deep: true
        },
        so_nguoi_lon() { this.resetCoupon(); },
        so_tre_em() { this.resetCoupon(); }
    },
    methods: {
        loadDanhGia() {
            baseRequest.get('danh-gia/lay-du-lieu/' + this.id_tour)
                .then((res) => {
                    if (res.data.status) {
                        this.list_danh_gia = res.data.list;
                        this.trung_binh_sao = res.data.avg;
                    }
                })
                .catch((err) => {
                    console.error("Lỗi lấy đánh giá:", err);
                });
        },

        guiDanhGia() {
            if (!this.is_login) {
                toaster.error("Bạn cần đăng nhập để gửi đánh giá!");
                this.$router.push('/client/dang-nhap');
                return;
            }

            if (this.form_danh_gia.so_sao === 0) {
                toaster.warning("Vui lòng chạm để chọn số sao đánh giá!");
                return;
            }

            this.is_submitting = true;

            const payload = {
                so_sao: this.form_danh_gia.so_sao,
                noi_dung: this.form_danh_gia.noi_dung,
                id_tour: this.id_tour,
            };

            axios.post("http://127.0.0.1:8000/api/danh-gia/them-moi", payload, {
                headers: {
                    Authorization: 'Bearer ' + localStorage.getItem("token_client")
                }
            })
            .then((res) => {
                if (res.data.status) {
                    toaster.success(res.data.message);
                    // Xóa rỗng form sau khi gửi
                    this.form_danh_gia = { so_sao: 0, noi_dung: '' }; 
                    this.hover_sao = 0;
                    this.loadDanhGia(); 
                } else {
                    toaster.error(res.data.message);
                }
            })
            .catch((err) => {
                console.error("Lỗi gửi đánh giá:", err.response?.data);
                toaster.error("Có lỗi xảy ra hoặc dữ liệu gửi đi không hợp lệ!");
            })
            .finally(() => {
                this.is_submitting = false;
            });
        },

        resetCoupon() {
            this.is_applied = false;
            this.so_tien_giam = 0;
            this.ma_khuyen_mai = '';
            this.thong_bao_km = '';
        },
        getMarkerColor(index) {
            return this.markerColors[index % this.markerColors.length];
        },
        initMap() {
            const mapContainer = document.getElementById('map-container-client');
            if (!mapContainer) return;
            
            if (this.map) {
                this.map.remove();
                this.map = null;
            }
            
            if (!window.L) {
                const link = document.createElement('link');
                link.rel = 'stylesheet';
                link.href = 'https://unpkg.com/leaflet@1.9.4/dist/leaflet.css';
                document.head.appendChild(link);
                
                const script = document.createElement('script');
                script.src = 'https://unpkg.com/leaflet@1.9.4/dist/leaflet.js';
                script.onload = () => {
                    this.createMapInstance();
                };
                document.head.appendChild(script);
            } else {
                this.createMapInstance();
            }
        },
        createMapInstance() {
            if (this.map) return;
            
            this.map = L.map('map-container-client').setView([16.0544, 108.2022], 7);
            
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap contributors'
            }).addTo(this.map);
            
            this.loadRouteData();
        },
        async loadRouteData() {
            if (!this.map || !this.lich_trinh || this.lich_trinh.length === 0) return;
            
            // Xóa tất cả các layer cũ
            this.map.eachLayer((layer) => {
                if (layer instanceof L.Marker || layer instanceof L.Polyline || layer instanceof L.GeoJSON) {
                    this.map.removeLayer(layer);
                }
            });
            
            const markerPositions = [];
            
            // Thu thập tất cả địa điểm cần geocode
            const allLocations = [];
            this.lich_trinh.forEach((item) => {
                if (item.dia_diem_den) {
                    const exists = allLocations.find(l => l.name === item.dia_diem_den);
                    if (!exists) {
                        allLocations.push({ 
                            name: item.dia_diem_den, 
                            item: item 
                        });
                    }
                }
            });
            
            // Geocode tất cả địa điểm trước
            const locationCoords = {};
            for (let i = 0; i < allLocations.length; i++) {
                const loc = allLocations[i];
                let coords = null;
                
                if (loc.item.vi_do && loc.item.kinh_do) {
                    coords = [parseFloat(loc.item.vi_do), parseFloat(loc.item.kinh_do)];
                } else {
                    coords = await this.geocode(loc.name);
                }
                
                if (coords) {
                    locationCoords[loc.name] = coords;
                }
                
                // Delay để tránh rate limit
                if (i < allLocations.length - 1) {
                    await new Promise(r => setTimeout(r, 500));
                }
            }
            
            // Bây giờ vẽ markers và routes với tọa độ đã có
            for (let i = 0; i < this.lich_trinh.length; i++) {
                const item = this.lich_trinh[i];
                const coords = locationCoords[item.dia_diem_den];
                
                if (coords && coords.length === 2) {
                    const color = this.getMarkerColor(i);
                    
                    const icon = L.divIcon({
                        html: `<div style="background-color: ${color}; color: white; width: 32px; height: 32px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold; font-size: 14px; border: 3px solid white; box-shadow: 0 2px 8px rgba(0,0,0,0.4);">${i + 1}</div>`,
                        className: 'custom-marker',
                        iconSize: [32, 32],
                        iconAnchor: [16, 16]
                    });
                    
                    L.marker(coords, { icon: icon })
                        .addTo(this.map)
                        .bindPopup(`<b>${item.tieu_de}</b><br>📍 ${item.dia_diem_den}<br>⏰ ${item.gio_khoi_hanh || '07:00'} - ${item.gio_ket_thuc || '18:00'}`);
                    
                    markerPositions.push(coords);
                    
                    // Vẽ đường đi từ điểm hiện tại đến điểm tiếp theo
                    if (i < this.lich_trinh.length - 1) {
                        const nextItem = this.lich_trinh[i + 1];
                        const fromCoord = coords;
                        const toCoord = locationCoords[nextItem.dia_diem_den];
                        
                        if (fromCoord && toCoord) {
                            await this.drawRouteByCoords(fromCoord, toCoord, i);
                        }
                    }
                }
            }
            
            // Zoom map để hiển thị tất cả các marker
            if (markerPositions.length > 0) {
                const bounds = L.latLngBounds(markerPositions);
                this.map.fitBounds(bounds, { padding: [50, 50] });
            }
        },
        async geocode(address) {
            try {
                // Thử tìm với địa chỉ đầy đủ
                const response = await fetch(
                    `https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(address + ', Việt Nam')}&limit=1`
                );
                const data = await response.json();
                
                if (data && data.length > 0) {
                    return [parseFloat(data[0].lat), parseFloat(data[0].lon)];
                }
            } catch (error) {
                console.error('Geocoding error for:', address, error);
            }
            return null;
        },
        async drawRouteByCoords(fromCoords, toCoords, index) {
            if (!fromCoords || !toCoords) return;
            
            const color = this.getMarkerColor(index);
            
            try {
                // Gọi OSRM API để lấy đường đi thực tế
                const response = await fetch(
                    `https://router.project-osrm.org/route/v1/driving/${fromCoords[1]},${fromCoords[0]};${toCoords[1]},${toCoords[0]}?overview=full&geometries=geojson`
                );
                const data = await response.json();
                
                if (data.code === 'Ok' && data.routes && data.routes[0]) {
                    const routeCoords = data.routes[0].geometry.coordinates.map(c => [c[1], c[0]]);
                    const distance = (data.routes[0].distance / 1000).toFixed(1);
                    
                    // Viền trắng
                    L.polyline(routeCoords, {
                        color: 'white',
                        weight: 8,
                        opacity: 1
                    }).addTo(this.map);
                    
                    // Đường chính
                    L.polyline(routeCoords, {
                        color: color,
                        weight: 5,
                        opacity: 0.9
                    }).addTo(this.map);
                    
                    // Thêm khoảng cách ở giữa đường
                    const midIndex = Math.floor(routeCoords.length / 2);
                    const midCoord = routeCoords[midIndex];
                    
                    const distanceIcon = L.divIcon({
                        className: 'distance-marker',
                        html: `<div style="background: white; padding: 4px 8px; border-radius: 15px; box-shadow: 0 2px 5px rgba(0,0,0,0.2); font-size: 11px; font-weight: bold; color: ${color}; white-space: nowrap;">${distance} km</div>`,
                        iconSize: [60, 20],
                        iconAnchor: [30, 10]
                    });
                    
                    L.marker(midCoord, { icon: distanceIcon, interactive: false }).addTo(this.map);
                } else {
                    // Fallback: vẽ đường thẳng nếu OSRM fail
                    L.polyline([fromCoords, toCoords], {
                        color: color,
                        weight: 4,
                        opacity: 0.8,
                        dashArray: '10, 10'
                    }).addTo(this.map);
                }
            } catch (error) {
                console.error('OSRM error:', error);
                // Fallback: vẽ đường thẳng nếu có lỗi
                L.polyline([fromCoords, toCoords], {
                    color: color,
                    weight: 4,
                    opacity: 0.8,
                    dashArray: '10, 10'
                }).addTo(this.map);
            }
        },
        async drawRoute(fromItem, toItem, index) {
            // Lấy tọa độ từ database
            let fromCoords = null;
            let toCoords = null;
            
            if (fromItem.vi_do && fromItem.kinh_do) {
                fromCoords = [parseFloat(fromItem.vi_do), parseFloat(fromItem.kinh_do)];
            }
            
            if (toItem.vi_do && toItem.kinh_do) {
                toCoords = [parseFloat(toItem.vi_do), parseFloat(toItem.kinh_do)];
            }
            
            if (fromCoords && toCoords) {
                const color = this.getMarkerColor(index);
                
                try {
                    // Gọi OSRM API để lấy đường đi thực tế
                    const response = await fetch(
                        `https://router.project-osrm.org/route/v1/driving/${fromCoords[1]},${fromCoords[0]};${toCoords[1]},${toCoords[0]}?overview=full&geometries=geojson`
                    );
                    const data = await response.json();
                    
                    if (data.code === 'Ok' && data.routes && data.routes[0]) {
                        const routeCoords = data.routes[0].geometry.coordinates.map(c => [c[1], c[0]]);
                        const distance = (data.routes[0].distance / 1000).toFixed(1);
                        
                        // Viền trắng
                        L.polyline(routeCoords, {
                            color: 'white',
                            weight: 8,
                            opacity: 1
                        }).addTo(this.map);
                        
                        // Đường chính
                        L.polyline(routeCoords, {
                            color: color,
                            weight: 5,
                            opacity: 0.9
                        }).addTo(this.map);
                        
                        // Thêm khoảng cách ở giữa đường
                        const midIndex = Math.floor(routeCoords.length / 2);
                        const midCoord = routeCoords[midIndex];
                        
                        const distanceIcon = L.divIcon({
                            className: 'distance-marker',
                            html: `<div style="background: white; padding: 4px 8px; border-radius: 15px; box-shadow: 0 2px 5px rgba(0,0,0,0.2); font-size: 11px; font-weight: bold; color: ${color}; white-space: nowrap;">${distance} km</div>`,
                            iconSize: [60, 20],
                            iconAnchor: [30, 10]
                        });
                        
                        L.marker(midCoord, { icon: distanceIcon, interactive: false }).addTo(this.map);
                        
                        return; // Thành công, không cần vẽ đường thẳng
                    }
                } catch (error) {
                    console.error('OSRM error:', error);
                }
                
                // Fallback: vẽ đường thẳng nếu OSRM fail
                L.polyline([fromCoords, toCoords], {
                    color: color,
                    weight: 4,
                    opacity: 0.8,
                    dashArray: '10, 10'
                }).addTo(this.map);
            }
        },

        moFormXacNhan() {
            if (this.so_nguoi_lon === 0 && this.so_tre_em === 0) {
                toaster.warning("Vui lòng chọn số lượng hành khách!");
                return;
            }

            if (!this.is_login) {
                toaster.error("Bạn cần đăng nhập trước khi thanh toán!");
                this.$router.push('/client/dang-nhap');
                return;
            }

            this.form_lien_he = {
                ho_ten: this.user_login?.ho_ten || localStorage.getItem('ho_ten_client') || '',
                sdt: this.user_login?.so_dien_thoai || this.user_login?.sdt || '',
                email: this.user_login?.email || '',
                dia_chi: this.user_login?.dia_chi || ''
            };

            if (!this.modal_xac_nhan) {
                this.modal_xac_nhan = new window.bootstrap.Modal(document.getElementById('modalXacNhanThanhToan'));
            }
            this.modal_xac_nhan.show();
        },

        tienHanhThanhToanMomo() {
            if (!this.form_lien_he.ho_ten || !this.form_lien_he.sdt || !this.form_lien_he.email) {
                toaster.warning("Vui lòng điền đầy đủ thông tin liên lạc!");
                return;
            }

            const payload_tao_hoa_don = {
                id: this.tour[0].id || this.tour[0].id_tour, 
                tong_tien: this.tong_tien_phai_tra || this.tong_tien,
                so_luong_nguoi_lon: this.so_nguoi_lon,
                so_luong_tre_em: this.so_tre_em,
                thong_tin_lien_he: this.form_lien_he
            };

            axios.post("http://127.0.0.1:8000/api/hoa-don/tao-hoa-don-momo", payload_tao_hoa_don, {
                headers: { Authorization: 'Bearer ' + localStorage.getItem("token_client") }
            })
            .then((res) => {
                if (res.data.status) {
                    this.modal_xac_nhan.hide();
                    const payload_momo = {
                        id: res.data.hoa_don.id,
                        tong_tien: res.data.hoa_don.tong_tien
                    };

                    axios.post("http://127.0.0.1:8000/api/momo/atm-payment", payload_momo, {
                        headers: { Authorization: 'Bearer ' + localStorage.getItem("token_client") }
                    })
                    .then((resMomo) => {
                        if (resMomo.data.status && resMomo.data.payUrl) {
                            window.location.href = resMomo.data.payUrl;
                        } else {
                            toaster.error("MoMo lỗi: " + (resMomo.data.message || 'Không khởi tạo được thanh toán'));
                        }
                    })
                    .catch((error) => {
                        console.error("Lỗi gọi MoMo:", error.response?.data); 
                        toaster.error("Không thể kết nối đến cổng thanh toán MoMo!");
                    });

                } else {
                    toaster.error(res.data.message);
                }
            })
            .catch((error) => {
                console.error("Lỗi lập hóa đơn:", error.response?.data);
                toaster.error("Có lỗi xảy ra khi tạo hóa đơn! Vui lòng thử lại.");
            });
        },
        apMaKhuyenMai() {
            const payload = {
                code: this.ma_khuyen_mai,
                tong_tien: this.tong_tien_tam_tinh
            };

            baseRequest
                .post('client/check-coupon', payload)
                .then((res) => {
                    if (res.data.status) {
                        this.is_applied = true;
                        this.so_tien_giam = res.data.so_tien_giam;
                        this.thong_bao_km = res.data.message;
                        toaster.success("Bạn được giảm " + this.formatToVND(this.so_tien_giam));
                    } else {
                        this.is_applied = false;
                        this.so_tien_giam = 0;
                        this.thong_bao_km = res.data.message;
                    }
                });
        },
        kiemTraDangNhap() {
            axios
                .get("http://127.0.0.1:8000/api/account-client/kiem-tra-token-client", {
                    headers: {
                        Authorization: 'Bearer ' + localStorage.getItem("token_client")
                    }
                })
                .then((res) => {
                    this.ten_hien_thi = localStorage.getItem('ho_ten_client');
                    this.user_login = res.data.khach_hang || res.data.user;
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
                        this.lich_trinh = res.data.lich_trinh || [];
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
            this.tong_tien = (this.tour[0].gia_nguoi_lon * this.so_nguoi_lon) + (this.tour[0].gia_tre_em * this.so_tre_em);
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
                    if (res.data.status) {
                        this.ten_hien_thi = localStorage.getItem('ho_ten_client');
                        this.user_login = res.data.khach_hang || res.data.user;
                    }
                });
        },
        themVaoWishlist() {
            if (this.is_login) {
                var payload = {
                    'tour_id': this.tour[0].id_tour,
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
                            this.$router.push('/client/wishlist');
                        } else {
                            toaster.error(res.data.message);
                        }
                    });
            } else {
                toaster.error("Bạn cần đăng nhập trước!");
                this.$router.push('/client/dang-nhap');
            }
        },
        themVaoGioHang() {
            if (this.so_nguoi_lon === 0 && this.so_tre_em === 0) {
                toaster.error("Vui lòng chọn số lượng hành khách (người lớn hoặc trẻ em)!");
                return; 
            }

            if (this.is_login) {
                var payload = {
                    'gia_nguoi_lon': parseInt(this.tour[0].gia_nguoi_lon) || 0,
                    'gia_tre_em': parseInt(this.tour[0].gia_tre_em) || 0,
                    'so_nguoi_lon': parseInt(this.so_nguoi_lon) || 0,
                    'so_tre_em': parseInt(this.so_tre_em) || 0,
                    'id_tour': this.tour[0].id_tour || this.tour[0].id, 
                };

                console.log("Dữ liệu gửi lên server:", payload);

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
                            toaster.error(res.data.message);
                        }
                    })
                    .catch((err) => {
                        console.error("Lỗi API:", err.response?.data);
                        toaster.error("Có lỗi xảy ra hoặc dữ liệu gửi đi không hợp lệ!");
                    });
            } else {
                toaster.error("Bạn cần đăng nhập trước!");
                this.$router.push('/client/dang-nhap');
            }
        }
    },
}
</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@300;400;500;600;700;800&display=swap');

/* ── BASE ── */
.chi-tiet-page {
    font-family: 'Be Vietnam Pro', sans-serif;
    background: #f8f7f4;
    min-height: 100vh;
}

/* ── UI COMPONENTS ── */
.section-tag {
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 2px;
    text-transform: uppercase;
    color: #0d7a5f;
    background: rgba(13, 122, 95, 0.1);
    padding: 4px 12px;
    border-radius: 50px;
}
.section-title {
    font-size: 32px;
    font-weight: 800;
    color: #1a1f2e;
}

/* ── IMAGES ── */
.main-img-box { height: 450px; }
.sub-img-box { height: 217px; }
.img-wrapper img {
    transition: transform 0.6s ease;
}
.img-wrapper:hover img { transform: scale(1.05); }

/* ── INFO CARDS ── */
.info-card {
    background: #fff;
    border: 1px solid #eeebe5;
}
.info-label {
    font-size: 18px;
    font-weight: 700;
    color: #0d7a5f;
}
.border-end-custom {
    border-right: 1px solid #f0ede8;
}
.highlight-box {
    background: #f1f8f6;
    border-left: 4px solid #0d7a5f;
}
.text-primary-dark { color: #0d7a5f; }
.text-description {
    line-height: 1.8;
    color: #4b5563;
    font-size: 15px;
}

/* ── FLIGHT ── */
.flight-badge-go {
    background: #e6f5f0;
    color: #0d7a5f;
    padding: 6px 15px;
    border-radius: 50px;
    font-weight: 700;
    font-size: 12px;
    display: inline-block;
}
.flight-badge-back {
    background: #fff8eb;
    color: #e8a020;
    padding: 6px 15px;
    border-radius: 50px;
    font-weight: 700;
    font-size: 12px;
    display: inline-block;
}
.flight-line {
    height: 2px;
    background: #e5e7eb;
    position: relative;
    text-align: center;
}
.flight-line i {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background: #fff;
    padding: 0 10px;
}

/* ── BOOKING CARD (Sticky) ── */
.booking-card {
    background: #fff;
    border: none;
    overflow: hidden;
}
.booking-header {
    background: #ffffff;
    border-bottom: 1px solid #eee;

}
.tour-id-tag {
    font-size: 11px;
    color: rgba(255,255,255,0.8);
    letter-spacing: 1px;
}
.price-val {
    font-size: 18px;
    font-weight: 800;
    color: #dc3545;
}
.divider-vertical {
    width: 1px;
    background: #eee;
}
.form-label-custom {
    font-size: 13px;
    font-weight: 700;
    color: #1a1f2e;
    margin-bottom: 8px;
}
.custom-input {
    border-radius: 8px;
    border: 1px solid #e5e7eb;
    padding: 10px;
    font-weight: 600;
    background-color: #f9fafb !important;
}

/* Counter Control */
.counter-control {
    display: flex;
    align-items: center;
    background: #f3f4f6;
    border-radius: 50px;
    padding: 4px;
}
.count-btn {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    border: none;
    background: #fff;
    font-weight: bold;
    transition: 0.2s;
}
.count-btn:hover { background: #0d7a5f; color: #fff; }
.count-input {
    width: 40px;
    border: none;
    background: transparent;
    text-align: center;
    font-weight: 700;
}

.total-price {
    font-size: 24px;
    font-weight: 800;
    color: #dc3545;
}

.btn-book-now {
    background: #0d7a5f;
    color: #fff;
    border: none;
    padding: 15px;
    border-radius: 12px;
    font-weight: 700;
    transition: 0.3s;
    width: 100%;
}
.btn-book-now:hover { background: #085544; transform: translateY(-2px); }

.btn-action {
    border: 1.5px solid;
    padding: 10px;
    border-radius: 10px;
    font-weight: 600;
    font-size: 13px;
    transition: 0.2s;
    background: transparent;
}
.btn-cart { border-color: #e8a020; color: #e8a020; }
.btn-cart:hover { background: #e8a020; color: #fff; }
.btn-wish { border-color: #ff4757; color: #ff4757; }
.btn-wish:hover { background: #ff4757; color: #fff; }

/* ── TOUR RELATED CARDS (Kế thừa style cũ) ── */
.tour-card {
    background: #fff;
    transition: transform 0.3s ease;
}
.tour-card:hover { transform: translateY(-5px); box-shadow: 0 10px 30px rgba(0,0,0,0.08); }
.tour-img-wrapper { height: 160px; overflow: hidden; }
.tour-img { width: 100%; height: 100%; object-fit: cover; transition: 0.5s; }
.tour-card:hover .tour-img { transform: scale(1.1); }
.tour-title {
    font-size: 14px;
    font-weight: 700;
    height: 2.6em;
    overflow: hidden;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
}
.tour-btn {
    display: block;
    text-align: center;
    text-decoration: none;
    border: 1.5px solid #0d7a5f;
    color: #0d7a5f;
    border-radius: 50px;
    font-size: 12px;
    font-weight: 700;
}
.tour-btn:hover { background: #0d7a5f; color: #fff; }
.hover-primary:hover { color: #0d7a5f !important; }

/* Responsive */
@media (max-width: 991px) {
    .border-end-custom { border-right: none; }
}

.btn-momo-filled, .btn-momo-outlined, .btn-momo-soft {
  display: flex; align-items: center; justify-content: center;
  gap: 10px; padding: 13px 20px;
  border-radius: 12px; font-size: 15px; font-weight: 500;
  cursor: pointer; border: none; transition: all 0.2s;
}

.btn-momo-filled { background: #ae2070; color: #fff; }
.btn-momo-filled:hover { background: #921a5f; }
.btn-momo-outlined { background: #fff; color: #ae2070; border: 1.5px solid #ae2070; }
.btn-momo-outlined:hover { background: #fdf0f6; }
.btn-momo-soft { background: #fdf0f6; color: #ae2070; border: 0.5px solid #f0b8d4; justify-content: space-between; }
.btn-momo-soft:hover { background: #fce0ee; }
[class^="btn-momo"] img { width: 28px; height: 28px; border-radius: 6px; }
.btn-momo-soft small { font-size: 12px; color: #c96b9e; }

/* ── MAP STYLES ── */
.map-container {
    height: 400px;
    width: 100%;
    z-index: 1;
}
.font-13 { font-size: 13px; }
.font-14 { font-size: 14px; }

/* ── TIMELINE STYLES ── */
.timeline-container {
    position: relative;
    padding-left: 20px;
}
.timeline-container::before {
    content: '';
    position: absolute;
    left: 12px;
    top: 0;
    bottom: 0;
    width: 3px;
    background: linear-gradient(180deg, #0d7a5f, #e8a020);
    border-radius: 3px;
}
.timeline-item {
    position: relative;
    padding: 15px 0 15px 40px;
    border-bottom: 1px dashed #e5e7eb;
}
.timeline-item:last-child {
    border-bottom: none;
}
.timeline-marker {
    position: absolute;
    left: 0;
    top: 18px;
    width: 28px;
    height: 28px;
    border-radius: 50%;
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 12px;
    border: 3px solid white;
    box-shadow: 0 2px 8px rgba(0,0,0,0.15);
}
.timeline-content {
    background: #f9fafb;
    padding: 15px;
    border-radius: 12px;
    border: 1px solid #e5e7eb;
}
.badge-day {
    background: #0d7a5f;
    color: white;
    padding: 2px 10px;
    border-radius: 20px;
    font-size: 11px;
    font-weight: 600;
}
.info-tag {
    background: white;
    border: 1px solid #e5e7eb;
    padding: 4px 10px;
    border-radius: 6px;
    font-size: 12px;
    color: #4b5563;
}
.info-tag i {
    color: #0d7a5f;
}

/* ── MAP LEGEND ── */
.map-legend {
    background: white;
    padding: 10px 15px;
    border-radius: 8px;
    border: 1px solid #e5e7eb;
    font-size: 12px;
}
.font-11 { font-size: 11px; }
.font-12 { font-size: 12px; }
.font-13 { font-size: 13px; }
.font-14 { font-size: 14px; }
.btn-momo-filled {
    background-color: #a50064;
    color: white;
    border: none;
    border-radius: 8px;
    font-weight: 600;
}
/* Đánh giá */
.text-primary-dark { color: #0d7a5f !important; }
.bg-light-success { background-color: #e6f5f0 !important; }

.btn-primary-dark {
    background-color: #0d7a5f;
    color: #fff;
    border: none;
    transition: all 0.2s ease;
}
.btn-primary-dark:hover:not(:disabled) {
    background-color: #085544;
    transform: translateY(-1px);
    box-shadow: 0 4px 8px rgba(13, 122, 95, 0.2);
}
.btn-primary-dark:disabled {
    background-color: #cbd5e1;
    cursor: not-allowed;
}

/* ── FORM INPUT & NGÔI SAO ── */
.custom-input {
    border-radius: 8px;
    border: 1px solid #e5e7eb;
    padding: 12px 14px;
    font-size: 14px;
    background-color: #f9fafb;
    transition: all 0.2s;
}
.custom-input:focus {
    background-color: #fff;
    border-color: #0d7a5f;
    box-shadow: 0 0 0 3px rgba(13, 122, 95, 0.1);
}

.cursor-pointer { cursor: pointer; }
.star-rating-input i {
    transition: transform 0.1s ease;
    margin-right: 4px;
}
.star-rating-input i:hover {
    transform: scale(1.2);
}

/* ── AVATAR ẢO ── */
.avatar-circle {
    width: 45px;
    height: 45px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 18px;
    flex-shrink: 0;
}

/* ── TIỆN ÍCH CHUNG ── */
.font-12 { font-size: 12px; }
.font-14 { font-size: 14px; }
.font-18 { font-size: 18px; }

@media (min-width: 992px) {
    .border-end-lg {
        border-right: 1px solid #f0ede8 !important;
    }
}

/* Thanh cuộn cho danh sách đánh giá */
.review-list::-webkit-scrollbar { width: 5px; }
.review-list::-webkit-scrollbar-thumb { background-color: #cbd5e1; border-radius: 10px; }
</style>