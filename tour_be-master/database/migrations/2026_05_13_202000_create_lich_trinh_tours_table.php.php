<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lich_trinh_tours', function (Blueprint $table) {
            $table->id();
            $table->integer('id_tour');
            $table->integer('so_ngay');
            $table->string('tieu_de');
            $table->text('mo_ta')->nullable();
            $table->string('dia_diem_di');
            $table->string('dia_diem_den');
            $table->string('phuong_tien');
            $table->time('gio_khoi_hanh')->nullable();
            $table->time('gio_ket_thuc')->nullable();
            $table->string('anh_lich_trinh')->nullable();
            $table->integer('tinh_trang')->default(1);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lich_trinh_tours');
    }
};
