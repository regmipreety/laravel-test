<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reviews extends Model
{
    protected $table='reviews';
    protected $fillable=[
    	'product_id','reviews'
    ];

    public function product(){
    	return $this->belongsTo('App\Product');
    }
}
