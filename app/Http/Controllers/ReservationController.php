<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Showtime;
use App\Http\Requests\StoreReservationRequest;
use App\Http\Resources\ReservationResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ReservationController extends Controller
{
    public function index()
    {
        $reservations = Reservation::with(['showtime.movie', 'seats'])
            ->where('user_id', auth('api')->id())
            ->latest()
            ->get();

        return response()->json([
            'message' => 'Reservations fetched',
            'data' => ReservationResource::collection($reservations),
            'status' => 1
        ]);
    }

    public function store(StoreReservationRequest $request)
    {
        $showtime = Showtime::findOrFail($request->showtime_id);
        $seatIds = $request->seat_ids;

        // Check if seats are available
        if (!Reservation::seatsAvailable($seatIds, $showtime->id)) {
            return response()->json([
                'message' => 'One or more seats are already booked',
                'status' => 0
            ], 409);
        }

        // Calculate total price
        $totalPrice = $showtime->price * count($seatIds);

        $reservation = DB::transaction(function () use ($request, $showtime, $seatIds, $totalPrice) {
            $reservation = Reservation::create([
                'user_id' => auth('api')->id(),
                'showtime_id' => $showtime->id,
                'status' => 'pending',
                'expires_at' => now()->addMinutes(15),
                'total_price' => $totalPrice,
            ]);

            $reservation->seats()->attach($seatIds);

            return $reservation->load(['showtime.movie', 'seats']);
        });

        return response()->json([
            'message' => 'Reservation created. Pay within 15 minutes.',
            'data' => new ReservationResource($reservation),
            'status' => 1
        ], 201);
    }

    public function show(Reservation $reservation)
    {
        // Only owner or admin can view
        if ($reservation->user_id !== auth('api')->id() && !auth('api')->user()->hasRole('admin')) {
            return response()->json(['message' => 'Unauthorized', 'status' => 0], 403);
        }

        return response()->json([
            'message' => 'Reservation fetched',
            'data' => new ReservationResource($reservation->load(['showtime.movie', 'showtime.hall.cinema', 'seats'])),
            'status' => 1
        ]);
    }

    public function confirm(Reservation $reservation)
    {
        if ($reservation->user_id !== auth('api')->id()) {
            return response()->json(['message' => 'Unauthorized', 'status' => 0], 403);
        }

        if ($reservation->status !== 'pending') {
            return response()->json(['message' => 'Reservation is not pending', 'status' => 0], 400);
        }

        if ($reservation->isExpired()) {
            $reservation->update(['status' => 'expired']);
            return response()->json(['message' => 'Reservation expired', 'status' => 0], 400);
        }

        $reservation->update(['status' => 'confirmed']);

        return response()->json([
            'message' => 'Reservation confirmed',
            'data' => new ReservationResource($reservation),
            'status' => 1
        ]);
    }

    public function cancel(Reservation $reservation)
    {
        if ($reservation->user_id !== auth('api')->id() && !auth('api')->user()->hasRole('admin')) {
            return response()->json(['message' => 'Unauthorized', 'status' => 0], 403);
        }

        if (!in_array($reservation->status, ['pending', 'confirmed'])) {
            return response()->json(['message' => 'Cannot cancel this reservation', 'status' => 0], 400);
        }

        $reservation->update(['status' => 'cancelled']);

        return response()->json([
            'message' => 'Reservation cancelled',
            'status' => 1
        ]);
    }

    // Admin only — get all reservations
    public function all()
    {
        $reservations = Reservation::with(['user', 'showtime.movie', 'showtime.hall.cinema', 'seats'])
            ->latest()
            ->get();

        return response()->json([
            'message' => 'All reservations fetched',
            'data' => ReservationResource::collection($reservations),
            'status' => 1
        ]);
    }
}