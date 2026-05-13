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
        Schema::create('dia_diems', function (Blueprint $table) {
            $table->id();
            $table->string('ten_dia_diem');
            $table->string('slug')->nullable();
            $table->integer('loai_dia_diem');
            $table->integer('gia_tien')->nullable();
            $table->integer('is_open')->default(1);
            $table->integer('id_tinh_thanh');
            $table->integer('id_quan_huyen')->nullable();
            $table->string('toa_do_x')->nullable();
            $table->string('toa_do_y')->nullable();
            $table->text('link_anh');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dia_diems');
    }
};
