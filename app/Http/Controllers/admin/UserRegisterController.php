<?php

namespace App\Http\Controllers\admin;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UserRegisterRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Traits\ImageUpload;
class UserRegisterController extends Controller
{
    use ImageUpload;
    public function viewUser(){

        $data = User::where('role_id',1)->where('status','!=',User::STATUS_INACTIVE)->orderBy('id', 'DESC')->paginate();
        return view('admin.user.create',compact('data'));
        }

/**
     *  adduserlist
     *
     * @param  get data from form
     * @return
     */
public function addUser(UserRegisterRequest $request)
{
    $insert = new User;
    $insert->name = $request->name;
    $insert->email = $request->email;
    $insert->password = Hash::make($request->password);
    $insert->role_id=User::ROLE_USER;
    $insert->save();
    
    return response()->json(redirect()->back()->with('success', 'New User is added Successfully'));
}

/**
     *  Enable disable user
     *
     * @param
     * @return
     */
    public function ToggleUserStatus(Request $r)
    {
        $getUserStatus = User::find($r->id);
        $status = ($getUserStatus->status == User::STATUS_ACTIVE) ? User::STATUS_NEW : User::STATUS_ACTIVE;
        $data = User::where('id', $r->id)->update(['status' => $status]);
        return response()->json($data);
    }
    /**
     *  viewuserdata
     *
     * @param  send id
     * @return  data from db and show into view
     */
    public function viewData($id)
    {
        $data = User::select('name', 'email', 'address', 'phone', 'dob')->where('id', '=', $id)->get();
        return view('admin.user.includes.detailview', compact('data'));
    }
    /**
     *  back to userlist
     *
     * @param
     * @return
     */
    public function  UserBack()
    {
        $url = route('view-user');
        return $url;
    }
    /**
     *  update userdata
     *
     * @param send id
     * @return  view with data
     */
    public function Updateuser(Request $request)
    {
        $value = User::where('id', $request->id)->first();
        return view('admin.user.includes.update', compact('value'))->render();
    }
    /**
     *  insert updated userdata
     *
     * @param send id
     * @return  message
     */
    public function UpdateUserData(UpdateUserRequest $request)
    {
        $update = User::where('id', $request->id)->update([
            "name" => $request->name,
            "email" => $request->email,
            "phone" => $request->phone,
            "address" => $request->address,
            "dob" => $request->dob,
        ]);
        return response()->json(redirect()->back()->with('success', 'User updated successfully'));
    }
    /**
     *  filter data on search
     *
     * @param send searchdata
     * @return  view
     */
 public function filter(Request $request){
    $search = $request->search;
    $qry = User::select('*');
    if(!empty($search)){
        $qry->where(function($q) use($search){
            $q->where('name','like',"%$search%");
            $q->orWhere('email','like',"%$search%");
            $q->orWhere('phone','like',"%$search%");
        });
    }
    $data = $qry->where('role_id',1)->where('status','!=',User::STATUS_INACTIVE)->orderBy('id', 'DESC')->paginate();
    return view('admin.user.includes.view', compact('data','search'));
    }
    /**
     *  Remove data
     *
     * @param send id
     * @return  json response
     */
    public function UserRemove(Request $r)
    {
        $data = User::where('id', $r->id)->update(['status' => User::STATUS_INACTIVE]);
        return response()->json(['success' => true]);
    }
    /**
     * Change Password.
     *
     * @param  $r request contains data to change Password 
     * @return response success or fail
     */
    //
    public function changePassword(Request $request)
    {
        $thisUser = User::whereId(Auth::user()->id);
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:4|max:20|different:password',
            'confirm_password' => 'required|required_with:new_password|same:new_password|max:20'
        ]);
        if (Hash::check($request->old_password, $thisUser->first()->password)) {
            $password = Hash::make($request->new_password);
            $thisUser->update(['password' => $password]);
            return response()->json(redirect()->back()->with('success', 'Password  Updated Successfully'));
        } else {
            return response()->json(redirect()->back()->with(['errors' => 'Password not matched']));
        }
    }
    /**
     * Change Profile Image.
     *
     * @param  $r request contains data to change profile 
     * @return response success or fail
     */
    //
    public function changeProfileImage(Request $request)
    {
        if ($request->hasFile('new_profile_image')) {
            $image_name = $this->UploadImage($request->file('new_profile_image'), 'images');
            $thisUser = Auth::user()->id;
            $isUpdated = User::whereId($thisUser)->update(['profile_image' => $image_name]);
            if ($isUpdated) {
                return response()->json(redirect()->back()->with('success', 'Image is Updated Successfully'));
            } else {
                return response()->json(redirect()->back()->with('fail', 'Image Failed to update'));
            }
        }
    }
}
