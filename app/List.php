<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class List extends Model
{
    //テーブルの指定
    protected $table = 'worker_list';

    public function getIndex(Request $request)
    {
        $data = DB::select('select * from greetings');
        return view('greeting', ['data' => $data]);
    }

}
