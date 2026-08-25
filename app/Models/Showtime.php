<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Showtime extends Model
{
    /** @use HasFactory<\Database\Factories\ShowtimeFactory> */
    use HasFactory;

    protected $hidden = ['created_at', 'updated_at'];

    protected $fillable = [
        'movie_id',
        'hall_id',
        'start_time',
        'end_time',
        'price',
        'language',
        'status'
    ];

    public function hall(){
        return $this->belongsTo(Hall::class);
    }

    public function movie(){
        return $this->belongsTo(Movie::class);
    }
}
