<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Seat;
use App\Models\Hall;

class SeatFactory extends Factory
{
    protected $model = Seat::class;

    public function definition(): array
    {
        return [
            'row' => $this->faker->numberBetween(1, 10),
            'number' => $this->faker->numberBetween(1, 15),
            'is_vip' => $this->faker->boolean(10), // 10% chance of being VIP
            'hall_id' => Hall::factory(),
        ];
    }
}