<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'reporting_issue','service_category_id','user_id','subject','status', 'message'
    ];

    public function jsonData()
    {
        $json = [];
        $json['reporting_issue'] = $this->reporting_issue;
        $json['service_category_id'] = $this->service_category_id; 
        $json['subcategory_id'] = $this->subcategory_id; 
        $json['service_provider_id'] = $this->service_provider_id; 
        $json['user_id'] = $this->user_id;
        $json['subject'] = $this->subject;
        $json['message'] = $this->message;
        $json['status'] = $this->status;
        return $json;
    }
}
