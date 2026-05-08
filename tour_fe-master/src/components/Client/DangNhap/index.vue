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
            <div class="section-authentication-signin d-flex align-items-center justify-content-center my-5 my-lg-0">
                <div class="container-fluid">
                    <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
                        <div class="col mx-auto">
                            <div class="mb-4 text-center">
                                <img src="../../../layout/imgaes/logo.png" width="180" alt="">
                            </div>
                            <div class="card border">
                                <div class="card-body">
                                    <div class="border p-4 rounded">
                                        <div class="text-center">
                                            <h3 class="">Đăng Nhập</h3>
                                            <p>Bạn chưa có tài khoản? <a href="/client/dang-ky">Đăng ký ngay</a></p>
                                        </div>
                                        <div class="login-separater text-center mb-4"> <span>ĐĂNG NHẬP BẰNG EMAIL</span>
                                            <hr />
                                        </div>
                                        <div class="form-body">
                                            <form class="row g-3">
                                                <div class="col-12">
                                                    <label for="inputEmailAddress" class="form-label">Email</label>
                                                    <input v-model="dang_nhap.email" type="email" class="form-control"
                                                        id="inputEmailAddress" placeholder="Email Address">
                                                </div>
                                                <div class="col-12">
                                                    <label for="inputChoosePassword" class="form-label">Mật Khẩu</label>
                                                    <input v-on:keyup.enter="dangNhap()" v-model="dang_nhap.password" type="password"
                                                        class="form-control" id="inputEmailAddress"
                                                        placeholder="Enter Password">
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox"
                                                            id="flexSwitchCheckChecked" checked>
                                                        <label class="form-check-label"
                                                            for="flexSwitchCheckChecked">Lưu Mật Khẩu</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 text-end">
                                                    <router-link to="/dang-ky">
                                                        <a href="authentication-forgot-password.html">Quên Mật Khẩu ?
                                                        </a>
                                                    </router-link>
                                                </div>
                                                <div class="col-12">
                                                    <div class="d-grid">
                                                        <button @:click="dangNhap()" type="button"
                                                            class="btn btn-primary"><i class="bx bxs-lock-open"></i>Đăng Nhập</button>
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
import axios from 'axios';
import { createToaster } from "@meforma/vue-toaster";
const toaster = createToaster({ position: "top-right" });
export default {
    data() {
        return {
            dang_nhap: {},
            id:' '
        }
    },
    mounted() {
        this.checkToken();
    },
    methods: {
        dangNhap() {
            axios
                .post('http://127.0.0.1:8000/api/account-client/login', this.dang_nhap)
                .then((res) => {
                    if (res.data.status) {
                        toaster.success('Thông báo<br>' + res.data.message);
                        var arr = res.data.token_client.split("|");
                        localStorage.setItem('token_client', arr[1]);
                        this.checkToken();
                        this.$router.push('/');
                        this.id = localStorage.getItem('id');
                    } else {
                        toaster.error('Thông báo<br>' + res.data.message);
                    }
                });
        },
        checkToken() {
            axios
                .post('http://127.0.0.1:8000/api/account-client/check', {}, {
                    headers: {
                        Authorization: 'Bearer ' + localStorage.getItem('token_client')
                    }
                })
                .then((res) => {
                    localStorage.setItem('ho_ten_client', res.data.ho_ten_client);
                    if (res.status === 200) {
                        this.list_token = res.data.list;
                        this.$router.push('/');
                    } if (res.status === 401) {
                        toaster.error('Thông báo<br>' + res.message);
                    }
                })
                .catch(() => {
                });
        },
    },
}
</script>
<style></style>