<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCinemaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            // cinema
            'name'                       => 'required|string|max:255',
            'rating'                     => 'required|integer|min:1|max:5',
            'location_id'                => 'required|exists:locations,id'
        ];
    }
}