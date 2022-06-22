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
use App\Http\Controllers\admin\SubscriptionController;
use App\Http\Controllers\admin\ServiceProviderController;
use App\Http\Controllers\admin\MainScreenController;
use App\Http\Controllers\admin\ReportController;
use App\Http\Controllers\admin\StaticContentController;
use App\Http\Controllers\admin\PaymentController;
use App\Http\Controllers\admin\CountryCityController;
use App\Http\Controllers\admin\ContactController;
use App\Http\Controllers\admin\RatingController;
/*
|--------------------------------------------------------------------------
| Web Routes
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//*****************************verify email*******************//
Route::get('terms-condition',[AdminController::class, 'termsAndCondition']);
Route::get('verify-email', [AdminController::class, 'VerifyEmail']);

Route::get('/', [AdminController::class, 'login']);
Route::post('/login', [AdminController::class, 'Adminlogin'])->name('login');
Route::get('/forgot-password', [AdminController::class, 'forgotpwdView'])->name('forgot');
Route::post('/forgotpwd', [AdminController::class, 'forgotPassword'])->name('forgotpwd');
Route::get('/resetpwd/{token}', [AdminController::class, 'resetPassword'])->name('resetpwd');
Route::post('/updatepwd', [AdminController::class, 'updatePassword'])->name('updatepwd');


Route::group(['prefix' => 'admin'], function () {
    Route::middleware([
        'prefix' => 'AuthCheck'
    ])->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::post('/dashboardrange', [AdminController::class, 'DashboardDateRange'])->name('dashboarddaterange');
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
        Route::post('/customer/add', [CustomerController::class, 'storecustomer'])->name('customer.add');
        Route::get('/customer/update/status', [CustomerController::class, 'status_customer'])->name('customer.update.status');
        Route::get('/customer/delete', [CustomerController::class, 'deletecustomer'])->name('customer.delete');
        Route::get('/customer/view/{id}', [CustomerController::class, 'detailView_customer'])->name('customer.view');
        Route::get('/update', [CustomerController::class, 'view_update'])->name('update');
        Route::post('/customer/update', [CustomerController::class, 'update_customer'])->name('customer.update');
        Route::get('/customer/search', [CustomerController::class, 'search_customer'])->name('customer.search');
        Route::get('/customer/back',[CustomerController::class,'customerBack']);
        Route::post('/customer/data',[CustomerController::class,'customerDateRange'])->name('customerdaterange');


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
        Route::get('/subcategory', [CategoryController::class, 'subcategoryView'])->name('subcategory');
        Route::post('/subcategory/add', [CategoryController::class, 'store_sub_category'])->name('subcategory.add');
        Route::get('/subcategory/view/update', [CategoryController::class, 'view_update_subcategory'])->name('subcategory.view.update');
        Route::post('/subcategory/update', [CategoryController::class, 'update_subcategory'])->name('subcategory.update');
        Route::get('/subcategory/view/{id}', [CategoryController::class, 'detailView_subcategory'])->name('subcategory.view');
        Route::get('/subcategory/search', [CategoryController::class, 'searchsubcategory'])->name('subcategory.search');
        Route::get('/subcategory/back',[CategoryController::class,'subcategoryBack']);
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
      Route::get('/service/category/{id}', [ServiceController::class, 'subcategory'])->name('service.category');

      //******************************************Admin Manage Main screen*********************************************//
      Route::get('/splashscreen', [MainScreenController::class, 'splash_screen_View'])->name('splashscreen');
      Route::post('/splash/screen/add', [MainScreenController::class, 'storeScreen'])->name('splash.screen.add');
      Route::get('/screen/view/update', [MainScreenController::class, 'view_update'])->name('screen.view.update');
      Route::get('/splash/screen/delete', [MainScreenController::class, 'deletescreen'])->name('splash.screen.delete');
      Route::post('/screen/update', [MainScreenController::class, 'update_screen_image'])->name('screen.update');
      Route::get('/splash/screen/search', [MainScreenController::class, 'searchscreen'])->name('splash.screen.search');
      Route::get('/screen/view/{id}', [MainScreenController::class, 'detail_screen'])->name('screen.view');

      //******************************************Admin export excel file of Report*********************************************//
      Route::get('/report', [ReportController::class, 'report_View'])->name('report');
      Route::get('/userexport',[ReportController::class,'export_user'])->name('userexport');
      Route::get('/queryexport',[ReportController::class,'export_query'])->name('queryexport');
      Route::get('/maxqueryexport',[ReportController::class,'export_max_query'])->name('maxqueryexport');
      Route::get('/minqueryexport',[ReportController::class,'export_min_query'])->name('minqueryexport');
      Route::get('/maxtwentyexport',[ReportController::class,'export_max_twenty_query'])->name('maxtwentyexport');
      Route::get('/mintwentyexport',[ReportController::class,'export_min_twenty_query'])->name('mintwentyexport');
      Route::get('/maxproviderexport',[ReportController::class,'export_max_provider'])->name('maxproviderexport');
      Route::get('/toptwentymaxproviderexport',[ReportController::class,'export_toptwenty_max_provider'])->name('toptwentymaxproviderexport');
      Route::get('/reviewsexport',[ReportController::class,'reviews_export'])->name('reviewsexport');
      Route::get('/contactexport',[ReportController::class,'contact_export'])->name('contactexport');
      Route::get('/contactinqueriesexport',[ReportController::class,'contact_inqueries_export'])->name('contactinqueriesexport');
      Route::get('/contactsupportexport',[ReportController::class,'contact_support_export'])->name('contactsupportexport');
      Route::get('/customerexport',[ReportController::class,'customer_export'])->name('customerexport');
      Route::get('/providerexport',[ReportController::class,'provider_export'])->name('providerexport');
      //******************************************Admin View Query*********************************************//
      Route::get('/query', [ReportController::class, 'query_View'])->name('query');
      Route::get('/query/delete', [ReportController::class, 'delete_query'])->name('query.delete');
      Route::get('/query/search', [ReportController::class, 'search_query'])->name('query.search');
      Route::get('/query/view/{id}', [ReportController::class, 'detailView_query'])->name('query.view');
      Route::get('/query/back',[ReportController::class,'queryBack']);
      //******************************************Admin contact Query*********************************************//
      Route::get('/contactquery', [ContactController::class, 'ContactQueryView'])->name('contactquery');
      Route::get('/contactquery/view/{id}', [ContactController::class, 'detailContactView_query'])->name('contactquery.view');
      Route::get('/contactquery/back',[ContactController::class,'ContactQueryBack']);
      Route::get('/contactquery/delete', [ContactController::class, 'delete_contact_query'])->name('contactquery.delete');
      Route::get('/contactquery/search', [ContactController::class, 'search_contact_query'])->name('contactquery.search');

      //******************************************Rating & Review*********************************************//
      Route::get('/rating', [RatingController::class, 'RatingView'])->name('rating');
      Route::get('/rating/view/{id}', [RatingController::class, 'RatingDetailView'])->name('rating.view');
      Route::get('/rating/back',[RatingController::class,'RatingBack']);
      Route::get('/rating/delete', [RatingController::class, 'RatingDelete'])->name('rating.delete');

      //******************************************Terms and condition*********************************************//
      Route::get('/staticcontent', [StaticContentController::class, 'static_content_View'])->name('staticcontent');
      Route::post('/static/content/add', [StaticContentController::class, 'storeContent'])->name('static.content.add');
      Route::get('/static/content/delete', [StaticContentController::class, 'delete_content'])->name('static.content.delete');
      Route::get('/content/view/update', [StaticContentController::class, 'view_update'])->name('content.view.update');
      Route::post('/content/update', [StaticContentController::class, 'update_content'])->name('content.update');
      Route::get('/content/view/{id}', [StaticContentController::class, 'detailView_content'])->name('content.view');
      Route::get('/content/back', [StaticContentController::class, 'ContentBack']);
      //****************************************** Screen Baner Image *********************************************//
      Route::get('/condition', [StaticContentController::class, 'condition_View'])->name('condition');
      Route::get('/condition/view/update', [StaticContentController::class, 'condition_update'])->name('condition.view.update');
      Route::post('/condition/update', [StaticContentController::class, 'update_condition'])->name('condition.update');
      Route::get('/condition/view/{id}', [StaticContentController::class, 'detailView_condition'])->name('condition.view');

      //******************************************Admin Manage Subscription*********************************************//
      Route::get('/subscription', [SubscriptionController::class, 'subscriptionView'])->name('subscription');
      Route::post('/subscription/add', [SubscriptionController::class, 'storesubscription'])->name('subscription.add');
      Route::get('/subscription/status', [SubscriptionController::class, 'status_subscription'])->name('subscription.status');
      Route::get('/subscription/search', [SubscriptionController::class, 'searchsubscription'])->name('subscription.search');
      Route::get('/subscription/delete', [SubscriptionController::class, 'delete_subscription'])->name('subscription.delete');
      Route::get('/subscription/view/update', [SubscriptionController::class, 'view_update'])->name('subscription.view.update');
      Route::post('/subscription/update', [SubscriptionController::class, 'update_subscription'])->name('subscription.update');
      Route::get('/subscription/view/{id}', [SubscriptionController::class, 'detailView_subscription'])->name('subscription.view');
      Route::get('/subscription/back', [SubscriptionController::class, 'SubscriptionBack']);
       //******************************************Admin Profile*********************************************//
        Route::post('/profile/changePassword', [UserRegisterController::class, 'changePassword'])->name('users-change-password');
        Route::post('/profile/changeProfileImage', [UserRegisterController::class, 'changeProfileImage'])->name('users-change-image');
          //****************************************** Manage Cities *********************************************//
        Route::get('/cities', [CountryCityController::class, 'CitiesView'])->name('view-cities');
        Route::post('/city/addcity', [CountryCityController::class, 'addCity'])->name('city.add');
        Route::post('/city/togglestatus', [CountryCityController::class, 'ToggleCityStatus'])->name('city.update.status');
        Route::get('/city/viewcity/{id}', [CountryCityController::class, 'viewCity'])->name('city.viewData');
        Route::get('/city/back', [CountryCityController::class, 'CityBack']);
        Route::get('/city/updatecity', [CountryCityController::class, 'UpdateCity'])->name('city.updatecity');
        Route::post('/city/updatecitydata', [CountryCityController::class, 'UpdateCityData'])->name('city.updatecitydata');
        Route::get('/city/search', [CountryCityController::class, 'filter'])->name('city.search');
        Route::get('/city/remove', [CountryCityController::class, 'CityRemove'])->name('city.remove');
       });
       Route::get('/user/includes/addform', function () {
        return view('admin.user.includes.addform');
       });
       });


/*********************************************Service Provider*******************************************************/
Route::get('/serviceprovider', [ServiceProviderController::class, 'ViewServiceProvider'])->name('viewserviceprovider');
Route::get('/formserviceprovider', [ServiceProviderController::class, 'addformServiceProvider'])->name('serviceproviderform');
Route::post('/addserviceprovider', [ServiceProviderController::class, 'AddServiceProvider'])->name('provider.add');
Route::post('/serviceprovider/togglestatus', [ServiceProviderController::class, 'ToggleProviderStatus'])->name('provider.status');
Route::get('/viewserviceprovider/{id}', [ServiceProviderController::class, 'ViewServiceProviderData'])->name('provider.viewdata');
Route::get('/serviceproviderback', [ServiceProviderController::class, 'ServiceProviderBack']);
Route::get('/serviceprovider/search', [ServiceProviderController::class, 'filter'])->name('provider.search');
Route::get('/serviceprovider/remove', [ServiceProviderController::class, 'ServiceProviderRemove'])->name('provider.remove');
Route::get('/providerupdateform/{id}', [ServiceProviderController::class, 'UpdateForm'])->name('provider.updateform');
Route::post('/updateproviderdata', [ServiceProviderController::class, 'UpdateProviderData'])->name('provider.updateproviderdata');
Route::get('/category/{id}', [ServiceProviderController::class, 'GetCategory'])->name('provider.category');
Route::get('/deletedproviders', [ServiceProviderController::class, 'RemovedProviders'])->name('provider.removed');
Route::get('/removeuser/search', [ServiceProviderController::class, 'RemoveUserSearch'])->name('removeduser.search');


Route::get('/company', [ServiceProviderController::class, 'company_view'])->name('company');
Route::get('/provider/company/search', [ServiceProviderController::class, 'search_company'])->name('provider.company.search');
Route::post('/provider/data',[ServiceProviderController::class,'providerDateRange'])->name('providerdaterange');
Route::post('/companyprovider/data',[ServiceProviderController::class,'companyDateRange'])->name('companydaterange');

    //******************************************  Payment  *********************************************//
    Route::get('/payment', [PaymentController::class, 'payment_view'])->name('payment');
    Route::get('/payment/delete', [PaymentController::class, 'payment_remove'])->name('payment.delete');
    Route::get('/payment/search', [PaymentController::class, 'searchpayment'])->name('payment.search');
    Route::get('/payment/view/{id}', [PaymentController::class, 'detailView_payment'])->name('payment.view');
    Route::get('/payment/back', [PaymentController::class, 'paymentBack'])->name('payment.back');


    Route::get('hyperpay/finalize', [paymentcontroller::class,'finalize']);
  