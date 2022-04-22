<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MainScreen extends Model
{
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_NEW = 2;


    use HasFactory;

    protected $fillable = [
        'title','screen_image','description','path','status',
    ];


  public function jsonData()
    {
        $json = [];
        $json['id'] = $this->id;
        $json['title'] = $this->title;
        $json['screen_image'] = $this->screen_image;
        $json['path'] = $this->path;
        $json['description'] = $this->description;
        return $json;
    }
}
