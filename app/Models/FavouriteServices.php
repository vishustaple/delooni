<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FavouriteServices extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_id','user_id','status',
    ];

    public function jsonData()
    {
        $json = [];
        $json['service_id'] = $this->service_id;
        $json['user_id'] = $this->user_id;
        $json['status'] = $this->status;
        return $json;
    }
}
