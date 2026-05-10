<template>
    <div class="container-fluid mt-3">
        <div class="d-flex align-items-center mb-4">
            <h4 class="mb-0">Thống Kê & Báo Cáo</h4>
        </div>

        <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
            <div class="col">
                <div class="card radius-10 border-start border-0 border-3 border-success">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary">Tổng Doanh Thu</p>
                                <h4 class="my-1 text-success">{{ formatToVND(tong_quan.tong_doanh_thu) }}</h4>
                                <p class="mb-0 font-13 text-success"><i class="fa-solid fa-arrow-trend-up"></i> +5% so với tháng trước</p>
                            </div>
                            <div class="widgets-icons bg-light-success text-success ms-auto">
                                <i class="fa-solid fa-money-bill-trend-up"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col">
                <div class="card radius-10 border-start border-0 border-3 border-info">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary">Hóa Đơn Thành Công</p>
                                <h4 class="my-1 text-info">{{ tong_quan.hoa_don_thanh_cong }}</h4>
                                <p class="mb-0 font-13 text-secondary">Tổng số hóa đơn đã thanh toán</p>
                            </div>
                            <div class="widgets-icons bg-light-info text-info ms-auto">
                                <i class="fa-solid fa-file-invoice-dollar"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card radius-10 border-start border-0 border-3 border-primary">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary">Khách Hàng Mới</p>
                                <h4 class="my-1 text-primary">{{ tong_quan.khach_hang_moi }}</h4>
                                <p class="mb-0 font-13 text-primary"><i class="fa-solid fa-arrow-trend-up"></i> +12% so với tháng trước</p>
                            </div>
                            <div class="widgets-icons bg-light-primary text-primary ms-auto">
                                <i class="fa-solid fa-users"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card radius-10 border-start border-0 border-3 border-danger">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary">Hóa Đơn Hủy</p>
                                <h4 class="my-1 text-danger">{{ tong_quan.hoa_don_huy }}</h4>
                                <p class="mb-0 font-13 text-danger"><i class="fa-solid fa-arrow-trend-down"></i> Cần chú ý</p>
                            </div>
                            <div class="widgets-icons bg-light-danger text-danger ms-auto">
                                <i class="fa-solid fa-calendar-xmark"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-12 col-lg-8">
                <div class="card radius-10 w-100">
                    <div class="card-header bg-transparent border-bottom">
                        <div class="d-flex align-items-center">
                            <div>
                                <h6 class="mb-0">Biểu Đồ Doanh Thu (6 Tháng Gần Nhất)</h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div style="height: 300px;">
                            <canvas id="doanhThuChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-4">
                <div class="card radius-10 w-100">
                    <div class="card-header bg-transparent border-bottom">
                        <div class="d-flex align-items-center">
                            <div>
                                <h6 class="mb-0">Tỉ Lệ Trạng Thái Hóa Đơn</h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div style="height: 300px; display: flex; justify-content: center;">
                            <canvas id="trangThaiChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Chart from 'chart.js/auto';
import axios from 'axios';

export default {
    name: 'ThongKeBaoCao',
    data() {
        return {
            chartDoanhThu: null,
            chartTrangThai: null,
            
            thong_ke: {
                thang: [],
                doanh_thu: [],
                trang_thai: []
            },

            tong_quan: {
                tong_doanh_thu: 0,
                hoa_don_thanh_cong: 0,
                khach_hang_moi: 0,
                hoa_don_huy: 0
            }
        }
    },
    mounted() {
        this.loadThongKeTongQuan();
        this.loadThongKeDoanhThu();
    },
    beforeUnmount() {
        // Dọn dẹp RAM: Hủy biểu đồ khi người dùng chuyển sang trang khác
        if (this.chartDoanhThu) this.chartDoanhThu.destroy();
        if (this.chartTrangThai) this.chartTrangThai.destroy();
    },
    methods: {
        async loadThongKeTongQuan() {
            try {
                const token = localStorage.getItem('token_admin');
                const response = await axios.get('/api/admin/thong-ke/tong-quan', {
                    headers: {
                        'Authorization': `Bearer ${token}`
                    }
                });
                
                if (response.data.status) {
                    this.tong_quan = response.data.data;
                }
            } catch (error) {
                console.error('Lỗi khi tải thống kê tổng quan:', error);
            }
        },

        async loadThongKeDoanhThu() {
            try {
                const token = localStorage.getItem('token_admin');
                const response = await axios.get('/api/admin/thong-ke/doanh-thu', {
                    headers: {
                        'Authorization': `Bearer ${token}`
                    }
                });
                
                if (response.data.status) {
                    this.thong_ke = response.data.data;
                    // Vẽ biểu đồ sau khi có dữ liệu
                    this.renderBiểuĐồDoanhThu();
                    this.renderBiểuĐồTrangThai();
                }
            } catch (error) {
                console.error('Lỗi khi tải thống kê doanh thu:', error);
            }
        },

        formatToVND(number) {
            return (parseInt(number) || 0).toLocaleString('vi-VN', { style: 'currency', currency: 'VND' });
        },

        renderBiểuĐồDoanhThu() {
            const ctx = document.getElementById('doanhThuChart').getContext('2d');
            this.chartDoanhThu = new Chart(ctx, {
                type: 'bar', // Biểu đồ dạng cột
                data: {
                    labels: this.thong_ke.thang,
                    datasets: [{
                        label: 'Doanh thu (VNĐ)',
                        data: this.thong_ke.doanh_thu,
                        backgroundColor: '#198754', // Màu xanh lá success
                        borderRadius: 4, // Bo tròn góc của cột
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false } // Tắt cái hộp chú thích ở trên cùng cho gọn
                    },
                    scales: {
                        y: { 
                            beginAtZero: true,
                            ticks: {
                                callback: function(value) {
                                    // Rút gọn số tiền trên trục Y (ví dụ: 10,000,000 -> 10Tr)
                                    return value / 1000000 + 'Tr'; 
                                }
                            }
                        }
                    }
                }
            });
        },

        renderBiểuĐồTrangThai() {
            const ctx = document.getElementById('trangThaiChart').getContext('2d');
            this.chartTrangThai = new Chart(ctx, {
                type: 'doughnut', 
                data: {
                    labels: ['Đã Thanh Toán', 'Chưa Thanh Toán', 'Đã Hủy'],
                    datasets: [{
                        data: this.thong_ke.trang_thai,
                        backgroundColor: [
                            '#0dcaf0', // info
                            '#ffc107', // warning
                            '#dc3545'  // danger
                        ],
                        borderWidth: 0
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    cutout: '70%', 
                    plugins: {
                        legend: {
                            position: 'bottom'
                        }
                    }
                }
            });
        }
    }
}
</script>

<style scoped>
.widgets-icons {
    width: 50px;
    height: 50px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 10px;
    font-size: 24px;
}
</style>