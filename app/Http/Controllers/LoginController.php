<?php
/*
修正日
担当

*/


namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use Auth;
use Request;
use App\User;
use DB;
use Input;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Support\Facades\Redirect;
use Session;
// メソッド一覧
/*
  概要

*/

class LoginController extends Controller
{
    //use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    // ログイン画面遷移
    // index -> charge/login
    public function charge()
    {
        //Session::flush();
        return view('charge.login');
    }
    
    // ログイン画面遷移
    // index -> employee/login
    public function employee()
    {
        //Session::flush();
        return view('employee.login');
    }

    //直リン禁止:
    // Middlewere設定でなんとかなるはずだけど、なんかダメっぽい
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout','employee.confirm','charge.list']);
    }

    // メソッドの概要:詳細
    // パラメータの説明
    //ログイン認証設定
    // 一般用認証処理
    public function getlogin()
    {
        // if(Request::has('work_id')){
        //     $name = Request::input('work_id');
        // }else{
        //     $name = 'ゲスト';
        // }
        // return view('employee.confirm',compact('name'));
        return '<h1 style="margin:2em auto;text-align:center">ログインしていない状態では閲覧することはできません</h1>';
    }

    // ログイン時の処理
    // employee/login -> employee/confirm
    public function postlogin()
    {   
        $credentials = [
            'work_id'=>Input::get('work_id'),
            'password'=>Input::get('password')
        ];

        $rules = [
            'work_id'=>'required',
            'password'=>'required|min:8|max:8',
        ];

        $validator = \Validator::make($credentials,$rules);

        $password = Input::get('password');
        $work_id = Input::get('work_id');
        Session::put('work_id', $work_id);
        if(($password == (DB::table('worker_list')->where('password',$password)->value('password'))) and ( $work_id == (DB::table('worker_list')->where('work_id',$work_id)->value('work_id')))){
          return view('employee.confirm',$credentials);
          //確認用 return Session::all();
        }else{
            return Redirect::back()
                ->withErrors($validator)
                ->withInput();
        }
        
        //return view('employee.confirm');
    }

    public function getlogout()
    {
        //return view('employee.login');
    }


    // 管理者用認証処理
    
    // 外部からの編集画面呼出への処理
    public function getList(){
        return '<h1 style="margin:2em auto;text-align:center">ログインしていない状態では閲覧することはできません</h1>';
    }

    // ログイン時の処理
    // charge/login -> charge/list
    public function postlist() {
        $credentials = [
            'work_id'=>Input::get('work_id'),
            'password'=>Input::get('password')
        ];

        $rules = [
            'work_id'=>'required',
            'password'=>'required|min:8|max:8',
        ];

        $validator = \Validator::make($credentials,$rules);

        $users = DB::table('safe_info')
          ->join('worker_list','safe_info.work_id', '=', 'worker_list.work_id')
          ->whereNotIn('safe_info.safety', ['問題ない'])
          ->get();

        $password = Input::get('password');
        $work_id = Input::get('work_id');
        
          //セッション保存
        Session::put('work_id', $work_id);
        Session::put('password', $password);

        if(($password == (DB::table('worker_list')->where('password',$password)->value('password'))) 
        and ( $work_id == (DB::table('worker_list')->where('work_id',$work_id)->value('work_id')))
        and ( (DB::table('worker_list')->where('work_id',$work_id)->value('name')) == (DB::table('worker_list')->where('work_id',$work_id)->value('manager_name')))){
          //return Session::all();
          return view('charge.list',compact('credentials','users'));
        }else{
            return Redirect::back()
                ->withErrors($validator)
                ->withInput();
        }
    }

    // 
    // charge/edit -> charge/edit/{id}
    public function getedit($id){
        $editUser = DB::table('safe_info')->where('work_id',$id)->get();
        Session::put('editWorker', $editUser); // 編集用ユーザー  
        if(Session::has('password')){
          return view('charge.edit',compact('editUser'));
        //   return Session::all();
        //   return Session::get('url');
        }else{
          //return Session::all(); 
        }
        //return redirect()->route('edit', ['editUser' => $editUser]);
        //return Session::all();
    }

    public function edit(){
        //return view('charge.edit',compact('editUser'));
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


    public function sessionkill(){
        Session::flush();
        return view('/index');
    }


    public function dbshow(){
        $users = DB::table('safe_info')
          ->join('worker_list','safe_info.work_id', '=', 'worker_list.work_id')
          ->whereNotIn('safe_info.safety', ['問題ない'])
          ->get();
          //print_r($users); //確認用
          return view('debug',compact('users'));
    }

    public function dbedit($id){
        return "Hello";
    }


}