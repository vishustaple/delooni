<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Otp extends Model
{
    use HasFactory;

    protected $table = 'otp';

    const FOR_SIGNUP = "signup";
    const FOR_LOGIN = "login";
    const FOR_FORGET = "forget";

    protected $fillable = [
        'phone','country_code','country_short_code','otp_for', 'otp',
    ];

    public function jsonData()
    {
        $json = [];
        $json['phone'] = $this->phone;
        $json['country_code'] = $this->country_code;
        $json['country_short_code'] = $this->country_short_code;
        $json['otp_for'] = $this->otp_for;
        $json['otp'] = $this->otp;
        return $json;
    }
}
