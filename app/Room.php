<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model;

class Room extends Model {
    protected $collection = 'rooms';

    protected $fillable = [
        'name', 'code', 'image', 'condition'
    ];
}

?>