<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EducationDetail extends Model
{
    use HasFactory;

    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'institute_name','degree','start_date','end_date','status', 'user_id'
    ];

    public function jsonData()
    {
        $json = [];
        $json['institute_name'] = $this->institute_name;
        $json['degree'] = $this->degree;
        $json['start_date'] = $this->start_date;
        $json['end_date'] = $this->end_date;
        $json['status'] = $this->status;
        $json['user_id'] = $this->user_id;
        return $json;
    }
}
