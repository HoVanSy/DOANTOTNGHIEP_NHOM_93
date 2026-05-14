<template>
    <footer class="footer-wrapper bg-white border-top mt-auto">
        <div class="newsletter-section py-4 border-bottom">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 mb-3 mb-lg-0">
                        <h5 class="fw-bold text-dark mb-1"><i class="fa-regular fa-paper-plane text-primary-dark me-2"></i>Đăng Ký Nhận Tin Khuyến Mãi</h5>
                        <p class="text-muted font-14 mb-0">Nhận ngay voucher giảm giá 10% cho lần đặt tour đầu tiên!</p>
                    </div>
                    <div class="col-lg-6">
                        <div class="input-group newsletter-input">
                            <input type="email" class="form-control border-end-0" placeholder="Nhập địa chỉ email của bạn...">
                            <button class="btn btn-primary-dark px-4 fw-medium" type="button">Đăng Ký</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="main-footer pt-5 pb-2">
            <div class="container">
                <div class="row g-4">
                    
                    <div class="col-lg-3 col-md-6 mb-4 ">
                        <router-link class="navbar-brand py-0 me-lg-4 d-flex align-items-center gap-2 text-decoration-none" to="/">
                            <div class="brand-icon">
                                <i class="fa-solid fa-plane-departure"></i>
                            </div>
                            <div class="brand-text d-flex flex-column justify-content-center">
                                <span class="brand-name">VIVU<span class="brand-highlight">TOUR</span></span>
                                <span class="brand-slogan">Travel & Explore</span>
                            </div>
                        </router-link>

                        <p class="text-muted font-14 line-height-lg pe-lg-2 pt-3">
                            VivuTour tự hào là đơn vị lữ hành hàng đầu, mang đến những trải nghiệm khám phá trọn vẹn, an toàn và tiết kiệm nhất cho mọi du khách.
                        </p>
                        <div class="d-flex gap-2 mt-4 social-group">
                            <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
                            <a href="#" class="social-icon"><i class="fab fa-youtube"></i></a>
                            <a href="#" class="social-icon"><i class="fab fa-tiktok"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 mb-4">
                        <h6 class="fw-bold mb-4 text-uppercase text-dark letter-spacing">Khám Phá</h6>
                        <ul class="list-unstyled font-14 footer-links">
                            <li><router-link to="/tours/trong-nuoc">Tour Trong Nước</router-link></li>
                            <li><router-link to="/tours/quoc-te">Tour Quốc Tế</router-link></li>
                            <li><router-link to="/khuyen-mai">Ưu Đãi & Khuyến Mãi</router-link></li>
                            <li><router-link to="/cam-nang">Cẩm Nang Du Lịch</router-link></li>
                            <li><router-link to="/blog">Blog Tin Tức</router-link></li>
                        </ul>
                    </div>

                    <div class="col-lg-3 col-md-6 mb-4">
                        <h6 class="fw-bold mb-4 text-uppercase text-dark letter-spacing">Hỗ Trợ Khách Hàng</h6>
                        <ul class="list-unstyled font-14 footer-links">
                            <li><router-link to="/huong-dan-dat-tour">Hướng Dẫn Đặt Tour</router-link></li>
                            <li><router-link to="/chinh-sach-thanh-toan">Chính Sách Thanh Toán</router-link></li>
                            <li><router-link to="/chinh-sach-huy-tour">Quy Định Hủy/Đổi Tour</router-link></li>
                            <li><router-link to="/bao-mat-thong-tin">Bảo Mật Thông Tin</router-link></li>
                            <li><router-link to="/cau-hoi-thuong-gap">Câu Hỏi Thường Gặp (FAQ)</router-link></li>
                        </ul>
                    </div>

                    <div class="col-lg-3 col-md-6 mb-4">
                        <h6 class="fw-bold mb-4 text-uppercase text-dark letter-spacing">Liên Hệ</h6>
                        <ul class="list-unstyled text-muted font-14 contact-list">
                            <li class="d-flex align-items-start">
                                <div class="contact-icon"><i class="fas fa-location-dot"></i></div>
                                <span>123 Nguyễn Văn Linh, Q. Hải Châu, TP. Đà Nẵng</span>
                            </li>
                            <li class="d-flex align-items-center">
                                <div class="contact-icon"><i class="fas fa-phone-volume"></i></div>
                                <span>Hotline: <b class="text-primary-dark">1900.9999</b></span>
                            </li>
                            <li class="d-flex align-items-center">
                                <div class="contact-icon"><i class="fas fa-envelope-open-text"></i></div>
                                <span>contact@vivutour.vn</span>
                            </li>
                            <li class="d-flex align-items-center">
                                <div class="contact-icon"><i class="fas fa-clock"></i></div>
                                <span>Thứ 2 - Chủ Nhật (8:00 - 22:00)</span>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>

        <div class="bottom-footer py-3 bg-light border-top">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-6 text-center text-md-start mb-3 mb-md-0 text-muted font-13">
                        &copy; 2026 <strong class="text-dark">VivuTour</strong>. Thiết kế & Phát triển bởi <span class="text-primary-dark fw-bold">Nhóm 93 CNPM TPM20</span>.
                    </div>
                    <div class="col-md-6 text-center text-md-end payment-methods">
                        <span class="text-muted font-12 me-3">Chấp nhận thanh toán:</span>
                        <i class="fa-brands fa-cc-visa" title="Visa"></i>
                        <i class="fa-brands fa-cc-mastercard" title="Mastercard"></i>
                        <i class="fa-brands fa-cc-paypal" title="PayPal"></i>
                        <i class="fa-brands fa-cc-stripe" title="Stripe"></i>
                        <img src="https://homepage.momocdn.net/fileuploads/svg/momo-file-240411162904.svg" alt="MoMo" class="momo-icon ms-2" title="Ví MoMo">
                    </div>
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
@import url('https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@400;500;600;700&display=swap');

.footer-wrapper {
    font-family: 'Be Vietnam Pro', sans-serif;
    background-color: #fafbfc; /* Màu xám cực nhạt để tách biệt với body */
}

/* ── TYPOGRAPHY & COLORS ── */
.text-primary-dark { color: #0d7a5f !important; }
.bg-primary-dark { background-color: #0d7a5f !important; }
.letter-spacing { letter-spacing: 0.5px; }
.line-height-lg { line-height: 1.7; }

.font-12 { font-size: 12px; }
.font-13 { font-size: 13px; }
.font-14 { font-size: 14px; }

/* ── NÚT BẤM (BUTTONS) ── */
.btn-primary-dark {
    background-color: #0d7a5f;
    color: #fff;
    border: none;
    transition: all 0.3s ease;
}
.btn-primary-dark:hover {
    background-color: #0a5f4a;
    box-shadow: 0 4px 10px rgba(13, 122, 95, 0.3);
}

/* ── NEWSLETTER INPUT ── */
.newsletter-section {
    background-color: #ffffff;
}
.newsletter-input .form-control {
    border-radius: 50px 0 0 50px;
    padding: 12px 20px;
    border: 1px solid #e5e7eb;
    background-color: #f9fafb;
    font-size: 14px;
    box-shadow: none;
}
.newsletter-input .form-control:focus {
    border-color: #0d7a5f;
    background-color: #fff;
}
.newsletter-input .btn {
    border-radius: 0 50px 50px 0;
}

/* ── FOOTER LINKS (Chuyên mục) ── */
.footer-links li {
    margin-bottom: 12px;
}
.footer-links a {
    color: #6b7280;
    text-decoration: none;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
}
.footer-links a::before {
    content: '\f105'; /* Icon FontAwesome mũi tên */
    font-family: 'Font Awesome 6 Free';
    font-weight: 900;
    font-size: 10px;
    margin-right: 8px;
    color: #cbd5e1;
    transition: all 0.3s ease;
}
.footer-links a:hover {
    color: #0d7a5f;
    transform: translateX(5px); /* Trượt nhẹ */
}
.footer-links a:hover::before {
    color: #0d7a5f;
}

/* ── LIÊN HỆ (CONTACT LIST) ── */
.contact-list li {
    margin-bottom: 16px;
    line-height: 1.5;
}
.contact-list .contact-icon {
    width: 28px;
    color: #0d7a5f;
    font-size: 16px;
    display: flex;
    justify-content: flex-start;
    margin-top: 2px;
}

/* ── SOCIAL ICONS ── */
.social-group .social-icon {
    width: 36px;
    height: 36px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 8px; /* Đổi sang vuông bo góc thay vì tròn hẳn cho hiện đại */
    background-color: #ffffff;
    border: 1px solid #e5e7eb;
    color: #4b5563;
    text-decoration: none;
    transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
}
.social-group .social-icon:hover {
    background-color: #0d7a5f;
    border-color: #0d7a5f;
    color: #ffffff;
    transform: translateY(-3px);
    box-shadow: 0 4px 8px rgba(13, 122, 95, 0.25);
}

/* ── ĐÁY FOOTER (THANH TOÁN) ── */
.bottom-footer {
    background-color: #f8fafc !important;
}
.payment-methods i {
    font-size: 28px;
    color: #94a3b8;
    margin: 0 5px;
    vertical-align: middle;
    transition: 0.3s;
    cursor: pointer;
}
.payment-methods i:hover {
    color: #0d7a5f; /* Hover lên màu xanh lá */
}
.momo-icon {
    height: 24px;
    object-fit: contain;
    filter: grayscale(100%);
    opacity: 0.6;
    transition: 0.3s;
    cursor: pointer;
    vertical-align: middle;
}
.momo-icon:hover {
    filter: grayscale(0%);
    opacity: 1;
}

.brand-icon {
    width: 42px;
    height: 42px;
    background-color: #003C71;
    color: #FFBD00;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
    border-radius: 12px 4px 12px 4px; /* Bo góc vát chéo logo */
    box-shadow: 0 4px 10px rgba(0, 60, 113, 0.2);
}
.brand-text {
    line-height: 1;
}
.brand-name {
    font-size: 22px;
    font-weight: 800;
    color: #003C71;
    letter-spacing: 0.5px;
    font-family: 'Be Vietnam Pro', sans-serif;
}
.brand-highlight {
    color: #FFBD00;
}
.brand-slogan {
    font-size: 10px;
    font-weight: 700;
    color: #6c757d;
    letter-spacing: 1.5px;
    text-transform: uppercase;
    margin-top: 2px;
}
/*LOGO*/

.brand-logo-custom {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
}
.brand-icon {
    width: 40px;
    height: 40px;
    background-color: #0d7a5f;
    color: #e8a020;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 22px;
    border-radius: 12px 4px 12px 4px;
    box-shadow: 0 4px 10px rgba(13, 122, 95, 0.2);
}
.brand-text {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    line-height: 1;
}
.brand-name {
    font-size: 26px;
    font-weight: 800;
    color: #0d7a5f;
    letter-spacing: 0.5px;
}
.brand-highlight {
    color: #e8a020;
}
.brand-slogan {
    font-size: 11px;
    font-weight: 700;
    color: #6c757d;
    letter-spacing: 1.5px;
    text-transform: uppercase;
    margin-top: 4px;
}
</style>