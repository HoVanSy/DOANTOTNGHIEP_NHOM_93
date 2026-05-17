<template>
  <div class="login-wrapper min-vh-100 d-flex align-items-center justify-content-center">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-11 col-md-8 col-lg-5 col-xl-4">
          
          <div class="text-center mb-4">
            <div class="brand-logo-custom">
              <i class="fa-solid fa-plane-departure brand-icon"></i>
              <div class="brand-text">
                <span class="brand-name">VIVU <span class="brand-highlight">TOUR</span></span>
              </div>
            </div>
          </div>

          <div class="card login-card border-0 shadow-lg rounded-4 p-4 p-md-5">
            <h4 class="fw-bold text-dark text-center mb-1">Khôi phục mật khẩu</h4>
            <p class="text-muted small text-center mb-4">
              {{ step === 1 ? 'Vui lòng nhập email đã đăng ký.' : (step === 2 ? 'Nhập mã 6 số được gửi về email của bạn.' : 'Tạo mật khẩu mới an toàn.') }}
            </p>

            <form v-if="step === 1" @submit.prevent="guiOTP">
              <label class="form-label-custom">Email của bạn</label>
              <input v-model="form.email" type="email" class="form-control custom-input mb-4" placeholder="Ví dụ: name@gmail.com" required>
              <button type="submit" class="btn btn-login w-100 rounded-pill py-2 fw-bold" :disabled="isLoading">
                <span v-if="isLoading" class="spinner-border spinner-border-sm me-2"></span>
                GỬI MÃ XÁC NHẬN
              </button>
            </form>

            <form v-if="step === 2" @submit.prevent="xacThucOTP">
              <label class="form-label-custom">Mã OTP (6 chữ số)</label>
              <input v-model="form.otp" type="text" class="form-control custom-input mb-4 text-center fs-4 letter-spacing-5" maxlength="6" required>
              <button type="submit" class="btn btn-login w-100 rounded-pill py-2 fw-bold" :disabled="isLoading">
                XÁC NHẬN MÃ
              </button>
              <div class="text-center mt-3">
                <span @click="step = 1" class="text-primary font-13 cursor-pointer"><i class="fa-solid fa-arrow-left me-1"></i> Quay lại sửa Email</span>
              </div>
            </form>

            <form v-if="step === 3" @submit.prevent="doiMatKhau">
              <label class="form-label-custom">Mật khẩu mới</label>
              <input v-model="form.password_new" type="password" class="form-control custom-input mb-3" placeholder="Nhập mật khẩu mới" required>
              
              <label class="form-label-custom">Nhập lại mật khẩu</label>
              <input v-model="form.password_confirm" type="password" class="form-control custom-input mb-4" placeholder="Xác nhận mật khẩu" required>
              
              <button type="submit" class="btn btn-success w-100 rounded-pill py-2 fw-bold" :disabled="isLoading">
                LƯU MẬT KHẨU MỚI
              </button>
            </form>

            <div class="text-center mt-4">
              <router-link to="/client/dang-nhap" class="text-muted font-14 text-decoration-none hover-text-primary">
                Trở về trang Đăng nhập
              </router-link>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';
import { createToaster } from "@meforma/vue-toaster";
const toaster = createToaster({ position: "top-right" });

export default {
  data() {
    return {
      step: 1, // 1: Email, 2: OTP, 3: Đổi Pass
      isLoading: false,
      form: {
        email: '',
        otp: '',
        password_new: '',
        password_confirm: ''
      }
    }
  },
  methods: {
    guiOTP() {
      this.isLoading = true;
      axios.post('http://127.0.0.1:8000/api/account-client/gui-otp', { email: this.form.email })
        .then((res) => {
          if (res.data.status) {
            toaster.success(res.data.message);
            this.step = 2; // Chuyển sang form nhập OTP
          } else {
            toaster.error(res.data.message);
          }
        })
        .finally(() => this.isLoading = false);
    },
    
    xacThucOTP() {
      this.isLoading = true;
      axios.post('http://127.0.0.1:8000/api/account-client/xac-thuc-otp', { email: this.form.email, otp: this.form.otp })
        .then((res) => {
          if (res.data.status) {
            toaster.success(res.data.message);
            this.step = 3; // Chuyển sang form Đổi pass
          } else {
            toaster.error(res.data.message);
          }
        })
        .finally(() => this.isLoading = false);
    },

    doiMatKhau() {
      if (this.form.password_new !== this.form.password_confirm) {
        toaster.error('Mật khẩu xác nhận không khớp!');
        return;
      }
      this.isLoading = true;
      axios.post('http://127.0.0.1:8000/api/account-client/tao-mat-khau-moi', this.form)
        .then((res) => {
          if (res.data.status) {
            toaster.success(res.data.message);
            this.$router.push('/client/dang-nhap');
          } else {
            toaster.error(res.data.message);
          }
        })
        .finally(() => this.isLoading = false);
    }
  }
}
</script>

<style scoped>
.letter-spacing-5 { letter-spacing: 5px; }
.cursor-pointer { cursor: pointer; }
.hover-text-primary:hover { color: #0d7a5f !important; }
.login-wrapper {
    font-family: 'Be Vietnam Pro', sans-serif;
    background-color: #f8f7f4;
    background-image: radial-gradient(#e6f5f0 1px, transparent 1px);
    background-size: 20px 20px;
    position: relative;
}

/* ── PROGRESS BAR ── */
.pace-custom {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 4px;
    background: linear-gradient(90deg, #0d7a5f, #e8a020);
    animation: loadingBar 1.5s ease-in-out forwards;
}
@keyframes loadingBar {
    0% { width: 0%; opacity: 1; }
    90% { width: 100%; opacity: 1; }
    100% { width: 100%; opacity: 0; }
}

/* ── LOGO CUSTOM ── */
.brand-logo-custom {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
}
.brand-icon {
    width: 45px;
    height: 45px;
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

/* ── CARD & FORM ── */
.login-card {
    border-radius: 20px;
}
.form-label-custom {
    font-size: 13px;
    font-weight: 700;
    color: #1a1f2e;
    margin-bottom: 8px;
    display: block;
}

.input-group-custom {
    position: relative;
    display: flex;
    align-items: center;
}
.input-icon {
    position: absolute;
    left: 16px;
    color: #9ca3af;
    font-size: 14px;
    z-index: 10;
}
.custom-input {
    border-radius: 12px;
    border: 1px solid #e5e7eb;
    padding: 12px 12px 12px 42px;
    font-size: 14px;
    font-weight: 500;
    background-color: #f9fafb;
    transition: all 0.2s;
}
.custom-input:focus {
    background-color: #fff;
    border-color: #0d7a5f;
    box-shadow: 0 0 0 4px rgba(13, 122, 95, 0.1);
    outline: none;
}

/* ── Checkbox ── */
.form-check-input:checked {
    background-color: #0d7a5f;
    border-color: #0d7a5f;
}
.form-check-input:focus {
    box-shadow: 0 0 0 0.25rem rgba(13, 122, 95, 0.25);
}

/* ── LINKS ── */
.forgot-link {
    color: #0d7a5f;
    transition: 0.2s;
}
.forgot-link:hover {
    color: #e8a020;
}
.register-link {
    color: #e8a020;
    text-decoration: none;
    transition: 0.2s;
}
.register-link:hover {
    color: #0d7a5f;
}

/* ── BUTTONS ── */
.btn-login {
    background-color: #0d7a5f;
    color: #fff;
    font-size: 15px;
    transition: all 0.3s;
    border: none;
}
.btn-login:hover {
    background-color: #085544;
    transform: translateY(-2px);
    box-shadow: 0 8px 15px rgba(13, 122, 95, 0.2) !important;
}

/* CSS cho Nút Google */
.btn-google {
    background-color: #fff;
    color: #3c4043;
    border: 1px solid #dadce0;
    font-size: 14px;
    transition: all 0.2s ease-in-out;
}
.btn-google:hover {
    background-color: #f8f9fa;
    border-color: #d2e3fc;
    box-shadow: 0 1px 2px 0 rgba(60,64,67,0.3), 0 1px 3px 1px rgba(60,64,67,0.15) !important;
    transform: translateY(-1px);
}
.google-icon {
    width: 20px;
    height: 20px;
}

/* ── LINE SEPARATOR ── */
.login-separator {
    position: relative;
    text-align: center;
}
.login-separator::before {
    content: '';
    position: absolute;
    top: 50%;
    left: 0;
    right: 0;
    height: 1px;
    background-color: #e5e7eb;
    z-index: 1;
}
.login-separator span {
    position: relative;
    z-index: 2;
}

.font-13 { font-size: 13px; }
.font-14 { font-size: 14px; }
</style>