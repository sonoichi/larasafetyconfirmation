<?php

namespace App\Http\Controllers;
use DB;
use Session;
//use Illuminate\Http\Request;
use Request;
use Illuminate\Routing\Controller;
use Input;
use Redirect;

use Validator; // 追加
class SafeController extends Controller
{
    // DB接続 長くなってきたらModelに移す
    // employee/confirm -> employee/post 
    public function store(Request $request)
    {
        if(!Session::get('work_id')){
            //return Session::all();
            return redirect('/');
            //return '<h1 style="margin:2em auto;text-align:center">ログインしていない状態では閲覧することはできません</h1>';
        }

        $input = \Request::all();

        $credentials = [
            'comment'=>Input::get('comment'),
        ];
        $rules = [
            'comment'=>'max:30', 
        ];
        $message = [
            'comment.max' => 'コメントは最大30文字までです。',
        ];

        $validator = Validator::make($credentials,$rules,$message);
        if($validator->fails()){
            return redirect::back()->withErrors($validator)->withInput();
        }

        // 確認用 
        //return Session::all();
        // 確認用 return Request::input('comment');
        // インサート or アップデートチェック
        if(DB::table('safe_info')->where('work_id', Session::get('work_id'))->count() === 0){
            // INSERT
            // DB::insert('insert into safe_info(safety, comment, manager_comment ,work_id) values (?, ?, ?, ?)', 
            // [Request::input('safety') ,Request::input('comment') , '',Session::get('work_id')]);

            DB::table('safe_info')->insert(
                ['safety' => Request::input('safety'), 'comment' => Request::input('comment'), 'manager_comment' => '','work_id' => Session::get('work_id'), 'date'=>Session::get('date')]
            );
        }else{
            // UPDATE
            DB::table('safe_info')
               ->where('work_id',Session::get('work_id'))
               ->update(['safety' => Request::input('safety'), 'comment' => Request::input('comment'),'date'=>Session::get('date')]);
        }
        $work_id = Session::get('work_id');
        return view('employee.post',compact('work_id'));
    }


    public function postconfirm(){
        if(!Session::get('work_id')){
             //return Session::all();
             return redirect('/');
            //return '<h1 style="margin:2em auto;text-align:center">ログインしていない状態では閲覧することはできません</h1>';
        }
       // return '<h1 style="margin:2em auto;text-align:center">ログインしていない状態では閲覧することはできません</h1>';
    }    
}
