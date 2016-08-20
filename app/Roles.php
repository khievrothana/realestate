<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    //

    public function users(){
    	return $this->BelongsToMany('App\User','userroles','UserId','RoleId');
    }
}
