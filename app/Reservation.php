<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model;

class Reservation extends Model {
    protected $collection = 'reservations';
    public $timestamps = false;

    protected $primaryKey = '_id';

    protected $fillable = [
        'description', 'begin', 'end', 'user', 'asset', 'status', 'history'
    ];

    public function user() {
        return $this->embedsOne(User::class);
    }

    public function asset() {
        return $this->embedsOne(Asset::class);
    }

    public function history(){
        return $this->embedsMany(History::class);
    }

    protected $attributes = [
        'status' => 'Waiting on approval'
    ];
}
