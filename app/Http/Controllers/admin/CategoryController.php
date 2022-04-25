<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ServiceCategory;
use App\Traits\ImageUpload;


class CategoryController extends Controller
{
    use ImageUpload;
/**
    * category View
    *
    * @param  show admin dashboard
    * @return view detail of all category
  */
public function categoryView(){
      $data = ServiceCategory::where('is_parent', 0)->orderBy('Id','DESC')->paginate();
      return view('admin.category.main', compact('data'));
    }

/**
    * Store Category
    *
    * @param  open pop up modal of registration form
    * @return store data in database
*/
public function storecategory(Request $request){
   $validatedData = $request->validate([
    'name' => 'required',
    'description' => 'required',
    'service_category_image' => 'required|image|mimes:jpg,png,jpeg,gif,svg',
]);
 $insert = new ServiceCategory;
 $insert->name = $request->name;
 $insert->description = $request->description;
 $insert->service_category_image  = $this->uploadImage($request->service_category_image, 'profile_image');
 $insert->save();
 return response()->json(redirect()->back()->with('success','Category Add Successfully'));
}
/**
     *  Search Category
     *
     * @param search name in search bar
     * @return  fetch data according to $request
*/
public function searchcategory(Request $request){
 $search = $request->search;
 $qry = ServiceCategory::select('*')->where('is_parent', 0);
 if(!empty($search)){
     $qry->where(function($q) use($search){
         $q->where('name','like',"%$search%");
    });
 }
$data = $qry->where('is_parent',0)->orderBy('id','DESC')->paginate();
return view('admin.category.view', compact('data','search'));
}
/**
     *  Delete Category
     *
     * @param click on delete button get $r->id
     * @return  delete data accordig to $r->id
*/
public function deletecategory(Request $request){
   $data = ServiceCategory::where('id',$request->id);
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
    $categoryData = ServiceCategory::find($request->id);
    $res =  view('admin.category.update', compact('categoryData'))->render();
    return response()->json($res);
}
/**
     *  update category
     *
     * @param $r get form data 
     * @return  return response update successfully or not
*/
public function update_category(Request $request){
   $insert = ServiceCategory::where('id', $request->id)->update([
        "name" => $request->name,
        "description" => $request->description,
         "service_category_image"  => $this->uploadImage($request->service_category_image, 'profile_image'),
   ]);
    if($insert){
        return response()->json(redirect()->back()->with('success', 'Updated Successfully.'));
    } else {
      return response()->json(redirect()->back()->with('error', 'Updated not successfully'));
    }
}
/**
     *  Detail view category
     *
     * @param get $r->id on click view button
     * @return  detail view page of category according $r->id
*/
    public function detailView_category(Request $request){
    $data = ServiceCategory::find($request->id);
    $getdatas = ServiceCategory::select('*')->where('is_parent',$request->id)->get(); 
    $getnames = ServiceCategory::select('name','id')->where('id',$request->id)->get();
    return view('admin.category.detailview', compact('data','getdatas','getnames'));
}
/**
     *  Status category
     *
     * @param get $r->id, on click status button
     * @return  return response status active/deactive
*/
   public function status_category(Request $request){
   $getstatus = ServiceCategory::find($request->id); 
   $status = ($getstatus->status==ServiceCategory::STATUS_ACTIVE)?ServiceCategory::STATUS_NEW:ServiceCategory::STATUS_ACTIVE;
   $data = ServiceCategory::where('id',$request->id)->update([
       'status' => $status
   ]);
   return response()->json($data);
   }
 /**
     *  Status category
     *
     * @param get get data according to $r
     * @return  sub category store according to parent category
*/
public function store_sub_category(Request $request){
    $validatedData = $request->validate([
        'name' => 'required',
        'service_category_image' => 'required|image|mimes:jpg,png,jpeg,gif,svg',
     ]);
     $insert = new ServiceCategory;
     $insert->name = $request->name;
     $insert->service_category_image  = $this->uploadImage($request->service_category_image, 'profile_image');
     $insert->is_parent = $request->is_parent;
     $insert->save();
     return response()->json(redirect()->back()->with('success','Sub Category Add Successfully'));
}
/**
     *  Category Back
     *
     * @param click on back button
     * @return  redirect at home page
*/
public function  categoryBack()
{
    $url = route('category');
    return $url;
}
}  
