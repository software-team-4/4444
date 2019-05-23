<?php

namespace App\model;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class User extends Model implements \Illuminate\Contracts\Auth\Authenticatable
{
    //
    protected $table='users';
    protected $guarded=['_token','password_confirmation'];
    use Authenticatable;
}
