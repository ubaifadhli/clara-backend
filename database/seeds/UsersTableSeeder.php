<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::collection('users')->insert([
            [
                'full_name' => 'Fajar Septian Nugraha',
                'nrp' => "2110181042",
                'class' => '3 D4 IT B',
                'email' => 'fajarsn99@it.student.pens.ac.id',
                'password' => Hash::make('password'),
                'role' => 'Student'
            ],
            [
                'full_name' => 'Tri Harsono S.Si, M.Kom, Ph.D',
                'nip' => "196901071994031001",
                'email' => 'triharsono@pens.ac.id',
                'password' => Hash::make('password'),
                'role' => 'Lecturer'
            ]
        ]);
        // $users = factory('App\User', 50)->create();
    }
}
