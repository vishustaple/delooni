<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Payment;
use App\Models\Subscription;
use App\Models\Transactionw;
use App\Traits\ApiResponser;
use Exception;
use Illuminate\Support\Facades\DB;
use Devinweb\LaravelHyperpay\Facades\LaravelHyperpay;


class paymentController extends Controller
{
	use ApiResponser;


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
    public function paymentStatus(Request $request)
    {

    $url = "https://eu-test.oppwa.com/v1/checkouts/{$request->checkout_id}/payment";
	$url .= "?entityId=$request->entity_id";

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                   'Authorization:$request->token'));
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);// this should be set to true in production
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$responseData = curl_exec($ch);
	if(curl_errno($ch)) {
		return curl_error($ch);
	}
	curl_close($ch);
	return $responseData;
     
    }
    
	
}
