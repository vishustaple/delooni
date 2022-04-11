<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\HospitalController;
use App\Http\Controllers\admin\PermissionController;
use App\Http\Controllers\admin\UserRegisterController;
use App\Http\Controllers\admin\RolesController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\ServiceProviderController;

/*
|--------------------------------------------------------------------------
| Web Routes
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//*****************************verify email*******************//
Route::get('verify-email', [AdminController::class, 'VerifyEmail']);

Route::get('/', [AdminController::class, 'login']);
Route::post('/login', [AdminController::class, 'Adminlogin'])->name('login');
Route::get('/forgot-password', [HospitalController::class, 'forgotpwdView'])->name('forgot');
Route::post('/forgotpwd', [HospitalController::class, 'forgotPassword'])->name('forgotpwd');

Route::group(['prefix' => 'admin'], function () {
    Route::middleware([
        'prefix' => 'AuthCheck'
    ])->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::get('/profile', [AdminController::class, 'adminProfile']);
        Route::get('/logout', [AdminController::class, 'Logout']);

        //********************************************User*******************************************//
        Route::get('/user', [UserRegisterController::class, 'viewUser'])->name('view-user');
        Route::post('/user/adduser', [UserRegisterController::class, 'addUser']);
        Route::post('/user/togglestatus', [UserRegisterController::class, 'ToggleUserStatus'])->name('user.update.status');
        Route::get('/user/viewdata/{id}', [UserRegisterController::class, 'viewData'])->name('user.viewData');
        Route::get('/user/back', [UserRegisterController::class, 'UserBack']);
        Route::get('/user/updateuser', [UserRegisterController::class, 'UpdateUser'])->name('user.updateuser');
        Route::post('/user/updateuserdata', [UserRegisterController::class, 'UpdateUserData'])->name('user.updateuserdata');
        Route::get('/user/search', [UserRegisterController::class, 'filter'])->name('user.search');
        Route::get('/user/remove', [UserRegisterController::class, 'UserRemove'])->name('user.remove');

        //********************************************Assign Roles Routes*******************************************//
        Route::get('manage-users/create', [UserController::class, 'create'])->name('manage-users-create');
        Route::post('manage-users/store', [UserController::class, 'store'])->name('manage-users-store');
        Route::get('manage-users/edit', [UserController::class, 'edit'])->name('manage-users-edit');
        Route::get('manage-users/destroy/{id}', [UserController::class, 'destroy'])->name('manage-users-destroy');
        Route::post('manage-users/update/{id}', [UserController::class, 'update'])->name('manage-users-update');
        Route::get('manage-users', [UserController::class, 'index'])->name('manage-users');
        Route::post('/updateProfile', [AdminController::class, 'updateProfile'])->name('admin.updateProfile');

        //******************************************Admin Profile*********************************************//
        Route::post('/profile/changePassword', [UserRegisterController::class, 'changePassword'])->name('users-change-password');
        Route::post('/profile/changeProfileImage', [UserRegisterController::class, 'changeProfileImage'])->name('users-change-image');
    });
    Route::get('/user/includes/addform', function () {
        return view('admin.user.includes.addform');
    });
});

//******************************************Permissions*********************************************//
Route::resource('permissions', PermissionController::class);

//***********************************************Role************************************************//
Route::resource('roles', RolesController::class);


/*********************************************Service Provider*******************************************************/
Route::get('/serviceprovider', [ServiceProviderController::class, 'ViewServiceProvider'])->name('viewserviceprovider');
Route::post('/addserviceprovider', [ServiceProviderController::class, 'AddServiceProvider'])->name('provider.add');
Route::post('/serviceprovider/togglestatus', [ServiceProviderController::class, 'ToggleProviderStatus'])->name('provider.status');


