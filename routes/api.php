<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\ListController;
use App\Http\Controllers\api\paymentcontroller;
use App\Http\Controllers\admin\RolesPermissionsController;
use App\Http\Controllers\api\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
/********************************* Un-Authenticate Api's ******************************/
Route::post('register', [UserController::class, 'register']);
//Route::post('login',[UserController::class, 'login']);
//Route::post('forgot-password',[UserController::class, 'forgotPassword']);


//to show error when user not logged in --- used in middleware(Authenticate)
Route::any('login-check', [UserController::class, 'loginCheck'])->name('login-check');

Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', [UserController::class, 'logout']);
    Route::get('get-notification', [ListController::class, 'GetNotification']);
    Route::post('notification-status', [UserController::class, 'NotificationStatus']);
    Route::post('change-password', [UserController::class, 'changePassword']);
    /******************************* Customer User Api **********************************************/
    Route::get('get-customer-profile', [UserController::class, 'getCustomerProfile']);
    Route::post('update-customer-detail', [UserController::class, 'updateCustomerDetail']);
    Route::post('contact-us', [UserController::class, 'contactUs']);
    Route::post('report', [UserController::class, 'report']);
    Route::post('user-rating', [UserController::class, 'userRating']);
    Route::post('add-favourite-service', [UserController::class, 'addRemoveFavourite']);
    Route::get('get-favourite-service', [ListController::class, 'getFavourite']);
    Route::post('service-filteration', [ListController::class, 'servicesFilteration']);
    Route::post('search', [ListController::class, 'search']);


    /******************************* Service Provider User Api **********************************************/
    Route::post('add-service', [UserController::class, 'addService']);
    Route::post('complete-profile', [UserController::class, 'completeProfile']);
    Route::post('update-sprovider-profile', [UserController::class, 'updateSpProfile']);
    Route::get('get-provider-profile', [UserController::class, 'providerDetail']);
    Route::get('view-sprofile', [UserController::class, 'viewDetail']);
    Route::post('update-spimage', [UserController::class, 'updatespImage']);


    /******************************* Common Api **********************************************/
    Route::get('get-categories', [ListController::class, 'getcategories']);
    Route::post('get-sub-categories', [ListController::class, 'getSubcategories']);
    Route::get('transaction-history', [ListController::class, 'getTransactionHistory']);
});
Route::get('plan-list', [ListController::class, 'Planlist']);
Route::get('subscription-list', [ListController::class, 'SubscriptionList']);
Route::post('send-otp', [UserController::class, 'sendOtp']);
Route::get('active-countries-list', [ListController::class, 'activeCountryList']);
Route::post('verify-otp', [UserController::class, 'verifyOtp']);



    /******************************* Razorpay Payment Gateway Api **********************************************/
    Route::post('razorpayPayment', [paymentController::class, 'razorpayPayment']);
    Route::get('/show/{id}', [paymentController::class, 'show']);
    Route::post('storepayment', [UserController::class, 'storepayment']);
    
