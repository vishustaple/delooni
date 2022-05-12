<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateServiceProviderRequest extends FormRequest
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
            'business_name'=>'required|max:100',
            'firstname' => 'required|alpha|max:100',
            'lastname' => 'required|alpha|max:100',
            'email' => 'required|email|unique:users,email,'.$this->id,
            'phone' => 'required',
            'nationality'=>'required',
            'img' => $this->id== null?'required|mimes:jpeg,bmp,png,jpg':'',
            'video'=>$this->id== null?'required|mimes:mp4':'',
            'nationality' => 'required',
            'Address' => 'required',
            'whatsappNumber' => 'required',
            'snapchat' => 'required',
            'instagram' => 'required',
            'twitter' => 'required',
            'licensenumber' => 'required|numeric',
            'licensephoto' => $this->id== null?'required':'',
            'dateofbirth' => 'required',
            'service_provider_type' => 'required',
            'description' => 'required',
            'price_per_hour'=>"required",
            'price_per_day'=>"required",
            'price_per_month'=>"required",
            'education' => 'required',
            'degree' => 'required',
            'startdate' => 'required',
            'enddate' => 'required',
            'experience' => 'required|numeric',
            
        ];
    }
}
