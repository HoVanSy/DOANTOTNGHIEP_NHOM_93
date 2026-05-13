<template>
  <div class="request-page py-4">
    <div class="container mt-3">
      <!-- ── SECTION HEADER ── -->
      <div class="section-header mb-4">
        <span class="section-tag">Hỗ trợ khách hàng</span>
        <h2 class="section-title">Yêu Cầu Hủy / Đổi Lịch Tour</h2>
        <div class="header-line"></div>
      </div>

      <!-- ── TRẠNG THÁI CHƯA ĐĂNG NHẬP ── -->
      <div v-if="!isLoggedIn" class="empty-state text-center py-5 rounded-4">
        <div class="icon-box mb-3">
          <i class="fa-solid fa-user-lock fa-2x text-muted"></i>
        </div>
        <h5 class="fw-bold text-dark">Bạn chưa đăng nhập</h5>
        <p class="text-muted small">Vui lòng đăng nhập để thực hiện các yêu cầu thay đổi lịch trình.</p>
        <router-link to="/dang-nhap" class="btn-primary-custom mt-2">Đăng nhập ngay</router-link>
      </div>

      <div v-else class="row g-4">
        <!-- ── CỘT TRÁI: FORM TẠO YÊU CẦU ── -->
        <div class="col-lg-5">
          <div class="request-card rounded-4 p-4 shadow-sm border-0">
            <h5 class="info-label mb-4"><i class="fa-solid fa-pen-to-square me-2"></i>Tạo yêu cầu mới</h5>
            
            <div class="form-group mb-3">
              <label class="form-label-custom">Chọn tour cần thay đổi</label>
              <select v-model="yeuCau.hoa_don_id" class="form-select custom-input" required>
                <option value="">-- Danh sách tour của bạn --</option>
                <option v-for="hd in hoaDonChuaHuy" :key="hd.id" :value="hd.id">
                  {{ hd.chi_tiet_hoa_dons[0]?.tour?.tieu_de || 'Tour #' + hd.id }}
                </option>
              </select>
            </div>

            <div class="form-group mb-3">
              <label class="form-label-custom">Loại yêu cầu</label>
              <div class="d-flex gap-3 mt-1">
                <div class="flex-grow-1">
                  <input type="radio" class="btn-check" name="type" id="huy" value="huy" v-model="yeuCau.loai_yeu_cau">
                  <label class="btn btn-outline-danger btn-sm w-100 rounded-3" for="huy">Hủy Tour</label>
                </div>
                <div class="flex-grow-1">
                  <input type="radio" class="btn-check" name="type" id="doi" value="doi_lich" v-model="yeuCau.loai_yeu_cau">
                  <label class="btn btn-outline-warning btn-sm w-100 rounded-3" for="doi">Đổi Lịch</label>
                </div>
              </div>
            </div>

            <div v-if="yeuCau.loai_yeu_cau === 'doi_lich'" class="form-group mb-3 animate__animated animate__fadeIn">
              <label class="form-label-custom">Ngày khởi hành mong muốn mới</label>
              <input v-model="yeuCau.ngay_khoi_hanh_moi" type="date" class="form-control custom-input">
            </div>

            <div class="form-group mb-4">
              <label class="form-label-custom">Lý do chi tiết</label>
              <textarea v-model="yeuCau.ly_do" class="form-control custom-input" rows="3" required placeholder="Vì sao bạn muốn thay đổi?"></textarea>
            </div>

            <button @click="guiYeuCau" class="btn-book-now w-100">
              <i class="fa-solid fa-paper-plane me-2"></i>Gửi Yêu Cầu
            </button>
          </div>
        </div>

        <!-- ── CỘT PHẢI: LỊCH SỬ YÊU CẦU ── -->
        <div class="col-lg-7">
          <div class="request-card rounded-4 p-4 shadow-sm border-0 h-100">
            <h5 class="info-label mb-4"><i class="fa-solid fa-clock-rotate-left me-2"></i>Lịch sử yêu cầu</h5>
            
            <div class="table-responsive">
              <table class="table table-hover align-middle custom-table">
                <thead>
                  <tr>
                    <th>Loại</th>
                    <th>Ngày đổi</th>
                    <th>Trạng thái</th>
                    <th>Gửi lúc</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(yc, index) in lichSuYeuCau" :key="index">
                    <td>
                      <span v-if="yc.loai_yeu_cau === 'huy'" class="badge-status badge-huy">Hủy tour</span>
                      <span v-else class="badge-status badge-doi">Đổi lịch</span>
                    </td>
                    <td class="small font-weight-600">
                      {{ yc.ngay_khoi_hanh_moi ? formatDate(yc.ngay_khoi_hanh_moi) : 'N/A' }}
                    </td>
                    <td>
                      <span v-if="yc.trang_thai == 0" class="badge-step step-waiting">Đang chờ</span>
                      <span v-else-if="yc.trang_thai == 1" class="badge-step step-success">Đã duyệt</span>
                      <span v-else class="badge-step step-fail">Từ chối</span>
                    </td>
                    <td class="text-muted" style="font-size: 11px;">{{ formatDate(yc.created_at) }}</td>
                  </tr>
                  <tr v-if="lichSuYeuCau.length === 0">
                    <td colspan="4" class="text-center py-4 text-muted small">Chưa có yêu cầu nào được gửi.</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
/* Giữ nguyên toàn bộ logic Script của bạn */
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
      baseRequest.post('client/hoa-don/lay-danh-sach-hoa-don/data')
        .then((res) => {
          const rawData = res.data.danh_sach_hoa_don;
          if (Array.isArray(rawData)) {
            this.hoaDonChuaHuy = rawData.filter(hd => hd.tinh_trang !== 2 && hd.tinh_trang !== 'da_huy');
          } else {
            this.hoaDonChuaHuy = [];
          }
        })
        .catch((err) => console.error("Lỗi API hóa đơn:", err));

      baseRequest.get('client/yeu-cau-huy/lay-danh-sach')
        .then((res) => {
          const rawData = res.data.data;
          if (Array.isArray(rawData)) {
            this.lichSuYeuCau = rawData;
          } else {
            this.lichSuYeuCau = [];
          }
        })
        .catch((err) => console.error("Lỗi API lịch sử:", err));
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
      if(!date) return '';
      return new Date(date).toLocaleDateString('vi-VN');
    }
  }
}
</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@300;400;500;600;700;800&display=swap');

.request-page {
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

/* ── CARDS ── */
.request-card {
  background: #fff;
  border: 1px solid #f0ede8;
}
.info-label {
  font-size: 17px;
  font-weight: 700;
  color: #0d7a5f;
}

/* ── FORMS ── */
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
  padding: 10px;
  font-size: 14px;
  background-color: #f9fafb;
}
.custom-input:focus {
  border-color: #0d7a5f;
  box-shadow: 0 0 0 0.2rem rgba(13, 122, 95, 0.1);
}

/* ── BUTTONS ── */
.btn-book-now {
  background: #0d7a5f;
  color: #fff;
  border: none;
  padding: 12px;
  border-radius: 12px;
  font-weight: 700;
  font-size: 14px;
  transition: 0.3s;
}
.btn-book-now:hover { background: #085544; transform: translateY(-2px); }

.btn-primary-custom {
  display: inline-block;
  background: #0d7a5f;
  color: #fff;
  padding: 8px 24px;
  border-radius: 50px;
  font-weight: 600;
  font-size: 14px;
  text-decoration: none;
}

/* ── TABLE & BADGES ── */
.custom-table thead th {
  background: #f9fafb;
  font-size: 12px;
  text-transform: uppercase;
  color: #6b7280;
  font-weight: 700;
  border-bottom: 2px solid #f0ede8;
}
.badge-status {
  font-size: 10px;
  font-weight: 700;
  padding: 4px 10px;
  border-radius: 50px;
  text-transform: uppercase;
}
.badge-huy { background: #fee2e2; color: #dc2626; }
.badge-doi { background: #fef3c7; color: #d97706; }

.badge-step {
  font-size: 11px;
  font-weight: 600;
  display: inline-block;
}
.step-waiting { color: #d97706; }
.step-success { color: #059669; }
.step-fail { color: #6b7280; }

/* ── EMPTY STATE ── */
.empty-state {
  background: #fff;
  border: 1px dashed #e5e7eb;
}
</style>