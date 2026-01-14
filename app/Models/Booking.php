<?php
// App/Models/Booking.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = ['user_id', 'facility_id', 'booking_date', 'slot_time', 'amount', 'status'];
    public function facility() { return $this->belongsTo(Facilities::class, 'facility_id'); }
    public function user() { return $this->belongsTo(User::class, 'user_id'); }
}