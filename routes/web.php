<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\HospitalController;
use App\Http\Controllers\admin\ServiceController;
use App\Http\Controllers\admin\PermissionController;
use App\Http\Controllers\admin\UserRegisterController;
use App\Http\Controllers\admin\RolesController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\CustomerController;
use App\Http\Controllers\admin\CategoryController;

/*
|--------------------------------------------------------------------------
| Web Routes
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', [AdminController::class, 'Login']);
Route::post('/login', [AdminController::class, 'Adminlogin']);
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

      //******************************************Admin Manage Customers*********************************************//
        Route::get('/customer', [CustomerController::class, 'customerView'])->name('customer');


      //******************************************Admin Manage Category*********************************************//
        Route::get('/category', [CategoryController::class, 'categoryView'])->name('category');
        Route::post('/category/add', [CategoryController::class, 'storecategory'])->name('category.add');
        Route::get('/category/search', [CategoryController::class, 'searchcategory'])->name('category.search');
        Route::get('/category/delete', [CategoryController::class, 'deletecategory'])->name('category.delete');
        Route::get('/category/view/update', [CategoryController::class, 'view_update'])->name('category.view.update');
        Route::post('/category/update', [CategoryController::class, 'update_category'])->name('category.update');
        Route::get('/category/view/{id}', [CategoryController::class, 'detailView_category'])->name('category.view');
        Route::get('/category/update/status', [CategoryController::class, 'status_category'])->name('category.update.status');
        Route::get('/category/back',[CategoryController::class,'categoryBack']);
     //******************************************Admin Manage Sub Category*********************************************//
        Route::post('/subcategory/add', [CategoryController::class, 'store_sub_category'])->name('subcategory.add');


      //******************************************Admin Manage Services*********************************************//
      Route::get('/services', [ServiceController::class, 'serviceView'])->name('services');
      Route::post('/service/add', [ServiceController::class, 'storeservice'])->name('service.add');
      Route::get('/service/status', [ServiceController::class, 'status_service'])->name('service.status');
      Route::get('/service/delete', [ServiceController::class, 'deleteservice'])->name('service.delete');
      Route::get('/service/view/update', [ServiceController::class, 'view_update'])->name('service.view.update');
      Route::post('/service/update', [ServiceController::class, 'update_service'])->name('service.update');
      Route::get('/service/view/{id}', [ServiceController::class, 'detailView_service'])->name('service.view');
      Route::get('/search', [ServiceController::class, 'searchservice'])->name('search');
      Route::get('/service/back',[ServiceController::class,'serviceBack']);

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
