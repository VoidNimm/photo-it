<?php

namespace App\Models;

use App\Concerns\LogsActivity;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pricing extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'name',
        'price',
        'description',
        'service_id',
    ];

    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }
}
