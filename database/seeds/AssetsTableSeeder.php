<?php

use Carbon\Carbon;
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
            ['name' => 'Cisco Router', 'image' => 'cisco-router.jpg', 'quantity' => 15, 'available' =>15],
            ['name' => 'Mikrotik Router', 'image' => 'mikrotik-router.jpg', 'quantity' => 30, 'available' => 30],
            ['name' => 'GPS Tracker', 'image' => 'gps-tracker.jpg', 'quantity' => 40, 'available' => 40],
            ['name' => 'Handheld GPS', 'image' => 'handheld-gps.jpg', 'quantity' => 40, 'available' => 40],
            ['name' => 'Digitizer', 'image' => 'digitizer.jpg', 'quantity' => 10, 'available' => 10],
            ['name' => 'LCD Proyektor', 'image' => 'lcd-proyektor.jpg', 'quantity' => 5, 'available' => 5],
            ['name' => 'Proyektor', 'image' => 'proyektor.jpg', 'quantity' => 10, 'available' => 10],
            ['name' => 'Bola Basket', 'image' => 'Ball-basket.jpg', 'quantity' => 10, 'available' => 10],
            ['name' => 'Bola Sepak', 'image' => 'Ball-soccer.jpg', 'quantity' => 10, 'available' => 10],
            ['name' => 'Bola Voli', 'image' => 'Ball-volley.jpg', 'quantity' => 10, 'available' => 10],
            ['name' => 'Kursi', 'image' => 'Chair.jpg', 'quantity' => 500, 'available' => 500],
            ['name' => 'Handy Talkie', 'image' => 'HT.jpg', 'quantity' => 30, 'available' => 30],
            ['name' => 'Mikrofon', 'image' => 'Microphone.jpg', 'quantity' => 10, 'available' => 10],
            ['name' => 'Jaring Voli', 'image' => 'Net-Volley.jpg', 'quantity' => 2, 'available' => 2],
            ['name' => 'Speaker', 'image' => 'Speaker.jpg', 'quantity' => 5, 'available' => 5],
            ['name' => 'Meja', 'image' => 'Table.jpg', 'quantity' => 250, 'available' => 250],
            ['name' => 'Tandu', 'image' => 'Tandu.png', 'quantity' => 20, 'available' => 20],
            ['name' => 'Kabel VGA', 'image' => 'VGA-cable.jpg', 'quantity' => 10, 'available' => 10],
        ]);
    }
}
