<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCinemaRequest extends FormRequest{
        public function authorize(): bool{
            return true;
        }

        public function rules(): array{
            return [
                'name' => 'sometimes|string',
                'rating' => 'sometimes|int',
            ];
        }
}