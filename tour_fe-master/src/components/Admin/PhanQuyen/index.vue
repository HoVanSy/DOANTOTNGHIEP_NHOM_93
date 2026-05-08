<template>
    <div class="row">
        <div class="col-lg-4">
            <div class="card">
                <div style="height: 110px;" class="card-header ">
                    <div class="row">
                        <div class="col-lg-7">
                            <h6 class="mt-2">Danh Sách Chức Vụ</h6>
                        </div>
                        <div class="col-lg-5 text-end">
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#themMoiModal">Thêm
                                Chức Vụ</button>
                        </div>
                        <div class="col-lg-12">
                            <div class="input-group mt-3 w-100">
                                <input v-on:keyup.enter="searchChucVu()" v-model="key_search_chuc_vu.abc" type="text" class="form-control search-control border " placeholder="Search...">
                                <button v-on:click="searchChucVu()" class="btn btn-primary ">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </button>
                            </div>
                        </div>
                        <div class="modal fade" id="themMoiModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Thêm Mới Chức Vụ</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="col-12 mb-2">
                                            <label class="form-label">Tên Chức vụ</label>
                                            <input v-model="create_chuc_vu.ten_chuc_vu" type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button v-on:click="themMoiChucVu()" type="button" class="btn btn-primary"
                                            data-bs-dismiss="modal">Tạo
                                            Mới</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive" >
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Tên chức vụ</th>
                                    <th class="text-center">Cấp quyền</th>
                                    <th class="text-center">ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for= "(v, k) in list_chuc_vu" :key="k">
                                    <th class="text-center">{{k+1}}</th>
                                    <td>{{v.ten_chuc_vu}}</td>
                                    <td class="text-center">
                                        <button v-on:click="quyen_dang_chon = v, loadDataChiTiet()" class="btn btn-info text-white">Phân Quyền</button>
                                    </td>
                                    <td class="text-center">
                                        <i v-on:click="Object.assign(update_chuc_vu, v)"
                                            class="fa-solid fa-square-pen fa-3x text-primary me-2"
                                            data-bs-toggle="modal" data-bs-target="#updateModal"></i>
                                        <i v-on:click="Object.assign(delete_chuc_vu, v)"
                                            class="fa-solid fa-trash fa-3x text-danger" data-bs-toggle="modal"
                                            data-bs-target="#xoaModal"></i>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Cập Nhật Chức Vụ</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="col-12 mb-2">
                                        <label class="form-label">Tên Chức Vụ</label>
                                        <input v-model="update_chuc_vu.ten_chuc_vu" type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button v-on:click="capNhatChucVu()" type="button" class="btn btn-primary"
                                        data-bs-dismiss="modal">Xác Nhận</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="xoaModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Xóa Chức Vụ</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="alert alert-danger" role="alert">
                                        Bạn thật sự có muốn xoá chức vụ <b>{{ delete_chuc_vu.ten_chuc_vu }}</b> không?
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button v-on:click="xoaChucVu()" type="button" class="btn btn-danger"
                                        data-bs-dismiss="modal">Xóa</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div style="height: 110px;" class="card-header">
                    <div class="row">
                        <div class="col-lg-6">
                            <h6 class="mt-2">Danh Sách Chức Năng</h6>
                        </div>
                        <div class="col-lg-12">
                            <div class="input-group mt-3 w-100">
                                <input v-on:keyup.enter="searchChucNang()" v-model="key_search_chuc_nang.abc" type="text" class="form-control search-control border " placeholder="Search...">
                                <button v-on:click="searchChucNang()" class="btn btn-primary ">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div style="max-height: 350px;" class="table-responsive" >
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Tên chức năng</th>
                                    <th class="text-center">ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(v, k) in list_chuc_nang" :key="k">
                                    <th class="text-center">{{k+1}}</th>
                                    <td>{{v.ten_chuc_nang}}</td>
                                    <td class="text-center">
                                            <button v-on:click="capQuyen(v)" class="btn btn-primary">Cấp Quyền</button>
                                        </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div style="height: 50px;" class="card-header">
                    <h6>Đang Phân Quyền Cho <b class="text-danger"> {{ quyen_dang_chon.ten_chuc_vu }}</b></h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="table-responsive" style="max-height: 410px;">
                            <table class="table table-bordered">
                                <thead>
                                    <tr class="text-center text-nowrap align-middle">
                                        <th>Tên Chức Năng</th>
                                        <th>Tên Chức Vụ</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <template v-for="(v, k) in locMang()" :key="k">
                                            <tr class="align-middle">
                                                <td>{{ v.ten_chuc_nang }}</td>
                                                <td>{{ v.ten_chuc_vu }}</td>
                                                <td class="text-center">
                                                    <button v-on:click="xoaQuyen(v)" class="btn btn-danger">Xóa</button>
                                                </td>
                                            </tr>
                                    </template>
                                </tbody>
                            </table>
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
            list_chuc_vu            :   [],
            list_chuc_nang            :   [],
            list_chi_tiet            :   [],
            key_search_chuc_vu      :   {},
            key_search_chuc_nang      :   {},
            create_chuc_vu          :   {},
            delete_chuc_vu      :   {},
            update_chuc_vu          :   {},
            quyen_dang_chon         : {},
        }
    },
    mounted() {
        this.loadDataChucVu();
        this.loadDataNang();
        this.loadDataChiTiet();
    },
    methods: {
        locMang(){
            return this.list_chi_tiet.filter(value => value.id_chuc_vu == this.quyen_dang_chon.id);
        },
        loadDataChucVu() {
            baseRequest
                .get('admin/chuc-vu/lay-du-lieu')
                .then((res) => {
                    if(res.data.status){
                        this.list_chuc_vu = res.data.chuc_vu;
                    }else{
                        toaster.error('Thông báo<br>' + res.data.message);
                    }
                });
        },
        loadDataNang() {
            baseRequest
                .get('admin/chuc-nang/lay-du-lieu')
                .then((res) => {
                    if(res.data.status){
                        this.list_chuc_nang = res.data.chuc_nang;
                    }else{
                        toaster.error('Thông báo<br>' + res.data.message);
                    }
                });
        },
        loadDataChiTiet() {
            baseRequest
                .post("admin/chi-tiet-chuc-nang/lay-du-lieu", {})
                .then((res) => {
                    if(res.data.status){
                        this.list_chi_tiet = res.data.chi_tiet_phan_quyen;
                    }else{
                        toaster.error('Thông báo<br>' + res.data.message);
                    }
                });
        },
        searchChucVu() {
            baseRequest
                .post("admin/chuc-vu/tim-chuc-vu", this.key_search_chuc_vu)
                .then((res) => {
                    if(res.data.status){
                        this.list_chuc_vu = res.data.data;
                    }else{
                        toaster.error('Thông báo<br>' + res.data.message);
                    }
                });
        },
        searchChucNang() {
            baseRequest
                .post("admin/chuc-nang/tim-chuc-nang", this.key_search_chuc_nang)
                .then((res) => {
                    if(res.data.status){
                        this.list_chuc_nang = res.data.data;
                    }else{
                        toaster.error('Thông báo<br>' + res.data.message);
                    }
                });
        },
        capQuyen(chuc_nang) {
            var payload = {
                'id_chuc_vu': this.quyen_dang_chon.id,
                'id_chuc_nang': chuc_nang.id
            };
            baseRequest
                .post("admin/chi-tiet-chuc-nang/cap-quyen", payload)
                .then((res) => {
                    if(res.data.status) {
                        toaster.success(res.data.message);
                        this.loadDataChiTiet();
                    }else{
                        toaster.error(res.data.message);
                        this.loadDataChiTiet();
                    }
                });
        },
        xoaQuyen(payload) {
            baseRequest
                .post("admin/chi-tiet-chuc-nang/xoa-quyen", payload)
                .then((res) => {
                    if(res.data.status) {
                        toaster.success(res.data.message);
                        this.loadDataChiTiet();
                    }                     
                    else{
                        toaster.error('Thông báo<br>' + res.data.message);
                    }
                });
        },
        themMoiChucVu() {
            baseRequest
                .post('admin/chuc-vu/them-moi-chuc-vu', this.create_chuc_vu)
                .then((res) => {
                    if (res.data.status) {
                        toaster.success('Thông báo<br>' + res.data.message);
                        this.loadDataChucVu();
                        this.create_chuc_vu = {};
                    }
                    else{
                        toaster.error('Thông báo<br>' + res.data.message);
                    }
                });
        },
        xoaChucVu() {
            baseRequest
                .delete('admin/chuc-vu/xoa-chuc-vu/' + this.delete_chuc_vu.id)
                .then((res) => {
                    if (res.data.status) {
                        toaster.success('Thông báo<br>' + res.data.message);
                        this.loadDataChucVu();
                    } else {
                        toaster.error('Thông báo<br>' + res.data.message);
                    }
                })
        },
        capNhatChucVu() {
            baseRequest
                .post('admin/chuc-vu/cap-nhat-chuc-vu', this.update_chuc_vu)
                .then((res) => {
                    if (res.data.status) {
                        toaster.success('Thông báo<br>' + res.data.message);
                        this.loadDataChucVu();
                    } else {
                        toaster.error('Thông báo<br>' + res.data.message);
                    }
                });
        },
    },
}
</script>
<style></style>