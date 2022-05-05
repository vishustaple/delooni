<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Services extends Model
{

    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_NEW = 2;
    
    const MIN_PRICE = 0;
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title','description','status','service_image','path','price_per_hour','price_per_day','price_per_month','cat_id','sub_cat_id','user_id','created_by'
    ];

    public function serviceCategory()
    {
        return $this->hasOne(ServiceCategory::class, 'id', 'cat_id')->where('is_parent',ServiceCategory::IS_PARENT);
    }

    public function serviceSubCategory()
    {
        return $this->hasOne(ServiceCategory::class, 'id', 'sub_cat_id');
    }


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
        $json['cat_name'] = $this->serviceCategory->name??"";
        $json['sub_cat_name'] = $this->serviceSubCategory->name??"";

        return $json;
    }
}
