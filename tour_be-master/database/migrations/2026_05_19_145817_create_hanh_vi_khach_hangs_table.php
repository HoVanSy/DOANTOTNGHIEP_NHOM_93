<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('hanh_vi_khach_hangs', function (Blueprint $table) {
            $table->id();
            $table->integer('id_khach_hang');
            $table->integer('id_tour');
            $table->string('loai_hanh_vi'); // Lịch sử: 'view' (xem), 'favorite' (thích), 'book' (đặt)
            $table->integer('diem_so')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hanh_vi_khach_hangs');
    }
};
