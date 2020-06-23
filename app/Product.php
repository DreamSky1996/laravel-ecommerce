<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $fillable = [
        'product_name', 'main_image', 'price','inventory', 'user_id', 'geofence', 'product_category',
    ];


}
