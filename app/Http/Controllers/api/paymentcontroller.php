<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\User;
use App\Payment;
use Razorpay\Api\Api;

class paymentcontroller extends Controller
{
public function razorpayPayment(Request $request)
	{
        $statusCode = 200;
        $v = Validator::make ( $request->input (),
		[
			 "session_id" => "required",
			 "plan_id" => "required",
						  
		] );
		  if ($v->fails ()) {
				$error_description = "";
				foreach ( $v->messages ()
					->all () as $error_message ) {
					$error_description .= $error_message . " ";
				}
				$statusCode = 400;
				$response = [
					"error" => true,
					"status" => $statusCode,
					"error_description" => $error_description
				];
				return response ()->json ( $response, $statusCode, $headers = [ ],
						$options = JSON_PRETTY_PRINT );
		} 


		$session_id = $request->session_id;

		$session = AppLogin::where("session_id", "=", $session_id)->first();

	 if($session){

	    $user=$session->getUser();

		$planId = $request->plan_id;

		$plan = Premium::where(['id' =>$planId])->first();

       if(!empty($plan)){


		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => 'https://api.razorpay.com/v1/orders',
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'POST',
		  CURLOPT_POSTFIELDS => array('amount' => $plan->amount* 100,'currency' => 'INR','receipt' => ''),
		  CURLOPT_HTTPHEADER => array(
			//'Authorization: Basic cnpwX3Rlc3RfcFhLa0FDME5GeU5OU0I6R29hYlVqZ0lXN1ZtcTZ4NGdpemVDanpN' //test

	     'Authorization: Basic cnpwX2xpdmVfMGZucXhGVUt4clhOYVU6T044S1Q1UUN0SEJOTnp6ZU1PNlI4U21s'  //live

		  ),
		));
//			'Authorization: Basic cnpwX2xpdmVfMGZucXhGVUt4clhOYVU6T044S1Q1UUN0SEJOTnp6ZU1PNlI4U21s'

		
		
		$response = curl_exec($curl);		
		curl_close($curl);

		$response =json_decode($response);

		if(empty($response->error->description)){

			DB::table('payments')->insert(
				[
				'order_id' => $response->id, 
				'model_id' => $plan->id,
				'model_type' => 1,
				'payment_status' => 0,
				'transaction_id' => $response->id,
				'amount' => $plan->amount,
				'created_by_id' => $user->id,
				]
			);
	
			$data=[];
			$data['order_id']=$response->id;
		    $data['amount']=$response->amount;
			$statusCode = 200;
			$response = ["status_code" => 200,"error"=>false, "data"=> $data ,"message" => 'Order created Successfully.'];

		}else{
			$response = ["status_code" => 200,"error"=>true,"message" => $response->error->description];
		}

	}else{
	    $response = ["status_code" => 200,"error"=>true,"message" => "No plan found"];
	}
}else{
	$statusCode=403;
	$response = ["status_code" => 403,"error"=>true,"message" => "Session expired"];
}

	    return response()->json($response, $statusCode, $headers = [], $options = JSON_PRETTY_PRINT);

	}


public function storePaymentDetail(Request $request)
{
	$statusCode=400;

	$v = Validator::make ( $request->input (),
	[
		 "session_id" => "required",
		 "razorpay_payment_id" => "required",
		 "razorpay_order_id" => "required",
		 "razorpay_signature" => "required"
					  
	] );
	  if ($v->fails ()) {
			$error_description = "";
			foreach ( $v->messages ()
				->all () as $error_message ) {
				$error_description .= $error_message . " ";
			}
			$statusCode = 200;
			$response = [
				"error" => true,
				"status" => $statusCode,
				"error_description" => $error_description
			];
			return response ()->json ( $response, $statusCode, $headers = [ ],
					$options = JSON_PRETTY_PRINT );
	} 

	$session_id = $request->session_id;

	$session = AppLogin::where("session_id", "=", $session_id)->first();

 if($session){
	 try{


	$user=$session->getUser();

	$paymentModel= Payment::where(["order_id"=>$request->razorpay_order_id,"created_by_id"=>$user->id,])->first();

	if(!empty($paymentModel)){
		$plan= Premium::where(['id' =>$paymentModel->model_id])->first();
	   if(!empty($plan)){

		// $key_id="rzp_test_pXKkAC0NFyNNSB";
		// $key_secret="GoabUjgIW7Vmq6x4gizeCjzM";

	// $key_id="rzp_live_0fnqxFUKxrXNaU";
	    // $key_secret="ON8KT5QCtHBNNzzeMO6R8Sml";

		$key_id="rzp_live_0fnqxFUKxrXNaU";
		$key_secret="ON8KT5QCtHBNNzzeMO6R8Sml";
		$api = new Api($key_id, $key_secret);

	   //Add subscription on razorpay
		$currentTimestamp=strtotime("+15 minutes", time());
		//$subscription  = $api->subscription->create(array('plan_id' => $plan->razorpay_plan_id, 'customer_notify' => 1, 'total_count' => 6, 'start_at' => $currentTimestamp, 'addons' => array(array('item' => array('name' => 'Plan subscription', 'amount' => $paymentModel->amount* 100, 'currency' => 'INR')))));
		
	   //verify payment Signature
		$attributes  = array('razorpay_signature'  => $request->razorpay_signature,  'razorpay_payment_id'  => $request->razorpay_payment_id ,  'razorpay_order_id' => $request->razorpay_order_id);
		$order  = $api->utility->verifyPaymentSignature($attributes);
	
		$paymentModel->razorpay_payment_id=$request->razorpay_payment_id;
		$paymentModel->razorpay_order_id=$request->razorpay_order_id;
		$paymentModel->razorpay_signature=$request->razorpay_signature;
		$paymentModel->payment_status=1;
		$paymentModel->save();

		
		//store subscription
		$this->addPlan($plan,$user->id);

		
		 $statusCode = 200;
		   $response = ["status_code" => 200,"error"=>false,
				"userData" => $this->user_profile_response($user,$session_id),
			   "message" => 'Your Premium Pack Activated Successfully for ₹'.$paymentModel->amount];

		}else{
			$response = ["status_code" => 200,"error"=>false,"message" => "No plan found"];

		}
	}else{
		$response = ["status_code" => 200,"error"=>false,"message" => "No payment found"];

	}

 }catch(\Exception $e) {
	 $response = ["status_code" => 200, "error"=>true,"message" => $e->getMessage()];
  }

}else{
$statusCode=403;

$response = ["status_code" => 403,"error"=>true,"message" => "Session expired"];
}

	return response()->json($response, $statusCode, $headers = [], $options = JSON_PRETTY_PRINT);

}
}