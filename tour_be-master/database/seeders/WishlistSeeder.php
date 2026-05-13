<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WishlistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('wishlists')->delete();

        DB::table('wishlists')->truncate();

        DB::table('wishlists')->insert([
            [
                'khach_hang_id' => 1,
                'tour_id' => 1,
            ],
            [
                'khach_hang_id' => 1,
                'tour_id' => 3,
            ],
            [
                'khach_hang_id' => 2,
                'tour_id' => 2,
            ],
            [
                'khach_hang_id' => 3,
                'tour_id' => 4,
            ],
            [
                'khach_hang_id' => 4,
                'tour_id' => 5,
            ],
            [
                'khach_hang_id' => 5,
                'tour_id' => 6,
            ],
        ]);
    }
}
