<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\HospitalController;
use App\Http\Controllers\admin\JobsController;
use App\Http\Controllers\admin\PermissionController;
use App\Http\Controllers\admin\UserRegisterController;
use App\Http\Controllers\admin\StaffController;
use App\Models\Admin;

/*
|--------------------------------------------------------------------------
| Web Routes
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use App\Http\Controllers\admin\permissionsController;
use App\Http\Controllers\admin\RolesController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\RolesPermissionsController;

Route::get('/admin', [AdminController::class, 'Login'])->middleware(["CustomAuthCheck"]);
Route::post('/login', [AdminController::class, 'Login'])->middleware(["CustomAuthCheck"]);
Route::get('/', [HospitalController::class, 'hospitalLogin'])->middleware(["CustomAuthCheck"])->name('hospital');
Route::post('/hospital', [HospitalController::class, 'hospitalLogin'])->middleware(["CustomAuthCheck"])->name('hospital');
Route::get('/hospitalSignup', [HospitalController::class, 'hospitalSignup'])->name('hospitalSignup');
Route::post('/hospitalRegister', [HospitalController::class, 'hospitalRegister']);
Route::get('/forgot-password', [HospitalController::class, 'forgotpwdView'])->name('forgot');
Route::post('/forgotpwd', [HospitalController::class, 'forgotPassword'])->name('forgotpwd');



Route::get('/agency', [AdminController::class, 'AgencyLogin']);
Route::post('/agency', [AdminController::class, 'AgencyLogin']);
Route::group(['prefix' => 'admin'], function () {
    Route::middleware([
        'prefix' => 'AuthCheck'
    ])->group(function () {

        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        });

        Route::get('/home', [AdminController::class,'home']);
        Route::get('/profile', [AdminController::class,'adminProfile']);
        // Route::get('/staff', [AdminController::class,'staffList']);
        Route::get('/revenue', [AdminController::class,'adminRevenue']);
        Route::post('/staff/toggleStatus',[AdminController::class,'toggleStaffStatus']);
        Route::post('/staff/add',[AdminController::class,'addStaff']);
        Route::post('/save/staff',[AdminController::class,'saveStaff'] );


        Route::get('/dashboard', function () {
        return view('admin.dashboard');
    });

    
       
    Route::get('/dark', function () {
        return view('dashboard.dashboard_dark');
    });
    
    Route::get('/light', function () {
        return view('dashboard.dashboard_light');
    });
    
    Route::get('/custom', function () {
        return view('dashboard.dashboard_custom');
    });

    Route::get('/logout',[AdminController::class,'Logout']);
    //***********************user ********************//
    Route::get('/user',[UserRegisterController::class,'viewUser'])->name('view-user');
    Route::post('/user/adduser',[UserRegisterController::class,'addUser']);
    Route::post('/user/togglestatus',[UserRegisterController::class,'ToggleUserStatus'])->name('user.update.status');
    Route::get('/user/viewdata/{id}',[UserRegisterController::class,'viewData'])->name('user.viewData');
    Route::get('/user/back',[UserRegisterController::class,'UserBack']);
    Route::get('/user/updateuser',[UserRegisterController::class,'UpdateUser'])->name('user.updateuser');
    Route::post('/user/updateuserdata',[UserRegisterController::class,'UpdateUserData'])->name('user.updateuserdata');
    Route::get('/user/search',[UserRegisterController::class,'filter'])->name('user.search');
    Route::get('/user/remove',[UserRegisterController::class,'UserRemove'])->name('user.remove');
    
//********************************************manage-users*******************************************//
Route::get('manage-users/create', [UserController::class, 'create'])->name('manage-users-create');
Route::post('manage-users/store', [UserController::class, 'store'])->name('manage-users-store');
Route::get('manage-users/edit', [UserController::class, 'edit'])->name('manage-users-edit');
Route::get('manage-users/destroy/{id}', [UserController::class, 'destroy'])->name('manage-users-destroy');
Route::post('manage-users/update/{id}', [UserController::class, 'update'])->name('manage-users-update');
Route::get('manage-users', [UserController::class, 'index'])->name('manage-users');


        Route::post('/updateProfile', [AdminController::class, 'updateProfile'])->name('admin.updateProfile');


        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        });



        Route::get('/dark', function () {
            return view('dashboard.dashboard_dark');
        });

        Route::get('/light', function () {
            return view('dashboard.dashboard_light');
        });

        Route::get('/custom', function () {
            return view('dashboard.dashboard_custom');
        });

        Route::get('/logout', [AdminController::class, 'Logout']);
        

        //********************************************user *****************************************//
        Route::get('/user', [UserRegisterController::class, 'viewUser'])->name('view-user');
        Route::post('/user/adduser', [UserRegisterController::class, 'addUser']);
        Route::post('/user/togglestatus', [UserRegisterController::class, 'ToggleUserStatus'])->name('user.update.status');
        Route::get('/user/viewdata/{id}', [UserRegisterController::class, 'viewData'])->name('user.viewData');
        Route::get('/user/back', [UserRegisterController::class, 'UserBack']);
        Route::get('/user/updateuser', [UserRegisterController::class, 'UpdateUser'])->name('user.updateuser');
        Route::post('/user/updateuserdata', [UserRegisterController::class, 'UpdateUserData'])->name('user.updateuserdata');
        Route::get('/user/search', [UserRegisterController::class, 'filter'])->name('user.search');
        Route::get('/user/remove', [UserRegisterController::class, 'UserRemove'])->name('user.remove');
        //******************************************Profile*********************************************//
        Route::post('/profile/changePassword', [UserRegisterController::class, 'changePassword'])->name('users-change-password');
        Route::post('/profile/changeProfileImage', [UserRegisterController::class, 'changeProfileImage'])->name('users-change-image');
    });
    Route::get('/user/includes/addform', function () {
        return view('admin.user.includes.addform');
    });
});

//******************************************Permissions*********************************************//

// follow  resource controller rule

Route::resource('permissions', PermissionController::class);
//***********************************************role************************************************//

Route::resource('roles', RolesController::class);

// //*****************************************roles-permissions****************************************//


