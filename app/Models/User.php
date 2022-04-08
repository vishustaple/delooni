<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;


class User extends Authenticatable
{
    use HasRoles, HasApiTokens, HasFactory, Notifiable, SoftDeletes;
    /////////////STATIC VALUES////////
    const STATIC_ADMIN_DATABASE_ID = 1;
    const STATIC_CUSTOMER_DATABASE_ID = 2;
    const STATIC_SERVICEPROFIDER_DATABASE_ID = 3;
    //////////////////////////////////

    const ROLE_ADMIN = 1;
    const ROLE_CUSTOMER = 2;
    const ROLE_SERVICE_PROVIDER = 3;
    const GUEST = 3;

    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_NEW = 2;


    const MALE = 1;
    const FEMALE = 2;
    const OTHER = 3;
    const UPLOAD_PICTURE_PATH = "/public/images";

    const USER_VERIFIED= 1;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','first_name','last_name','phone','email','dob','latitude','longitude','address','city','state','pincode','country','counry_code','country_short_code','spoken_language','other_spoken_language','primary_mode_of_transport','experience','travel_distance','earliest_start_date','aspire_to_achieve','hobbies','long_term_goal','goal','profile_image','cover_image','is_notification','role_id','status','created_by','email_verified_at','password','form_step','email_verified_token'
    ];

    public function education(){
        return $this->hasOne(EducationDetail::class, 'user_id');
    }
    public function workexperience(){
        return $this->hasOne(WorkExperience::class, 'user_id');
    }
    public function files()
    {
        return $this->hasOne(Files::class, 'created_by')->where('model_type','App/Models/User');
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function jsonData()
    {
        $json = [];
        $json['email'] = $this->email;
        $json['business_name']=$this->name;
        $json['is_notification'] = $this->is_notification;
        $json['form_step'] = $this->form_step;
        return $json;
    }

    public function customerProfile(){
        $json=[];
        $json['id']=$this->id;
        $json['dob'] = $this->dob;
        $json['nationality'] = $this->nationality;
        $json['address'] = $this->address;
        $json['email'] = $this->email;
        return $json;
    }

    public function serviceProviderProfile()
    {
        $json = [];
        $json['profile_image']= url('') . '/profile_image/' . $this->profile_image ?? '';
        $json['video']=url('') . '/videos/' . $this->files->file_name ?? '';
        $json['service_provider_type ']=$this->service_provider_type ;
        $json['nationality']=$this->nationality;
        $json['address']=$this->address;
        $json['phone']=$this->phone;
        $json['whatspp_no']=$this->whatspp_no;
        $json['snapchat_link']=$this->snapchat_link;
        $json['instagram_link']=$this->instagram_link;
        $json['twitter_link']= $this->twitter_link;
        $json['license_cr_no']= $this->license_cr_no;
        $json['license_cr_photo']= $this->license_cr_photo;
        $json['description']= $this->description;
        $json['institute_name']= $this->education->institute_name;
        $json['degree']= $this->education->degree;
        $json['start_date']= $this->education->start_date;
        $json['end_date']= $this->education->end_date;
        $json['no_of_years']= $this->workexperience->no_of_years;
        $json['brief_of_experience']= $this->workexperience->brief_of_experience;
        return $json;

    }
    
}
