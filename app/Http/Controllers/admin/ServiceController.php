<?php

namespace App\Http\Controllers\admin;
use App\Models\Services;
use App\Models\User;
use Spatie\Permission\Models\Role;
use App\Models\ServiceCategory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\ImageUpload;

class ServiceController extends Controller
{
    use ImageUpload;
  /**
    * service View
    *
    * @param  show admin dashboard
    * @return view detail of all service
  */  
   public function serviceView(){
   $data =Services::join('service_categories','services.service_category_id','=','service_categories.id')
    ->select('services.id','services.status','services.name','services.description','services.service_image',
   'services.price_per_hour','services.price_per_day','services.price_per_month','service_categories.name')
   ->orderBy('Id','DESC')->paginate();
    $categorynames = ServiceCategory::where('is_parent',0)->get(); 
    $subcategorys = ServiceCategory::where('is_parent','!=',0)->get();
    $serviceproviders=User::role(Role::where('id',User::ROLE_SERVICE_PROVIDER)->value('name'))->get();
    return view('admin.service.main', compact('data','categorynames','subcategorys','serviceproviders'));
}
/**
    * Store service
    *
    * @param  open pop up modal of registration form
    * @return store data in database
*/
public function storeservice(Request $request){ 
    $validatedData = $request->validate([
        'name' => 'required',
        'description' => 'required',
        'service_image' => 'required|image|mimes:jpg,png,jpeg,gif,svg',
        'price_per_hour' => 'numeric',
        'price_per_day' => 'numeric',
        'price_per_month' => 'numeric',
    ]);
     $insert = new Services;
     $insert->name = $request->name;
     $insert->description = $request->description;
     $insert->service_image  = $this->uploadImage($request->service_image, 'profile_image');
     $insert->price_per_hour = $request->price_per_hour;
     $insert->price_per_day = $request->price_per_day;
     $insert->price_per_month = $request->price_per_month;
     $insert->service_category_id = $request->service_category_id;
     $insert->save();
     return response()->json(redirect()->back()->with('success','Service Add Successfully'));
}
/**
     *  Status service
     *
     * @param get $r->id, on click status button
     * @return  return response status active/deactive
*/
public function status_service(Request $request){
    $getstatus = Services::find($request->id); 
    $status = ($getstatus->status==Services::STATUS_ACTIVE)?Services::STATUS_NEW:Services::STATUS_ACTIVE;
    $data = Services::where('id',$request->id)->update([
        'status' => $status
    ]);
    return response()->json($data);
    }
    /**
     *  Delete service
     *
     * @param click on delete button get $r->id
     * @return  delete data accordig to $r->id
    */
 public function deleteservice(Request $request){
 $data = Services::where('id',$request->id);
 $data->delete();
 return response()->json(['success' => true]);
 }  
/**
     *  view update
     *
     * @param click on update button get $r->id
     * @return  open pop up model of $r->id with value
*/
 public function view_update(Request $request){ 
    $categoryData = Services::find($request->id);
    $categorynames = ServiceCategory::where('is_parent',0)->get();
    $res =  view('admin.service.update', compact('categoryData','categorynames'))->render();
    return response()->json($res);
}
/**
     *  update service
     *
     * @param $r get form data 
     * @return  return response update successfully or not
*/
     public function update_service(Request $request){
     $validatedData = $request->validate([
     'name' => 'required',
     'price_per_hour' => 'required',
     'price_per_day' => 'required',
     'price_per_month' => 'required',
     'description' => 'required',
     'service_image' => 'image|mimes:jpg,png,jpeg,gif,svg',
     ]);
     $user = Services::find($request->id);
    if($request->service_image)
    $service_cate = $this->uploadImage($request->service_image, 'profile_image');
    else
    $service_cate = $user->service_image;
    $user->name = $request->name;
    $user->price_per_hour = $request->price_per_hour;
    $user->price_per_day = $request->price_per_day;
    $user->price_per_month = $request->price_per_month;
    $user->description = $request->description;
    $user->service_image = $service_cate;
    $user->save();
    if($user){
    return response()->json(redirect()->back()->with('success', 'Updated Successfully.'));
    }
    else{
    return response()->json(redirect()->back()->with('error', 'Updated not successfully'));
    }
    }
/**
     *  Search service
     *
     * @param search name in search bar
     * @return  fetch data according to $request
*/
public function searchservice(Request $request){
    $search = $request->search;
    $qry = Services::select('*');
    if(!empty($search)){
        $qry->where(function($q) use($search){
            $q->where('name','like',"%$search%");
       });
    }
   $data = $qry->orderBy('id','DESC')->paginate();
   return view('admin.service.view', compact('data','search'));
   }
/**
     *  Detail view service
     *
     * @param get $r->id on click view button
     * @return  detail view page of service according $r->id
*/
   public function detailView_service(Request $request){
    $data = Services::find($request->id);
    return view('admin.service.detailview', compact('data'));
}
/**
     *  service Back
     *
     * @param click on back button
     * @return  redirect at home page
*/
public function  serviceBack()
{
    $url = route('services');
    return $url;
}
 
public function subcategory($id){
    $categorynames = ServiceCategory::where('is_parent',$id)->get();
    return response()->json($categorynames);
}
}
