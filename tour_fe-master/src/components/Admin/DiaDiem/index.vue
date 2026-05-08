<template>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-lg-12 text-center ">
                            <button style="width: 50%;" class="btn btn-primary mb-3 mb-lg-0 " data-bs-toggle="modal"
                                data-bs-target="#ModalThemDiaDiem">
                                <i class="bx bxs-plus-square"></i>Thêm mới Địa điểm</button>
                        </div>
                    </div>
                    <div class="modal fade" id="ModalThemDiaDiem" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Thêm mới Địa điểm</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-2">
                                        <label>Tên địa điểm</label>
                                        <input v-model="create_dia_diem.ten_dia_diem" v-on:keyup="addSlug()" type="text"
                                            class="form-control mt-2">
                                    </div>
                                    <div class="mb-2">
                                        <label>Slug</label>
                                        <input v-model="create_dia_diem.slug" type="text" disabled
                                            class="form-control mt-2">
                                    </div>
                                    <div class="mb-2">
                                        <label>Loại địa điểm</label>
                                        <select v-model="create_dia_diem.loai_dia_diem" class="form-control">
                                            <option value="1">Khách sạn</option>
                                            <option value="2">Nhà hàng</option>
                                            <option value="3">Địa điểm tham quan</option>
                                        </select>
                                    </div>
                                    <div class="mb-2">
                                        <label>Giá Tiền</label>
                                        <input v-model="create_dia_diem.gia_tien" type="number"
                                            class="form-control mt-2">
                                    </div>
                                    <div class="mb-2">
                                        <label>Tình trạng</label>
                                        <select v-model="create_dia_diem.tinh_trang" class="form-control">
                                            <option value="1">Hoạt động</option>
                                            <option value="0">Tạm dừng</option>
                                        </select>
                                    </div>
                                    <div class="mb-2">
                                        <label>Tỉnh thành</label>
                                        <select v-model="create_dia_diem.id_tinh_thanh" @change="locQuanHuyen()"
                                            class="form-control">
                                            <template v-for="(v, k) in list_tinh_thanh" :key="k">
                                                <option v-bind:value="v.id">{{ v.ten_tinh_thanh }}</option>
                                            </template>
                                        </select>
                                    </div>
                                    <div class="mb-2">
                                        <label>Quận huyện</label>
                                        <select v-model="create_dia_diem.id_quan_huyen" class="form-control">
                                            <template v-for="(v, k) in loc_tinh" :key="k">
                                                <option v-bind:value="v.id">{{ v.ten_quan_huyen }}</option>
                                            </template>
                                        </select>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-2">
                                                <label>Tọa độ x</label>
                                                <input v-model="create_dia_diem.toa_do_x" type="text"
                                                    class="form-control mt-2">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-2">
                                                <label>Tọa độ y</label>
                                                <input v-model="create_dia_diem.toa_do_y" type="text"
                                                    class="form-control mt-2">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="mb-2">
                                                <label>Hình Ảnh</label>
                                                <input v-model="create_dia_diem.link_anh" type="text"
                                                    class="form-control mt-2">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button v-on:click="themMoiDiaDiem()" type="button" class="btn btn-primary"
                                        data-bs-dismiss="modal">Thêm
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
                    <h5 class="text-center text-dark">Danh Sách Địa Điểm</h5>
                    <div class="input-group mb-3 ">
                        <input v-on:keyup.enter="searchDiaDiem()" v-model="key_search.abc" type="text"
                            class="form-control search-control" placeholder="Nhập thông tin cần tìm">
                        <button v-on:click="searchDiaDiem()" class="btn btn-primary">
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
                                    <th class="align-middle text-center">Tên địa điểm</th>
                                    <th class="align-middle text-center">Hình ảnh</th>
                                    <th class="align-middle text-center">Slug</th>
                                    <th class="align-middle text-center">Loại địa điểm</th>
                                    <th class="align-middle text-center">Giá tiền</th>
                                    <th class="align-middle text-center">Tình trạng</th>
                                    <th class="align-middle text-center">Tên tỉnh</th>
                                    <th class="align-middle text-center">Tên quận/huyện</th>
                                    <th class="align-middle text-center">Tọa độ x</th>
                                    <th class="align-middle text-center">Tọa độ y</th>
                                    <th class="align-middle text-center">ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(v, k) in list_dia_diem" :key="k">
                                    <th class="align-middle text-center">{{ k + 1 }}</th>
                                    <td class="align-middle">{{ v.ten_dia_diem }}</td>
                                    <td class="align-middle text-center">
                                        <img style="width: 90px;height: 60px;" v-bind:src="v.link_anh"
                                            class="img-fluid ">
                                    </td>
                                    <td class="align-middle">{{ v.slug }}</td>
                                    <td class="align-middle text-center">
                                        <button v-if="v.loai_dia_diem == 1" class="btn btn-info">Khách sạn</button>
                                        <button v-else-if="v.loai_dia_diem == 2" class="btn btn-primary">Nhà
                                            hàng</button>
                                        <button v-else-if="v.loai_dia_diem == 3" class="btn btn-warning">Tham
                                            quan</button>
                                    </td>
                                    <td class="align-middle">{{ v.gia_tien }}</td>
                                    <td class="align-middle text-center">
                                        <button v-on:click="doiTinhTrang(v)" v-if="v.is_open == 1"
                                            class="btn btn-success">Hoạt
                                            động</button>
                                        <button v-on:click="doiTinhTrang(v)" v-else class="btn btn-danger">Tạm dừng
                                        </button>
                                    </td>
                                    <td class="align-middle">{{ v.ten_tinh_thanh }}</td>
                                    <td class="align-middle">{{ v.ten_quan_huyen }}</td>
                                    <td class="align-middle">{{ v.toa_do_x }}</td>
                                    <td class="align-middle">{{ v.toa_do_y }}</td>

                                    <td class="align-middle text-center">
                                        <button v-on:click="Object.assign(update_dia_diem, v), locQuanHuyen_update()"
                                            class="btn btn-info me-2" data-bs-toggle="modal"
                                            data-bs-target="#capNhatModal">Cập
                                            Nhật</button>
                                        <button v-on:click="id_can_xoa = v.id" class="btn btn-danger"
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
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Xoá địa điểm</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="alert alert-danger" role="alert">
                                        Bạn thật sự có muốn xoá địa điểm này không?
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button v-on:click="deleteDiaDiem()" type="button" class="btn btn-danger"
                                        data-bs-dismiss="modal">Xác Nhận Xoá</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade modal-lg" id="capNhatModal" tabindex="-1" aria-labelledby="exampleModalLabel"
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
                                        <label>Tên địa điểm</label>
                                        <input v-model="update_dia_diem.ten_dia_diem" v-on:keyup="addSlugUpdate()"
                                            type="text" disabled class="form-control mt-2">
                                    </div>
                                    <div class="mb-2">
                                        <label>Slug</label>
                                        <input v-model="update_dia_diem.slug" type="text" class="form-control mt-2">
                                    </div>
                                    <div class="mb-2">
                                        <label>Loại địa điểm</label>
                                        <select v-model="update_dia_diem.loai_dia_diem" class="form-control">
                                            <option value="1">Khách sạn</option>
                                            <option value="2">Nhà hàng</option>
                                            <option value="3">Địa điểm tham quan</option>
                                        </select>
                                    </div>
                                    <div class="mb-2">
                                        <label>Giá Tiền</label>
                                        <input v-model="update_dia_diem.gia_tien" type="number"
                                            class="form-control mt-2">
                                    </div>
                                    <div class="mb-2">
                                        <label>Tỉnh thành</label>
                                        <select v-model="update_dia_diem.id_tinh_thanh" @change="locQuanHuyen_update()"
                                            class="form-control">
                                            <template v-for="(v, k) in list_tinh_thanh" :key="k">
                                                <option v-bind:value="v.id">{{ v.ten_tinh_thanh }}</option>
                                            </template>
                                        </select>
                                    </div>
                                    <div class="mb-2">
                                        <label>Quận huyện</label>
                                        <select v-model="update_dia_diem.id_quan_huyen" class="form-control">
                                            <template v-for="(v, k) in loc_tinh_update" :key="k">
                                                <option v-bind:value="v.id">{{ v.ten_quan_huyen }}</option>
                                            </template>
                                        </select>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-2">
                                                <label>Tọa độ x</label>
                                                <input v-model="update_dia_diem.toa_do_x" type="text"
                                                    class="form-control mt-2">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-2">
                                                <label>Tọa độ y</label>
                                                <input v-model="update_dia_diem.toa_do_y" type="text"
                                                    class="form-control mt-2">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="mb-2">
                                                <label>Hình Ảnh</label>
                                                <input v-model="update_dia_diem.link_anh" type="text"
                                                    class="form-control mt-2">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button v-on:click="updateDiaDiem()" type="button" class="btn btn-info"
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
            list_quan_huyen: [],
            list_tinh_thanh: [],
            list_dia_diem: [],
            key_search: {},
            create_dia_diem: {},
            id_can_xoa: '',
            update_dia_diem: {},
            tinh_dang_chon: {},
            tinh_dang_chon_update: {},
            loc_tinh: [],
            loc_tinh_update: [],
        }
    },
    mounted() {
        this.loadDataDiaDiem();
        this.loadDataQuanHuyen();
        this.loadDataTinhThanh();
    },
    methods: {
        locQuanHuyen() {
            if (this.tinh_dang_chon) {
                this.loc_tinh = this.list_quan_huyen.filter(v => v.id_tinh_thanh === this.create_dia_diem.id_tinh_thanh);
            } else {
                this.loc_tinh = [];
            }
        },
        locQuanHuyen_update() {
            if (this.tinh_dang_chon_update) {
                this.loc_tinh_update = this.list_quan_huyen.filter(v => v.id_tinh_thanh === this.update_dia_diem.id_tinh_thanh);
            } else {
                this.loc_tinh_update = [];
            }
        },
        loadDataDiaDiem() {
            baseRequest
                .get('admin/dia-diem/lay-du-lieu')
                .then((res) => {
                    if (res.data.status) {
                        this.list_dia_diem = res.data.dia_diem;
                    } else {
                        toaster.error('Thông báo<br>' + res.data.message);
                    }
                });
        },
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
        searchDiaDiem() {
            baseRequest
                .post('admin/dia-diem/tim-dia-diem', this.key_search)
                .then((res) => {
                    if (res.data.status) {
                        this.list_dia_diem = res.data.dia_diem;
                    } else {
                        toaster.error('Thông báo<br>' + res.data.message);
                    }
                });
        },
        themMoiDiaDiem() {
            baseRequest
                .post('admin/dia-diem/them-moi-dia-diem', this.create_dia_diem)
                .then((res) => {
                    if (res.data.status == true) {
                        toaster.success('Thông báo<br>' + res.data.message);
                        this.loadDataDiaDiem();
                    }
                    else {
                        toaster.error(); ('Thông báo<br>' + res.data.message);
                    }
                });
        },
        deleteDiaDiem() {
            baseRequest
                .delete('admin/dia-diem/xoa-dia-diem/' + this.id_can_xoa)
                .then((res) => {
                    if (res.data.status == true) {
                        toaster.success('Thông báo<br>' + res.data.message);
                        this.loadDataDiaDiem();
                    }
                    else {
                        toaster.error('Thông báo<br>' + res.data.message);
                    }
                });
        },

        updateDiaDiem() {
            baseRequest
                .post('admin/dia-diem/cap-nhat-dia-diem', this.update_dia_diem)
                .then((res) => {
                    if (res.data.status == true) {
                        toaster.success('Thông báo<br>' + res.data.message);
                        this.loadDataDiaDiem();
                    }
                    else {
                        toaster.error('Thông báo<br>' + res.data.message);
                    }
                });
        },

        doiTinhTrang(v) {
            baseRequest
                .post('admin/dia-diem/doi-tinh-trang-dia-diem', v)
                .then((res) => {
                    if (res.data.status == true) {
                        toaster.success('Thông báo<br>' + res.data.message);
                        this.loadDataDiaDiem();
                    }
                    else {
                        toaster.error('Thông báo<br>' + res.data.message);
                    }
                });
        },

        convertToSlug(str) {
            str = str.toLowerCase();
            str = str
                .normalize('NFD')
                .replace(/[\u0300-\u036f]/g, '');
            str = str.replace(/[đĐ]/g, 'd');
            str = str.replace(/([^0-9a-z-\s])/g, '');
            str = str.replace(/(\s+)/g, '-');
            str = str.replace(/-+/g, '-');
            str = str.replace(/^-+|-+$/g, '');
            return str;
        },

        addSlug() {
            this.create_dia_diem.slug = this.convertToSlug(this.create_dia_diem.ten_dia_diem);
        },

        addSlugUpdate() {
            this.update_dia_diem.slug = this.convertToSlug(this.update_dia_diem.ten_dia_diem);
        },
    },
}
</script>
<style></style>