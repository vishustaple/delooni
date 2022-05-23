<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_NEW = 2;
    
    const ADS_PLAN=1;
    const BOOST_PLAN=2;
    const APP_ACCESS=3;

    const CUSTOMER=1;
    const SP_INDIVIDUAL=2;
    const SP_COMPANY=3;
    
    use HasFactory;
      /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'plan_name','description','validity','price_per_plan','status','user_type','plan_type'
    ];
    public function getexpiredate()
    {
        return $this->hasOne(Payment::class, 'plan_id', 'id');
    }
    function dateDiffInDays($date1, $date2) 
    {
    $diff = strtotime($date2) - strtotime($date1);
    return abs(round($diff / 86400));
    }
    public function jsonData()
    {
     
        $json = [];
        $json['plan_id'] = $this->id;
        $json['plan_name'] = $this->plan_name;
        $json['description'] = $this->description;
        $json['validity'] = $this->validity;
        $json['price_per_plan'] = $this->price_per_plan;
        $json['expire_date'] = $this->getexpiredate->expire_date??"";
        $json['user_type'] = $this->user_type;
        $json['plan_type'] = $this->plan_type;
        $json['days_left'] = $this->dateDiffInDays($this->getexpiredate->start_date??"", $this->getexpiredate->expire_date??"");
        $json['is_active'] = $this->getexpiredate->payment_status??0;
        return $json;
    }
}
