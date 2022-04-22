<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\ListController;
use App\Http\Controllers\admin\RolesPermissionsController;
use App\Http\Controllers\admin\RolesController;
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
Route::get('terms-condition',[AdminController::class, 'termsAndCondition']);
/********************************* General Api's ******************************/
Route::post('register',[UserController::class, 'register']);
Route::post('login',[UserController::class, 'login']);
Route::post('forgot-password',[UserController::class, 'forgotPassword']);
Route::post('send-otp',[UserController::class, 'sendOtp']);
Route::post('verify-otp',[UserController::class, 'verifyOtp']);
Route::get('active-countries-list',[UserController::class, 'activeCountryList']);
/**********(Service Provider User) Get Categories And Sub-Categories of Services ****************/
Route::get('get-categories',[UserController::class, 'getcategories']);
Route::post('get-sub-categories',[UserController::class, 'getSubcategories']);

//to show error when user not logged in --- used in middleware(Authenticate)
Route::any('login-check',[UserController::class, 'loginCheck'])->name('login-check');

Route::middleware('auth:sanctum')->group( function () {
    Route::post('logout',[UserController::class, 'logout']);
    Route::get('get-notification',[listController::class, 'GetNotification']);
    Route::post('notification-status',[UserController::class, 'NotificationStatus']);
    Route::post('change-password',[UserController::class, 'changePassword']);
    Route::post('search',[UserController::class, 'search']);
/******************************* Customer User Api **********************************************/
    Route::get('get-customer-profile',[UserController::class, 'getCustomerProfile']);
    Route::post('update-customer-detail',[UserController::class, 'updateCustomerDetail']);
    Route::post('contact-us',[UserController::class, 'contactUs']);
    Route::post('report',[UserController::class, 'report']);
    Route::post('user-rating',[UserController::class, 'userRating']);
    Route::post('add-favourite-service',[UserController::class, 'addFavourite']);
    Route::get('get-favourite-service',[UserController::class, 'getFavourite']);
    Route::post('service-filteration',[UserController::class, 'servicesFilteration']);
    
    
/******************************* Service Provider User Api **********************************************/
    Route::post('add-service-detail',[UserController::class, 'addServiceDetails']);
    Route::post('complete-profile',[UserController::class, 'completeProfile']);
    Route::post('update-sprovider-profile',[UserController::class, 'updateSpProfile']);
});

Route::resource('rolesPermission', RolesPermissionsController::class);

