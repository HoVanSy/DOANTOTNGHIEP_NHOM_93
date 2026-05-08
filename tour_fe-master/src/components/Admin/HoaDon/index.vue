<template>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h3>Danh Sách Hóa Đơn</h3>
                    <!-- <div class="input-group mb-3">
                        <input type="text" class="form-control search-control" placeholder="Nhập thông tin cần tìm" />
                        <button class="btn btn-primary">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                    </div> -->
                    <div class="input-group mb-3">
                        <input v-on:keyup.enter="searchHoaDon()" v-model="key_search.abc" type="text"
                            class="form-control search-control" placeholder="Nhập thông tin cần tìm" />
                        <button v-on:click="searchHoaDon()" class="btn btn-primary">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Số Hoá Đơn</th>
                                    <th class="text-center">Tên Khách Hàng</th>
                                    <th class="text-center">Số lượng người lớn</th>
                                    <th class="text-center">Số lượng trẻ em</th>
                                    <th class="text-center">Tổng Tiền</th>
                                    <th class="text-center">Trạng Thái</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(v, k) in list_hoa_don" :key="k">
                                    <th class="text-center align-middle">{{ k + 1 }}</th>
                                    <td class="text-center align-middle">{{ v.id }}</td>
                                    <td class="text-center align-middle">{{ v.ho_ten }}</td>
                                    <td class="text-center align-middle">{{ v.so_luong_nguoi_lon }}</td>
                                    <td class="text-center align-middle">{{ v.so_luong_tre_em }}</td>
                                    <td class="text-center align-middle" style="font-weight: bold; color: crimson;">
                                        {{ formatToVND(v.tong_tien) }}</td>
                                    <td class="align-middle">
                                        <div v-if="v.tinh_trang == 1"
                                            class="badge rounded-pill text-success bg-light-success p-2 text-uppercase px-3 ms-3">
                                            <i class="bx bxs-circle align-middle me-1"></i>Đã Thanh Toán
                                        </div>
                                        <div v-else-if="v.tinh_trang == 0"
                                            class="badge rounded-pill text-warning bg-light-warning p-2 text-uppercase px-3 ms-3">
                                            <i class="bx bxs-circle align-middle me-1"></i>Chưa Thanh Toán
                                        </div>
                                        <div v-else-if="v.tinh_trang == 2"
                                            class="badge rounded-pill text-danger bg-light-danger p-2 text-uppercase px-3 ms-3">
                                            <i class="bx bxs-circle align-middle me-1"></i>Đã Hủy
                                        </div>
                                    </td>
                                    <td class="text-center align-middle">
                                        <div v-if="v.tinh_trang == 1">
                                            <a title="In Hóa Đơn" type="button" class="btn btn-outline-info me-2"
                                                v-bind:href="'/client/hoa-don/' + v.id"><i
                                                    class="fa-solid fa-print me-0"></i></a>
                                        </div>
                                        <div v-if="v.tinh_trang == 0">
                                            <button @click="xacNhanHoaDon(v)" title="Xác Nhận" type="button"
                                                class="btn btn-outline-success me-2"><i
                                                    class="fa-solid fa-check me-0"></i>
                                            </button>
                                            <button v-on:click="Object.assign(huy_hoa_don, v)" title="Hủy"
                                                data-bs-toggle="modal" data-bs-target="#huyModal" type="button"
                                                class="btn btn-outline-danger"><i class="fa-solid fa-xmark me-0"></i>
                                            </button>
                                        </div>
                                        <div v-if="v.tinh_trang == 2">
                                            <button @click="id_can_xoa = v.id" title="Xóa Khỏi Danh Sách" type="button"
                                                data-bs-toggle="modal" data-bs-target="#xoaModal"
                                                class="btn btn-outline-secondary me-2"><i
                                                    class="fa-regular fa-circle-xmark me-0"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal fade" id="huyModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-body d-flex">
                                <div
                                    class="alert border-0 border-start border-5 border-warning alert-dismissible fade show py-2">
                                    <div class="d-flex align-items-center">
                                        <div class="font-35 text-warning"><i class="bx bxs-message-square-x"></i>
                                        </div>
                                        <div class="ms-3">
                                            <h6 class="mb-0 text-warning">Thông Báo</h6>
                                            <div>Bạn chắc chắn muốn hủy hóa đơn này?</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button data-bs-dismiss="modal" @click="huyHoaDon(huy_hoa_don)"
                                class="btn btn-border bg-light-warning align-middle">
                                <h5 class="text-warning mt-1">Xác Nhận</h5>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="xoaModal" tabindex="-1" aria-labelledby="exampleModalLabel"
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
                                            <div>Bạn chắc chắn muốn xóa hóa đơn này?</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button data-bs-dismiss="modal" @click="deleteHoaDon()"
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
import baseRequest from "../../../core/baseRequest";
import { createToaster } from "@meforma/vue-toaster";
const toaster = createToaster({ position: "top-right" });
export default {
    data() {
        return {
            list_hoa_don: [],
            huy_hoa_don: {},
            id_can_xoa: "",
            key_search: {},
        }
    },
    mounted() {
        this.loadData();
    },
    methods: {
        loadData() {
            baseRequest
                .get("admin/hoa-don/lay-du-lieu")
                .then((res) => {
                    if (res.data.status) {
                        this.list_hoa_don = res.data.data;
                    } else {
                        toaster.error('Thông báo<br>' + res.data.message);
                    }
                })
        },

        formatToVND(number) {
            number = parseInt(number);
            return number.toLocaleString('vi-VN', { style: 'currency', currency: 'VND' });
        },

        xacNhanHoaDon(v) {
            baseRequest
                .post("admin/hoa-don/xac-nhan-hoa-don", v).then((res) => {
                    if (res.data.status == true) {
                        toaster.success(res.data.message);
                        this.loadData();
                    } else {
                        toaster.error(res.data.message);
                    }
                });
        },

        huyHoaDon(v) {
            baseRequest
                .post("admin/hoa-don/huy-hoa-don", v)
                .then((res) => {
                    if (res.data.status == true) {
                        toaster.success(res.data.message);
                        this.loadData();
                    } else {
                        toaster.error(res.data.message);
                    }
                });
        },

        deleteHoaDon() {
            baseRequest.delete("admin/hoa-don/xoa-hoa-don/" + this.id_can_xoa).then((res) => {
                if (res.data.status == true) {
                    toaster.success("Thông báo<br>" + res.data.message);
                    this.loadData();
                } else {
                    toaster.error("Thông báo<br>" + res.data.message);
                }
            });
        },

        searchHoaDon() {
            baseRequest.post("admin/hoa-don/tim-hoa-don", this.key_search).then((res) => {
                if (res.data.status) {
                    this.list_hoa_don = res.data.data;
                } else {
                    toaster.error("Thông báo<br>" + res.data.message);
                }
            });
        },
    },
}
</script>
<style></style>