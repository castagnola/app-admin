<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    public $table = "cities";

    /**
     * Get the departament record associated with the city.
     */
    public function departament(){

        return $this->hasOne('App\Models\Departament','id','departament_id');
    }
}
