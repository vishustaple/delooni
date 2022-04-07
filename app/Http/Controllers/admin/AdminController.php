<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Admin;
use App\Traits\ImageUpload;
use App\Traits\Statuscheck;
use App\Traits\togglestatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

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
}
