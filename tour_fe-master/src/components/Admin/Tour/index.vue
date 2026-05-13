<template>
    <div class="tour-wrapper mt-3">
        <div class="row g-4">
            
            <div class="col-12 col-xl-4">
                <div class="card border-0 shadow-sm rounded-4 h-100">
                    <div class="card-header bg-white border-bottom-0 pt-4 pb-2">
                        <h6 class="mb-0 fw-bold text-dark">
                            <i class="fa-solid fa-square-plus text-primary-dark me-2"></i>Thêm Mới Tour
                        </h6>
                    </div>
                    <div class="card-body">
                        <form @submit.prevent="themMoiTour">
                            <div class="mb-3">
                                <label class="form-label-custom">Tiêu Đề Tour</label>
                                <input v-model="create_tour.tieu_de" @keyup="addSlug()" type="text" class="form-control custom-input" placeholder="Nhập tên tour du lịch..." required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label-custom">Slug (Đường dẫn)</label>
                                <input v-model="create_tour.slug" type="text" class="form-control custom-input bg-light" disabled placeholder="tu-dong-tao-slug...">
                            </div>

                            <div class="mb-3">
                                <label class="form-label-custom">Link Hình Ảnh</label>
                                <input v-model="create_tour.link_anh" type="text" class="form-control custom-input" placeholder="https://..." required>
                            </div>

                            <div class="row">
                                <div class="col-sm-6 mb-3">
                                    <label class="form-label-custom">Ngày Bắt Đầu</label>
                                    <input v-model="create_tour.ngay_bat_dau" type="date" class="form-control custom-input" required>
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <label class="form-label-custom">Ngày Kết Thúc</label>
                                    <input v-model="create_tour.ngay_ket_thuc" type="date" class="form-control custom-input" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6 mb-3">
                                    <label class="form-label-custom">Giá Người Lớn</label>
                                    <input v-model.number="create_tour.gia_nguoi_lon" type="number" class="form-control custom-input" placeholder="VNĐ" required>
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <label class="form-label-custom">Giá Trẻ Em</label>
                                    <input v-model.number="create_tour.gia_tre_em" type="number" class="form-control custom-input" placeholder="VNĐ" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6 mb-3">
                                    <label class="form-label-custom">Số Lượng Khách</label>
                                    <input v-model.number="create_tour.so_luong_khach" type="number" class="form-control custom-input" placeholder="Số người..." required>
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <label class="form-label-custom">Tình trạng</label>
                                    <select v-model="create_tour.tinh_trang" class="form-select custom-input" required>
                                        <option value="1">Hoạt Động</option>
                                        <option value="0">Tạm Dừng</option>
                                    </select>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label-custom">Mô Tả Ngắn</label>
                                <textarea v-model="create_tour.mo_ta" class="form-control custom-input" rows="2" placeholder="Nhập mô tả ngắn..."></textarea>
                            </div>

                            <div class="mb-4">
                                <label class="form-label-custom">Mô Tả Chi Tiết (Lịch trình)</label>
                                <textarea v-model="create_tour.mo_ta_chi_tiet" class="form-control custom-input" rows="3" placeholder="Nhập chi tiết lịch trình..."></textarea>
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
                            <i class="fa-solid fa-list-ul text-primary-dark me-2"></i>Danh Sách Tour
                        </h6>
                        
                        <div class="search-box">
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="fa-solid fa-magnifying-glass text-muted"></i></span>
                                <input @keyup.enter="searchTour()" v-model="key_search.abc" type="text" class="form-control border-start-0 bg-light" placeholder="Tìm kiếm tour...">
                                <button @click="searchTour()" class="btn btn-primary-dark px-3">Tìm</button>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card-body p-0">
                        <div class="table-responsive" style="max-height: 800px; overflow-y: auto;">
                            <table class="table table-hover align-middle mb-0 custom-table">
                                <thead class="table-light sticky-top">
                                    <tr>
                                        <th width="5%" class="text-center">#</th>
                                        <th width="35%">Thông Tin Tour</th>
                                        <th width="20%">Thời Gian</th>
                                        <th width="15%">Giá & Khách</th>
                                        <th width="12%" class="text-center">Thông Tin</th>
                                        <th width="13%" class="text-center">Trạng Thái & Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(v, k) in list_tour" :key="k">
                                        <th class="text-center text-muted fw-medium">{{ k + 1 }}</th>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img :src="v.link_anh" class="thumbnail-img me-3" alt="Tour IMG" onerror="this.src='https://placehold.co/100x70?text=No+Image'">
                                                <div>
                                                    <h6 class="mb-1 text-dark fw-bold font-14">{{ v.tieu_de }}</h6>
                                                    <small class="text-muted fst-italic">{{ v.slug }}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="font-13 mb-1"><i class="fa-solid fa-calendar-check text-success me-2"></i>{{ v.ngay_bat_dau }}</div>
                                            <div class="font-13"><i class="fa-solid fa-calendar-xmark text-danger me-2"></i>{{ v.ngay_ket_thuc }}</div>
                                        </td>
                                        <td>
                                            <div class="font-13 mb-1 text-dark fw-bold" title="Giá Người Lớn"><i class="fa-solid fa-person me-2 opacity-50"></i>{{ formatToVND(v.gia_nguoi_lon) }}</div>
                                            <div class="font-13 mb-1 text-secondary fw-semibold" title="Giá Trẻ Em"><i class="fa-solid fa-child me-2 opacity-50"></i>{{ formatToVND(v.gia_tre_em) }}</div>
                                            <span class="badge bg-light text-dark border">Max: {{ v.so_luong_khach }} khách</span>
                                        </td>
                                        <td class="text-center">
                                            <div class="d-flex justify-content-center gap-1">
                                                <button @click="Object.assign(detail_tour, v)" class="btn-action action-info" data-bs-toggle="modal" data-bs-target="#chiTietModal" title="Xem mô tả ngắn">
                                                    <i class="fa-solid fa-circle-info"></i>
                                                </button>
                                                <button @click="Object.assign(detail_tour_ct, v)" class="btn-action action-info-detail" data-bs-toggle="modal" data-bs-target="#chiTietModalCT" title="Xem lịch trình chi tiết">
                                                    <i class="fa-solid fa-list-check"></i>
                                                </button>
<<<<<<< HEAD
=======
                                                <button @click="openLichTrinhModal(v)" class="btn-action action-map" data-bs-toggle="modal" data-bs-target="#lichTrinhModal" title="Quản lý lịch trình map">
                                                    <i class="fa-solid fa-map-location-dot"></i>
                                                </button>
>>>>>>> master
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex flex-column align-items-center gap-2">
                                                <button @click="doiTinhTrang(v)" v-if="v.tinh_trang == 1" class="btn badge-status status-active w-100">Hoạt động</button>
                                                <button @click="doiTinhTrang(v)" v-else class="btn badge-status status-pause w-100">Tạm dừng</button>
                                                
                                                <div class="d-flex justify-content-center gap-2 w-100">
                                                    <button @click="Object.assign(update_tour, v)" class="btn-action action-edit w-50" data-bs-toggle="modal" data-bs-target="#capNhatModal" title="Cập nhật">
                                                        <i class="fa-solid fa-pen-to-square"></i>
                                                    </button>
                                                    <button @click="Object.assign(delete_tour, v)" class="btn-action action-delete w-50" data-bs-toggle="modal" data-bs-target="#xoaModal" title="Xóa">
                                                        <i class="fa-solid fa-trash-can"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr v-if="list_tour.length === 0">
                                        <td colspan="6" class="text-center py-5 text-muted">
                                            <i class="fa-solid fa-box-open fa-2x mb-2 opacity-50"></i>
                                            <p class="mb-0">Không tìm thấy dữ liệu tour.</p>
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
                        <h5 class="modal-title fw-bold"><i class="fa-solid fa-pen-to-square text-primary-dark me-2"></i>Cập Nhật Tour</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body pt-4">
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label class="form-label-custom">Tiêu Đề Tour</label>
                                <input v-model="update_tour.tieu_de" @keyup="addSlugUpdate()" type="text" class="form-control custom-input">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label-custom">Slug</label>
                                <input v-model="update_tour.slug" type="text" class="form-control custom-input bg-light">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label-custom">Link Hình Ảnh</label>
                                <input v-model="update_tour.link_anh" type="text" class="form-control custom-input">
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label class="form-label-custom">Ngày Bắt Đầu</label>
                                <input v-model="update_tour.ngay_bat_dau" type="date" class="form-control custom-input">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label-custom">Ngày Kết Thúc</label>
                                <input v-model="update_tour.ngay_ket_thuc" type="date" class="form-control custom-input">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label-custom">Giá Người Lớn</label>
                                <input v-model.number="update_tour.gia_nguoi_lon" type="number" class="form-control custom-input">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label-custom">Giá Trẻ Em</label>
                                <input v-model.number="update_tour.gia_tre_em" type="number" class="form-control custom-input">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label-custom">Số Lượng Khách</label>
                                <input v-model.number="update_tour.so_luong_khach" type="number" class="form-control custom-input">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label-custom">Tình trạng</label>
                                <select v-model="update_tour.tinh_trang" class="form-select custom-input">
                                    <option value="1">Hoạt động</option>
                                    <option value="0">Tạm dừng</option>
                                </select>
                            </div>

                            <div class="col-md-12 mb-3">
                                <label class="form-label-custom">Mô Tả Ngắn</label>
                                <textarea v-model="update_tour.mo_ta" class="form-control custom-input" rows="3"></textarea>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label-custom">Mô Tả Chi Tiết</label>
                                <textarea v-model="update_tour.mo_ta_chi_tiet" class="form-control custom-input" rows="4"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-top-0 pt-0">
                        <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Hủy</button>
                        <button @click="updateTour()" type="button" class="btn btn-primary-dark rounded-pill px-4" data-bs-dismiss="modal">Lưu Thay Đổi</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="chiTietModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 shadow-lg rounded-4">
                    <div class="modal-header border-bottom-0 pb-0">
                        <h5 class="modal-title fw-bold text-info"><i class="fa-solid fa-circle-info me-2"></i>Mô Tả Ngắn</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body pt-3">
                        <div class="p-3 bg-light rounded-3 text-dark font-14" style="white-space: pre-line;">
                            {{ detail_tour.mo_ta || 'Không có mô tả.' }}
                        </div>
                    </div>
                    <div class="modal-footer border-top-0 pt-0">
                        <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Đóng</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="chiTietModalCT" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content border-0 shadow-lg rounded-4">
                    <div class="modal-header border-bottom-0 pb-0">
                        <h5 class="modal-title fw-bold text-primary"><i class="fa-solid fa-list-check me-2"></i>Lịch Trình Chi Tiết</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body pt-3">
                        <div class="p-4 bg-light rounded-3 text-dark font-14 border" style="white-space: pre-line; line-height: 1.6;">
                            {{ detail_tour_ct.mo_ta_chi_tiet || 'Chưa cập nhật lịch trình.' }}
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
                        <p class="text-muted mb-4">Bạn có chắc chắn muốn xóa tour <b class="text-danger">{{ delete_tour.tieu_de }}</b> không? Hành động này không thể hoàn tác.</p>
                        <div class="d-flex justify-content-center gap-3">
                            <button type="button" class="btn btn-light px-4 rounded-pill fw-medium" data-bs-dismiss="modal">Đóng</button>
                            <button @click="deleteTour()" data-bs-dismiss="modal" type="button" class="btn btn-danger px-4 rounded-pill fw-medium">Xác Nhận Xóa</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<<<<<<< HEAD
=======
        <!-- Modal Lịch Trình Map -->
        <div class="modal fade" id="lichTrinhModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-centered">
                <div class="modal-content border-0 shadow-lg rounded-4">
                    <div class="modal-header border-bottom">
                        <h5 class="modal-title fw-bold">
                            <i class="fa-solid fa-map-location-dot text-primary-dark me-2"></i>
                            Lịch Trình Map - {{ selected_tour.tieu_de }}
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="mb-3">
                                    <label class="form-label-custom">Ngày thứ</label>
                                    <input v-model="lich_trinh_form.so_ngay" type="number" class="form-control custom-input" placeholder="VD: 1, 2, 3..." min="1">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label-custom">Tiêu đề</label>
                                    <input v-model="lich_trinh_form.tieu_de" type="text" class="form-control custom-input" placeholder="VD: Ngày 1 - Khởi hành...">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label-custom">Mô tả</label>
                                    <textarea v-model="lich_trinh_form.mo_ta" class="form-control custom-input" rows="2" placeholder="Mô tả chi tiết lịch trình..."></textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label-custom">Điểm đi</label>
                                    <input v-model="lich_trinh_form.dia_diem_di" type="text" class="form-control custom-input" placeholder="VD: Hà Nội">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label-custom">Điểm đến</label>
                                    <input v-model="lich_trinh_form.dia_diem_den" type="text" class="form-control custom-input" placeholder="VD: TP Hồ Chí Minh">
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label-custom">Phương tiện</label>
                                        <input v-model="lich_trinh_form.phuong_tien" type="text" class="form-control custom-input" placeholder="VD: Máy bay">
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label class="form-label-custom">Giờ đi</label>
                                        <input v-model="lich_trinh_form.gio_khoi_hanh" type="time" class="form-control custom-input">
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label class="form-label-custom">Giờ về</label>
                                        <input v-model="lich_trinh_form.gio_ket_thuc" type="time" class="form-control custom-input">
                                    </div>
                                </div>
                                <div class="d-grid gap-2">
                                    <button @click="saveLichTrinh()" class="btn btn-primary-dark rounded-pill">
                                        <i class="fa-solid fa-plus me-2"></i>{{ is_edit_lich_trinh ? 'Cập nhật' : 'Thêm mới' }}
                                    </button>
                                    <button v-if="is_edit_lich_trinh" @click="cancelEditLichTrinh()" class="btn btn-secondary rounded-pill">
                                        Hủy chỉnh sửa
                                    </button>
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div id="map-container-admin" class="map-container-admin rounded-3 overflow-hidden mb-3"></div>
                                <div class="table-responsive" style="max-height: 250px;">
                                    <table class="table table-sm table-hover align-middle mb-0">
                                        <thead class="table-light">
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th>Ngày</th>
                                                <th>Tiêu đề</th>
                                                <th>Điểm đến</th>
                                                <th class="text-center">Hành động</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="(item, index) in list_lich_trinh" :key="index">
                                                <td class="text-center">
                                                    <span class="badge" :style="{ backgroundColor: markerColors[index % markerColors.length], color: 'white' }">{{ item.so_ngay }}</span>
                                                </td>
                                                <td>{{ item.so_ngay }}</td>
                                                <td>{{ item.tieu_de }}</td>
                                                <td>{{ item.dia_diem_den }}</td>
                                                <td class="text-center">
                                                    <button @click="editLichTrinh(item)" class="btn btn-sm btn-outline-primary me-1">
                                                        <i class="fa-solid fa-pen"></i>
                                                    </button>
                                                    <button @click="deleteLichTrinh(item.id)" class="btn btn-sm btn-outline-danger">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            <tr v-if="list_lich_trinh.length === 0">
                                                <td colspan="5" class="text-center text-muted py-3">
                                                    Chưa có lịch trình nào
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

>>>>>>> master
    </div>
</template>

<script>
import baseRequest from "../../../core/baseRequest";
import { createToaster } from "@meforma/vue-toaster";
<<<<<<< HEAD
=======
import axios from "axios";
>>>>>>> master
const toaster = createToaster({ position: "top-right" });

export default {
    data() {
        return {
            list_tour: [],
            key_search: {},
            create_tour: { tinh_trang: 1 },
<<<<<<< HEAD
            delete_tour: {}, // Đổi object để chứa title xóa
            update_tour: {},
            detail_tour: {},
            detail_tour_ct: {},
=======
            delete_tour: {},
            update_tour: {},
            detail_tour: {},
            detail_tour_ct: {},
            selected_tour: {},
            list_lich_trinh: [],
            lich_trinh_form: {},
            is_edit_lich_trinh: false,
            map: null,
            markers: [],
            markerColors: ['#0d7a5f', '#e8a020', '#dc3545', '#6f42c1', '#17a2b8', '#28a745']
>>>>>>> master
        };
    },
    mounted() {
        this.loadDataTour();
    },
    methods: {
        formatToVND(number) {
            return (parseInt(number) || 0).toLocaleString('vi-VN', { style: 'currency', currency: 'VND' });
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
            this.create_tour.slug = this.convertToSlug(this.create_tour.tieu_de || '');
        },

        addSlugUpdate() {
            this.update_tour.slug = this.convertToSlug(this.update_tour.tieu_de || '');
        },

        loadDataTour() {
            baseRequest.get("admin/tour/lay-du-lieu").then((res) => {
                if (res.data.status) {
                    this.list_tour = res.data.tour;
                } else {
                    toaster.error("Thông báo<br>" + res.data.message);
                }
            });
        },
        
<<<<<<< HEAD
=======
        // Lịch trình map methods
        openLichTrinhModal(tour) {
            this.selected_tour = tour;
            this.lich_trinh_form = { id_tour: tour.id, so_ngay: 1 };
            this.is_edit_lich_trinh = false;
            this.loadLichTrinh(tour.id);
            this.$nextTick(() => {
                this.initLeafletMap();
            });
        },
        
        loadLichTrinh(tour_id) {
            baseRequest.get("admin/lich-trinh/lay-du-lieu/" + tour_id).then((res) => {
                if (res.data.status) {
                    this.list_lich_trinh = res.data.lich_trinh;
                    this.updateMapPreview();
                }
            });
        },
        
        initLeafletMap() {
            if (this.map) {
                this.map.remove();
            }
            
            const link = document.createElement('link');
            link.rel = 'stylesheet';
            link.href = 'https://unpkg.com/leaflet@1.9.4/dist/leaflet.css';
            if (!document.querySelector('link[href*="leaflet"]')) {
                document.head.appendChild(link);
            }
            
            const script = document.createElement('script');
            script.src = 'https://unpkg.com/leaflet@1.9.4/dist/leaflet.js';
            script.onload = () => {
                if (this.map) return;
                
                this.map = L.map('map-container-admin').setView([16.0544, 108.2022], 6);
                
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; OpenStreetMap contributors'
                }).addTo(this.map);
                
                this.updateMapPreview();
            };
            if (!window.L) {
                document.head.appendChild(script);
            } else {
                this.updateMapPreview();
            }
        },
        
        async updateMapPreview() {
            if (!window.L || !this.map) return;
            
            this.map.eachLayer((layer) => {
                if (layer instanceof L.Marker || layer instanceof L.Polyline) {
                    this.map.removeLayer(layer);
                }
            });
            
            for (let i = 0; i < this.list_lich_trinh.length; i++) {
                const item = this.list_lich_trinh[i];
                try {
                    const coords = await this.geocode(item.dia_diem_den);
                    if (coords) {
                        const color = this.markerColors[i % this.markerColors.length];
                        const icon = L.divIcon({
                            html: `<div style="background-color: ${color}; color: white; width: 30px; height: 30px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold; border: 3px solid white; box-shadow: 0 2px 5px rgba(0,0,0,0.3);">${i + 1}</div>`,
                            className: 'custom-marker',
                            iconSize: [30, 30],
                            iconAnchor: [15, 15]
                        });
                        
                        L.marker([coords.lat, coords.lon], { icon: icon })
                            .addTo(this.map)
                            .bindPopup(`<b>${item.tieu_de}</b><br>${item.dia_diem_den}`);
                    }
                } catch (error) {
                    console.log('Geocoding error');
                }
                
                if (i < this.list_lich_trinh.length - 1) {
                    const nextItem = this.list_lich_trinh[i + 1];
                    await this.drawRouteOnMap(item.dia_diem_den, nextItem.dia_diem_di);
                }
            }
            
            if (this.list_lich_trinh.length > 0) {
                const bounds = [];
                for (const item of this.list_lich_trinh) {
                    const coords = await this.geocode(item.dia_diem_den);
                    if (coords) {
                        bounds.push([coords.lat, coords.lon]);
                    }
                }
                if (bounds.length > 0) {
                    this.map.fitBounds(bounds, { padding: [50, 50] });
                }
            }
        },
        
        async geocode(address) {
            try {
                const response = await axios.get(
                    `https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(address + ', Vietnam')}`
                );
                if (response.data && response.data.length > 0) {
                    return {
                        lat: parseFloat(response.data[0].lat),
                        lon: parseFloat(response.data[0].lon)
                    };
                }
            } catch (error) {
                console.error('Geocoding error:', error);
            }
            return null;
        },
        
        async drawRouteOnMap(from, to) {
            try {
                const fromCoords = await this.geocode(from);
                const toCoords = await this.geocode(to);
                
                if (fromCoords && toCoords) {
                    const response = await axios.get(
                        `https://router.project-osrm.org/route/v1/driving/${fromCoords.lon},${fromCoords.lat};${toCoords.lon},${toCoords.lat}?overview=full&geometries=geojson`
                    );
                    
                    if (response.data && response.data.routes && response.data.routes[0]) {
                        const route = response.data.routes[0].geometry;
                        const color = this.markerColors[this.list_lich_trinh.length % this.markerColors.length];
                        
                        L.geoJSON(route, {
                            style: {
                                color: color,
                                weight: 4,
                                opacity: 0.8
                            }
                        }).addTo(this.map);
                    }
                }
            } catch (error) {
                console.error('Route drawing error:', error);
            }
        },
        
        saveLichTrinh() {
            if (!this.lich_trinh_form.tieu_de || !this.lich_trinh_form.dia_diem_den) {
                toaster.warning("Vui lòng nhập đầy đủ thông tin!");
                return;
            }
            
            this.lich_trinh_form.id_tour = this.selected_tour.id;
            
            if (this.is_edit_lich_trinh) {
                baseRequest.post("admin/lich-trinh/cap-nhat", this.lich_trinh_form).then((res) => {
                    if (res.data.status) {
                        toaster.success("Cập nhật lịch trình thành công!");
                        this.loadLichTrinh(this.selected_tour.id);
                        this.lich_trinh_form = { id_tour: this.selected_tour.id, so_ngay: 1 };
                        this.is_edit_lich_trinh = false;
                    } else {
                        toaster.error(res.data.message);
                    }
                });
            } else {
                baseRequest.post("admin/lich-trinh/them-moi", this.lich_trinh_form).then((res) => {
                    if (res.data.status) {
                        toaster.success("Thêm lịch trình thành công!");
                        this.loadLichTrinh(this.selected_tour.id);
                        this.lich_trinh_form = { id_tour: this.selected_tour.id, so_ngay: this.list_lich_trinh.length + 2 };
                    } else {
                        toaster.error(res.data.message);
                    }
                });
            }
        },
        
        editLichTrinh(item) {
            this.lich_trinh_form = { ...item };
            this.is_edit_lich_trinh = true;
        },
        
        cancelEditLichTrinh() {
            this.lich_trinh_form = { id_tour: this.selected_tour.id, so_ngay: this.list_lich_trinh.length + 1 };
            this.is_edit_lich_trinh = false;
        },
        
        deleteLichTrinh(id) {
            if (confirm('Bạn có chắc muốn xóa lịch trình này?')) {
                baseRequest.delete("admin/lich-trinh/xoa/" + id).then((res) => {
                    if (res.data.status) {
                        toaster.success("Xóa lịch trình thành công!");
                        this.loadLichTrinh(this.selected_tour.id);
                    } else {
                        toaster.error(res.data.message);
                    }
                });
            }
        },
        
>>>>>>> master
        themMoiTour() {
            baseRequest.post("admin/tour/them-moi-tour", this.create_tour).then((res) => {
                if (res.data.status == true) {
                    toaster.success("Thông báo<br>" + res.data.message);
                    this.loadDataTour();
<<<<<<< HEAD
                    this.create_tour = { tinh_trang: 1 }; // Xoá trắng form
=======
                    this.create_tour = { tinh_trang: 1 };
>>>>>>> master
                } else {
                    toaster.error("Thông báo<br>" + res.data.message);
                }
            });
        },
        
        searchTour() {
            baseRequest.post("admin/tour/tim-tour", this.key_search).then((res) => {
                if (res.data.status) {
                    this.list_tour = res.data.tour;
                } else {
                    toaster.error("Thông báo<br>" + res.data.message);
                }
            });
        },

        deleteTour() {
            baseRequest.delete("admin/tour/xoa-tour/" + this.delete_tour.id).then((res) => {
                if (res.data.status == true) {
                    toaster.success("Thông báo<br>" + res.data.message);
                    this.loadDataTour();
                } else {
                    toaster.error("Thông báo<br>" + res.data.message);
                }
            });
        },

        updateTour() {
            baseRequest.post("admin/tour/cap-nhat-tour", this.update_tour).then((res) => {
                if (res.data.status == true) {
                    toaster.success("Thông báo<br>" + res.data.message);
                    this.loadDataTour();
                } else {
                    toaster.error("Thông báo<br>" + res.data.message);
                }
            });
        },

        doiTinhTrang(v) {
            baseRequest.post("admin/tour/doi-tinh-trang-tour", v).then((res) => {
                if (res.data.status == true) {
                    toaster.success("Thông báo<br>" + res.data.message);
                    this.loadDataTour();
                } else {
                    toaster.error("Thông báo<br>" + res.data.message);
                }
            });
        }
    },
};
</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@400;500;600;700&display=swap');

.tour-wrapper {
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
    width: 65px;
    height: 65px;
    object-fit: cover;
    border-radius: 8px;
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

.action-info-detail { background-color: #ede9fe; color: #4f46e5; }
.action-info-detail:hover { background-color: #4f46e5; color: #fff; }

.action-edit { background-color: #f3f4f6; color: #4b5563; }
.action-edit:hover { background-color: #0d7a5f; color: #fff; }

.action-delete { background-color: #fee2e2; color: #ef4444; }
.action-delete:hover { background-color: #ef4444; color: #fff; }

.font-13 { font-size: 13px; }
.font-14 { font-size: 14px; }
<<<<<<< HEAD
=======

/* ── MAP CONTAINER ── */
.map-container-admin {
    height: 350px;
    width: 100%;
    border: 1px solid #e5e7eb;
}

/* ── ACTION MAP BUTTON ── */
.action-map { background-color: #fef3c7; color: #d97706; }
.action-map:hover { background-color: #d97706; color: #fff; }
>>>>>>> master
</style>