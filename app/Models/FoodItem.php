<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoodItem extends Model
{
    protected $fillable = ['category_id','name','description','price','image','status'];

    public function category()
    {
        return $this->belongsTo(FoodCategory::class);
    }
}
