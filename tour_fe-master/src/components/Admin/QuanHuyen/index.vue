<template>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-lg-12 text-center ">
                            <button style="width: 50%;" class="btn btn-primary mb-3 mb-lg-0" data-bs-toggle="modal"
                                data-bs-target="#ModalThemQuanHuyen">
                                <i class="bx bxs-plus-square "></i>Thêm mới Quận/Huyện</button>
                        </div>
                    </div>
                    <div class="modal fade" id="ModalThemQuanHuyen" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Thêm mới Quận/Huyện</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-2">
                                        <label>Tên Quận/Huyện</label>
                                        <input v-model="create_quan_huyen.ten_quan_huyen" type="text"
                                            class="form-control mt-2">
                                    </div>

                                    <div class="mb-2">
                                        <label>Tình Trạng</label>
                                        <select v-model="create_quan_huyen.tinh_trang" class="form-control">
                                            <option value="1">Đang Hoạt Động</option>
                                            <option value="0">Dừng Kinh Doanh</option>
                                        </select>
                                    </div>
                                    <div class="mb-2">
                                        <label>Tỉnh Thành</label>
                                        <select v-model="create_quan_huyen.id_tinh_thanh" class="form-control">
                                            <template v-for="(value, index) in list_tinh_thanh" :key="index">
                                                <option v-bind:value="value.id">{{ value.ten_tinh_thanh }}</option>
                                            </template>
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary "
                                        data-bs-dismiss="modal">Close</button>
                                    <button data-bs-dismiss="modal" v-on:click="themMoiQuanHuyen()" type="button"
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
                <div style="max-height: 100px;" class="card-header ">
                    <h5 class="text-center text-dark">Danh Sách Quận, Huyện</h5>
                    <div class="input-group mb-3 ">
                        <input v-on:keyup.enter="searchQuanHuyen()" v-model="key_search.abc" type="text"
                            class="form-control search-control" placeholder="Nhập thông tin cần tìm">
                        <button v-on:click="searchQuanHuyen()" class="btn btn-primary ">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive" style="max-height: 270px">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th class="align-middle text-center">#</th>
                                    <th class="align-middle text-center">Tên Tỉnh Thành</th>
                                    <th class="align-middle text-center">Tên Quận Huyện</th>
                                    <th class="align-middle text-center">Tình trạng</th>
                                    <th class="align-middle text-center">ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(v, k) in list_quan_huyen" :key="k">
                                    <th class="align-middle text-center">{{ k + 1 }}</th>
                                    <td class="align-middle">{{ v.ten_tinh_thanh }}</td>
                                    <td class="align-middle">{{ v.ten_quan_huyen }}</td>
                                    <td class="align-middle text-center">
                                        <button v-on:click="doiTinhTrang(v)" v-if="v.tinh_trang == 1"
                                            class="btn btn-success ">Hoạt Động</button>
                                        <button v-on:click="doiTinhTrang(v)" v-else class="btn btn-warning ">Tạm
                                            Dừng</button>
                                    </td>
                                    <td class="align-middle text-center">
                                        <button v-on:click="Object.assign(update_quan_huyen, v)"
                                            class="btn btn-info me-2 " data-bs-toggle="modal"
                                            data-bs-target="#capNhatModal">Cập Nhật</button>
                                        <button v-on:click="id_can_xoa = v.id" class="btn btn-danger "
                                            data-bs-toggle="modal" data-bs-target="#xoaModal">Xóa</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal fade" id="xoaModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Xoá Quận/Huyện</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="alert alert-danger" role="alert">
                                        Bạn thật sự có muốn xoá Quận/Huyện này không?
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary "
                                        data-bs-dismiss="modal">Close</button>
                                    <button v-on:click="deleteQuanHuyen()" type="button" class="btn btn-danger "
                                        data-bs-dismiss="modal">Xác Nhận Xoá</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="capNhatModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Cập Nhật Quận/Huyện</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-2">
                                        <label>Tên Quận/Huyện</label>
                                        <input v-model="update_quan_huyen.ten_quan_huyen" type="text"
                                            class="form-control mt-2">
                                    </div>
                                    <div class="mb-2">
                                        <label>Tỉnh Thành</label>
                                        <select v-model="update_quan_huyen.id_tinh_thanh" class="form-control">
                                            <template v-for="(value, index) in list_tinh_thanh" :key="index">
                                                <option v-bind:value="value.id">{{ value.ten_tinh_thanh }}</option>
                                            </template>
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary "
                                        data-bs-dismiss="modal">Close</button>
                                    <button v-on:click="updateQuanHuyen()" type="button" class="btn btn-info "
                                        data-bs-dismiss="modal">Xác Nhận Cập Nhật</button>
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
            list_tinh_thanh: [],
            list_quan_huyen: [],
            key_search: {},
            create_quan_huyen: {},
            id_can_xoa: '',
            update_quan_huyen: {},
        }
    },
    mounted() {
        this.loadDataTinhThanh();
        this.loadDataQuanHuyen();
    },
    methods: {
        loadDataQuanHuyen() {
            baseRequest
                .get('admin/quan-huyen/lay-du-lieu')
                .then((res) => {
                    if (res.data.status) {
                        this.list_quan_huyen = res.data.quan_huyen;
                    } else {
                        toaster.error('Thông báo<br>' + res.data.message);
                    }
                });
        },
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
        searchQuanHuyen() {
            baseRequest
                .post('admin/quan-huyen/tim-quan-huyen', this.key_search)
                .then((res) => {
                    if (res.data.status) {
                        this.list_quan_huyen = res.data.quan_huyen;
                    } else {
                        toaster.error('Thông báo<br>' + res.data.message);
                    }
                });
        },
        themMoiQuanHuyen() {
            baseRequest
                .post('admin/quan-huyen/them-moi-quan-huyen', this.create_quan_huyen)
                .then((res) => {
                    if (res.data.status) {
                        toaster.success('Thông báo<br>' + res.data.message);
                        this.loadDataQuanHuyen();
                    }
                    else {
                        toaster.error(); ('Thông báo<br>' + res.data.message);
                    }
                });
        },
        deleteQuanHuyen() {
            baseRequest
                .delete('admin/quan-huyen/xoa-quan-huyen/' + this.id_can_xoa)
                .then((res) => {
                    if (res.data.status) {
                        toaster.success('Thông báo<br>' + res.data.message);
                        this.loadDataQuanHuyen();
                    }
                    else {
                        toaster.error('Thông báo<br>' + res.data.message);
                    }
                });
        },

        updateQuanHuyen() {
            baseRequest
                .post('admin/quan-huyen/cap-nhat-quan-huyen', this.update_quan_huyen)
                .then((res) => {
                    if (res.data.status) {
                        toaster.success('Thông báo<br>' + res.data.message);
                        this.loadDataQuanHuyen();
                    }
                    else {
                        toaster.error('Thông báo<br>' + res.data.message);
                    }
                });
        },

        doiTinhTrang(v) {
            baseRequest
                .post('admin/quan-huyen/doi-tinh-trang-quan-huyen', v)
                .then((res) => {
                    if (res.data.status) {
                        toaster.success('Thông báo<br>' + res.data.message);
                        this.loadDataQuanHuyen();
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