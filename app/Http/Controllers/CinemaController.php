<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cinema;
use App\Services\CinemaService;
use App\Http\Requests\CreateCinemaRequest;
use App\Http\Requests\UpdateCinemaRequest;
use illuminate\Validation\ValidationException;
use App\Http\Resources\CinemaResource;

class CinemaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //get all cinemas
        $cinemas = Cinema::with(['location'])->get();

        return response()->json([
            'message' => 'cinemas fetched successfully',
            'status' => 1,
            'data' => CinemaResource::collection($cinemas)
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    // CinemaController
    public function store(CreateCinemaRequest $request)
    {
        $cinema = Cinema::create($request->validated());
        return response()->json([
            'message' => 'Cinema created',
            'status' => 1,
            'data' => $cinema
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //show one cinema
        $cinema = Cinema::with(['location'])->find($id);
        if(!$cinema)
            return response()->json([
            'message' => "cinema doesn't exist",
            'status' => 0, 
            ], 400);
        
        return response()->json([
            'message' => 'cineam fetched successfully',
            'status' => 1,
            'data' => $cinema
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCinemaRequest $request, string $id)
    {
        //update a cinema, wether its halls, seats, location rename or cinema rename.
        $cinema = Cinema::find($id);

        if(!$cinema)
            return response()->json([
            'message' => "cinema doesn't exist",
            'status' => 0,
            ], 400);
            
        $cinema->update($request->validated());

        return response()->json([
            'message' => 'cineam updated successfully',
            'status' => 1,
            'data' => $cinema
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //delete a cinema
        $cinema = Cinema::find($id);

        if(!$cinema)
            return response()->json([
            'message' => "cinema doesn't exist",
            'status' => 0
            ], 400);

        $cinemaCopy = new Cinema();
        $cinemaCopy->name = $cinema->name;

        $cinema->delete();
        return response()->json([
            'message' => 'cinema deleted successfully',
            'status' => 1,
            'data' => $cinemaCopy->name . ' has been deleted successfully'
        ], 200);
    }
}
