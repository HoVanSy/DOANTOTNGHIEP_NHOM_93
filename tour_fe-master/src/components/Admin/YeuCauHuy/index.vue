<template>
  <div class="container-fluid mt-4">
    <div class="card shadow">
      <div class="card-header bg-white text-white d-flex justify-content-between align-items-center">
        <h4 class="mb-0">QUẢN LÝ YÊU CẦU HỦY / ĐỔI LỊCH</h4>
        <button @click="loadData" class="btn btn-sm btn-light">Làm mới</button>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-hover table-bordered align-middle">
            <thead class="table-light text-center">
              <tr>
                <th>STT</th>
                <th>Khách hàng</th>
                <th>Thông tin Tour / HĐ</th>
                <th>Loại Y/C</th>
                <th>Lý do & Ngày mới</th>
                <th>Trạng thái</th>
                <th>Thao tác</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(yc, index) in danhSachYeuCau" :key="yc.id">
                <td class="text-center">{{ index + 1 }}</td>
                
                <td>
                  <strong>{{ yc.khach_hang?.ho_ten || 'N/A' }}</strong><br>
                  <small class="text-muted">{{ yc.khach_hang?.email || '' }}</small><br>
                  <small class="text-muted">{{ yc.khach_hang?.so_dien_thoai || '' }}</small>
                </td>

                <td>
                  Mã HĐ: <strong>{{ yc.hoa_don?.ma_hoa_don ? yc.hoa_don.ma_hoa_don.substring(0,8) : yc.hoa_don_id }}</strong><br>
                  <small class="text-primary">{{ yc.hoa_don?.tour?.tieu_de || 'N/A' }}</small>
                </td>

                <td class="text-center">
                  <span v-if="yc.loai_yeu_cau === 'huy'" class="badge bg-danger">Hủy tour</span>
                  <span v-else class="badge bg-warning text-dark">Đổi lịch</span>
                </td>

                <td>
                  Lý do: <em>{{ yc.ly_do }}</em> <br>
                  <span v-if="yc.loai_yeu_cau === 'doi_lich'" class="text-success">
                    Ngày mới: <strong>{{ formatDate(yc.ngay_khoi_hanh_moi) }}</strong>
                  </span>
                </td>

                <td class="text-center">
                  <span v-if="yc.trang_thai === 0" class="badge bg-secondary">Chờ xử lý</span>
                  <span v-else-if="yc.trang_thai === 1" class="badge bg-success">Đã duyệt</span>
                  <span v-else-if="yc.trang_thai === 2" class="badge bg-danger">Từ chối</span>
                </td>

                <td class="text-center">
                  <div v-if="yc.trang_thai === 0" class="btn-group">
                    <button @click="xulyYeuCau(yc, 'duyet')" class="btn btn-sm btn-success">
                      ✔ Duyệt
                    </button>
                    <button @click="xulyYeuCau(yc, 'tu_choi')" class="btn btn-sm btn-outline-danger">
                      ✖ Từ chối
                    </button>
                  </div>
                  <div v-else>
                    <small class="text-muted">Ghi chú: {{ yc.ghi_chu || 'Không có' }}</small>
                  </div>
                </td>
              </tr>
              <tr v-if="danhSachYeuCau.length === 0">
                <td colspan="7" class="text-center text-muted py-4">Hiện không có yêu cầu nào.</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import baseRequest from '../../../core/baseRequestClient.js'; 

export default {
  name: 'QuanLyYeuCau',
  data() {
    return {
      danhSachYeuCau: []
    }
  },
  mounted() {
    this.loadData();
  },
  methods: {
    loadData() {
      // Gọi API lấy dữ liệu dành cho Admin
      baseRequest.get('admin/yeu-cau-huy/lay-du-lieu')
        .then(res => {
          if(res.data.status) {
            this.danhSachYeuCau = res.data.data;
          }
        })
        .catch(err => {
          console.error('Lỗi tải dữ liệu:', err);
          alert('Không thể tải danh sách yêu cầu!');
        });
    },

    xulyYeuCau(yc, action) {
      // Bật hộp thoại nhập ghi chú (Lý do duyệt/từ chối)
      const ghiChu = prompt(`Nhập ghi chú cho việc ${action === 'duyet' ? 'DUYỆT' : 'TỪ CHỐI'} yêu cầu này:`, '');
      
      if (ghiChu === null) return; // Người dùng bấm Cancel

      const endpoint = action === 'duyet' ? 'admin/yeu-cau-huy/duyet' : 'admin/yeu-cau-huy/tu-choi';
      
      baseRequest.post(endpoint, {
        id: yc.id,
        ghi_chu: ghiChu
      })
      .then(res => {
        if(res.data.status) {
          alert(res.data.message);
          this.loadData(); // Tải lại bảng sau khi thao tác thành công
        }
      })
      .catch(err => {
        alert('Có lỗi xảy ra, vui lòng thử lại!');
        console.error(err);
      });
    },

    formatDate(dateStr) {
      if (!dateStr) return '';
      return new Date(dateStr).toLocaleDateString('vi-VN');
    }
  }
}
</script>