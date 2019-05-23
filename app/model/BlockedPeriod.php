<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class BlockedPeriod extends Model
{
    //
    protected $table='blockedperiod';
    protected $guarded=['_token'];
}
