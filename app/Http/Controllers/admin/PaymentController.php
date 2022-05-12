<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Subscription;
use App\Models\User;


class PaymentController extends Controller
{
  /**
    * customer View
    *
    * @param  show admin dashboard
    * @return view detail of all customers
  */
    public function payment_view(){
    $data = Payment::join('subscriptions','payments.plan_id','=','subscriptions.id')
    ->join('users','payments.created_by','=','users.id')
    ->select('payments.id','payments.amount','payments.transaction_id','payments.payment_status','users.first_name','subscriptions.plan_name')
    ->orderBy('Id','DESC')->paginate();
    return view('admin.payment.main', compact('data'));
  }
 /**
     *  Delete payment
     *
     * @param click on delete button get $r->id
     * @return  delete data accordig to $r->id
   */
  public function payment_remove(Request $request){
    $data = Payment::where('id',$request->id);
    $data->delete();
    return response()->json(['success' => true]);
    } 

     /**
     *  Search query
     *
     * @param search name in search bar
     * @return  fetch data according to $request
    */
    public function searchpayment(Request $request){ 
        $search = $request->search;
        $qry = Payment::orderBy('id','DESC')->paginate();
        if(!empty($search)){
            $qry->where(function($q) use($search){
                $q->where('plan_id','like',"%$search%");
           });
        }
        $data = $qry->orderBy('id','DESC')->paginate();dd($data);
        return view('admin.payment.view', compact('data','search'));
        }

     /**
     *  Detail view Payment History
     *
     * @param get $r->id on click view button
     * @return  detail view page of query according $r->id
     */
    public function detailView_payment(Request $request){
       $plan = Payment::where('id',$request->id)->pluck('plan_id');
       $plan_name = Subscription::whereIn('id',$plan)->select('plan_name')->first();
       $user = Payment::where('id',$request->id)->pluck('created_by');
       $user_name = User::whereIn('id',$user)->select('first_name')->first();
       $payment = Payment::find($request->id);
       return view('admin.payment.detailview', compact('payment','plan_name','user_name'));
        }

    /**
     * query Back
     *
     * @param click on back button
     * @return  redirect at home page
    */
    public function  paymentBack()
    {
    $url = route('payment');
    return $url;
    }
    
}
