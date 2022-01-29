<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServiceFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'date' => ['date_format:d-m-Y|after:today'],
            'pet_name' => ['required'],
            'service_type' => ['required'],
        ];
    }

    public function messages() {
        return [
            'pet_name.required' => 'A pet name is required!',
            'service_type.required' => 'A service type is required!',
        ];
    }
}
