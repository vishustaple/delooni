<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CityRequest extends FormRequest
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
            'countries'=>'required',
            'city_name' => 'required|alpha|max:100',
            'latitude' => 'required|between:-90,90',
            'longitude' => 'required|between:-180,180',
            'radius'=>'required',
        ];
    }
}
