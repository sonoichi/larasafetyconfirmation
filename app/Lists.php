<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lists extends Model
{
    //
    protected $table = 'worker_list';
    public $timestamps = false;
    protected $fillable = ['work_id', 'name', 'email', 'tell','password'];
}
