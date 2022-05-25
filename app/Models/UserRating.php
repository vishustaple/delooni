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
        'user_id','rating','from_user_id','status','message',
    ];
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
    public function fromuser()
    {
        return $this->hasOne(User::class, 'id', 'from_user_id');
    }
    const MAX_RATING=5;
    
    public function jsonData()
    {
        $json = [];
        $json['user_id'] = $this->user_id;
        $json['rating'] = $this->rating;
        $json['from_user_id'] = $this->from_user_id;
        $json['from_user_name'] = $this->fromuser->first_name." ".$this->fromuser->last_name;
        $json['message'] = $this->message;
        $json['status'] = $this->status;
        return $json;
    }
}
