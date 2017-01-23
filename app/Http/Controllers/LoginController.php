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
use Redirect;
use DB;
use Input;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
// メソッド一覧
/*
  概要

*/

class LoginController extends Controller
{
    //use AuthenticatesAndRegistersUsers, ThrottlesLogins;
    use AuthenticatesUsers;

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
    }

    public function postlogin()
    {

        $credentials = [
            'work_id'=>Input::get('work_id'),
            'password'=>Input::get('password')
        ];

        $password = Input::get('password');
        $work_id = Input::get('work_id');
        if(($password == (DB::table('worker_list')->where('password',$password)->value('password'))) and ( $work_id == (DB::table('worker_list')->where('work_id',$work_id)->value('work_id')))){
          return view('employee.confirm',$credentials);
        }else{
          return 'パスワードが違います';
        }
    }

    public function getlogout()
    {
        //return view('employee.login');
    }


    // 管理者用認証処理
    public function getList(){
        //getList
        // $worker_list = DB::table('worker_list');
        // return view('charge.list', $worker_list);
        // $worker_lists['worker_lists'] = DB::table('worker_list')->get();

        // return view('charge.list', $worker_lists);
    }

    public function postlist() {
        $credentials = [
            'work_id'=>Input::get('work_id'),
            'password'=>Input::get('password')
        ];

        $users = DB::table('safe_info')
          ->join('worker_list','safe_info.work_id', '=', 'worker_list.work_id')
          ->whereNotIn('safe_info.safety', ['問題なし'])
          ->get();

        $password = Input::get('password');
        $work_id = Input::get('work_id');
        if(($password == (DB::table('worker_list')->where('password',$password)->value('password'))) 
        and ( $work_id == (DB::table('worker_list')->where('work_id',$work_id)->value('work_id')))
        and ( (DB::table('worker_list')->where('work_id',$work_id)->value('name')) == (DB::table('worker_list')->where('work_id',$work_id)->value('manager_name')))){
          return view('charge.list',compact('credentials','users'));
        }else{
          return 'パスワードが違います';
        }      
    }




    public function edit($id){
        $editUser = DB::table('safe_info')->where('work_id',$id)->get();
        return view('charge.edit',compact('editUser'));
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


    public function dbshow(){
        // $users = DB::table('safe_info')->get();

        // foreach ($users as $user) {
        //     //echo $user->safety;
        //     //echo $user->work_id;
        //     $currentID = $user->work_id;
        //     //echo '<br/>'.$currentID.'Login Cotrollerから<br/>';
        //     $worker_lists['worker_lists'] = DB::table('worker_list')->where('work_id', $currentID)->get();
        //     $IDdata[] []= $worker_lists['worker_lists'];
        //     //print_r($IDdata);
        // }

        // //return view('debug', ['users' => $users]);
        // return view('debug', $IDdata);

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
