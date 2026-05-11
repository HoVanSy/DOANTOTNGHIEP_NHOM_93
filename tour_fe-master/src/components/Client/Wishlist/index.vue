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

    <div v-else class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4 border rounded-4 p-3">
      <div class="col" v-for="(item, index) in listWishlist" :key="index">
          <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden tour-card">
              
              <div class="position-relative tour-img-wrapper">
                  <img :src="item.tour?.link_anh || 'https://via.placeholder.com/300x200'" class="card-img-top tour-img" alt="Ảnh Tour">
              </div>
              
              <div class="card-body d-flex flex-column p-3">
                  <h6 class="card-title fw-bold text-dark mb-2 tour-title">
                      <router-link :to="'/client/chi-tiet-tour/' + item.tour_id" class="text-decoration-none text-dark hover-primary">
                          {{ item.tour?.tieu_de }}
                      </router-link>
                  </h6>
                  
                  <p class="card-text text-danger fw-bold font-14 mb-3">
                      {{ formatCurrency(item.tour?.gia_tien) }}
                  </p>
                  
                  <div class="mt-auto pt-3 border-top d-flex gap-2">
                      <router-link :to="'/client/chi-tiet-tour/' + item.tour_id" class="btn btn-outline-primary rounded-pill flex-grow-1 fw-medium font-14">
                          Xem Chi Tiết
                      </router-link>
                      
                      <button @click="removeFromWishlist(item.tour_id)" class="btn btn-outline-danger rounded-pill px-3" title="Xóa khỏi yêu thích">
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
<style scoped>
/* Tiện ích tùy chỉnh kích thước chữ */
.font-14 { font-size: 14px; }

/* Hiệu ứng di chuột đổi màu xanh cho tiêu đề tour */
.hover-primary {
    transition: color 0.3s ease;
}
.hover-primary:hover {
    color: #0d6efd !important;
}

/* Hiệu ứng nẩy lên và đổ bóng cho cả khung Card Tour */
.tour-card {
    transition: all 0.3s ease;
}
.tour-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
}

/* Cố định khung ảnh và hiệu ứng Zoom ảnh bên trong */
.tour-img-wrapper {
    height: 180px;
    overflow: hidden;
}
.tour-img {
    height: 100%;
    width: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
}
.tour-card:hover .tour-img {
    transform: scale(1.1);
}

/* Ép tiêu đề tour luôn hiển thị 2 dòng (giữ form bằng nhau), dài quá tự hiện dấu 3 chấm */
.tour-title {
    display: -webkit-box;
    line-clamp: 2;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    height: 2.5em; 
}
</style>