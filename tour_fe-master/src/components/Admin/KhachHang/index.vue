<template>
    <div class="khach-hang-wrapper mt-3">
        <div class="row g-4">
            
            <div class="col-12 col-xl-4">
                <div class="card border-0 shadow-sm rounded-4 h-100">
                    <div class="card-header bg-white border-bottom-0 pt-4 pb-2">
                        <h6 class="mb-0 fw-bold text-dark">
                            <i class="fa-solid fa-user-plus text-primary-dark me-2"></i>Thêm Mới Khách Hàng
                        </h6>
                    </div>
                    <div class="card-body">
                        <form @submit.prevent="themMoiKhachHang">
                            <div class="mb-3">
                                <label class="form-label-custom">Họ và tên</label>
                                <input v-model="create_khach_hang.ho_ten" type="text" class="form-control custom-input" placeholder="Nhập họ tên khách hàng..." required>
                            </div>

                            <div class="row">
                                <div class="col-sm-6 mb-3">
                                    <label class="form-label-custom">Email</label>
                                    <input v-model="create_khach_hang.email" type="email" class="form-control custom-input" placeholder="name@example.com" required>
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <label class="form-label-custom">Số điện thoại</label>
                                    <input v-model="create_khach_hang.so_dien_thoai" type="text" class="form-control custom-input" placeholder="Nhập SĐT..." required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6 mb-3">
                                    <label class="form-label-custom">Mật khẩu</label>
                                    <input v-model="create_khach_hang.password" type="password" class="form-control custom-input" placeholder="Nhập mật khẩu" required>
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <label class="form-label-custom">Nhập lại MK</label>
                                    <input v-model="create_khach_hang.re_password" type="password" class="form-control custom-input" placeholder="Xác nhận mật khẩu" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6 mb-3">
                                    <label class="form-label-custom">Ngày sinh</label>
                                    <input v-model="create_khach_hang.ngay_sinh" type="date" class="form-control custom-input" required>
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <label class="form-label-custom">Giới tính</label>
                                    <select v-model="create_khach_hang.gioi_tinh" class="form-select custom-input" required>
                                        <option value="1">Nam</option>
                                        <option value="0">Nữ</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6 mb-4">
                                    <label class="form-label-custom">Địa chỉ (Tỉnh Thành)</label>
                                    <select v-model="create_khach_hang.dia_chi" class="form-select custom-input" required>
                                        <option value="" disabled selected>-- Chọn --</option>
                                        <template v-for="(v, k) in list_tinh_thanh" :key="k">
                                            <option :value="v.id">{{ v.ten_tinh_thanh }}</option>
                                        </template>
                                    </select>
                                </div>
                                <div class="col-sm-6 mb-4">
                                    <label class="form-label-custom">Tình trạng</label>
                                    <select v-model="create_khach_hang.tinh_trang" class="form-select custom-input" required>
                                        <option value="1">Hoạt Động</option>
                                        <option value="0">Dừng</option>
                                    </select>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary-dark w-100 rounded-pill fw-bold">
                                <i class="fa-solid fa-cloud-arrow-up me-2"></i>THÊM MỚI
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-12 col-xl-8">
                <div class="card border-0 shadow-sm rounded-4 h-100">
                    <div class="card-header bg-white border-bottom-0 pt-4 pb-3 d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
                        <h6 class="mb-0 fw-bold text-dark">
                            <i class="fa-solid fa-list-ul text-primary-dark me-2"></i>Danh Sách Khách Hàng
                        </h6>
                        
                        <div class="search-box">
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="fa-solid fa-magnifying-glass text-muted"></i></span>
                                <input @keyup.enter="searchKhachHang()" v-model="key_search.abc" type="text" class="form-control border-start-0 bg-light" placeholder="Tìm kiếm khách hàng...">
                                <button @click="searchKhachHang()" class="btn btn-primary-dark px-3">Tìm</button>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card-body p-0">
                        <div class="table-responsive" style="max-height: 600px; overflow-y: auto;">
                            <table class="table table-hover align-middle mb-0 custom-table">
                                <thead class="table-light sticky-top">
                                    <tr>
                                        <th width="5%" class="text-center">#</th>
                                        <th width="30%">Khách Hàng</th>
                                        <th width="25%">Liên Hệ</th>
                                        <th width="15%">Thông Tin</th>
                                        <th width="15%" class="text-center">Trạng Thái</th>
                                        <th width="10%" class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(v, k) in list_khach_hang" :key="k">
                                        <th class="text-center text-muted fw-medium">{{ k + 1 }}</th>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-circle me-3" :class="v.gioi_tinh == 1 ? 'bg-male' : 'bg-female'">
                                                    {{ v.ho_ten.charAt(0).toUpperCase() }}
                                                </div>
                                                <div>
                                                    <h6 class="mb-1 text-dark fw-bold font-14">
                                                        {{ v.ho_ten }} 
                                                        <i v-if="v.gioi_tinh == 1" class="fa-solid fa-mars text-primary ms-1" title="Nam"></i>
                                                        <i v-else class="fa-solid fa-venus text-danger ms-1" title="Nữ"></i>
                                                    </h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="font-13 mb-1"><i class="fa-solid fa-envelope text-muted me-2"></i>{{ v.email }}</div>
                                            <div class="font-13"><i class="fa-solid fa-phone text-muted me-2"></i>{{ v.so_dien_thoai }}</div>
                                        </td>
                                        <td>
                                            <div class="font-13 mb-1"><i class="fa-solid fa-calendar-day text-muted me-2"></i>{{ v.ngay_sinh }}</div>
                                            <div class="font-13"><i class="fa-solid fa-map-location-dot text-muted me-2"></i>{{ v.ten_tinh_thanh }}</div>
                                        </td>
                                        <td class="text-center">
                                            <button @click="doiTinhTrang(v)" v-if="v.tinh_trang == 1" class="btn badge-status status-active">
                                                Hoạt động
                                            </button>
                                            <button @click="doiTinhTrang(v)" v-else class="btn badge-status status-pause">
                                                Tạm dừng
                                            </button>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center gap-2">
                                                <button @click="Object.assign(update_khach_hang, v)" class="btn-action action-edit" data-bs-toggle="modal" data-bs-target="#capNhatModal" title="Cập nhật">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </button>
                                                <button @click="Object.assign(delete_khach_hang, v)" class="btn-action action-delete" data-bs-toggle="modal" data-bs-target="#xoaModal" title="Xóa">
                                                    <i class="fa-solid fa-trash-can"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr v-if="list_khach_hang.length === 0">
                                        <td colspan="6" class="text-center py-5 text-muted">
                                            <i class="fa-solid fa-users-slash fa-2x mb-2 opacity-50"></i>
                                            <p class="mb-0">Không tìm thấy dữ liệu khách hàng.</p>
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
                        <h5 class="modal-title fw-bold"><i class="fa-solid fa-pen-to-square text-primary-dark me-2"></i>Cập Nhật Khách Hàng</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body pt-4">
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label class="form-label-custom">Họ và tên</label>
                                <input v-model="update_khach_hang.ho_ten" type="text" class="form-control custom-input">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label-custom">Email</label>
                                <input v-model="update_khach_hang.email" type="email" class="form-control custom-input">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label-custom">Số điện thoại</label>
                                <input v-model="update_khach_hang.so_dien_thoai" type="text" class="form-control custom-input">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label-custom">Giới tính</label>
                                <select v-model="update_khach_hang.gioi_tinh" class="form-select custom-input">
                                    <option value="1">Nam</option>
                                    <option value="0">Nữ</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label-custom">Ngày sinh</label>
                                <input v-model="update_khach_hang.ngay_sinh" type="date" class="form-control custom-input">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label-custom">Địa chỉ (Tỉnh thành)</label>
                                <select v-model="update_khach_hang.dia_chi" class="form-select custom-input">
                                    <template v-for="(v, k) in list_tinh_thanh" :key="k">
                                        <option :value="v.id">{{ v.ten_tinh_thanh }}</option>
                                    </template>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label-custom">Tình trạng</label>
                                <select v-model="update_khach_hang.tinh_trang" class="form-select custom-input">
                                    <option value="1">Hoạt động</option>
                                    <option value="0">Tạm dừng</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-top-0 pt-0">
                        <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Hủy</button>
                        <button @click="updateKhachHang()" type="button" class="btn btn-primary-dark rounded-pill px-4" data-bs-dismiss="modal">Lưu Thay Đổi</button>
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
                        <p class="text-muted mb-4">Bạn có chắc chắn muốn xóa khách hàng <b class="text-danger">{{ delete_khach_hang.ho_ten }}</b> không? Hành động này không thể hoàn tác.</p>
                        <div class="d-flex justify-content-center gap-3">
                            <button type="button" class="btn btn-light px-4 rounded-pill fw-medium" data-bs-dismiss="modal">Đóng</button>
                            <button @click="deleteKhachHang()" data-bs-dismiss="modal" type="button" class="btn btn-danger px-4 rounded-pill fw-medium">Xác Nhận Xóa</button>
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
            list_khach_hang: [],
            list_tinh_thanh: [],
            key_search: {},
            create_khach_hang: { tinh_trang: 1, gioi_tinh: 1, dia_chi: '' }, // Setup values mặc định
            delete_khach_hang: {}, // Đổi id_can_xoa thành object để có thể in tên
            update_khach_hang: {},
        }
    },
    mounted() {
        this.loadDataKhachHang();
        this.loadDataTinhThanh();
    },
    methods: {
        loadDataTinhThanh() {
            baseRequest.get('admin/tinh-thanh/lay-du-lieu').then((res) => {
                if (res.data.status) {
                    this.list_tinh_thanh = res.data.tinh_thanh;
                } else {
                    toaster.error('Thông báo<br>' + res.data.message);
                }
            });
        },
        loadDataKhachHang() {
            baseRequest.get('admin/khach-hang/lay-du-lieu').then((res) => {
                if (res.data.status) {
                    this.list_khach_hang = res.data.khach_hang;
                } else {
                    toaster.error('Thông báo<br>' + res.data.message);
                }
            });
        },
        themMoiKhachHang() {
            baseRequest.post('admin/khach-hang/them-moi-khach-hang', this.create_khach_hang).then((res) => {
                if (res.data.status == true) {
                    toaster.success('Thông báo<br>' + res.data.message);
                    this.loadDataKhachHang();
                    this.create_khach_hang = { tinh_trang: 1, gioi_tinh: 1, dia_chi: '' }; // Reset form
                } else {
                    toaster.error('Thông báo<br>' + res.data.message);
                }
            });
        },
        searchKhachHang() {
            baseRequest.post('admin/khach-hang/tim-khach-hang', this.key_search).then((res) => {
                if (res.data.status) {
                    this.list_khach_hang = res.data.khach_hang;
                } else {
                    toaster.error('Thông báo<br>' + res.data.message);
                }
            });
        },
        deleteKhachHang() {
            baseRequest.delete('admin/khach-hang/xoa-khach-hang/' + this.delete_khach_hang.id).then((res) => {
                if (res.data.status == true) {
                    toaster.success('Thông báo<br>' + res.data.message);
                    this.loadDataKhachHang();
                } else {
                    toaster.error('Thông báo<br>' + res.data.message);
                }
            });
        },
        updateKhachHang() {
            baseRequest.post('admin/khach-hang/cap-nhat-khach-hang', this.update_khach_hang).then((res) => {
                if (res.data.status == true) {
                    toaster.success('Thông báo<br>' + res.data.message);
                    this.loadDataKhachHang();
                } else {
                    toaster.error('Thông báo<br>' + res.data.message);
                }
            });
        },
        doiTinhTrang(v) {
            baseRequest.post('admin/khach-hang/doi-tinh-trang-khach-hang', v).then((res) => {
                if (res.data.status == true) {
                    toaster.success('Thông báo<br>' + res.data.message);
                    this.loadDataKhachHang();
                } else {
                    toaster.error('Thông báo<br>' + res.data.message);
                }
            });
        }
    },
}
</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@400;500;600;700&display=swap');

.khach-hang-wrapper {
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

/* ── AVATAR ẢO KẾT HỢP GIỚI TÍNH ── */
.avatar-circle {
    width: 42px;
    height: 42px;
    font-weight: bold;
    font-size: 16px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
}
.bg-male { background-color: #e0f2fe; color: #0284c7; }
.bg-female { background-color: #fce7f3; color: #db2777; }

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

/* ── TRẠNG THÁI BADGE ── */
.badge-status {
    padding: 4px 12px;
    border-radius: 50px;
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
.action-edit { background-color: #e0f2fe; color: #0284c7; }
.action-edit:hover { background-color: #0284c7; color: #fff; }
.action-delete { background-color: #fee2e2; color: #ef4444; }
.action-delete:hover { background-color: #ef4444; color: #fff; }

.font-13 { font-size: 13px; }
.font-14 { font-size: 14px; }
</style>