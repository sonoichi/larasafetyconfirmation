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

        $message = [
            'work_id.alpha_num' => '社員IDは半角英数字のみ有効です',
            'password.min' => 'パスワードは8文字になります',
            'password.max' => 'パスワードは8文字になります',
        ];

        $validator = \Validator::make($credentials,$rules,$message);

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
        if(!Session::has('work_id')){
            return view('/index');
        }
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
            'work_id'=>'required|alpha_num', // 全角が普通に通るので要修正
            'password'=>'required|min:8|max:8',
        ];
        
        $message = [
            'work_id.alpha_num' => '社員IDは半角英数字のみ有効です',
            'password.min' => 'パスワードは8文字になります',
            'password.max' => 'パスワードは8文字になります',
        ];

       // ['wok_id'=>'regex:/^[a-zA-Z0-9]+$/']// 半角英数字チェック

        $validator = \Validator::make($credentials,$rules,$message);

        $users = DB::table('safe_info')
          ->join('worker_list','safe_info.work_id', '=', 'worker_list.work_id')
          ->whereNotIn('safe_info.safety', ['問題ない'])
          ->get();

        $password = Input::get('password'); // 個別取得
        $work_id = Input::get('work_id');   // 個別取得
        
          //セッション保存
        Session::put('work_id', $work_id);

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
        //return Session::all();
        if(!Session::has('work_id')){
          Session::forget('work_id');
          return '<h1 style="margin:2em auto;text-align:center">ログインしていない状態では閲覧することはできません</h1>';
        }
        
        $editUser = DB::table('safe_info')->where('work_id',$id)->get();
        Session::put('editWorker', $editUser); // 編集用ユーザーID :: view中の表示に利用しているので下手にいじれない

        $editEditWorker_id = DB::table('safe_info')->where('work_id',$id)->value('work_id');
        Session::put('editWorker_id', $editEditWorker_id); //個別データ
        $editEditSafety = DB::table('safe_info')->where('work_id',$id)->value('safety');
        Session::put('editSafety', $editEditSafety); //個別データ
        $editComment = DB::table('safe_info')->where('work_id',$id)->value('comment');
        Session::put('editComment', $editComment); //個別データ
        $editManager_comment = DB::table('safe_info')->where('work_id',$id)->value('manager_comment');
        Session::put('editManager_comment', $editManager_comment); //個別データ
        
        // 確認用 return Session::get('editWorker');
        
         return view('charge.edit',compact('editUser','editWorker_id','editSafety','editComment'));
         // return Session::all();

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
        Session::forget('work_id');
        Session::forget('editWorker');
        Session::forget('editWorker_id');
        Session::forget('editSafety');
        Session::forget('editComment');

        Session::forget('editManeger_comment');
        // 確認用 
        //return Session::all();

        //return view('/index');
        return redirect('charge/login');
        //return redirect()->route('../index');
    }



// 以下検証用に作ったもの
    public function dbshow(){

    }

    public function dbedit($id){
        return "Hello";
    }


}