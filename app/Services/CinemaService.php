<?php 

namespace App\Services;
use Illuminate\Support\Facades\DB;
use App\Models\Cinema;
use App\Models\Hall;
use App\Models\Location;
use App\Models\Seat;

class CinemaService
{
    public function createWithHallsAndSeats(array $data): Cinema
    {
        return DB::transaction(function () use ($data) {
            $loaction = Location::create($data['location']);
            $cinema = Cinema::create([
                'name' => $data['name'],
                'rating' => $data['rating'],
                'location_id' => $loaction->id
            ]);

            foreach($data['halls'] as $hallData){
                $hall = $this->createHall($cinema, $hallData);
                $this->createSeats($hall, $hallData['seats']);
            }

            return $cinema->load('halls.seats');
        });
    }

    private function createHall(Cinema $cinema, array $data): Hall
    {
    return $cinema->halls()->create(
        collect($data)->except('seats')->toArray()
    );
    }

    private function createSeats(Hall $hall, array $seatsData): void
    {
        $seats = array_map(fn($seat) => [
            'hall_id' => $hall->id,
            ...$seat
        ], $seatsData);

        Seat::insert($seats); // bulk insert, much faster than looping
    }
    

}