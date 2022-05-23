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
        'plan' => 'required',
        'planno' => 'required',
        'price_per_plan' => 'required|max:6',
        'user_type' => 'required',
        'plan_type' => 'required',

    ]);
     $insert = new Subscription;
     $insert->plan_name = $request->plan_name;
     $insert->description = $request->description;
     $insert->validity  =$request->planno." ". $request->plan;
     $insert->price_per_plan = $request->price_per_plan;
     $insert->user_type  = $request->user_type;
     $insert->plan_type  = $request->plan_type;
     $insert->save();
     return response()->json(redirect()->back()->with('success','Subscription Add Successfully'));
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
   /**
     *  Delete subscription
     *
     * @param click on delete button get $r->id
     * @return  delete data accordig to $r->id
    */
    public function delete_subscription(Request $request){
    $data = Subscription::where('id',$request->id);
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
        $content = Subscription::find($request->id);
        $res =  view('admin.subscription.update', compact('content'))->render();
        return response()->json($res);
        }

    /**
     *  update subscription
     *
     * @param $r get form data 
     * @return  return response update successfully or not
     */
       public function update_subscription(Request $request){
       $validatedData = $request->validate([
        'plan_name' => 'required',
        'description' => 'required',
        'plan' => 'required',
        'price_per_plan' => 'required|max:6',
      ]);
    $insert = Subscription::where('id', $request->id)->update([
      "plan_name" => $request->plan_name,
      "description" => $request->description,
      "validity" => $request->plan,
      "price_per_plan" => $request->price_per_plan,
   ]);
    if($insert){
      return response()->json(redirect()->back()->with('success', 'Updated Successfully.'));
    } else {
    return response()->json(redirect()->back()->with('error', 'Updated not successfully'));
   }
 }
    /**
     *  Detail subscription
     *
     * @param get $r->id on click view button
     * @return  detail view page of subscription according $r->id
     */
     public function detailView_subscription(Request $request){
        $content = Subscription::find($request->id);
        return view('admin.subscription.detailview', compact('content'));
        }
}
