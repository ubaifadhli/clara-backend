<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model;

class RoomReservation extends Model
{
    protected $collections = 'room_reservations';

    protected $fillable =[
        'user_id', 'room_id', 'available_qty', 
        'reservation_date', 'reservation_qty', 
        'reservation_status'
    ];
}
