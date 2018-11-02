<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table='products';
    protected $fillable=['name','price','discount','stock','image'];

    function review(){
    	return $this->hasMany(Reviews::class,'product_id');
    }
}
