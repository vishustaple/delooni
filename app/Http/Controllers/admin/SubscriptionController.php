<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Subscription;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    /**
    * subscription View
    *
    * @param  show admin dashboard
    * @return view detail of all subscription
    */  
    public function subscriptionView()
    {
        $data = Subscription::orderBy('Id','DESC')->paginate();
        return view('admin.subscription.main', compact('data'));
    }

/**
    * Store Subscription
    *
    * @param  open pop up modal of registration form
    * @return store data in database
*/
public function storesubscription(Request $request){
    $validatedData = $request->validate([
        'plan_name' => 'required',
        'description' => 'required',
        'validity' => 'required',
        'price_per_plan' => 'required',
    ]);
     $insert = new Subscription;
     $insert->plan_name = $request->plan_name;
     $insert->description = $request->description;
     $insert->validity  = $request->validity;
     $insert->price_per_plan = $request->price_per_plan;
     $insert->save();
     return response()->json(redirect()->back()->with('success','Category Add Successfully'));
    }
    /**
     *  Status Subscription
     *
     * @param get $r->id, on click status button
     * @return  return response status active/deactive
*/
   public function status_subscription(Request $request){
    $getstatus = Subscription::find($request->id); 
    $status = ($getstatus->status==Subscription::STATUS_ACTIVE)?Subscription::STATUS_NEW:Subscription::STATUS_ACTIVE;
    $data = Subscription::where('id',$request->id)->update([
        'status' => $status
    ]);
    return response()->json($data);
    }
    /**
     *  Search Subscription
     *
     * @param search Plan name in search bar
     * @return  fetch data according to $request
*/
public function searchsubscription(Request $request){
    $search = $request->search;
    $qry = Subscription::select('*');
    if(!empty($search)){
        $qry->where(function($q) use($search){
            $q->where('plan_name','like',"%$search%");
       });
    }
   $data = $qry->orderBy('id','DESC')->paginate();
   return view('admin.subscription.view', compact('data','search'));
   }
}
