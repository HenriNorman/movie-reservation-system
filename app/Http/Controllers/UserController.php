<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use illuminate\Validation\ValidationException;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //get all users
        $users = User::all();
        return response()->json($users);
    }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {
    //     //create a new user:
    //     $validated = $request->validate([
    //         'username' => 'required|string|max:255|unique:users',
    //         'email' => 'required|string|email|max:255|unique:users',
    //         'password' => 'required|string|min:8',
    //         'profile_picture' => 'sometimes|string'
    //     ]);

    //     $user = User::create([
    //         'username' => $validated['username'],
    //         'email' => $validated['email'],
    //         'password' => bcrypt($validated['password']),
    //     ]);

    //     return response()->json([
    //         'message' => 'User created successfully',
    //         'status' => 201,
    //         'data' => $user
    //     ], 201);
    // }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //get a specific user by id
        $user = User::find($id);
        if($user)
            return response()->json([
                'message' => 'User found',
                'status' => 200,
                'data' => $user
            ], 200);
        else
            return response()->json([
                'message' => 'User not found',
                'status' => 404,
                ], 404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //update a specific user by id
        $user = User::find($id);

        if(!$user)
            return response()->json([
                'message' => 'user not found',
                'status' => 0,
                'data' => null
                ], 404);
        try{
            $validated = $request->validate([
                'username' => 'sometimes|string|max:255|unique:users,username,' . $id,
                'email'    => 'sometimes|string|email|max:255|unique:users,email,' . $id,
                'password' => 'sometimes|min:8', 
            ]);
        }catch (ValidationException $e){
            return response()->json([
                'message' => 'validation failed',
                'status' => 0, 
                'errors' => $e->errors()
            ], 400);
        }

        if(isset($validated['password']))
            $validated['password'] = bcrypt($validated['password']);
        $user -> update($validated);
        
        return response()->json([
                'message' => 'user updated successfully',
                'status' => 1,
                'data' => $user
                ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $user = User::find($id);

        if(!$user)
            return response()->json([
                'message' => "user doesn't exists",
                'status' => 0
                    ], 404);

        $userCopy = new User();
        $userCopy->username = $user->username;
        $userCopy->email = $user->email;
        $user->delete();

        return response()->json([
            'message' => 'user deleted successfully',
            'status' => 1,
            'data' => 'user '. $userCopy->username .' with email ' . $userCopy->email . ' has been successfully deleted'
        ]);
    }
}
