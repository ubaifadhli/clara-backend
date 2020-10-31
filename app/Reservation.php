<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model;

class Reservation extends Model {
    protected $collection = 'reservations';

    protected $fillable = [
        'description', 'quantity', 'asset', 'user', 'status', 'datetime'
    ];


}
