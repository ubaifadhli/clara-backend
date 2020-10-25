<?php

namespace App\Http\Controllers;
use App\AssetReservation;
class AssetReservationController extends Controller
{
    
    public function create_dummy()
    {
        $reservation = new AssetReservation;
        $reservation->test = 'test2';
        $reservation->save();
        return $reservation;
    }
    
    

}