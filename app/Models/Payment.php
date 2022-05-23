<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{

    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_NEW = 2;
    use HasFactory;

    protected $fillable = [
        'plan_id','amount','transaction_id','payment_status','created_by','start_date','expire_date','created_at','updated_at'
    ];
    public function getplanname()
    {
        return $this->hasOne(Subscription::class, 'id', 'plan_id');
    }
    public function jsonData()
    {
        $json = [];
        $json['plan_id'] = $this->plan_id;
        $json['plan_name'] = $this->getplanname->plan_name;
        $json['amount'] = $this->amount; 
        $json['validity'] = $this->getplanname->validity; 
        $json['transaction_id'] = $this->transaction_id;
        $json['payment_status'] = $this->payment_status; 
        $json['user_type'] = $this->getplanname->user_type;
        $json['plan_type'] = $this->getplanname->plan_type;
        $json['created_by'] = $this->created_by;
        $json['start_date'] = $this->start_date;
        $json['expire_date'] = $this->expire_date;
        $json['created_at'] = $this->created_at;
        $json['updated_at'] = $this->updated_at;
        return $json;
    }
}
