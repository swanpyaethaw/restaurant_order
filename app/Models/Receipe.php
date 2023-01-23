<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receipe extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function images(){
        return $this->hasMany(ReceipeImage::class,'receipe_id','id');
    }

    public function category(){
        return $this->belongsTo(Category::class,'category_id','id');
    }
}
