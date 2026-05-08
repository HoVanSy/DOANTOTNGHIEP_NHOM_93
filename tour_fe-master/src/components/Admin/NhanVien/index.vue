<template>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-lg-12 text-center  ">
                            <button style="width: 50%;" class="btn btn-primary mb-3 mb-lg-0 " data-bs-toggle="modal"
                                data-bs-target="#ModalThemNhanVien">
                                <i class="bx bxs-plus-square"></i>Thêm mới nhân viên</button>
                        </div>
                    </div>
                    <div class="modal fade" id="ModalThemNhanVien" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Thêm mới nhân viên</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mt-2 me-2">
                                        <label>Họ và tên</label>
                                        <input v-model="create_nhan_vien.ho_ten" type="text" class="form-control">
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mt-2 me-2">
                                                <label>Mã nhân viên</label>
                                                <input v-model="create_nhan_vien.ma_nhan_vien" type="text"
                                                    class="form-control">
                                            </div>
                                            <div class="mt-2 me-2">
                                                <label>Ngày sinh</label>
                                                <input v-model="create_nhan_vien.ngay_sinh" type="date"
                                                    class="form-control">
                                            </div>
                                            <div class="mt-2 me-2">
                                                <label>Số điện thoại</label>
                                                <input v-model="create_nhan_vien.so_dien_thoai" type="text"
                                                    class="form-control">
                                            </div>
                                            <div class="mt-2 me-2">
                                                <label>Mật khẩu</label>
                                                <input v-model="create_nhan_vien.password" type="password"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mt-2 me-2">
                                                <label>Email</label>
                                                <input v-model="create_nhan_vien.email" type="email"
                                                    class="form-control">
                                            </div>
                                            <div class="mt-2 me-2">
                                                <label>Chức vụ</label>
                                                <select v-model="create_nhan_vien.id_chuc_vu" class="form-control">
                                                    <template v-for="(v, k) in list_chuc_vu" :key="k">
                                                        <option v-bind:value="v.id">{{ v.ten_chuc_vu }}</option>
                                                    </template>
                                                </select>
                                            </div>
                                            <div class="mt-2 me-2">
                                                <label>Tình Trạng</label>
                                                <select v-model="create_nhan_vien.tinh_trang" class="form-control">
                                                    <option value="1">Hoạt Động</option>
                                                    <option value="0">Dừng</option>
                                                </select>
                                            </div>
                                            <div class="mt-2 me-2">
                                                <label>Nhập lại mật khẩu</label>
                                                <input v-model="create_nhan_vien.re_password" type="password"
                                                    class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary "
                                        data-bs-dismiss="modal">Close</button>
                                    <button data-bs-dismiss="modal" v-on:click="themMoiNhanVien()" type="button"
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
                    <h5 class="text-center text-dark">Danh Sách Nhân Viên</h5>
                    <div class="input-group mb-3 ">
                        <input v-on:keyup.enter="searchNhanVien()" v-model="key_search.abc" type="text"
                            class="form-control search-control" placeholder="Nhập thông tin cần tìm">
                        <button v-on:click="searchNhanVien()" class="btn btn-primary ">
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
                                    <th class="align-middle text-center">Họ và tên</th>
                                    <th class="align-middle text-center">Mã nhân viên</th>
                                    <th class="align-middle text-center">Email</th>
                                    <th class="align-middle text-center">Số điện thoại</th>
                                    <th class="align-middle text-center">Ngày sinh</th>
                                    <th class="align-middle text-center">Chức vụ</th>
                                    <th class="align-middle text-center">Tình Trạng</th>
                                    <th class="align-middle text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(v, k) in list_nhan_vien" :key="k">
                                    <th class="align-middle text-center">{{ k + 1 }}</th>
                                    <td class="align-middle">{{ v.ho_ten }}</td>
                                    <td class="align-middle">{{ v.ma_nhan_vien }}</td>
                                    <td class="align-middle">{{ v.email }}</td>
                                    <td class="align-middle">{{ v.so_dien_thoai }}</td>
                                    <td class="align-middle">{{ v.ngay_sinh }}</td>
                                    <td class="align-middle text-center">{{ v.ten_chuc_vu }}</td>
                                    <td class="align-middle text-center">
                                        <button v-on:click="doiTinhTrang(v)" v-if="v.tinh_trang == 1"
                                            class="btn btn-success ">Hoạt Động</button>
                                        <button v-on:click="doiTinhTrang(v)" v-else class="btn btn-warning  ">Tạm
                                            Dừng</button>
                                    </td>
                                    <td class="align-middle text-center">
                                        <button v-on:click="Object.assign(update_nhan_vien, v)"
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
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Cập Nhật Nhân Viên</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mt-2 me-2">
                                        <label>Họ và tên</label>
                                        <input v-model="update_nhan_vien.ho_ten" type="text" class="form-control">
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mt-2 me-2">
                                                <label>Mã nhân viên</label>
                                                <input v-model="update_nhan_vien.ma_nhan_vien" type="text"
                                                    class="form-control">
                                            </div>
                                            <div class="mt-2 me-2">
                                                <label>Ngày sinh</label>
                                                <input v-model="update_nhan_vien.ngay_sinh" type="date"
                                                    class="form-control">
                                            </div>
                                            <div class="mt-2 me-2">
                                                <label>Số điện thoại</label>
                                                <input v-model="update_nhan_vien.so_dien_thoai" type="text"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mt-2 me-2">
                                                <label>Email</label>
                                                <input v-model="update_nhan_vien.email" type="email"
                                                    class="form-control">
                                            </div>
                                            <div class="mt-2 me-2">
                                                <label>Chức vụ</label>
                                                <select v-model="create_nhan_vien.id_chuc_vu" class="form-control">
                                                    <template v-for="(v, k) in list_chuc_vu" :key="k">
                                                        <option v-bind:value="v.id">{{ v.ten_chuc_vu }}</option>
                                                    </template>
                                                </select>
                                            </div>
                                            <div class="mt-2 me-2">
                                                <label>Tình Trạng</label>
                                                <select v-model="update_nhan_vien.tinh_trang" class="form-control">
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
                                    <button v-on:click="updateNhanVien()" type="button" class="btn btn-info "
                                        data-bs-dismiss="modal">Xác Nhận Cập Nhật</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="xoaModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Xoá nhân viên</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="alert alert-danger" role="alert">
                                        Bạn thật sự có muốn xoá nhân viên này không?
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary "
                                        data-bs-dismiss="modal">Close</button>
                                    <button v-on:click="deleteNhanVien()" type="button" class="btn btn-danger "
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
            list_nhan_vien: [],
            key_search: {},
            create_nhan_vien: {},
            id_can_xoa: '',
            update_nhan_vien: {},
            list_chuc_vu: [],
        }
    },
    mounted() {
        this.loadDataNhanVien();
        this.loadDataChucVu();
    },
    methods: {
        loadDataNhanVien() {
            baseRequest
                .get('admin/nhan-vien/lay-du-lieu')
                .then((res) => {
                    if (res.data.status) {
                        this.list_nhan_vien = res.data.nhan_vien;
                    } else {
                        toaster.error('Thông báo<br>' + res.data.message);
                    }
                });
        },
        themMoiNhanVien() {
            baseRequest
                .post('admin/nhan-vien/them-moi-nhan-vien', this.create_nhan_vien)
                .then((res) => {
                    if (res.data.status == true) {
                        toaster.success('Thông báo<br>' + res.data.message);
                        this.loadDataNhanVien();
                    }
                    else {
                        toaster.error(); ('Thông báo<br>' + res.data.message);
                    }
                });
        },
        searchNhanVien() {
            baseRequest
                .post('admin/nhan-vien/tim-nhan-vien', this.key_search)
                .then((res) => {
                    if (res.data.status) {
                        this.list_nhan_vien = res.data.nhan_vien;
                    } else {
                        toaster.error('Thông báo<br>' + res.data.message);
                    }
                });
        },
        deleteNhanVien() {
            baseRequest
                .delete('admin/nhan-vien/xoa-nhan-vien/' + this.id_can_xoa)
                .then((res) => {
                    if (res.data.status == true) {
                        toaster.success('Thông báo<br>' + res.data.message);
                        this.loadDataNhanVien();
                    }
                    else {
                        toaster.error('Thông báo<br>' + res.data.message);
                    }
                });
        },

        updateNhanVien() {
            baseRequest
                .post('admin/nhan-vien/cap-nhat-nhan-vien', this.update_nhan_vien)
                .then((res) => {
                    if (res.data.status == true) {
                        toaster.success('Thông báo<br>' + res.data.message);
                        this.loadDataNhanVien();
                    }
                    else {
                        toaster.error('Thông báo<br>' + res.data.message);
                    }
                });
        },

        doiTinhTrang(v) {
            baseRequest
                .post('admin/nhan-vien/doi-tinh-trang-nhan-vien', v)
                .then((res) => {
                    if (res.data.status == true) {
                        toaster.success('Thông báo<br>' + res.data.message);
                        this.loadDataNhanVien();
                    }
                    else {
                        toaster.error('Thông báo<br>' + res.data.message);
                    }
                });
        },

        loadDataChucVu() {
            baseRequest
                .get('admin/chuc-vu/lay-du-lieu')
                .then((res) => {
                    if (res.data.status) {
                        this.list_chuc_vu = res.data.chuc_vu;
                    } else {
                        toaster.error('Thông báo<br>' + res.data.message);
                    }
                });
        },
    },
}
</script>
<style></style>