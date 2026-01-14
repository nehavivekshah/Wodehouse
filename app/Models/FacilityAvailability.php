<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FacilityAvailability extends Model
{
    use HasFactory;

    protected $table = 'facility_availabilities'; // Ensure this matches your DB table name case

    protected $fillable = [
        'facility_id',
        'day_of_week',
        'start_time',
        'end_time',
        'slot_duration',
    ];

    // Renamed to singular 'facility'
    public function facility()
    {
        return $this->belongsTo(Facilities::class, 'facility_id');
    }
    
    // Accessor for day name
    public function getDayNameAttribute()
    {
        return [
            'Sunday','Monday','Tuesday','Wednesday',
            'Thursday','Friday','Saturday'
        ][$this->day_of_week] ?? 'Unknown';
    }
}