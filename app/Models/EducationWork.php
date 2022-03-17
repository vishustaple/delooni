<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EducationWork extends Model
{
    protected $table = "education_work";
    use HasFactory;
    protected $fillable = [
            'highschool',
            'college',
            'training_institute',
            'additional_educational',
            'job_experiences',
            'relevant_skills',
            'position_apply',
        ];
}
