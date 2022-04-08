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
        
        
        if($this->user_type == 'customer'){
            return [
                
                'user_type'=>'required',
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required|email|unique:users|max:255',
                'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:5|max:15|unique:users',
                'password' => 'required|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
                'confirm_password' => 'string|required_with:password|same:password|min:8',
               
            ];
        }
            else{
                return [
                    'user_type'=>'required',
                    'business_name'=>'required',
                    'first_name' => 'required',
                    'last_name' => 'required',
                    'email' => 'required|email|unique:users|max:255',
                    'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:5|max:15|unique:users',
                    'password' => 'required|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
                    'confirm_password' => 'string|required_with:password|same:password|min:8',
                ];
    
            }
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