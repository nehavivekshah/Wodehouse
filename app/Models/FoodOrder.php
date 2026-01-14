<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoodOrder extends Model
{
    protected $fillable = ['user_id', 'total', 'status', 'payment_status', 'payment_method'];

    public function items()
    {
        return $this->hasMany(FoodOrderItem::class);
    }
}
