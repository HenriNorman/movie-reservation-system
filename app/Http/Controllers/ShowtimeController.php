<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Showtime;
use Illuminate\Validation\ValidationException;
use App\Http\Resources\ShowtimeResource;

class ShowtimeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //get all showtimes
        $showtimes = Showtime::with('movie', 'hall.cinema')->get();
        return response()->json([
            'message' => 'Showtimes retrieved successfully',
            'status' => 1,
            'data' => ShowtimeResource::collection($showtimes)
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //New showtime
        try{
        $validated = $request->validate([
            'movie_id' => 'required|exists:movies,id',
            'hall_id' => 'required|exists:halls,id',
            'start_time' => 'required|date_format:Y-m-d H:i:s',
            'end_time' => 'required|date_format:Y-m-d H:i:s|after:start_time',
            'price' => 'required|numeric|min:0',
            'language' => 'required|in:original,dubbed,subbed',
            'status' => 'required|in:completed,cancelled,scheduled',
        ]);
        }catch(ValidationException $e){
            return response()->json([
                'message' => 'Validation failed',
                'status' => 0,
                'errors' => $e->errors()
            ], 422);
        }

        $showtime = Showtime::create($validated);

        return response()->json([
            'message' => 'Showtime created successfully',
            'status' => 1,
            'data' => $showtime
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //get one showtime

        $showtime = Showtime::with('movie', 'hall.cinema')->find($id);

        if(!$showtime){
            return response()->json([
                'message' => 'Showtime not found',
                'status' => 0
            ], 404);
        }

        return response()->json([
            'message' => 'Showtime retrieved successfully',
            'status' => 1,
            'data' => new ShowtimeResource($showtime)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //update one showtime
        $showtime = Showtime::find($id);

        if(!$showtime){
            return response()->json([
                'message' => 'Showtime not found',
                'status' => 0
            ], 404);
        }

        try{
        $validated = $request->validate([
            'movie_id' => 'sometimes|exists:movies,id',
            'hall_id' => 'sometimes|exists:halls,id',
            'start_time' => 'sometimes|date_format:Y-m-d H:i:s',
            'end_time' => 'sometimes|date_format:Y-m-d H:i:s|after:start_time',
            'price' => 'sometimes|numeric|min:0',
            'language' => 'sometimes|in:original,dubbed,subbed',
            'status' => 'sometimes|in:completed,cancelled,scheduled',
        ]);
        }catch(ValidationException $e){
            return response()->json([
                'message' => 'Validation failed',
                'status' => 0,
                'errors' => $e->errors()
            ], 422);
        }

        $showtime->update($validated);

        return response()->json([
            'message' => 'Showtime updated successfully',
            'status' => 1,
            'data' => $showtime
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //delete a showtime

        $showtime = Showtime::find($id);

        if(!$showtime){
            return response()->json([
                'message' => 'Showtime not found',
                'status' => 0
            ], 404);
        }

        $showtime->delete();

        return response()->json([
            'message' => 'Showtime deleted successfully',
            'data' => $showtime,
            'status' => 1
        ]);
    }
}
