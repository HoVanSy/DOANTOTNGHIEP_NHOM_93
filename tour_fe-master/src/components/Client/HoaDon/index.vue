<template>
    <section id="invoice-page" class="bg-light py-5 min-vh-100">
        <div class="container">
            <div class="text-end mb-3 no-print">
                <button @click="printInvoice" class="btn btn-primary shadow-sm rounded-pill px-4">
                    <i class="fa-solid fa-print me-2"></i> In Hóa Đơn
                </button>
            </div>

            <div class="invoice-a4 shadow bg-white p-4 p-md-5 mx-auto" v-for="(v, k) in ct_hoa_don" :key="k">
                
                <div class="text-center mb-4">
                    <h2 class="invoice-title mb-3">HOÁ ĐƠN THANH TOÁN DỊCH VỤ</h2>
                    <p class="invoice-intro text-start text-dark">
                        Xin chân thành cảm ơn Quý khách đã tin tưởng ủng hộ dịch vụ du lịch của chúng tôi. 
                        <b>VivuTour</b> xin được xác nhận dịch vụ mà quý vị đã thanh toán như sau:
                    </p>
                </div>

                <table class="table-bordered w-100 mb-4 info-table">
                    <thead>
                        <tr class="bg-green text-white text-center">
                            <th width="50%" class="py-2">THÔNG TIN KHÁCH HÀNG</th>
                            <th width="50%" class="py-2">THÔNG TIN ĐẠI LÝ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="p-3 align-top">
                                <table class="w-100 inner-table">
                                    <tr><td width="35%">Khách hàng</td><td>: <b>{{ ten_khach_hang }}</b></td></tr>
                                    <tr><td>Mã đơn hàng</td><td>: #{{ v.id }}</td></tr>
                                    <tr><td>Điện thoại</td><td>: {{ sdt_khach_hang }}</td></tr>
                                    <tr><td>Ngày đặt</td><td>: {{ formatDate(v.created_at) }}</td></tr>
                                </table>
                            </td>
                            <td class="p-3 align-top">
                                <table class="w-100 inner-table">
                                    <tr><td width="35%">Đại diện</td><td>: <b>VivuTour Travel</b></td></tr>
                                    <tr><td>Điện thoại</td><td>: 0935.532.543</td></tr>
                                    <tr><td>Email</td><td>: vivutour@gmail.com</td></tr>
                                    <tr><td>Website</td><td>: www.vivutour.vn</td></tr>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <table class="table-bordered w-100 details-table">
                    <thead>
                        <tr class="text-center bg-light fw-bold">
                            <td width="15%" class="py-2">Ngày</td>
                            <td width="45%" class="py-2">Nội dung</td>
                            <td width="15%" class="py-2">Số lượng</td>
                            <td width="25%" class="py-2">Giá</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="bg-green text-white text-center fw-bold">
                            <td colspan="4" class="py-2 text-uppercase">
                                TOUR: {{ v.tieu_de }} - CODE: {{ v.id_tour }}
                            </td>
                        </tr>
                        
                        <tr class="text-center">
                            <td rowspan="2" class="align-middle fw-medium">{{ formatDate(v.created_at) }}</td>
                            <td class="text-start px-3 py-2">Người lớn (trên 10 tuổi)</td>
                            <td>{{ v.so_luong_nguoi_lon }}</td>
                            <td class="text-end px-3">{{ formatToVND(v.gia_nguoi_lon) }}</td>
                        </tr>
                        
                        <tr class="text-center">
                            <td class="text-start px-3 py-2">Trẻ em (dưới 10 tuổi)</td>
                            <td>{{ v.so_luong_tre_em }}</td>
                            <td class="text-end px-3">{{ formatToVND(v.gia_tre_em) }}</td>
                        </tr>

                        <tr>
                            <td colspan="4" class="p-3">
                                <div>
                                    <i class="fw-bold text-decoration-underline">Bao gồm:</i>
                                    <ul class="mb-2 mt-1 ps-4">
                                        <li>Xe bus máy lạnh/thuyền lớn đưa đón tham quan theo chương trình.</li>
                                        <li>Hướng dẫn viên nói tiếng Việt/Anh chuyên nghiệp, tận tình.</li>
                                        <li>Phí tham quan các điểm, ăn trưa theo chương trình, bảo hiểm du lịch.</li>
                                    </ul>
                                </div>
                                <div>
                                    <i class="fw-bold text-decoration-underline">Không bao gồm:</i>
                                    <ul class="mb-0 mt-1 ps-4">
                                        <li>Thuế VAT, tiền Tip cho HDV và tài xế.</li>
                                        <li>Chi phí cá nhân ăn uống ngoài chương trình.</li>
                                    </ul>
                                </div>
                            </td>
                        </tr>

                        <!-- Tổng kết -->
                        <tr>
                            <td colspan="3" class="text-end px-3 py-2 fw-bold">Thành tiền</td>
                            <td class="text-end px-3 py-2 fw-bold">{{ formatToVND(v.tong_tien) }}</td>
                        </tr>
                        <tr>
                            <td colspan="3" class="text-end px-3 py-2 fw-bold">Tổng tiền</td>
                            <td class="text-end px-3 py-2 fw-bold text-danger">{{ formatToVND(v.tong_tien) }}</td>
                        </tr>
                        <tr>
                            <td colspan="3" class="text-end px-3 py-2 fw-bold">Đã thanh toán</td>
                            <td class="text-end px-3 py-2 fw-bold">{{ v.tinh_trang == 1 ? formatToVND(v.tong_tien) : '0 ₫' }}</td>
                        </tr>
                        <tr>
                            <td colspan="3" class="text-end px-3 py-2 fw-bold">Còn lại</td>
                            <td class="text-end px-3 py-2 fw-bold">{{ v.tinh_trang == 1 ? '0 ₫' : formatToVND(v.tong_tien) }}</td>
                        </tr>
                    </tbody>
                </table>

                <!-- Chữ ký -->
                <div class="row mt-5 signature-section">
                    <div class="col-6"></div>
                    <div class="col-6 text-center">
                        <i class="d-block mb-1">Đà Nẵng, ngày {{ currentDay }} tháng {{ currentMonth }} năm {{ currentYear }}</i>
                        <h5 class="fw-bold mb-5">ĐẠI DIỆN CÔNG TY</h5>
                        <p class="mt-5 mb-0">(Ký và Ghi rõ họ tên)</p>
                        <b class="d-block mt-2">VivuTour</b>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import baseRequest from "../../../core/baseRequestClient";
import { createToaster } from "@meforma/vue-toaster";
const toaster = createToaster({ position: "top-right" });

export default {
    data() {
        return {
            ct_hoa_don: [],
            ten_khach_hang: localStorage.getItem('ho_ten_client') || 'Khách Hàng',
            sdt_khach_hang: ' ',
            currentDay: new Date().getDate().toString().padStart(2, '0'),
            currentMonth: (new Date().getMonth() + 1).toString().padStart(2, '0'),
            currentYear: new Date().getFullYear(),
        }
    },
    mounted() {
        this.loadDataChiTietHoaDon();
    },
    methods: {
        printInvoice() {
            window.print();
        },
        formatToVND(number) {
            number = parseInt(number) || 0;
            return number.toLocaleString('vi-VN', { style: 'currency', currency: 'VND' });
        },
        formatDate(date) {
            if (!date) return ''; 
            const d = new Date(date);
            const day = String(d.getDate()).padStart(2, '0'); 
            const month = String(d.getMonth() + 1).padStart(2, '0'); 
            const year = d.getFullYear(); 
            return `${day}/${month}/${year}`; 
        },
        loadDataChiTietHoaDon() {
            var url = window.location.href;
            var arr = url.split('/');
            var gui_di = {
                id: arr[arr.length - 1]
            }
            baseRequest
                .post('client/hoa-don/lay-thong-tin-chi-tiet-hoa-don/data', gui_di)
                .then((res) => {
                    if (res.data.status) {
                        this.ct_hoa_don = res.data.chi_tiet_hoa_don;
                    } else {
                        toaster.error('Thông báo<br>' + res.data.message);
                    }
                });
        },
    },
}
</script>

<style scoped>
#invoice-page {
    font-family: "Times New Roman", Times, serif; 
    color: #000;
}

.invoice-a4 {
    max-width: 900px; 
    background: #fff;
    margin: 0 auto;
    border: 1px solid #ddd;
}

.invoice-title {
    color: #003399;
    font-weight: bold;
    font-size: 24px;
}
.bg-green {
    background-color: #00A651 !important; 
}
.text-white {
    color: #fff !important;
}

table.table-bordered {
    border-collapse: collapse;
}
table.table-bordered th,
table.table-bordered td {
    border: 1px solid #333;
}
.inner-table td {
    border: none;
    padding: 2px 0;
    font-size: 15px;
}
.details-table td {
    font-size: 15px;
}
.details-table ul li {
    margin-bottom: 4px;
    font-size: 14.5px;
}

@media print {
    body * {
        visibility: hidden;
    }
    #invoice-page, #invoice-page * {
        visibility: visible;
    }
    #invoice-page {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
        background: #fff;
        padding: 0 !important;
    }
    .no-print {
        display: none !important;
    }
    .invoice-a4 {
        box-shadow: none !important;
        border: none !important;
        max-width: 100%;
        width: 100%;
    }
    .bg-green {
        background-color: #00A651 !important;
        -webkit-print-color-adjust: exact; 
        print-color-adjust: exact; 
    }
    .bg-light {
        background-color: #f8f9fa !important;
        -webkit-print-color-adjust: exact; 
        print-color-adjust: exact; 
    }
}
</style>