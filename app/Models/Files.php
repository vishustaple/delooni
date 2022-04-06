<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Files extends Model
{
    protected $table = "files";
    use HasFactory;

    const TYPE_RESUME = 1;
    const TYPE_COVER_LETTER = 2;
    const TYPE_LICENSE = 3;
    const TYPE_TRAINING_CERTIFICATE = 4;
    const TYPE_DEGREE = 5;
    const TYPE_GOVERNMENT_ISSUEID = 6;
    const TYPE_PHYSICAL = 7;
    const TYPE_TB_RECORDS = 8;
}

