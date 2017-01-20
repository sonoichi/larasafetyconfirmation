<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class SafeController extends Controller
{
    public function store(Request $request)
    {
        $input = \Request::all();
        //確認用 
         print_r($input);

        DB::insert('insert into safe_info(safety, comment, work_id) values (?, ?, ?)', 
        [$_POST['safety'],$_POST['comment'], 1]);
        //Safe::create($input);
         //リクエストの確認
        //echo $_POST['safety'];
       // //echo $_POST['comment'];
        //print "<sctipt>alert('送信していいですか');</script>";
        return '送信されました';
    }
}
