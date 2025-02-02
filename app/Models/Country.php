<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;

class Country extends Model
{
    use HasFactory;
    protected $table = 'countries';

    protected $fillable = [
        'id','country_name','short_name','currency_name','country_code','usd_perc','symbol','flag','emoji'
    ];
    const STATUS_ACTIVE=1;
    public function cities(){
        return $this->hasMany(City::class,'country_id', 'id');
    }
    public function jsonData(){
        $json = [];
        $json['id'] = $this->id;
        $json['country_code'] = $this->country_code;
        $json['country_name'] = $this->country_name;
        $json['short_name'] = $this->short_name;
        $json['currency_name'] = $this->currency_name;
        $json['usd_perc'] = $this->usd_perc;
        $json['symbol'] = $this->symbol;
        $json['emoji'] = $this->emoji;
        $json['flag']=  $this->flag!=null?Config::get('constants.FLAG_URL').$this->flag:'';
        $json['cities']=$this->cities;
        return $json;
    }
}
