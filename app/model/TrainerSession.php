<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class TrainerSession extends Model
{
    //
    protected $table='trainersession';
    protected $guarded=['_token'];
    function user(){
        return $this->hasOne('App\model\User','id','trainerId');
    }
}
