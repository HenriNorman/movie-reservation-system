<?php
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CinemaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HallController;
use App\Http\Controllers\SeatController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\ShowtimeController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryMovieController;

// public routes
Route::post('v1/register', [AuthController::class, 'register']);
Route::post('v1/login', [AuthController::class, 'login']);

Route::middleware('auth:api')->group(function () {

    // auth routes
    Route::post('v1/logout', [AuthController::class, 'logout']);
    Route::post('v1/refresh', [AuthController::class, 'refresh']);
    Route::get('v1/me', [AuthController::class, 'me']);

    Route::prefix('v1')->group(function () {

        // read only — all authenticated users
        Route::get('users', [UserController::class, 'index']);
        Route::get('users/{user}', [UserController::class, 'show']);
        Route::get('cinemas', [CinemaController::class, 'index']);
        Route::get('cinemas/{cinema}', [CinemaController::class, 'show']);
        Route::get('cinemas/{cinema}/halls', [HallController::class, 'index']);
        Route::get('cinemas/{cinema}/halls/{hall}', [HallController::class, 'show']);
        Route::get('halls/{hall}/seats', [SeatController::class, 'index']);
        Route::get('seats/{seat}', [SeatController::class, 'show']);
        Route::get('movies', [MovieController::class, 'index']);
        Route::get('movies/{movie}', [MovieController::class, 'show']);
        Route::get('showtimes', [ShowtimeController::class, 'index']);
        Route::get('showtimes/{showtime}', [ShowtimeController::class, 'show']);
        Route::get('categories', [CategoryController::class, 'index']);
        Route::get('categories/{category}', [CategoryController::class, 'show']);
        Route::get('categories/{category}/movies', [CategoryController::class, 'movies']);
        Route::get('movies/{movie}/categories', [MovieController::class, 'categories']);
        Route::get('movies/{movie}/categories/{category}', [CategoryController::class, 'show']);
        Route::get('categories/{category}/movies/{movie}', [MovieController::class, 'show']);
        Route::get('reservations', [ReservationController::class, 'index']);
        Route::post('reservations', [ReservationController::class, 'store']);
        Route::get('reservations/{reservation}', [ReservationController::class, 'show']);
        Route::post('reservations/{reservation}/confirm', [ReservationController::class, 'confirm']);
        Route::post('reservations/{reservation}/cancel', [ReservationController::class, 'cancel']);


        // reservations — all authenticated users
        Route::apiResource('reservations', ReservationController::class);

        // admin only
        Route::middleware('role:admin')->group(function () {
            Route::apiResource('users', UserController::class)->except(['index', 'show']);
            Route::apiResource('locations', LocationController::class);
            Route::apiResource('categories', CategoryController::class)->except(['index', 'show']);
            Route::apiResource('cinemas', CinemaController::class)->except(['index', 'show']);
            Route::apiResource('cinemas.halls', HallController::class)->shallow()->except(['show', 'index']);
            Route::apiResource('halls.seats', SeatController::class)->shallow()->except(['show', 'index']);
            Route::apiResource('movies', MovieController::class)->except(['index', 'show']);
            Route::apiResource('showtimes', ShowtimeController::class)->except(['index', 'show']);
            Route::post('halls/{hall}/seats/bulk', [SeatController::class, 'bulkStore']);
            Route::post('movies/{movie}/categories', [MovieController::class, 'addCategory']);
            Route::delete('movies/{movie}/categories/{category}', [MovieController::class, 'removeCategory']);
        });
    });
});