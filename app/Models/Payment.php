<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'plan_id','amount','transaction_id','payment_status','created_by','duration_date','expire_date','created_at','updated_at'
    ];

    public function jsonData()
    {
        $json = [];
        $json['plan_id'] = $this->plan_id;
        $json['amount'] = $this->amount; 
        $json['transaction_id'] = $this->transaction_id; 
        $json['payment_status'] = $this->payment_status; 
        $json['created_by'] = $this->created_by;
        $json['duration_date'] = $this->duration_date;
        $json['expire_date'] = $this->expire_date;
        $json['created_at'] = $this->created_at;
        $json['updated_at'] = $this->updated_at;
        return $json;
    }
}
