<template>
	<div class="card border-dark border-bottom border-5 border-0">
		<div class="card-body bg-white ">
			<nav style="height:35px" class="navbar navbar-expand-lg navbar-dark bg-primary rounded">
				<div class="container-fluid bg-white">
					<a class="navbar-brand" href="/">
						<img style="height: 60px; width: 140px;" src="../imgaes/logo.png" alt="">
					</a>
					<button class="navbar-toggler" type="button" data-bs-toggle="collapse"
						data-bs-target="#navbarSupportedContent2" aria-controls="navbarSupportedContent2"
						aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span>
					</button>
					<div class="collapse navbar-collapse" id="navbarSupportedContent2">
						<ul class="navbar-nav me-auto mb-2 mb-lg-0">
							<li class="nav-item">
								<router-link to="/">
									<a style="color: darkblue;" class="nav-link active" aria-current="page" href="/"><i
											class="bx bx-home-alt me-1"></i>Home</a>
								</router-link>
							</li>
							<li class="nav-item">
								<router-link to="/client/danh-sach-hoa-don">
								<a style="color: darkblue;" class="nav-link"
									href=""><i
										class="fa-solid fa-bag-shopping"></i> Hoá Đơn</a> 
								</router-link>
							</li>
							<li class="nav-item">
								<router-link to="/blog">
									<a style="color: darkblue;" class="nav-link" href=""><i class="fa-solid fa-newspaper"></i> Blog tin tức</a>
								</router-link>
							</li>
							<li class="nav-item">
								<router-link to="/yeu-cau">
									<a style="color: darkblue;" class="nav-link" href=""><i class="fa-solid fa-rotate"></i> Hủy / Đổi lịch</a>
								</router-link>
							</li>
							<!-- <li class="nav-item dropdown"><a style="color: darkblue;" class="nav-link dropdown-toggle" href="#" role="button"
									data-bs-toggle="dropdown" aria-expanded="false"> Dropdown </a>
								<ul class="dropdown-menu">
									<li><a class="dropdown-item" href="#">Action</a></li>
									<li><a class="dropdown-item" href="#">Another action</a></li>
									<li>
										<hr class="dropdown-divider">
									</li>
									<li><a class="dropdown-item" href="#">Something else here</a></li>
								</ul>
							</li> -->
						</ul>
						<template v-if="is_check == false">
							<form class="d-flex">
								<router-link to="/client/dang-nhap">
									<button class="btn btn-dark me-3 radius-30 px-4" type="button"><i
											class="bx bx-lock"></i> Login</button>
								</router-link>
								<router-link to="/client/dang-ky">
									<button class="btn btn-light radius-30 px-4" type="button"><i
											class="bx bx-user"></i>
										Register</button>
								</router-link>
							</form>
						</template>
						<template v-else>
							<div class="user-box dropdown">
								<a class="d-flex align-items-center nav-link dropdown-toggle dropdown-toggle-nocaret"
									href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
									<div class="user-info ps-3">
										<p class="user-name mb-0"><b>{{ ten_hien_thi }}</b></p>
										<p class="designattion mb-0 text-dark">Khách Hàng</p>
									</div>
								</a>
								<ul class="dropdown-menu dropdown-menu-end">
									<li><a v-on:click="dangXuat()" class="dropdown-item"><i
												class='bx bx-log-out-circle'></i><span>Đăng Xuất</span></a>
									</li>
									<li><a v-on:click="trangCaNhan()" class="dropdown-item"><i
												class='bx bx-log-out-circle'></i><span>Trang Cá Nhân</span></a>
									</li>
								
								</ul>
							</div>
						</template>
					</div>
				</div>
			</nav>
		</div>
	</div>
</template>
<script>
import baseRequestClient from '../../core/baseRequestClient';
import { createToaster } from "@meforma/vue-toaster";
import axios from "axios";
const toaster = createToaster({ position: "top-right" });
export default {
	data() {
		return {
			ten_hien_thi: 'Chưa đăng nhập',
			is_check: false,
			id: ' '
		}
	},
	mounted() {
		this.checkLogin();
	},
	methods: {
		dangXuat() {
			baseRequestClient
				.get('account-client/logout')
				.then((res) => {
					if (res.data.status) {
						toaster.success('Thông báo<br>' + res.data.message);
						this.$router.push('/client/dang-nhap');
					} else {
						toaster.error('Thông báo<br>' + res.data.message);
					}
				});
		},

		checkLogin() {
			axios
				.get('http://127.0.0.1:8000/api/account-client/kiem-tra-token-client', {
					headers: {
						Authorization: 'Bearer ' + localStorage.getItem("token_client")
					}
				})
				.then((res) => {
					if (res.data.status) {
						this.is_check = true;
						this.ten_hien_thi = localStorage.getItem('ho_ten_client');
						// this.id = localStorage.getItem('id');
					}
				});
		},
	},
}
</script>
<style></style>