<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'distance_km',
        'gallon_type',
        'price_per_gallon',
        'default_vehicle_id',
        'phone',
    ];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'default_vehicle_id');
    }
}
