<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{

    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_NEW = 2;
    
    use HasFactory;
    protected $fillable = [
        'id','city_name','latitude','longitude','radius','status','country_id'
    ];
    public function jsonData(){
        $json = [];
        $json['id'] = $this->id;
        $json['city_name'] = $this->city_name;
        $json['latitude'] = $this->latitude;
        $json['longitude'] = $this->longitude;
        $json['radius'] = $this->radius;
        $json['status'] = $this->status;
        $json['country_id'] = $this->country_id;
        return $json;
    }
}
