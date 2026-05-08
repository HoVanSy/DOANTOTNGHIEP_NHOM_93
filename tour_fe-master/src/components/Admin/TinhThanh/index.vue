<template>
    <div class="row">
        <div class="col-4">
            <div class="card border-primary border-bottom border-3 border-0">
                <div style="max-height: 50px;" class="card-header">
                    <h5 class="text-dark">Thêm Mới Tỉnh Thành</h5>
                </div>
                <div class="card-body">
                    <label class="mb-1 mt-1">Tên Tỉnh Thành</label>
                    <input v-model="create_tinh_thanh.ten_tinh_thanh" class="form-control" type="text">
                    <label class="mb-1 mt-2">Tình Trạng</label>
                    <select v-model="create_tinh_thanh.tinh_trang" class="form-control">
                        <option value="1">Hoạt Động</option>
                        <option value="0">Tạm Dừng</option>
                    </select>
                </div>
                <div class="card-footer text-end">
                    <button v-on:click="createTinhThanh()" class="btn btn-primary">Thêm Mới</button>
                </div>
            </div>
        </div>
        <div class="col-8">
            <div class="card border-primary border-bottom border-3 border-0">
                <div style="max-height: 50px;"  class="card-header">
                    <h5 class="text-dark">Danh Sách Tỉnh Thành</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive" style="max-height: 420px">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th colspan="100%">
                                        <div class="input-group mb-3 ">
                                            <input v-on:keyup.enter="searchTinhThanh()" v-model="key_search.abc" type="text" class="form-control search-control"
                                                placeholder="Nhập thông tin cần tìm">
                                            <button v-on:click="searchTinhThanh()" class="btn btn-primary">
                                                <i class="fa-solid fa-magnifying-glass"></i>
                                            </button>
                                        </div>
                                    </th>
                                </tr>
                                <tr>
                                    <th class="align-middle text-center">#</th>
                                    <th class="align-middle text-center">Tên Tỉnh Thành</th>
                                    <th class="align-middle text-center">Tình Trạng</th>
                                    <th class="align-middle text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(v, k) in list_tinh_thanh" :key="k">
                                    <th class="align-middle text-center">{{ k + 1 }}</th>
                                    <td class="align-middle">{{ v.ten_tinh_thanh }}</td>
                                    <td class="align-middle text-center">
                                        <button v-on:click="doiTinhTrang(v)" v-if="v.tinh_trang == 1" class="btn btn-success ">Hoạt Động</button>
                                        <button v-on:click="doiTinhTrang(v)" v-else class="btn btn-warning ">Tạm
                                            Dừng</button>
                                    </td>
                                    <td class="align-middle text-center">
                                        <button v-on:click="Object.assign(update_tinh_thanh, v)" class="btn btn-info me-2 " data-bs-toggle="modal"
                                            data-bs-target="#capNhatModal">Cập Nhật</button>
                                        <button v-on:click="Object.assign(delete_tinh_thanh, v)" class="btn btn-danger " data-bs-toggle="modal"
                                            data-bs-target="#xoaModal">Xóa</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal fade" id="capNhatModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Cập Nhật Tỉnh Thành</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <label class="mb-1 mt-1">Tên Tỉnh Thành</label>
                                    <input v-model="update_tinh_thanh.ten_tinh_thanh" class="form-control" type="text">
                                    <label class="mb-1 mt-1">Tình Trạng</label>
                                    <select v-model="update_tinh_thanh.tinh_trang" class="form-control">
                                        <option value="1">Hoạt Động</option>
                                        <option value="0">Tạm Tắt</option>
                                    </select>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary "
                                        data-bs-dismiss="modal">Thoát</button>
                                    <button v-on:click="updateTinhThanh()" type="button" data-bs-dismiss="modal" class="btn btn-primary ">Cập
                                        Nhật</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="xoaModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Xóa Tỉnh Thành</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div
                                        class="alert alert-warning border-0 bg-warning alert-dismissible fade show py-2">
                                        <div class="d-flex align-items-center">
                                            <div class="font-35 text-dark"><i class="bx bx-info-circle"></i>
                                            </div>
                                            <div class="ms-3">
                                                <h6 class="mb-0 text-dark">Warning</h6>
                                                <div class="text-dark">
                                                    <p>Bạn có muốn xóa tỉnh thành <b class="text-danger">{{ delete_tinh_thanh.ten_tinh_thanh }}</b> này
                                                        không?
                                                    </p>
                                                    <p>
                                                        <b>Lưu ý:</b> Điều này không thể hoàn tác!
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary "
                                        data-bs-dismiss="modal">Thoát</button>
                                    <button v-on:click="deleteTinhThanh()" type="button" class="btn btn-danger " data-bs-dismiss="modal">Xóa</button>
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
            list_tinh_thanh     :   [],
            key_search          :   {},
            create_tinh_thanh      :   {},
            delete_tinh_thanh      :   {},
            update_tinh_thanh      :   {},
        }
    },
    mounted() {
        this.loadDataTinhThanh();
    },
    methods: {
        loadDataTinhThanh() {
            baseRequest
                .get('admin/tinh-thanh/lay-du-lieu')
                .then((res) => {
                    if(res.data.status){
                        this.list_tinh_thanh = res.data.tinh_thanh;
                    }
                    else{
                        toaster.error(res.data.message)
                    }
                });
        },

        searchTinhThanh(){
            baseRequest
                .post('admin/tinh-thanh/tim-tinh-thanh', this.key_search)
                .then((res) => {
                    if(res.data.status == true) {
                        this.list_tinh_thanh = res.data.tinh_thanh;
                    }
                    else{
                        toaster.error('Thông báo<br>' + res.data.message);
                    }
                });
        },

        createTinhThanh(){
            baseRequest
                .post('admin/tinh-thanh/them-moi-tinh-thanh', this.create_tinh_thanh)
                .then((res) => {
                    if(res.data.status == true) {
                        toaster.success('Thông báo<br>' + res.data.message);
                        this.loadDataTinhThanh();
                    }
                    else{
                        toaster.error('Thông báo<br>' + res.data.message);
                    }
                });
        },

        deleteTinhThanh(){
            baseRequest
                .delete('admin/tinh-thanh/xoa-tinh-thanh/'+ this.delete_tinh_thanh.id)
                .then((res) => {
                    if(res.data.status) {
                        toaster.success('Thông báo<br>' + res.data.message);
                        this.loadDataTinhThanh();
                    }
                    else{
                        toaster.error('Thông báo<br>' + res.data.message);
                    }
                });
        },

        updateTinhThanh(){
            baseRequest
                .post('admin/tinh-thanh/cap-nhat-tinh-thanh', this.update_tinh_thanh)
                .then((res) => {
                    if(res.data.status == true) {
                        toaster.success('Thông báo<br>' + res.data.message);
                        this.loadDataTinhThanh();
                    }
                    else{
                        toaster.error('Thông báo<br>' + res.data.message);
                    }
                });
        },

        doiTinhTrang(v){
            baseRequest
                .post('admin/tinh-thanh/doi-tinh-trang-tinh-thanh', v)
                .then((res) => {
                    if(res.data.status == true) {
                        toaster.success('Thông báo<br>' + res.data.message);
                        this.loadDataTinhThanh();
                    }
                    else{
                        toaster.error('Thông báo<br>' + res.data.message);
                    }
                });
        }
    },
}
</script>
<style></style>