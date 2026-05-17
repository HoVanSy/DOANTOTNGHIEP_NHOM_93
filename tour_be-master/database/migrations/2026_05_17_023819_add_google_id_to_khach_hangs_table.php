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
        Schema::table('khach_hangs', function (Blueprint $table) {
            $table->string('google_id')->nullable();
            $table->string('password')->nullable()->change(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('khach_hangs', function (Blueprint $table) {
            $table->dropColumn('google_id');
            // Khôi phục lại tính bắt buộc của cột password nếu cần
            $table->string('password')->nullable(false)->change();
        });
    }
};
