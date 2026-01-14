<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }
}
