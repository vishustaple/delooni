<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentStatusLogs extends Model
{
    use HasFactory;
    protected $table = 'payment_status_logs';

    protected $fillable = [
        'id','code','description','buildnumaber','timestamp','ndc',
    ];
    public function jsonData(){
        $json = [];
        $json['id'] = $this->id;
        $json['code'] = $this->code;
        $json['description'] = $this->description;
        $json['buildnumaber'] = $this->buildnumaber;
        $json['timestamp'] = $this->timestamp;
        $json['ndc'] = $this->ndc;
        return $json;
    }
}
