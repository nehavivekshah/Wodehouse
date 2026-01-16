<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FoodOrderItem extends Model
{
    protected $fillable = [
        'food_order_id',
        'food_item_id',
        'qty',
        'price'
    ];

    public function foodItem()
    {
        return $this->belongsTo(Food::class, 'food_item_id');
    }

    public function order()
    {
        return $this->belongsTo(FoodOrder::class, 'food_order_id');
    }
}
