<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('yeu_cau_huys', function (Blueprint $table) {
            $table->id();
            $table->integer('hoa_don_id');
            $table->integer('khach_hang_id');
            $table->enum('loai_yeu_cau', ['huy', 'doi_lich']);
            $table->text('ly_do');
            $table->integer('trang_thai')->default(0);
            $table->string('ghi_chu')->nullable();
            $table->date('ngay_khoi_hanh_moi')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('yeu_cau_huys');
    }
};
