<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tours', function (Blueprint $table) {
            $table->id();
            $table->string('tieu_de')->nullable();
            $table->string('slug')->nullable();
            $table->date('ngay_bat_dau')->nullable();
            $table->date('ngay_ket_thuc')->nullable();
            $table->string('mo_ta')->nullable();
            $table->string('mo_ta_chi_tiet')->nullable();
            $table->double('gia_nguoi_lon')->nullable();
            $table->double('gia_tre_em')->nullable();
            $table->integer('tinh_trang')->default(1);
            $table->integer('so_luong_khach')->nullable();
            $table->integer('is_khach_hang_dat')->default(0);
            $table->integer('id_nhan_vien')->nullable();
            $table->text('link_anh')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tours');
    }
};
