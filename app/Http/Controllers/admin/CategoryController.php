<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ServiceCategory;

class CategoryController extends Controller
{
/**
    * category View
    *
    * @param  show admin dashboard
    * @return view detail of all category
  */
public function categoryView(){
      $data = ServiceCategory::select('*')->orderBy('Id','DESC')->paginate();
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
]);
 $insert = new ServiceCategory;
 $insert->name = $request->name;
 $insert->description = $request->description;
 $insert->service_category_image = $request->service_category_image ?? " ";
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
 $qry = ServiceCategory::select('*');
 if(!empty($search)){
     $qry->where(function($q) use($search){
         $q->where('name','like',"%$search%");
    });
 }
$data = $qry->where('status',1)->orderBy('id','DESC')->paginate();
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
        // "service_category-image" => $request->service_category_image ?? " ",
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
    return view('admin.category.detailview', compact('data'));

}
}

