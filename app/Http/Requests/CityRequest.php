<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;

use Illuminate\Support\Arr;

use Illuminate\Support\Facades\Config;

class CityRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Config::get('constants.authorize');
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

    protected function failedValidation(Validator $validator)
    {

        $errors = collect($validator->errors());
        $error  = $errors->unique()->first();

        $msg = Arr::pull($error, 0);

        throw new HttpResponseException(

            response()->json(["status" => 422, "success" => false, "message" => $errors], 422, $headers = [], $options = JSON_PRETTY_PRINT)
        );
    }
}
