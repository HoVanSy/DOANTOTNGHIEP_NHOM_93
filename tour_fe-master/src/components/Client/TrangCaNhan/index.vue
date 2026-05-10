<template>
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <div class="card shadow-sm">
          <div class="card-header bg-white border-bottom">
            <h4 class="mb-0">Trang cá nhân</h4>
          </div>
          <div class="card-body">
            <form @submit.prevent="saveProfile">
              <div class="mb-3">
                <label class="form-label">Họ và tên</label>
                <input v-model="profile.ho_ten" type="text" class="form-control" required />
              </div>
              <div class="mb-3">
                <label class="form-label">Email</label>
                <input v-model="profile.email" type="email" class="form-control" required />
              </div>
              <div class="mb-3">
                <label class="form-label">Số điện thoại</label>
                <input v-model="profile.so_dien_thoai" type="text" class="form-control" />
              </div>
              <div class="mb-3">
                <label class="form-label">Địa chỉ</label>
                <input v-model="profile.dia_chi" type="text" class="form-control" />
              </div>
              <div class="row">
                <div class="col-md-6 mb-3">
                  <label class="form-label">Ngày sinh</label>
                  <input v-model="profile.ngay_sinh" type="date" class="form-control" />
                </div>
                <div class="col-md-6 mb-3">
                  <label class="form-label">Giới tính</label>
                  <select v-model.number="profile.gioi_tinh" class="form-select">
                    <option :value="null">Chọn giới tính</option>
                    <option :value="0">Nam</option>
                    <option :value="1">Nữ</option>
                    <option :value="2">Khác</option>
                  </select>
                </div>
              </div>
              <div class="d-flex justify-content-between align-items-center mt-4">
                <button type="submit" class="btn btn-primary">Lưu thông tin</button>
                <button type="button" class="btn btn-outline-secondary" @click="cancelEdit">Hủy</button>
              </div>
            </form>
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
        gioi_tinh: ''
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
      }
    }
  }
};
</script>

<style scoped>
.card {
  border: none;
}
.form-label {
  font-weight: 500;
}
</style>
