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
                            <template v-for="(v, k) in list_hoa_don">
                                <tr>
                                    <td><b>#{{ v.id }}</b></td>
                                    <td>{{ v.tieu_de }}</td>
                                    <td>{{ v.ho_ten }}</td>
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
                                                v-bind:href="'/client/hoa-don/' + v.id" class="ms-2 bg-light-info"><i
                                                    class="fa-solid fa-print text-primary"></i></a>
                                            <div v-else-if="v.tinh_trang == 0" class="d-flex order-actions">
                                                <a type="button" title="Xác Nhận" @click="xacNhanHoaDon(v)"
                                                    class="ms-2 bg-light-success"><i
                                                        class="fa-solid fa-check text-success"></i></a>
                                                <a type="button" v-on:click="Object.assign(huy_hoa_don, v)" title="Hủy"
                                                    data-bs-toggle="modal" data-bs-target="#huyModal"
                                                    class="ms-2 bg-light-danger"><i
                                                        class="fa-solid fa-xmark text-danger"></i></a>
                                            </div>
                                            <a v-bind:href="'/client/chi-tiet-tour/' + v.id_tour" type="button"
                                                title="Đặt Lại Tour" v-else-if="v.tinh_trang == 2"
                                                class="ms-2 bg-light-secondary"><i
                                                    class="fa-solid fa-arrows-rotate text-secondary"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            </template>
                        </tbody>
                    </table>
                </div>
                <div class="modal fade" id="huyModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-body d-flex">
                                <div
                                    class="alert border-0 border-start border-5 border-danger alert-dismissible fade show py-2">
                                    <div class="d-flex align-items-center">
                                        <div class="font-35 text-danger"><i class="bx bxs-message-square-x"></i>
                                        </div>
                                        <div class="ms-3">
                                            <h6 class="mb-0 text-danger">Thông Báo</h6>
                                            <div>Bạn chắc chắn muốn hủy hóa đơn này?</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button data-bs-dismiss="modal" @click="huyHoaDon(huy_hoa_don)"
                                class="btn btn-border bg-light-danger align-middle">
                                <h5 class="text-danger mt-1">Xác Nhận</h5>
                            </button>
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
                        console.log(this.list_hoa_don);
                    } else {
                        toaster.error('Thông báo<br>' + res.data.message);
                    }
                });
        },

        formatToVND(number) {
            number = parseInt(number);
            return number.toLocaleString('vi-VN', { style: 'currency', currency: 'VND' });
        },
        formatDate(date) {
            if (!date) return ''; // Kiểm tra nếu không có ngày
            const d = new Date(date);
            const day = String(d.getDate()).padStart(2, '0'); // Lấy ngày, thêm số 0 nếu cần
            const month = String(d.getMonth() + 1).padStart(2, '0'); // Tháng + 1, thêm số 0
            const year = d.getFullYear(); // Lấy năm
            return `${day}/${month}/${year}`; // Trả về chuỗi định dạng dd/mm/yyyy
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