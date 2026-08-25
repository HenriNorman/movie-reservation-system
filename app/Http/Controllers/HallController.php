<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateHallRequest;
use App\Models\Hall;
use App\Models\Cinema;
use App\Services\HallService;
use \Illuminate\Validation\ValidationException;

class HallController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Cinema $cinema)
    {
        //return all halls within a cinema
        $hall = $cinema->halls;

        return response()->json([
            'message' => 'halls fetched successfully',
            'data' => $hall,
            'status' => 1
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateHallRequest $request, Cinema $cinema)
    {
        $hall = $cinema->halls()->create($request->validated()); 

        return response()->json([
            'message' => 'Hall created successfully',
            'data'    => $hall,
            'status'  => 1
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Cinema $cinema, Hall $hall){

        if(!$hall)
            return response()->json([
            'message' => 'Hall not found',
            'status' => 0
        ], 404);



        if($hall->cinema_id !== $cinema->id) {
            return response()->json([
                'message' => 'Hall not found',
                'status' => 0
            ], 404);
        }

        return response()->json([
            'message' => 'Hall fetched successfully',
            'data' => $hall,
            'status' => 1
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Hall $hall)
    {
        try{
            $validated = $request->validate([
                'number' => 'sometimes|integer|min:1|unique:halls,number,' . $hall->id . ',id,cinema_id,' . $hall->cinema_id,
                'name' => 'sometimes|string|max:255|unique:halls,name,' . $hall->id . ',id,cinema_id,' . $hall->cinema_id,
                'is_vip' => 'sometimes|boolean',
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->errors(),
                'status' => 0
            ], 422);
        }

        $hall->update($validated);

        return response()->json([
            'message' => 'Hall updated successfully',
            'data' => $hall,
            'status' => 1
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cinema $cinema, Hall $hall)
    {

        $hallCopy = $hall;
        $hall->delete();

        return response()->json([
            'message' => 'Hall deleted successfully',
            'data' => $hallCopy,
            'status' => 1
        ], 200);
    }
}
