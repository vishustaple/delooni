<?php
namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\ServiceProvider;
use App\Models\User;
use App\Models\EducationDetail;
use App\Models\WorkExperience;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ServiceProviderRequest;
use App\Traits\ImageUpload;
use App\Models\Files;

class ServiceProviderController extends Controller
{
    use ImageUpload;
    /**
     *  Show ServiceProvider List
     *
     * @param 
     * @return 
     */
    public function ViewServiceProvider(){
try{
        $data = User::role(Role::where('id',User::ROLE_SERVICE_PROVIDER)->value('name'))
                        ->orderBy('id', 'DESC')
                        ->paginate();

                  
        return view('admin.serviceprovider.create', compact('data'));
}
catch (\Throwable $th) {
  
    return $this->error($th->getMessage());
}

    }
     /**
     *  Show ServiceProvider form
     *
     * @param 
     * @return 
     */
    public function addformServiceProvider(){
        return view('admin.serviceprovider.addform');
    }
    
    /*
    * add service provider.
    *
    * @param  store service provider
    * @return  response success msg or fail
    */
       
    public function AddServiceProvider(ServiceProviderRequest $request){
        try{ 
    $serviceprovideruser =  User::create([
        "business_name" => $request->business_name,
        "first_name" => $request->firstname,
        "last_name" => $request->lastname,
        "email" => $request->email,
        "password" => Hash::make($request->password),
        "nationality" =>$request->nationality,
        "address" => $request->Address,
        "phone" => $request->phone,
        "whatsapp_no" => $request->whatsappNumber,
        "snapchat_link" => $request->snapchat,
        "instagram_link" => $request->instagram,
        "twitter_link"=> $request->twitter,
        "license_cr_no" => $request->licensenumber,
        "license_cr_photo" => $this->uploadImage($request->licensephoto, 'profile_image'),
        "dob"=> $request->dateofbirth,
        "description" => $request->description,
        "profile_image" => $this->uploadImage($request->img, 'profile_image'),
        "profile_video"=>$this->UploadImage($request->video,'profile_video'),
    ]);
   
    

    if($serviceprovideruser){
     
        $serviceprovideruser->assignRole(User::ROLE_SERVICE_PROVIDER);
        $user =$serviceprovideruser->id;
    
        $education =  EducationDetail::create([
            "institute_name" => $request->education,
            "degree" => $request->degree,
            "start_date" => $request->startdate,
            "end_date" => $request->enddate,
            "user_id" => $user,
           
        ]);
        $workexperiences = WorkExperience::create([
            "no_of_years"=>$request->experience,
            "user_id" => $user,
        ]);
        return response()->json(redirect()->back()->with('success', 'New service provider is added Successfully'));
    }
    }
    catch (\Throwable $th) {
        return response()->json(redirect()->back()->with('error', $th->getMessage()));
        return $this->error($th->getMessage());
    }
}

    /**
     *  Enable disable provideruser
     *
     * @param
     * @return
     */
    public function ToggleProviderStatus(Request $r)
    {
        try{
        $getUserStatus = User::find($r->id);
        $status = ($getUserStatus->status == User::STATUS_ACTIVE) ? User::STATUS_INACTIVE: User::STATUS_ACTIVE;
        $data = User::where('id', $r->id)->update(['status' => $status]);
        return response()->json($data);
        }
        catch (\Throwable $th) {
            return $this->error($th->getMessage());
        }
    }
    /**
     *  View service Provider
     *
     * @param   send id 
     * @return  data from db and show into view 
     */

    public function ViewServiceProviderData($id){

        $data=User::select('*')->where('id', '=', $id)->first();
        $getwork=WorkExperience::select('*')->where('user_id', '=', $id)->first();
        $geteducation=EducationDetail::select('*')->where('user_id', '=', $id)->first();
        return view('admin.serviceprovider.detailview',compact('data','getwork','geteducation'));
      
     }
     /**
     *  back to serviceproviderlist
     *
     * @param 
     * @return  
     */
    public function  ServiceProviderBack()
    {
    $url = route('viewserviceprovider');
    return $url;
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
            $q->where('first_name','like',"%$search%");
            $q->orWhere('email','like',"%$search%");
            // $q->orWhere('phone','like',"%$search%");
        });
    }
    // where('role_id',1)->where('status','!=',User::STATUS_INACTIVE)
    $data = $qry->role(Role::where('id',User::ROLE_SERVICE_PROVIDER)->value('name'))->orderBy('id', 'DESC')->paginate();
    return view('admin.serviceprovider.view', compact('data','search'));
    }

    /**
     *  Remove serviceprovider data form frontend 
     *
     * @param send id
     * @return  json response 
     */
    public function ServiceProviderRemove(Request $r){

        $data = User::where('id',$r->id)->delete();
        return response()->json(['success' => true]);
        }
    /**
     *  return update form  
     *
     * @param    
     * @return  update form 
     */
    public function UpdateForm($id){
       $data=User::select('*')->where('id', '=', $id)->first();
       $geteducation=EducationDetail::select('*')->where('user_id', '=', $id)->first();
       $getwork=WorkExperience::select('*')->where('user_id', '=', $id)->first();
        return view('admin.serviceprovider.update',compact('data','getwork','geteducation'));

        }

        /**
         *  insert updated service providerdata
         *
         * @param send id 
         * @return  message
         */
    public function UpdateProviderData(ServiceProviderRequest $request)
    {
       dd("here");
        // $user= DB::table('model_has_roles')->where('model_id', $request->id)->delete();

        // $update = User::where('id', $request->id)->update([
        //     "name" => $request->name,
        //     "email" => $request->email,
        //     "role_id"=>$request->roles,
        // ]);
        // if($update){
        //     User::find($request->id)->assignRole($request->roles);
        //     return response()->json(redirect()->back()->with('success', 'Staff updated successfully'));
        // }
        // else{
        //     return response()->json(redirect()->back()->with('error', 'Getting error while adding user.'));

        // }

    }

        

        
}
