<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryMovie extends Model
{
    /** @use HasFactory<\Database\Factories\CategoryMovieFactory> */
    use HasFactory;

    protected $guarded = [];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function movie(){
        return $this->belongsTo(Movie::class);
    }
}
