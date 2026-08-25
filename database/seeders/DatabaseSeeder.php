<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cinema;
use App\Models\Hall;
use App\Models\Seat;
use App\Models\User;
use App\Models\Category;
use App\Models\Movie;
use App\Models\Showtime;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->count(50)->create();
        $categories = Category::factory()->count(10)->create();
        $movies = Movie::factory()->count(20)->create();

        $movies->each(function($movie) use ($categories) {
            $movie->categories()->attach($categories->random(3));
        });

        // Create 10 cinemas
        $cinemas = Cinema::factory()->count(10)->create();
        
        // For each cinema
        foreach ($cinemas as $cinema) {
            // Create 5 halls with SPECIFIC numbers (1,2,3,4,5)
            for ($hallNumber = 1; $hallNumber <= 5; $hallNumber++) {
                
                $hall = Hall::create([
                    'name' => 'Hall ' . $hallNumber,
                    'number' => $hallNumber,  // ← Manually set: 1, then 2, then 3, etc.
                    'is_vip' => ($hallNumber == 1), // Only hall #1 is VIP
                    'cinema_id' => $cinema->id,
                ]);
                
                // Create 50 seats for this hall
                for ($seatCount = 1; $seatCount <= 50; $seatCount++) {
                    Seat::create([
                        'hall_id' => $hall->id,
                        'row' => rand(1, 8),
                        'number' => $seatCount,
                        'is_vip' => false,
                    ]);
                }
            }
        }

        $show_time = Showtime::factory()->count(50)->recycle($movies)->
        recycle(Hall::all())->
        create();

        $this->call([ReservationSeeder::class]);
    }
}
                    
                    