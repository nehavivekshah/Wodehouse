<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    
    protected $table = 'food_items';
    
    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }
}
