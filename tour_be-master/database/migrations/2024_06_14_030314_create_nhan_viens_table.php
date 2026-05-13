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
        Schema::create('nhan_viens', function (Blueprint $table) {
            $table->id();
            $table->string('ho_ten');
            $table->string('ma_nhan_vien');
            $table->string('email');
            $table->string('so_dien_thoai')->nullable();
            $table->string('password');
            $table->date('ngay_sinh')->nullable();
            $table->integer('id_chuc_vu');
            $table->integer('tinh_trang')->default(1);
            $table->integer('is_master')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nhan_viens');
    }
};
