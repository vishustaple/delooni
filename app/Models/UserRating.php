<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRating extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','description','status','service_image',
    ];

    public function jsonData()
    {
        $json = [];
        $json['user_id'] = $this->user_id;
        $json['rating'] = $this->rating;
        $json['from_user_id'] = $this->from_user_id;
        $json['status'] = $this->status;
        return $json;
    }
}
