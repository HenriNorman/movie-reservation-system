<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Reservation;
use App\Models\Seat;
use App\Models\Showtime;
use App\Models\User;

class ReservationSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();
        $showtimes = Showtime::all();
        $statuses = ['pending', 'confirmed', 'cancelled', 'expired'];

        // Create 50 reservations
        for ($i = 0; $i < 50; $i++) {
            $showtime = $showtimes->random();
            $hallId = $showtime->hall_id;
            $seats = Seat::where('hall_id', $hallId)->inRandomOrder()->take(rand(1, 4))->get();

            $reservation = Reservation::create([
                'user_id' => $users->random()->id,
                'showtime_id' => $showtime->id,
                'status' => $statuses[array_rand($statuses)],
                'expires_at' => now()->addMinutes(15),
                'total_price' => $showtime->price * $seats->count(),
            ]);

            // Attach seats via pivot table
            $reservation->seats()->attach($seats->pluck('id'));
        }
    }
}