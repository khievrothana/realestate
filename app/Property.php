<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    //
    protected $table='property';

    public function User(){
    	return $this->belongsTo('App\user', 'UserId');
    }

    public function PropertyType(){
    	return $this->belongsTo('App\PropertyType', 'Type');
    }
}
