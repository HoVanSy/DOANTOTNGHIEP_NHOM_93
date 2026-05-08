<template>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-lg-12 text-center  ">
                            <button style="width: 50%;" class="btn btn-primary mb-3 mb-lg-0 " data-bs-toggle="modal"
                                data-bs-target="#ModalThemKhachHang">
                                <i class="bx bxs-plus-square"></i>Thêm Mới Khách Hàng</button>
                        </div>
                    </div>
                    <div class="modal fade" id="ModalThemKhachHang" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Thêm Mới Khách Hàng</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mt-2 me-2">
                                        <label>Họ và tên</label>
                                        <input v-model="create_khach_hang.ho_ten" type="text" class="form-control">
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mt-2 me-2">
                                                <label>Email</label>
                                                <input v-model="create_khach_hang.email" type="email"
                                                    class="form-control">
                                            </div>
                                            <div class="mt-2 me-2">
                                                <label>Mật khẩu</label>
                                                <input v-model="create_khach_hang.password" type="password"
                                                    class="form-control">
                                            </div>
                                            <div class="mt-2 me-2">
                                                <label>Nhập lại mật khẩu</label>
                                                <input v-model="create_khach_hang.re_password" type="password"
                                                    class="form-control">
                                            </div>

                                            <div class="mt-2 me-2">
                                                <label>Số điện thoại</label>
                                                <input v-model="create_khach_hang.so_dien_thoai" type="text"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mt-2 me-2">
                                                <label>Địa Chỉ</label>
                                                <select v-model="create_khach_hang.dia_chi" class="form-control">
                                                    <template v-for="(v, k) in list_tinh_thanh" :key="k">
                                                        <option v-bind:value="v.id">{{ v.ten_tinh_thanh }}</option>
                                                    </template>
                                                </select>
                                            </div>
                                            <div class="mt-2 me-2">
                                                <label>Ngày sinh</label>
                                                <input v-model="create_khach_hang.ngay_sinh" type="date"
                                                    class="form-control">
                                            </div>
                                            <div class="mt-2 me-2">
                                                <label>Giới Tính</label>
                                                <select v-model="create_khach_hang.gioi_tinh" class="form-control">
                                                    <option value="0">Nữ</option>
                                                    <option value="1">Nam</option>
                                                </select>
                                            </div>
                                            <div class="mt-2 me-2">
                                                <label>Tình Trạng</label>
                                                <select v-model="create_khach_hang.tinh_trang" class="form-control">
                                                    <option value="1">Hoạt Động</option>
                                                    <option value="0">Dừng</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary "
                                        data-bs-dismiss="modal">Close</button>
                                    <button data-bs-dismiss="modal" v-on:click="themMoiKhachHang()" type="button"
                                        class="btn btn-primary ">Thêm
                                        Mới</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="card">
                <div style="max-height: 100px;" class="card-header">
                    <h5 class="text-center text-dark">Danh Sách Khách Hàng</h5>
                    <div class="input-group mb-3 ">
                        <input v-on:keyup.enter="searchKhachHang()" v-model="key_search.abc" type="text"
                            class="form-control search-control" placeholder="Nhập thông tin cần tìm">
                        <button v-on:click="searchKhachHang()" class="btn btn-primary ">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive" style="height: 280px;">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th class="align-middle text-center">#</th>
                                    <th class="align-middle text-center">Họ Và Tên</th>
                                    <th class="align-middle text-center">Email</th>
                                    <th class="align-middle text-center">Số Điện Thoại</th>
                                    <th class="align-middle text-center">Ngày Sinh</th>
                                    <th class="align-middle text-center">Địa Chỉ</th>
                                    <th class="align-middle text-center">Giới Tính</th>
                                    <th class="align-middle text-center">Tình Trạng</th>
                                    <th class="align-middle text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(v, k) in list_khach_hang" :key="k">
                                    <th class="align-middle text-center">{{ k + 1 }}</th>
                                    <td class="align-middle">{{ v.ho_ten }}</td>
                                    <td class="align-middle">{{ v.email }}</td>
                                    <td class="align-middle">{{ v.so_dien_thoai }}</td>
                                    <td class="align-middle">{{ v.ngay_sinh }}</td>
                                    <td class="align-middle text-center">{{ v.ten_tinh_thanh }}</td>
                                    <td class="align-middle text-center">
                                        <template v-if="v.gioi_tinh == 1">
                                            Nam
                                        </template>
                                        <template v-if="v.gioi_tinh == 0">
                                            Nữ
                                        </template>
                                    </td>
                                    <td class="align-middle text-center">
                                        <button v-on:click="doiTinhTrang(v)" v-if="v.tinh_trang == 1"
                                            class="btn btn-success ">Hoạt Động</button>
                                        <button v-on:click="doiTinhTrang(v)" v-else class="btn btn-warning  ">Tạm
                                            Dừng</button>
                                    </td>
                                    <td class="align-middle text-center">
                                        <button v-on:click="Object.assign(update_khach_hang, v)"
                                            class="btn btn-info me-2 " data-bs-toggle="modal"
                                            data-bs-target="#capNhatModal">Cập Nhật</button>
                                        <button v-on:click="id_can_xoa = v.id" class="btn btn-danger "
                                            data-bs-toggle="modal" data-bs-target="#xoaModal">Xóa</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal fade modal-lg" id="capNhatModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Cập Nhật Khách Hàng</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mt-2 me-2">
                                        <label>Họ và tên</label>
                                        <input v-model="update_khach_hang.ho_ten" type="text" class="form-control">
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mt-2 me-2">
                                                <label>Email</label>
                                                <input v-model="update_khach_hang.email" type="email"
                                                    class="form-control">
                                            </div>
                                            <div class="mt-2 me-2">
                                                <label>Số điện thoại</label>
                                                <input v-model="update_khach_hang.so_dien_thoai" type="text"
                                                    class="form-control">
                                            </div>
                                            <div class="mt-2 me-2">
                                                <label>Giới Tính</label>
                                                <select v-model="update_khach_hang.gioi_tinh" class="form-control">
                                                    <option value="0">Nữ</option>
                                                    <option value="1">Nam</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mt-2 me-2">
                                                <label>Địa Chỉ</label>
                                                <select v-model="update_khach_hang.dia_chi" class="form-control">
                                                    <template v-for="(v, k) in list_tinh_thanh" :key="k">
                                                        <option v-bind:value="v.id">{{ v.ten_tinh_thanh }}</option>
                                                    </template>
                                                </select>
                                            </div>
                                            <div class="mt-2 me-2">
                                                <label>Ngày sinh</label>
                                                <input v-model="update_khach_hang.ngay_sinh" type="date"
                                                    class="form-control">
                                            </div>

                                            <div class="mt-2 me-2">
                                                <label>Tình Trạng</label>
                                                <select v-model="update_khach_hang.tinh_trang" class="form-control">
                                                    <option value="1">Hoạt Động</option>
                                                    <option value="0">Dừng</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary "
                                        data-bs-dismiss="modal">Close</button>
                                    <button data-bs-dismiss="modal" v-on:click="updateKhachHang()" type="button"
                                        class="btn btn-primary ">Cập Nhật</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="xoaModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Xoá Khách Hàng</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="alert alert-danger" role="alert">
                                        Bạn thật sự có muốn xoá khách hàng này không?
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary "
                                        data-bs-dismiss="modal">Close</button>
                                    <button v-on:click="deleteKhachHang()" type="button" class="btn btn-danger "
                                        data-bs-dismiss="modal">Xác Nhận Xoá</button>
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
            list_khach_hang: [],
            list_tinh_thanh: [],
            key_search: {},
            create_khach_hang: {},
            id_can_xoa: '',
            update_khach_hang: {},
        }
    },
    mounted() {
        this.loadDataKhachHang();
        this.loadDataTinhThanh();
    },
    methods: {
        loadDataTinhThanh() {
            baseRequest
                .get('admin/tinh-thanh/lay-du-lieu')
                .then((res) => {
                    if (res.data.status) {
                        this.list_tinh_thanh = res.data.tinh_thanh;
                    } else {
                        toaster.error('Thông báo<br>' + res.data.message);
                    }
                });
        },
        loadDataKhachHang() {
            baseRequest
                .get('admin/khach-hang/lay-du-lieu')
                .then((res) => {
                    if (res.data.status) {
                        this.list_khach_hang = res.data.khach_hang;
                    } else {
                        toaster.error('Thông báo<br>' + res.data.message);
                    }
                });
        },
        themMoiKhachHang() {
            baseRequest
                .post('admin/khach-hang/them-moi-khach-hang', this.create_khach_hang)
                .then((res) => {
                    if (res.data.status == true) {
                        toaster.success('Thông báo<br>' + res.data.message);
                        this.loadDataKhachHang();
                    }
                    else {
                        toaster.error(); ('Thông báo<br>' + res.data.message);
                    }
                });
        },
        searchKhachHang() {
            baseRequest
                .post('admin/khach-hang/tim-khach-hang', this.key_search)
                .then((res) => {
                    if (res.data.status) {
                        this.list_khach_hang = res.data.khach_hang;
                    } else {
                        toaster.error('Thông báo<br>' + res.data.message);
                    }
                });
        },
        deleteKhachHang() {
            baseRequest
                .delete('admin/khach-hang/xoa-khach-hang/' + this.id_can_xoa)
                .then((res) => {
                    if (res.data.status == true) {
                        toaster.success('Thông báo<br>' + res.data.message);
                        this.loadDataKhachHang();
                    }
                    else {
                        toaster.error('Thông báo<br>' + res.data.message);
                    }
                });
        },

        updateKhachHang() {
            baseRequest
                .post('admin/khach-hang/cap-nhat-khach-hang', this.update_khach_hang)
                .then((res) => {
                    if (res.data.status == true) {
                        toaster.success('Thông báo<br>' + res.data.message);
                        this.loadDataKhachHang();
                    }
                    else {
                        toaster.error('Thông báo<br>' + res.data.message);
                    }
                });
        },

        doiTinhTrang(v) {
            baseRequest
                .post('admin/khach-hang/doi-tinh-trang-khach-hang', v)
                .then((res) => {
                    if (res.data.status == true) {
                        toaster.success('Thông báo<br>' + res.data.message);
                        this.loadDataKhachHang();
                    }
                    else {
                        toaster.error('Thông báo<br>' + res.data.message);
                    }
                });
        }
    },
}
</script>
<style></style>