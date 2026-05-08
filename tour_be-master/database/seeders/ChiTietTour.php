<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ChiTietTour extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('chi_tiet_tours')->delete();

        DB::table('chi_tiet_tours')->truncate();

        DB::table('chi_tiet_tours')->insert([
            ['id_tour' => '1', 'id_dia_diem' => '139', 'thanh_tien' => '9050000'],
            ['id_tour' => '1', 'id_dia_diem' => '169', 'thanh_tien' => '6290000'],
            ['id_tour' => '1', 'id_dia_diem' => '136', 'thanh_tien' => '8790000'],
            ['id_tour' => '2', 'id_dia_diem' => '38', 'thanh_tien' => '7770000'],
            ['id_tour' => '2', 'id_dia_diem' => '105', 'thanh_tien' => '8888000'],
            ['id_tour' => '2', 'id_dia_diem' => '142', 'thanh_tien' => '6900000'],
            ['id_tour' => '3', 'id_dia_diem' => '177', 'thanh_tien' => '10790000'],
            ['id_tour' => '3', 'id_dia_diem' => '183', 'thanh_tien' => '12000000'],
            ['id_tour' => '3', 'id_dia_diem' => '7', 'thanh_tien' => '5000000'],
            ['id_tour' => '4', 'id_dia_diem' => '111', 'thanh_tien' => '5790000'],
            ['id_tour' => '4', 'id_dia_diem' => '93', 'thanh_tien' => '9050000'],
            ['id_tour' => '4', 'id_dia_diem' => '130', 'thanh_tien' => '6290000'],
            ['id_tour' => '5', 'id_dia_diem' => '164', 'thanh_tien' => '8790000'],
            ['id_tour' => '5', 'id_dia_diem' => '118', 'thanh_tien' => '7770000'],
            ['id_tour' => '5', 'id_dia_diem' => '73', 'thanh_tien' => '8888000'],
            ['id_tour' => '6', 'id_dia_diem' => '107', 'thanh_tien' => '6900000'],
            ['id_tour' => '6', 'id_dia_diem' => '100', 'thanh_tien' => '10790000'],
            ['id_tour' => '6', 'id_dia_diem' => '53', 'thanh_tien' => '12000000'],
            ['id_tour' => '7', 'id_dia_diem' => '95', 'thanh_tien' => '5000000'],
            ['id_tour' => '7', 'id_dia_diem' => '34', 'thanh_tien' => '5790000'],
            ['id_tour' => '7', 'id_dia_diem' => '41', 'thanh_tien' => '9050000'],
            ['id_tour' => '8', 'id_dia_diem' => '16', 'thanh_tien' => '6290000'],
            ['id_tour' => '8', 'id_dia_diem' => '71', 'thanh_tien' => '8790000'],
            ['id_tour' => '8', 'id_dia_diem' => '76', 'thanh_tien' => '7770000'],
            ['id_tour' => '9', 'id_dia_diem' => '48', 'thanh_tien' => '8888000'],
            ['id_tour' => '9', 'id_dia_diem' => '63', 'thanh_tien' => '6900000'],
            ['id_tour' => '9', 'id_dia_diem' => '97', 'thanh_tien' => '10790000'],
            ['id_tour' => '10', 'id_dia_diem' => '133', 'thanh_tien' => '12000000'],
            ['id_tour' => '10', 'id_dia_diem' => '145', 'thanh_tien' => '5000000'],
            ['id_tour' => '10', 'id_dia_diem' => '169', 'thanh_tien' => '5790000'],
        ]);
    }
}
