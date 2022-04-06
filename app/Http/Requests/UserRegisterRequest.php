<?php

namespace App\Http\Requests;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Support\Arr;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Config;


use Illuminate\Foundation\Http\FormRequest;

class UserRegisterRequest extends FormRequest
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
                'phone' => 'required',
                'first_name'=>'required',
                'last_name'=>'required',
                'email' => 'required|unique:users|email',
                'password' => 'required|min:6'
        ];
    }


        protected function failedValidation(Validator $validator)
            {
                $errors = collect($validator->errors());
                $error  = $errors->unique()->first();

                $msg = Arr::pull($error, 0);

                throw new HttpResponseException(

                    response()->json(["status" => 400, "success" => false, "message" => $msg], 400, $headers = [], $options = JSON_PRETTY_PRINT)
                );
            }
        }