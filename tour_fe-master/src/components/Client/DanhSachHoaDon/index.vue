<template>
    <div class="container">
        <div class="card radius-10">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div>
                        <h4 class="mb-3">Danh Sách Hóa Đơn</h4>
                    </div>
                </div>
                <div class="table-responsive" style="height: 470px;">
                    <table class="table align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Số Hóa Đơn</th>
                                <th>Tiêu Đề Tour</th>
                                <th>Tên Khách Hàng</th>
                                <th>Trạng Thái</th>
                                <th>Ngày Đặt</th>
                                <th>Thành Tiền</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(v, k) in list_hoa_don" :key="v.id">
                                <td><b>#{{ v.ma_hoa_don ? v.ma_hoa_don.substring(0,8) : v.id }}</b></td>
                                
                                <td>{{ v.chi_tiet_hoa_dons?.[0]?.tour?.tieu_de || 'Chưa có thông tin tour' }}</td>
                                
                                <td>{{ v.khach_hang?.ho_ten || 'Khách hàng' }}</td>
                                
                                <td>
                                    <div v-if="v.tinh_trang == 1"
                                        class="badge rounded-pill text-info bg-light-info p-2 text-uppercase px-3">
                                        <i class="bx bxs-circle align-middle me-1"></i>Đã Thanh Toán
                                    </div>
                                    <div v-else-if="v.tinh_trang == 0"
                                        class="badge rounded-pill text-warning bg-light-warning p-2 text-uppercase px-3">
                                        <i class="bx bxs-circle align-middle me-1"></i>Chưa Thanh Toán
                                    </div>
                                    <div v-else-if="v.tinh_trang == 2"
                                        class="badge rounded-pill text-danger bg-light-danger p-2 text-uppercase px-3">
                                        <i class="bx bxs-circle align-middle me-1"></i>Đã Hủy
                                    </div>
                                </td>
                                <td>{{ formatDate(v.created_at) }}</td>
                                <td><b class="text-danger">{{ formatToVND(v.tong_tien) }}</b></td>
                                <td>
                                    <div class="d-flex order-actions">
                                        <a title="In" v-if="v.tinh_trang == 1"
                                            v-bind:href="'/client/hoa-don/' + v.id" class="ms-2 bg-light-info">
                                            <i class="fa-solid fa-print text-primary"></i>
                                        </a>
                                        
                                        <div v-else-if="v.tinh_trang == 0" class="d-flex order-actions">
                                            <a type="button" title="Thanh Toán MOMO" @click="thanhToanATM(v)"
                                                class="ms-2 bg-light-primary text-primary border border-primary d-flex align-items-center justify-content-center">
                                                <img src="https://homepage.momocdn.net/fileuploads/svg/momo-file-240411162904.svg" width="22" alt="MOMO">
                                            </a>

                                            <a type="button" v-on:click="Object.assign(huy_hoa_don, v)" title="Hủy"
                                                data-bs-toggle="modal" data-bs-target="#huyModal"
                                                class="ms-2 bg-light-danger">
                                                <i class="fa-solid fa-xmark text-danger"></i>
                                            </a>
                                        </div>
                                        
                                        <a v-bind:href="'/client/chi-tiet-tour/' + (v.chi_tiet_hoa_dons?.[0]?.id_tour || '')" type="button"
                                            title="Đặt Lại Tour" v-else-if="v.tinh_trang == 2"
                                            class="ms-2 bg-light-secondary">
                                            <i class="fa-solid fa-arrows-rotate text-secondary"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                
                <div class="modal fade" id="huyModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-body d-flex">
                                <div class="alert border-0 border-start border-5 border-danger alert-dismissible fade show py-2 w-100">
                                    <div class="d-flex align-items-center">
                                        <div class="font-35 text-danger"><i class="bx bxs-message-square-x"></i></div>
                                        <div class="ms-3">
                                            <h6 class="mb-0 text-danger">Thông Báo</h6>
                                            <div>Bạn chắc chắn muốn hủy hóa đơn này?</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button data-bs-dismiss="modal" class="btn btn-secondary">Đóng</button>
                                <button data-bs-dismiss="modal" @click="huyHoaDon(huy_hoa_don)" class="btn btn-danger">
                                    Xác Nhận Hủy
                                </button>
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
            number = parseInt(number) || 0; // Thêm || 0 để chống lỗi NaN
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

        xacNhanHoaDon(v) {
            baseRequest
                .post("client/gio-hang/xac-nhan-hoa-don", v)
                .then((res) => {
                    if (res.data.status == true) {
                        toaster.success(res.data.message);
                        this.loadDataDanhSachHoaDon();
                    } else {
                        toaster.error(res.data.message);
                    }
                });
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

<style></style>