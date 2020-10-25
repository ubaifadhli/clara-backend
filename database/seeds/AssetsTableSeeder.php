<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AssetsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::collection('assets')->insert([
            ['name' => 'Lab Sistem Informasi', 'type' => 'room', 'image' => 'G-102.jpg'],
            ['name' => 'Lab Database', 'type' => 'room', 'image' => 'G-103.jpg'],
            ['name' => 'Lab Sistem Informasi Geografis', 'type' => 'room', 'image' => 'JJ-102.jpg'],
            ['name' => 'Lab Soft Computing', 'type' => 'room', 'image' => 'JJ-204.jpg'],
            ['name' => 'Lab Computer Vision', 'type' => 'room', 'image' => 'JJ-106.jpg'],
            ['name' => 'Lab Jaringan Komputer', 'type' => 'room', 'image' => 'JJ-109.jpg'],
            ['name' => 'Cisco Router', 'type' => 'item', 'image' => 'cisco-router.jpg', 'quantity' => 15],
            ['name' => 'Mikrotik Router', 'type' => 'item', 'image' => 'mikrotik-router.jpg', 'quantity' => 30],
            ['name' => 'GPS Tracker', 'type' => 'item', 'image' => 'gps-tracker.jpg', 'quantity' => 40],
            ['name' => 'Handheld GPS', 'type' => 'item', 'image' => 'handheld-gps.jpg', 'quantity' => 40],
            ['name' => 'Digitizer', 'type' => 'item', 'image' => 'digitizer.jpg', 'quantity' => 10],
            ['name' => 'LCD Proyektor', 'type' => 'item', 'image' => 'lcd-proyektor.jpg', 'quantity' => 5],
            ['name' => 'Proyektor', 'type' => 'item', 'image' => 'proyektor.jpg', 'quantity' => 10],
        ]);
    }
}
