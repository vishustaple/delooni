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
            'business_name'=>'required|max:100|regex:/^[a-zA-Z]+ [a-zA-Z]+$/',
            'firstname' => 'required|alpha|max:100',
            'lastname' => 'required|alpha|max:100',
            'email' => 'required|unique:users',
            'phone' => 'required',
            'password'=>'required|min:6',
            'confirm_password'=>'required|required_with:password|same:password|min:6',
            'nationality'=>'required',
            'img' => 'required|mimes:jpeg,bmp,png,jpg',
            'video'=>'required|mimes:mp4',
            'nationality' => 'required',
            'Address' => 'required',
            'whatsappNumber' => 'required',
            'snapchat' => 'required',
            'instagram' => 'required',
            'twitter' => 'required',
            'licensenumber' => 'required|numeric',
            'licensephoto' => 'required',
            'dateofbirth' => 'required',
            'description' => 'required',
            'education' => 'required',
            'degree' => 'required',
            'startdate' => 'required',
            'enddate' => 'required|after:startdate',
            'experience' => 'required|numeric',
           
            
        ];
    }
}
