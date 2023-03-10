<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function order(){
        return $this->belongsTo(Order::class,'order_id','id');
    }

    public function receipe(){
        return $this->belongsTo(Receipe::class,'receipe_id','id');
    }
}
