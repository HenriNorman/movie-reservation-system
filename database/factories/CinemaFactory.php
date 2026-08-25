<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Cinema;
use App\Models\Location;

class CinemaFactory extends Factory
{
    protected $model = Cinema::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->company() . ' Cinema',
            'rating' => $this->faker->numberBetween(1, 5),
            'location_id' => Location::factory(),
        ];
    }
}