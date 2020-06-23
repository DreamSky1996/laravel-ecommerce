<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customers';
    protected $fillable = [
        'firstName', 'lastName', 'email', 'Address', 'City', 'Province', 'PostalCode', 'Phone','shipping_Address', 'shipping_City', 'shipping_Province', 'shipping_PostalCode',
    ];

    public function orders() {
        return $this->hasMany(Order::class);
    }
}
