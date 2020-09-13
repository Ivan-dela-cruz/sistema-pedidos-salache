<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequestProduct extends Model
{
	 protected $table = 'request_products';
     public function details()
    {
     	return $this->hasMany(DetailRequestProduct::class,'id_request');
    }

    public function merchant()
    {
        return $this->belongsTo(Merchant::class, 'id_merchant');
    }
}
