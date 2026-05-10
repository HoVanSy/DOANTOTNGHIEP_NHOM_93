<template>
    <div class="nav-container primary-menu">
        <div class="mobile-topbar-header">
            <div>
                <router-link to="/">
                    <img src="../../assets/images/logo-icon.png" class="logo-icon" alt="logo icon">
                </router-link>
            </div>
            <div>
                <h4 class="logo-text">Rukada</h4>
            </div>
            <div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i></div>
        </div>
        
        <nav class="navbar navbar-expand-xl w-100">
            <ul class="navbar-nav justify-content-start flex-grow-1 gap-1">
                
                <li class="nav-item">
                    <router-link to="/admin/thongkebaocao" class="nav-link">
                        <div class="parent-icon"><i class="fa-solid fa-chart-line"></i></div>
                        <div class="menu-title">Thống Kê/Báo Cáo</div>
                    </router-link>
                </li>

                <li class="nav-item">
                    <router-link to="/admin/tinh-thanh" class="nav-link">
                        <div class="parent-icon"><i class="fa-solid fa-map-location-dot"></i></div>
                        <div class="menu-title">Tỉnh Thành</div>
                    </router-link>
                </li>

                <li class="nav-item">
                    <router-link to="/admin/quan-huyen" class="nav-link">
                        <div class="parent-icon"><i class="fa-solid fa-location-dot"></i></div>
                        <div class="menu-title">Quận/Huyện</div>
                    </router-link>
                </li>

                <li class="nav-item">
                    <router-link to="/admin/dia-diem" class="nav-link">
                        <div class="parent-icon"><i class="fa-solid fa-thumbtack"></i></div>
                        <div class="menu-title">Địa Điểm</div>
                    </router-link>
                </li>

                <li class="nav-item">
                    <router-link to="/admin/nhan-vien" class="nav-link">
                        <div class="parent-icon"><i class="fa-solid fa-user-tie"></i></div>
                        <div class="menu-title">Nhân Viên</div>
                    </router-link>
                </li>

                <li class="nav-item">
                    <router-link to="/admin/phan-quyen" class="nav-link">
                        <div class="parent-icon"><i class="fa-solid fa-user-shield"></i></div>
                        <div class="menu-title">Phân Quyền</div>
                    </router-link>
                </li>

                <li class="nav-item">
                    <router-link to="/admin/hoa-don" class="nav-link">
                        <div class="parent-icon"><i class="fa-solid fa-file-invoice-dollar"></i></div>
                        <div class="menu-title">Hóa Đơn</div>
                    </router-link>
                </li>

                <li class="nav-item">
                    <router-link to="/admin/khach-hang" class="nav-link">
                        <div class="parent-icon"><i class="fa-solid fa-users"></i></div>
                        <div class="menu-title">Khách Hàng</div>
                    </router-link>
                </li>

                <li class="nav-item">
                    <router-link to="/admin/tour" class="nav-link">
                        <div class="parent-icon"><i class="fa-solid fa-route"></i></div>
                        <div class="menu-title">Tour</div>
                    </router-link>
                </li>

                <li class="nav-item">
                    <router-link to="/admin/blog" class="nav-link">
                        <div class="parent-icon"><i class="fa-solid fa-newspaper"></i></div>
                        <div class="menu-title">Blog</div>
                    </router-link>
                </li>

                <li class="nav-item">
                    <router-link to="/admin/yeucauhuy" class="nav-link">
                        <div class="parent-icon"><i class="fa-solid fa-calendar-xmark"></i></div>
                        <div class="menu-title">Yêu Cầu Hủy</div>
                    </router-link>
                </li>
                
            </ul>
        </nav>
    </div>
</template>

<script>
export default {
    name: 'AdminHorizontalMenu'
}
</script>

<style scoped>
.primary-menu .navbar-nav .nav-link:hover,
.primary-menu .navbar-nav .nav-link.router-link-active {
    color: #0d6efd;
}
.primary-menu .navbar-nav .nav-link.router-link-active .parent-icon i {
    color: #0d6efd;
}

.primary-menu .navbar-nav .nav-link {
    padding: 0.4rem 0.6rem !important; 
    display: flex;
    align-items: center;
}

/* Thu nhỏ icon */
.primary-menu .navbar-nav .parent-icon {
    font-size: 1.1rem;
    line-height: 1;
}

.primary-menu .navbar-nav .parent-icon i {
    margin-right: 0.3rem; 
}

.primary-menu .navbar-nav .menu-title {
    font-size: 0.85rem; 
    white-space: nowrap; 
}

.primary-menu .navbar-nav {
    gap: 0.15rem !important; 
}
</style>