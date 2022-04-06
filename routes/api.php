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


Route::post('send-otp',[UserController::class, 'sendOtp']);

# ----  old ------------
Route::post('register',[UserController::class, 'register']);
Route::post('login',[UserController::class, 'login']);

Route::post('forgot-password',[UserController::class, 'forgotPassword']);

Route::post('verify-otp',[UserController::class, 'verifyOtp']);

//to show error when user not logged in --- used in middleware(Authenticate)
Route::get('login-check',[UserController::class, 'loginCheck'])->name('login');

Route::middleware('auth:sanctum')->group( function () {
    Route::post('change-password',[UserController::class, 'changePassword']);
    Route::get('accept-job', [ListController::class, 'acceptJob']);

//invite    
// Route::post('invite',[UC::class, 'invite']);
// Route::post('update-profile', [UserController::class, 'updateProfile']);
// //general
 Route::post('complete-profile',[UserController::class, 'completeProfile']);
 Route::get('ideal-scheduleList',[UserController::class, 'idealScheduleList']);

 Route::get('secondStepDefaultList', [ListController::class, 'secondStepDefaultList']);
 Route::get('getJobRequest', [ListController::class, 'getJobRequest']);
});

Route::resource('rolesPermission', RolesPermissionsController::class);
// Route::resources('rolesPermission/create', RolesPermissionsController::class);

