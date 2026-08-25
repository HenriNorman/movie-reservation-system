<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'showtime_id',
        'status',
        'expires_at',
        'total_price'
    ];

    protected $casts = [
        'expires_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function showtime()
    {
        return $this->belongsTo(Showtime::class);
    }

    public function seats()
    {
        return $this->belongsToMany(Seat::class, 'reservation_seat');
    }

    // Check if reservation is expired
    public function isExpired(): bool
    {
        return $this->expires_at->isPast();
    }

    // Check if any seats in this reservation are already booked for this showtime
    public static function seatsAvailable(array $seatIds, int $showtimeId): bool
    {
        $bookedSeats = self::where('showtime_id', $showtimeId)
            ->whereIn('status', ['pending', 'confirmed'])
            ->where('expires_at', '>', now())
            ->whereHas('seats', fn($q) => $q->whereIn('seats.id', $seatIds))
            ->exists();

        return !$bookedSeats;
    }
}