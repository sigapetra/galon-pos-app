<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
        'date',
        'customer_id',
        'vehicle_id',
        'quantity',
        'total_revenue',
        'total_cost',
        'fuel_cost',
        'toll_fee',
        'profit',
        'note'
    ];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    public function product()
    {
        return $this->belongsTo(\App\Models\Product::class);
    }

    public function customer()
    {
        return $this->belongsTo(\App\Models\Customer::class);
    }

    public function vehicle()
    {
        return $this->belongsTo(\App\Models\Vehicle::class);
    }
}
