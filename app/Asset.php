<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model;

class Asset extends Model
{

    protected $collection = 'assets';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'asset_id', 'asset_name', 'quantity', 'condition', 'picture'
    ];

}
