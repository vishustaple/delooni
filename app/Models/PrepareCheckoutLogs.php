<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrepareCheckoutLogs extends Model
{
    use HasFactory;
    protected $table = 'prepare_checkout_logs';

    protected $fillable = [
        'id','code','description','buildnumaber','timestamp','ndc','checkout_id'
    ];
    public function jsonData(){
        $json = [];
        $json['id'] = $this->id;
        $json['code'] = $this->code;
        $json['description'] = $this->description;
        $json['buildnumaber'] = $this->buildnumaber;
        $json['timestamp'] = $this->timestamp;
        $json['ndc'] = $this->ndc;
        $json['checkout_id'] = $this->checkout_id;
        return $json;
    }
}
