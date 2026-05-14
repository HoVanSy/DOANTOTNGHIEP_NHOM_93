<template>
    <div class="khuyen-mai-wrapper">
        
        <div class="d-flex align-items-center mb-3">
        </div>

        <div class="row g-4">
            <div class="col-12 col-xl-4">
                <div class="card border-0 shadow-sm rounded-4 h-100">
                    <div class="card-header bg-white border-bottom-0 pt-4 pb-2">
                        <h6 class="mb-0 fw-bold text-dark">
                            <i class="fa-solid fa-circle-plus text-primary-dark me-2"></i>Tạo Mã Khuyến Mãi
                        </h6>
                    </div>
                    <div class="card-body">
                        <form @submit.prevent="createAction">
                            <div class="mb-3 position-relative">
                                <label class="form-label-custom">Mã Code <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input v-model="create_km.ma_code" type="text" class="form-control custom-input text-uppercase fw-bold text-primary-dark" placeholder="VD: SUMMER2024" required>
                                    <button @click.prevent="generateCode()" class="btn btn-outline-secondary custom-input px-3" title="Tạo mã ngẫu nhiên">
                                        <i class="fa-solid fa-shuffle"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-6 mb-3">
                                    <label class="form-label-custom">Hình Thức Giảm</label>
                                    <select v-model="create_km.loai" class="form-select custom-input">
                                        <option value="1">Giảm theo %</option>
                                        <option value="2">Giảm tiền mặt (đ)</option>
                                    </select>
                                </div>
                                <div class="col-6 mb-3">
                                    <label class="form-label-custom">Giá Trị Giảm <span class="text-danger">*</span></label>
                                    <input v-model="create_km.gia_tri" type="number" class="form-control custom-input" placeholder="0" required>
                                </div>
                            </div>

                            <!-- <div class="mb-3">
                                <label class="form-label-custom">Đơn Hàng Tối Thiểu (đ)</label>
                                <input v-model="create_km.don_hang_toi_thieu" type="number" class="form-control custom-input" placeholder="0">
                            </div> -->

                            <div class="row">
                                <div class="col-6 mb-4">
                                    <label class="form-label-custom">Ngày Hết Hạn <span class="text-danger">*</span></label>
                                    <input v-model="create_km.ngay_ket_thuc" type="date" class="form-control custom-input" required>
                                </div>
                                <div class="col-6 mb-4">
                                    <label class="form-label-custom">Tình Trạng</label>
                                    <select v-model="create_km.tinh_trang" class="form-select custom-input">
                                        <option value="1">Hoạt động</option>
                                        <option value="0">Tạm khóa</option>
                                    </select>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label-custom text-muted mb-2"><i class="fa-regular fa-eye me-1"></i>XEM TRƯỚC HIỂN THỊ</label>
                                <div class="coupon-card p-3 bg-light-success text-center">
                                    <div class="font-18 fw-bold text-primary-dark mb-1 letter-spacing">{{ create_km.ma_code || 'CODE_NAME' }}</div>
                                    <div class="font-13 mb-2 text-dark">
                                        Giảm ngay: <span class="text-danger fw-bold">{{ create_km.loai == 1 ? create_km.gia_tri + '%' : formatToVND(create_km.gia_tri) }}</span>
                                    </div>
                                    <div class="font-11 text-muted border-top border-secondary pt-2 mt-2 border-opacity-25">
                                        Hạn dùng: {{ formatDate(create_km.ngay_ket_thuc) || 'Chưa chọn' }}<br>
                                        Áp dụng cho đơn từ {{ formatToVND(create_km.don_hang_toi_thieu) }}
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary-dark w-100 rounded-pill fw-bold">
                                <i class="fa-solid fa-cloud-arrow-up me-2"></i>TẠO MÃ NGAY
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-12 col-xl-8">
                <div class="card border-0 shadow-sm rounded-4 h-100">
                    <div class="card-header bg-white border-bottom-0 pt-4 pb-3 d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
                        <h6 class="mb-0 fw-bold text-dark">
                            <i class="fa-solid fa-list-ul text-primary-dark me-2"></i>Danh Sách Mã Code
                        </h6>
                        
                        <div class="d-flex gap-2 w-100 w-md-auto search-box">
                            <select v-model="filter_status" class="form-select bg-light border-0 w-auto" style="min-width: 140px;">
                                <option value="-1">Tất cả</option>
                                <option value="1">Đang chạy</option>
                                <option value="0">Đã khóa</option>
                            </select>
                            <div class="input-group flex-grow-1">
                                <span class="input-group-text bg-light border-end-0"><i class="fa-solid fa-magnifying-glass text-muted"></i></span>
                                <input v-model="key_search" type="text" class="form-control border-start-0 bg-light" placeholder="Tìm mã code...">
                            </div>
                        </div>
                    </div>
                    
                    <div class="card-body p-0">
                        <div class="table-responsive" style="max-height: 700px; overflow-y: auto;">
                            <table class="table table-hover align-middle mb-0 custom-table">
                                <thead class="table-light sticky-top">
                                    <tr>
                                        <th width="20%" class="ps-4">Mã Code</th>
                                        <th width="15%" class="text-center">Loại Giảm</th>
                                        <th width="15%" class="text-center">Giá Trị</th>
                                        <th width="20%" class="text-center">Hạn Dùng</th>
                                        <th width="15%" class="text-center">Trạng Thái</th>
                                        <th width="15%" class="text-center pe-4">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(v, k) in filteredList" :key="v.id">
                                        <td class="ps-4">
                                            <div class="d-flex align-items-center">
                                                <span class="badge bg-primary-dark font-13 fw-bold me-2 py-2 px-3">{{ v.ma_code }}</span>
                                                <button @click="copyToClipboard(v.ma_code)" class="btn btn-link p-0 text-muted" title="Copy mã">
                                                    <i class="fa-regular fa-copy"></i>
                                                </button>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <span v-if="v.loai == 1" class="badge rounded-pill bg-info text-dark opacity-75">Phần trăm (%)</span>
                                            <span v-else class="badge rounded-pill bg-secondary bg-opacity-25 text-dark">Tiền mặt (đ)</span>
                                        </td>
                                        <td class="text-center fw-bold text-danger font-14">
                                            {{ v.loai == 1 ? v.gia_tri + '%' : formatToVND(v.gia_tri) }}
                                        </td>
                                        <td class="text-center font-13">
                                            <div :class="isExpired(v.ngay_ket_thuc) ? 'text-danger fw-bold' : 'text-dark'">
                                                {{ formatDate(v.ngay_ket_thuc) }}
                                            </div>
                                            <small v-if="isExpired(v.ngay_ket_thuc)" class="text-danger fst-italic">(Hết hạn)</small>
                                            <!-- <div class="text-muted mt-1" style="font-size: 11px;">Đơn tối thiểu: {{ formatToVND(v.don_hang_toi_thieu) }}</div> -->
                                        </td>
                                        <td class="text-center">
                                            <div class="form-check form-switch d-flex justify-content-center m-0 p-0">
                                                <input class="form-check-input custom-switch m-0" type="checkbox" :checked="v.tinh_trang == 1" @change="doiTrangThai(v)">
                                            </div>
                                        </td>
                                        <td class="text-center pe-4">
                                            <div class="d-flex justify-content-center gap-2">
                                                <button @click="Object.assign(edit_km, v)" class="btn-action action-edit" title="Cập nhật (Chức năng đang phát triển)">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </button>
                                                <button @click="Object.assign(del_km, v)" class="btn-action action-delete" data-bs-toggle="modal" data-bs-target="#deleteModal" title="Xóa">
                                                    <i class="fa-solid fa-trash-can"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr v-if="filteredList.length === 0">
                                        <td colspan="6" class="text-center py-5 text-muted">
                                            <i class="fa-solid fa-ticket-simple fa-2x mb-2 opacity-50"></i>
                                            <p class="mb-0">Không tìm thấy mã khuyến mãi.</p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 shadow-lg rounded-4">
                    <div class="modal-body p-4 text-center">
                        <div class="mb-3 text-danger">
                            <i class="fa-solid fa-circle-exclamation fa-4x"></i>
                        </div>
                        <h5 class="fw-bold mb-2">Xác Nhận Xóa</h5>
                        <p class="text-muted mb-4">Bạn có chắc chắn muốn xóa mã <b class="text-danger">{{ del_km.ma_code }}</b> không? Hành động này không thể hoàn tác.</p>
                        <div class="d-flex justify-content-center gap-3">
                            <button type="button" class="btn btn-light px-4 rounded-pill fw-medium" data-bs-dismiss="modal">Đóng</button>
                            <button @click="xoaKhuyenMai()" data-bs-dismiss="modal" type="button" class="btn btn-danger px-4 rounded-pill fw-medium">Xác Nhận Xóa</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
import baseRequest from "../../../core/baseRequestClient";
import { createToaster } from "@meforma/vue-toaster";

const toaster = createToaster({ position: "top-right" });

export default {
    data() {
        return {
            list_km: [],
            key_search: '',
            filter_status: -1,
            create_km: { loai: 1, tinh_trang: 1, gia_tri: 0, don_hang_toi_thieu: 0, ngay_ket_thuc: '' },
            edit_km: {},
            del_km: {}
        }
    },
    computed: {
        filteredList() {
            return this.list_km.filter(item => {
                const searchMatch = item.ma_code.toLowerCase().includes(this.key_search.toLowerCase());
                const statusMatch = this.filter_status == -1 || item.tinh_trang == this.filter_status;
                return searchMatch && statusMatch;
            });
        }
    },
    mounted() {
        this.loadData();
    },
    methods: {
        // Hàm tạo mã ngẫu nhiên 8 ký tự
        generateCode() {
            const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
            let result = '';
            for (let i = 0; i < 8; i++) {
                result += characters.charAt(Math.floor(Math.random() * characters.length));
            }
            this.create_km.ma_code = result;
        },
        
        loadData() {
            baseRequest.get('admin/khuyen-mai/data').then(res => {
                this.list_km = res.data.data;
            });
        },
        
        createAction() {
            if (!this.create_km.ma_code || !this.create_km.ngay_ket_thuc || !this.create_km.gia_tri) {
                toaster.error("Vui lòng điền đầy đủ các thông tin bắt buộc (*)");
                return;
            }
            baseRequest.post('admin/khuyen-mai/create', this.create_km).then(res => {
                if (res.data.status) {
                    toaster.success(res.data.message);
                    this.loadData();
                    this.create_km = { loai: 1, tinh_trang: 1, gia_tri: 0, don_hang_toi_thieu: 0, ngay_ket_thuc: '' };
                }
            });
        },

        xoaKhuyenMai() {
            // Giả lập API Xóa, bạn nhớ thay đúng link API của bạn
            baseRequest.post('admin/khuyen-mai/delete', this.del_km).then((res) => {
                if(res.data.status) {
                    toaster.success("Xóa mã khuyến mãi thành công!");
                    this.loadData();
                } else {
                    toaster.error("Xóa thất bại!");
                }
            });
        },

        doiTrangThai(v) {
            // Đảo trạng thái trước khi gửi API
            let payload = { ...v, tinh_trang: v.tinh_trang == 1 ? 0 : 1 };
            baseRequest.post('admin/khuyen-mai/status', payload).then(res => {
                toaster.success("Đã cập nhật trạng thái!");
                this.loadData();
            });
        },

        copyToClipboard(text) {
            navigator.clipboard.writeText(text);
            toaster.info("Đã sao chép mã: " + text);
        },

        isExpired(date) {
            if(!date) return false;
            return new Date(date) < new Date(new Date().setHours(0,0,0,0));
        },

        formatToVND(n) {
            return new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(n || 0);
        },

        formatDate(date) {
            if (!date) return '';
            const d = new Date(date);
            const day = String(d.getDate()).padStart(2, '0');
            const month = String(d.getMonth() + 1).padStart(2, '0');
            const year = d.getFullYear();
            return `${day}/${month}/${year}`;
        }
    }
}
</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@400;500;600;700&display=swap');

.khuyen-mai-wrapper {
    font-family: 'Be Vietnam Pro', sans-serif;
}

/* ── MÀU SẮC CHỦ ĐẠO ── */
.text-primary-dark { color: #0d7a5f; }
.bg-primary-dark { background-color: #0d7a5f !important; color: #fff;}
.bg-light-success { background-color: #e6f5f0; }

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

/* ── SWITCH TỰ CODE (Để nó màu xanh lá) ── */
.custom-switch:checked {
    background-color: #0d7a5f;
    border-color: #0d7a5f;
}
.custom-switch:focus {
    box-shadow: 0 0 0 0.25rem rgba(13, 122, 95, 0.25);
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

/* ── COUPON CARD PREVIEW ── */
.coupon-card {
    border: 2px dashed #0d7a5f;
    border-radius: 12px;
    position: relative;
    overflow: hidden;
}
/* Tạo 2 rãnh khuyết ở 2 bên giống vé thật */
.coupon-card::before, .coupon-card::after {
    content: '';
    position: absolute;
    top: 50%;
    width: 20px;
    height: 20px;
    background: white;
    border-radius: 50%;
    transform: translateY(-50%);
}
.coupon-card::before { left: -10px; border-right: 2px dashed #0d7a5f; }
.coupon-card::after { right: -10px; border-left: 2px dashed #0d7a5f; }


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

.font-11 { font-size: 11px; }
.font-13 { font-size: 13px; }
.font-14 { font-size: 14px; }
.font-18 { font-size: 18px; }
.letter-spacing { letter-spacing: 1px; }
</style>