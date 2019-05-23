<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    //
    protected $table='facility';
    protected $guarded=['_token'];
}
