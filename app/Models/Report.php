<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'reorting_issue','brief_of_experience','start_date','end_date','status', 'user_id'
    ];

    public function jsonData()
    {
        $json = [];
        $json['reorting_issue'] = $this->reorting_issue;
        $json['brief_of_experience'] = $this->brief_of_experience;
        $json['start_date'] = $this->start_date;
        $json['end_date'] = $this->end_date;
        $json['status'] = $this->status;
        $json['user_id'] = $this->user_id;
        return $json;
    }
}
