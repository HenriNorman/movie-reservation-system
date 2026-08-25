<?php

namespace Database\Factories;

use App\Models\showtime;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Movie;
use App\Models\Hall;

/**
 * @extends Factory<showtime>
 */
class ShowtimeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'start_time' => $this->faker->dateTimeBetween('+1 week', '+1 month'),
            'end_time' => $this->faker->dateTimeBetween('+1 month', '+2 months'),
            'price' => $this->faker->randomFloat(2, 5, 20), 
            'language' => $this->faker->randomElement(['original', 'dubbed', 'subbed']),
            'status' => $this->faker->randomElement(['scheduled', 'cancelled', 'completed']),
            'movie_id' => Movie::inRandomOrder()->first()?->id ?? Movie::factory(),
            'hall_id' => Hall::inRandomOrder()->first()?->id ?? Hall::factory(),
        ];
    }
}
