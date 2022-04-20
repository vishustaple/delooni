<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceCategory extends Model
{

    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_NEW = 2;


    use HasFactory;

    protected $fillable = [
        'name','description','service_category_image','is_parent',
    ];

    const IS_PARENT=0;

    public function subcategories(){
        // return $this->hasMany('ServiceCategory','is_parent');
        return $this->hasMany(\App\Models\ServiceCategory::class,'is_parent', 'id');


    }

    public function jsonData()
    {
       // if( $this->is_parent == 0 ){
            $json = [];
            $json['id'] = $this->id;
            $json['name'] = $this->name;
            if( count($this->subcategories) > 0 ){
                $subcategoriesData = [];
                foreach ($this->subcategories as $key => $value) {
                        array_push($subcategoriesData, ['name'=>$value->name,'id'=>$value->id, 'icon'=>'http://192.168.1.210/delooni/public/img/'.$value->service_category_image]);
                   
                }
    
                $json['subcategories'] = $subcategoriesData;        
            }
            return $json;
     //   }
    }
}
