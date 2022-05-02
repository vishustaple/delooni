<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Services extends Model
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
        'title','description','status','service_image','path','price_per_hour','price_per_day','price_per_month','cat_id','sub_cat_id','user_id','created_by'
    ];

   

    public function jsonData()
    {
        $json = [];
        $json['title'] = $this->title;
        $json['description'] = $this->description;
        $json['status'] = $this->status;
        $json['service_image'] = $this->service_image;
        $json['price_per_hour'] = $this->price_per_hour;
        $json['price_per_day'] = $this->price_per_day;
        $json['price_per_month'] = $this->price_per_month;
        $json['cat_id'] = $this->cat_id;
        $json['sub_cat_id'] = $this->sub_cat_id;
        $json['user_id'] = $this->user_id;
        $json['created_by'] = $this->created_by;


        return $json;
    }
}
