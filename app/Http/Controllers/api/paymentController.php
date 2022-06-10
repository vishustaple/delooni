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
		$trackable_data = [
			'product_id'=> 'bc842310-371f-49d1-b479-ad4b387f6630',
            'product_type' => 't-shirt'
        ];
        $user = User::where('id', $request->user_id)->first();
        $amount = 10;
        $brand = 'VISA'; // MASTER OR MADA

        return LaravelHyperpay::checkout($trackable_data, $user, $amount, $brand, $request);
    }
    /*
	** Payment form 
	*/
	public function paymentform()
    {
        return view('admin.paymentform');
    }
    /*
	**
	*/
    public function paymentStatus(Request $request)
    {
        $resourcePath = $request->get('resourcePath');
        $checkout_id = $request->get('id');
        return LaravelHyperpay::paymentStatus($resourcePath, $checkout_id);
    }
    
	public function finalize(){
		return view('admin.finalize');

	}
	
}
