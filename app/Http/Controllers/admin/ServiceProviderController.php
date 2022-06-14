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
use App\Models\UserRating;


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
        $data = User::where('service_provider_type',"individual")
               ->role(Role::where('id',User::ROLE_SERVICE_PROVIDER)->value('name'))
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
        "service_provider_type"=> $request->service_provider_type,
        "description" => $request->description,
        "profile_image" => $this->uploadImage($request->img, 'profile_image'),
        "profile_video"=>$this->UploadImage($request->video,'profile_video'),
        "cat_id" =>$request->service_category_id,
        "sub_cat_id" =>$request->subcategory,
        "price_per_hour"=>$request->price_per_hour, 
        "price_per_day"=>$request->price_per_day,
        "price_per_month"=>$request->price_per_month,
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
            "brief_of_experience" => $request->brief_of_experience,
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
        $getwork=WorkExperience::where('user_id', '=', $id)->first();
        $geteducation=EducationDetail::where('user_id', '=', $id)->first();
        $getcatgory=ServiceCategory::where('id', '=', $data->cat_id)->first();
        $servicename=ServiceCategory::where('id', '=',$data->sub_cat_id)->first();
        $rating=UserRating::with('fromuser')->Where('user_id','=',$id)->get();
        return view('admin.serviceprovider.detailview',compact('data','getwork','geteducation','getcatgory','servicename','rating'));
      
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
    $data = $qry->where('service_provider_type',"individual")->role(Role::where('id',User::ROLE_SERVICE_PROVIDER)->value('name'))->orderBy('id', 'DESC')->paginate();
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
       $servicename=ServiceCategory::where('id', '=',$data->sub_cat_id)->first();
       $getcountry=Country::get();
       return view('admin.serviceprovider.update',compact('data','getwork','geteducation','categorynames','servicename','getcountry'));
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
        $user->service_provider_type = $request->service_provider_type ?? $user->service_provider_type;
        $user->description = $request->description ?? $user->description;
        $user->profile_video = $profilevideo;
        $user->profile_image = $profileimg;
        $user->license_cr_photo = $licensephoto;
        $user->cat_id =$request->service_category_id;
        $user->sub_cat_id =$request->subcategory;
        $user->price_per_hour=$request->price_per_hour;
        $user->price_per_day=$request->price_per_day;
        $user->price_per_month=$request->price_per_month;
        $user->save();
        if($user){
            $user->assignRole(User::ROLE_SERVICE_PROVIDER);
           
        }
       
        $educationupdate = EducationDetail::where('user_id',$request->id)->first();
        $educationupdate->institute_name = $request->education??$educationupdate->institute_name;
        $educationupdate->degree = $request->degree??$educationupdate->degree;
        $educationupdate->start_date = $request->startdate??$educationupdate->start_date;
        $educationupdate->end_date = $request->enddate??$educationupdate->end_date;
        $educationupdate->save();

        $workexperienceupdate = WorkExperience::where('user_id',$request->id)->first();
        $workexperienceupdate->no_of_years=$request->experience??$workexperienceupdate->no_of_years;
        $workexperienceupdate->brief_of_experience=$request->brief_of_experience??$workexperienceupdate->brief_of_experience;
        $workexperienceupdate->save();

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
     /**
     *  Show ServiceProvider List
     *
     * @param 
     * @return 
     */
    public function company_view(){
        try{
            $data = User::where('service_provider_type',"company")
                    ->role(Role::where('id',User::ROLE_SERVICE_PROVIDER)->value('name'))
                    ->orderBy('id', 'DESC')->paginate();
              return view('admin.serviceprovider.company', compact('data'));
    }
    catch (\Throwable $th) {
      
        return $this->error($th->getMessage());
    }
    
    }
    public function search_company(Request $request){
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
        $data = $qry->where('service_provider_type',"company")->role(Role::where('id',User::ROLE_SERVICE_PROVIDER)->value('name'))->orderBy('id', 'DESC')->paginate();
        return view('admin.serviceprovider.view', compact('data','search'));
        }
    
    /**
     *  get Remove serviceprovider data form frontend 
     *
     * @param send id
     * @return  json response 
     */
    public function RemovedProviders(){
        $data = User::withTrashed()->paginate();
        return view('admin.removed_user.main', compact('data'));

    }
    /**
     *  Search query for removed user
     *
     * @param search name in search bar
     * @return  fetch data according to $request
    */
     public function RemoveUserSearch(Request $request){
        $search = $request->search;
        $qry = User::select('*');
        if(!empty($search)){
            $qry->where(function($q) use($search){
                $q->where('first_name','like',"%$search%");
           });
        }
        $data = $qry->orderBy('id','ASC')->paginate();
        return view('admin.removed_user.removeduser', compact('data','search'));
        }
}
