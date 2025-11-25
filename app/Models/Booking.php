<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_number',
        'client_name',
        'client_email',
        'client_phone',
        'service_id',
        'event_date',
        'location',
        'notes',
        'booking_status',
    ];

    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }
}

