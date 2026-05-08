<template>
  <div class="container mt-5">
    <h2 class="text-center mb-4">TIN TỨC & BLOG DU LỊCH</h2>
    
    <div class="row">
      <div class="col-md-4 mb-4" v-for="(blog, index) in list_blog" :key="index">
        <div class="card h-100 shadow-sm">
          <img :src="blog.hinh_anh || 'https://via.placeholder.com/400x200'" class="card-img-top" style="height: 200px; object-fit: cover;" alt="">
          <div class="card-body">
            <h5 class="card-title">{{ blog.tieu_de }}</h5>
            <p class="card-text text-muted small">{{ truncateText(blog.noi_dung, 100) }}</p>
            <p class="small text-muted">
              <i class="fa-solid fa-user"></i> {{ blog.tac_gia || 'Admin' }} |
              <i class="fa-solid fa-calendar"></i> {{ formatDate(blog.created_at) }}
            </p>
            <button @click="xemChiTiet(blog.id)" class="btn btn-primary w-100">
              Đọc thêm
            </button>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal Chi tiết Blog -->
    <div class="modal fade" id="blogModal" tabindex="-1">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header bg-primary text-white">
            <h5 class="modal-title">{{ chiTietBlog?.tieu_de }}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body" v-if="chiTietBlog">
            <img :src="chiTietBlog.hinh_anh" class="img-fluid mb-3" alt="">
            <div v-html="chiTietBlog.noi_dung"></div>
            <hr>
            <p class="text-muted">
              <i class="fa-solid fa-user"></i> {{ chiTietBlog.tac_gia || 'Admin' }} |
              <i class="fa-solid fa-calendar"></i> {{ formatDate(chiTietBlog.created_at) }}
            </p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
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
            let modal = new bootstrap.Modal(document.getElementById('blogModal'));
            modal.show();
          }
        });
    },
    truncateText(text, length) {
      if (!text) return '';
      return text.length > length ? text.substring(0, length) + '...' : text;
    },
    formatDate(date) {
      return new Date(date).toLocaleDateString('vi-VN');
    }
  }
}
</script>
