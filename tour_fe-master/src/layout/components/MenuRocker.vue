<template>
	<div class="nav-container primary-menu">
		<div class="mobile-topbar-header">
			<div>
				<router-link to="/client/trang-chu">
					<img src="../../assets/images/logo-icon.png" class="logo-icon" alt="logo icon">
				</router-link>
			</div>
			<div>
				<h4 class="logo-text">Rukada</h4>
			</div>
			<div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
			</div>
		</div>
		<nav class="navbar navbar-expand-xl w-100">
			<ul class="navbar-nav justify-content-start flex-grow-1 gap-1">
				<li class="nav-item dropdown">
					<a href="javascript:;" class="nav-link dropdown-toggle dropdown-toggle-nocaret"
						data-bs-toggle="dropdown">
						<div class="parent-icon"><i class='bx bx-home-circle'></i>
						</div>
						<div class="menu-title">Drop Down</div>
					</a>
					<ul class="dropdown-menu">
						<li> <a class="dropdown-item" href="index.html"><i class="bx bx-right-arrow-alt"></i>Default</a>
						</li>
						<li> <a class="dropdown-item" href="index2.html"><i
									class="bx bx-right-arrow-alt"></i>Alternate</a>
						</li>
						<li> <a class="dropdown-item" href="index3.html"><i
									class="bx bx-right-arrow-alt"></i>Graphical</a>
						</li>
					</ul>
				</li>

				<li class="nav-item">
					<router-link to="/admin/tinh-thanh">
						<a href="/admin/tinh-thanh" class="nav-link">
							<div class="parent-icon">
								<i class="fa-solid fa-map-location-dot"></i>
							</div>
							<div class="menu-title">Tỉnh Thành</div>
						</a>
					</router-link>
				</li>
				<li class="nav-item">
					<router-link to="/admin/quan-huyen">
						<a href="/admin/quan-huyen" class="nav-link">
							<div class="parent-icon">
								<i class="fa-solid fa-location-dot"></i>
							</div>
							<div class="menu-title">Quận/Huyện</div>
						</a>
					</router-link>
				</li>
				<li class="nav-item">
					<router-link to="/admin/dia-diem">
						<a href="/admin/dia-diem" class="nav-link">
							<div class="parent-icon">
								<i class="fa-solid fa-thumbtack"></i>
							</div>
							<div class="menu-title">QL Địa Điểm</div>
						</a>
					</router-link>
				</li>
				<li class="nav-item">
					<router-link to="/admin/nhan-vien">
						<a href="/admin/nhan-vien" class="nav-link">
							<div class="parent-icon">
								<i class="fa-solid fa-clipboard-user"></i>
							</div>
							<div class="menu-title">QL Nhân Viên</div>
						</a>
					</router-link>
				</li>
				<li class="nav-item">
					<router-link to="/admin/phan-quyen">
						<a href="/admin/phan-quyen" class="nav-link">
							<div class="parent-icon">
								<i class="fa-solid fa-list-check"></i>
							</div>
							<div class="menu-title">QL Phân Quyền</div>
						</a>
					</router-link>
				</li>
				<li class="nav-item">
					<router-link to="/admin/hoa-don">
						<a href="/admin/hoa-don" class="nav-link">
							<div class="parent-icon">
								<i class="fa-solid fa-list-check"></i>
							</div>
							<div class="menu-title">QL Hóa Đơn</div>
						</a>
					</router-link>
				</li>
				<li class="nav-item">
					<router-link to="/admin/khach-hang">
						<a href="/admin/khach-hang" class="nav-link">
							<div class="parent-icon">
								<i class="fa-solid fa-users"></i>
							</div>
							<div class="menu-title">QL Khách Hàng</div>
						</a>
					</router-link>
				</li>
				<li class="nav-item">
					<router-link to="/admin/tour">
						<a href="/admin/tour" class="nav-link">
							<div class="parent-icon">
								<i class="fa-solid fa-list-check"></i>
							</div>
							<div class="menu-title">QL Tour</div>
						</a>
					</router-link>
				</li>
				<li class="nav-item">
					<router-link to="/admin/blog">
						<a href="/admin/blog" class="nav-link">
							<div class="parent-icon">
								<i class="fa-solid fa-list-check"></i>
							</div>
							<div class="menu-title">QL Blog</div>
						</a>
					</router-link>
				</li>
			</ul>
		</nav>
	</div>
</template>
<script>
export default {

}
</script>
<style></style>