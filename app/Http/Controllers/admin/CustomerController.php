<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;


class CustomerController extends Controller
{
  /**
    * customer View
    *
    * @param  show admin dashboard
    * @return view detail of all customers
  */
  public function customerView(){
        $data = User::select('*')->orderBy('id', 'DESC')->paginate();
        return view('admin.customer.main', compact('data'));
      }
      /**
    * Store Category
    *
    * @param  open pop up modal of registration form
    * @return store data in database
    */
    public function storecustomer(Request $request){
    $validatedData = $request->validate([
      'first_name' => 'required',
      'last_name' => 'required',
      'email' => 'required|email',
      'password' => 'required',
      'confirm_password' => 'same:password',   
      'phone' => 'required|numeric',
      'address' => 'required',
      'nationality' => 'required',
    ]);
   $insert = new ServiceCategory;
   $insert->category_name = $request->category_name;
   $insert->description = $request->description;
   $insert->service_category_image  = $request->file('service_category_image')->getClientOriginalName();
   $insert->path = $request->file('service_category_image')->store('/public/images');
  //  echo "<pre>"; var_dump($request->file('service_category_image')->store('/public/images'));die;
   $insert->save();
   return response()->json(redirect()->back()->with('success','Category Add Successfully'));
  }
}

