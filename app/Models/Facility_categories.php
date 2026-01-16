<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facility_categories extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'slog', 'parent_id', 'status'];

    public function parent()
    {
        return $this->belongsTo(Facility_categories::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Facility_categories::class, 'parent_id');
    }
}
