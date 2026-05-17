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
        Schema::create('khach_hangs', function (Blueprint $table) {
            $table->id();
            $table->string("ho_ten");
            $table->string("email");
            $table->string("so_dien_thoai")->nullable();
            $table->string("password");
            $table->date("ngay_sinh")->nullable();

            $table->string("dia_chi")->nullable();
            $table->integer("gioi_tinh")->nullable();

            $table->integer("tinh_trang")->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('khach_hangs');
    }
};
