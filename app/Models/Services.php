<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Services extends Model
{

    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_NEW = 2;
    
    const MIN_PRICE = 0;
    const IS_PARENT=0;
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','description','service_category_image','is_parent',    ];

    public function subcategories(){
        return $this->hasMany(\App\Models\Services::class,'is_parent', 'id');
    }

    public function serviceCategory()
    {
        return $this->hasOne(ServiceCategory::class, 'id', 'cat_id')->where('is_parent',ServiceCategory::IS_PARENT);
    }

    public function serviceSubCategory()
    {
        return $this->hasOne(ServiceCategory::class, 'id', 'sub_cat_id');
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
                        array_push($subcategoriesData, ['name'=>$value->name,'id'=>$value->id, 'icon'=>env('APP_URL') . 'public/profile_image/'.$value->service_category_image]);
                   
                }
    
                $json['subcategories'] = $subcategoriesData;     
            }
            else{
                $json['subcategories'] = [];    
            }
            return $json;
     //   }
    }
}
