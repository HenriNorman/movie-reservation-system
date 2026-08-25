<?php
namespace App\Services;

use App\Models\Hall;
use App\Models\Seat;
use Illuminate\Support\Facades\DB;

class HallService
{
    public function createHall(array $data, $cinema): Hall
    {
        return DB::transaction(function () use ($data, $cinema) {
            $hall = $cinema->halls()->create(
                collect($data)->except('seats')->toArray()
            );

            $seats = array_map(fn($seat) => [
                'hall_id'    => $hall->id,
                'row'        => $seat['row'],
                'number'     => $seat['number'],
                'is_vip'     => $seat['is_vip'] ?? false,
                'created_at' => now(),
                'updated_at' => now(),
            ], $data['seats']);

            Seat::insert($seats);

            return $hall->load('seats');
        });
    }
}