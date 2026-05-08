<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call([
            ChucVu::class,
            ChucNang::class,
            DiaDiem::class,
            NhanVien::class,
            QuanHuyen::class,
            TinhThanh::class,
            KhachHangSeeder::class,
            Tour::class,
            ChiTietTour::class,
            ChiTietChucNang::class,
            HoaDonSeeder::class,
            WishlistSeeder::class,
            YeuCauHuySeeder::class,
            BlogSeeder::class,
        ]);
    }
}
