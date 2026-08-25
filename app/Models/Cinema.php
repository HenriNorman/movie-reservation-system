<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cinema extends Model
{
    /** @use HasFactory<\Database\Factories\CinemaFactory> */
    use HasFactory;

    protected $hidden = [
        'created_at',
        'updated_at',
        'location_id'
    ];
    
    protected $fillable = [
        'name',
        'rating',
        'location_id'
    ];
    
    public function location(){
        return $this->belongsTo(Location::class);
    }

    public function showtimes(){
        return $this->hasMany(Showtime::class);
    }

    public function halls(){
        return $this->hasMany(Hall::class);
    }
}
