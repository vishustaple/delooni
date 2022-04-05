<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name','description','service_category_image','is_parent',
    ];

    public function jsonData()
    {
        $json = [];
        $json['id'] = $this->id;
        $json['name'] = $this->name;
        $json['description'] = $this->description;
        $json['service_category_image'] = $this->service_category_image;
        $json['is_parent'] = $this->is_parent;
        return $json;
    }
}
