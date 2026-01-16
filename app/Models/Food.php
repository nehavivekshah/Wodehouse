<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    
    protected $table = 'food';
    
    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }
}
