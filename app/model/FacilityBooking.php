<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class FacilityBooking extends Model
{
    protected $table = 'facilitybookings';
    protected $guarded = ['_token'];
}
