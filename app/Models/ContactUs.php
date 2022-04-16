<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactUs extends Model
{
    use HasFactory;

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'subject','message','from_user','to_user','status','read',
    ];

    public function jsonData()
    {
        $json = [];
        $json['subject'] = $this->subject??'';
        $json['message'] = $this->message;
        $json['from_user'] = $this->from_user;
        $json['to_user'] = $this->to_user;
        $json['status'] = $this->status??'';
        $json['read'] = $this->read??'';
        return $json;
    }
}
