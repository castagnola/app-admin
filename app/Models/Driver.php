<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    public $table = "drivers";

    public function city(){
        return $this->hasOne('App\Models\City','id','city_id');
    }
}
