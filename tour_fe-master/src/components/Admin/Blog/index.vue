<template>
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <div class="row align-items-center">
            <div class="col-lg-12 text-center">
              <button style="width: 50%" class="btn btn-primary mb-3 mb-lg-0" data-bs-toggle="modal" data-bs-target="#blogModal" @click="showModal('create')">
                <i class="fa-solid fa-plus me-2"></i>Thêm Blog Mới
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-12">
      <div class="card">
        <div style="max-height: 100px" class="card-header">
          <h5 class="text-center text-dar k">Danh Sách Blog</h5>
          <div class="input-group mb-3">
            <input v-model="key_search" type="text" class="form-control search-control" placeholder="Nhập thông tin cần tìm" @keyup.enter="searchBlog()"/>
            <button @click="searchBlog()" class="btn btn-primary">
              <i class="fa-solid fa-magnifying-glass"></i>
            </button>
          </div>
        </div>
        <div class="card-body">
          <div class="table-responsive" style="max-height: 280px">
            <table class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th class="align-middle text-center">#</th>
                  <th class="align-middle text-center">Tiêu Đề</th>
                  <th class="align-middle text-center">Hình Ảnh</th>
                  <th class="align-middle text-center">Tác Giả</th>
                  <th class="align-middle text-center">Nội Dung</th>
                  <th class="align-middle text-center">Trạng Thái</th>
                  <th class="align-middle text-center">Hành Động</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(blog, index) in filteredList" :key="index">
                  <td class="align-middle text-center">{{ index + 1 }}</td>
                  <td class="align-middle">{{ blog.tieu_de }}</td>
                  <td class="align-middle text-center">
                    <img :src="blog.hinh_anh" alt="" class="form-control" style="max-width: 80px; height: auto;">
                  </td>
                  <td class="align-middle text-center">{{ blog.tac_gia || 'Admin' }}</td>
                  <td class="align-middle text-center">
                    <i class="fa-solid fa-notes-medical fa-2x text-info" @click="viewContent(blog)" data-bs-toggle="modal" data-bs-target="#contentModal" style="cursor: pointer;"></i>
                  </td>
                  <td class="align-middle text-center">
                    <button v-if="blog.tinh_trang == 1" @click="toggleStatus(blog)" class="btn btn-success btn-sm">
                      Hiển thị
                    </button>
                    <button v-else @click="toggleStatus(blog)" class="btn btn-warning btn-sm">
                      Ẩn
                    </button>
                  </td>
                  <td class="align-middle text-center">
                    <button @click="editBlog(blog)" class="btn btn-info btn-sm me-2" data-bs-toggle="modal" data-bs-target="#blogModal">
                      Cập Nhật
                    </button>
                    <button @click="id_can_xoa = blog.id" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#xoaModal">
                      Xóa
                    </button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Thêm/Sửa Blog -->
  <div class="modal fade" id="blogModal" tabindex="-1" aria-labelledby="blogModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="blogModalLabel">{{ modalTitle }}</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-lg-8">
              <div class="mt-2 me-2">
                <label>Tiêu Đề <span class="text-danger">*</span></label>
                <input v-model="blog.tieu_de" type="text" class="form-control" placeholder="Nhập tiêu đề bài viết..."/>
              </div>
            </div>
            <div class="col-lg-4">
              <div class="mt-2 me-2">
                <label>Tác Giả</label>
                <input v-model="blog.tac_gia" type="text" class="form-control" placeholder="Tên tác giả"/>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12">
              <div class="mt-2 me-2">
                <label>Link Hình Ảnh</label>
                <input v-model="blog.hinh_anh" type="text" class="form-control" placeholder="https://..."/>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12">
              <div class="mt-2 me-2">
                <label>Nội Dung</label>
                <textarea v-model="blog.noi_dung" class="form-control" rows="8" placeholder="Nhập nội dung bài viết..."></textarea>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-6">
              <div class="mt-2 me-2">
                <label>Trạng Thái</label>
                <select v-model="blog.tinh_trang" class="form-control">
                  <option :value="1">Hiển thị</option>
                  <option :value="0">Ẩn</option>
                </select>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
            Hủy
          </button>
          <button @click="saveBlog" type="button" class="btn btn-primary">
            {{ blog.id ? 'Cập Nhật' : 'Thêm Mới' }}
          </button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Xem Nội Dung -->
  <div class="modal fade" id="contentModal" tabindex="-1" aria-labelledby="contentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="contentModalLabel">Nội Dung Bài Viết</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <textarea class="form-control" rows="10" v-model="currentContent" readonly></textarea>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
            Đóng
          </button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Xác Nhận Xóa -->
  <div class="modal fade" id="xoaModal" tabindex="-1" aria-labelledby="xoaModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="xoaModalLabel">Xác Nhận Xóa</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          Bạn có chắc chắn muốn xóa bài viết này không?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
            Hủy
          </button>
          <button @click="confirmDelete" type="button" class="btn btn-danger" data-bs-dismiss="modal">
            Xóa
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import baseRequest from "../../../core/baseRequest";
import { createToaster } from "@meforma/vue-toaster";

const toaster = createToaster({ position: "top-right" });

export default {
  data() {
    return {
      list_blog: [],
      blog: {
        id: null,
        tieu_de: '',
        hinh_anh: '',
        noi_dung: '',
        tac_gia: '',
        tinh_trang: 1
      },
      modalTitle: 'Thêm Blog mới',
      id_can_xoa: null,
      key_search: '',
      currentContent: ''
    }
  },
  computed: {
    filteredList() {
      if (!this.key_search) {
        return this.list_blog;
      }
      return this.list_blog.filter(blog => 
        blog.tieu_de.toLowerCase().includes(this.key_search.toLowerCase()) ||
        blog.tac_gia?.toLowerCase().includes(this.key_search.toLowerCase())
      );
    }
  },
  mounted() {
    this.loadData();
  },
  methods: {
    loadData() {
      baseRequest.get('admin/blog/lay-du-lieu')
        .then((res) => {
          if (res.data.status) {
            this.list_blog = res.data.data;
          } else {
            toaster.error('Không có dữ liệu: ' + (res.data.message || 'Lỗi không xác định'));
            console.error('API Error:', res.data);
          }
        })
        .catch((error) => {
          toaster.error('Lỗi tải dữ liệu!');
          console.error('Request Error:', error);
        });
    },
    showModal(action, blog = null) {
      if (action === 'create') {
        this.modalTitle = 'Thêm Blog Mới';
        this.blog = { id: null, tieu_de: '', hinh_anh: '', noi_dung: '', tac_gia: '', tinh_trang: 1 };
      } else {
        this.modalTitle = 'Cập Nhật Blog';
        this.blog = { ...blog };
      }
    },
    editBlog(blog) {
      this.showModal('edit', blog);
    },
    saveBlog() {
      if (!this.blog.tieu_de) {
        toaster.error("Vui lòng nhập tiêu đề!");
        return;
      }
      
      if (this.blog.id) {
        baseRequest.post('admin/blog/cap-nhat', this.blog)
          .then((res) => {
            if (res.data.status) {
              toaster.success('Cập nhật thành công!');
              this.loadData();
              const modal = bootstrap.Modal.getInstance(document.getElementById('blogModal'));
              modal?.hide();
            } else {
              toaster.error(res.data.message || 'Cập nhật thất bại');
            }
          })
          .catch(() => {
            toaster.error('Lỗi cập nhật bài viết!');
          });
      } else {
        baseRequest.post('admin/blog/them-moi', this.blog)
          .then((res) => {
            if (res.data.status) {
              toaster.success('Thêm thành công!');
              this.loadData();
              const modal = bootstrap.Modal.getInstance(document.getElementById('blogModal'));
              modal?.hide();
            } else {
              toaster.error(res.data.message || 'Thêm thất bại');
            }
          })
          .catch(() => {
            toaster.error('Lỗi thêm bài viết!');
          });
      }
    },
    viewContent(blog) {
      this.currentContent = blog.noi_dung;
    },
    toggleStatus(blog) {
      blog.tinh_trang = blog.tinh_trang == 1 ? 0 : 1;
      baseRequest.post('admin/blog/cap-nhat', blog)
        .then((res) => {
          if (res.data.status) {
            toaster.success(blog.tinh_trang == 1 ? 'Hiển thị bài viết' : 'Ẩn bài viết');
            this.loadData();
          } else {
            toaster.error('Thay đổi trạng thái thất bại');
          }
        });
    },
    confirmDelete() {
      if (this.id_can_xoa) {
        baseRequest.delete('admin/blog/xoa/' + this.id_can_xoa)
          .then((res) => {
            if (res.data.status) {
              toaster.success('Xóa thành công!');
              this.loadData();
            } else {
              toaster.error(res.data.message || 'Xóa thất bại');
            }
          })
          .catch(() => {
            toaster.error('Lỗi xóa bài viết!');
          });
      }
    },
    searchBlog() {
      // Search is handled by computed property 'filteredList'
    }
  }
}
</script>

<style scoped>
/* Remove custom blog styles and use standard Bootstrap layout */
.row {
  margin-bottom: 20px;
}

.card {
  border: 1px solid #dee2e6;
  border-radius: 0.25rem;
  margin-bottom: 1.5rem;
}

.card-header {
  background-color: #f8f9fa;
  border-bottom: 1px solid #dee2e6;
  padding: 1rem;
}

.card-body {
  padding: 1.5rem;
}

.card-header h5 {
  margin-bottom: 1rem;
  font-weight: 600;
}

.table-responsive {
  overflow-y: auto;
}

.table {
  font-size: 0.9375rem;
}

.table thead th {
  background-color: #f8f9fa;
  border: 1px solid #dee2e6;
  font-weight: 600;
  padding: 1rem;
  vertical-align: middle;
}

.table tbody td {
  border: 1px solid #dee2e6;
  padding: 1rem;
  vertical-align: middle;
}

.table tbody tr:hover {
  background-color: #f8f9fa;
}

.btn {
  border-radius: 0.25rem;
  font-size: 0.875rem;
}

.btn-primary {
  background-color: #007bff;
  border-color: #007bff;
  color: #fff;
}

.btn-primary:hover {
  background-color: #0056b3;
  border-color: #004085;
  color: #fff;
}

.btn-info {
  background-color: #17a2b8;
  border-color: #17a2b8;
  color: #fff;
}

.btn-info:hover {
  background-color: #117a8b;
  border-color: #0c5460;
  color: #fff;
}

.btn-danger {
  background-color: #dc3545;
  border-color: #dc3545;
  color: #fff;
}

.btn-danger:hover {
  background-color: #c82333;
  border-color: #bd2130;
  color: #fff;
}

.btn-success {
  background-color: #28a745;
  border-color: #28a745;
  color: #fff;
}

.btn-success:hover {
  background-color: #218838;
  border-color: #1e7e34;
  color: #fff;
}

.btn-warning {
  background-color: #ffc107;
  border-color: #ffc107;
  color: #212529;
}

.btn-warning:hover {
  background-color: #e0a800;
  border-color: #d39e00;
  color: #212529;
}

.btn-secondary {
  background-color: #6c757d;
  border-color: #6c757d;
  color: #fff;
}

.btn-secondary:hover {
  background-color: #5a6268;
  border-color: #545b62;
  color: #fff;
}

.btn-sm {
  padding: 0.25rem 0.5rem;
  font-size: 0.75rem;
}

.form-control,
.form-select {
  border-radius: 0.25rem;
  border: 1px solid #ced4da;
  font-size: 0.9375rem;
}

.form-control:focus,
.form-select:focus {
  border-color: #80bdff;
  box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
}

.modal-header {
  background-color: #f8f9fa;
  border-bottom: 1px solid #dee2e6;
}

.modal-title {
  font-weight: 600;
  font-size: 1.1rem;
}

.input-group .form-control {
  border-radius: 0.25rem 0 0 0.25rem;
}

.input-group .btn {
  border-radius: 0 0.25rem 0.25rem 0;
  border: 1px solid #ced4da;
}

.search-control {
  font-size: 0.9375rem;
}

.text-danger {
  color: #dc3545 !important;
}
</style>