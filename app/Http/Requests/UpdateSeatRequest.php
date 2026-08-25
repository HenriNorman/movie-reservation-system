<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSeatRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'row'    => 'sometimes|integer|min:1',
            'number' => 'sometimes|integer|min:1',
            'is_vip' => 'sometimes|boolean',
        ];
    }
}