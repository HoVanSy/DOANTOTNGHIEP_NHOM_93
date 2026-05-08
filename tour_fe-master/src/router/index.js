import { createRouter, createWebHistory } from "vue-router"; // cài vue-router: npm install vue-router@next --save
import checkLogin from "./checkLogin";

const routes = [
    {
        path : '/',
        component: ()=>import('../components/Client/TrangChu/index.vue'),  
        meta : {layout : 'client'}  
    },

    {
        path : '/client/danh-sach-tour',
        component: ()=>import('../components/Client/DanhSachTour/index.vue'),  
        meta : {layout : 'client'} ,
       
    },

    {
        path : '/client/chi-tiet-tour/:id',
        component: ()=>import('../components/Client/ChiTietTour/index.vue'),  
        meta : {layout : 'client'}  
    },

    {
        path : '/client/dang-ky',
        component: ()=>import('../components/Client/DangKy/index.vue'),  
        meta : {layout : 'account'}  
    },

    {
        path : '/client/dang-nhap',
        component: ()=>import('../components/Client/DangNhap/index.vue'),  
        meta : {layout : 'account'}  
    },

    {
        path : '/client/dat-tour',
        component: ()=>import('../components/Client/DatTour/index.vue'),  
        meta : {layout : 'client'}  
    },

    {
        path : '/client/hoa-don/:id',
        component: ()=>import('../components/Client/HoaDon/index.vue'),  
        meta : {layout : 'bill'}
    },

    {
        path : '/client/danh-sach-hoa-don',
        component: ()=>import('../components/Client/DanhSachHoaDon/index.vue'),  
        meta : {layout : 'client'}  
    },
    {
        path: '/blog',
        component: () => import('../components/Client/Blog/index.vue'),
        meta: { layout: 'client' }
    },
    {
        path: '/yeu-cau',
        component: () => import('../components/Client/YeuCau/index.vue'),
        meta: { layout: 'client' },
        beforeEnter: checkLogin
    },

    //admin
    {
        path : '/admin/tinh-thanh',
        component: ()=>import('../components/Admin/TinhThanh/index.vue'),
        beforeEnter: checkLogin
    },
    {
        path : '/admin/quan-huyen',
        component: ()=>import('../components/Admin/QuanHuyen/index.vue'),
        beforeEnter: checkLogin
    },
    {
        path : '/admin/nhan-vien',
        component: ()=>import('../components/Admin/NhanVien/index.vue'),
        beforeEnter: checkLogin
    },
    {
        path : '/admin/dia-diem',
        component: ()=>import('../components/Admin/DiaDiem/index.vue'),
        beforeEnter: checkLogin
    },
    {
        path : '/admin/phan-quyen',
        component: ()=>import('../components/Admin/PhanQuyen/index.vue'),
        beforeEnter: checkLogin
    },
    {
        path : '/admin/hoa-don',
        component: ()=>import('../components/Admin/HoaDon/index.vue'),
        beforeEnter: checkLogin
    },
    {
        path : '/admin/dang-nhap',
        component: ()=>import('../components/Admin/DangNhap/index.vue'),
        meta : {layout : 'account'}  
    },
    {
        path : '/admin/khach-hang',
        component: ()=>import('../components/Admin/KhachHang/index.vue'),
        beforeEnter: checkLogin
    },
    {
        path : '/admin/tour',
        component: ()=>import('../components/Admin/Tour/index.vue'),
        beforeEnter: checkLogin
    },
    {
        path : '/admin/blog',
        component: ()=>import('../components/Admin/Blog/index.vue'),
        beforeEnter: checkLogin
    },
]

const router = createRouter({
    history: createWebHistory(),
    routes: routes
})

export default router