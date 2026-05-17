<template>
    <div class="dashboard-wrapper container-fluid px-3 py-2">
        
        <div class="d-flex align-items-center mb-2">
        </div>

        <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4 g-2 mb-2">
    
            <router-link to="" class="col text-decoration-none">
                <div class="card summary-card radius-8 border-0 shadow-sm h-100 bg-white">
                    <div class="card-body p-2 px-3 d-flex align-items-center justify-content-between">
                        <div>
                            <p class="mb-0 text-muted font-11 fw-semibold text-uppercase">Doanh Thu</p>
                            <h6 class="my-1 text-dark fw-bold font-15">{{ formatToVND(tong_quan.tong_doanh_thu) }}</h6>
                            <p class="mb-0 font-10 text-success"><i class="fa-solid fa-arrow-trend-up"></i> +5% tháng này</p>
                        </div>
                        <div class="widgets-icons bg-light-success text-success">
                            <i class="fa-solid fa-money-bill-wave"></i>
                        </div>
                    </div>
                </div>
            </router-link>
            
            <router-link to="/admin/hoa-don" class="col text-decoration-none">
                <div class="card summary-card radius-8 border-0 shadow-sm h-100 bg-white">
                    <div class="card-body p-2 px-3 d-flex align-items-center justify-content-between">
                        <div>
                            <p class="mb-0 text-muted font-11 fw-semibold text-uppercase">HĐ Thành Công</p>
                            <h6 class="my-1 text-dark fw-bold font-15">{{ tong_quan.hoa_don_thanh_cong }}</h6>
                            <p class="mb-0 font-10 text-secondary">Đã thanh toán</p>
                        </div>
                        <div class="widgets-icons bg-light-info text-info">
                            <i class="fa-solid fa-file-circle-check"></i>
                        </div>
                    </div>
                </div>
            </router-link>

            <router-link to="/admin/khach-hang" class="col text-decoration-none">
                <div class="card summary-card radius-8 border-0 shadow-sm h-100 bg-white">
                    <div class="card-body p-2 px-3 d-flex align-items-center justify-content-between">
                        <div>
                            <p class="mb-0 text-muted font-11 fw-semibold text-uppercase">Khách Mới</p>
                            <h6 class="my-1 text-dark fw-bold font-15">{{ tong_quan.khach_hang_moi }}</h6>
                            <p class="mb-0 font-10 text-primary"><i class="fa-solid fa-arrow-trend-up"></i> +12% tháng này</p>
                        </div>
                        <div class="widgets-icons bg-light-primary text-primary">
                            <i class="fa-solid fa-user-plus"></i>
                        </div>
                    </div>
                </div>
            </router-link>

            <router-link to="/admin/yeucauhuy" class="col text-decoration-none">
                <div class="card summary-card radius-8 border-0 shadow-sm h-100 bg-white">
                    <div class="card-body p-2 px-3 d-flex align-items-center justify-content-between">
                        <div>
                            <p class="mb-0 text-muted font-11 fw-semibold text-uppercase">HĐ Đã Hủy</p>
                            <h6 class="my-1 text-dark fw-bold font-15">{{ tong_quan.hoa_don_huy }}</h6>
                            <p class="mb-0 font-10 text-danger"><i class="fa-solid fa-triangle-exclamation"></i> Cần chú ý</p>
                        </div>
                        <div class="widgets-icons bg-light-danger text-danger">
                            <i class="fa-solid fa-ban"></i>
                        </div>
                    </div>
                </div>
            </router-link>

        </div>

        <div class="row g-2 chart-row flex-grow-1">
            <div class="col-12 col-lg-8 d-flex flex-column">
                <div class="card radius-8 w-100 h-100 d-flex flex-column mb-0 shadow-sm border-0">
                    <div class="card-header bg-white border-bottom p-2 px-3">
                        <h6 class="mb-0 font-12 fw-bold text-dark text-uppercase">Doanh Thu 6 Tháng Gần Nhất</h6>
                    </div>
                    <div class="card-body p-2 position-relative flex-grow-1">
                        <div class="chart-container">
                            <canvas id="doanhThuChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-4 d-flex flex-column">
                <div class="card radius-8 w-100 h-100 d-flex flex-column mb-0 shadow-sm border-0">
                    <div class="card-header bg-white border-bottom p-2 px-3">
                        <h6 class="mb-0 font-12 fw-bold text-dark text-uppercase">Tỉ Lệ Trạng Thái</h6>
                    </div>
                    <div class="card-body p-2 position-relative flex-grow-1 d-flex align-items-center justify-content-center">
                        <div class="chart-container">
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
        window.addEventListener('resize', this.resizeCharts);
    },
    beforeUnmount() {
        if (this.chartDoanhThu) this.chartDoanhThu.destroy();
        if (this.chartTrangThai) this.chartTrangThai.destroy();
        window.removeEventListener('resize', this.resizeCharts);
    },
    methods: {
        resizeCharts() {
            if (this.chartDoanhThu) this.chartDoanhThu.resize();
            if (this.chartTrangThai) this.chartTrangThai.resize();
        },

        async loadThongKeTongQuan() {
            try {
                const token = localStorage.getItem('token');
                const response = await axios.get('/api/admin/thong-ke/tong-quan', {
                    headers: { 'Authorization': `Bearer ${token}` }
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
                const token = localStorage.getItem('token');
                const response = await axios.get('/api/admin/thong-ke/doanh-thu', {
                    headers: { 'Authorization': `Bearer ${token}` }
                });
                
                if (response.data.status) {
                    this.thong_ke = response.data.data;
                    this.renderBiểuĐồDoanhThu();
                    this.renderBiểuĐồTrangThai();
                }
            } catch (error) {
                console.error('Lỗi tải thống kê:', error);
            }
        },

        formatToVND(number) {
            return (parseInt(number) || 0).toLocaleString('vi-VN', { style: 'currency', currency: 'VND' });
        },

        renderBiểuĐồDoanhThu() {
            const ctx = document.getElementById('doanhThuChart').getContext('2d');
            this.chartDoanhThu = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: this.thong_ke.thang,
                    datasets: [{
                        label: 'Doanh thu (VNĐ)',
                        data: this.thong_ke.doanh_thu,
                        backgroundColor: '#0d7a5f', /* Xanh lá theme */
                        borderRadius: 6,
                        barPercentage: 0.6
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    responsive: true,
                    plugins: { legend: { display: false } },
                    scales: {
                        y: { 
                            beginAtZero: true,
                            grid: { color: '#f0f0f0', drawBorder: false },
                            ticks: {
                                font: { size: 10 },
                                callback: function(value) { return value / 1000000 + 'Tr'; }
                            }
                        },
                        x: {
                            grid: { display: false, drawBorder: false },
                            ticks: { font: { size: 10 } }
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
                        backgroundColor: ['#0d7a5f', '#e8a020', '#dc3545'],
                        borderWidth: 0,
                        hoverOffset: 4
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    responsive: true,
                    cutout: '70%', 
                    layout: { padding: 10 },
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: { usePointStyle: true, padding: 15, font: { size: 11 } }
                        }
                    }
                }
            });
        }
    }
}
</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@400;500;600;700&display=swap');

.dashboard-wrapper {
    font-family: 'Be Vietnam Pro', sans-serif;
    background-color: #f1f5f9;
    height: calc(100vh - 120px); 
    display: flex;
    flex-direction: column;
    overflow: hidden; 
}

.chart-row {
    min-height: 0; 
}
.chart-container {
    position: absolute;
    top: 10px;
    left: 15px;
    right: 15px;
    bottom: 10px;
}

.radius-8 { border-radius: 8px; }

.summary-card {
    transition: transform 0.2s;
    border: 1px solid #f0ede8 !important;
}
.summary-card:hover { transform: translateY(-2px); }

.widgets-icons {
    width: 38px;
    height: 38px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 8px;
    font-size: 16px; 
}
.bg-light-success { background-color: #e6f5f0; }
.bg-light-info { background-color: #e0f2fe; }
.bg-light-primary { background-color: #e0e7ff; color: #4f46e5 !important;}
.bg-light-danger { background-color: #fee2e2; }

.text-primary-dark { color: #0d7a5f; }
.letter-spacing { letter-spacing: 0.5px; }

.font-10 { font-size: 10px; }
.font-11 { font-size: 11px; }
.font-12 { font-size: 12px; }
.font-15 { font-size: 15px; }
</style>