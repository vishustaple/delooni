<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\City;
use App\Models\Day;
use App\Models\DefaultPostion;
use App\Models\DefaultPreferToWorkIn;
use App\Models\DeliveryAddress;
use App\Models\Favorite;
use App\Models\FoodItem;
use App\Models\FoodType;
use App\Models\Item;
use App\Models\JobSession;
use App\Models\Language;
use App\Models\LoginHistory;
use App\Models\Menu;
use App\Models\Notification;
use App\Models\RestaurantServiceArea;
use App\Models\State;
use App\Models\Jobs;
use App\Models\Order;
use App\Models\Review;
use App\Models\Transaction;
use App\Models\Restaurant;
use App\Models\Slot;
//facades
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


//models
use App\Models\User;


//additional
use Validator;

//traits
use App\Traits\ApiResponser;
use App\Traits\ImageUpload;
use App\Traits\Email;
//use App\Traits\Togglestatus;
use Carbon\Carbon;
use Exception;

class ListController extends Controller
{
    use ApiResponser;
    use ImageUpload;
    use Email;
  //  use Togglestatus;
    /**
     *Get list
     *
     * @param  $r request contains data to days,slot,defalutPostion,defalutPreferToWorkIn,list
     * @return List Data
     */
    //
    public function secondStepDefaultList(request $r){
        $data=[];
        $data['days'] = Day::select('id','title')->orderBy('id', 'ASC')->get();
        $data['slot']  = Slot::select('id','start_time','end_time')->orderBy('id', 'ASC')->get();
        $data['defalutPostion']  = DefaultPostion::select('id','title')->orderBy('id', 'ASC')->get();
        $data['defalutPreferToWorkIn'] = DefaultPreferToWorkIn::select('id','title')->orderBy('id', 'ASC')->get();
        return $this->successWithData($data, "List fetched successfully");
    }
    /**
     *Get Job Request list
     *
     * @param  $r request contains data to Job Request
     * @return Job Request list
     */
    //
    public function getJobRequest(request $r)
    {
        $data=[];
        $data['job'] = Jobs::get();
        return $this->successWithData($data, "List fetched successfully");
    }
    /**
     *Accepted Job
     *
     * @param  $r request contains data to  auth user
     * @return response success or fail
     */
    //
    public function acceptJob(request $r)
    {
        try {
            $loginUser = auth()->user();
            $assignedJobs = Jobs::where(["assign_to" => $loginUser->id, "status" => Jobs::STATUS_ASSIGNED])->get();
            if (!$assignedJobs->count()) {
                throw new Exception("No assigned Job found");
            }
            foreach ($assignedJobs as $assignedJob) {
                $assignedJob->accepted_at = Carbon::now();
                $assignedJob->status = Jobs::STATUS_ACCEPTED;
                $assignedJob->save();
            }
            //send push notification
            $notification = (new Notification())->sendPushNotification([
                "title" => "Assigned Job accepted.",
                "message" => $loginUser->name . " has confirmed Job!" . ".",
                "model_id" => 0,
                "type" => Notification::STATUS_ASSIGNED,
                "to_user" =>  User::where("role_id", User::ROLE_ADMIN)->first()->id
            ]);
            return $this->success('Job Accepted Successfully');
        } catch (\Throwable $th) {
            return $this->error($th->getMessage());
        }
    }

    /**
     *Get Notification
     *
     * @param  contains user id 
     * @return response show list 
     */
    //
    public function GetNotification(request $r)
    {
        try{
        $user = auth()->user();
        $list=Notification::where('to_user',$user->id)->paginate();
        return $this->customPaginator($list,'jsonData');
        }
        catch (\Throwable $e) {
            DB::rollback();
            return $this->error($e->getMessage());
        }
        

    }
}
