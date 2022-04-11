<?php
namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\ServiceProvider;
use App\Models\User;
use App\Models\EducationDetail;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ServiceProviderRequest;


class ServiceProviderController extends Controller
{
    /**
     *  Show ServiceProvider List
     *
     * @param 
     * @return 
     */
    public function ViewServiceProvider(){


        $data = User::role(Role::where('id',User::ROLE_SERVICE_PROVIDER)->value('name'))
                        ->orderBy('id', 'DESC')
                        ->where('status','!=',User::STATUS_INACTIVE)
                        ->paginate();
        return view('admin.serviceprovider.create', compact('data'));
     

    }
    
    /*
    * add service provider.
    *
    * @param  store service provider
    * @return  response success msg or fail
    */
       
    public function AddServiceProvider(ServiceProviderRequest $request){
        dd('heres');
       
     $user = Auth::user();  

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
        "license_cr_photo" => $request->licensephoto,
        "dob"=> $request->dateofbirth,
        "description" => $request->description,
        
       
    ]);
   
    $education =  EducationDetail::create([
        "institute_name" => $request->education,
        "degree" => $request->degree,
        "start_date" => $request->startdate,
        "end_date" => $request->enddate,
        "user_id" => $user->id,
       
    ]);
    return response()->json(redirect()->back()->with('success', 'New service provider is added Successfully'));
    // if($serviceprovideruser||$education){
    
    //     return response()->json(redirect()->back()->with('success', 'New Staff is added Successfully'));
    // } else {
    //     return response()->json(redirect()->back()->with('error', 'Getting error while adding user.'));
    // }
}

    /**
     *  Enable disable user
     *
     * @param
     * @return
     */
    public function ToggleProviderStatus(Request $r)
    {
        $getUserStatus = User::find($r->id);
        $status = ($getUserStatus->status == User::STATUS_ACTIVE) ? User::STATUS_NEW : User::STATUS_ACTIVE;
        $data = User::where('id', $r->id)->update(['status' => $status]);
        return response()->json($data);
    }

}
