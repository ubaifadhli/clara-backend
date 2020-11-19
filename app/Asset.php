<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model;

class Asset extends Model {
    protected $collection = 'assets';
    public $timestamps = false;

    protected $primaryKey = '_id';

    protected $fillable = [
        'name', 'image', 'quantity', 'available'
    ];

    protected $attributes = [
        'image' => 'no-image.png'
    ];
}
