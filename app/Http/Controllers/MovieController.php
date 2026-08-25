<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Http\Resources\MovieResource;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //get all movies
        $movies = Movie::with('categories', 'showtimes.hall.cinema')->get();

        return response()->json([
            'message' => 'Movies fetched successfully',
            'data'    => MovieResource::collection($movies),
            'status'  => 1
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //add new movie

        try{
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'poster_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        }catch(\Illuminate\Validation\ValidationException $e){
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->errors(),
                'status' => 0
            ], 422);
        }

            $validated['poster_image'] = $request->file('poster_image')->store('movie_posters', 'public');

        $movie = Movie::create($validated);

        return response()->json([
            'message' => 'Movie created successfully',
            'data'    => $movie,
            'status'  => 1
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $movie = Movie::with('categories', 'showtimes.hall.cinema')->find($id);

        if(!$movie){
            return response()->json([
                'message' => 'Movie not found',
                'status' => 0
            ], 404);
        }

        return response()->json([
            'message' => 'Movie fetched successfully',
            'data'    => MovieResource::make($movie),
            'status'  => 1
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $movie = Movie::findOrFail($id);

        if(!$movie){
            return response()->json([
                'message' => 'Movie not found',
                'status' => 0
            ], 404);
        }
        try{
        $validated = $request->validate([
            'title' => 'sometimes|string|max:255',
            'description' => 'sometimes|string',
            'poster_image' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        }catch(\Illuminate\Validation\ValidationException $e){
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->errors(),
                'status' => 0
            ], 422);
        }

        if ($request->hasFile('poster_image')) {
            
            $validated['poster_image'] = $request->file('poster_image')->store('movie_posters', 'public');
        }

        if(!isset($validated['title']) && !isset($validated['description']) && !isset($validated['poster_image'])){
            return response()->json([
                'message' => 'No data provided for update',
                'status' => 0
            ], 400);
        }
        $movie->update($validated);

        return response()->json([
            'message' => 'Movie updated successfully',
            'data'    => $movie,
            'status'  => 1
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $movie = Movie::findOrFail($id);

        if(!$movie){
            return response()->json([
                'message' => 'Movie not found',
                'status' => 0
            ], 404);
        }

        $movie->delete();

        return response()->json([
            'message' => 'Movie deleted successfully',
            'data'    => $movie,
            'status'  => 1
        ], 200);
    }

    public function categories(string $id)
    {
        $movie = Movie::find($id);

        if(!$movie)
            return response([
                'message' => "movie doesn't exist",
                'status' => 0
            ], 404);

        $categories = $movie->categories;

        return response()->json([
            'message' => 'categories fetched successfully',
            'status' => 1,
            'data' => CategoryResource::collection($categories)
        ]);
    }

    public function addCategory(Request $request, string $id)
    {
        $movie = Movie::findOrFail($id);

        if(!$movie){
            return response()->json([
                'message' => 'Movie not found',
                'status' => 0
            ], 404);
        }

        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id'
        ]);

        $movie->categories()->attach($validated['category_id']);

        return response()->json([
            'message' => 'Category added to movie successfully',
            'status' => 1
        ], 200);
    }

    // In MovieController
    public function removeCategory(Movie $movie, Category $category)
{
    // Check if relationship exists before detaching
    if (!$movie->categories()->where('category_id', $category->id)->exists()) {
        return response()->json([
            'message' => 'category not found',
            'status' => 0
        ], 404);
    }

    $movie->categories()->detach($category->id);
    
    return response()->json([
        'message' => 'Category removed successfully',
        'status' => 1
    ]);
}
}
