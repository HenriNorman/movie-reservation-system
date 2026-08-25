<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateBulkSeatsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $hallId = $this->route('hall')->id;

        return [
            'seats'          => 'required|array|min:1',
            'seats.*.row'    => 'required|integer|min:1',
            'seats.*.number' => 'required|integer|min:1|unique:seats,number,NULL,id,hall_id,' . $hallId,
            'seats.*.is_vip' => 'boolean',
        ];
    }
}