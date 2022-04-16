<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FavouriteServices extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_id','user_id','status',
    ];

    public function service(){
        return $this->hasOne(ServiceDetail::class, 'id','service_id');
    }
     
    public function serviceName($id)
    {
        return ServiceCategory::where('id',$id)->first();

    }

    public function serviceProviderName($id){
        return User::where('id',$id)->first();
    }
   

    public function jsonData()
    {
        $serviceId=$this->service->service_id;
        $service=$this->serviceName($serviceId);
        $serviceProviderId=$this->service->user_id;
        $serviceProvider=$this->serviceProviderName($serviceProviderId);

        $json = [];
        $json['service_id']=$serviceId;
        $json['service'] =$service->name ;
        $json['service_provider_id']= $serviceProviderId;
        $json['service_provider'] = $serviceProvider->first_name." ".$serviceProvider->last_name;
        $json['created_by'] = $this->user_id;
        $json['status'] = $this->status;
        return $json;
    }
}
