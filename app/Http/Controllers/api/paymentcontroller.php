<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Payment;
use App\Models\Subscription;
use App\Traits\ApiResponser;
use Exception;
use Illuminate\Support\Facades\DB;
use Razorpay\Api\Api;


class paymentcontroller extends Controller
{
	use ApiResponser;

	public function razorpayPayment(Request $request)
	{

		$v = Validator::make(
			$request->input(),
			[
				'plan_id' => 'required|numeric'
			]
		);
		if ($v->fails()) {
			return $this->validation($v);
		}

		$planId = $request->plan_id;
		$plan = Subscription::where(['id' => $planId])->first();
		try {

			if (empty($plan)) {
				throw new Exception("No plan found");
			}

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
				CURLOPT_POSTFIELDS => array('amount' => $plan->price_per_plan * 100, 'currency' => 'INR', 'receipt' => ''),
				CURLOPT_HTTPHEADER => array(
					'Authorization: Basic cnpwX3Rlc3RfcFhLa0FDME5GeU5OU0I6R29hYlVqZ0lXN1ZtcTZ4NGdpemVDanpN' //test
					// 'Authorization: Basic cnpwX2xpdmVfMGZucXhGVUt4clhOYVU6T044S1Q1UUN0SEJOTnp6ZU1PNlI4U21s'  //live
				),
			));
			//			'Authorization: Basic cnpwX2xpdmVfMGZucXhGVUt4clhOYVU6T044S1Q1UUN0SEJOTnp6ZU1PNlI4U21s'
			$response = curl_exec($curl);
			curl_close($curl);
			$response = json_decode($response);

			if (!empty($response->error->description)) {
				throw new Exception($response->error->description);
			}

			DB::table('payments')->insert(
				[
					'id' => $response->id,
					'plan_id' => $plan->id,
					'amount' => $plan->amount,
					'transaction_id' => $response->id,
					'payment_status' => 0,
					'created_by' => 1,
				]
			);

			$data = [];
			$data['id'] = $response->id;
			$data['amount'] = $response->amount;
			return $this->successWithData([], "Payment performed Successfully", $data);
		} catch (\Throwable $e) {
			return $this->error($e->getMessage());
		}
	}




	public function storePaymentDetail(Request $request)
	{

		$v = Validator::make(
			$request->input(),
			[
				"razorpay_payment_id" => "required",
				"razorpay_id" => "required",
				"razorpay_signature" => "required"
			]
		);
		if ($v->fails()) {
			return $this->validation($v);
		}

		//$session = AppLogin::where("session_id", "=", $session_id)->first();

		//if ($session) {
			try {


				$user =auth()->user();

				$paymentModel = Payment::where(["order_id" => $request->razorpay_order_id, "created_by_id" => $user->id,])->first();

				if (empty($paymentModel)) {
						throw new Exception("No subscription request found");
				}

				
					$plan = Subscription::where(['id' => $paymentModel->model_id])->first();
					if (!empty($plan)) {
						$key_id = "rzp_test_qDLQi8noYdGJcE";
						$key_secret = "pihp0ZDR7sgh8PmZ24Qy6Ef9";
						$api = new Api($key_id, $key_secret);

						//Add subscription on razorpay
						$currentTimestamp = strtotime("+15 minutes", time());
						//$subscription  = $api->subscription->create(array('plan_id' => $plan->razorpay_plan_id, 'customer_notify' => 1, 'total_count' => 6, 'start_at' => $currentTimestamp, 'addons' => array(array('item' => array('name' => 'Plan subscription', 'amount' => $paymentModel->amount* 100, 'currency' => 'INR')))));

						//verify payment Signature
						$attributes  = array('razorpay_signature'  => $request->razorpay_signature,  'razorpay_payment_id'  => $request->razorpay_payment_id,  'razorpay_order_id' => $request->razorpay_order_id);
						$order  = $api->utility->verifyPaymentSignature($attributes);

						$paymentModel->razorpay_payment_id = $request->razorpay_payment_id;
						$paymentModel->razorpay_order_id = $request->razorpay_order_id;
						$paymentModel->razorpay_signature = $request->razorpay_signature;
						$paymentModel->payment_status = 1;
						$paymentModel->save();
						//store subscription
						$this->addPlan($plan, $user->id);
						$statusCode = 200;
						$response = [
							"status_code" => 200, "error" => false,
							"userData" => $this->user_profile_response($user, $session_id),
							"message" => 'Your Premium Pack Activated Successfully for ₹' . $paymentModel->amount
						];
					} else {
						$response = ["status_code" => 200, "error" => false, "message" => "No plan found"];
					}
				// } else {
				// 	$response = ["status_code" => 200, "error" => false, "message" => "No payment found"];
				// }
			} catch (\Exception $e) {
				$response = ["status_code" => 200, "error" => true, "message" => $e->getMessage()];
			}
		// } else {
		// 	$statusCode = 403;

		// 	$response = ["status_code" => 403, "error" => true, "message" => "Session expired"];
		// }

		return response()->json($response, $statusCode, $headers = [], $options = JSON_PRETTY_PRINT);
	}
}
