<?php

namespace app\Http\Controllers;

use App\RoomReservation;

class RoomReservationController extends Controller
{
    public function create_dummy()
    {
        $reservation = new RoomReservation();
        $reservation->test = 'Test';
        $reservation->save();
        return $reservation;
    }
}