<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\ValidationData;

class PhoneBookRequest extends FormRequest
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
            'name' => 'string',
            'second_name' => 'string',
            'phone_number' => 'regex:/^\+?[1-9]\d{1,14}$/',
            'country_code' => 'country_code',
            'timezone_code' => 'timezone_code',
        ];
    }
}
