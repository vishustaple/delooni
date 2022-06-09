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
use Devinweb\LaravelHyperpay\Facades\LaravelHyperpay;


class paymentController extends Controller
{
	use ApiResponser;


	/*
	** Preparing checkout before payment
	*/
	public function prepareCheckout(Request $request)
    {
		$trackable_data = [
			'product_id'=> 'bc842310-371f-49d1-b479-ad4b387f6630',
            'product_type' => 't-shirt'
        ];
		//dd("here");
        $user = User::where('id', $request->user_id)->first();
        $amount = 10;
        $brand = 'VISA'; // MASTER OR MADA

		// echo "<pre>"; print_r(LaravelHyperpay::checkout($trackable_data, $user, $amount, $brand, $request));die;
		// dd("kfdjdlksfjl");
        return LaravelHyperpay::checkout($trackable_data, $user, $amount, $brand, $request);
    }
}
