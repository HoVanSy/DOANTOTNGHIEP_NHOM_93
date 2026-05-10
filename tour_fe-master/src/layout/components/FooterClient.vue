<template>
    <footer class="bg-white border-top pt-5 pb-3 mt-auto">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 mb-4">
                    <img src="../../layout/imgaes/logo.png" alt="VivuTour Logo" style="height: 50px; object-fit: contain;" class="mb-3">
                    <p class="text-secondary font-14 pe-lg-4">
                        VivuTour - Hệ thống quản lý và đặt tour du lịch hàng đầu. Chúng tôi cam kết mang đến cho bạn những trải nghiệm tuyệt vời nhất trên mọi hành trình.
                    </p>
                    <div class="d-flex gap-3 mt-3">
                        <a href="#" class="text-dark fs-5 hover-primary"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="text-dark fs-5 hover-primary"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-dark fs-5 hover-primary"><i class="fab fa-youtube"></i></a>
                        <a href="#" class="text-dark fs-5 hover-primary"><i class="fab fa-tiktok"></i></a>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 mb-4">
                    <h5 class="fw-bold mb-4 text-uppercase fs-6 tracking-wide text-dark">Liên Kết Nhanh</h5>
                    <ul class="list-unstyled font-14">
                        <li class="mb-2">
                            <router-link to="/" class="text-secondary text-decoration-none hover-primary">
                                <i class="fas fa-chevron-right font-12 me-2 text-dark"></i> Trang Chủ
                            </router-link>
                        </li>
                        <li class="mb-2">
                            <router-link to="/client/danh-sach-hoa-don" class="text-secondary text-decoration-none hover-primary">
                                <i class="fas fa-chevron-right font-12 me-2 text-dark"></i> Hóa Đơn Của Tôi
                            </router-link>
                        </li>
                        <li class="mb-2">
                            <router-link to="/blog" class="text-secondary text-decoration-none hover-primary">
                                <i class="fas fa-chevron-right font-12 me-2 text-dark"></i> Blog Tin Tức
                            </router-link>
                        </li>
                        <li class="mb-2">
                            <router-link to="/yeu-cau" class="text-secondary text-decoration-none hover-primary">
                                <i class="fas fa-chevron-right font-12 me-2 text-dark"></i> Hủy / Đổi Lịch
                            </router-link>
                        </li>
                    </ul>
                </div>

                <div class="col-lg-4 col-md-12 mb-4">
                    <h5 class="fw-bold mb-4 text-uppercase fs-6 tracking-wide text-dark">Liên Hệ</h5>
                    <ul class="list-unstyled text-secondary font-14">
                        <li class="mb-3 d-flex align-items-start">
                            <i class="fas fa-map-marker-alt mt-1 me-3 fs-5 text-dark"></i> 
                            <span>123 Nguyễn Văn Linh, Quận Hải Châu, TP. Đà Nẵng</span>
                        </li>
                        <li class="mb-3 d-flex align-items-center">
                            <i class="fas fa-phone-alt me-3 fs-5 text-dark"></i> 
                            <span>Hotline: 0999.999.999</span>
                        </li>
                        <li class="mb-3 d-flex align-items-center">
                            <i class="fas fa-envelope me-3 fs-5 text-dark"></i> 
                            <span>Email: contact@vivutour.vn</span>
                        </li>
                    </ul>
                </div>
            </div>

            <hr class="text-secondary opacity-25 my-3">

            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center text-secondary font-12">
                <div class="mb-2 mb-md-0">
                    © 2026 VivuTour. All rights reserved.
                </div>
                <div>
                    Thiết kế và phát triển bởi <b class="text-dark">Nhóm Đồ Án</b>
                </div>
            </div>
        </div>

        <ChatbotAI />
    </footer>
</template>

<script>
import ChatbotAI from './ChatbotAI.vue';

export default {
    name: 'FooterComponent',
    components: {
        ChatbotAI
    }
}
</script>

<style scoped>
/* Tiện ích tùy chỉnh kích thước chữ */
.font-12 { font-size: 12px; }
.font-14 { font-size: 14px; }
.tracking-wide { letter-spacing: 1px; }

/* Hiệu ứng di chuột cho các liên kết: đổi sang màu xanh, trượt nhẹ sang phải */
.hover-primary {
    transition: all 0.3s ease;
}
.hover-primary:hover {
    color: #0d6efd !important; /* Xanh primary chuẩn của Bootstrap */
    padding-left: 5px; 
}

/* Riêng các icon mạng xã hội khi hover sẽ nhảy nhẹ lên trên */
a.hover-primary:hover i {
    transform: translateY(-3px);
    display: inline-block;
    color: #0d6efd !important;
}
</style>