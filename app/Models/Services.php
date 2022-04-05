<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Services extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','description','status','service_image','service_category_id', 'price_per_month'
    ];

    public function jsonData()
    {
        $json = [];
        $json['name'] = $this->name;
        $json['description'] = $this->description;
        $json['status'] = $this->status;
        $json['service_image'] = $this->service_image;
        $json['service_category_id'] = $this->service_category_id;
        return $json;
    }
}
