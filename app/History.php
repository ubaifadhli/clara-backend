<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model;

class History extends Model {

    public $timestamps = false;

    protected $fillable = [
        'datetime', 'status'
    ];

    protected $attributes = [
        'status' => 'Waiting on approval'
    ];
}
