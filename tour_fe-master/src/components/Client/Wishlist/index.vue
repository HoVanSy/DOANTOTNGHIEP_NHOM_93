<template>
  <div class="wishlist-page py-4">
    <div class="container mt-3">
      <div class="section-header mb-4">
            <span class="section-tag">Bộ sưu tập của bạn</span>
            <h2 class="section-title">Tour Yêu Thích</h2>
            <div class="header-line"></div>
        </div>

      <!-- ── TRẠNG THÁI CHƯA ĐĂNG NHẬP ── -->
      <div v-if="!isLoggedIn" class="empty-state text-center py-5 rounded-4">
        <div class="icon-box mb-3">
          <i class="fa-solid fa-heart-circle-xmark fa-3x text-muted opacity-50"></i>
        </div>
        <h5 class="fw-bold text-dark">Bắt đầu lưu giữ hành trình</h5>
        <p class="text-muted small">Vui lòng đăng nhập để xem danh sách các tour bạn đã yêu thích.</p>
        <router-link to="/dang-nhap" class="btn-primary-custom mt-2">Đăng nhập ngay</router-link>
      </div>

      <!-- ── TRẠNG THÁI DANH SÁCH TRỐNG ── -->
      <div v-else-if="listWishlist.length === 0" class="empty-state text-center py-5 rounded-4">
        <div class="icon-box mb-3">
          <i class="fa-solid fa-heart fa-3x text-muted opacity-25"></i>
        </div>
        <h5 class="fw-bold text-dark">Danh sách đang trống</h5>
        <p class="text-muted small">Hãy dạo quanh một vòng và "thả tim" cho những chuyến đi bạn thích nhé!</p>
        <router-link to="/client/danh-sach-tour" class="btn-primary-custom mt-2">Khám phá tour ngay</router-link>
      </div>

      <!-- ── DANH SÁCH WISHLIST ── -->
      <div v-else class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-3">
        <div class="col" v-for="(item, index) in listWishlist" :key="index">
          <div class="tour-card h-100 rounded-3 overflow-hidden border-0 shadow-sm bg-white">
            
            <div class="position-relative tour-img-wrapper" @click="$router.push('/client/chi-tiet-tour/' + item.tour_id)">
              <img :src="item.tour?.link_anh || 'https://via.placeholder.com/300x200'" class="tour-img" alt="Ảnh Tour">
              <div class="img-overlay"></div>
            </div>
            
            <div class="card-body d-flex flex-column p-3">
              <h6 class="tour-title fw-bold mb-2">
                <router-link :to="'/client/chi-tiet-tour/' + item.tour_id" class="text-decoration-none text-dark hover-primary">
                  {{ item.tour?.tieu_de }}
                </router-link>
              </h6>
              
              <div class="price-section mb-3">
                <span class="price-label small text-muted">Giá từ</span>
                <p class="price-value text-danger fw-bold mb-0">
                  {{ formatCurrency(item.tour?.gia_tien) }}
                </p>
              </div>
              
              <div class="mt-auto pt-2 border-top d-flex gap-2">
                <router-link :to="'/client/chi-tiet-tour/' + item.tour_id" class="btn-detail flex-grow-1">
                  Xem Chi Tiết
                </router-link>
                
                <button @click="removeFromWishlist(item.tour_id)" class="btn-remove" title="Xóa khỏi yêu thích">
                  <i class="fa-solid fa-trash-can"></i>
                </button>
              </div>
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
              this.loadWishlist();
            }
          });
      }
    },
    formatCurrency(value) {
      if (!value) return 'Liên hệ';
      return new Intl.NumberFormat('vi-VN', {
        style: 'currency',
        currency: 'VND'
      }).format(value);
    }
  }
}
</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@300;400;500;600;700;800&display=swap');

.wishlist-page {
  font-family: 'Be Vietnam Pro', sans-serif;
  background: #f8f7f4;
  min-height: 80vh;
}

/* ── HEADER ── */
.section-tag {
  font-size: 10px;
  font-weight: 700;
  letter-spacing: 1.8px;
  text-transform: uppercase;
  color: #0d7a5f;
  background: rgba(13, 122, 95, 0.1);
  padding: 4px 12px;
  border-radius: 50px;
}
.section-title {
  font-size: 26px;
  font-weight: 800;
  color: #1a1f2e;
  margin-top: 8px;
}
.header-line {
  width: 50px;
  height: 3px;
  background: #0d7a5f;
  border-radius: 50px;
}

/* ── CARDS ── */
.tour-card {
  transition: all 0.3s ease;
  border: 1px solid #f0ede8 !important;
}
.tour-card:hover {
  transform: translateY(-6px);
  box-shadow: 0 10px 25px rgba(0,0,0,0.08) !important;
}

.tour-img-wrapper {
  height: 165px; /* Giảm ~10% từ 180px */
  overflow: hidden;
  cursor: pointer;
}
.tour-img {
  height: 100%;
  width: 100%;
  object-fit: cover;
  transition: transform 0.5s ease;
}
.tour-card:hover .tour-img {
  transform: scale(1.08);
}

.tour-title {
  font-size: 15px;
  line-height: 1.4;
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
  height: 2.8em;
}

.price-value {
  font-size: 15px;
}

/* ── BUTTONS ── */
.btn-detail {
  display: flex;
  align-items: center;
  justify-content: center;
  text-decoration: none;
  background: transparent;
  color: #0d7a5f;
  border: 1.5px solid #0d7a5f;
  border-radius: 50px;
  font-size: 12px;
  font-weight: 700;
  transition: 0.3s;
  padding: 6px 12px;
}
.btn-detail:hover {
  background: #0d7a5f;
  color: #fff;
}

.btn-remove {
  background: #fff;
  color: #dc3545;
  border: 1.5px solid #ffeded;
  border-radius: 50px;
  width: 34px;
  height: 34px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 13px;
  transition: 0.2s;
}
.btn-remove:hover {
  background: #dc3545;
  color: #fff;
  border-color: #dc3545;
}

.btn-primary-custom {
  display: inline-block;
  background: #0d7a5f;
  color: #fff;
  padding: 8px 20px;
  border-radius: 50px;
  font-weight: 600;
  font-size: 13px;
  text-decoration: none;
  transition: 0.3s;
}
.btn-primary-custom:hover {
  background: #085544;
  transform: translateY(-2px);
}

.hover-primary:hover {
  color: #0d7a5f !important;
}

/* ── EMPTY STATE ── */
.empty-state {
  background: #fff;
  border: 1px dashed #e5e7eb;
}
</style>