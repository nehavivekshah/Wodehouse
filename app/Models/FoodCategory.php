<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoodCategory extends Model
{
    use HasFactory;
    
    protected $table = 'food_categories';
    
    protected $fillable = ['name','slug','status'];

    public function items()
    {
        return $this->hasMany(FoodItem::class, 'category_id');
    }
}
