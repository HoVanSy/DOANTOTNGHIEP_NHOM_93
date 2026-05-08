<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('yeu_cau_huy', function (Blueprint $table) {
            $table->id();
            $table->integer('hoa_don_id');
            $table->integer('khach_hang_id');
            $table->string('loai_yeu_cau'); // 'huy' hoặc 'doi_lich'
            $table->text('ly_do');
            $table->date('ngay_khoi_hanh_moi')->nullable(); // Có thể rỗng nếu chỉ là hủy
            $table->integer('trang_thai')->default(0); // 0: Chờ, 1: Duyệt, 2: Từ chối
            $table->text('ghi_chu')->nullable(); // Admin ghi chú lý do từ chối
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('yeu_cau_huy');
    }
};