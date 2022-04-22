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
        'user_id','service_id','status','price_per_hour','price_per_day', 'price_per_month','service_cat_id'
    ];
    
    public function Rating()
    {
        return $this->hasOne(UserRating::class, 'user_id', 'user_id');
    }
    public function users(){
        return $this->hasMany(User::class,'id','user_id');
    }
    public function favourite($id,$userId){
        return FavouriteServices::where('service_id',$id)->where('user_id',$userId)->first();
    }
    

public function filterData()
{
    $userId= auth()->user()->id;
    $favourite= $this->favourite($this->users[0]->id,$userId);
    $json = [];
    $json['id'] = $this->users[0]->id;
    $json['first_name'] = $this->users[0]->first_name;
    $json['last_name'] = $this->users[0]->last_name;
    $json['profile_image']=env('APP_URL').'public/profile_image/'.$this->users[0]->profile_image;
    $json['rating'] = $this->Rating->rating??0;;
    $json['is_favorite'] = empty($favourite)?0:1;
    $json['whatsapp_no'] = $this->users[0]->whatsapp_no;
    $json['snapchat_link'] = $this->users[0]->snapchat_link;
    $json['instagram_link'] = $this->users[0]->instagram_link;
    $json['twitter_link'] = $this->users[0]->twitter_link;
    $json['description'] = $this->users[0]->description;
    $json['phone']=$this->users[0]->phone;
    $json['price_per_hour']=$this->users[0]->price_per_hour??0;

    return $json;
}


    public function jsonData()
    {
        $json = [];
        $json['user_id'] = $this->user_id;
        $json['service_id'] = $this->service_id;
        $json['price_per_hour'] = $this->price_per_hour;
        $json['price_per_day'] = $this->price_per_day;
        $json['price_per_month'] = $this->price_per_month;
        $json['status'] = $this->status;
        return $json;
    }
}
