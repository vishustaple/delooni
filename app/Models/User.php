<?php
namespace App\Models;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Sanctum\HasApiTokens;
use App\Notifications\TaskNotification;
use App\Models\PunchTiming;
use App\Models\Announcement;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use SebastianBergmann\CodeCoverage\Report\Xml\Totals;
use Throwable;
use function PHPUnit\Framework\returnArgument;
class User extends Authenticatable
{
    use HasRoles, HasApiTokens, HasFactory, Notifiable;

    const ROLE_ADMIN = 0;
    const ROLE_USER = 1;
    const ROLE_USER_Hospital = 2;
    const ROLE_USER_STAFF=3;


    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_NEW = 2;


    const MALE = 1;
    const FEMALE = 2;
    const UPLOAD_PICTURE_PATH = "/public/images";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'otp',
        'first_name',
        'last_name',
        'phone',
        'dob',
        'email',
        'password',
        'name',
        'travel_distance',
        'experience',
        'address',
        'city',
        'date_of_joining',
        'goal',
        'state',
        'long_term_goal',
        'hobbies',
        'pincode',
        'country',
        'spoken_language',
        'other_spoken_language',
        'primary_mode_of_transport',
        'travel_distance',
        'earliest_start_date',
        'form_step',
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
    public function jsonData(){
        $json=[];
        $json['id']=$this->id;
       // $json['name']=$this->name;
        $json['email']=$this->email;
        $json['is_notification']=$this->is_notification;
        $json['form_step']=$this->form_step;
        return $json;
    }  
}
