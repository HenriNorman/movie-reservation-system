<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Location;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //get all locations
        $locations = Location::all();

        return response()->json([
            'message' => 'Locations fetched successfully',
            'data'    => $locations,
            'status'  => 1
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //add new location

        try{
        $validated = $request->validate([
            'street' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
        ]);
        }catch(\Illuminate\Validation\ValidationException $e){
            return response()->json([
                'message' => 'Validation failed.',
                'errors' => $e->errors(),
                'status' => 0
            ], 422);
        }


        $location = Location::create([
            'street' => $validated['street'],
            'city' => $validated['city'],
            'state' => $validated['state']
        ]);

        return response()->json([
            'message' => 'Location created successfully',
            'data'    => $location,
            'status'  => 1
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Location $location)
    {
        //get one location
        return response()->json([
            'message' => 'Location fetched successfully',
            'data'    => $location,
            'status'  => 1
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //update one location
        $location = Location::findOrFail($id);

        if(!$location){
            return response()->json([
                'message' => 'Location not found',
                'status' => 0
            ], 404);
        }

        try{
            $validated = $request->validate([
                'street' => 'sometimes|string|max:255',
                'city' => 'sometimes|string|max:255',
                'state' => 'sometimes|string|max:255',
            ]);

            $location->update($validated);
        }catch(\Illuminate\Validation\ValidationException $e){
            return response()->json([
                'message' => 'Validation failed.',
                'errors' => $e->errors(),
                'status' => 0
            ], 422);
        }

        if(!isset($validated['street']) && !isset($validated['city']) && !isset($validated['state'])){
            return response()->json([
                'message' => 'No valid data provided for update.',
                'status' => 0
            ], 422);
        }

        $location->update($validated);

        return response()->json([
            'message' => 'Location updated successfully',
            'data'    => $location,
            'status'  => 1
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Location $location)
    {
        //remove one location
        $location->delete();

        return response()->json([
            'message' => 'Location deleted successfully',
            'data'    => $location,
            'status'  => 1
        ], 200);
    }
}
