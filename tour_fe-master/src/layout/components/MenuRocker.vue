<template>
    <div class="nav-container primary-menu shadow-sm">
        <div class="mobile-topbar-header">
            <div>
                <router-link to="/">
                    <img src="../../assets/images/logo-icon.png" class="logo-icon" alt="logo icon">
                </router-link>
            </div>
            <div>
                <h4 class="logo-text">VietTour Admin</h4>
            </div>
            <div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i></div>
        </div>
        
        <nav class="navbar navbar-expand-xl w-100 p-0">
            <ul class="navbar-nav justify-content-start flex-grow-1 menu-list">
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
                
                <li class="nav-item">
                    <router-link to="/admin/khuyenmai" class="nav-link">
                        <div class="parent-icon"><i class="fa-solid fa-calendar-xmark"></i></div>
                        <div class="menu-title">Khuyến Mãi</div>
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
@import url('https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@400;500;600;700&display=swap');

/* ── CONTAINER ── */
.primary-menu {
    font-family: 'Be Vietnam Pro', sans-serif;
    background-color: #ffffff;
    border-bottom: 1px solid #f0ede8;
    padding: 0 10px;
}

/* Scroll ngang cho màn hình nhỏ */
.menu-list {
    display: flex;
    flex-wrap: nowrap;
    overflow-x: auto;
    gap: 4px;
    padding: 8px 0;
    scrollbar-width: none;
}
.menu-list::-webkit-scrollbar {
    display: none; 
}

/* ── NAV ITEMS ── */
.primary-menu .navbar-nav .nav-item {
    display: flex;
    align-items: center;
}

.primary-menu .navbar-nav .nav-link {
    color: #4b5563; 
    padding: 8px 14px !important; 
    display: flex;
    align-items: center;
    border-radius: 8px;
    transition: all 0.2s ease-in-out;
    font-weight: 500;
}

.primary-menu .navbar-nav .nav-link:hover {
    color: #0d7a5f; 
    background-color: #f8f9fa;
}

.primary-menu .navbar-nav .nav-link.router-link-active {
    color: #0d7a5f;
    background-color: #e6f5f0; 
    font-weight: 600;
}

.primary-menu .navbar-nav .nav-link.router-link-active .parent-icon i {
    color: #0d7a5f; /* Icon xanh lá */
}

/* ── ICONS & TEXT ── */
.primary-menu .navbar-nav .parent-icon {
    font-size: 1.1rem;
    display: flex;
    align-items: center;
    justify-content: center;
}

.primary-menu .navbar-nav .parent-icon i {
    margin-right: 6px; 
    transition: color 0.2s ease;
}

.primary-menu .navbar-nav .menu-title {
    font-size: 13px; 
    white-space: nowrap; 
    letter-spacing: 0.2px;
}

.logo-text {
    font-weight: 800;
    color: #1a1f2e;
    margin: 0;
}
</style>