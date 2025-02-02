<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\FavouriteServices;
use App\Models\Notification;
use App\Models\Services;
use App\Models\User;
use App\Models\UserRating;
use App\Models\Subscription;
use App\Models\Payment;
use App\Models\ServiceCategory;
use App\Models\StaticContent;

//facades
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
//traits
use App\Traits\ApiResponser;
use App\Traits\ImageUpload;
use App\Traits\Email;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\TryCatch;
use Validator;

class ListController extends Controller
{
    use ApiResponser;
    use ImageUpload;
    use Email;

    /**
     * Get category list  
     * @return response success or fail
     */
    public function getcategories()
    {
        $categories = ServiceCategory::where('is_parent', ServiceCategory::IS_PARENT)->with('subcategories')->paginate();
        $getbanners = StaticContent::get()->toArray();
        return $this->customPaginator($categories, 'jsonData', ['service_banners' => $getbanners]);
    }

    /**
     * Get Sub-Categories List
     *
     * @param  $r request contains data to show list of sub categories
     * @return response success or fail
     */
    // public function getSubcategories(request $r)
    // {
    //     $v = Validator::make(
    //         $r->input(),
    //         [
    //             'category' => 'required',
    //         ]
    //     );
    //     if ($v->fails()) {
    //         return $this->validation($v);
    //     }
    //     $categories = ServiceCategory::where('name', $r->category)->first();
    //     $subcategories = ServiceCategory::where('is_parent', $categories->id)->paginate();
    //     return $this->customPaginator($subcategories, 'jsonData');
    // }

    /**
     * get favorite 
     *
     * @param  send auth id 
     * @return response get favourite service provider by user 
     */
    public function getFavourite(request $r)
    {
        $user = auth()->user();
        $favourite = FavouriteServices::where('user_id', $user->id)->paginate();
        return $this->customPaginator($favourite, 'jsonData');
    }

    public function servicesFilteration(request $r)
    {

        $user = auth()->user();

        $v = Validator::make(
            $r->input(),
            [
                // 'userId' => 'required|numeric', //service provider id
                'rating' => 'required',
            ]
        );
        if ($v->fails()) {
            return $this->validation($v);
        }
        if ($r->rating) {

            $userrate = UserRating::whereBetween('rating', [$r->rating, UserRating::MAX_RATING])->paginate();

            return $this->customPaginator($userrate, 'jsonData');
        }
        if ($r->price) {
        }
    }

    public function activeCountryList(Request $request)
    {
        $query = Country::paginate(500);
        return $this->customPaginator($query, 'jsonData');
    }
    public function search(request $r)
    {
        $v = Validator::make(
            $r->input(),
            [
                'latitude' => 'required',
                'longitude' => 'required',
            ]
        );
        if ($v->fails()) {
            return $this->validation($v);
        }
        $search = $r->search;
        $rating = $r->rating;
        $pricePerHour = $r->price_per_hour;
        $latitude = $r->latitude;
        $longitude = $r->longitude;

        $radius = 5000;
        $paginate = User::select("users.*", \DB::raw("6371 * acos(cos(radians(" . $latitude . "))
        * cos(radians(latitude)) * cos(radians(longitude) - radians(" . $longitude . "))
        + sin(radians(" . $latitude . ")) * sin(radians(latitude))) AS distance"))
            ->having('distance', '<', $radius)->where('form_step', User::FORM_COMPLETED);
           
            
            $paginate = $paginate->where(function ($query) use ($search) {
                $query->where('first_name', 'like', "%$search%")
                    // ->orWhere('business_name', 'like', "%$search%")
                    ->orWhere('last_name', 'like', "%$search%");
            });
           
          
            if (!empty($pricePerHour)) {
                $paginate = $paginate->whereBetween('price_per_hour', [User::MIN_PRICE, $pricePerHour]);
                
            }

            $userId = DB::table('model_has_roles')->where('role_id', User::ROLE_SERVICE_PROVIDER)->pluck('model_id')->toArray();
            $paginate->whereIn('id', $userId);
            if (!empty($search)) {
                $catId = ServiceCategory::where('name','like' ,"%$search%")->pluck('id')->toArray();
                if(!empty($catId)){
             
                  $catuser= $paginate->whereIn('sub_cat_id', $catId)->pluck('id')->toArray();     
                  $planuser=Payment::orwhereIn('created_by', $catuser)->pluck('created_by')->toArray();
                  $paginate->orwhereIn('id', $planuser)->orwhereIn('sub_cat_id', $catId);
                  
                }
            }
            if (!empty($rating)) {
                $paginate= $paginate->where('rating',$rating);
             }

            return $this->customPaginator($paginate->paginate());
    }

    // public function search(request $r)
    // {
       
    //     $v = Validator::make(
    //         $r->input(),
    //         [
    //             'latitude' => 'required',
    //             'longitude' => 'required',
    //         ]
    //     );
    //     if ($v->fails()) {
    //         return $this->validation($v);
    //     }
    //     $search = $r->search;
    //     $rating = $r->rating;
    //     $pricePerHour = $r->price_per_hour;
    //     $latitude = $r->latitude;
    //     $longitude = $r->longitude;

    //     $radius = 5000;
    //     $paginate = User::select("users.*", \DB::raw("6371 * acos(cos(radians(" . $latitude . "))
    //     * cos(radians(latitude)) * cos(radians(longitude) - radians(" . $longitude . "))
    //     + sin(radians(" . $latitude . ")) * sin(radians(latitude))) AS distance"))
    //         ->having('distance', '<', $radius)->where('form_step', User::FORM_COMPLETED);
        
    //     $paginate = $paginate->where(function ($query) use ($search) {
    //         $query->where('first_name', 'like', "%$search%")
    //             // ->orWhere('business_name', 'like', "%$search%")
    //             ->orWhere('last_name', 'like', "%$search%");
    //     });
       
         
    //     if (!empty($rating)) {
    //         $paginate->where('rating',$rating);
    //     }
    //     if (!empty($search)) {
    //         $catId = ServiceCategory::where('name','like' ,"%$search%")->pluck('id')->toArray();
    //         if(!empty($catId)){
              
    //           $catuser= User::Where('rating',$ratingId)->orwhereIn('sub_cat_id', $catId)->pluck('id')->toArray();
    //           $planuser=Payment::orwhereIn('created_by', $catuser)->pluck('created_by')->toArray();
    //           $paginate->orwhereIn('id', $planuser)->orwhereIn('sub_cat_id', $catId);
              
    //         }
    //     }
         
    //     if (!empty($pricePerHour)) {
    //         $userId = $paginate->whereBetween('price_per_hour', [User::MIN_PRICE, $pricePerHour]);
    //     }

    //     $userId = DB::table('model_has_roles')->where('role_id', User::ROLE_SERVICE_PROVIDER)->pluck('model_id')->toArray();
    //     $paginate->whereIn('id', $userId);
         
    //     return $this->customPaginator($paginate->paginate());
    // }
    //get Notification list
    public function getNotification(request $r)
    {
        $loginUser = auth()->user();
        $query = Notification::where('to_user', $loginUser->id);

        //make read notification
        $notifications = $query;
        $notifications->update(['is_read' => Notification::STATUS_CLEAR]);

        // $data = [];
        // $data['today_timestemp'] = Carbon::now()->toDateTimeString();

         return $this->customPaginator($query->paginate(20), "JsonData");
    }
    
     /**
     * get plans list 
     *
     * @param  send auth id 
     * @return response success or fail
     */
    public function Planlist(request $r)
    {
         $user = auth()->user(); 
         $usertype=$user->service_provider_type;
         if($usertype == 'individual'){
           $value=Subscription::SP_INDIVIDUAL;
         }
         else{
         $value=Subscription::SP_COMPANY;
         }
        $Plans = Subscription::where('user_type',$value )->where('plan_type',Subscription::BOOST_PLAN)->paginate();
        return $this->customPaginator($Plans, 'jsonData');
    }
     /**
     * get banner ads plans list 
     *
     * @param  send auth id 
     * @return response success or fail
     */
    public function BannerPlanlist(request $r)
    {
      
      
         $user = auth()->user(); 
         $usertype=$user->service_provider_type;
         if($usertype == 'company'){
            $value=Subscription::SP_COMPANY;
            $BannerPlans = Subscription::where('user_type',$value )->where('plan_type',Subscription::BANNER_ADS_PLAN)->paginate();
            return $this->customPaginator($BannerPlans, 'jsonData');
           }
           else{
            return $this->error(__("Wrong service provider type"));
           }
       
    }
       /**
     * get subscriptions list 
     *
     * @param  send auth id 
     * @return response success or fail
     */
    public function SubscriptionList(request $r)
    {
        $user = auth()->user(); 
        $usertype=$user->service_provider_type;
        if($usertype == 'individual'){
            $value=Subscription::SP_INDIVIDUAL;
        }
        else{
            $value=Subscription::SP_COMPANY;
        }
        $subscription = Subscription::where('user_type',$value )->where('plan_type',Subscription::APP_ACCESS)->where('status',Subscription::STATUS_ACTIVE)->paginate();
        return $this->customPaginator($subscription, 'jsonData');
    }
    
    /**
     * get transaction history list 
     *
     * @param  send auth id 
     * @return response success or fail
     */
    public function getTransactionHistory(request $r)
    {
        $user = auth()->user();
        $gethistory = Payment::where('created_by',$user->id)->orderBy('created_at','DESC')->paginate();
        return $this->customPaginator($gethistory, 'jsonData');
    }
    

    /**
     * get reviews 
     *
     * @param  send auth id 
     * @return response get reviews by customer 
     */
    public function getReviews(request $r)
    {
       
           $user = auth()->user();
           $v = Validator::make(
            $r->input(),
            [
                'provider_id' => 'required',
            ]
        );
        if ($v->fails()) {
            return $this->validation($v);
        }
           $userreviews = UserRating::where('user_id', $r->provider_id)->paginate();
         
           return $this->customPaginator($userreviews, 'jsonData');
    }
     
    

}
