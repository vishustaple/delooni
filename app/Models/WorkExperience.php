<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkExperience extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'no_of_years','brief_of_experience','start_date','end_date','status', 'user_id'
    ];

    public function jsonData()
    {
        $json = [];
        $json['no_of_years'] = $this->no_of_years;
        $json['brief_of_experience'] = $this->brief_of_experience;
        $json['start_date'] = $this->start_date;
        $json['end_date'] = $this->end_date;
        $json['status'] = $this->status;
        $json['user_id'] = $this->user_id;
        return $json;
    }
}
