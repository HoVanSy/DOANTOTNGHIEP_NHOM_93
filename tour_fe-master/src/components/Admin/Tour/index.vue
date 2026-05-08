<template>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-lg-12 text-center">
                            <button style="width: 50%" class="btn btn-primary mb-3 mb-lg-0" data-bs-toggle="modal"
                                data-bs-target="#ModalThemTour">
                                <i class="bx bxs-plus-square"></i>Thêm Mới Tour
                            </button>
                        </div>
                    </div>
                    <div class="modal fade" id="ModalThemTour" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Thêm Mới Tour</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mt-2 me-2">
                                                <label>Tiêu Đề Tour</label>
                                                <input v-model="create_tour.ho_ten" type="text" class="form-control" />
                                            </div>
                                            <div class="mt-2 me-2">
                                                <label>Slug</label>
                                                <input v-model="create_tour.slug" type="text" class="form-control" />
                                            </div>
                                            <div class="mt-2 me-2">
                                                <label>Số Lượng Khách</label>
                                                <input v-model="create_tour.so_luong_khach" type="text"
                                                    class="form-control" />
                                            </div>
                                            <div class="mt-2 me-2">
                                                <label>Mô Tả Chi Tiết</label>
                                                <textarea v-model="create_tour.mo_ta_chi_tiet" class="form-control"
                                                    id="exampleFormControlTextarea1" rows="4"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mt-2 me-2">
                                                <label>Ngày Bắt Đầu</label>
                                                <input v-model="create_tour.ngay_bat_dau" type="date"
                                                    class="form-control" />
                                            </div>
                                            <div class="mt-2 me-2">
                                                <label>Ngày Kết Thúc</label>
                                                <input v-model="create_tour.ngay_ket_thuc" type="date"
                                                    class="form-control" />
                                            </div>
                                            <div class="mt-2 me-2">
                                                <label>Giá Người Lớn</label>
                                                <input v-model="create_tour.gia_nguoi_lon" type="text"
                                                    class="form-control" />
                                            </div>
                                            <div class="mt-2 me-2">
                                                <label>Giá Trẻ Em</label>
                                                <input v-model="create_tour.gia_tre_em" type="text"
                                                    class="form-control" />
                                            </div>
                                            <!-- <div class="mt-2 me-2">
                                                <label>Khách Hàng</label>
                                                <select v-model="create_tour.id_khach_hang" class="form-control">
                                                    <template v-for="(value, index) in list_khach_hang"
                                                        :key="index">
                                                        <option v-bind:value="value.id">{{ value.ho_ten }}</option>
                                                    </template>
</select>
</div>
<div class="mt-2 me-2">
    <label>Nhân Viên</label>
    <input v-model="create_tour.id_nhan_vien" type="text" class="form-control" />
</div> -->
                                            <div class="mt-2 me-2">
                                                <label>Tình Trạng</label>
                                                <select v-model="create_tour.tinh_trang" class="form-control">
                                                    <option value="1">Hoạt Động</option>
                                                    <option value="0">Dừng</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="mt-2 me-2">
                                                <label>Mô Tả</label>
                                                <textarea v-model="create_tour.mo_ta" class="form-control"
                                                    id="exampleFormControlTextarea1" rows="4"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary " data-bs-dismiss="modal">
                                        Close
                                    </button>
                                    <button data-bs-dismiss="modal" v-on:click="themMoiTour()" type="button"
                                        class="btn btn-primary ">
                                        Thêm Mới
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="card">
                <div style="max-height: 100px" class="card-header">
                    <h5 class="text-center text-dark">Danh Sách Tour</h5>
                    <div class="input-group mb-3">
                        <input v-on:keyup.enter="searchTour()" v-model="key_search.abc" type="text"
                            class="form-control search-control" placeholder="Nhập thông tin cần tìm" />
                        <button v-on:click="searchTour()" class="btn btn-primary">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive" style="max-height: 280px">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th class="align-middle text-center">#</th>
                                    <th class="align-middle text-center">Tiêu Đề Tour</th>
                                    <th class="align-middle text-center">Slug</th>
                                    <th class="align-middle text-center">Hình Ảnh</th>
                                    <th class="align-middle text-center">Ngày Bắt Đầu</th>
                                    <th class="align-middle text-center">Ngày Kế Thúc</th>
                                    <th class="align-middle text-center">Mô Tả</th>
                                    <th class="align-middle text-center">Mô Tả Chi Tiết</th>
                                    <th class="align-middle text-center">Tình Trạng</th>
                                    <th class="align-middle text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <template v-for="(v, k) in list_tour" :key="k">
                                    <tr>
                                        <th class="align-middle text-center">{{ k + 1 }}</th>
                                        <td class="align-middle">{{ v.tieu_de }}</td>
                                        <td class="align-middle">{{ v.slug }}</td>
                                        <td class="align-middle">
                                            <img v-bind:src="v.link_anh" alt="" class="form-control" />
                                        </td>
                                        <td class="align-middle">{{ v.ngay_bat_dau }}</td>
                                        <td class="align-middle">{{ v.ngay_ket_thuc }}</td>
                                        <td class="align-middle text-center">
                                            <i class="fa-solid fa-notes-medical fa-2x text-info"
                                                v-on:click="Object.assign(detail_tour, v)" data-bs-toggle="modal"
                                                data-bs-target="#chiTietModal"></i>
                                        </td>
                                        <td class="align-middle text-center">
                                            <i class="fa-solid fa-notes-medical fa-2x text-info"
                                                v-on:click="Object.assign(detail_tour_ct, v)" data-bs-toggle="modal"
                                                data-bs-target="#chiTietModalCT"></i>
                                        </td>
                                        <td class="align-middle text-center">
                                            <button v-on:click="doiTinhTrang(v)" v-if="v.tinh_trang == 1"
                                                class="btn btn-success ">
                                                Hoạt Động
                                            </button>
                                            <button v-on:click="doiTinhTrang(v)" v-else class="btn btn-warning ">
                                                Tạm Dừng
                                            </button>
                                        </td>
                                        <td class="align-middle text-center">
                                            <button v-on:click="Object.assign(update_tour, v)"
                                                class="btn btn-info me-2 " data-bs-toggle="modal"
                                                data-bs-target="#capNhatModal">
                                                Cập Nhật
                                            </button>
                                            <button v-on:click="id_can_xoa = v.id" class="btn btn-danger "
                                                data-bs-toggle="modal" data-bs-target="#xoaModal">
                                                Xóa
                                            </button>
                                        </td>
                                    </tr>
                                </template>
                                <!-- modal mô tả -->
                                <div class="modal fade" id="chiTietModal" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: none">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Mô Tả Tour</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- <p>{{ detail_tour.mo_ta }}</p> -->
                                                <textarea class="form-control" id="" rows="4">{{
                                                    detail_tour.mo_ta
                                                }}</textarea>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                    Đóng
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- modal mô tả chi tiết -->
                                <div class="modal fade" id="chiTietModalCT" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: none">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Mô Tả Chi Tiết</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- <p>{{ detail_tour.mo_ta }}</p> -->
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                    Đóng
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal fade modal-lg" id="capNhatModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Cập Nhật Tour</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mt-2 me-2">
                                                <label>Tiêu Đề Tour</label>
                                                <input v-model="update_tour.tieu_de" type="text" class="form-control" />
                                            </div>
                                            <div class="mt-2 me-2">
                                                <label>Slug</label>
                                                <input v-model="update_tour.slug" type="text" class="form-control" />
                                            </div>
                                            <div class="mt-2 me-2">
                                                <label>Số Lượng Khách</label>
                                                <input v-model="update_tour.so_luong_khach" type="text"
                                                    class="form-control" />
                                            </div>
                                            <div class="mt-2 me-2">
                                                <label>Mô Tả Chi Tiết</label>
                                                <textarea v-model="update_tour.mo_ta_chi_tiet" class="form-control"
                                                    id="exampleFormControlTextarea1" rows="4"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mt-2 me-2">
                                                <label>Ngày Bắt Đầu</label>
                                                <input v-model="update_tour.ngay_bat_dau" type="date"
                                                    class="form-control" />
                                            </div>
                                            <div class="mt-2 me-2">
                                                <label>Ngày Kết Thúc</label>
                                                <input v-model="update_tour.ngay_ket_thuc" type="date"
                                                    class="form-control" />
                                            </div>
                                            <div class="mt-2 me-2">
                                                <label>Giá Người Lớn</label>
                                                <input v-model.number="update_tour.gia_nguoi_lon" type="text"
                                                    class="form-control" />
                                            </div>
                                            <div class="mt-2 me-2">
                                                <label>Giá Trẻ Em</label>
                                                <input v-model.number="update_tour.gia_tre_em" type="text"
                                                    class="form-control" />
                                            </div>
                                            <!-- <div class="mt-2 me-2">
                                                <label>Khách Hàng</label>
                                                <input v-model="update_tour.id_khach_hang" type="text"
                                                    class="form-control" />
                                            </div>
                                            <div class="mt-2 me-2">
                                                <label>Nhân Viên</label>
                                                <input v-model="update_tour.id_nhan_vien" type="text"
                                                    class="form-control" />
                                            </div> -->
                                            <div class="mt-2 me-2">
                                                <label>Tình Trạng</label>
                                                <select v-model="update_tour.tinh_trang" class="form-control">
                                                    <option value="1">Hoạt Động</option>
                                                    <option value="0">Dừng</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="mt-2 me-2">
                                                <label>Mô Tả</label>
                                                <textarea v-model="update_tour.mo_ta" class="form-control"
                                                    id="exampleFormControlTextarea1" rows="4"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary " data-bs-dismiss="modal">
                                        Close
                                    </button>
                                    <button data-bs-dismiss="modal" v-on:click="updateTour()" type="button"
                                        class="btn btn-primary ">
                                        Cập Nhật
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="xoaModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Xoá Tour</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="alert alert-danger" role="alert">
                                        Bạn thật sự có muốn xoá tour này không?
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary " data-bs-dismiss="modal">
                                        Close
                                    </button>
                                    <button v-on:click="deleteTour()" type="button" class="btn btn-danger "
                                        data-bs-dismiss="modal">
                                        Xác Nhận Xoá
                                    </button>
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
import baseRequest from "../../../core/baseRequest";
import { createToaster } from "@meforma/vue-toaster";
const toaster = createToaster({ position: "top-right" });
export default {
    data() {
        return {
            list_tour: [],
            list_tinh_thanh: [],
            key_search: {},
            create_tour: {},
            id_can_xoa: "",
            update_tour: {},
            detail_tour: {},
            detail_tour_ct: {},
            // list_khach_hang: [],
        };
    },
    mounted() {
        this.loadDataTour();
        // this.loadDataKhachHang();
        // this.loadDataTinhThanh();
    },
    methods: {
        // loadDataTinhThanh() {
        //     baseRequest
        //         .get('admin/tinh-thanh/lay-du-lieu')
        //         .then((res) => {
        //             if(res.data.status){
        //                 this.list_tinh_thanh = res.data.tinh_thanh;
        //             }else{
        //                 toaster.error('Thông báo<br>' + res.data.message);
        //             }
        //         });
        // },
        loadDataTour() {
            baseRequest.get("admin/tour/lay-du-lieu").then((res) => {
                if (res.data.status) {
                    this.list_tour = res.data.tour;
                } else {
                    toaster.error("Thông báo<br>" + res.data.message);
                }
            });
        },
        themMoiTour() {
            baseRequest.post("admin/tour/them-moi-tour", this.create_tour).then((res) => {
                if (res.data.status == true) {
                    toaster.success("Thông báo<br>" + res.data.message);
                    this.loadDataTour();
                } else {
                    toaster.error();
                    "Thông báo<br>" + res.data.message;
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
            baseRequest.delete("admin/tour/xoa-tour/" + this.id_can_xoa).then((res) => {
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
        },

        formatToVND(number) {
            number = parseInt(number);
            return number.toLocaleString('vi-VN', { style: 'currency', currency: 'VND' });
        },
    },
};
</script>
<style></style>
