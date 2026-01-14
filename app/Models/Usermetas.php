<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Usermetas extends Model
{
    protected $table = 'usermetas';

    protected $fillable = [
        'uid', 'company', 'address', 'city', 'pincode', 'state', 'country', 'status'
    ];

    // Relationship: UserMeta belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class, 'uid');
    }
}
