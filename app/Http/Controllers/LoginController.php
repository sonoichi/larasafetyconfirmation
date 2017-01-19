<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use Request;
use App\User;
use DB;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class LoginController extends Controller
{
    //use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    //ログイン画面遷移
    public function charge()
    {
        return view('charge.login');
    }
    
    public function employee()
    {
        return view('employee.login');
    }

    //直リン禁止:
    // Middlewere設定でなんとかなるはずだけど、なんかダメっぽい
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout','employee.confirm','charge.list']);
    }

    //ログイン認証設定
    public function getlogin()
    {
        if(Request::has('work_id')){
            $name = Request::input('work_id');
        }else{
            $name = 'ゲスト';
        }
        return view('employee.confirm',compact('name'));
    }

    public function postlogin()
    {
       // return view('employee.login');
    }

    public function getlogout()
    {
        //return view('employee.login');
    }

//
    public function getList(){
        //getList
        //$worker_list = DB::table('worker_list');
        //return view('charge.list', $worker_list);
        $worker_lists['worker_lists'] = DB::table('worker_list')->get();
        
        return view('charge.list', $worker_lists);
    }

    public function edit(){
        return view('charge.edit');
    }

    public function getConfirm(){
        $safety = Input::get('safety');
        $comment = Input::get('comment');

        $safeMember = new Member;
        $safeMember->safety = $safety;
        $safeMember->comment = $comment;

        $safeMember->save();
        return '保存しました';             
    }
    

 

}
