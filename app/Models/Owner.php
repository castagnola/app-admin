<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Owner extends Model
{
    public $table = "owners";

    public function city(){
        return $this->hasOne('App\Models\City','id','city_id');
    }

    public function vehicle(){
        return $this->hasMany('App\Models\Vehicle','owner_id','id');
    }
}
