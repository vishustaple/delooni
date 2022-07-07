<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Payment;
use App\Models\Subscription;
use App\Models\Transactionw;
use App\Models\PrepareCheckoutLogs;
use App\Models\PaymentStatusLogs;
use App\Traits\ApiResponser;
use Illuminate\Support\Facades\Log;
use Exception;
use Illuminate\Support\Facades\DB;
use Devinweb\LaravelHyperpay\Facades\LaravelHyperpay;
use Illuminate\Support\Facades\Config;


class paymentController extends Controller
{
	use ApiResponser;
	public $paymentMode = '';
	public $productionMode = FALSE;
	public function __construct()
    {
        if( Config::get('constants.oppwa.SANDBOX_MODE') ){
			$this->paymentMode = 'production';
			$this->productionMode = TRUE;
		} else {
			$this->paymentMode = 'test';
		}
    }
	/*
	** Preparing checkout before payment
	*/
	public function checkout(Request $request)
    {
		$url = "https://eu-test.oppwa.com/v1/checkouts";
		$data = "entityId=$request->entity_id" .
					"&amount=$request->amount" .
					"&currency=$request->currency" .
					"&paymentType=$request->payment_type";

					
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
					'Authorization:Bearer OGE4Mjk0MTc0YjdlY2IyODAxNGI5Njk5MjIwMDE1Y2N8c3k2S0pzVDg='));
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);// this should be set to true in production
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$responseData = curl_exec($ch);
		if(curl_errno($ch)) {
			return curl_error($ch);
		}
		curl_close($ch);
		return $responseData;
	
    }
 
    /*
	**
	*/
    // public function paymentStatus(Request $request)
    // {

    // $url = "https://eu-test.oppwa.com/v1/checkouts/{$request->checkout_id}/payment";
	// $url .= "?entityId=$request->entity_id";

	// $ch = curl_init();
	// curl_setopt($ch, CURLOPT_URL, $url);
	// curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    //                'Authorization:$request->token'));
	// curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
	// curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);// this should be set to true in production
	// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	// $responseData = curl_exec($ch);
	// if(curl_errno($ch)) {
	// 	return curl_error($ch);
	// }
	// curl_close($ch);
	// return $responseData;
     
    // }
	

	// prepare checkout with opppwa
	public function prepareCheckout(Request $request)
	{
		try {
			$user = auth()->user();
		
			$url 		= Config::get('constants.oppwa.'.$this->paymentMode.'.URL.PREPARE-CHECKOUT');
			$entityId 	= Config::get('constants.oppwa.'.$this->paymentMode.'.ENTITY_ID');
			$accessToken= Config::get('constants.oppwa.'.$this->paymentMode.'.ACCESS_TOKEN');
			$currency 	= Config::get('constants.oppwa.'.$this->paymentMode.'.CURRENCY');
			 
			$amount = $request->amount;
			$paymentType = $request->payment_type;

			$testMode = $request->testMode;
			$merchantTransactionId = $request->merchantTransactionId;
			$customer_email = $request->customer_email;
			$billing_street1 = $request->billing_street1;
			$billing_city = $request->billing_city;
			$billing_state = $request->billing_state;

			$billing_country = $request->billing_country;
			$billing_postcode = $request->billing_postcode;
			$customer_givenName = $request->customer_givenName;
			$customer_surname = $request->customer_surname;
			
			// testMode=EXTERNAL
//- merchantTransactionId="your unique ID in your database"
//- customer.email = The user's email.
//- billing.street1= street address of customer
//- billing.city= should be city of customer
//- billing.state= should be state of customer
//- billing.country= should be country of customer (Alpha-2 codes with Format A2[A-Z]{2})
//- billing.postcode
//- customer.givenName
//- customer.surname

			$data = "entityId=".$entityId .
						"&amount=".$amount.
						"&currency=".$currency.
						"&paymentType=".$paymentType.
//						"&testMode=".$testMode.
						"&testMode=".$testMode.
						"&merchantTransactionId=".$merchantTransactionId.
						"&customer.email=".$customer_email.
						"&billing.street1=".$billing_street1.
						"&billing.city=".$billing_city.
						"&billing.state=".$billing_state.
						"&billing.country=".$billing_country.
						"&billing.postcode=".$billing_postcode.
						"&customer.givenName=".$customer_givenName.
						"&customer.surname=".$customer_surname.

			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(
						'Authorization:Bearer '.$accessToken));
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, $this->productionMode);// this should be set to true in production
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$responseData = curl_exec($ch);
			if(curl_errno($ch)) {
				return curl_error($ch);
			}
			curl_close($ch);
			$response = json_decode($responseData);
			$insert=new PrepareCheckoutLogs();
			$insert->code= $response->result->code;
			$insert->description = $response->result->description;
			$insert->buildnumber = $response->buildNumber;
			$insert->timestamp = $response->timestamp;
			$insert->ndc = $response->ndc;
            $insert->checkout_id = $response->id;
			$insert->user_id = $user->id??'';
			$insert->save();
			return $response;
		} catch (\Throwable $th) {
			return $this->error($th->getMessage());
		}
	}
    //checkour function with oppwa
	public function paymentStatus(Request $request)
	{
		try{
			$user=auth()->user();
			$id 		= $request->id;
			$_url 		= Config::get('constants.oppwa.'.$this->paymentMode.'.URL.PREPARE-CHECKOUT');
			$entityId 	= Config::get('constants.oppwa.'.$this->paymentMode.'.ENTITY_ID');
			$accessToken= Config::get('constants.oppwa.'.$this->paymentMode.'.ACCESS_TOKEN');

			$url      = $_url.'/'.$id.'/payment?entityId='.$entityId;
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(
						'Authorization:Bearer '.$accessToken));
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, $this->productionMode);// this should be set to true in production
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$responseData = curl_exec($ch);
			if(curl_errno($ch)) {
				return curl_error($ch);
			}
			curl_close($ch);
			$response = json_decode($responseData);
			$insert=new PaymentStatusLogs();
			$insert->code= $response->result->code;
			$insert->description = $response->result->description;
			$insert->buildnumber = $response->buildNumber;
			$insert->timestamp = $response->timestamp;
			$insert->ndc = $response->ndc;
			$insert->user_id = $user->id??'';
			$insert->save();
			return $response;
		} catch (\Throwable $th) {
			return $this->error($th->getMessage());
		}
	}
    
    public function Shopperresult(Request $request){
   	
	 	Log::info("\n----- shooper url log here ------\n");
	 	Log::info("------- ".time()." ------ ".$request->method()." ------- \n");
	 	Log::info(json_encode($request->all()));
	 	Log::info("\n----- shooper url log end here ------\n");

		return $this->success('success!');
	}
}

