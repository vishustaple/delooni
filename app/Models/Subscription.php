<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_NEW = 2;

    use HasFactory;
      /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'plan_name','description','validity','price_per_plan','status'
    ];
    public function jsonData()
    {
        $json = [];
        $json['plan_name'] = $this->plan_name;
        $json['description'] = $this->description;
        $json['validity'] = $this->validity;
        $json['price_per_plan'] = $this->price_per_plan;
        $json['user_type'] = $this->user_type;
        $json['status'] = $this->status;
        return $json;
    }
}
