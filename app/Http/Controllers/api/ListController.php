<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\FavouriteServices;
use App\Models\Notification;
use App\Models\ServiceCategory;
use App\Models\ServiceDetail;
use App\Models\User;
use App\Models\UserRating;
//facades
use Illuminate\Http\Request;

//traits
use App\Traits\ApiResponser;
use App\Traits\ImageUpload;
use App\Traits\Email;


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
        dd($categories);
        $getbanners = \App\Models\ServiceBanner::get()->toArray();
        return $this->customPaginator($categories, 'jsonData', ['service_banners' => $getbanners]);
    }

    /**
     * Get Sub-Categories List
     *
     * @param  $r request contains data to show list of sub categories
     * @return response success or fail
     */
    public function getSubcategories(request $r)
    {
        $v = Validator::make(
            $r->input(),
            [
                'category' => 'required',
            ]
        );
        if ($v->fails()) {
            return $this->validation($v);
        }
        $categories = ServiceCategory::where('name', $r->category)->first();
        $subcategories = ServiceCategory::where('is_parent', $categories->id)->paginate();
        return $this->customPaginator($subcategories, 'jsonData');
    }

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
        $query = Country::where('status', Country::STATUS_ACTIVE)->paginate(500);
        return $this->customPaginator($query, 'jsonData');
    }


    public function search(request $r)
    {
        $user = auth()->user();
        $search = $r->search;
        $rating = $r->rating;
        $pricePerHour = $r->price_per_hour;

        $paginate = User::where(function ($query) use ($search) {
            $query->where('first_name', 'like', "%$search%")
                ->orWhere('business_name', 'like', "%$search%")
                ->orWhere('last_name', 'like', "%$search%");
        })
            ->where('rating', 'like', "%$rating%")
            ->where('users.id', '!=', $user->id);

        if (!empty($pricePerHour)) {
            $userId = ServiceDetail::where('price_per_hour', 'like', "%$pricePerHour%")->pluck('user_id')->toArray();
            $paginate->wherein('id', $userId);
        }
        if (!empty($search)) {
            $catId = ServiceCategory::where('name', 'like', "%$search%")->where('is_parent', ServiceCategory::IS_PARENT)->pluck('id')->toArray();
            $userId = ServiceDetail::whereIn('cat_id', $catId)->pluck('user_id')->toArray();
            $paginate->orWhereIn('id', $userId);
        }

        return $this->customPaginator($paginate->paginate());
    }
}
