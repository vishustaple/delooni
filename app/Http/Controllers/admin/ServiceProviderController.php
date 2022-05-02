<?php
namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\ServiceProvider;
use App\Models\ServiceCategory;
use App\Models\User;
use App\Models\EducationDetail;
use App\Models\WorkExperience;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ServiceProviderRequest;
use App\Http\Requests\UpdateServiceProviderRequest;
use App\Traits\ImageUpload;
use App\Models\Files;
use App\Models\Country;
use App\Models\Services;


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
        $categorynames = ServiceCategory::where('is_parent','+','0')->get();  
        $getcountry=Country::get();
        return view('admin.serviceprovider.addform',compact('categorynames','getcountry'));
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
        "address" => $request->address,
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
            "brief_of_experience"=>$request->brief_of_experience,
            "user_id" => $user,
        ]);
        $insert = new Services;
        $insert->cat_id =$request->service_category_id;
        $insert->sub_cat_id =$request->subcategory;
        $insert->price_per_hour=$request->price_per_hour; 
        $insert->price_per_day=$request->price_per_day;
        $insert->price_per_month=$request->price_per_month;
        $insert->user_id=$user;
        $insert->created_by=Auth::user()->id;
        $insert->save();

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
        $getwork=WorkExperience::where('user_id', '=', $id)->first();
        $geteducation=EducationDetail::where('user_id', '=', $id)->first();
        $getservicedetail=Services::where('user_id', '=', $id)->first();
        $servicecatid=$getservicedetail->cat_id;
        $getcatdata=ServiceCategory::where('id', '=', $servicecatid)->first();
        $subcatid=$getservicedetail->sub_cat_id;
        $subcategory=ServiceCategory::where('id', '=', $subcatid)->first();
     
        return view('admin.serviceprovider.detailview',compact('data','getwork','geteducation','getservicedetail','getcatdata','subcategory'));
      
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
       $data=User::where('id', '=', $id)->first();
       $geteducation=EducationDetail::where('user_id', '=', $id)->first();
       $getwork=WorkExperience::where('user_id', '=', $id)->first();
       $categorynames=ServiceCategory::select('*')->get();
       $servicename = Services::where('user_id', '=', $id)->first();
       
       return view('admin.serviceprovider.update',compact('data','getwork','geteducation','categorynames','servicename'));
       }

        /**
         *  insert updated service providerdata
         *
         * @param send id 
         * @return  message
         */
         public function UpdateProviderData(UpdateServiceProviderRequest $request)
        {
        
        $user = User::find($request->id);

        if($request->licensephoto)
        $licensephoto = $this->uploadImage($request->licensephoto, 'profile_image');
        else
        $licensephoto = $user->license_cr_photo;

        if($request->img)
        $profileimg = $this->uploadImage($request->img, 'profile_image');
        else
        $profileimg = $user->profile_image;

        if($request->video)
        $profilevideo = $this->UploadImage($request->video,'profile_video');
        else
        $profilevideo = $user->profile_video;

        $user->business_name = $request->business_name ?? $user->business_name;
        $user->first_name = $request->firstname ?? $user->first_name;
        $user->last_name = $request->lastname ?? $user->last_name;
        $user->email = $request->email ?? $user->email;
        $user->nationality = $request->nationality ?? $user->nationality;
        $user->address = $request->Address ?? $user->address;
        $user->phone = $request->phone ?? $user->phone;
        $user->whatsapp_no = $request->whatsappNumber ?? $user->whatsapp_no;
        $user->snapchat_link = $request->snapchat ?? $user->snapchat_link;
        $user->instagram_link = $request->instagram ?? $user->instagram_link;
        $user->twitter_link = $request->twitter ?? $user->twitter_link;
        $user->license_cr_no = $request->licensenumber ?? $user->license_cr_no;
        $user->dob = $request->dateofbirth ?? $user->dob;
        $user->description = $request->description ?? $user->description;
        $user->profile_video = $profilevideo;
        $user->profile_image = $profileimg;
        $user->license_cr_photo = $licensephoto;
        $user->save();
     
        $educationupdate =  EducationDetail::where('user_id', $request->id)->update([
            "institute_name" => $request->education,
            "degree" => $request->degree,
            "start_date" => $request->startdate,
            "end_date" => $request->enddate,
            
        ]);
        $workexperienceupdate = WorkExperience::where('user_id', $request->id)->update([
            "no_of_years"=>$request->experience,
        ]);
        if($user){
            return response()->json(redirect()->back()->with('success', 'ServiceProvider updated successfully'));
        }
        else{
            return response()->json(redirect()->back()->with('error', 'Getting error while adding user.'));
         }

    }
     /**
     *  get category list
     *
     * @param 
     * @return 
     */
    public function GetCategory($id){
        $cat_id=$id;
        $categorynames = ServiceCategory::where('is_parent','=',$cat_id)->get();
        return response()->json($categorynames);
    }
    
        

        
}
