<template>
  <div class="blog-page py-4"> <!-- Giảm py-5 xuống py-4 -->
    <div class="container mt-3"> <!-- Giảm mt-4 xuống mt-3 -->
      <!-- ── SECTION HEADER ── -->
      <div class="section-header text-center mb-4"> <!-- Giảm mb-5 xuống mb-4 -->
        <span class="section-tag">Cảm hứng du lịch</span>
        <h2 class="section-title">Tin Tức & Blog Du Lịch</h2>
        <div class="header-line mx-auto"></div>
      </div>
      
      <!-- ── BLOG LIST ── -->
      <div class="row g-3"> 
        <div class="col-md-6 col-lg-4" v-for="(blog, index) in list_blog" :key="index">
          <div class="blog-card h-100 rounded-3 overflow-hidden border-0 shadow-sm"> 
            <div class="blog-img-wrapper" @click="xemChiTiet(blog.id)">
              <img :src="blog.hinh_anh || 'https://via.placeholder.com/400x250'" class="blog-img" alt="Blog Thumb">
              <div class="blog-date-badge">
                <i class="fa-solid fa-calendar-days me-1"></i> {{ formatDate(blog.created_at) }}
              </div>
            </div>
            
            <div class="blog-body p-3">
              <div class="blog-meta mb-1"> 
                <span class="meta-item"><i class="fa-solid fa-user me-1"></i> {{ blog.tac_gia || 'Admin' }}</span>
              </div>
              <h5 class="blog-title fw-bold" @click="xemChiTiet(blog.id)">{{ blog.tieu_de }}</h5>
              <p class="blog-desc text-muted mb-3">{{ truncateText(blog.noi_dung, 90) }}</p>
              
              <button @click="xemChiTiet(blog.id)" class="read-more-btn">
                Đọc hành trình <i class="fa-solid fa-arrow-right ms-2"></i>
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="blogModal" tabindex="-1">
      <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 rounded-3 overflow-hidden shadow-lg">
          <div class="modal-header-custom p-2" v-if="chiTietBlog">
             <button type="button" class="close-modal-btn" data-bs-dismiss="modal">
               <i class="fa-solid fa-xmark"></i>
             </button>
          </div>
          
          <div class="modal-body p-0" v-if="chiTietBlog">
            <div class="modal-hero-img">
              <img :src="chiTietBlog.hinh_anh" class="w-100 h-100 object-fit-cover" alt="">
              <div class="hero-overlay"></div>
            </div>
            
            <div class="p-4 p-lg-4"> <!-- Giảm p-5 xuống p-4 -->
              <span class="section-tag mb-2">Bài viết chi tiết</span>
              <h3 class="modal-blog-title mb-2">{{ chiTietBlog.tieu_de }}</h3>
              
              <div class="modal-meta mb-3 pb-3 border-bottom"> <!-- Giảm mb-4 xuống mb-3 -->
                <span class="me-3"><i class="fa-solid fa-user text-primary-dark me-1"></i> {{ chiTietBlog.tac_gia || 'Admin' }}</span>
                <span><i class="fa-solid fa-calendar-days text-primary-dark me-1"></i> {{ formatDate(chiTietBlog.created_at) }}</span>
              </div>
              
              <div class="blog-content-rich" v-html="chiTietBlog.noi_dung"></div>
            </div>
          </div>
          
          <div class="modal-footer border-0 p-3 pt-0">
            <button type="button" class="btn-close-custom" data-bs-dismiss="modal">Quay lại danh sách</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@300;400;500;600;700;800&display=swap');

/* ── BASE ── */
.blog-page {
  font-family: 'Be Vietnam Pro', sans-serif;
  background: #f8f7f4;
  min-height: 100vh;
}

/* ── SECTION HEADER ── */
.section-tag {
  font-size: 11px;
  font-weight: 700;
  letter-spacing: 2px;
  text-transform: uppercase;
  color: #0d7a5f;
  background: rgba(13, 122, 95, 0.1);
  padding: 5px 15px;
  border-radius: 50px;
  display: inline-block;
}
.section-title {
  font-size: 32px;
  font-weight: 800;
  color: #1a1f2e;
  margin-top: 10px;
}
.header-line {
  width: 60px;
  height: 3px;
  background: #0d7a5f;
  border-radius: 50px;
}

/* ── BLOG CARDS ── */
.blog-card {
  background: #fff;
  transition: transform 0.3s ease, box-shadow 0.3s ease;
  border: 1px solid #f0ede8;
}
.blog-card:hover {
  transform: translateY(-8px);
  box-shadow: 0 15px 35px rgba(0,0,0,0.08) !important;
}

.blog-img-wrapper {
  height: 240px;
  overflow: hidden;
  position: relative;
  cursor: pointer;
}
.blog-img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform 0.6s ease;
}
.blog-card:hover .blog-img {
  transform: scale(1.1);
}

.blog-date-badge {
  position: absolute;
  top: 15px;
  right: 15px;
  background: rgba(255, 255, 255, 0.95);
  backdrop-filter: blur(4px);
  padding: 6px 14px;
  border-radius: 50px;
  font-size: 12px;
  font-weight: 700;
  color: #0d7a5f;
  box-shadow: 0 4px 10px rgba(0,0,0,0.1);
}

.blog-meta {
  font-size: 13px;
  color: #6b7280;
  font-weight: 500;
}

.blog-title {
  font-size: 19px;
  line-height: 1.4;
  color: #1a1f2e;
  margin-bottom: 15px;
  cursor: pointer;
  transition: color 0.2s;
}
.blog-title:hover {
  color: #0d7a5f;
}

.blog-desc {
  font-size: 14px;
  line-height: 1.6;
  display: -webkit-box;
  -webkit-line-clamp: 3;
  -webkit-box-orient: vertical;
  overflow: hidden;
}

.read-more-btn {
  background: transparent;
  border: none;
  color: #0d7a5f;
  font-weight: 700;
  font-size: 14px;
  padding: 0;
  transition: gap 0.2s;
  display: inline-flex;
  align-items: center;
}
.read-more-btn:hover {
  color: #085544;
}
.read-more-btn:hover i {
  transform: translateX(5px);
  transition: transform 0.2s;
}

/* ── MODAL STYLES ── */
.modal-hero-img {
  height: 350px;
  position: relative;
}
.hero-overlay {
  position: absolute;
  inset: 0;
  background: linear-gradient(to bottom, rgba(0,0,0,0.2), rgba(0,0,0,0));
}
.modal-header-custom {
  position: absolute;
  top: 0;
  right: 0;
  z-index: 10;
}
.close-modal-btn {
  background: rgba(0,0,0,0.5);
  color: #fff;
  border: none;
  width: 40px;
  height: 40px;
  border-radius: 50%;
  margin: 15px;
  display: flex;
  align-items: center;
  justify-content: center;
  transition: 0.2s;
}
.close-modal-btn:hover {
  background: rgba(220, 53, 69, 0.9);
}

.modal-blog-title {
  font-weight: 800;
  color: #1a1f2e;
  line-height: 1.3;
}
.text-primary-dark {
  color: #0d7a5f;
}
.blog-content-rich {
  line-height: 1.8;
  color: #4b5563;
  font-size: 16px;
}
.blog-content-rich >>> img {
  max-width: 100%;
  border-radius: 12px;
  margin: 20px 0;
}

.btn-close-custom {
  background: #f1f8f6;
  border: 1px solid #e5e7eb;
  padding: 10px 25px;
  border-radius: 50px;
  font-weight: 600;
  color: #0d7a5f;
  transition: 0.2s;
}
.btn-close-custom:hover {
  background: #0d7a5f;
  color: #fff;
}
</style>

<script>
// Logic giữ nguyên 100% như yêu cầu của bạn ở turn trước
import baseRequest from "../../../core/baseRequestClient";

export default {
  data() {
    return {
      list_blog: [],
      chiTietBlog: null
    }
  },
  mounted() {
    this.loadBlog();
  },
  methods: {
    loadBlog() {
      baseRequest.get('blog/lay-du-lieu')
        .then((res) => {
          if (res.data.status) {
            this.list_blog = res.data.data;
          }
        });
    },
    xemChiTiet(id) {
      baseRequest.get('blog/chi-tiet/' + id)
        .then((res) => {
          if (res.data.status) {
            this.chiTietBlog = res.data.data;
            // eslint-disable-next-line no-undef
            let modal = new bootstrap.Modal(document.getElementById('blogModal'));
            modal.show();
          }
        });
    },
    truncateText(text, length) {
      if (!text) return '';
      const plainText = text.replace(/<[^>]*>?/gm, '');
      return plainText.length > length ? plainText.substring(0, length) + '...' : plainText;
    },
    formatDate(date) {
      if (!date) return '';
      return new Date(date).toLocaleDateString('vi-VN');
    }
  }
}
</script>