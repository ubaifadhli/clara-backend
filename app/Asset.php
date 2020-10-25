<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model;

class Asset extends Model {
    protected $collection = 'assets';

    protected $fillable = [
        'name', 'type', 'image', 'quantity'
    ];
}

?>
