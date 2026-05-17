<template>
  <div class="profile-page py-4">
    <div class="container mt-3">
      <div class="row justify-content-center">
        <div class="col-lg-7">
          <!-- ── SECTION HEADER ── -->
          <div class="section-header mb-4">
            <span class="section-tag">Quản lý tài khoản</span>
            <h2 class="section-title">Hồ Sơ Cá Nhân</h2>
          </div>
          
          <!-- ── PROFILE CARD ── -->
          <div class="profile-card shadow-sm border-0 bg-white overflow-hidden animate__animated animate__fadeIn">
            <div class="card-accent"></div>
            <div class="p-4 p-md-5">
              <form @submit.prevent="saveProfile">
                <div class="row g-3">
                  <!-- Họ và tên -->
                  <div class="col-12 mb-2">
                    <label class="form-label-custom">Họ và tên</label>
                    <div class="input-group-custom">
                      <i class="fa-solid fa-user"></i>
                      <input v-model="profile.ho_ten" type="text" class="form-control custom-input" placeholder="Nhập họ tên của bạn" required />
                    </div>
                  </div>

                  <!-- Email -->
                  <div class="col-12 mb-2">
                    <label class="form-label-custom">Địa chỉ Email</label>
                    <div class="input-group-custom">
                      <i class="fa-solid fa-envelope"></i>
                      <input v-model="profile.email" type="email" class="form-control custom-input" placeholder="name@example.com" required />
                    </div>
                  </div>

                  <!-- Số điện thoại -->
                  <div class="col-md-6 mb-2">
                    <label class="form-label-custom">Số điện thoại</label>
                    <div class="input-group-custom">
                      <i class="fa-solid fa-phone"></i>
                      <input v-model="profile.so_dien_thoai" type="text" class="form-control custom-input" placeholder="0123 456 789" />
                    </div>
                  </div>

                  <!-- Ngày sinh -->
                  <div class="col-md-6 mb-2">
                    <label class="form-label-custom">Ngày sinh</label>
                    <div class="input-group-custom">
                      <i class="fa-solid fa-calendar-day"></i>
                      <input v-model="profile.ngay_sinh" type="date" class="form-control custom-input" />
                    </div>
                  </div>

                  <!-- Địa chỉ -->
                  <div class="col-12 mb-2">
                    <label class="form-label-custom">Địa chỉ cư trú</label>
                    <div class="input-group-custom">
                      <i class="fa-solid fa-location-dot"></i>
                      <input v-model="profile.dia_chi" type="text" class="form-control custom-input" placeholder="Số nhà, tên đường, quận/huyện..." />
                    </div>
                  </div>

                  <!-- Giới tính -->
                  <div class="col-12 mb-4">
                    <label class="form-label-custom">Giới tính</label>
                    <div class="gender-selector d-flex gap-2">
                      <div class="gender-option">
                        <input type="radio" v-model.number="profile.gioi_tinh" :value="0" id="male" class="gender-input" />
                        <label for="male" class="gender-label">Nam</label>
                      </div>
                      <div class="gender-option">
                        <input type="radio" v-model.number="profile.gioi_tinh" :value="1" id="female" class="gender-input" />
                        <label for="female" class="gender-label">Nữ</label>
                      </div>
                      <div class="gender-option">
                        <input type="radio" v-model.number="profile.gioi_tinh" :value="2" id="other" class="gender-input" />
                        <label for="other" class="gender-label">Khác</label>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Action Buttons -->
                <div class="d-flex justify-content-between align-items-center pt-3 border-top mt-2">
                  <button type="button" class="btn-cancel" @click="cancelEdit">
                    <i class="fa-solid fa-rotate-left me-2"></i>Hủy thay đổi
                  </button>
                  <button type="submit" class="btn-save shadow-sm">
                    <i class="fa-solid fa-cloud-arrow-up me-2"></i>Cập nhật hồ sơ
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import baseRequest from '../../../core/baseRequestClient';
import { createToaster } from '@meforma/vue-toaster';
const toaster = createToaster({ position: 'top-right' });

export default {
  data() {
    return {
      profile: {
        id: null,
        ho_ten: '',
        email: '',
        so_dien_thoai: '',
        dia_chi: '',
        ngay_sinh: '',
        gioi_tinh: null
      },
      originalProfile: null
    };
  },
  mounted() {
    this.loadProfile();
  },
  methods: {
    loadProfile() {
      const token = localStorage.getItem('token_client');
      if (!token) {
        toaster.warning('Bạn cần đăng nhập trước khi vào trang cá nhân.');
        return this.$router.push('/client/dang-nhap');
      }

      baseRequest.get('account-client/profile')
        .then((res) => {
          if (res.data.status) {
            this.profile = { ...res.data.data };
            this.originalProfile = JSON.parse(JSON.stringify(this.profile));
          } else {
            toaster.warning('Không thể tải thông tin cá nhân.');
            this.$router.push('/client/dang-nhap');
          }
        })
        .catch(() => {
          toaster.warning('Phiên đăng nhập không hợp lệ. Vui lòng đăng nhập lại.');
          this.$router.push('/client/dang-nhap');
        });
    },
    saveProfile() {
      baseRequest.post('account-client/update-profile', this.profile)
        .then((res) => {
          if (res.data.status) {
            toaster.success(res.data.message);
            localStorage.setItem('ho_ten_client', this.profile.ho_ten);
            this.originalProfile = JSON.parse(JSON.stringify(this.profile));
          } else {
            toaster.error(res.data.message || 'Cập nhật thất bại.');
          }
        })
        .catch((error) => {
          const message = error.response?.data?.message || 'Lỗi khi lưu thông tin cá nhân.';
          toaster.error(message);
        });
    },
    cancelEdit() {
      if (this.originalProfile) {
        this.profile = JSON.parse(JSON.stringify(this.originalProfile));
        toaster.info('Đã khôi phục dữ liệu ban đầu.');
      }
    }
  }
};
</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@300;400;500;600;700;800&display=swap');

.profile-page {
  font-family: 'Be Vietnam Pro', sans-serif;
  background: #f8f7f4;
  min-height: 90vh;
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

/* ── CARD ── */
.profile-card {
  position: relative;
  border: 1px solid #f0ede8 !important;
}
.card-accent {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  height: 4px;
  background: #0d7a5f;
}

/* ── FORM ── */
.form-label-custom {
  font-size: 13px;
  font-weight: 700;
  color: #1a1f2e;
  margin-bottom: 6px;
  display: block;
}

.input-group-custom {
  position: relative;
  display: flex;
  align-items: center;
}
.input-group-custom i {
  position: absolute;
  left: 14px;
  color: #9ca3af;
  font-size: 14px;
}
.custom-input {
  border-radius: 10px;
  border: 1px solid #e5e7eb;
  padding: 10px 10px 10px 40px;
  font-size: 14px;
  background-color: #f9fafb;
  transition: all 0.2s;
}
.custom-input:focus {
  background-color: #fff;
  border-color: #0d7a5f;
  box-shadow: 0 0 0 4px rgba(13, 122, 95, 0.05);
}

/* ── GENDER SELECTOR ── */
.gender-option {
  flex: 1;
}
.gender-input {
  display: none;
}
.gender-label {
  display: block;
  text-align: center;
  padding: 8px;
  background: #f9fafb;
  border: 1px solid #e5e7eb;
  border-radius: 8px;
  font-size: 13px;
  font-weight: 600;
  color: #6b7280;
  cursor: pointer;
  transition: all 0.2s;
}
.gender-input:checked + .gender-label {
  background: #0d7a5f;
  color: #fff;
  border-color: #0d7a5f;
}

/* ── BUTTONS ── */
.btn-save {
  background: #0d7a5f;
  color: #fff;
  border: none;
  padding: 10px 24px;
  border-radius: 50px;
  font-weight: 700;
  font-size: 14px;
  transition: all 0.3s;
}
.btn-save:hover {
  background: #085544;
  transform: translateY(-2px);
}

.btn-cancel {
  background: transparent;
  color: #6b7280;
  border: none;
  font-weight: 600;
  font-size: 13px;
  transition: color 0.2s;
}
.btn-cancel:hover {
  color: #dc3545;
}
</style>