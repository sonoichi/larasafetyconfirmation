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
        // 確認用 print_r($input);

        // インサート or アップデートチェック
        if(DB::table('safe_info')->where('work_id', $_POST['work_id'])->count() == 0){
            // INSERT
            DB::insert('insert into safe_info(safety, comment, work_id) values (?, ?, ?)', 
            [$_POST['safety'],$_POST['comment'], $_POST['work_id']]);
        }else{
            // UPDATE
            DB::table('safe_info')
               ->where('work_id',$_POST['work_id'])
               ->update(['safety' => $_POST['safety'], 'comment' => $_POST['comment']]);
        }
        $work_id = $_POST['work_id'];
        return view('employee.post',compact('work_id'));
    }


    public function postconfirm(){
        // $post = DB::table('safe_info')
        //   ->where('work_id',$_POST['work_id'])
        //   ->get();
        // return view('employee.post',compact('post'));
    }    
}
