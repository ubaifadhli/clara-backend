<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model;

class Reservation extends Model {
    protected $collection = 'reservations';
    public $timestamps = false;

    protected $guarded = [];

    public function user() {
        return $this->embedsOne(User::class);
    }

    public function asset() {
        return $this->embedsOne(Asset::class);
    }

    public function history(){
        return $this->embedsMany(History::class);
    }
}
