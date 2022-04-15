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
        'name','first_name','last_name','business_name','phone','email','dob','latitude','longitude','address','city','state','pincode','country','counry_code','country_short_code','spoken_language','other_spoken_language','primary_mode_of_transport','experience','travel_distance','earliest_start_date','aspire_to_achieve','hobbies','long_term_goal','goal','profile_image','cover_image','is_notification','role_id','status','created_by','email_verified_at','password','form_step','email_verified_token','whatsapp_no','snapchat_link','instagram_link','twitter_link','license_cr_no','license_cr_photo','description','profile_video','profile_image','nationality',
    ];

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
}
