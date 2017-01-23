<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class EditController extends Controller
{
    public function update(Request $request)
    {
        $input = \Request::all();
        //確認用 
        print_r($input);
        echo $_POST['safety'];

        //Update
        DB::table('safe_info')
           ->where('work_id',$_POST['work_id'])
           ->update(['safety' => $_POST['safety'], 'comment' => $_POST['comment']]);

        //戻る用 'Users'
        $users = DB::table('safe_info')
          ->join('worker_list','safe_info.work_id', '=', 'worker_list.work_id')
          ->whereNotIn('safe_info.safety', ['問題ない'])
          ->get();

        return view('charge/list',compact('users'));
    }
}
