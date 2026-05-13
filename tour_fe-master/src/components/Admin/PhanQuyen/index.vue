<template>
    <div class="phan-quyen-wrapper mt-3">
        <div class="row g-4">
            
            <div class="col-12 col-lg-4">
                <div class="card border-0 shadow-sm rounded-4 h-100">
                    <div class="card-header bg-white border-bottom-0 pt-4 pb-2 d-flex justify-content-between align-items-center">
                        <h6 class="mb-0 fw-bold text-dark">
                            <i class="fa-solid fa-users-gear text-primary-dark me-2"></i>Danh Sách Chức Vụ
                        </h6>
                        <button class="btn btn-sm btn-primary-dark rounded-pill px-3" data-bs-toggle="modal" data-bs-target="#themMoiModal">
                            <i class="fa-solid fa-plus me-1"></i> Thêm Mới
                        </button>
                    </div>
                    <div class="card-body p-0">
                        <div class="px-3 pb-3">
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="fa-solid fa-magnifying-glass text-muted"></i></span>
                                <input @keyup.enter="searchChucVu()" v-model="key_search_chuc_vu.abc" type="text" class="form-control border-start-0 bg-light" placeholder="Tìm kiếm chức vụ...">
                            </div>
                        </div>
                        <div class="table-responsive" style="max-height: 550px; overflow-y: auto;">
                            <table class="table table-hover align-middle mb-0 custom-table">
                                <thead class="table-light sticky-top">
                                    <tr>
                                        <th width="15%" class="text-center">#</th>
                                        <th width="45%">Tên Chức Vụ</th>
                                        <th width="40%" class="text-center">Thao Tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(v, k) in list_chuc_vu" :key="k" :class="{'bg-active-row': quyen_dang_chon.id === v.id}">
                                        <th class="text-center text-muted fw-medium">{{ k + 1 }}</th>
                                        <td class="fw-semibold text-dark">{{ v.ten_chuc_vu }}</td>
                                        <td>
                                            <div class="d-flex justify-content-center gap-1">
                                                <button @click="chonChucVu(v)" class="btn-action" :class="quyen_dang_chon.id === v.id ? 'action-selected' : 'action-select'" title="Phân quyền">
                                                    <i class="fa-solid fa-shield-halved"></i>
                                                </button>
                                                <button @click="Object.assign(update_chuc_vu, v)" data-bs-toggle="modal" data-bs-target="#updateModal" class="btn-action action-edit" title="Sửa">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </button>
                                                <button @click="Object.assign(delete_chuc_vu, v)" data-bs-toggle="modal" data-bs-target="#xoaModal" class="btn-action action-delete" title="Xóa">
                                                    <i class="fa-solid fa-trash-can"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-4">
                <div class="card border-0 shadow-sm rounded-4 h-100">
                    <div class="card-header bg-white border-bottom-0 pt-4 pb-2">
                        <h6 class="mb-0 fw-bold text-dark">
                            <i class="fa-solid fa-boxes-stacked text-primary-dark me-2"></i>Kho Chức Năng
                        </h6>
                    </div>
                    <div class="card-body p-0">
                        <div class="px-3 pb-3">
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="fa-solid fa-magnifying-glass text-muted"></i></span>
                                <input @keyup.enter="searchChucNang()" v-model="key_search_chuc_nang.abc" type="text" class="form-control border-start-0 bg-light" placeholder="Tìm kiếm chức năng...">
                            </div>
                        </div>
                        <div class="table-responsive" style="max-height: 550px; overflow-y: auto;">
                            <table class="table table-hover align-middle mb-0 custom-table">
                                <thead class="table-light sticky-top">
                                    <tr>
                                        <th width="10%" class="text-center">#</th>
                                        <th width="60%">Tên Chức Năng</th>
                                        <th width="30%" class="text-center">Cấp Quyền</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(v, k) in list_chuc_nang" :key="k">
                                        <th class="text-center text-muted fw-medium">{{ k + 1 }}</th>
                                        <td class="text-dark">{{ v.ten_chuc_nang }}</td>
                                        <td class="text-center">
                                            <template v-if="quyen_dang_chon.id">
                                                <button v-if="checkDaCapQuyen(v.id)" disabled class="btn btn-sm btn-secondary rounded-pill px-3 font-12 w-100">Đã Cấp</button>
                                                <button v-else @click="capQuyen(v)" class="btn btn-sm btn-primary-dark rounded-pill px-3 font-12 w-100">Cấp Quyền</button>
                                            </template>
                                            <template v-else>
                                                <span class="text-danger font-11 fst-italic">Chọn chức vụ trước</span>
                                            </template>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-4">
                <div class="card border-0 shadow-sm rounded-4 h-100 border-start-custom">
                    <div class="card-header bg-white border-bottom-0 pt-4 pb-3">
                        <h6 class="mb-0 fw-bold text-dark">
                            Đang phân quyền cho:
                            <span class="d-block mt-2 text-primary-dark fs-5">{{ quyen_dang_chon.ten_chuc_vu || 'Chưa chọn chức vụ...' }}</span>
                        </h6>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive" style="max-height: 600px; overflow-y: auto;">
                            <table class="table table-hover align-middle mb-0 custom-table">
                                <thead class="table-light sticky-top">
                                    <tr>
                                        <th width="75%">Quyền Đang Sở Hữu</th>
                                        <th width="25%" class="text-center">Thu Hồi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(v, k) in locMang()" :key="k">
                                        <td class="fw-medium text-dark">
                                            <i class="fa-solid fa-circle-check text-success me-2"></i>{{ v.ten_chuc_nang }}
                                        </td>
                                        <td class="text-center">
                                            <button @click="xoaQuyen(v)" class="btn-action action-delete mx-auto" title="Thu hồi quyền này">
                                                <i class="fa-solid fa-xmark"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr v-if="locMang().length === 0">
                                        <td colspan="2" class="text-center py-5 text-muted">
                                            <i class="fa-solid fa-shield-blank fa-3x mb-3 opacity-25"></i>
                                            <p class="mb-0">Chưa có quyền nào được cấp.</p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="modal fade" id="themMoiModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 shadow-lg rounded-4">
                    <div class="modal-header border-bottom-0 pb-0">
                        <h5 class="modal-title fw-bold"><i class="fa-solid fa-plus-circle text-primary-dark me-2"></i>Thêm Chức Vụ</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body pt-4">
                        <label class="form-label-custom">Tên Chức Vụ</label>
                        <input v-model="create_chuc_vu.ten_chuc_vu" type="text" class="form-control custom-input" placeholder="Nhập tên chức vụ (VD: Quản lý, Nhân viên...)">
                    </div>
                    <div class="modal-footer border-top-0 pt-0">
                        <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Hủy</button>
                        <button @click="themMoiChucVu()" type="button" class="btn btn-primary-dark rounded-pill px-4" data-bs-dismiss="modal">Lưu Mới</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="updateModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 shadow-lg rounded-4">
                    <div class="modal-header border-bottom-0 pb-0">
                        <h5 class="modal-title fw-bold"><i class="fa-solid fa-pen-to-square text-primary-dark me-2"></i>Cập Nhật Chức Vụ</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body pt-4">
                        <label class="form-label-custom">Tên Chức Vụ</label>
                        <input v-model="update_chuc_vu.ten_chuc_vu" type="text" class="form-control custom-input">
                    </div>
                    <div class="modal-footer border-top-0 pt-0">
                        <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Hủy</button>
                        <button @click="capNhatChucVu()" type="button" class="btn btn-primary-dark rounded-pill px-4" data-bs-dismiss="modal">Cập Nhật</button>
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
                        <p class="text-muted mb-4">Bạn có chắc chắn muốn xóa chức vụ <b class="text-danger">{{ delete_chuc_vu.ten_chuc_vu }}</b> không? Hệ thống sẽ thu hồi toàn bộ quyền của nhân viên thuộc chức vụ này.</p>
                        <div class="d-flex justify-content-center gap-3">
                            <button type="button" class="btn btn-light px-4 rounded-pill fw-medium" data-bs-dismiss="modal">Đóng</button>
                            <button @click="xoaChucVu()" data-bs-dismiss="modal" type="button" class="btn btn-danger px-4 rounded-pill fw-medium">Xác Nhận Xóa</button>
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
            list_chuc_vu            :   [],
            list_chuc_nang          :   [],
            list_chi_tiet           :   [],
            key_search_chuc_vu      :   {},
            key_search_chuc_nang    :   {},
            create_chuc_vu          :   {},
            delete_chuc_vu          :   {},
            update_chuc_vu          :   {},
            quyen_dang_chon         :   {},
        }
    },
    mounted() {
        this.loadDataChucVu();
        this.loadDataNang();
        this.loadDataChiTiet();
    },
    methods: {
        chonChucVu(v) {
            this.quyen_dang_chon = v;
            this.loadDataChiTiet();
        },

        locMang(){
            if(!this.quyen_dang_chon.id) return [];
            return this.list_chi_tiet.filter(value => value.id_chuc_vu == this.quyen_dang_chon.id);
        },

        checkDaCapQuyen(id_chuc_nang) {
            if(!this.quyen_dang_chon.id) return false;
            // Kiểm tra xem trong mảng chi tiết phân quyền đã tồn tại cặp ID này chưa
            return this.list_chi_tiet.some(item => item.id_chuc_vu === this.quyen_dang_chon.id && item.id_chuc_nang === id_chuc_nang);
        },

        loadDataChucVu() {
            baseRequest.get('admin/chuc-vu/lay-du-lieu').then((res) => {
                if(res.data.status){
                    this.list_chuc_vu = res.data.chuc_vu;
                } else {
                    toaster.error('Thông báo<br>' + res.data.message);
                }
            });
        },
        loadDataNang() {
            baseRequest.get('admin/chuc-nang/lay-du-lieu').then((res) => {
                if(res.data.status){
                    this.list_chuc_nang = res.data.chuc_nang;
                } else {
                    toaster.error('Thông báo<br>' + res.data.message);
                }
            });
        },
        loadDataChiTiet() {
            baseRequest.post("admin/chi-tiet-chuc-nang/lay-du-lieu", {}).then((res) => {
                if(res.data.status){
                    this.list_chi_tiet = res.data.chi_tiet_phan_quyen;
                } else {
                    toaster.error('Thông báo<br>' + res.data.message);
                }
            });
        },
        searchChucVu() {
            baseRequest.post("admin/chuc-vu/tim-chuc-vu", this.key_search_chuc_vu).then((res) => {
                if(res.data.status){
                    this.list_chuc_vu = res.data.data;
                } else {
                    toaster.error('Thông báo<br>' + res.data.message);
                }
            });
        },
        searchChucNang() {
            baseRequest.post("admin/chuc-nang/tim-chuc-nang", this.key_search_chuc_nang).then((res) => {
                if(res.data.status){
                    this.list_chuc_nang = res.data.data;
                } else {
                    toaster.error('Thông báo<br>' + res.data.message);
                }
            });
        },
        capQuyen(chuc_nang) {
            var payload = {
                'id_chuc_vu': this.quyen_dang_chon.id,
                'id_chuc_nang': chuc_nang.id
            };
            baseRequest.post("admin/chi-tiet-chuc-nang/cap-quyen", payload).then((res) => {
                if(res.data.status) {
                    toaster.success(res.data.message);
                    this.loadDataChiTiet();
                } else{
                    toaster.error(res.data.message);
                }
            });
        },
        xoaQuyen(payload) {
            baseRequest.post("admin/chi-tiet-chuc-nang/xoa-quyen", payload).then((res) => {
                if(res.data.status) {
                    toaster.success(res.data.message);
                    this.loadDataChiTiet();
                } else{
                    toaster.error('Thông báo<br>' + res.data.message);
                }
            });
        },
        themMoiChucVu() {
            baseRequest.post('admin/chuc-vu/them-moi-chuc-vu', this.create_chuc_vu).then((res) => {
                if (res.data.status) {
                    toaster.success('Thông báo<br>' + res.data.message);
                    this.loadDataChucVu();
                    this.create_chuc_vu = {};
                } else{
                    toaster.error('Thông báo<br>' + res.data.message);
                }
            });
        },
        xoaChucVu() {
            baseRequest.delete('admin/chuc-vu/xoa-chuc-vu/' + this.delete_chuc_vu.id).then((res) => {
                if (res.data.status) {
                    toaster.success('Thông báo<br>' + res.data.message);
                    this.loadDataChucVu();
                    if(this.quyen_dang_chon.id === this.delete_chuc_vu.id) this.quyen_dang_chon = {};
                } else {
                    toaster.error('Thông báo<br>' + res.data.message);
                }
            });
        },
        capNhatChucVu() {
            baseRequest.post('admin/chuc-vu/cap-nhat-chuc-vu', this.update_chuc_vu).then((res) => {
                if (res.data.status) {
                    toaster.success('Thông báo<br>' + res.data.message);
                    this.loadDataChucVu();
                } else {
                    toaster.error('Thông báo<br>' + res.data.message);
                }
            });
        },
    },
}
</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@400;500;600;700&display=swap');

.phan-quyen-wrapper {
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

.border-start-custom {
    border-left: 4px solid #0d7a5f !important;
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
    font-size: 13px;
}

/* Dòng chức vụ đang được chọn (Active) */
.bg-active-row {
    background-color: #e6f5f0 !important;
}

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
.action-select { background-color: #f3f4f6; color: #4b5563; }
.action-select:hover { background-color: #0d7a5f; color: #fff; }
.action-selected { background-color: #0d7a5f; color: #fff; } /* Trạng thái đã chọn */

.action-edit { background-color: #e0f2fe; color: #0284c7; }
.action-edit:hover { background-color: #0284c7; color: #fff; }
.action-delete { background-color: #fee2e2; color: #ef4444; }
.action-delete:hover { background-color: #ef4444; color: #fff; }

.font-11 { font-size: 11px; }
.font-12 { font-size: 12px; }
</style>