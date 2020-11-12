<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
class Admin extends Authenticatable
{
    //
    use HasApiTokens;
    protected $table = 'admins';
    protected $guarded = [];


    
}
