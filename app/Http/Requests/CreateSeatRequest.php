<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateSeatRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $hallId = $this->route('hall')->id;
        
        return [
            'row'    => 'required|integer|min:1',
            'number' => 'required|integer|min:1|unique:seats,number,NULL,id,hall_id,' . $hallId,
            'is_vip' => 'required|boolean',
        ];
    }
}