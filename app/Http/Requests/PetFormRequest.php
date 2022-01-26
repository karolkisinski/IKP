<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PetFormRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:100'],
            'race' => ['required', 'string', 'max:100'],
            'age' => ['required', 'integer', 'between:1,50'],
        ];
    }

    public function messages() {
        return [
            'name.required' => 'A name is required!',
            'race.required' => 'A race is required!',
            'age.required' => 'Age is required!',
        ];
    }
}
