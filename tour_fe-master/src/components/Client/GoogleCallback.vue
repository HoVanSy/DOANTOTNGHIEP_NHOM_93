<template>
    <div class="min-vh-100 d-flex flex-column align-items-center justify-content-center bg-light">
        <div class="spinner-border text-success mb-3" role="status" style="width: 3rem; height: 3rem;"></div>
        <h4 class="fw-bold text-dark">Đang xác thực tài khoản Google...</h4>
        <p class="text-muted">Vui lòng chờ trong giây lát.</p>
    </div>
</template>

<script>
import { createToaster } from "@meforma/vue-toaster";
const toaster = createToaster({ position: "top-right" });

export default {
    mounted() {
        // Lấy token và tên từ URL
        const urlParams = new URLSearchParams(window.location.search);
        const token = urlParams.get('token');
        const name = urlParams.get('name');
        const error = urlParams.get('error');

        if (error) {
            toaster.error("Đăng nhập Google thất bại!");
            this.$router.push('/client/dang-nhap');
            return;
        }

        if (token) {
            // Lưu vào localStorage giống y hệt lúc đăng nhập thường
            localStorage.setItem('token_client', token);
            if (name) localStorage.setItem('ho_ten_client', name);
            
            toaster.success(`Xin chào, ${name}!`);
            
            // Chuyển về trang chủ
            setTimeout(() => {
                this.$router.push('/');
            }, 1000);
        } else {
            this.$router.push('/client/dang-nhap');
        }
    }
}
</script>