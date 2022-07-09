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
            // 'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:12|unique:users',
            'phone' => 'required|unique:users',
            'nationality'=>'required',
            'img' => 'required|mimes:jpeg,bmp,png,jpg|max:8192',
            'video'=>'required|mimes:mp4|max:8192',
            'nationality' => 'required',
            'address' => 'required',
            'service_provider_type' => 'required',
            'whatsappNumber' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:12',
            'snapchat' => 'url|nullable',
            'instagram' => 'url|nullable',
            'twitter' => 'url|nullable',
            'licensenumber' => 'required|numeric',
            'licensephoto' => 'required|mimes:jpeg,bmp,png,jpg|max:8192',
            'dateofbirth' => 'required|before:today',
            'description' => 'required',
            // 'education' => 'required',
            // 'degree' => 'required',
            'startdate' => 'date|nullable',
            'enddate' => 'date|after:startdate|nullable',
            'experience' => 'required|numeric',
            'brief_of_experience' => 'string',
            'service_category_id'=>"required",
            'price_per_hour'=>"required|numeric",
            'price_per_day'=>"required|numeric",
            'price_per_month'=>"required|numeric",
            'subcategory'=>"required"
            
        ];
    }
}
