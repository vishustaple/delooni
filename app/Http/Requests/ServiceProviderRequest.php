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
            'business_name'=>'required',
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'password'=>'required',
            'nationality'=>'required',
            'img' => 'required',
            'video'=>'required',
            'nationality' => 'required',
            'Address' => 'required',
            'whatsappNumber' => 'required',
            'snapchat' => 'required',
            'instagram' => 'required',
            'twitter' => 'required',
            'licensenumber' => 'required',
            'licensephoto' => 'required',
            'dateofbirth' => 'required',
            'description' => 'required',
            'education' => 'required',
            'degree' => 'required',
            'startdate' => 'required',
            'enddate' => 'required',
            'experience' => 'required',
           
            
        ];
    }
}
