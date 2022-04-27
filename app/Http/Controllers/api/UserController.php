<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
//facades
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use App\Models\LoginHistory;
use Illuminate\Support\Facades\Mail;
//models
use App\Models\User;
use App\Models\Report;
use App\Models\Files;
use Spatie\Permission\Models\Role;



//additional
use DB;

//traits
use App\Traits\ApiResponser;
use App\Traits\ImageUpload;
use App\Traits\Email;

//requests
use App\Http\Requests\OtpRequest;
use App\Http\Requests\UserRegisterRequest;


use App\Models\ContactUs;
use App\Models\EducationDetail;
use App\Models\FavouriteServices;
use App\Models\Otp;
use App\Models\ServiceCategory;
use App\Models\ServiceDetail;
use App\Models\UserRating;
use App\Models\WorkExperience;
use App\Models\Country;
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
            auth()->user()->tokens()->delete();
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
    public function sendOtp(OtpRequest $r)
    {

        try {
            # otp to phole integration here
            // Otp::where([
            //     ['phone', '=', $r->phone],
            //     ['country_code', '=', $r->country_code],
            // ])->delete();
            $otp = Otp::create([
                'phone' => $r->phone,
                'country_code' => $r->country_code,
                'otp' => random_int(1000, 9999),
            ]);

            if ($otp) {
                return $this->successWithData(['otp' => $otp->otp]);
            }
            return $this->error("unable to processs your request. Please try again later.");
        } catch (\Throwable $e) {
            Log::Info("\n==============OTP Error Logs==============\n");
            Log::error($e->getMessage());
            Log::Info("\n==============End of OTP Error Logs==============\n");
            return $this->error("Gettig error while sending OTP. Please try again later.");
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
        $emailVerifiedAt = time();

        if ($r->user_type == "customer") {
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
                ]
            );
            $register->assignRole(User::ROLE_CUSTOMER);
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
                ]
            );
            $register->assignRole(User::ROLE_SERVICE_PROVIDER);
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
        return $this->successWithData($register->jsonData(), 'Registeration Successfull.',  $data);
    }


    /**
     *  login
     *
     * @param  $r request contains data to user login
     * @return response success or fail
     */
    // public function login(request $r)
    // {
    //     try {
    //         $v = Validator::make(
    //             $r->input(),
    //             [
    //                 'email' => 'required',
    //                 'password' => 'required|min:4|max:20',
    //                 'device_name' => 'required',
    //                 'device_token' => 'required',
    //                 'device_type' => 'required',
    //             ]
    //         );
    //         if ($v->fails()) {
    //             return $this->validation($v);
    //         }

    //         $user = User::where('email', '=', $r->email)->first();
    //         if (!$user) {
    //             throw new Exception("Invalid email or password");
    //         }
    //         if (!Hash::check($r->password, $user->password)) {
    //             throw new Exception("Invalid email or password");
    //         }
    //         //Genrate API Auth token
    //         $token = $user->createToken('API Token')->plainTextToken;

    //         $loginHistory = new LoginHistory();
    //         $loginHistory->device_name = $r->device_name;
    //         $loginHistory->device_token = $r->device_token;
    //         $loginHistory->device_type = $r->device_type;
    //         $loginHistory->personal_access_token = $token;
    //         $loginHistory->created_by = $user->id;
    //         $loginHistory->save();
    //         $data = [];
    //         $data['token'] =  $token;
    //         return $this->successWithData($user->jsonData(), "Login successfully", $data);
    //     } catch (\Throwable $e) {
    //         return $this->error($e->getMessage());
    //     }
    // }


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
                'otp' => 'required|numeric'
            ]
        );
        if ($v->fails()) {
            return $this->validation($v);
        }
        try {
            $user = User::where('phone', $r->phone)->where('country_code', $r->country_code)->first();
            if (empty($user)) {
                throw new Exception("This number is not registered yet");
            }
            $otp = Otp::where(['phone' => $r->phone, 'otp' => $r->otp, 'country_code' => $r->country_code])
                ->first();
            if (empty($otp)) {
                throw new Exception("No otp found");
            }
            $otp->delete();

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
            return $this->successWithData($user->jsonData(), "OTP verified successfully", $data);
        } catch (\Throwable $e) {
            return $this->error($e->getMessage());
        }
    }

    /**
     * Forgot Password   
     *
     * @param  $r request contains data to forgot password 
     * @return response success or fail
     */
    // public function forgotPassword(request $r)
    // {
    //     $v = Validator::make(
    //         $r->input(),
    //         [
    //             'email' => 'required|email',

    //         ]
    //     );
    //     if ($v->fails()) {
    //         return $this->validation($v);
    //     }
    //     try {
    //         $update = 0;
    //         $insert = 0;
    //         $user = User::where('email', $r->email)->first();
    //         if (!empty($user)) {

    //             if ($update || $insert) {
    //                 $link = url('') . '/change-password';
    //                 $user['fname'] = $user->first_name . ' ' . $user->last_name;
    //                 $user['email'] = $r->email;

    //                 try {
    //                     $sendMail = Mail::send('mails.change-password', ['user' => $user, 'link' => $link], function ($m) use ($user) {
    //                         $m->from('shagun@richestsoft.in', 'Tranzlanta');
    //                         $m->to($user['email'], $user['fname'])->subject('Password Reset!');
    //                     });
    //                     return $this->success('Mail has been sent to your email.Please check.');
    //                 } catch (\Throwable $e) {
    //                     return $this->error($e->getMessage());
    //                 }
    //             } else {
    //                 return $this->error('Something went wrong please try again later.');
    //             }
    //         } else {
    //             return $this->error('This email is not registered yet.');
    //         }
    //     } catch (\Throwable $e) {
    //         return $this->error($e->getMessage());
    //     }
    // }

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
            return $this->success('Password changed successfull');
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
                    'phone' => 'string|required',
                    'whatsapp_no' => 'string|required',
                    'snapchat_link' => 'url',
                    'instagram_link' => 'url',
                    'twitter_link' => 'url',
                    'license_cr_no' => 'string',
                    'license_cr_photo' => 'file',
                    'description' => 'string',
                    'institute_name' => 'string|required',
                    'degree' => 'string',
                    'start_date' => 'date',
                    'end_date' => 'date',
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
                $user->nationality = $r->nationality;
                $user->service_provider_type  = $r->service_provider_type;
                $user->address = $r->address;
                $user->phone = $r->phone;
                $user->whatsapp_no = $r->whatsapp_no;
                $user->snapchat_link = $r->snapchat_link;
                $user->instagram_link = $r->instagram_link;
                $user->twitter_link = $r->twitter_link;
                $user->license_cr_no = $r->license_cr_no;
                $user->description = $r->description;
                // $user->service_provider_type = $r->type;

                if (!empty($_FILES['license_cr_photo'])) {
                    $licenseImage = $this->uploadImage($r->license_cr_photo, 'license_image');
                    $user->license_cr_photo = $licenseImage ?? $user->license_cr_photo;
                }
                $user->save();

                $education = new EducationDetail();
                $education->institute_name = $r->institute_name;
                $education->degree = $r->degree;
                $education->start_date = $r->start_date;
                $education->end_date = $r->end_date;
                $education->user_id = $user->id;
                $education->save();

                $workExperience = new WorkExperience();
                $workExperience->no_of_years = $r->no_of_years;
                $workExperience->brief_of_experience = $r->brief_of_experience;
                $workExperience->user_id = $user->id;
                $workExperience->save();

                $file = new Files();
                $file->file_name = $this->UploadImage($r->file('video'), 'videos');
                $extension = ($r->file('video'))->getClientOriginalExtension();
                $file->extension = $extension;
                $file->model_id = $user->id;
                $file->model_type = 'App/Models/User';
                $file->file_size = 112;
                $file->created_by = $user->id;
                $file->type = 1;
                $file->save();
                DB::commit();
                return $this->successWithData($user->serviceProviderProfile(), " User Profile updated successfully");
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
    public function addServiceDetails(request $r)
    {
        try {
            $user = auth()->user();

            $v = Validator::make(
                $r->input(),
                [
                    'category' => 'required|integer',
                    'sub_category' => 'required|integer',
                    'price_per_hour ' => 'string',
                    'price_per_day' => 'string',
                    'price_per_month' => 'string',
                ]
            );
            if ($v->fails()) {
                return $this->validation($v);
            }
            $category = ServiceCategory::where('id', $r->category)->where('is_parent', ServiceCategory::IS_PARENT)->first();
            if (empty($category)) {
                return $this->error("No Category Found");
            }
            $subCategory = ServiceCategory::where('id', $r->category)->where('is_parent', $category->id)->first();
            if (empty($category)) {
                return $this->error("No Sub Category Found");
            }
            $service = new ServiceDetail();
            $service->cat_id = $category->id;
            $service->sub_cat_id = $subCategory->id;
            $service->user_id = $user->id;
            $service->price_per_hour = $r->price_per_hour;
            $service->price_per_day = $r->price_per_day;
            $service->price_per_month = $r->price_per_month;
            $service->save();
            return $this->successWithData($service->jsonData(), "Service Details Added");
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
        return $this->successWithData($user->CustomerProfile(), 'Data fetched successfully.');
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
                'email' => 'required|email',
            ]
        );
        if ($v->fails()) {
            return $this->validation($v);
        }
        $userUpdate = User::where('id', $user->id)->update(['email' => $r->email]);
        return $this->success('Your information has been updated.');
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

            return $this->successWithData($contact->jsonData(), 'Message sent successfully');
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
                    'reporting_issue' => 'required|string',
                    'service_category' => 'required',
                    'user_id' => 'required',
                    'subject' => 'required|string',
                    'message' => 'required|string',
                ]
            );
            if ($v->fails()) {
                return $this->validation($v);
            }
            $serviceCategory = ServiceCategory::where('name', $r->service_category)->first();
            $report = new Report();
            $report->reporting_issue = $r->reporting_issue;
            $report->service_category_id = $serviceCategory->id;;
            $report->user_id  = $r->user_id;     //service provider id
            $report->subject = $r->subject;
            $report->message = $r->message;
            $report->save();
            return $this->successWithData($report->jsonData(), 'Report added successfully');
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
                throw new Exception("Not rated");
            }
            $ratingUserModel = $userrating->user;
            $ratingUserModel->rating = (int) UserRating::where(['user_id' => $ratingUserModel->id])->avg('rating');
            if (!$ratingUserModel->save()) {
                throw new Exception("Not rated");
            }
            DB::commit();
            return $this->successWithData($userrating->jsonData(), 'Rating successfully given to user.');
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

                return $this->success('Added to favourite');
            } else {
                $favourite = FavouriteServices::where(['service_id' => $r->provider_id, 'user_id' => $user->id])->delete();
                return $this->success('Remove from favourite.');
            }
        } catch (\Throwable $e) {
            DB::rollback();
            return $this->error($e->getMessage());
        }
    }

    public function updateSpProfile(request $r)
    {
        try {
            $v = Validator::make(
                $r->input(),
                [
                    'email' => 'email',
                    'phone' => 'regex:/^([0-9\s\-\+\(\)]*)$/|min:5|max:15',
                    'whatsapp_no' => 'regex:/^([0-9\s\-\+\(\)]*)$/|min:5|max:15',
                    'snapchat_link' => 'url',
                    'instagram_link' => 'url',
                    'twitter_link' => 'url',
                    'no_of_years' => 'numeric',
                ]
            );
            if ($v->fails()) {
                return $this->validation($v);
            }
            $user = auth()->user();
            $serviceprovider = User::where('id', $user->id)->first();
            $serviceprovider->email = $r->email ?? $serviceprovider->email;
            $serviceprovider->phone = $r->phone ?? $serviceprovider->phone;
            $serviceprovider->whatsapp_no = $r->whatsapp_no ?? $serviceprovider->whatsapp_no;
            $serviceprovider->snapchat_link = $r->snapchat_link ?? $serviceprovider->snapchat_link;
            $serviceprovider->instagram_link = $r->instagram_link ?? $serviceprovider->instagram_link;
            $serviceprovider->twitter_link = $r->twitter_link ?? $serviceprovider->twitter_link;
            $serviceprovider->save();
            if (!empty($_FILES['video'])) {
                $update_data = Files::where(['created_by' => $user->id])
                    ->update(['file_name' => $this->UploadImage($r->file('video'), 'videos'), 'extension' => ($r->file('video'))->getClientOriginalExtension()]);
            }
            $workExperience = WorkExperience::where('user_id', $user->id)->first();
            $workExperience->no_of_years = $r->no_of_years ?? $workExperience->no_of_years;
            $workExperience->save();
            return $this->successWithData($user->serviceProviderProfile(), " User Profile updated successfully");
        } catch (\Throwable $e) {
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
                return $this->success('Notification Disabled');
            }
            if ($r->status == 1) {
                return $this->success('Notification Enabled');
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
        if (empty($user)) {
            return $this->error("No provider found");
        }
        $message = "provider detail";
        return $this->successWithData($query->serviceProviderProfile(), $message);
    }
}
