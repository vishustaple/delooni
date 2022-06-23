<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
//facades
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use App\Models\LoginHistory;
//models
use App\Models\User;
use App\Models\Report;
use App\Models\Files;
use App\Models\Subscription;
use App\Models\Payment;
use App\Models\providerAnalytic;
use Carbon\Carbon;
//additional
use DB;

//traits
use App\Traits\ApiResponser;
use App\Traits\ImageUpload;
use App\Traits\Email;

//requests
use App\Http\Requests\OtpRequest;

use App\Models\ContactUs;
use App\Models\EducationDetail;
use App\Models\FavouriteServices;
use App\Models\Otp;
use App\Models\ServiceCategory;
use App\Models\UserRating;
use App\Models\WorkExperience;
use App\Models\Services;
use App\Models\Notification;


use Exception;
use Illuminate\Support\Facades\Log;
use PhpOffice\PhpSpreadsheet\Calculation\Web\Service;
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
            return $this->success(__("message.logincheck"), 403);
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
            auth()->user()->tokens()->delete();
            return $this->success(__("message.logoutsuccess"));
        } catch (\Exception $e) {
            return $this->error(__("message.logouterror"));
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
            return $this->success(__("message.logoutallsuccess"));
        } catch (\Exception $e) {
            return $this->error(__("message.logoutallerror"));
        }
    }

    /**
     * sendOtp 
     *
     * @param  $r request contains data to sendOtp 
     * @return response success or fail
     */
    public function sendOtp(OtpRequest $r)
    {
        try {
            $otp = Otp::create([
                'phone' => $r->phone,
                'country_code' => $r->country_code,
                ///'otp' => random_int(1000, 9999),
                'otp' => 1234,
            ]);

            if ($otp) {
                return $this->success(__("message.sendotp"));
            }
            return $this->error(__("message.otperror"));
        } catch (\Throwable $e) {
            Log::error($e->getMessage());
            return $this->error(__("message.otpcatcherror"));
        }
    }

    /**
     * Verify Otp  
     *
     * @param  $r request contains data to verify Otp 
     * @return response success or fail
     */
    public function verifyOtp(request $r)
    {
        $v = Validator::make(
            $r->input(),
            [
                'phone' => 'required|numeric',
                'country_code' => 'required',
                'otp' => 'required|numeric',
                'device_name' => 'required',
                'device_token' => 'required',
                'device_type' => 'required',
                'user_type' => 'required'
            ]
        );
        if ($v->fails()) {
            return $this->validation($v);
        }
        try {
            //if otp not exist
            $otp = Otp::where(['phone' => $r->phone, 'otp' => $r->otp, 'country_code' => $r->country_code])
                ->first();
            if (empty($otp)) {
                throw new Exception(__("message.wrongotp"));
            }
            $otp->delete();
            //if new user 
            $user = User::where('phone', $r->phone)->where('country_code', $r->country_code)->first();

            if (empty($user)) {
                $data = [];
                $data['is_new_profile'] =  true;
                return $this->successWithData([], __("message.otpverified"), $data);
            }
            //if user_type doesn't match 
            if ($user->roles->first()->id != $r->user_type) {
                throw new Exception(__("message.wrongapp"));
            }

            if ($user->roles->first()->id == User::ROLE_SERVICE_PROVIDER) {
                $json = "serviceProviderProfile";
            } else {
                $json = "customerProfile";
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
            $data['is_new_profile'] =  false;

            return $this->successWithData($user->$json(), __("message.otpverified"), $data);
        } catch (\Throwable $e) {
            return $this->error($e->getMessage());
        }
    }

    /**
     *  Register
     *
     * @param  $r request contains data to register
     * @return response success or fail
     */
    public function register(request $r)
    {

        if ($r->user_type == User::ROLE_CUSTOMER) {
            $val = [

                'user_type' => 'required',
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required|email|unique:users|max:255',
                'address' => 'required|string',
                'nationality' => 'required',
                'dob' => 'required',
                'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:5|max:15|unique:users',
                // 'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:5|max:15',
                'device_name' => 'required',
                'device_token' => 'required',
                'device_type' => 'required',
                'country_code' => 'required',
                'latitude' => 'required',
                'longitude' => 'required'

            ];
        } else {
            $val = [
                'user_type' => 'required',
                // 'business_name' => 'required',
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required|email|unique:users|max:255',
                'dob' => 'required',
                // 'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:5|max:15',
                'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:5|max:15|unique:users',
                'device_name' => 'required',
                'device_token' => 'required',
                'device_type' => 'required',
                'country_code' => 'required',
                'latitude' => 'required',
                'longitude' => 'required'

            ];
        }

        $v = Validator::make(
            $r->input(),
            $val
        );
        if ($v->fails()) {
            return $this->validation($v);
        }
        $emailVerifiedAt = time();

        if ($r->user_type == User::ROLE_CUSTOMER) {
            $register = User::create(
                [
                    'email' => $r->email,
                    'first_name' => $r->first_name,
                    'last_name' => $r->last_name,
                    'address' => $r->address,
                    'nationality' => $r->nationality,
                    'dob' => $r->dob,
                    'country_code' => $r->country_code,
                    'phone' => $r->phone,
                    'email_verified_token' => $emailVerifiedAt,
                    'latitude' => $r->latitude,
                    'longitude' => $r->longitude
                ]
            );
            $register->assignRole(User::ROLE_CUSTOMER);
            $json = "customerProfile";
        } else {
            $register = User::create(
                [
                    'business_name' => $r->business_name,
                    'email' => $r->email,
                    'first_name' => $r->first_name,
                    'last_name' => $r->last_name,
                    'dob' => $r->dob,
                    'country_code' => $r->country_code,
                    'phone' => $r->phone,
                    'email_verified_token' => $emailVerifiedAt,
                    'address' => $r->address,
                    'latitude' => $r->latitude,
                    'longitude' => $r->longitude,
                    'nationality' => $r->nationality
                ]
            );
            $register->assignRole(User::ROLE_SERVICE_PROVIDER);
            $json = "serviceProviderProfile";
        }
        $token = $register->createToken('API Token')->plainTextToken;
        $loginHistory = new LoginHistory();
        $loginHistory->device_name = $r->device_name;
        $loginHistory->device_token = $r->device_token;
        $loginHistory->device_type = $r->device_type;
        $loginHistory->personal_access_token = $token;
        $loginHistory->created_by = $register->id;
        $loginHistory->save();
        $data = [];
        $data['token'] =  $token;
        return $this->successWithData($register->$json(), __("message.register_success"),  $data);
    }


    /**
     *  Change Password
     *
     * @param  $r request contains data to change password 
     * @return response success or fail
     */
    public function changePassword(request $r)
    {
        $v = Validator::make(
            $r->input(),
            [
                'password' => 'required|min:4|max:20',
                'confirm_password' => 'required|same:password|min:4|max:20'
            ]
        );
        if ($v->fails()) {
            return $this->validation($v);
        }
        try {
            auth()->user()->update(['password' => Hash::make($r->confirm_password)]);
            return $this->success(__("message.change_Pass"));
        } catch (\Throwable $e) {
            return $this->error($e->getMessage());
        }
    }


    /**
     * Complete Profile  
     *
     * @param  $r request contains data to update user profile 
     * @return response success or fail
     */
    public function completeProfile(request $r)
    {
        try {
            $user = Auth::user();

            $v = Validator::make(
                $r->input(),
                [
                    'profile_image' => 'file',
                    'video' => 'file',
                    'service_provider_type' => 'string|required',
                    'nationality' => 'string',
                    'address' => 'string|required',
                    'country_code' => 'required|string',
                    //'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:5|max:15|unique:users',
                    'whatsapp_no' => 'string|required|regex:/^([0-9\s\-\+\(\)]*)$/|min:8|max:12',
                    'snapchat_link' => 'url|nullable',
                    'instagram_link' => 'url|nullable',
                    'twitter_link' => 'url|nullable',
                    'license_cr_no' => 'string',
                    'license_cr_photo' => 'file',
                    'description' => 'string',
                    'institute_name' => 'string|nullable',
                    'degree' => 'string|nullable',
                    'start_date' => 'date|nullable',
                    'end_date' => 'date|after:start_date|nullable',
                    'no_of_years' => 'numeric',
                    'brief_of_experience' => 'string',
                ]
            );
            if ($v->fails()) {
                return $this->validation($v);
            }
            
            if ($user->roles->first()->id == User::ROLE_SERVICE_PROVIDER) {
                DB::beginTransaction();

                if (isset($_FILES['profile_image'])) {
                    $profile_image = $this->uploadImage($r->profile_image, 'profile_image');
                    $user->profile_image = $profile_image;
                }
                

                if (!empty($_FILES['video'])) {
                    $profilevideo = $this->uploadImage($r->video, 'profile_video');
                    $user->profile_video = $profilevideo;
                }
                // if(isset($r->video)){
                //     $profilevideo = $this->uploadFiles('profile_video',$user->id,FILES::TYPE_VIDEO,$r->file('video'));
                //   //dd($profilevideo);
                //     $user->profile_video = $profilevideo;    
                //     }
                   
                $user->nationality = $r->nationality;
                $user->service_provider_type  = $r->service_provider_type;
                $user->address = $r->address;
                $user->phone = $user->phone;
                $user->whatsapp_no = $r->whatsapp_no;
                $user->snapchat_link = $r->snapchat_link;
                $user->instagram_link = $r->instagram_link;
                $user->twitter_link = $r->twitter_link;
                $user->license_cr_no = $r->license_cr_no;
                $user->description = $r->description;
                // $user->service_provider_type = $r->type;

                if (!empty($_FILES['license_cr_photo'])) {
                    $licenseImage = $this->uploadImage($r->license_cr_photo, 'profile_image');
                    $user->license_cr_photo = $licenseImage;
                }
               
                $user->save();
               
                $education = $user->education ?? new EducationDetail();
                $education->institute_name = $r->institute_name;
                $education->degree = $r->degree;
                $education->start_date = $r->start_date;
                $education->end_date = $r->end_date;
                $education->user_id = $user->id;
                $education->save();
                
                $workExperience = $user->workexperience ?? new WorkExperience();
                $workExperience->no_of_years = $r->no_of_years;
                $workExperience->brief_of_experience = $r->brief_of_experience;
                $workExperience->user_id = $user->id;
                $workExperience->save();
              
                // if ($r->hasFile('video')) {
                //     $file = new Files();
                //     $file->file_name = $this->uploadImage($r->video, 'profile_video');
                //     $extension = ($r->file('video'))->getClientOriginalExtension();
                //     $file->extension = $extension;
                //     $file->model_id = $user->id;
                //     $file->model_type = 'App/Models/User';
                //     $file->file_size = 112;
                //     $file->created_by = $user->id;
                //     $file->type = 1;
                //     $file->save();
                // }
              
                DB::commit();
             
                return $this->successWithData($user->serviceProviderProfile(), __("message.spregister_success"));
             
            }
        } catch (\Throwable $e) {
            DB::rollback();
            return $this->error($e->getMessage());
        }
    }
    /**
     * Add Service Detail  
     *categories
     * @param  $r request contains data to Add Service Detail 
     * @return response success or fail
     */
    public function addService(request $r)
    {
        try {
            $user = auth()->user();
            // $token = LoginHistory::select('personal_access_token')->where('created_by','=',$user->id)->first();
            
            // $data = [];
            // $data['token'] =  $token; 
            $v = Validator::make(
                $r->input(),
                [
                    // 'title' => 'string',
                    // 'description ' => 'string',
                    //'service_image ' => 'string',
                    'category_id' => 'required|integer',
                    'sub_category_id' => 'required|integer',
                    'price_per_hour ' => 'string',
                    'price_per_day' => 'string',
                    'price_per_month' => 'string',
                ]
            );
            if ($v->fails()) {
                return $this->validation($v);
            }
            $category = ServiceCategory::where('id', $r->category_id)->where('is_parent', Services::IS_PARENT)->first();
            if (empty($category)) {
                return $this->error(__("message.nocatfound"));
            }
            $subCategory = ServiceCategory::where('id', $r->sub_category_id)->where('is_parent', $category->id)->first();
            if (empty($subCategory)) {
                return $this->error(__("message.nosubcatfound"));
            }

            $service = User::where('id', $user->id)->first();

            if (empty($service)) {
                $service = new Users();
            }
            $service->cat_id = $category->id ;
            $service->sub_cat_id = $subCategory->id ;
            $service->price_per_hour = $r->price_per_hour ;
            $service->price_per_day = $r->price_per_day ;
            $service->price_per_month = $r->price_per_month ;
            $service->id = $user->id;
            $service->form_step = User::FORM_COMPLETED;
            $service->save();
            return $this->successWithData($service->serviceProviderProfile(), __("message.addservice"));
        } catch (\Throwable $e) {
            DB::rollback();
            return $this->error($e->getMessage());
        }
    }



    /**
     * Get Customer Profile  
     *
     * @return response success or fail
     */
    public function getCustomerProfile()
    {
        $user = auth()->user();
        return $this->successWithData($user->CustomerProfile(), __("message.get_customer_profile"));
    }

    /**
     * Update Customer Detail  
     *
     * @param  $r request contains data to Update Customer Detail
     * @return response success or fail
     */
    public function updateCustomerDetail(request $r)
    {
        $user = auth()->user();
        $v = Validator::make(
            $r->input(),
            [
                'email' => 'required|email|unique:users,email,'.$user->id
            ]
        );
        if ($v->fails()) {
            return $this->validation($v);
        }
        $userUpdate = User::where('id', $user->id)->update(['email' => $r->email]);
        return $this->success(__("message.update_customer"));
    }

    /**
     * Contact Us 
     *
     * @param  $r request contains data for ContactUs 
     * @return response success or fail
     */
    public function contactUs(request $r)
    {
        $user = auth()->user();
        try {
            $v = Validator::make(
                $r->input(),
                [
                    'message' => 'required|string',
                    'type' => "required|string",
                ]
            );
            if ($v->fails()) {
                return $this->validation($v);
            }
            $contact = new ContactUs();
            $contact->message = $r->message;
            $contact->from_user = $user->id;
            $contact->type = $r->type;
            $contact->save();

            return $this->successWithData($contact->jsonData(), __("message.contactus"));
        } catch (\Throwable $e) {
            DB::rollback();
            return $this->error($e->getMessage());
        }
    }

    /**
     * Add Report
     *
     * @param  $r request contains data to Add Report
     * @return response success or fail
     */
    public function report(request $r)
    {

        $user = auth()->user();
        try {
            $v = Validator::make(
                $r->input(),
                [
                    'service_category' => 'string',
                    // 'service_sub_category' => 'integer',
                    'provider_id' => 'required',
                    'subject' => 'required|string',
                    'message' => 'required|string',
                ]
            );
            if ($v->fails()) {
                return $this->validation($v);
            }
            // $serviceCategory = Services::where('id', $r->service_category)->first();
            // if (empty($serviceCategory)) {
            //     throw new Exception("No Service Category Found");
            // }
            $userId = User::where('id', $r->provider_id)->first();
            if (empty($userId)) {
                throw new Exception(__("message.reportnotfound"));
            }
            $report = new Report();
            $report->service_category_id = $userId->cat_id;
            $report->subcategory_id = $userId->sub_cat_id;
            $report->service_provider_id = $r->provider_id;     //service provider id
            $report->user_id  = $user->id;
            $report->subject = $r->subject;
            $report->message = $r->message;
            $report->save();
            return $this->successWithData($report->jsonData(), __("message.report_success"));
        } catch (\Throwable $e) {
            DB::rollback();
            return $this->error($e->getMessage());
        }
    }

    /**
     * Add User Rating
     *
     * @param  $r request contains data to Give rating to service provider
     * @return response success or fail
     */
    public function userRating(request $r)
    {
        $user = auth()->user();
        try {
            $v = Validator::make(
                $r->input(),
                [
                    'rating' => 'required|numeric',
                    'user_id' => 'required|numeric', //service provider id
                    'message' => 'required|string',
                ]
            );
            if ($v->fails()) {
                return $this->validation($v);
            }
            DB::beginTransaction();

            $userrating =  new UserRating();
            $userrating->rating = $r->rating;
            $userrating->user_id  = $r->user_id;
            $userrating->from_user_id = $user->id;
            $userrating->message = $r->message;
            if (!$userrating->save()) {
                throw new Exception(__("message.notrated"));
            }
            $ratingUserModel = $userrating->user;
            $ratingUserModel->rating = (int) UserRating::where(['user_id' => $ratingUserModel->id])->avg('rating');
            if (!$ratingUserModel->save()) {
                throw new Exception(__("message.notrated"));
            }
            DB::commit();
            return $this->successWithData($userrating->jsonData(), __("message.ratingsuccess"));
        } catch (\Throwable $e) {
            DB::rollback();
            return $this->error($e->getMessage());
        }
    }
    /**
     * add favorite 
     *
     * @param  send auth id 
     * @return response get favourite service provider by user 
     */
    public function addRemoveFavourite(request $r)
    {
       
        $user = auth()->user();
        try {
            $v = Validator::make(
                $r->input(),
                [
                    'provider_id' => 'required|numeric', //service provider id
                    'is_favourite' =>  'required|numeric', //is favorite or not   0 or 1

                ]
            );
            if ($v->fails()) {
                return $this->validation($v);
            }
            if ($r->is_favourite == 1) {
                $favourite = new FavouriteServices();
                $favourite->service_id = $r->provider_id;
                $favourite->user_id = $user->id;
                $favourite->save();
                 //send push notification
                 $notification = (new Notification())->sendPushNotification([
                    "title" => "Add to favourite list.",
                    "message" => " You have added a new favourite.",
                    "model_id" => $favourite->id,
                    "type" => Notification::STATUS_NEW,
                    "to_user" => $r->provider_id
                ]);
                 return $this->success(__("message.addfav"));
            
            } else {
                $favourite = FavouriteServices::where(['service_id' => $r->provider_id, 'user_id' => $user->id])->delete();
                return $this->success(__("message.removefav"));
            }
        } catch (\Throwable $e) {
            DB::rollback();
            return $this->error($e->getMessage());
        }
    }
    /**
     * Update Service provider detail 
     *
     * @param  contains id 
     * @return response 
     */
    //
    public function updateSpProfile(request $r)
    { 
        $user = auth()->user(); 
        try {
            $v = Validator::make(
                $r->input(),
                [
                    'whatsapp_no' => 'string|required|regex:/^([0-9\s\-\+\(\)]*)$/|min:8|max:12',
                    'email' => 'required|email|unique:users,email,'.$user->id,
                    'video' => 'file',
                    'snapchat_link' => 'url|nullable',
                    'instagram_link' => 'url|nullable',
                    'twitter_link' => 'url|nullable',
                    'no_of_years' => 'numeric',
                    'price_per_hour ' => 'numeric',
                    'price_per_day' => 'numeric',
                    'price_per_month' => 'numeric',
                ]
            );
            if ($v->fails()) {
                return $this->validation($v);
            }
           
            $serviceprovider = User::where('id', $user->id)->first();
            // if(isset($r->video)){
                // if ($r->hasFile('video')) {
                //     $file = new Files();
                //     $file->file_name = $this->uploadImage($r->video, 'profile_video');
                //     $extension = ($r->file('video'))->getClientOriginalExtension();
                //     $file->extension = $extension;
                //     $file->model_id = $user->id;
                //     $file->model_type = 'App/Models/User';
                //     $file->file_size = 112;
                //     $file->created_by = $user->id;
                //     $file->type = 1;
                //     $file->save();
                // }
                
            // $profilevideo = $this->uploadImage($r->video, 'profile_video');
            // $serviceprovider->profile_video = $profilevideo;    
           // }

           if($r->video)
            $profilevideo = $this->UploadImage($r->video,'profile_video');
            else
            $profilevideo = $serviceprovider->profile_video;
            $serviceprovider->profile_video = $profilevideo;
            $serviceprovider->email = $r->email ?? $serviceprovider->email;
            $serviceprovider->whatsapp_no = $r->whatsapp_no ?? $serviceprovider->whatsapp_no;
            $serviceprovider->snapchat_link = $r->snapchat_link ?? $serviceprovider->snapchat_link;
            $serviceprovider->instagram_link = $r->instagram_link ?? $serviceprovider->instagram_link;
            $serviceprovider->twitter_link = $r->twitter_link ?? $serviceprovider->twitter_link;
            $serviceprovider->price_per_hour=$r->price_per_hour?? $serviceprovider->price_per_hour;
            $serviceprovider->price_per_day=$r->price_per_day?? $serviceprovider->price_per_day;
            $serviceprovider->price_per_month=$r->price_per_month?? $serviceprovider->price_per_month;
            $serviceprovider->save();
            $workExperience = WorkExperience::where('user_id', $user->id)->first();
            $workExperience->no_of_years = $r->no_of_years ?? $workExperience->no_of_years;
            $workExperience->save();
            return $this->successWithData($user->serviceProviderProfile(), __("message.spupdatesuccess"));
        }   catch (\Throwable $e) {
            DB::rollback();
            return $this->error($e->getMessage());
        }
    }

    /**
     * Notification enable disable 
     *
     * @param  contains user id 
     * @return response 
     */
    //

    public function NotificationStatus(request $r)
    {
        try {
            $v = Validator::make(
                $r->input(),
                [
                    'status' => 'numeric|required',
                ]
            );
            if ($v->fails()) {
                return $this->validation($v);
            }
            $notificationstatus = auth()->user()->update(['is_notification' => $r->status]);
            if ($r->status == 0) {
                return $this->success(__("message.disaablenotifi"));
            }
            if ($r->status == 1) {
                return $this->success(__("message.enablenotifi"));
            }
        } catch (\Throwable $e) {
            DB::rollback();
            return $this->error($e->getMessage());
        }
    }

    public function providerDetail(request $r)
    {
        $v = Validator::make(
            $r->input(),
            [
                'provider_id' => 'required|numeric',
            ]
        );
        if ($v->fails()) {
            return $this->validation($v);
        }
      
        $query = User::where('id', $r->provider_id)->first();

        // if (empty($query)) {
        //     return $this->error("No provider found");
        // }
        if ($query->roles->first()->id == User::ROLE_SERVICE_PROVIDER) {
          //save data for profile visit  

        $data=providerAnalytic::where('user_id','=',auth()->user()->id)->Where('service_provider_id','=',$r->provider_id)->first();
        
        if($data == null){
        $user= new providerAnalytic;
        $user->user_id=auth()->user()->id;
        $user->service_provider_id=$r->provider_id;
        $user->save();
        }
        else{

        $user= providerAnalytic::where('service_provider_id','=',$r->provider_id)->first();
        $user->user_id = auth()->user()->id;
        $user->service_provider_id=$r->provider_id;
        $user->count=$user->count+1;
        $user->save();
     
        }
        //profile visit end 
            $message = __("message.spdetailfound");
            return $this->successWithData($query->serviceProviderProfile(), $message);
            
        } else {
            return $this->error(__("message.spnodetail"));
        }
    }
    public function viewDetail()
    {
        $message = __("message.spdetailfound");
        return $this->successWithData(auth()->user()->serviceProviderProfile(), $message);
    }
    /**
     * Update Service provider image and description
     *
     * @param  contains id 
     * @return response 
     */
    //
    public function updatespImage(request $r)
    {  
       
        try {
            $v = Validator::make(
                $r->input(),
                [
                    'profile_image' => 'file',
                    'description' => 'text',
                   
                ]    
            );
            // if ($v->fails()) {
            //     return $this->validation($v);
            // }
            $user = auth()->user();
            $serviceprovider = User::where('id', $user->id)->first();
            if(isset($r->profile_image)){
            $profile_image = $this->uploadImage($r->profile_image, 'profile_image');
            $serviceprovider->profile_image = $profile_image;    
            }
            else{
                $serviceprovider->profile_image =$serviceprovider->profile_image ;
            }
            if(isset($r->description)){
                $serviceprovider->description= $r->description??$serviceprovider->description;
            }
            $serviceprovider->save();
            return $this->successWithData($user->serviceProviderProfile(), __("message.spupdatesuccess"));
        }   catch (\Throwable $e) {
            DB::rollback();
            return $this->error($e->getMessage());
        }
    }

     /**
     * store payment information 
     *
     * @param  contains id 
     * @return response 
     */
    //
    public function storepayment(request $r)
    {
      
     try{
        $v = Validator::make(
            $r->input(),
            [
                'transaction_id' => 'required',
                'user_id' => 'required',
                'plan_id' => 'required',
               
            ]    
        );
        if ($v->fails()) {
            return $this->validation($v);
        }
        $getamount=Subscription::where('id',$r->plan_id)->first();
        $validity=$getamount->validity;

        if($validity){
            $startdate=date('y-m-d h:i:s');
            $enddate=date('y-m-d h:i:s', strtotime($validity));
 
        }
        else{
            return  __("message.no_plan");
        }
        
        $payment = new payment();
        $payment->plan_id = $r->plan_id;
        $payment->transaction_id = $r->transaction_id;
        $payment->created_by = $r->user_id;
        $payment->amount = $getamount->price_per_plan;
        $payment->start_date=$startdate;
        $payment->expire_date= $enddate;
        $payment->payment_status= payment::STATUS_ACTIVE;
        $payment->save();
  
        return $this->successWithData($payment->jsonData(), __("message.planadd"));
    }   catch (\Throwable $e) {
        DB::rollback();
        return $this->error($e->getMessage());
    }

    }
}
