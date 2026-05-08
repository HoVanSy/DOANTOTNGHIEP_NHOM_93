<template>

    <body class="bg-login  pace-done">
        <div class="pace  pace-inactive">
            <div class="pace-progress" data-progress-text="100%" data-progress="99"
                style="transform: translate3d(100%, 0px, 0px);">
                <div class="pace-progress-inner"></div>
            </div>
            <div class="pace-activity"></div>
        </div>
        <div class="wrapper">
            <div class="d-flex align-items-center justify-content-center my-5 my-lg-0">
                <div class="container">
                    <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-2">
                        <div class="col mx-auto">
                            <div class="my-4 text-center">
                                <img src="../../../layout/imgaes/logo.png" width="180" alt="">
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <div class="border p-4 rounded">
                                        <div class="text-center">
                                            <h3 class="">Sign Up</h3>
                                            <p>Already have an account? <a href="/client/dang-nhap">Sign in
                                                    here</a>
                                            </p>
                                        </div>

                                        <div class="form-body">
                                            <form class="row g-3">
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label class="form-label">Họ và tên</label>
                                                        <input v-model="dang_ky.ho_ten" type="text" class="form-control"
                                                            placeholder="Nhập họ và tên" id="fname" name="fname">
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label class="form-label">Email</label>
                                                        <input v-model="dang_ky.email" type="email" class="form-control"
                                                            placeholder="Nhập email" id="name" name="name">
                                                    </div>
                                                </div>
                                                <div class="row mt-3">
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label class="form-label">số điện thoại</label>
                                                            <input v-model="dang_ky.so_dien_thoai" type="text"
                                                                class="form-control" placeholder="Nhập số điện thoại"
                                                                id="sdt" name="sdt">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label class="form-label">Giới Tính</label>
                                                            <select v-model="dang_ky.gioi_tinh" class="form-control">
                                                                <option value="0">Nam</option>
                                                                <option value="1">Nữ</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label class="form-label">Mật khẩu</label>
                                                        <input v-model="dang_ky.password" type="password"
                                                            class="form-control" placeholder="Nhập mật khẩu"
                                                            id="password" name="password">
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label class="form-label">ngày sinh</label>
                                                        <input v-model="dang_ky.ngay_sinh" type="date"
                                                            class="form-control" id="lname" name="lname">
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label class="form-label">Địa Chỉ</label>
                                                        <select v-model="dang_ky.dia_chi" class="form-select">
                                                            <template v-for="(v, k) in list_tinh_thanh">
                                                                <option v-bind:value="v.id">{{ v.ten_tinh_thanh }}
                                                                </option>
                                                            </template>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox"
                                                            id="flexSwitchCheckChecked">
                                                        <label class="form-check-label" for="flexSwitchCheckChecked">I
                                                            read and agree to Terms &amp; Conditions</label>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="d-grid">
                                                        <button v-on:click="dangKy()" type="button"
                                                            class="btn btn-primary"><i class="bx bx-user"></i>Sign
                                                            up</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</template>
<script>
import { createToaster } from "@meforma/vue-toaster";
const toaster = createToaster({ position: "top-right" });
import axios from 'axios';
import baseRequest from "../../../core/baseRequestClient";
export default {
    data() {
        return {
            dang_ky: {},
            list_tinh_thanh: [],
        };
    },
    mounted() {
        this.loadDataTinhThanh();
    },
    methods: {
        dangKy() {
            axios
                .post('http://127.0.0.1:8000/api/account-client/register', this.dang_ky)
                .then((res) => {
                    if (res.data.status) {
                        toaster.success('Thông báo<br>' + res.data.message);
                        this.$router.push('/client/dang-nhap');
                    } else {
                        toaster.error('Thông báo<br>' + res.data.message);
                    }
                })
                .catch((res) => {
                    var result = Object.entries(res.response.data.errors);
                    result.forEach((v, k) => {
                        toaster.error(v[1][0]);
                    });
                });
        },

        loadDataTinhThanh() {
            baseRequest
                .get('client/tinh-thanh/lay-du-lieu')
                .then((res) => {
                    this.list_tinh_thanh = res.data.tinh_thanh;
                });
        },
    }
}
</script>
<style></style>