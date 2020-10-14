<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoomsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::collection('rooms')->insert([
            ['name' => 'Lab Sistem Informasi', 'code' => 'C-102', 'image' => 'G-102.jpg', 'condition' => 'good'],
            ['name' => 'Lab Database', 'code' => 'C-105', 'image' => 'G-103.jpg', 'condition' => 'good'],
            ['name' => 'Lab Sistem Informasi Geografis', 'code' => 'C-203', 'image' => 'JJ-102.jpg', 'condition' => 'good'],
            ['name' => 'Lab Soft Computing', 'code' => 'C-206', 'image' => 'JJ-204.jpg', 'condition' => 'good'],
            ['name' => 'Lab Computer Vision', 'code' => 'C-303', 'image' => 'JJ-106.jpg', 'condition' => 'good'],
            ['name' => 'Lab Jaringan Komputer', 'code' => 'C-307', 'image' => 'JJ-109.jpg', 'condition' => 'good'],
        ]);
    }
}
