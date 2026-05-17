<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $tables = ['hoa_dons', 'khach_hangs', 'nhan_viens', 'blogs', 'danh_gias', 'khuyen_mais', 'dia_diems'];

        foreach ($tables as $table) {
            Schema::table($table, function (Blueprint $t) {
                $t->softDeletes();
            });
        }
    }

    public function down(): void
    {
        $tables = ['hoa_dons', 'khach_hangs', 'nhan_viens', 'blogs', 'danh_gias', 'khuyen_mais', 'dia_diems'];

        foreach ($tables as $table) {
            Schema::table($table, function (Blueprint $t) {
                $t->dropSoftDeletes();
            });
        }
    }
};
