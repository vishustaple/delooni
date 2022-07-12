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
    $data = Payment::orderBy('id','DESC')->paginate();
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
        
        if(!empty($search)){
         $data = Payment::where(function($q) use($search){
                $q->where('amount','like',"%$search%");
                $q->orwhere('transaction_id','like',"%$search%");
           })->orderBy('id','DESC')
           ->paginate();
        }else{
          $data = Payment::paginate();
        }
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
    public function finalize(){
    
      return view('admin.finalize');
  
    }
    /**
     * datalist by date range
     *
     * @param click on get button 
     * @return  list by date 
    */
    public function  paymentDateRange(request $r)
    {

    $r->validate(
      [
          'start_date' => 'required',
          'end_date' => 'required|after:start_date',
      ],
  );
  $start_date=date('Y-m-d', strtotime($r->start_date));
  $day=1;
  $end_date=date('Y-m-d', strtotime($r->end_date.' + '.$day.' day'));
  $data = Payment::orderBy('Id','DESC')->whereBetween('payments.created_at', [$start_date,$end_date])->paginate();
  return view('admin.payment.view', compact('data'));
    }
    
}
