<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AllCity extends Model
{
    use HasFactory;
    protected $table = 'allcities';

    protected $fillable = [
        'id','city_name','state_id','state_code','country_id','country_code','created_at'
    ];
    public function jsonData(){
        $json = [];
        $json['id'] = $this->id;
        $json['city_name'] = $this->city_name;
        $json['state_id'] = $this->state_id;
        $json['state_code'] = $this->state_code;
        $json['country_id'] = $this->country_id;
        $json['country_code'] = $this->country_code;
        return $json;
    }
}
