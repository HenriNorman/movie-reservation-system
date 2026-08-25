<?php 

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateShowtimeRequest extends FormRequest{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'start_time' => 'required|date|after:now',
            'end_time'   => 'required|date|after:start_time',
            'price'      => 'required|numeric|min:0',
            'language'   => 'sometimes|string',
            'status'     => 'sometimes|in:scheduled,cancelled,completed',
        ];
    }
}