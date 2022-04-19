<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Models\Admin;
use App\Traits\ImageUpload;
use App\Traits\Statuscheck;
use App\Traits\togglestatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use Carbon\Carbon;
class AdminController extends Controller
{
    use ImageUpload;
    use Statuscheck;
    use togglestatus;
    public function login(){
        return view('admin.login');
        
    }
    /**
     * Admin Login.
     *
     * @param  $r request contains data to login data
     * @return Login user
     */
    public function Adminlogin(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                "email" => "required|email",
                "password" => "required",
            ]);
            $credentials = $request->only('email', 'password');
            $remember = $request->remember;
            $check = User::where('email', $request->email)->first();
            if ($check) {
                if (Auth::attempt($credentials, $remember)) {
                    Auth::logoutOtherDevices($request->password);
                    return redirect()->route('dashboard');
                } else {
                   return redirect('/')->with('error', "Incorrect password");
                }
            } else {
                return redirect('/')->with('error', "Incorrect email/password");
            }
        } else {
           return back();
        }
    }
    /**
     * Admin Logout.
     *
     * @param  $r request contains data to logout
     * @return Logout user
     */
    public function Logout()
    {
        $role = Auth::user()->role_id;
        Auth::logout();
        if ($role == User::ROLE_ADMIN) {
            return redirect('/')->with('success', 'Logged out successfully.');
        } else {
            return redirect('/')->with('success', 'Logged out successfully.');
        }
    }

    public function adminProfile()
    {
        $admin = Admin::where('id', Auth::user()->id)->first();
        return view('admin.profile', compact('admin'));
    }
    
    public function dashboard()
    {
        $loginUser = auth()->user();
        ////////////////Admin/////////////////////
        if ($loginUser->hasRole('admin')) {
            $staff = User::all();
            return view('admin.home', compact('staff'));
        }
        //////////////////Customer//////////////////
        $userModule = $loginUser->userModule;
        return view('admin.customer.dashboard', compact('userModule'));
    }
    public function fetchStaffList(request $request)
    {
        if ($request->ajax()) {
            if ($request->input('search')) {
                $data = Admin::where('first_name', 'like', '%' . $request->search . '%')->where('role', 1)->orderBy('last_name', 'DESC')->paginate(15);
                return view('admin.staff.view', compact('data'))->render();
            } else {
                $data = Admin::orderBy('id', 'DESC')->where('role', 1)->paginate(15);
                return view('admin.staff.view', compact('data'))->render();
            }
        }
    }

    public function toggleStaffStatus(Request $request)
    {
        $check_status = Admin::where('id', $request->id)->where('role', 1)->first();
        $status = $this->checkStatus($check_status->status);
        $get_Result = $this->toggleStatusDB($status, 'Admin', $request->id);
        if ($request->input('search')) {
            $data = Admin::where('first_name', 'like', '%' . $request->search . '%')->where('role', 1)->orderBy('id', 'DESC')->paginate(15);
            return view('admin.staff.view', compact('data'))->render();
        } else {
            $data = Admin::orderBy('id', 'DESC')->where('role', 1)->paginate(15);
            return view('admin.staff.view', compact('data'))->render();
        }
    }

    public function searchStaff(Request $request)
    {
        if ($request->ajax()) {
            if ($request->input('search')) {
                $data = Admin::where('first_name', 'like', '%' . $request->search . '%')->where('role', 1)->orderBy('last_name', 'DESC')->paginate(15);
                return view('admin.staff.view', compact('data'))->render();
            } else {
                $data = Admin::orderBy('id', 'DESC')->where('role', 1)->paginate(15);
                return view('admin.staff.view', compact('data'))->render();
            }
        }
    }
    public function deleteStaff(request $request)
    {
        $delete = Admin::where('id', $request->id)->delete();
        $data = Admin::orderBy('id', 'DESC')->where('role', 1)->paginate(15);
        return view('admin.staff.view', compact('data'))->render();
    }

    /**
     * verify email 
     * 
     * 
     */
    public function VerifyEmail(request $r)
    {
    
        $r->validate(
            [
                'token' => 'required'
            ],
        );
        $token = $r->token;
        
        $tuser = User::where('email_verified_token', $token)->first();
        if (empty($tuser)) {

            $message = 'Your email is not verified';
            return view ('mail.api-error-message',['message'=>$message]);
        } else {
            $updated = User::where('id', $tuser->id)->update(['email_verified' => User::USER_VERIFIED]);
            
            
            if ($updated) {
                $verified = User::where('id', $tuser->id)->update(
                    ['email_verified_token'=> null,
                     'email_verified_at'=>Carbon::now(),
                    ]);
            
            } else {
                $message = 'Your email is not verified';
                return view ('mail.api-error-message',['message'=>$message]);
            }
            if ($updated && $verified) {
                $message = 'Your email is successfully verified';
                return view ('mail.api-success-message',['message'=>$message]);
            } else {
                return $this->error('Something went wrong');
                $message ='Something went wrong';
                 return view ('mail.api-error-message',compact($message));
            }
        }
     
      
    }
      /**
     * Forget password.
     *
     * @param  show Forget password
     * @return  view 
     */
    //
    public function forgotpwdView(){
    return view('admin.forgotPassword');
    }
       /**
     * Forget password.
     *
     * @param  $r request contains data to forget user password
     * @return  response success or fail
     */
    //
    public function forgotPassword(Request $request){
        if ($request->isMethod('post')) {
           $validate = Validator::make(
               $request->input(),
               [
                   'email' => 'required|email|exists:users,email',
               ]
           );
           if ($validate->fails())
                   {                 
                        return redirect()->back()->withErrors($validate->errors());
                    }
            $credentials = $request->only('email');
             $remember = true;
             $check = User::where('email', $request->email)->first();
             if(!$check){
                 return back()
                 ->with('error','email does not match.'); 
             }else{ 
                 $token =rand(); 
                 $id =  $check->first()->id;
                 $user = User::findOrFail($id);
                 $time = Carbon::now();
                 try{
                     Mail::send('admin.forget',['user' => $user, 'id' => $id, 'token'=>$token], function ($m) use ($user) {
                         $m->from('ankur.mittal@richestsoft.in', 'Your Application');
                           $m->to($user->email, $user->name)->subject('Your Reminder!');
                      });
                 }
                 catch(Exception $e){
                 } $insert = User::where('email', $request->email)->update([   
                   "password_reset_token" => $token,
                   "expired_token_time" => $time, 
                 ]);
                 if($insert){
                 return redirect('/')->withSuccess('Password reset link has been sent on your email');
                 }else{

                 }
             }
             }
         }
       /**
       * Reset password.
       *
       * @param  get $id
       * @return  after getting $id reset-password page will be show
       */
       //
        public function resetPassword($token){
            $token_time = User::select('expired_token_time')->where('password_reset_token',$token)->first();
            $token_expire_time = Carbon::now()->subHour(3)->format('Y-m-d H:m:s');
            if($token_time > $token_expire_time){
               return view('admin.resetpassword', compact('token'));
            }else{
            }
        }
            /**
      * update password.
      *
      * @param  $request, id get
      * @return  if $id get, password will be reset and redirect on login page
      */
      //
     public function updatePassword(Request $request){
        $validated = $request->validate([
            'password' => 'required|min:6',
            'confirm_password' => 'required|required_with:password|same:password'
        ]);
         if(!$validated)
                    {                 
                         return redirect()->back()->withErrors($validated->errors());
                    }
         $token = $request->token;
           if($token){ 
               $insert = User::where('password_reset_token', $request->token)->update([   
              "password" => Hash::make($request->password),
           ]);
            return view('/login')->with('success', 'Your password has been changed!');
         }else{ 
              return back()
             ->with('error','Password could not update.');
             }
         }

}
