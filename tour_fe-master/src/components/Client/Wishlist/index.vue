<template>
  <div class="container mt-5">
    <h2 class="text-center mb-4">TOUR YÊU THÍCH</h2>
    
    <div v-if="!isLoggedIn" class="text-center py-5">
      <h4 class="text-muted">Vui lòng đăng nhập để xem tour yêu thích</h4>
      <router-link to="/dang-nhap" class="btn btn-primary mt-3">Đăng nhập</router-link>
    </div>

    <div v-else-if="listWishlist.length === 0" class="text-center py-5">
      <i class="fa-solid fa-heart text-muted fa-4x mb-3"></i>
      <h4 class="text-muted">Chưa có tour yêu thích nào</h4>
      <router-link to="/danh-sach-tour" class="btn btn-primary mt-3">Khám phá tour</router-link>
    </div>

    <div v-else class="row">
      <div class="col-md-3 mb-4" v-for="(item, index) in listWishlist" :key="index">
        <div class="card h-100 shadow-sm">
          <img :src="item.tour?.link_anh || 'https://via.placeholder.com/300x200'" class="card-img-top" style="height: 180px; object-fit: cover;" alt="">
          <div class="card-body">
            <h5 class="card-title">{{ item.tour?.tieu_de }}</h5>
            <p class="text-danger fw-bold">{{ formatCurrency(item.tour?.gia_tien) }}</p>
            <div class="d-flex gap-2">
              <router-link :to="'/chi-tiet-tour/' + item.tour_id" class="btn btn-primary btn-sm flex-grow-1">
                Xem chi tiết
              </router-link>
              <button @click="removeFromWishlist(item.tour_id)" class="btn btn-danger btn-sm">
                <i class="fa-solid fa-trash"></i>
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import baseRequest from "../../../core/baseRequestClient";

export default {
  data() {
    return {
      listWishlist: []
    }
  },
  computed: {
    isLoggedIn() {
      return !!localStorage.getItem('token_client');
    }
  },
  mounted() {
    if (this.isLoggedIn) {
      this.loadWishlist();
    }
  },
  methods: {
    loadWishlist() {
      baseRequest.get('client/wishlist/lay-du-lieu')
        .then((res) => {
          if (res.data.status) {
            this.listWishlist = res.data.data;
          }
        });
    },
    removeFromWishlist(tourId) {
      if (confirm('Xóa tour khỏi danh sách yêu thích?')) {
        baseRequest.post('client/wishlist/xoa', { tour_id: tourId })
          .then((res) => {
            if (res.data.status) {
              alert('Đã xóa khỏi wishlist!');
              this.loadWishlist();
            }
          });
      }
    },
    formatCurrency(value) {
      if (!value) return '';
      return new Intl.NumberFormat('vi-VN', {
        style: 'currency',
        currency: 'VND'
      }).format(value);
    }
  }
}
</script>
