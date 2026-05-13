<template>
    <div class="container mt-5">
        <div class="card radius-10 text-center p-4">
            <div v-if="loading">
                <i class="bx bx-loader-alt bx-spin font-35"></i>
                <p>Đang xử lý...</p>
            </div>

            <div v-else-if="thanhCong">
                <i class="bx bxs-check-circle text-success" style="font-size:60px"></i>
                <h4 class="mt-3 text-success">Thanh Toán Thành Công!</h4>
                <p class="text-muted">Đơn hàng của bạn đã được xác nhận.</p>
                <a href="/client/danh-sach-hoa-don" class="btn btn-primary mt-2">Xem Danh Sách Hóa Đơn</a>
            </div>

            <div v-else>
                <i class="bx bxs-x-circle text-danger" style="font-size:60px"></i>
                <h4 class="mt-3 text-danger">Thanh Toán Thất Bại</h4>
                <p class="text-muted">{{ errorMessage }}</p>
                <a href="/client/danh-sach-hoa-don" class="btn btn-secondary mt-2">Quay Lại</a>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";

export default {
    data() {
        return {
            loading: true,
            thanhCong: false,
            errorMessage: 'Đã có lỗi xảy ra.'
        }
    },
    mounted() {
        // Lấy params MoMo trả về trên URL
        const params = new URLSearchParams(window.location.search);
        const resultCode = params.get('resultCode');

        if (resultCode === '0') {
            this.thanhCong = true;
        } else {
            this.thanhCong = false;
            this.errorMessage = 'Mã lỗi: ' + resultCode;
        }
        this.loading = false;
    }
}
</script>