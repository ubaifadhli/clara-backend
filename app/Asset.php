<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model;

class Asset extends Model {
    protected $collection = 'assets';
    public $timestamps = false;

    protected $fillable = [
        'name', 'image', 'quantity'
    ];
}
