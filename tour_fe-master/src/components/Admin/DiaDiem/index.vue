<template>
    <div class="dia-diem-wrapper mt-3">
        <div class="row g-4">
            
            <div class="col-12 col-lg-4">
                <div class="card border-0 shadow-sm rounded-4 h-100">
                    <div class="card-header bg-white border-bottom-0 pt-4 pb-2">
                        <h6 class="mb-0 fw-bold text-dark">
                            <i class="fa-solid fa-plus-circle text-primary-dark me-2"></i>Thêm Mới Địa Điểm
                        </h6>
                    </div>
                    <div class="card-body">
                        <form @submit.prevent="themMoiDiaDiem">
                            <div class="mb-3">
                                <label class="form-label-custom">Tên Địa Điểm</label>
                                <input v-model="create_dia_diem.ten_dia_diem" @keyup="addSlug()" type="text" class="form-control custom-input" placeholder="Nhập tên địa điểm..." required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label-custom">Slug (Đường dẫn)</label>
                                <input v-model="create_dia_diem.slug" type="text" class="form-control custom-input bg-light" disabled placeholder="tu-dong-tao-slug...">
                            </div>
                            <div class="row">
                                <div class="col-6 mb-3">
                                    <label class="form-label-custom">Loại Địa Điểm</label>
                                    <select v-model="create_dia_diem.loai_dia_diem" class="form-select custom-input" required>
                                        <option value="1">Khách sạn</option>
                                        <option value="2">Nhà hàng</option>
                                        <option value="3">Tham quan</option>
                                    </select>
                                </div>
                                <div class="col-6 mb-3">
                                    <!-- <label class="form-label-custom">Giá Tiền</label> -->
                                    <!-- <input v-model="create_dia_diem.gia_tien" type="number" class="form-control custom-input" placeholder="VNĐ" required> -->
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 mb-3">
                                    <label class="form-label-custom">Tỉnh / Thành</label>
                                    <select v-model="create_dia_diem.id_tinh_thanh" @change="locQuanHuyen()" class="form-select custom-input" required>
                                        <option value="" disabled selected>-- Chọn Tỉnh --</option>
                                        <template v-for="(v, k) in list_tinh_thanh" :key="k">
                                            <option :value="v.id">{{ v.ten_tinh_thanh }}</option>
                                        </template>
                                    </select>
                                </div>
                                <div class="col-6 mb-3">
                                    <label class="form-label-custom">Quận / Huyện</label>
                                    <select v-model="create_dia_diem.id_quan_huyen" class="form-select custom-input" required>
                                        <option value="" disabled selected>-- Chọn Quận --</option>
                                        <template v-for="(v, k) in loc_tinh" :key="k">
                                            <option :value="v.id">{{ v.ten_quan_huyen }}</option>
                                        </template>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 mb-3">
                                    <label class="form-label-custom">Tọa độ X</label>
                                    <input v-model="create_dia_diem.toa_do_x" type="text" class="form-control custom-input" placeholder="Ví dụ: 16.0544">
                                </div>
                                <div class="col-6 mb-3">
                                    <label class="form-label-custom">Tọa độ Y</label>
                                    <input v-model="create_dia_diem.toa_do_y" type="text" class="form-control custom-input" placeholder="Ví dụ: 108.2022">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label-custom">Link Hình Ảnh</label>
                                <input v-model="create_dia_diem.link_anh" type="text" class="form-control custom-input" placeholder="https://..." required>
                            </div>
                            <div class="mb-4">
                                <label class="form-label-custom">Tình Trạng</label>
                                <select v-model="create_dia_diem.tinh_trang" class="form-select custom-input">
                                    <option value="1">Hoạt động</option>
                                    <option value="0">Tạm dừng</option>
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
                            <i class="fa-solid fa-list-ul text-primary-dark me-2"></i>Danh Sách Địa Điểm
                        </h6>
                        
                        <div class="search-box">
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="fa-solid fa-magnifying-glass text-muted"></i></span>
                                <input @keyup.enter="searchDiaDiem()" v-model="key_search.abc" type="text" class="form-control border-start-0 bg-light" placeholder="Tìm kiếm địa điểm...">
                                <button @click="searchDiaDiem()" class="btn btn-primary-dark px-3">Tìm</button>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card-body p-0">
                        <div class="table-responsive" style="max-height: 700px; overflow-y: auto;">
                            <table class="table table-hover align-middle mb-0 custom-table">
                                <thead class="table-light sticky-top">
                                    <tr>
                                        <th width="5%" class="text-center">#</th>
                                        <th width="35%">Thông Tin Địa Điểm</th>
                                        <th width="20%">Phân Loại & Giá</th>
                                        <th width="20%">Vị Trí</th>
                                        <th width="12%" class="text-center">Trạng Thái</th>
                                        <th width="8%" class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(v, k) in list_dia_diem" :key="k">
                                        <th class="text-center text-muted fw-medium">{{ k + 1 }}</th>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img :src="v.link_anh" class="thumbnail-img me-3" alt="IMG">
                                                <div>
                                                    <h6 class="mb-1 text-dark fw-bold font-14">{{ v.ten_dia_diem }}</h6>
                                                    <small class="text-muted fst-italic">{{ v.slug }}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <span v-if="v.loai_dia_diem == 1" class="badge bg-info text-dark mb-1">Khách sạn</span>
                                            <span v-else-if="v.loai_dia_diem == 2" class="badge bg-primary mb-1">Nhà hàng</span>
                                            <span v-else-if="v.loai_dia_diem == 3" class="badge bg-warning text-dark mb-1">Tham quan</span>
                                            <br>
                                            <!-- <b class="text-danger font-13">{{ formatToVND(v.gia_tien) }}</b> -->
                                        </td>
                                        <td>
                                            <div class="font-13 fw-semibold text-secondary mb-1">
                                                {{ v.ten_quan_huyen }}, {{ v.ten_tinh_thanh }}
                                            </div>
                                            <small class="text-muted">X: {{ v.toa_do_x || 'N/A' }} | Y: {{ v.toa_do_y || 'N/A' }}</small>
                                        </td>
                                        <td class="text-center">
                                            <button @click="doiTinhTrang(v)" v-if="v.is_open == 1" class="btn badge-status status-active">
                                                Hoạt động
                                            </button>
                                            <button @click="doiTinhTrang(v)" v-else class="btn badge-status status-pause">
                                                Tạm dừng
                                            </button>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center gap-2">
                                                <button @click="Object.assign(update_dia_diem, v); locQuanHuyen_update()" class="btn-action action-edit" data-bs-toggle="modal" data-bs-target="#capNhatModal" title="Cập nhật">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </button>
                                                <button @click="Object.assign(delete_dia_diem, v)" class="btn-action action-delete" data-bs-toggle="modal" data-bs-target="#xoaModal" title="Xóa">
                                                    <i class="fa-solid fa-trash-can"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr v-if="list_dia_diem.length === 0">
                                        <td colspan="6" class="text-center py-5 text-muted">
                                            <i class="fa-solid fa-box-open fa-2x mb-2 opacity-50"></i>
                                            <p class="mb-0">Không có dữ liệu địa điểm.</p>
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
                        <h5 class="modal-title fw-bold"><i class="fa-solid fa-pen-to-square text-primary-dark me-2"></i>Cập Nhật Địa Điểm</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body pt-4">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label-custom">Tên địa điểm (Khóa)</label>
                                <input v-model="update_dia_diem.ten_dia_diem" type="text" class="form-control custom-input bg-light" disabled>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label-custom">Slug</label>
                                <input v-model="update_dia_diem.slug" type="text" class="form-control custom-input">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label-custom">Loại địa điểm</label>
                                <select v-model="update_dia_diem.loai_dia_diem" class="form-select custom-input">
                                    <option value="1">Khách sạn</option>
                                    <option value="2">Nhà hàng</option>
                                    <option value="3">Địa điểm tham quan</option>
                                </select>
                            </div>
                            <!-- <div class="col-md-6 mb-3">
                                <label class="form-label-custom">Giá Tiền</label>
                                <input v-model="update_dia_diem.gia_tien" type="number" class="form-control custom-input">
                            </div> -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label-custom">Tỉnh thành</label>
                                <select v-model="update_dia_diem.id_tinh_thanh" @change="locQuanHuyen_update()" class="form-select custom-input">
                                    <template v-for="(v, k) in list_tinh_thanh" :key="k">
                                        <option :value="v.id">{{ v.ten_tinh_thanh }}</option>
                                    </template>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label-custom">Quận huyện</label>
                                <select v-model="update_dia_diem.id_quan_huyen" class="form-select custom-input">
                                    <template v-for="(v, k) in loc_tinh_update" :key="k">
                                        <option :value="v.id">{{ v.ten_quan_huyen }}</option>
                                    </template>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label-custom">Tọa độ x</label>
                                <input v-model="update_dia_diem.toa_do_x" type="text" class="form-control custom-input">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label-custom">Tọa độ y</label>
                                <input v-model="update_dia_diem.toa_do_y" type="text" class="form-control custom-input">
                            </div>
                            <div class="col-12 mb-2">
                                <label class="form-label-custom">Hình Ảnh (URL)</label>
                                <input v-model="update_dia_diem.link_anh" type="text" class="form-control custom-input">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-top-0 pt-0">
                        <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Hủy</button>
                        <button @click="updateDiaDiem()" type="button" class="btn btn-primary-dark rounded-pill px-4" data-bs-dismiss="modal">Cập Nhật</button>
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
                        <p class="text-muted mb-4">Bạn có chắc chắn muốn xóa địa điểm <b class="text-danger">{{ delete_dia_diem.ten_dia_diem }}</b> không? Hành động này không thể hoàn tác.</p>
                        <div class="d-flex justify-content-center gap-3">
                            <button type="button" class="btn btn-light px-4 rounded-pill fw-medium" data-bs-dismiss="modal">Đóng</button>
                            <button @click="deleteDiaDiem()" data-bs-dismiss="modal" type="button" class="btn btn-danger px-4 rounded-pill fw-medium">Xác Nhận Xóa</button>
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
            list_quan_huyen: [],
            list_tinh_thanh: [],
            list_dia_diem: [],
            key_search: {},
            create_dia_diem: { tinh_trang: 1, loai_dia_diem: 1, id_tinh_thanh: '', id_quan_huyen: '', },
            delete_dia_diem: {}, // Đổi id_can_xoa thành object
            update_dia_diem: {},
            tinh_dang_chon: {},
            tinh_dang_chon_update: {},
            loc_tinh: [],
            loc_tinh_update: [],
        }
    },
    mounted() {
        this.loadDataDiaDiem();
        this.loadDataQuanHuyen();
        this.loadDataTinhThanh();
    },
    methods: {
        formatToVND(number) {
            if (number === null || number === undefined || number === '') {
                return '0 ₫';
            }
            const parsedNumber = Number(number); 
            if (isNaN(parsedNumber)) {
                return '0 ₫';
            }
            return parsedNumber.toLocaleString('vi-VN', { style: 'currency', currency: 'VND' });
        },
        locQuanHuyen() {
            this.loc_tinh = this.list_quan_huyen.filter(v => v.id_tinh_thanh === this.create_dia_diem.id_tinh_thanh);
        },
        locQuanHuyen_update() {
            this.loc_tinh_update = this.list_quan_huyen.filter(v => v.id_tinh_thanh === this.update_dia_diem.id_tinh_thanh);
        },
        loadDataDiaDiem() {
            baseRequest.get('admin/dia-diem/lay-du-lieu').then((res) => {
                if (res.data.status) {
                    this.list_dia_diem = res.data.dia_diem;
                } else {
                    toaster.error('Thông báo<br>' + res.data.message);
                }
            });
        },
        loadDataQuanHuyen() {
            baseRequest.get('admin/quan-huyen/lay-du-lieu').then((res) => {
                if (res.data.status) {
                    this.list_quan_huyen = res.data.quan_huyen;
                }
            });
        },
        loadDataTinhThanh() {
            baseRequest.get('admin/tinh-thanh/lay-du-lieu').then((res) => {
                if (res.data.status) {
                    this.list_tinh_thanh = res.data.tinh_thanh;
                }
            });
        },
        searchDiaDiem() {
            baseRequest.post('admin/dia-diem/tim-dia-diem', this.key_search).then((res) => {
                if (res.data.status) {
                    this.list_dia_diem = res.data.dia_diem;
                } else {
                    toaster.error('Thông báo<br>' + res.data.message);
                }
            });
        },
        themMoiDiaDiem() {
            baseRequest.post('admin/dia-diem/them-moi-dia-diem', this.create_dia_diem).then((res) => {
                if (res.data.status) {
                    toaster.success('Thông báo<br>' + res.data.message);
                    this.loadDataDiaDiem();
                    this.create_dia_diem = { tinh_trang: 1, loai_dia_diem: 1, id_tinh_thanh: '', id_quan_huyen: '' };
                } else {
                    toaster.error('Thông báo<br>' + res.data.message);
                }
            });
        },
        deleteDiaDiem() {
            baseRequest.delete('admin/dia-diem/xoa-dia-diem/' + this.delete_dia_diem.id).then((res) => {
                if (res.data.status) {
                    toaster.success('Thông báo<br>' + res.data.message);
                    this.loadDataDiaDiem();
                } else {
                    toaster.error('Thông báo<br>' + res.data.message);
                }
            });
        },
        updateDiaDiem() {
            baseRequest.post('admin/dia-diem/cap-nhat-dia-diem', this.update_dia_diem).then((res) => {
                if (res.data.status) {
                    toaster.success('Thông báo<br>' + res.data.message);
                    this.loadDataDiaDiem();
                } else {
                    toaster.error('Thông báo<br>' + res.data.message);
                }
            });
        },
        doiTinhTrang(v) {
            baseRequest.post('admin/dia-diem/doi-tinh-trang-dia-diem', v).then((res) => {
                if (res.data.status) {
                    toaster.success('Thông báo<br>' + res.data.message);
                    this.loadDataDiaDiem();
                } else {
                    toaster.error('Thông báo<br>' + res.data.message);
                }
            });
        },
        convertToSlug(str) {
            str = str.toLowerCase();
            str = str.normalize('NFD').replace(/[\u0300-\u036f]/g, '');
            str = str.replace(/[đĐ]/g, 'd');
            str = str.replace(/([^0-9a-z-\s])/g, '');
            str = str.replace(/(\s+)/g, '-');
            str = str.replace(/-+/g, '-');
            str = str.replace(/^-+|-+$/g, '');
            return str;
        },
        addSlug() {
            this.create_dia_diem.slug = this.convertToSlug(this.create_dia_diem.ten_dia_diem || '');
        },
    },
}
</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@400;500;600;700&display=swap');

.dia-diem-wrapper {
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

/* Tối ưu hiển thị Hình Ảnh */
.thumbnail-img {
    width: 60px;
    height: 45px;
    object-fit: cover;
    border-radius: 6px;
    border: 1px solid #eee;
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