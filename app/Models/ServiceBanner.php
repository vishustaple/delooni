<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceBanner extends Model
{
    use HasFactory;
    protected $fillable = [
        'service_banner_image','status',
    ];

    public function toArray()
    {
        $json = [];
        $json['id'] = $this->id;
        $json['service_banner_image'] ='http://192.168.1.210/delooni/public/img/'.$this->service_banner_image;
          
        return $json;
    }
}
