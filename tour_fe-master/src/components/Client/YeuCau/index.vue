<template>
  <div class="container mt-5">
    <h2 class="mb-4">YÊU CẦU HỦY / ĐỔI LỊCH TOUR</h2>

    <div v-if="!isLoggedIn" class="text-center py-5">
      <h4 class="text-muted">Vui lòng đăng nhập</h4>
      <router-link to="/dang-nhap" class="btn btn-primary mt-3">Đăng nhập</router-link>
    </div>

    <div v-else>
      <!-- Form tao yeu cau -->
      <div class="card mb-4">
        <div class="card-header bg-primary text-white">
          <h5 class="mb-0">TẠO YÊU CẦU MỚI</h5>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-6 mb-3">
              <label class="form-label">Chọn hóa đơn</label>
              <select v-model="yeuCau.hoa_don_id" class="form-control" required>
                <option value="">-- Chọn hóa đơn --</option>
                <option v-for="hd in hoaDonChuaHuy" :key="hd.id" :value="hd.id">
                  {{ hd.ma_hoa_don }} - {{ hd.tour?.tieu_de }}
                </option>
              </select>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">Loại yêu cầu</label>
              <select v-model="yeuCau.loai_yeu_cau" class="form-control" required>
                <option value="huy">Hủy tour</option>
                <option value="doi_lich">Đổi lịch</option>
              </select>
            </div>
            <div v-if="yeuCau.loai_yeu_cau === 'doi_lich'" class="col-md-6 mb-3">
              <label class="form-label">Ngày khởi hành mới</label>
              <input v-model="yeuCau.ngay_khoi_hanh_moi" type="date" class="form-control">
            </div>
            <div class="col-12 mb-3">
              <label class="form-label">Lý do</label>
              <textarea v-model="yeuCau.ly_do" class="form-control" rows="3" required placeholder="Nhập lý do yêu cầu..."></textarea>
            </div>
          </div>
          <button @click="guiYeuCau" class="btn btn-primary">
            <i class="fa-solid fa-paper-plane"></i> Gửi yêu cầu
          </button>
        </div>
      </div>

      <!-- Lich su yeu cau -->
      <h4 class="mb-3">LỊCH SỬ YÊU CẦU</h4>
      <div class="table-responsive">
        <table class="table table-bordered">
          <thead class="table-dark">
            <tr>
              <th>STT</th>
              <th>Loại</th>
              <th>Lý do</th>
              <th>Ngày mới</th>
              <th>Trạng thái</th>
              <th>Ghi chú</th>
              <th>Ngày gửi</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(yc, index) in lichSuYeuCau" :key="index">
              <td>{{ index + 1 }}</td>
              <td>
                <span v-if="yc.loai_yeu_cau === 'huy'" class="badge bg-danger">Hủy tour</span>
                <span v-else class="badge bg-warning">Đổi lịch</span>
              </td>
              <td>{{ yc.ly_do }}</td>
              <td>{{ yc.ngay_khoi_hanh_moi ? formatDate(yc.ngay_khoi_hanh_moi) : '-' }}</td>
              <td>
                <span v-if="yc.trang_thai === 'cho_xu_ly'" class="badge bg-warning">Chờ xử lý</span>
                <span v-else-if="yc.trang_thai === 'da_duyet'" class="badge bg-success">Đã duyệt</span>
                <span v-else class="badge bg-secondary">Từ chối</span>
              </td>
              <td>{{ yc.ghi_chu || '-' }}</td>
              <td>{{ formatDate(yc.created_at) }}</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>

<script>
import baseRequest from "../../../core/baseRequestClient";

export default {
  data() {
    return {
      lichSuYeuCau: [],
      hoaDonChuaHuy: [],
      yeuCau: {
        hoa_don_id: '',
        loai_yeu_cau: 'huy',
        ly_do: '',
        ngay_khoi_hanh_moi: ''
      }
    }
  },
  computed: {
    isLoggedIn() {
      return !!localStorage.getItem('token_client');
    }
  },
  mounted() {
    if (this.isLoggedIn) {
      this.loadData();
    }
  },
  methods: {
    loadData() {
      // Load hoa don
      baseRequest.get('client/hoa-don/lay-danh-sach')
        .then((res) => {
          if (res.data.status) {
            this.hoaDonChuaHuy = res.data.data.filter(hd => hd.trang_thai !== 'da_huy');
          }
        });
      // Load lich su yeu cau
      baseRequest.get('client/yeu-cau-huy/lay-danh-sach')
        .then((res) => {
          if (res.data.status) {
            this.lichSuYeuCau = res.data.data;
          }
        });
    },
    guiYeuCau() {
      if (!this.yeuCau.hoa_don_id || !this.yeuCau.ly_do) {
        alert('Vui lòng điền đầy đủ thông tin!');
        return;
      }
      baseRequest.post('client/yeu-cau-huy/tao', this.yeuCau)
        .then((res) => {
          if (res.data.status) {
            alert('Gửi yêu cầu thành công!');
            this.yeuCau = { hoa_don_id: '', loai_yeu_cau: 'huy', ly_do: '', ngay_khoi_hanh_moi: '' };
            this.loadData();
          } else {
            alert('Có lỗi xảy ra!');
          }
        });
    },
    formatDate(date) {
      return new Date(date).toLocaleDateString('vi-VN');
    }
  }
}
</script>
