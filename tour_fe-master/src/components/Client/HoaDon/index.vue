<template>
    <section id="invoice">
        <div class="container">
            <div class="text-center">
                <img width="300px" src="https://trangchudulich.com/wp-content/uploads/2023/11/logo-img.png" alt="">
            </div>
            <div class="text-center border-top border-bottom my-5 py-3">
                <h2 class="display-5 fw-bold">Hóa Đơn Thanh Toán</h2>
                <template v-for="(v, k) in ct_hoa_don">
                    <p class="m-0">Số Hóa Đơn: <i>{{ v.id }}</i></p>
                    <br>
                    <p>Ngày Đặt: <i>{{ formatDate(v.created_at) }}</i></p>
                </template>
            </div>
            <table class="table border my-5">
                <thead>
                    <tr class="bg-primary-subtle ">
                        <th scope="col" class="text-center">#</th>
                        <th scope="col">Tên Tour</th>
                        <th scope="col">Giá Người Lớn</th>
                        <th scope="col">Số Lượng</th>
                        <th scope="col">Giá Trẻ Em</th>
                        <th scope="col">Số Lượng</th>
                        <th scope="col">Thành Tiền</th>
                    </tr>
                </thead>
                <tbody>
                    <template v-for="(v, k) in ct_hoa_don">
                        <tr>
                            <th scope="row" class="text-center">{{ k + 1 }}</th>
                            <td>{{ v.tieu_de }}</td>
                            <!-- <td>{{ formatToVND(value.don_gia) }}</td> -->
                            <td class="text-danger">{{ formatToVND(v.gia_nguoi_lon) }}</td>
                            <td class="text-danger">x {{ v.so_luong_nguoi_lon }}</td>
                            <td class="text-danger">{{ formatToVND(v.gia_tre_em) }}</td>
                            <td class="text-danger">x {{ v.so_luong_tre_em }}</td>
                            <td class="text-danger">{{ formatToVND(v.tong_tien) }}</td>
                        </tr>
                    </template>
                    <tr v-for="(v, k) in ct_hoa_don">
                        <th></th>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="">Tổng Tiền Hóa Đơn</td>
                        <td>{{ formatToVND(v.tong_tien) }}</td>
                    </tr>
                    <tr v-for="(v, k) in ct_hoa_don">
                        <th></th>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="text-primary fw-bold">Tổng Tiền Thanh Toán</td>
                        <td class="text-primary fw-bold">{{ formatToVND(v.tong_tien) }}</td>
                    </tr>
                </tbody>
            </table>

            <div class="d-md-flex justify-content-between my-5">
                <div>
                    <h5 class="fw-bold my-4">Contact Us</h5>
                    <ul class="list-unstyled">
                        <li><iconify-icon class="social-icon text-primary fs-5 me-2" icon="ic:baseline-email"
                                style="vertical-align:text-bottom"></iconify-icon>Du Lịch VivuTour</li>
                        <li><iconify-icon class="social-icon text-primary fs-5 me-2" icon="mdi:location"
                                style="vertical-align:text-bottom"></iconify-icon> 32 Xuân Diệu, Thuận Phước, Hải Châu,
                            Đà Nẵng</li>
                        <li><iconify-icon class="social-icon text-primary fs-5 me-2" icon="solar:phone-bold"
                                style="vertical-align:text-bottom"></iconify-icon> 0935532543</li>
                        <li><iconify-icon class="social-icon text-primary fs-5 me-2" icon="ic:baseline-email"
                                style="vertical-align:text-bottom"></iconify-icon> vivutour@gmail.com</li>

                    </ul>
                </div>
                <div>
                    <h5 class="fw-bold my-4">Thông Tin Thanh Toán</h5>
                    <ul class="list-unstyled">
                        <li><span class="fw-semibold">Account No: </span> 1910061030119</li>
                        <li><span class="fw-semibold">Account Name: </span> LE THANH TRUONG</li>
                        <li><span class="fw-semibold">Bank Name: </span> MB Bank </li>
                    </ul>
                </div>
            </div>
            <div id="footer-bottom">
                <div class="container border-top">
                    <div class="row mt-3">
                        <div class="col-md-6 copyright">
                            <p>© 2024 vivutour. <a href="#" target="_blank"
                                    class="text-decoration-none text-black-50">Terms
                                    & Support</a> </p>
                        </div>
                        <div class="col-md-6 text-md-end">
                            <p>Design By: <a href="https://templatesjungle.com/" target="_blank"
                                    class="text-decoration-none text-black-50">
                                    VivuTour</a> </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
<script>
import axios from "axios";
import baseRequest from "../../../core/baseRequestClient";
import baseRequestAdmin from "../../../core/baseRequest";
import { createToaster } from "@meforma/vue-toaster";
const toaster = createToaster({ position: "top-right" });
export default {
    data() {
        return {
            ct_hoa_don: [],
            hoa_don: {},
            date: '',
            id_tour: this.$route.params.id,
            ct_hoa_don: [],
        }
    },
    mounted() {
        // this.getData();
        this.date = new Date().toISOString().slice(0, 10);
        this.loadDataChiTietHoaDon();
    },
    methods: {
        formatToVND(number) {
            number = parseInt(number);
            return number.toLocaleString('vi-VN', { style: 'currency', currency: 'VND' });
        },

        formatDate(date) {
            if (!date) return ''; // Kiểm tra nếu không có ngày
            const d = new Date(date);
            const day = String(d.getDate()).padStart(2, '0'); // Lấy ngày, thêm số 0 nếu cần
            const month = String(d.getMonth() + 1).padStart(2, '0'); // Tháng + 1, thêm số 0
            const year = d.getFullYear(); // Lấy năm
            return `${day}/${month}/${year}`; // Trả về chuỗi định dạng dd/mm/yyyy
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
                        console.log(this.ct_hoa_don);
                    } else {
                        toaster.error('Thông báo<br>' + res.data.message);
                    }
                });
        },
    },
}
</script>
<style></style>