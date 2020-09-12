<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Merchant extends Model
{
    protected $table = 'merchants';

    public function user(){
        return $this->belongsTo(User::class,'id_user');
    }
    public function companies()
    {
     return $this->hasMany(Company::class,'id_merchant');
    }
     public function requests()
    {
     return $this->hasMany(RequestProduct::class,'id_merchant');
    }
}
