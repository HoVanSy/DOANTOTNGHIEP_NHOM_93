<template>
    <div class="container py-4 min-vh-100 invoice-page">
        <!-- ── SECTION HEADER ── -->
        <div class="section-header mb-4">
            <span class="section-tag">Lịch sử giao dịch</span>
            <h2 class="section-title">Danh Sách Hóa Đơn</h2>
            <div class="header-line"></div>
        </div>

        <div class="card shadow-sm border-0 rounded-4 mt-1">
            <div class="card-body p-4">
                <div class="table-responsive table-wrapper">
                    <table class="table table-hover align-middle mb-0 custom-table">
                        <thead class="table-light">
                            <tr>
                                <th width="12%">Mã HĐ</th>
                                <th width="28%">Hành Trình</th>
                                <th width="15%">Khách Hàng</th>
                                <th width="15%">Ngày Đặt</th>
                                <th width="12%">Tổng Tiền</th>
                                <th width="12%">Trạng Thái</th>
                                <th width="6%" class="text-center">Xử lý</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(v, k) in list_hoa_don" :key="v.id">
                                <td><b class="text-primary-dark">#{{ v.ma_hoa_don ? v.ma_hoa_don.substring(0,8) : v.id }}</b></td>
                                
                                <td>
                                    <div class="tour-name text-truncate-2">
                                        {{ v.chi_tiet_hoa_dons?.[0]?.tour?.tieu_de || 'Chưa có thông tin tour' }}
                                    </div>
                                </td>
                                
                                <td class="text-secondary fw-medium">{{ v.khach_hang?.ho_ten || 'Khách hàng' }}</td>
                                
                                <td class="text-secondary">{{ formatDate(v.created_at) }}</td>
                                
                                <td><b class="text-danger font-15">{{ formatToVND(v.tong_tien) }}</b></td>
                                
                                <td>
                                    <span v-if="v.tinh_trang == 1" class="badge-status status-paid">
                                        <i class="fa-solid fa-circle-check me-1"></i>Đã thanh toán
                                    </span>
                                    <span v-else-if="v.tinh_trang == 0" class="badge-status status-unpaid">
                                        <i class="fa-solid fa-clock-rotate-left me-1"></i>Chờ thanh toán
                                    </span>
                                    <span v-else-if="v.tinh_trang == 2" class="badge-status status-cancel">
                                        <i class="fa-solid fa-ban me-1"></i>Đã hủy
                                    </span>
                                </td>
                                
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        <!-- Nút In Hóa Đơn -->
                                        <a title="In hóa đơn" v-if="v.tinh_trang == 1"
                                            v-bind:href="'/client/hoa-don/' + v.id" class="btn-action action-print">
                                            <i class="fa-solid fa-print"></i>
                                        </a>
                                        
                                        <!-- Nút Thanh Toán và Hủy -->
                                        <template v-else-if="v.tinh_trang == 0">
                                            <a type="button" title="Thanh Toán MoMo" @click="thanhToanATM(v)" class="btn-action action-pay">
                                                <img src="https://homepage.momocdn.net/fileuploads/svg/momo-file-240411162904.svg" width="16" alt="MOMO">
                                            </a>

                                            <a type="button" v-on:click="Object.assign(huy_hoa_don, v)" title="Hủy đơn"
                                                data-bs-toggle="modal" data-bs-target="#huyModal" class="btn-action action-delete">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </a>
                                        </template>
                                        
                                        <!-- Nút Đặt lại tour đã hủy -->
                                        <a v-bind:href="'/client/chi-tiet-tour/' + (v.chi_tiet_hoa_dons?.[0]?.id_tour || '')" type="button"
                                            title="Đặt lại tour này" v-else-if="v.tinh_trang == 2" class="btn-action action-reload">
                                            <i class="fa-solid fa-rotate-right"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <tr v-if="list_hoa_don.length === 0">
                                <td colspan="7" class="text-center py-5 text-muted">
                                    <i class="fa-solid fa-receipt fa-2x mb-3 opacity-50"></i>
                                    <p class="mb-0">Bạn chưa có hóa đơn nào.</p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                
                <!-- Modal Hủy -->
                <div class="modal fade" id="huyModal" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content border-0 rounded-4 shadow">
                            <div class="modal-body p-4 text-center">
                                <div class="mb-3 text-danger">
                                    <i class="fa-regular fa-circle-xmark fa-4x"></i>
                                </div>
                                <h5 class="fw-bold mb-2">Xác nhận hủy hóa đơn</h5>
                                <p class="text-muted mb-4 font-14">Bạn có chắc chắn muốn hủy hóa đơn <b class="text-dark">#{{ huy_hoa_don.ma_hoa_don ? huy_hoa_don.ma_hoa_don.substring(0,8) : huy_hoa_don.id }}</b> không? Hành động này không thể hoàn tác.</p>
                                <div class="d-flex justify-content-center gap-3">
                                    <button type="button" class="btn btn-light px-4 rounded-pill fw-medium font-14" data-bs-dismiss="modal">Đóng</button>
                                    <button type="button" @click="huyHoaDon(huy_hoa_don)" data-bs-dismiss="modal" class="btn btn-danger px-4 rounded-pill fw-medium font-14">Xác Nhận Hủy</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";
import baseRequest from "../../../core/baseRequestClient";
import { createToaster } from "@meforma/vue-toaster";

const toaster = createToaster({ position: "top-right" });

export default {
    data() {
        return {
            list_hoa_don: [],
            ct_hoa_don: [],
            huy_hoa_don: {}
        }
    },
    mounted() {
        this.loadDataDanhSachHoaDon();
    },
    methods: {
        loadDataDanhSachHoaDon() {
            var url = window.location.href;
            var arr = url.split('/');
            var gui_di = {
                id: arr[arr.length - 1]
            }
            baseRequest
                .post('client/hoa-don/lay-danh-sach-hoa-don/data', gui_di)
                .then((res) => {
                    if (res.data.status) {
                        this.list_hoa_don = res.data.danh_sach_hoa_don;
                    } else {
                        toaster.error('Thông báo<br>' + res.data.message);
                    }
                })
                .catch((err) => {
                    console.error("Lỗi API tải hóa đơn:", err);
                });
        },

        thanhToanATM(hoaDon) 
        {
            const payload = {
                id: hoaDon.id,
                tong_tien: hoaDon.tong_tien
            };

            axios.post("http://127.0.0.1:8000/api/momo/atm-payment", payload, {
                headers: { Authorization: 'Bearer ' + localStorage.getItem("token_client") }
            })
            .then((res) => {
                console.log("RESPONSE MOMO:", res.data);

                if (res.data.status && res.data.payUrl) {
                    window.location.href = res.data.payUrl;
                } else {
                    toaster.error(
                        "MoMo lỗi: " + JSON.stringify(res.data)
                    );
                }
            })
            .catch((error) => {
                console.error("Chi tiết lỗi:", error.response.data); 
                toaster.error("Dữ liệu gửi đi không hợp lệ (Lỗi 422)!");
            });
        },

        formatToVND(number) {
            number = parseInt(number) || 0; 
            return number.toLocaleString('vi-VN', { style: 'currency', currency: 'VND' });
        },
        
        formatDate(date) {
            if (!date) return ''; 
            const d = new Date(date);
            const day = String(d.getDate()).padStart(2, '0'); 
            const month = String(d.getMonth() + 1).padStart(2, '0'); 
            const year = d.getFullYear(); 
            return `${day}/${month}/${year}`; 
        },

        huyHoaDon(v) {
            baseRequest
                .post("client/gio-hang/huy-hoa-don-client", v)
                .then((res) => {
                    if (res.data.status == true) {
                        toaster.success(res.data.message);
                        this.loadDataDanhSachHoaDon();
                    } else {
                        toaster.error(res.data.message);
                    }
                });
        },
    },
}
</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@300;400;500;600;700&display=swap');

.invoice-page {
    font-family: 'Be Vietnam Pro', sans-serif;
    background-color: #f8f7f4; /* Nền xám nhẹ giống các trang khác */
}

/* ── HEADER ── */
.section-tag {
    font-size: 10px;
    font-weight: 700;
    letter-spacing: 1.8px;
    text-transform: uppercase;
    color: #0d7a5f;
    background: rgba(13, 122, 95, 0.1);
    padding: 4px 12px;
    border-radius: 50px;
}
.section-title {
    font-size: 26px;
    font-weight: 800;
    color: #1a1f2e;
    margin-top: 8px;
}
.header-line {
    width: 50px;
    height: 3px;
    background: #0d7a5f;
    border-radius: 50px;
}

/* ── Typography & Colors ── */
.text-primary-dark { color: #0d7a5f; }
.font-14 { font-size: 14px; }
.font-15 { font-size: 15px; }

/* ── Table Layout ── */
.table-wrapper {
    min-height: 450px;
}
.custom-table th {
    font-size: 12px;
    font-weight: 700;
    text-transform: uppercase;
    color: #6b7280;
    padding: 15px;
    background-color: #f9fafb;
    border-bottom: 2px solid #f0ede8;
}
.custom-table td {
    padding: 15px;
    font-size: 13px;
    vertical-align: middle;
}
.tour-name {
    font-weight: 600;
    color: #1a1f2e;
    max-width: 250px;
}
.text-truncate-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

/* ── Status Badges ── */
.badge-status {
    padding: 5px 12px;
    border-radius: 50px;
    font-size: 11px;
    font-weight: 700;
    display: inline-flex;
    align-items: center;
    white-space: nowrap;
}
/* Trạng thái Đã thanh toán: Màu xanh lá đậm giống theme */
.status-paid { background: #e6f5f0; color: #0d7a5f; } 
/* Trạng thái Chờ: Vàng cam đồng bộ */
.status-unpaid { background: #fff8eb; color: #e8a020; } 
/* Trạng thái Hủy: Đỏ nhạt */
.status-cancel { background: #fee2e2; color: #dc3545; }

/* ── Action Buttons ── */
.btn-action {
    width: 30px;
    height: 30px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
    transition: 0.2s ease;
    cursor: pointer;
    font-size: 13px;
}
.action-print { background: #e6f5f0; color: #0d7a5f; }
.action-print:hover { background: #0d7a5f; color: #fff; }

.action-pay { background: #fdf2f8; border: 1px solid #fbcfe8; }
.action-pay:hover { background: #fce7f3; }

.action-delete { background: #fff; border: 1.5px solid #ffeded; color: #dc3545; }
.action-delete:hover { background: #dc3545; color: #fff; border-color: #dc3545; }

.action-reload { background: #f3f4f6; color: #6b7280; }
.action-reload:hover { background: #4b5563; color: #fff; }

</style>