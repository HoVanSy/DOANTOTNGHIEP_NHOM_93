<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->string('tieu_de');
            $table->string('hinh_anh')->nullable();
            $table->longText('noi_dung')->nullable();
            $table->string('slug')->nullable();
            $table->string('tac_gia')->nullable();
            $table->integer('tinh_trang')->default(1);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};
