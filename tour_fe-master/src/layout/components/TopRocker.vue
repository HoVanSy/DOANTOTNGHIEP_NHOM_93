<template>
	<header>
		<div class="topbar d-flex align-items-center">
			<nav class="navbar navbar-expand">
				<div class="topbar-logo-header">
					<div class="">
						<img style="height: 55px; width: 135px;" src="../../layout/imgaes/logo.png">
					</div>
				</div>
				<div class="mobile-toggle-menu"><i class='bx bx-menu'></i></div>
				<div class="top-menu ms-auto">
					<ul class="navbar-nav align-items-center">
						<li class="nav-item mobile-search-icon">
							<a class="nav-link" href="#"> <i class='bx bx-search'></i>
							</a>
						</li>
						<li class="nav-item dropdown dropdown-large">
							<a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" role="button"
								data-bs-toggle="dropdown" aria-expanded="false"> <i class='bx bx-category'></i>
							</a>
							<div class="dropdown-menu dropdown-menu-end">
								<div class="row row-cols-3 g-3 p-3">
									<div class="col text-center">
										<div class="app-box mx-auto bg-gradient-cosmic text-white"><i
												class='bx bx-group'></i>
										</div>
										<div class="app-title">Teams</div>
									</div>
									<div class="col text-center">
										<div class="app-box mx-auto bg-gradient-burning text-white"><i
												class='bx bx-atom'></i>
										</div>
										<div class="app-title">Projects</div>
									</div>
									<div class="col text-center">
										<div class="app-box mx-auto bg-gradient-lush text-white"><i
												class='bx bx-shield'></i>
										</div>
										<div class="app-title">Tasks</div>
									</div>
									<div class="col text-center">
										<div class="app-box mx-auto bg-gradient-kyoto text-dark"><i
												class='bx bx-notification'></i>
										</div>
										<div class="app-title">Feeds</div>
									</div>
									<div class="col text-center">
										<div class="app-box mx-auto bg-gradient-blues text-dark"><i
												class='bx bx-file'></i>
										</div>
										<div class="app-title">Files</div>
									</div>
									<div class="col text-center">
										<div class="app-box mx-auto bg-gradient-moonlit text-white"><i
												class='bx bx-filter-alt'></i>
										</div>
										<div class="app-title">Alerts</div>
									</div>
								</div>
							</div>
						</li>
						<li class="nav-item dropdown dropdown-large">
							<a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative" href="#"
								role="button" data-bs-toggle="dropdown" aria-expanded="false"> <span
									class="alert-count">7</span>
								<i class='bx bx-bell'></i>
							</a>
						</li>
						<li class="nav-item dropdown dropdown-large">
							<a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative" href="#"
								role="button" data-bs-toggle="dropdown" aria-expanded="false"> <span
									class="alert-count">8</span>
								<i class='bx bx-comment'></i>
							</a>
						</li>
					</ul>
				</div>
				<div class="row">
					<div class="col">
						<template v-if="is_check == false">
							<form class="d-flex">
								<router-link to="/admin/dang-nhap">
									<button class="btn btn-dark me-3 radius-30 px-4" type="button"><i
											class="bx bx-lock"></i> Login</button>
								</router-link>
							</form>
						</template>
						<template v-else>
							<div class="user-box dropdown">
								<a class="d-flex align-items-center nav-link dropdown-toggle dropdown-toggle-nocaret"
									href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
									<div class="user-info ps-3">
										<p class="user-name mb-0"><b>{{ ten_hien_thi }}</b></p>
										<p class="designattion mb-0 text-dark">Nhân Viên</p>
									</div>
								</a>
								<ul class="dropdown-menu dropdown-menu-end">
									<li><a v-on:click="dangXuat()" class="dropdown-item"><i
												class='bx bx-log-out-circle'></i><span>Đăng Xuất</span></a>
									</li>
									<li><a v-on:click="dangXuatAll()" class="dropdown-item"><i
												class='bx bx-log-out-circle'></i><span>Đăng Xuất Tất Cả</span></a>
									</li>
								</ul>
							</div>
						</template>
					</div>
				</div>
			</nav>
		</div>
	</header>
</template>
<script>
import axios from "axios";
import baseRequest from '../../core/baseRequest';
import { createToaster } from "@meforma/vue-toaster";
const toaster = createToaster({ position: "top-right" });
export default {
	data() {
		return {
			ten_hien_thi: 'Chưa đăng nhập',
			is_check: false,
		}
	},
	mounted() {
		this.checkLogin();
	},
	methods: {
		dangXuat() {
			baseRequest
				.get('account-admin/dang-xuat')
				.then((res) => {
					if (res.data.status) {
						toaster.success('Thông báo<br>' + res.data.message);
						this.$router.push('/admin/dang-nhap');
					} else {
						toaster.error('Thông báo<br>' + res.data.message);
					}
				});
		},
		dangXuatAll() {
			baseRequest
				.get('account-admin/dang-xuat-tat-ca')
				.then((res) => {
					if (res.data.status) {
						toaster.success('Thông báo<br>' + res.data.message);
						this.$router.push('/admin/dang-nhap');
					} else {
						toaster.error('Thông báo<br>' + res.data.message);
					}
				});
		},
		checkLogin() {
			axios
				.get('http://127.0.0.1:8000/api/account-admin/kiem-tra-token-client', {
					headers: {
						Authorization: 'Bearer ' + localStorage.getItem("token")
					}
				})
				.then((res) => {
					if (res.data.status) {
						this.is_check = true;
						this.ten_hien_thi = localStorage.getItem('ho_ten');
					}
				});
		},
	},
}
</script>
<style></style>