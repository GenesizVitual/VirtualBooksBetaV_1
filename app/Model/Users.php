<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    //
    protected $table="users";

    protected $fillable = ['name','email','password','level','status_syarat'];
}
