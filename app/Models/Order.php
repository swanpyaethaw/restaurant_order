<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function orderDetails(){
        return $this->hasMany(OrderDetail::class,'order_id','id');
    }

    public function table(){
        return $this->belongsTo(Table::class,'table_id','id');
    }
}
