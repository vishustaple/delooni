<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FavouriteServices extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_id', 'user_id', 'status',
    ];

    public function Rating()
    {
        return $this->hasOne(User::class, 'id', 'service_id');
    }

    public function service()
    {
        return $this->hasOne(Services::class, 'id', 'service_id');
    }

    public function serviceCategory()
    {
        return $this->hasOne(ServiceCategory::class, 'id', 'service_id');
    }

    public function serviceProvider()
    {
        return $this->hasOne(User::class, 'id', 'service_id');
    }
    public function favourite($id){
        return FavouriteServices::where('user_id',$id)->first();
    }



    public function jsonData()
    {
        $favourite= $this->favourite($this->user_id);
        $serviceProvider = $this->serviceProvider ?? "";
        $json = [];
        $json['service_provider_id'] = $this->service_id;
        $json['service_provider'] = $serviceProvider->first_name . " " . $serviceProvider->last_name;
        $json['service'] = $this->service->serviceCategory->name ?? "";
        $json['rating'] = $this->Rating->rating??'0';
        $json['profile_image']= url('') . '/profile_image/' . $serviceProvider->profile_image ?? '';
        $json['description'] = $this->serviceProvider->description ?? "";
        $json['whatsapp_no']=$this->serviceProvider->whatsapp_no;
        $json['snapchat_link']=$this->serviceProvider->snapchat_link;
        $json['instagram_link']=$this->serviceProvider->instagram_link;
        $json['twitter_link']= $this->serviceProvider->twitter_link;
        $json['phone']=$this->serviceProvider->phone;
        $json['price_per_hour']=$this->service->price_per_hour??0;
        $json['is_favourite']=empty($favourite)?0:1;
        return $json;
    }
}
