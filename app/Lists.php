<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lists extends Model
{
    //
    protected $table = 'worker_list';
    public $timestamps = false;
    protected $fillable = ['id','work_id', 'name', 'email', 'tell','password','department','manager_name','manager_tell'];
}
