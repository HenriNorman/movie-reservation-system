<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use illuminate\Validation\ValidationException;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\MovieResource;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //get all categories
        $categories = Category::all();

        return response()->json([
            'message' => 'categories fetched successfully',
            'status' => 1,
            'data' => CategoryResource::collection($categories)
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //create new category
        try{
            $validated = $request->validate([
                'name' => 'required|string|unique:categories|max:255',
                'description' => 'required|string'
            ]);
        }catch(ValidationException $e){
            return response()->json([
                'message' => 'validation error',
                'status' => 0,
                'data' => $e->errors()
            ], 400);
        }

        $category = Category::create([
            'name' => $validated['name'],
            'description' => $validated['description']
        ]);

        return response()->json([
            'message' => 'category created successfully',
            'status' => 1,
            'data' => $category
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //get one category using id
        $category = Category::find($id);

        if(!$category)
            return response([
                'message' => "category doesn't exist",
                'status' => 0
            ], 404);

        return response()->json([
            'message' => 'category fetched successfully',
            'status' => 1, 
            'data' => new CategoryResource($category)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //update one category
        $category = Category::find($id);
        
        if(!$category)
            return response([
        'message' => "category doesn't exist",
        'status' => 0
        ], 404);
        
        
        try{
            $validated = $request->validate([
                'name' => 'sometimes|string|max:255|unique:categories',
                'description' => 'sometimes|max:500'
                ]);
        }catch(ValidationException $e){
            return response()->json([
                'message' => 'validation error',
                'status' => 0,
                'data' => $e->errors()
            ], 400); 
        }
        
        $category->update($validated);

        return response()->json([
            'message' => 'category updated successfully',
            'status' => 1,
            'data' => new CategoryResource($category)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //delete a category
        $category = Category::find($id);

        if(!$category)
            return response()->json([
                'message' => "category doesn't exists",
                'status' => 0
                    ], 404);

        $categoryCopy = new Category();
        $categoryCopy->name = $category->name;
        $category->delete();

        return response()->json([
            'message' => 'category deleted successfully',
            'status' => 1,
            'data' => 'category '. $categoryCopy->name . ' has been successfully deleted'
        ]);
    }
    
    public function movies(string $id)
    {
        $category = Category::find($id);

        if(!$category)
            return response([
                'message' => "category doesn't exist",
                'status' => 0
            ], 404);

        $movies = $category->movies;

        return response()->json([
            'message' => 'movies fetched successfully',
            'status' => 1,
            'data' => MovieResource::collection($movies)
        ]);
    }
}
