<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class facilitybooking extends Model
{
     // Arwa 
     protected $table = 'facilitybookings';
    protected $fillable= ['*'];
     //protected $fillable= ['title','color','start_date','end_date','facilityId','userId'];
}
