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
            ['name' => 'Cisco Router', 'type' => 'item', 'image' => 'cisco-router.jpg', 'quantity' => 15],
            ['name' => 'Mikrotik Router', 'type' => 'item', 'image' => 'mikrotik-router.jpg', 'quantity' => 30],
            ['name' => 'GPS Tracker', 'type' => 'item', 'image' => 'gps-tracker.jpg', 'quantity' => 40],
            ['name' => 'Handheld GPS', 'type' => 'item', 'image' => 'handheld-gps.jpg', 'quantity' => 40],
            ['name' => 'Digitizer', 'type' => 'item', 'image' => 'digitizer.jpg', 'quantity' => 10],
            ['name' => 'LCD Proyektor', 'type' => 'item', 'image' => 'lcd-proyektor.jpg', 'quantity' => 5],
            ['name' => 'Proyektor', 'type' => 'item', 'image' => 'proyektor.jpg', 'quantity' => 10],
            ['name' => 'Bola Basket', 'type' => 'item', 'image' => 'Ball-basket.jpg', 'quantity' => 10],
            ['name' => 'Bola Sepak', 'type' => 'item', 'image' => 'Ball-soccer.jpg', 'quantity' => 10],
            ['name' => 'Bola Voli', 'type' => 'item', 'image' => 'Ball-volley.jpg', 'quantity' => 10],
            ['name' => 'Kursi', 'type' => 'item', 'image' => 'Chair.jpg', 'quantity' => 500],
            ['name' => 'Handy Talkie', 'type' => 'item', 'image' => 'HT.jpg', 'quantity' => 30],
            ['name' => 'Mikrofon', 'type' => 'item', 'image' => 'Microphone.jpg', 'quantity' => 10],
            ['name' => 'Jaring Voli', 'type' => 'item', 'image' => 'Net-Volley.jpg', 'quantity' => 2],
            ['name' => 'Speaker', 'type' => 'item', 'image' => 'Speaker.jpg', 'quantity' => 5],
            ['name' => 'Meja', 'type' => 'item', 'image' => 'Table.jpg', 'quantity' => 250],
            ['name' => 'Tandu', 'type' => 'item', 'image' => 'Tandu.png', 'quantity' => 20],
            ['name' => 'Kabel VGA', 'type' => 'item', 'image' => 'VGA-cable.jpg', 'quantity' => 10],
            ['name' => 'Lab Sistem Informasi', 'type' => 'room', 'image' => 'G-102.jpg'],
            ['name' => 'Lab Database', 'type' => 'room', 'image' => 'G-103.jpg'],
            ['name' => 'Lab Sistem Informasi Geografis', 'type' => 'room', 'image' => 'JJ-102.jpg'],
            ['name' => 'Lab Soft Computing', 'type' => 'room', 'image' => 'JJ-204.jpg'],
            ['name' => 'Lab Computer Vision', 'type' => 'room', 'image' => 'JJ-106.jpg'],
            ['name' => 'Lab Jaringan Komputer', 'type' => 'room', 'image' => 'JJ-109.jpg'],
            ['name' => 'Lapangan Badminton', 'type' => 'room', 'image' => 'Badminton-court.jpg'],
            ['name' => 'Lapangan Basket', 'type' => 'room', 'image' => 'Basketball-court.jpg'],
            ['name' => 'Kantin', 'type' => 'room', 'image' => 'Canteen.jpg'],
            ['name' => 'Taman Kampus', 'type' => 'room', 'image' => 'College-Park.jpg'],
            ['name' => 'Lapangan Basket', 'type' => 'room', 'image' => 'Basketball-court.jpg'],
            ['name' => 'Lab Perangkat Komputer', 'type' => 'room', 'image' => 'Computer-lab.jpg'],
            ['name' => 'Kelas Eksklusif', 'type' => 'room', 'image' => 'Exclusive-classroom.jpg'],
            ['name' => 'Lapangan Futsal', 'type' => 'room', 'image' => 'Futsal-court.jpg'],
            ['name' => 'Hall Pascasarjana', 'type' => 'room', 'image' => 'Basketball-court.png'],
            ['name' => 'Perpustakaan D3', 'type' => 'room', 'image' => 'Library.jpg'],
            ['name' => 'Perpustakaan D4', 'type' => 'room', 'image' => 'Library.jpg'],
            ['name' => 'Perpustakaan S2', 'type' => 'room', 'image' => 'Library.jpg'],
            ['name' => 'Masjid Nurul Huda', 'type' => 'room', 'image' => 'Masjid.jpg'],
            ['name' => 'Studio Musik', 'type' => 'room', 'image' => 'Music-studio.jpg'],
            ['name' => 'Lab Project Akhir', 'type' => 'room', 'image' => 'Regular-classroom.png'],
            ['name' => 'Lapangan Voli', 'type' => 'room', 'image' => 'Volleyball-court.jpg'],
            ['name' => 'Teater D3', 'type' => 'room', 'image' => 'Theatre.jpg'],
            ['name' => 'Kolam Renang', 'type' => 'room', 'image' => 'Swimming-pool.jpg'],
        ]);
    }
}
