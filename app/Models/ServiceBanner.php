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
        $json['service_banner_image'] =env('APP_URL') . 'public/img/'.$this->service_banner_image;
          
        return $json;
    }
}
