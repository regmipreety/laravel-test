<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Product extends Model
{
    protected $table='products';
    protected $fillable=['name','price','discount','stock','image','description'];

    public function reviews(){
    	return $this->hasMany(Reviews::class,'product_id');
    }

    public static function price_range($max_price,$min_price){

    	$filter = DB::table('products')
                ->whereBetween('price', 
                 array( $max_price,$min_price))
                ->get();
               
               return $filter;
    }
}
