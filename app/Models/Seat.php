<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seat extends Model
{
    /** @use HasFactory<\Database\Factories\SeatFactory> */
    use HasFactory;

    protected $hidden = [
        'created_at',
        'updated_at',
        'hall_id'
    ];

    protected $fillable = [
        'row',
        'number',
        'is_vip',
        'hall_id'
    ];
    
    public function hall(){
        return $this->belongsTo(Hall::class);
    }
}
