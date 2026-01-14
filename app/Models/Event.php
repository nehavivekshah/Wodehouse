<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slog',
        'category',
        'event_date',
        'time',
        'venue',
        'duration',
        'content',
        'image',
        'status'
    ];

    public function registrations()
    {
        return $this->hasMany(EventRegistration::class);
    }

    protected $casts = [
        'event_date' => 'date',
    ];

    public function getIsPastAttribute()
    {
        return $this->event_date->isPast();
    }

    public function getIsFullAttribute()
    {
        if (is_null($this->capacity)) {
            return false;
        }
        return $this->registrations()->count() >= $this->capacity;
    }

    public function getRemainingSpotsAttribute()
    {
        if (is_null($this->capacity)) {
            return 999;
        }
        return max(0, $this->capacity - $this->registrations()->count());
    }
}
