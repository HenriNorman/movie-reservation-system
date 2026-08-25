<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Hall;
use App\Models\Cinema;

class HallFactory extends Factory
{
    protected $model = Hall::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->word() . ' Hall',
            'number' => $this->faker->unique()->numberBetween(1, 10),
            'is_vip' => $this->faker->boolean(20), // 20% chance of being VIP
            'cinema_id' => Cinema::factory(),
        ];
    }
}