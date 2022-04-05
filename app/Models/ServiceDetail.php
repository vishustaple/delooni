<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceDetail extends Model
{
    use HasFactory;

    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id','servie_id','status','price_per_hour','price_per_day', 'price_per_month'
    ];

    public function jsonData()
    {
        $json = [];
        $json['user_id'] = $this->user_id;
        $json['servie_id'] = $this->servie_id;
        $json['status'] = $this->status;
        $json['price_per_hour'] = $this->price_per_hour;
        $json['price_per_day'] = $this->price_per_day;
        $json['price_per_month'] = $this->price_per_month;
        return $json;
    }
}
