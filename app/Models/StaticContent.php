<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaticContent extends Model
{
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_NEW = 2;


    use HasFactory;

    protected $fillable = [
        'terms_and_condition','screen_baner_image',
    ];

   
 public function jsonData()
    {
        $json = [];
        $json['id'] = $this->id;
        $json['terms_and_condition'] = $this->terms_and_condition;
        $json['screen_baner_image'] = $this->screen_baner_image;
        return $json;
    }
}
