<?php
namespace App;

use Jenssegers\Mongodb\Eloquent\Model;

class AssetReservation extends Model
{
    protected $collection = 'asset_reservations';
    protected $fillable = ['user','asset','amount'];
}