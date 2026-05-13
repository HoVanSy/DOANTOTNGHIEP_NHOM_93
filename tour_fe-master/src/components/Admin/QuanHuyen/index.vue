<template>
    <div class="quan-huyen-wrapper mt-3">
        <div class="row g-4">
            
            <div class="col-12 col-lg-4">
                <div class="card border-0 shadow-sm rounded-4 h-100">
                    <div class="card-header bg-white border-bottom-0 pt-4 pb-2">
                        <h6 class="mb-0 fw-bold text-dark">
                            <i class="fa-solid fa-plus-circle text-primary-dark me-2"></i>Thêm Mới Quận/Huyện
                        </h6>
                    </div>
                    <div class="card-body">
                        <form @submit.prevent="themMoiQuanHuyen">
                            <div class="mb-3">
                                <label class="form-label-custom">Tên Quận / Huyện</label>
                                <input v-model="create_quan_huyen.ten_quan_huyen" class="form-control custom-input" type="text" placeholder="Nhập tên quận/huyện..." required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label-custom">Thuộc Tỉnh / Thành Phố</label>
                                <select v-model="create_quan_huyen.id_tinh_thanh" class="form-select custom-input" required>
                                    <option value="" disabled selected>-- Chọn Tỉnh Thành --</option>
                                    <template v-for="(value, index) in list_tinh_thanh" :key="index">
                                        <option v-bind:value="value.id">{{ value.ten_tinh_thanh }}</option>
                                    </template>
                                </select>
                            </div>
                            <div class="mb-4">
                                <label class="form-label-custom">Tình Trạng</label>
                                <select v-model="create_quan_huyen.tinh_trang" class="form-select custom-input" required>
                                    <option value="1">Đang Hoạt Động</option>
                                    <option value="0">Dừng Kinh Doanh</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary-dark w-100 rounded-pill fw-bold">
                                <i class="fa-solid fa-cloud-arrow-up me-2"></i>THÊM MỚI
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-8">
                <div class="card border-0 shadow-sm rounded-4 h-100">
                    <div class="card-header bg-white border-bottom-0 pt-4 pb-3 d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
                        <h6 class="mb-0 fw-bold text-dark">
                            <i class="fa-solid fa-list-ul text-primary-dark me-2"></i>Danh Sách Quận/Huyện
                        </h6>
                        
                        <div class="search-box">
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="fa-solid fa-magnifying-glass text-muted"></i></span>
                                <input v-on:keyup.enter="searchQuanHuyen()" v-model="key_search.abc" type="text" class="form-control border-start-0 bg-light" placeholder="Tìm kiếm quận/huyện...">
                                <button v-on:click="searchQuanHuyen()" class="btn btn-primary-dark px-3">Tìm</button>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card-body p-0">
                        <div class="table-responsive" style="max-height: 480px; overflow-y: auto;">
                            <table class="table table-hover align-middle mb-0 custom-table">
                                <thead class="table-light sticky-top">
                                    <tr>
                                        <th width="8%" class="text-center">#</th>
                                        <th width="30%">Tỉnh Thành</th>
                                        <th width="30%">Quận Huyện</th>
                                        <th width="17%" class="text-center">Tình Trạng</th>
                                        <th width="15%" class="text-center">Hành Động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(v, k) in list_quan_huyen" :key="k">
                                        <th class="text-center text-muted fw-medium">{{ k + 1 }}</th>
                                        <td class="text-secondary">{{ v.ten_tinh_thanh }}</td>
                                        <td class="fw-semibold text-dark">{{ v.ten_quan_huyen }}</td>
                                        <td class="text-center">
                                            <button v-on:click="doiTinhTrang(v)" v-if="v.tinh_trang == 1" class="btn badge-status status-active">
                                                <i class="fa-solid fa-circle-check me-1"></i>Hoạt Động
                                            </button>
                                            <button v-on:click="doiTinhTrang(v)" v-else class="btn badge-status status-pause">
                                                <i class="fa-solid fa-circle-pause me-1"></i>Tạm Dừng
                                            </button>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center gap-2">
                                                <button v-on:click="Object.assign(update_quan_huyen, v)" class="btn-action action-edit" data-bs-toggle="modal" data-bs-target="#capNhatModal" title="Cập nhật">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </button>
                                                <button v-on:click="Object.assign(delete_quan_huyen, v)" class="btn-action action-delete" data-bs-toggle="modal" data-bs-target="#xoaModal" title="Xóa">
                                                    <i class="fa-solid fa-trash-can"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr v-if="list_quan_huyen.length === 0">
                                        <td colspan="5" class="text-center py-4 text-muted">
                                            <i class="fa-solid fa-box-open fa-2x mb-2 opacity-50"></i>
                                            <p class="mb-0">Không tìm thấy dữ liệu.</p>
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
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 shadow-lg rounded-4">
                    <div class="modal-header border-bottom-0 pb-0">
                        <h5 class="modal-title fw-bold"><i class="fa-solid fa-pen-to-square text-primary-dark me-2"></i>Cập Nhật Quận/Huyện</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body pt-4">
                        <div class="mb-3">
                            <label class="form-label-custom">Tên Quận/Huyện</label>
                            <input v-model="update_quan_huyen.ten_quan_huyen" class="form-control custom-input" type="text">
                        </div>
                        <div class="mb-3">
                            <label class="form-label-custom">Thuộc Tỉnh Thành</label>
                            <select v-model="update_quan_huyen.id_tinh_thanh" class="form-select custom-input">
                                <template v-for="(value, index) in list_tinh_thanh" :key="index">
                                    <option v-bind:value="value.id">{{ value.ten_tinh_thanh }}</option>
                                </template>
                            </select>
                        </div>
                        <div class="mb-2">
                            <label class="form-label-custom">Tình Trạng</label>
                            <select v-model="update_quan_huyen.tinh_trang" class="form-select custom-input">
                                <option value="1">Đang Hoạt Động</option>
                                <option value="0">Dừng Kinh Doanh</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer border-top-0 pt-0">
                        <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Hủy</button>
                        <button v-on:click="updateQuanHuyen()" type="button" data-bs-dismiss="modal" class="btn btn-primary-dark rounded-pill px-4">Lưu Thay Đổi</button>
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
                        <p class="text-muted mb-4">Bạn có chắc chắn muốn xóa quận/huyện <b class="text-danger">{{ delete_quan_huyen.ten_quan_huyen }}</b> không? Hành động này không thể hoàn tác.</p>
                        <div class="d-flex justify-content-center gap-3">
                            <button type="button" class="btn btn-light px-4 rounded-pill fw-medium" data-bs-dismiss="modal">Đóng</button>
                            <button v-on:click="deleteQuanHuyen()" data-bs-dismiss="modal" type="button" class="btn btn-danger px-4 rounded-pill fw-medium">Xác Nhận Xóa</button>
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
            list_tinh_thanh: [],
            list_quan_huyen: [],
            key_search: {},
            create_quan_huyen: { tinh_trang: 1, id_tinh_thanh: '' }, // Default values
            delete_quan_huyen: {}, // Đã cập nhật lại thành object để hiển thị tên
            update_quan_huyen: {},
        }
    },
    mounted() {
        this.loadDataTinhThanh();
        this.loadDataQuanHuyen();
    },
    methods: {
        loadDataQuanHuyen() {
            baseRequest
                .get('admin/quan-huyen/lay-du-lieu')
                .then((res) => {
                    if (res.data.status) {
                        this.list_quan_huyen = res.data.quan_huyen;
                    } else {
                        toaster.error('Thông báo<br>' + res.data.message);
                    }
                });
        },
        loadDataTinhThanh() {
            baseRequest
                .get('admin/tinh-thanh/lay-du-lieu')
                .then((res) => {
                    if (res.data.status) {
                        this.list_tinh_thanh = res.data.tinh_thanh;
                    } else {
                        toaster.error('Thông báo<br>' + res.data.message);
                    }
                });
        },
        searchQuanHuyen() {
            baseRequest
                .post('admin/quan-huyen/tim-quan-huyen', this.key_search)
                .then((res) => {
                    if (res.data.status) {
                        this.list_quan_huyen = res.data.quan_huyen;
                    } else {
                        toaster.error('Thông báo<br>' + res.data.message);
                    }
                });
        },
        themMoiQuanHuyen() {
            baseRequest
                .post('admin/quan-huyen/them-moi-quan-huyen', this.create_quan_huyen)
                .then((res) => {
                    if (res.data.status) {
                        toaster.success('Thông báo<br>' + res.data.message);
                        this.loadDataQuanHuyen();
                        this.create_quan_huyen = { tinh_trang: 1, id_tinh_thanh: '' }; // Xóa form sau khi thêm
                    }
                    else {
                        toaster.error('Thông báo<br>' + res.data.message);
                    }
                });
        },
        deleteQuanHuyen() {
            baseRequest
                .delete('admin/quan-huyen/xoa-quan-huyen/' + this.delete_quan_huyen.id)
                .then((res) => {
                    if (res.data.status) {
                        toaster.success('Thông báo<br>' + res.data.message);
                        this.loadDataQuanHuyen();
                    }
                    else {
                        toaster.error('Thông báo<br>' + res.data.message);
                    }
                });
        },
        updateQuanHuyen() {
            baseRequest
                .post('admin/quan-huyen/cap-nhat-quan-huyen', this.update_quan_huyen)
                .then((res) => {
                    if (res.data.status) {
                        toaster.success('Thông báo<br>' + res.data.message);
                        this.loadDataQuanHuyen();
                    }
                    else {
                        toaster.error('Thông báo<br>' + res.data.message);
                    }
                });
        },
        doiTinhTrang(v) {
            baseRequest
                .post('admin/quan-huyen/doi-tinh-trang-quan-huyen', v)
                .then((res) => {
                    if (res.data.status) {
                        toaster.success('Thông báo<br>' + res.data.message);
                        this.loadDataQuanHuyen();
                    }
                    else {
                        toaster.error('Thông báo<br>' + res.data.message);
                    }
                });
        }
    },
}
</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@400;500;600;700&display=swap');

.quan-huyen-wrapper {
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
    font-size: 14px;
    background-color: #f9fafb;
    transition: all 0.2s;
}
.custom-input:focus {
    background-color: #fff;
    border-color: #0d7a5f;
    box-shadow: 0 0 0 3px rgba(13, 122, 95, 0.1);
}

/* ── SEARCH BOX ── */
.search-box {
    min-width: 300px;
}
.search-box .form-control:focus {
    box-shadow: none;
    border-color: #e5e7eb;
}

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
    padding: 6px 14px;
    border-radius: 50px;
    font-size: 12px;
    font-weight: 600;
    transition: all 0.2s;
    border: 1px solid transparent;
}
.status-active {
    background-color: #e6f5f0;
    color: #0d7a5f;
}
.status-active:hover {
    background-color: #0d7a5f;
    color: #fff;
}
.status-pause {
    background-color: #fff8eb;
    color: #e8a020;
}
.status-pause:hover {
    background-color: #e8a020;
    color: #fff;
}

/* ── NÚT HÀNH ĐỘNG (ACTION BUTTONS) ── */
.btn-action {
    width: 34px;
    height: 34px;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    border: none;
    transition: 0.2s ease;
    font-size: 14px;
}
.action-edit {
    background-color: #e0f2fe;
    color: #0284c7;
}
.action-edit:hover {
    background-color: #0284c7;
    color: #fff;
}
.action-delete {
    background-color: #fee2e2;
    color: #ef4444;
}
.action-delete:hover {
    background-color: #ef4444;
    color: #fff;
}
</style>