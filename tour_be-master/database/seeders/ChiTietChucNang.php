<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ChiTietChucNang extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('chi_tiet_chuc_nangs')->delete();

        DB::table('chi_tiet_chuc_nangs')->truncate();

        DB::table('chi_tiet_chuc_nangs')->insert([
            ['id' => '1', 'id_chuc_vu' => '1', 'id_chuc_nang' => '1'],
            ['id' => '2', 'id_chuc_vu' => '1', 'id_chuc_nang' => '2'],
            ['id' => '3', 'id_chuc_vu' => '1', 'id_chuc_nang' => '3'],
            ['id' => '4', 'id_chuc_vu' => '1', 'id_chuc_nang' => '4'],
            ['id' => '5', 'id_chuc_vu' => '1', 'id_chuc_nang' => '5'],
            ['id' => '6', 'id_chuc_vu' => '1', 'id_chuc_nang' => '6'],
            ['id' => '7', 'id_chuc_vu' => '1', 'id_chuc_nang' => '7'],
            ['id' => '8', 'id_chuc_vu' => '1', 'id_chuc_nang' => '8'],
            ['id' => '9', 'id_chuc_vu' => '1', 'id_chuc_nang' => '9'],
            ['id' => '10', 'id_chuc_vu' => '1', 'id_chuc_nang' => '10'],
            ['id' => '11', 'id_chuc_vu' => '1', 'id_chuc_nang' => '11'],
            ['id' => '12', 'id_chuc_vu' => '1', 'id_chuc_nang' => '12'],
            ['id' => '13', 'id_chuc_vu' => '1', 'id_chuc_nang' => '13'],
            ['id' => '14', 'id_chuc_vu' => '1', 'id_chuc_nang' => '14'],
            ['id' => '15', 'id_chuc_vu' => '1', 'id_chuc_nang' => '15'],
            ['id' => '16', 'id_chuc_vu' => '1', 'id_chuc_nang' => '16'],
            ['id' => '17', 'id_chuc_vu' => '1', 'id_chuc_nang' => '17'],
            ['id' => '18', 'id_chuc_vu' => '1', 'id_chuc_nang' => '18'],
            ['id' => '19', 'id_chuc_vu' => '1', 'id_chuc_nang' => '19'],
            ['id' => '20', 'id_chuc_vu' => '1', 'id_chuc_nang' => '20'],
            ['id' => '21', 'id_chuc_vu' => '1', 'id_chuc_nang' => '21'],
            ['id' => '22', 'id_chuc_vu' => '1', 'id_chuc_nang' => '22'],
            ['id' => '23', 'id_chuc_vu' => '1', 'id_chuc_nang' => '23'],
            ['id' => '24', 'id_chuc_vu' => '1', 'id_chuc_nang' => '24'],
            ['id' => '25', 'id_chuc_vu' => '1', 'id_chuc_nang' => '25'],
            ['id' => '26', 'id_chuc_vu' => '1', 'id_chuc_nang' => '26'],
            ['id' => '27', 'id_chuc_vu' => '1', 'id_chuc_nang' => '27'],
            ['id' => '28', 'id_chuc_vu' => '1', 'id_chuc_nang' => '28'],
            ['id' => '29', 'id_chuc_vu' => '1', 'id_chuc_nang' => '29'],
            ['id' => '30', 'id_chuc_vu' => '1', 'id_chuc_nang' => '30'],
            ['id' => '31', 'id_chuc_vu' => '1', 'id_chuc_nang' => '31'],
            ['id' => '32', 'id_chuc_vu' => '1', 'id_chuc_nang' => '32'],
            ['id' => '33', 'id_chuc_vu' => '1', 'id_chuc_nang' => '33'],
            ['id' => '34', 'id_chuc_vu' => '1', 'id_chuc_nang' => '34'],
            ['id' => '35', 'id_chuc_vu' => '1', 'id_chuc_nang' => '35'],
            ['id' => '36', 'id_chuc_vu' => '1', 'id_chuc_nang' => '36'],
            ['id' => '37', 'id_chuc_vu' => '1', 'id_chuc_nang' => '37'],
            ['id' => '38', 'id_chuc_vu' => '1', 'id_chuc_nang' => '38'],
            ['id' => '39', 'id_chuc_vu' => '1', 'id_chuc_nang' => '39'],
            ['id' => '40', 'id_chuc_vu' => '1', 'id_chuc_nang' => '40'],
            ['id' => '41', 'id_chuc_vu' => '1', 'id_chuc_nang' => '41'],
            ['id' => '42', 'id_chuc_vu' => '1', 'id_chuc_nang' => '42'],
            ['id' => '43', 'id_chuc_vu' => '1', 'id_chuc_nang' => '43'],
            ['id' => '44', 'id_chuc_vu' => '1', 'id_chuc_nang' => '44'],
            ['id' => '45', 'id_chuc_vu' => '1', 'id_chuc_nang' => '45'],
            ['id' => '46', 'id_chuc_vu' => '1', 'id_chuc_nang' => '46'],
            ['id' => '47', 'id_chuc_vu' => '1', 'id_chuc_nang' => '47'],
            ['id' => '48', 'id_chuc_vu' => '1', 'id_chuc_nang' => '48'],
            ['id' => '49', 'id_chuc_vu' => '1', 'id_chuc_nang' => '49'],
            ['id' => '50', 'id_chuc_vu' => '1', 'id_chuc_nang' => '50'],
            ['id' => '51', 'id_chuc_vu' => '1', 'id_chuc_nang' => '51'],
            ['id' => '52', 'id_chuc_vu' => '1', 'id_chuc_nang' => '52'],
            ['id' => '53', 'id_chuc_vu' => '1', 'id_chuc_nang' => '53'],
            ['id' => '54', 'id_chuc_vu' => '1', 'id_chuc_nang' => '54'],
            ['id' => '55', 'id_chuc_vu' => '1', 'id_chuc_nang' => '55'],
            ['id' => '56', 'id_chuc_vu' => '1', 'id_chuc_nang' => '56'],
            ['id' => '57', 'id_chuc_vu' => '1', 'id_chuc_nang' => '57'],
            ['id' => '58', 'id_chuc_vu' => '1', 'id_chuc_nang' => '58'],
            ['id' => '59', 'id_chuc_vu' => '1', 'id_chuc_nang' => '59'],
            ['id' => '60', 'id_chuc_vu' => '1', 'id_chuc_nang' => '60'],
        ]);
    }
}
