<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded=[];
    protected $table='product';

    public function sale(){
        return $this->hasMany('App\Sale');
    }
    public function category(){
        return $this->belongsTo('App\Category');
    }
}
