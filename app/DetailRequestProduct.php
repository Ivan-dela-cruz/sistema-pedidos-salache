<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailRequestProduct extends Model
{
	 protected $table = 'detail_request_products';
   public function request()
    {
        return $this->belongsTo(RequestProduct::class, 'id_request');
    }
}
