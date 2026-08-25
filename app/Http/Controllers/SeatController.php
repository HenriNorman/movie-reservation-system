<?php
namespace App\Http\Controllers;

use App\Http\Requests\UpdateSeatRequest;
use App\Models\Hall;
use App\Models\Seat;
use App\Http\Resources\SeatResource;
use App\Http\Requests\CreateSeatRequest;
use App\Http\Requests\CreateBulkSeatsRequest;

class SeatController extends Controller
{
    public function index(Hall $hall)
    {
        return response()->json([
            'message' => 'Seats fetched successfully',
            'data'    => SeatResource::collection($hall->seats),
            'status'  => 1
        ], 200);
    }

    public function show(Hall $hall, Seat $seat)
    {
        return response()->json([
            'message' => 'Seat fetched successfully',
            'data'    => $seat,
            'status'  => 1
        ], 200);
    }


    public function store(CreateSeatRequest $request, Hall $hall)
    {
        $seat = $hall->seats()->create($request->validated());
        
        return response()->json([
            'message' => 'Seat created successfully',
            'data'    => $seat,
            'status'  => 1
        ], 201);
    }

    public function bulkStore(CreateBulkSeatsRequest $request, Hall $hall)
    {
        $seats = array_map(fn($seat) => [
            'hall_id'    => $hall->id,
            'row'        => $seat['row'],
            'number'     => $seat['number'],
            'is_vip'     => $seat['is_vip'] ?? false,
            'created_at' => now(),
            'updated_at' => now(),
        ], $request->validated()['seats']);

        Seat::insert($seats);

        return response()->json([
            'message' => 'Seats created successfully',
            'status'  => 1
        ], 201);
    }

    public function update(UpdateSeatRequest $request, Hall $hall, Seat $seat)
    {
        
        $seat->update($request->validated());

        return response()->json([
            'message' => 'Seat updated successfully',
            'data'    => $seat,
            'status'  => 1
        ], 200);
    }

    public function destroy(Hall $hall, Seat $seat)
    {
        
        $seat->delete();

        return response()->json([
            'message' => 'Seat deleted successfully',
            'data'    => $seat,
            'status'  => 1
        ], 200);
    }
}