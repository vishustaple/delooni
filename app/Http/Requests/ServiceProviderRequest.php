<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServiceProviderRequest extends FormRequest
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
            // 'business_name'=>'required|max:100|regex:/^[a-zA-Z]+$/',
            'business_name'=>'required|max:100',
            'firstname' => 'required|alpha|max:100',
            'lastname' => 'required|alpha|max:100',
            'email' => 'required|unique:users',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:12|unique:users',
            'nationality'=>'required',
            'img' => 'required|mimes:jpeg,bmp,png,jpg|max:8192',
            'video'=>'required|mimes:mp4|max:8192',
            'nationality' => 'required',
            'address' => 'required',
            'service_provider_type' => 'required',
            'whatsappNumber' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:12',
            // 'snapchat' => 'required',
            // 'instagram' => 'required',
            // 'twitter' => 'required',
            'licensenumber' => 'required|numeric',
            'licensephoto' => 'required|mimes:jpeg,bmp,png,jpg|max:8192',
            'dateofbirth' => 'required',
            'description' => 'required',
            'education' => 'required',
            'degree' => 'required',
            'startdate' => 'required',
            'enddate' => 'required|after:startdate',
            'experience' => 'required|numeric',
            'brief_of_experience' => 'string',
            'service_category_id'=>"required",
            'price_per_hour'=>"required",
            'price_per_day'=>"required",
            'price_per_month'=>"required",
            'subcategory'=>"required"
            
        ];
    }
}
