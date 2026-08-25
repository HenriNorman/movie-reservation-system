<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hall extends Model
{
    /** @use HasFactory<\Database\Factories\HallFactory> */
    use HasFactory;

    protected $hidden = [
        'created_at',
        'updated_at',
        'cinema_id'
    ];

    protected $fillable = [
        'number',
        'name',
        'is_vip',
        'cinema_id'
    ];

    public function seats(){
        return $this->hasMany(Seat::class);
    }

    public function cinema(){
        return $this->belongsTo(Cinema::class);
    }
}
