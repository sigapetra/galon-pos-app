<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SaleFactory extends Factory
{
    protected $model = \App\Models\Sale::class;

    public function definition()
    {
        return [
            'customer_name' => $this->faker->name,
            'gallons_sold' => $this->faker->numberBetween(1, 20),
            'price_per_gallon' => $this->faker->randomFloat(2, 10000, 20000),
            'vehicle_id' => \App\Models\Vehicle::factory(),
            'distance_km' => $this->faker->numberBetween(1, 50),
        ];
    }
}