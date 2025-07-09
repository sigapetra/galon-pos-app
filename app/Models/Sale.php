<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Sale extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'product_id',
        'quantity',
        'price_per_unit',
        'total_price',
        'customer_name',
        'customer_address',
        'payment_method',
    ];

    /**
     * Get the user who recorded the sale.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the product that was sold.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
