<template>
    <div class="blog-wrapper mt-3">
        <div class="row g-4">
            
            <div class="col-12 col-xl-4">
                <div class="card border-0 shadow-sm rounded-4 h-100">
                    <div class="card-header bg-white border-bottom-0 pt-4 pb-2">
                        <h6 class="mb-0 fw-bold text-dark">
                            <i class="fa-solid fa-square-plus text-primary-dark me-2"></i>Thêm Mới Blog
                        </h6>
                    </div>
                    <div class="card-body">
                        <form @submit.prevent="themMoiBlog">
                            <div class="mb-3">
                                <label class="form-label-custom">Tiêu Đề Bài Viết <span class="text-danger">*</span></label>
                                <input v-model="create_blog.tieu_de" type="text" class="form-control custom-input" placeholder="Nhập tiêu đề blog..." required>
                            </div>
                            
                            <div class="row">
                                <div class="col-6 mb-3">
                                    <label class="form-label-custom">Tác Giả</label>
                                    <input v-model="create_blog.tac_gia" type="text" class="form-control custom-input" placeholder="Tên tác giả">
                                </div>
                                <div class="col-6 mb-3">
                                    <label class="form-label-custom">Trạng Thái</label>
                                    <select v-model="create_blog.tinh_trang" class="form-select custom-input" required>
                                        <option value="1">Hiển thị</option>
                                        <option value="0">Ẩn bài viết</option>
                                    </select>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label-custom">Link Hình Ảnh</label>
                                <input v-model="create_blog.hinh_anh" type="text" class="form-control custom-input" placeholder="https://..." required>
                            </div>

                            <div class="mb-4">
                                <label class="form-label-custom">Nội Dung Bài Viết</label>
                                <textarea v-model="create_blog.noi_dung" class="form-control custom-input" rows="7" placeholder="Nhập chi tiết nội dung..."></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary-dark w-100 rounded-pill fw-bold">
                                <i class="fa-solid fa-cloud-arrow-up me-2"></i>THÊM BÀI VIẾT
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-12 col-xl-8">
                <div class="card border-0 shadow-sm rounded-4 h-100">
                    <div class="card-header bg-white border-bottom-0 pt-4 pb-3 d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
                        <h6 class="mb-0 fw-bold text-dark">
                            <i class="fa-solid fa-list-ul text-primary-dark me-2"></i>Danh Sách Blog
                        </h6>
                        
                        <div class="search-box">
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="fa-solid fa-magnifying-glass text-muted"></i></span>
                                <input v-model="key_search" type="text" class="form-control border-start-0 bg-light" placeholder="Tìm kiếm tiêu đề, tác giả...">
                            </div>
                        </div>
                    </div>
                    
                    <div class="card-body p-0">
                        <div class="table-responsive" style="max-height: 700px; overflow-y: auto;">
                            <table class="table table-hover align-middle mb-0 custom-table">
                                <thead class="table-light sticky-top">
                                    <tr>
                                        <th width="5%" class="text-center">#</th>
                                        <th width="50%">Thông Tin Bài Viết</th>
                                        <th width="15%" class="text-center">Nội Dung</th>
                                        <th width="15%" class="text-center">Trạng Thái</th>
                                        <th width="15%" class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(blog, index) in filteredList" :key="index">
                                        <th class="text-center text-muted fw-medium">{{ index + 1 }}</th>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img :src="blog.hinh_anh" class="thumbnail-img me-3" alt="Blog IMG" onerror="this.src='https://placehold.co/100x70?text=No+Image'">
                                                <div>
                                                    <h6 class="mb-1 text-dark fw-bold font-14 title-truncate" :title="blog.tieu_de">{{ blog.tieu_de }}</h6>
                                                    <small class="text-muted"><i class="fa-solid fa-pen-nib me-1"></i>{{ blog.tac_gia || 'Admin' }}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <button @click="viewContent(blog)" class="btn-action action-info mx-auto" data-bs-toggle="modal" data-bs-target="#contentModal" title="Xem nội dung">
                                                <i class="fa-solid fa-file-lines"></i>
                                            </button>
                                        </td>
                                        <td class="text-center">
                                            <button @click="doiTinhTrang(blog)" v-if="blog.tinh_trang == 1" class="btn badge-status status-active w-100">
                                                Hiển thị
                                            </button>
                                            <button @click="doiTinhTrang(blog)" v-else class="btn badge-status status-pause w-100">
                                                Đang Ẩn
                                            </button>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center gap-2">
                                                <button @click="Object.assign(update_blog, blog)" class="btn-action action-edit" data-bs-toggle="modal" data-bs-target="#capNhatModal" title="Cập nhật">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </button>
                                                <button @click="Object.assign(delete_blog, blog)" class="btn-action action-delete" data-bs-toggle="modal" data-bs-target="#xoaModal" title="Xóa">
                                                    <i class="fa-solid fa-trash-can"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr v-if="filteredList.length === 0">
                                        <td colspan="5" class="text-center py-5 text-muted">
                                            <i class="fa-solid fa-box-open fa-2x mb-2 opacity-50"></i>
                                            <p class="mb-0">Không tìm thấy bài viết nào.</p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="capNhatModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content border-0 shadow-lg rounded-4">
                    <div class="modal-header border-bottom-0 pb-0">
                        <h5 class="modal-title fw-bold"><i class="fa-solid fa-pen-to-square text-primary-dark me-2"></i>Cập Nhật Blog</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body pt-4">
                        <div class="mb-3">
                            <label class="form-label-custom">Tiêu Đề</label>
                            <input v-model="update_blog.tieu_de" type="text" class="form-control custom-input">
                        </div>
                        <div class="row">
                            <div class="col-6 mb-3">
                                <label class="form-label-custom">Tác Giả</label>
                                <input v-model="update_blog.tac_gia" type="text" class="form-control custom-input">
                            </div>
                            <div class="col-6 mb-3">
                                <label class="form-label-custom">Trạng Thái</label>
                                <select v-model="update_blog.tinh_trang" class="form-select custom-input">
                                    <option value="1">Hiển thị</option>
                                    <option value="0">Ẩn bài viết</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label-custom">Link Hình Ảnh</label>
                            <input v-model="update_blog.hinh_anh" type="text" class="form-control custom-input">
                        </div>
                        <div class="mb-2">
                            <label class="form-label-custom">Nội Dung</label>
                            <textarea v-model="update_blog.noi_dung" class="form-control custom-input" rows="6"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer border-top-0 pt-0">
                        <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Hủy</button>
                        <button @click="capNhatBlog()" type="button" class="btn btn-primary-dark rounded-pill px-4" data-bs-dismiss="modal">Lưu Thay Đổi</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="contentModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content border-0 shadow-lg rounded-4">
                    <div class="modal-header border-bottom-0 pb-0">
                        <h5 class="modal-title fw-bold text-info"><i class="fa-solid fa-file-lines me-2"></i>Nội Dung Bài Viết</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body pt-3">
                        <div class="p-4 bg-light rounded-3 text-dark font-14 border" style="white-space: pre-line; line-height: 1.8;">
                            {{ currentContent || 'Bài viết chưa có nội dung.' }}
                        </div>
                    </div>
                    <div class="modal-footer border-top-0 pt-0">
                        <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Đóng</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="xoaModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 shadow-lg rounded-4">
                    <div class="modal-body p-4 text-center">
                        <div class="mb-3 text-danger">
                            <i class="fa-solid fa-circle-exclamation fa-4x"></i>
                        </div>
                        <h5 class="fw-bold mb-2">Xác Nhận Xóa</h5>
                        <p class="text-muted mb-4">Bạn có chắc chắn muốn xóa bài viết <b class="text-danger">{{ delete_blog.tieu_de }}</b> không? Hành động này không thể hoàn tác.</p>
                        <div class="d-flex justify-content-center gap-3">
                            <button type="button" class="btn btn-light px-4 rounded-pill fw-medium" data-bs-dismiss="modal">Đóng</button>
                            <button @click="xoaBlog()" data-bs-dismiss="modal" type="button" class="btn btn-danger px-4 rounded-pill fw-medium">Xác Nhận Xóa</button>
                        </div>
                    </div>
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
            key_search: '',
            create_blog: { tinh_trang: 1, tac_gia: '' }, // Khởi tạo mặc định
            update_blog: {},
            delete_blog: {},
            currentContent: ''
        }
    },
    computed: {
        // Lọc trực tiếp không cần gọi lại API
        filteredList() {
            if (!this.key_search) return this.list_blog;
            const key = this.key_search.toLowerCase();
            return this.list_blog.filter(blog => 
                blog.tieu_de.toLowerCase().includes(key) ||
                (blog.tac_gia && blog.tac_gia.toLowerCase().includes(key))
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
                        toaster.error('Lỗi tải dữ liệu: ' + res.data.message);
                    }
                })
                .catch(() => {
                    toaster.error('Lỗi kết nối máy chủ!');
                });
        },

        themMoiBlog() {
            if (!this.create_blog.tieu_de) {
                toaster.error("Vui lòng nhập tiêu đề!");
                return;
            }
            baseRequest.post('admin/blog/them-moi', this.create_blog).then((res) => {
                if (res.data.status) {
                    toaster.success('Thêm bài viết thành công!');
                    this.loadData();
                    this.create_blog = { tinh_trang: 1, tac_gia: '' }; // Xóa trắng form
                } else {
                    toaster.error(res.data.message || 'Thêm thất bại');
                }
            });
        },

        capNhatBlog() {
            baseRequest.post('admin/blog/cap-nhat', this.update_blog).then((res) => {
                if (res.data.status) {
                    toaster.success('Cập nhật thành công!');
                    this.loadData();
                } else {
                    toaster.error(res.data.message || 'Cập nhật thất bại');
                }
            });
        },

        xoaBlog() {
            baseRequest.delete('admin/blog/xoa/' + this.delete_blog.id).then((res) => {
                if (res.data.status) {
                    toaster.success('Xóa thành công!');
                    this.loadData();
                } else {
                    toaster.error(res.data.message || 'Xóa thất bại');
                }
            });
        },

        doiTinhTrang(blog) {
            // Đảo ngược tình trạng để gửi lên server
            let payload = { ...blog, tinh_trang: blog.tinh_trang == 1 ? 0 : 1 };
            baseRequest.post('admin/blog/cap-nhat', payload).then((res) => {
                if (res.data.status) {
                    toaster.success(payload.tinh_trang == 1 ? 'Đã bật hiển thị' : 'Đã ẩn bài viết');
                    this.loadData();
                } else {
                    toaster.error('Đổi trạng thái thất bại!');
                }
            });
        },

        viewContent(blog) {
            this.currentContent = blog.noi_dung;
        }
    }
}
</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@400;500;600;700&display=swap');

.blog-wrapper {
    font-family: 'Be Vietnam Pro', sans-serif;
}

/* ── MÀU SẮC CHỦ ĐẠO ── */
.text-primary-dark { color: #0d7a5f; }
.btn-primary-dark {
    background-color: #0d7a5f;
    color: #fff;
    border: none;
    transition: all 0.2s ease;
}
.btn-primary-dark:hover {
    background-color: #085544;
    transform: translateY(-1px);
    box-shadow: 0 4px 8px rgba(13, 122, 95, 0.2);
}

/* ── FORM INPUTS ── */
.form-label-custom {
    font-size: 13px;
    font-weight: 700;
    color: #4b5563;
    margin-bottom: 6px;
    display: block;
}
.custom-input {
    border-radius: 8px;
    border: 1px solid #e5e7eb;
    padding: 10px 14px;
    font-size: 13px;
    background-color: #f9fafb;
    transition: all 0.2s;
}
.custom-input:focus {
    background-color: #fff;
    border-color: #0d7a5f;
    box-shadow: 0 0 0 3px rgba(13, 122, 95, 0.1);
}

/* ── SEARCH BOX ── */
.search-box { min-width: 280px; }
.search-box .form-control:focus { box-shadow: none; border-color: #e5e7eb; }

/* ── BẢNG BIỂU (TABLE) ── */
.custom-table th {
    font-size: 12px;
    font-weight: 700;
    text-transform: uppercase;
    color: #6b7280;
    padding: 14px;
    background-color: #f9fafb;
    border-bottom: 2px solid #f0ede8;
}
.custom-table td {
    padding: 12px 14px;
    font-size: 14px;
}

/* Cắt chữ tiêu đề dài */
.title-truncate {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    text-overflow: ellipsis;
    max-width: 300px;
}

/* Hình Ảnh Thu nhỏ */
.thumbnail-img {
    width: 65px;
    height: 45px;
    object-fit: cover;
    border-radius: 6px;
    border: 1px solid #e5e7eb;
}

/* ── TRẠNG THÁI BADGE ── */
.badge-status {
    padding: 4px 12px;
    border-radius: 6px;
    font-size: 11px;
    font-weight: 600;
    transition: all 0.2s;
}
.status-active { background-color: #e6f5f0; color: #0d7a5f; }
.status-active:hover { background-color: #0d7a5f; color: #fff; }
.status-pause { background-color: #fff8eb; color: #e8a020; }
.status-pause:hover { background-color: #e8a020; color: #fff; }

/* ── NÚT HÀNH ĐỘNG (ACTION BUTTONS) ── */
.btn-action {
    width: 32px;
    height: 32px;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    border: none;
    transition: 0.2s ease;
    font-size: 13px;
}
.action-info { background-color: #e0f2fe; color: #0284c7; }
.action-info:hover { background-color: #0284c7; color: #fff; }

.action-edit { background-color: #f3f4f6; color: #4b5563; }
.action-edit:hover { background-color: #0d7a5f; color: #fff; }

.action-delete { background-color: #fee2e2; color: #ef4444; }
.action-delete:hover { background-color: #ef4444; color: #fff; }

.font-14 { font-size: 14px; }
</style>