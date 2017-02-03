<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Register extends Model
{
    //
    protected $table = 'users';
    public $timestamps = false;
    protected $fillable = ['work_id', 'name', 'email', 'tell','password','department'];

}
