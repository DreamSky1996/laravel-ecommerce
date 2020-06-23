<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    protected $fillable = [
        'order_number', 'customer_id', 'status', 'grand_total', 'item_count', 'first_name', 'last_name',
        'address', 'city', 'province', 'post_code', 'phone_number', 'notes'
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
