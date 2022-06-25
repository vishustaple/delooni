<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use App\Models\Country;
use Illuminate\Support\Facades\Hash;



class CustomerController extends Controller
{
  /**
    * customer View
    *
    * @param  show admin dashboard
    * @return view detail of all customers
  */
      public function customerView(){
        $data = User::role(Role::where('id',User::ROLE_CUSTOMER)->value('name'))->orderBy('id', 'DESC')->paginate();
       
        $countries = Country::get();
        return view('admin.customer.main', compact('data','countries'));
      }
      /**
    * Store Customer
    *
    * @param  open pop up modal of registration form
    * @return store data in database
    */
    public function storecustomer(Request $request){
    $validatedData = $request->validate([
      'first_name' => 'required',
      'last_name' => 'required',
      'email' => 'required|email|unique:users,email',
      // 'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:8|max:12|unique:users',
      'phone' => 'required|digits:10|unique:users',
      'address' => 'required',
      'nationality' => 'required',
    ]);
   $insert = new User;
   $insert->first_name = $request->first_name;
   $insert->last_name = $request->last_name;
   $insert->email = $request->email;
   $insert->password = Hash::make($request->password);
   $insert->phone = $request->phone;
   $insert->country_code = $request->country_code;
   $insert->address = $request->address;
   $insert->latitude = $request->latitude;
   $insert->longitude = $request->longitude;
   $insert->nationality = $request->nationality;
   $insert->save();
   $insert->assignRole(User::ROLE_CUSTOMER);
   return response()->json(redirect()->back()->with('success','Customer Add Successfully'));
  }
   /**
     *  Status customer
     *
     * @param get $r->id, on click status button
     * @return  return response status active/deactive
   */
   public function status_customer(Request $request){
   $getstatus = User::find($request->id); 
   $status = ($getstatus->status==User::STATUS_ACTIVE)?User::STATUS_NEW:User::STATUS_ACTIVE;
   $data = User::where('id',$request->id)->update([
      'status' => $status
    ]);
   return response()->json($data);
   }
    /**
     *  Delete Customer
     *
     * @param click on delete button get $r->id
     * @return  delete data accordig to $r->id
    */
    public function deletecustomer(Request $request){
    $data = User::where('id',$request->id);
    $data->delete();
    return response()->json(['success' => true]);
   }
   /**
     *  Detail view customer
     * 
     * @param get $r->id on click view button
     * @return  detail view page of customer according $r->id
   */
    public function detailView_customer(Request $request){
    $data = User::find($request->id);
    return view('admin.customer.detailview', compact('data'));
    }
    /**
     *  view update
     *
     * @param click on update button get $r->id
     * @return  open pop up model of $r->id with value
    */
    public function view_update(Request $request){
    $categoryData = User::find($request->id);
    $getcountry=Country::get();
    $res =  view('admin.customer.update', compact('categoryData','getcountry'))->render();
    return response()->json($res);
    }
    /**
     *  update customer
     *
     * @param $r get form data 
     * @return  return response update successfully or not
    */
    public function update_customer(Request $request){
      $validatedData = $request->validate([
        'first_name' => 'required',
        'last_name' => 'required',
        'email' => 'required|email',
        // 'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:8|max:12',
        'phone' => 'required|digits:10|unique:users',
        'address' => 'required',
        'nationality' => 'required',
      ]);
    $insert = User::where('id', $request->id)->update([
      "first_name" => $request->first_name,
      "last_name" => $request->last_name,
      "email" => $request->email,
      "phone" => $request->phone,
      "address" => $request->address,
      "nationality" => $request->nationality,
    ]);
    if($insert){
      return response()->json(redirect()->back()->with('success', 'Updated Successfully.'));
    } else {
    return response()->json(redirect()->back()->with('error', 'Updated not successfully'));
   }
  }
  /**
     *  Search customer
     *
     * @param search name in search bar
     * @return  fetch data according to $request
  */
  public function search_customer(Request $request){
  $search = $request->search;
  $qry = User::select('*');
  if(!empty($search)){
      $qry->where(function($q) use($search){
          $q->where('first_name','like',"%$search%");
     });
  }
  $data = $qry->role(Role::where('id',User::ROLE_CUSTOMER)->value('name'))->orderBy('id', 'DESC')->paginate();
  return view('admin.customer.view', compact('data','search'));
  }
  /**
     *  Customer Back
     *
     * @param click on back button
     * @return  redirect at home page
  */
  public function  customerBack()
  { 
    $url = route('customer');
    return $url;
  }
   /**
     *  Customer data by date range
     *
     * @param select daterange
     * @return  result into view
  */
  public function  customerDateRange(request $r)
  { 
    $r->validate(
      [
          'start_date' => 'required',
          'end_date' => 'required|after:start_date|before_or_equal:today',
      ],
  );
  $start_date=$r->start_date;
  $end_date=$r->end_date;
  
  $data = User::role(Role::where('id',User::ROLE_CUSTOMER)->value('name'))->orderBy('id', 'DESC')->whereBetween('created_at', [$start_date,$end_date])->paginate();
  return view('admin.customer.view', compact('data'));
}


  
  }

