<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'plan_id','amount','transaction_id','payment_status','created_by','duration_date','expire_date'
    ];

    public function jsonData()
    {
        $json = [];
        $json['plan_id'] = $this->plan_id;
        $json['amount'] = $this->amount; 
        $json['transaction_id'] = $this->transaction_id; 
        $json['payment_status'] = $this->payment_status; 
        $json['created_by'] = $this->created_by;
        return $json;
    }
}
