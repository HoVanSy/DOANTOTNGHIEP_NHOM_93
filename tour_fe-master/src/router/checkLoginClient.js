import axios from "axios";
import { createToaster } from "@meforma/vue-toaster";
const toaster = createToaster({ position: "top-right" });

export default function(to, from, next) {
    const tokenClient = localStorage.getItem('token_client');

    if (!tokenClient) {
        toaster.warning('Thông báo<br>Bạn cần đăng nhập hệ thống trước!');
        return next('/client/dang-nhap');
    }

    axios
        .post('http://127.0.0.1:8000/api/account-client/check', {}, {
            headers: {
                Authorization: 'Bearer ' + tokenClient
            }
        })
        .then((res) => {
            if(res.status === 200) {
                localStorage.setItem('ho_ten_client', res.data.ho_ten_client); 
                
                localStorage.setItem('id_client', res.data.id); 
                
                next();
            } else {
                toaster.warning('Thông báo<br>Bạn cần đăng nhập hệ thống trước!');
                next('/client/dang-nhap');
            }
        })
        .catch(() => {
            toaster.warning('Phiên đăng nhập hết hạn, vui lòng đăng nhập lại!');
            next('/client/dang-nhap');
        });
}