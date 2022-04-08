<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;

//facades
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Paginate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Arr;
use App\Models\LoginHistory;
use Illuminate\Support\Facades\Mail;
//models
use App\Models\User;
use App\Models\AppLogin;
use App\Models\EmploymentHistory as EH;
use App\Models\Project;
use App\Models\Socialmedia;
use App\Models\Language;
use App\Models\Skill;
use App\Models\UserSkill;
use App\Models\PasswordReset;
use App\Models\Expertise;
use App\Models\FriendRequest;
use App\Models\FriendList;
use App\Models\Post;
use App\Models\Notification;
use App\Models\Files;
use App\Models\Favourite;
use App\Models\Thumbsup;
use App\Models\SinglePostFav;
use App\Models\SinglePostThumbs;
use App\Models\FileReaction;
use App\Models\PostReaction;
use App\Models\Comment;
use App\Models\Reply;
use App\Models\FileComment;
use App\Models\FileCommentReply;
use App\Models\PostViews;
use App\Models\FileViews;
use App\Models\DefaultPostion;
use App\Models\Position;
use App\Models\DefaultPreferToWorkIn;
use App\Models\PreferToWorkIn;

//additional
use DB;
use Carbon\Carbon;
//use Validator;
use Session;

//traits
use App\Traits\ApiResponser;
use App\Traits\ImageUpload;
use App\Traits\Email;
use App\Traits\Togglestatus;

//requests
use App\Http\Requests\UserRequest;
use App\Http\Requests\OtpRequest;
use App\Http\Requests\UserRegisterRequest;

//events
use App\Events\Notify;
use App\Models\Availability;
use App\Models\DefaultSlot;
use App\Models\Otp;
use App\Models\Slot;
use App\Models\EducationWork;
use Exception;
use Illuminate\Support\Facades\Log;
use Validator;

class UserController extends Controller
{
    use ApiResponser;
    use ImageUpload;
    use Email;
    // use Togglestatus;

    /**
     * Showing error when user not logged in.
     *
     * @param  $r request contains data to show error when user not login
     * @return login user check
     */
    public function loginCheck(request $r)
    {
        try {
            return $this->success('Please login to access this page', 403);
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }
    /**
     * Logout current device.
     *
     * @param  $r request contains data to logout
     * @return logout current device
     */
    public function logout(request $r)
    {
        try {
            $r->user()->currentAccessToken()->delete();
            return $this->success('Successfully loggged out');
        } catch (\Exception $e) {
            return $this->error('Please check your fields');
        }
    }
    /**
     * Logout all device
     *
     * @param  $r request contains data to all device logout
     * @return logout  all  device
     */
    public function logoutAll()
    {
        try {
            auth()->user()->tokens()->delete();
            return $this->success('Successfully loggged out from all devices');
        } catch (\Exception $e) {
            return $this->error('Please check your fields');
        }
    }

    /**
     * sendOtp 
     *
     * @param  $r request contains data to sendOtp 
     * @return response success or fail
     */
    public function sendOtp(OtpRequest $request)
    {
        
        try {
            # if sign up, check for unique phone no
            if ($request->otp_for == Otp::FOR_SIGNUP) {
                $for = Otp::FOR_SIGNUP;

                $checkExist = User::where('phone', $request->phone)->first();
                if ($checkExist) {
                    return $this->error("Phone has already been taken.");
                }
            }
            
            # otp to phole integration here
            Otp::where([
                ['phone', '=', $request->phone],
                ['otp_for', '=', $request->otp_for],
            ])->delete();

            $otp = Otp::create([
                'phone' => $request->phone,
                'country_code' => $request->country_code,
                'country_short_code' => $request->country_short_code,
                'otp_for' => $request->otp_for,
                'otp' => random_int(1000, 9999),
            ]);
            if( $otp ){
                return $this->successWithData(['otp'=>$otp->otp]);
            } 
            return $this->error("unable to processs your request. Please try again laer.");
        } catch (\Throwable $e) {
            Log::Info("\n==============OTP Error Logs==============\n");
            Log::error($e->getMessage());
            Log::Info("\n==============End of OTP Error Logs==============\n");
            return $this->error("Gettig error while sending OTP. Please try again laer.");
        }
        exit;
    }

    /**
     *  Register
     *
     * @param  $r request contains data to register
     * @return response success or fail
     */
    public function register(UserRegisterRequest $r)
    {
       try
       {
        $email_verify_token = time();
        if($r->user_type=="customer"){
        $register = User::create(
            [
                'email' => $r->email,
                'password' => Hash::make($r->password),
                'first_name'=> $r->first_name,
                'last_name'=>$r->last_name,
                'phone'=>$r->phone,
                'email_verified_token'=>$email_verify_token,
            ]
        );
        $register->assignRole(User::ROLE_CUSTOMER);
    }
    else {
        $register = User::create(
            [   
                'business_name'=>$r->business_name,
                'email' => $r->email,
                'password' => Hash::make($r->password),
                'first_name'=> $r->first_name,
                'last_name'=>$r->last_name,
                'phone'=>$r->phone,
                'email_verified_token'=>$email_verify_token,
            ]
        );
        $register->assignRole(User::ROLE_SERVICE_PROVIDER);
    }
       
        
       $token = $register->createToken('API Token')->plainTextToken;
        if (!empty($register)) {
            $register['fname'] = $r->first_name . ' ' . $r->last_name;
            $register['email'] = $r->email;
            $link = url('') . "/verify-email?token=" . $email_verify_token;
            $sendMail = Mail::send('mail.send-verification-email', ['user' => $register['fname'], 'link' => $link], function ($m) use ($register) {
                $m->from('vishumehandiratta360@gmail.com', 'delooni');
                $m->to($register['email'], $register['fname'])->subject('Email Verification!');
            });
        }
        $data = [];
        $data['token'] =  $token;
        return $this->successWithData($register->jsonData(), "Register successfully", $data);
            } catch (\Throwable $e) {
                Log::Info("\n==============OTP Error Logs==============\n");
                Log::error($e->getMessage());
                Log::Info("\n==============End of OTP Error Logs==============\n");
                return $this->error("Gettig error while creating User. Please try again laer.");
            }
    exit;



    }
   
    /**
     *  Update profile for both users
     *
     * @param  $r request contains data to user profile update
     * @return response success or fail
     */
    // public function updateProfile(UserRequest $r)
    // {
    //     try {
    //         $user = Auth::user();
    //         $update = User::where('id', $user->id)
    //             ->update([
    //                 'name' => $r->name, 'email' => $r->email,
    //                 'phone' => $r->phone, 'business_name' => $r->business_name
    //             ]);
    //         return $this->success('Profile updated successfully');
    //     } catch (\ThrowaValidatorble $e) {
    //         return $this->error('Please check your fields');
    //     }
    // }
    /**
     *  login
     *
     * @param  $r request contains data to user login
     * @return response success or fail
     */
    public function login(request $r)
    {
        try {
            $v = Validator::make(
                $r->input(),
                [
                    'email' => 'required',
                    'password' => 'required|min:4|max:20',
                    'device_name' => 'required',
                    'device_token' => 'required',
                    'device_type' => 'required',
                ]
            );
            if ($v->fails()) {
                return $this->validation($v);
            }

            $user = User::where('email', '=', $r->email)->first();
            if (!$user) {
                throw new Exception("Invalid email or password");
            }
            if (!Hash::check($r->password, $user->password)) {
                throw new Exception("Invalid email or password");
            }
            //Genrate API Auth token
            $token = $user->createToken('API Token')->plainTextToken;

            $loginHistory = new LoginHistory();
            $loginHistory->device_name = $r->device_name;
            $loginHistory->device_token = $r->device_token;
            $loginHistory->device_type = $r->device_type;
            $loginHistory->personal_access_token = $token;
            $loginHistory->created_by = $user->id;
            $loginHistory->save();
            $data = [];
            $data['token'] =  $token;
            return $this->successWithData($user->jsonData(), "Login successfully", $data);
        } catch (\Throwable $e) {
            return $this->error($e->getMessage());
        }
    }
    /**
     *  Get all profile including additional info of both users
     *
     * @param  $r request contains data to user all profile including additional info
     * @return user profile list
     */
    // public function getProfile(request $r)
    // {
    //     return $this->successWithData(auth()->user()->jsonData());
    // }

    /**
     * Verify Otp  
     *
     * @param  $r request contains data to verify Otp 
     * @return response success or fail
     */
    // public function verifyOtp(request $request)
    // {
    //     $v = Validator::make(
    //         $request->input(),
    //         [
    //             'email' => 'required',
    //             'otp' => 'required|numeric',
    //         ]
    //     );
    //     if ($v->fails()) {
    //         return $this->validation($v);
    //     }
    //     try {

    //         $otp = Otp::where(['email' => $request->email, 'otp' => $request->otp])
    //             ->first();
    //         if (empty($otp)) {
    //             throw new Exception("No otp found");
    //         }
    //         $otp->delete();
    //         return $this->success("OTP verified successfully");
    //     } catch (\Throwable $e) {
    //         return $this->error($e->getMessage());
    //     }
    // }

    /**
     * Forgot Password   
     *
     * @param  $r request contains data to forgot password 
     * @return response success or fail
     */
    public function forgotPassword(request $r)
    {
        $v = Validator::make(
            $r->input(),
            [
                'email' => 'required|email',
                'otp' => 'required',
                'password' => 'required|min:4|max:20',

            ]
        );
        if ($v->fails()) {
            return $this->validation($v);
        }
        try {

            $user = User::where('email', $r->email)->first();
            if (empty($user)) {
                throw new Exception("This email is not registered yet");
            }

            $otp = Otp::where(['email' => $r->email, 'otp' => $r->otp, 'for' => OTP::FOR_FORGET])
                ->first();
            if (empty($otp)) {
                throw new Exception("No otp found");
            }
            $user->update(['password' => Hash::make($r->password)]);
            $otp->delete();

            //Genrate API Auth token
            $token = $user->createToken('API Token')->plainTextToken;

            $data = [];
            $data['token'] =  $token;
            return $this->successWithData($user->jsonData(), "Forget successfull", $data);
        } catch (\Throwable $e) {
            return $this->error($e->getMessage());
        }
    }
    /**
     *  Change Password
     *
     * @param  $r request contains data to change password 
     * @return response success or fail
     */
    // public function changePassword(request $r)
    // {
    //     $v = Validator::make(
    //         $r->input(),
    //         [
    //             'password' => 'required|min:4|max:20',
    //             'confirm_password' => 'required|same:password|min:4|max:20'
    //         ]
    //     );
    //     if ($v->fails()) {
    //         return $this->validation($v);
    //     }
    //     try {
    //         auth()->user()->update(['password' => Hash::make($r->confirm_password)]);
    //         return $this->success('Password changed successfull');
    //     } catch (\Throwable $e) {
    //         return $this->error($e->getMessage());
    //     }
    // }

    /**
     * Complete Profile  
     *
     * @param  $r request contains data to update user profile 
     * @return response success or fail
     */
    public function completeProfile(request $r)
    {
        try {
            $user = auth()->user();
            DB::beginTransaction();
            if ($r->form_step == 1) {
                $v = Validator::make(
                    $r->input(),
                    [
                        'form_step' => 'required|numeric',
                        'phone' => 'numeric|digits:10',
                        'pincode' => 'numeric',
                    ]
                );
                if ($v->fails()) {
                    return $this->validation($v);
                }
                $user->update([
                    'first_name' => $r->first_name ?? $user->first_name,
                    'last_name' => $r->last_name ?? $user->last_name,
                    'phone' => $r->phone ?? $user->phone,
                    'dob' => $r->dob ?? $user->dob,
                    'address' => $r->address ?? $user->address,
                    'city' => $r->city ?? $user->city,
                    'state' => $r->state ?? $user->state,
                    'pincode' => $r->pincode ?? $user->pincode,
                    'country' => $r->country ?? $user->country,
                    'spoken_language' => $r->spoken_language ?? $user->spoken_language,
                    'other_spoken_language' => $r->other_spoken_language ?? $user->other_spoken_language,
                    'primary_mode_of_transport' => $r->primary_mode_of_transport ?? $user->primary_mode_of_transport,
                    'travel_distance' => $r->travel_distance ?? $user->travel_distance,
                    'earliest_start_date' => $r->earliest_start_date ?? $user->earliest_start_date,
                    'form_step' => 2,

                ]);
            }
            if ($r->form_step == 2) {
                $validation_rules = [
                    'form_step' => 'required|numeric',
                    'resume.*' => 'mimes:jpeg,jpg,png,gif,csv,txt,pdf|max:2048',
                    'cover_letter.*' => 'mimes:jpeg,jpg,png,gif,csv,txt,pdf|max:2048',
                    'license.*' => 'mimes:jpeg,jpg,png,gif,csv,txt,pdf|max:2048',
                    'training_certificate.*' => 'mimes:jpeg,jpg,png,gif,csv,txt,pdf|max:2048',
                    'degree.*' => 'mimes:jpeg,jpg,png,gif,csv,txt,pdf|max:2048',
                    'shift_json' => 'required|json',
                    'position' => 'required|json',
                    'setting' => 'required|json',
                ];
                $validator = Validator::make($r->all(), $validation_rules);
                if ($validator->fails()) {
                    return $this->validation($validator);
                }
                //shift slot start
                $shiftArray = json_decode($r->shift_json);
                foreach ($shiftArray as $shift) {
                    $dataArray = [
                        'day' => $shift->day,
                        'slot' => $shift->slot,
                    ];
                    $v = Validator::make(
                        $dataArray,
                        [
                            'day' => 'required|string|max:10',
                            'slot' => 'required|array',
                        ],
                    );
                    if ($v->fails()) {
                        return $this->validation($v);
                    }
                    $availabilityModel = Availability::where("day", $shift->day)->first();
                    if (empty($availabilityModel)) {
                        $availabilityModel = new Availability();
                    }
                    $availabilityModel->day = $shift->day;
                    $availabilityModel->created_by = $user->id;
                    $availabilityModel->save();
                    foreach ($shift->slot as $slot) {
                        $getSlot = DefaultSlot::where("id", $slot)->first();
                        if (empty($getSlot)) {
                            throw new Exception("Default slot not found");
                        }
                        $slotModel = Slot::where([
                            "availability_id" => $availabilityModel->id,
                            "start_time" => $getSlot->start_time,
                            "end_time" => $getSlot->end_time,
                        ])->first();
                        if (empty($slotModel)) {
                            $slotModel = new Slot();
                        }
                        $slotModel->start_time = $getSlot->start_time;
                        $slotModel->end_time = $getSlot->end_time;
                        $slotModel->availability_id = $availabilityModel->id;
                        $slotModel->created_by = $user->id;
                        $slotModel->save();
                    }
                }
                //position
                $positions = json_decode($r->position);
                foreach ($positions as $value) {
                    $getPositionData = DefaultPostion::where('id', $value)->first();
                    if (empty($getPositionData)) {
                        throw new Exception("Default position not found");
                    }
                    $postionModel = Position::where("title", $getPositionData->title)->first();
                    if (empty($postionModel)) {
                        $postionModel = new Position();
                    }
                    $postionModel->title = $getPositionData->title;
                    $postionModel->created_by = $user->id;
                    $postionModel->save();
                }
                //setting
                $settings = json_decode($r->setting);
                foreach ($settings as $value) {
                    $getSetting = DefaultPreferToWorkIn::where('id', $value)->first();
                    if (empty($getSetting)) {
                        throw new Exception("Default setting not found");
                    }
                    $settingModel = PreferToWorkIn::where("title", $getSetting->title)->first();
                    if (empty($settingModel)) {
                        $settingModel = new PreferToWorkIn();
                    }
                    $settingModel->title = $getSetting->title;
                    $settingModel->created_by = $user->id;
                    $settingModel->save();
                }
                $this->uploadFiles($r->file('resume'), FILES::TYPE_RESUME, $user,'file');
                $this->uploadFiles($r->file('cover_letter'), FILES::TYPE_COVER_LETTER, $user,'file');
                $this->uploadFiles($r->file('license'), FILES::TYPE_LICENSE, $user,'file');
                $this->uploadFiles($r->file('training_certificate'), FILES::TYPE_TRAINING_CERTIFICATE, $user,'file');
                $this->uploadFiles($r->file('degree'), FILES::TYPE_DEGREE, $user,'file');
                $user->update([
                    'hobbies' => $r->hobbies ?? $user->hobbies,
                    'long_term_goal' => $r->long_term_goal ?? $user->long_term_goal,
                    'experience' => $r->experience ?? $user->experience,
                    'goal' => $r->goal ?? $user->goal,
                    'form_step' => 3
                ]);
            }
            if ($r->form_step == 3) {
                $validation_rules = [
                    'form_step' => 'required|numeric',
                    'government_issueId.*' => 'mimes:jpeg,jpg,png,gif,csv,txt,pdf|max:2048',
                    'physical.*' => 'mimes:jpeg,jpg,png,gif,csv,txt,pdf|max:2048',
                    'tb_records.*' => 'mimes:jpeg,jpg,png,gif,csv,txt,pdf|max:2048',
                ];
                $validator = Validator::make($r->all(), $validation_rules);
                if ($validator->fails()) {
                    return $this->validation($validator);
                }
                $this->uploadFiles($r->file('government_issueId'), FILES::TYPE_GOVERNMENT_ISSUEID, $user,'file');
                $this->uploadFiles($r->file('physical'), FILES::TYPE_PHYSICAL, $user,'file');
                $this->uploadFiles($r->file('tb_records'), FILES::TYPE_TB_RECORDS, $user,'file');
                $insert = new EducationWork;
                $insert->highschool = $r->highschool;
                $insert->college = $r->college;
                $insert->training_institute = $r->training_institute;
                $insert->additional_educational = $r->additional_educational;
                $insert->job_experiences = $r->job_experiences;
                $insert->relevant_skills = $r->relevant_skills;
                $insert->position_apply = $r->position_apply;
                $insert->created_by = $user->id;
                $insert->save();
                $user->update([
                    'form_step' => 4
                ]);
            }
            DB::commit();
            return $this->success('User Profile updated successfully');
        } catch (\Throwable $e) {
            DB::rollback();
            return $this->error($e->getMessage());
        }
    }
}
