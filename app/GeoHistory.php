<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GeoHistory extends Model
{
    protected $table = 'geo_histories';

    protected $fillable = [
        'user_id', 'Latitude', 'longitude'
        ];
}
