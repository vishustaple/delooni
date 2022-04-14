<?php

namespace App\Http\Controllers\admin;
use App\Models\Services;
use App\Models\ServiceCategory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    
public function serviceView(){

    $data = Services::select('*')->orderBy('Id','DESC')->paginate();
    $categorynames = ServiceCategory::select('*')->get(); 
    return view('admin.service.main', compact('data','categorynames'));
}

public function storeservice(Request $request){
    $validatedData = $request->validate([
        'name' => 'required',
        'description' => 'required',
        'service_category_image' => 'required|image|mimes:jpg,png,jpeg,gif,svg',
    ]);
     $insert = new ServiceCategory;
     $insert->name = $request->name;
     $insert->description = $request->description;
     $insert->service_category_image  = $request->file('service_category_image')->getClientOriginalName();
     $insert->path = $request->file('service_category_image')->store('/public/images');
    //  echo "<pre>"; var_dump($request->file('service_category_image')->store('/public/images'));die;
     $insert->save();
     return response()->json(redirect()->back()->with('success','Category Add Successfully'));

}

}
