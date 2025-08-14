<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class VehicleFactory extends Factory
{
    protected $model = \App\Models\Vehicle::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'capacity' => $this->faker->numberBetween(1, 10),
            'fuel_efficiency' => $this->faker->randomFloat(2, 5, 50),
            'fuel_price' => $this->faker->randomFloat(2, 5000, 20000),
            'default_toll_fee' => $this->faker->randomFloat(2, 0, 5000),
            'type' => $this->faker->randomElement(['Car', 'Motorcycle', 'Truck']),
        ];
    }
}
