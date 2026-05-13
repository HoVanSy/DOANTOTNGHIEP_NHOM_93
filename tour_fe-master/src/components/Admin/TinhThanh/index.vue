<template>
    <div class="tinh-thanh-wrapper mt-3">
        <div class="row g-4">
            
            <div class="col-12 col-lg-4">
                <div class="card border-0 shadow-sm rounded-4 h-100">
                    <div class="card-header bg-white border-bottom-0 pt-4 pb-2">
                        <h6 class="mb-0 fw-bold text-dark">
                            <i class="fa-solid fa-plus-circle text-primary-dark me-2"></i>Thêm Mới Tỉnh Thành
                        </h6>
                    </div>
                    <div class="card-body">
                        <form @submit.prevent="createTinhThanh">
                            <div class="mb-3">
                                <label class="form-label-custom">Tên Tỉnh / Thành phố</label>
                                <input v-model="create_tinh_thanh.ten_tinh_thanh" class="form-control custom-input" type="text" placeholder="Nhập tên tỉnh thành..." required>
                            </div>
                            <div class="mb-4">
                                <label class="form-label-custom">Tình Trạng</label>
                                <select v-model="create_tinh_thanh.tinh_trang" class="form-select custom-input" required>
                                    <option value="1" selected>Hoạt Động</option>
                                    <option value="0">Tạm Dừng</option>
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
                            <i class="fa-solid fa-list-ul text-primary-dark me-2"></i>Danh Sách Tỉnh Thành
                        </h6>
                        
                        <div class="search-box">
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="fa-solid fa-magnifying-glass text-muted"></i></span>
                                <input v-on:keyup.enter="searchTinhThanh()" v-model="key_search.abc" type="text" class="form-control border-start-0 bg-light" placeholder="Tìm kiếm tỉnh thành...">
                                <button v-on:click="searchTinhThanh()" class="btn btn-primary-dark px-3">Tìm</button>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card-body p-0">
                        <div class="table-responsive" style="max-height: 450px; overflow-y: auto;">
                            <table class="table table-hover align-middle mb-0 custom-table">
                                <thead class="table-light sticky-top">
                                    <tr>
                                        <th width="10%" class="text-center">#</th>
                                        <th width="45%">Tên Tỉnh Thành</th>
                                        <th width="25%" class="text-center">Tình Trạng</th>
                                        <th width="20%" class="text-center">Hành Động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(v, k) in list_tinh_thanh" :key="k">
                                        <th class="text-center text-muted fw-medium">{{ k + 1 }}</th>
                                        <td class="fw-semibold text-dark">{{ v.ten_tinh_thanh }}</td>
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
                                                <button v-on:click="Object.assign(update_tinh_thanh, v)" class="btn-action action-edit" data-bs-toggle="modal" data-bs-target="#capNhatModal" title="Cập nhật">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </button>
                                                <button v-on:click="Object.assign(delete_tinh_thanh, v)" class="btn-action action-delete" data-bs-toggle="modal" data-bs-target="#xoaModal" title="Xóa">
                                                    <i class="fa-solid fa-trash-can"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr v-if="list_tinh_thanh.length === 0">
                                        <td colspan="4" class="text-center py-4 text-muted">
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
                        <h5 class="modal-title fw-bold"><i class="fa-solid fa-pen-to-square text-primary-dark me-2"></i>Cập Nhật Tỉnh Thành</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body pt-4">
                        <div class="mb-3">
                            <label class="form-label-custom">Tên Tỉnh Thành</label>
                            <input v-model="update_tinh_thanh.ten_tinh_thanh" class="form-control custom-input" type="text">
                        </div>
                        <div class="mb-2">
                            <label class="form-label-custom">Tình Trạng</label>
                            <select v-model="update_tinh_thanh.tinh_trang" class="form-select custom-input">
                                <option value="1">Hoạt Động</option>
                                <option value="0">Tạm Dừng</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer border-top-0 pt-0">
                        <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Hủy</button>
                        <button v-on:click="updateTinhThanh()" type="button" data-bs-dismiss="modal" class="btn btn-primary-dark rounded-pill px-4">Lưu Thay Đổi</button>
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
                        <p class="text-muted mb-4">Bạn có chắc chắn muốn xóa tỉnh thành <b class="text-danger">{{ delete_tinh_thanh.ten_tinh_thanh }}</b> không? Hành động này không thể hoàn tác.</p>
                        <div class="d-flex justify-content-center gap-3">
                            <button type="button" class="btn btn-light px-4 rounded-pill fw-medium" data-bs-dismiss="modal">Đóng</button>
                            <button v-on:click="deleteTinhThanh()" data-bs-dismiss="modal" type="button" class="btn btn-danger px-4 rounded-pill fw-medium">Xác Nhận Xóa</button>
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
            list_tinh_thanh     :   [],
            key_search          :   {},
            create_tinh_thanh      :   { tinh_trang: 1 }, // Default tinh_trang = 1
            delete_tinh_thanh      :   {},
            update_tinh_thanh      :   {},
        }
    },
    mounted() {
        this.loadDataTinhThanh();
    },
    methods: {
        loadDataTinhThanh() {
            baseRequest
                .get('admin/tinh-thanh/lay-du-lieu')
                .then((res) => {
                    if(res.data.status){
                        this.list_tinh_thanh = res.data.tinh_thanh;
                    }
                    else{
                        toaster.error(res.data.message)
                    }
                });
        },

        searchTinhThanh(){
            baseRequest
                .post('admin/tinh-thanh/tim-tinh-thanh', this.key_search)
                .then((res) => {
                    if(res.data.status == true) {
                        this.list_tinh_thanh = res.data.tinh_thanh;
                    }
                    else{
                        toaster.error('Thông báo<br>' + res.data.message);
                    }
                });
        },

        createTinhThanh(){
            baseRequest
                .post('admin/tinh-thanh/them-moi-tinh-thanh', this.create_tinh_thanh)
                .then((res) => {
                    if(res.data.status == true) {
                        toaster.success('Thông báo<br>' + res.data.message);
                        this.loadDataTinhThanh();
                        this.create_tinh_thanh = { tinh_trang: 1 }; // Reset form
                    }
                    else{
                        toaster.error('Thông báo<br>' + res.data.message);
                    }
                });
        },

        deleteTinhThanh(){
            baseRequest
                .delete('admin/tinh-thanh/xoa-tinh-thanh/'+ this.delete_tinh_thanh.id)
                .then((res) => {
                    if(res.data.status) {
                        toaster.success('Thông báo<br>' + res.data.message);
                        this.loadDataTinhThanh();
                    }
                    else{
                        toaster.error('Thông báo<br>' + res.data.message);
                    }
                });
        },

        updateTinhThanh(){
            baseRequest
                .post('admin/tinh-thanh/cap-nhat-tinh-thanh', this.update_tinh_thanh)
                .then((res) => {
                    if(res.data.status == true) {
                        toaster.success('Thông báo<br>' + res.data.message);
                        this.loadDataTinhThanh();
                    }
                    else{
                        toaster.error('Thông báo<br>' + res.data.message);
                    }
                });
        },

        doiTinhTrang(v){
            baseRequest
                .post('admin/tinh-thanh/doi-tinh-trang-tinh-thanh', v)
                .then((res) => {
                    if(res.data.status == true) {
                        toaster.success('Thông báo<br>' + res.data.message);
                        this.loadDataTinhThanh();
                    }
                    else{
                        toaster.error('Thông báo<br>' + res.data.message);
                    }
                });
        }
    },
}
</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@400;500;600;700&display=swap');

.tinh-thanh-wrapper {
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