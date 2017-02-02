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
use Mail;
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
    // Mail::raw('本文', function($message)
    // {
    //     $message->from('fromアドレス', '差出人不明');

    //     $message->to('toアドレス');
    // });
        //Session::flush();
        return view('employee.login');
    }

    //直リン禁止:
    // Middlewere設定でなんとかなるはずだけど、なんかダメっぽい
    public function __construct()
    {
        //$this->middleware('guest', ['except' => 'index','employee.login','charge.login','register']);
    }

    // メソッドの概要:詳細
    // パラメータの説明
    //ログイン認証設定
    // 一般用認証処理
    // 
    public function getlogin()
    {
        //return Session::all();
        if(!Session::get('work_id')){
            Session::flush();
            return redirect('/');
           //return '<h1 style="margin:2em auto;text-align:center">ログインしていない状態では閲覧することはできません</h1>';
        }
        return view('employee.confirm');
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
            'work_id'=>'required|regex:/^[0-9a-zA-Z]+$/',
            'password'=>'required|min:8|max:8',
        ];

        $message = [
            'work_id.required' => '社員IDが未入力です',
            'work_id.regex' => '社員IDは半角英数字のみ有効です',
            'password.required' => 'パスワードが未入力です',
            'password.min' => 'パスワードは8文字になります',
            'password.max' => 'パスワードは8文字になります',
        ];

        $validator = \Validator::make($credentials,$rules,$message);

        $password = Input::get('password');
        $work_id = Input::get('work_id');
        Session::put('work_id', $work_id);
        if(($password === (DB::table('worker_list')->where('password',$password)->value('password'))) and ((int)$work_id === (DB::table('worker_list')->where('work_id',$work_id)->value('work_id')))){
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
        return view('employee.login');
    }


    // 管理者用認証処理
    
    // 外部からの編集画面呼出への処理
    // charge/login -> charge/list
    public function getList(){
        
        if(!Session::has('work_id')){
            return redirect('/');
        }else if((DB::table('worker_list')->where('work_id',Session::get('work_id'))->value('name')) !== (DB::table('worker_list')->where('work_id',Session::get('work_id'))->value('manager_name')) ){
            // 上の式をなんとかしたい
            Session::flush();
            return redirect('/');
        }
        //return Session::get('work_id');


        $users = DB::table('safe_info')
          ->join('worker_list','safe_info.work_id', '=', 'worker_list.work_id')
          ->whereNotIn('safe_info.safety', ['問題ない'])
          ->get();

        return view('charge.list',compact('users'));
        //return '<h1 style="margin:2em auto;text-align:center">ログインしていない状態では閲覧することはできません</h1>';
    }

    // ログイン時の処理
    // charge/login -> charge/list
    public function postlist() {
        
        $credentials = [
            'work_id'=>Input::get('work_id'),
            'password'=>Input::get('password')
        ];

        $rules = [
            'work_id'=>'required|regex:/^[0-9a-zA-Z]+$/', // 全角が普通に通るので要修正:正規表現で対応
            'password'=>'required|min:8|max:8',
        ];
        
        $message = [
            'work_id.required' => '社員IDが未入力です',
            'work_id.regex' => '社員IDは半角英数字のみ有効です',
            'password.required' => 'パスワードが未入力です',
            'password.min' => 'パスワードは8文字になります',
            'password.max' => 'パスワードは8文字になります',
        ];

        $validator = \Validator::make($credentials,$rules,$message);

        $users = DB::table('safe_info')
          ->join('worker_list','safe_info.work_id', '=', 'worker_list.work_id')
          ->whereNotIn('safe_info.safety', ['問題ない'])
          ->get();

        $password = Input::get('password'); // 個別取得
        $work_id = Input::get('work_id');   // 個別取得
        
          //セッション保存
        Session::put('work_id', $work_id);

        if(($password === (DB::table('worker_list')->where('password',$password)->value('password'))) 
        and ( (int)$work_id === (DB::table('worker_list')->where('work_id',$work_id)->value('work_id')))
        and ( (DB::table('worker_list')->where('work_id',$work_id)->value('name')) === (DB::table('worker_list')->where('work_id',$work_id)->value('manager_name')))){
          //return Session::all();
          //Session::regenerateToken();
          return view('charge.list',compact('credentials','users'));
        }else{
            return Redirect::back()
                ->withErrors($validator)
                ->withInput();
        }
    }

    // 入場
    // charge/edit -> charge/edit/{id}
    public function getedit($id){
        //return Session::all();
        if(!Session::has('work_id')){
          Session::forget('work_id');
          return redirect('/');
          //return '<h1 style="margin:2em auto;text-align:center">ログインしていない状態では閲覧することはできません</h1>';
        }else if((DB::table('worker_list')->where('work_id',Session::get('work_id'))->value('name')) !== (DB::table('worker_list')->where('work_id',Session::get('work_id'))->value('manager_name')) ){
            Session::flush();
            return redirect('/');
        }

          // 個別編集ログイン時にメール送信。
          //振り分けようのメールアドレスをつくる
          // $noReportMail = 
        // if(DB::table('safe_info')->where('work_id',$id)->value('safety')  == '報告なし'){
        //     Mail::send('email.safe', ['name' => (DB::table('worker_list')->where('work_id', $id)->value('name'))], function($message) {
        //         $message->to('')->subject('安否報告なしのための確認連絡'); //確認用メール
        //     });
        // }

        
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
        Session::flush();
        return redirect('/');
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

    // logout -> / 
    public function sessionkill(){
        if(!Session::has('work_id')){
            Session::flush();
            return redirect('/');
            //return '無効です';
        }
        // Session::forget('editManeger_comment');
        Session::flush();
        // 確認用 return Session::all();

        //return view('/index');
        return redirect('/');
        //return redirect()->route('../index');
    }

    // CSV吐出
    public function csv()
        {
            $keyword = \Input::get('keyword');
            $query = User::query();

            if(!empty($keyword))
            {
                //修正
                $query->where('email','like','%'.$keyword.'%');
            }

            $users = $query->get();
            $stream = fopen('php://temp','w');

            foreach($users as $user)
            {   
                fputcsv($stream,[$user->id,$user->name]);
            }

            rewind($stream);
            $csv = mb_convert_encoding(str_replace(PHP_EOL, "\r\n", stream_get_contents($stream)), 'SJIS', 'UTF-8');
            $filename = "users_".date('Ymd').".csv";
            $headers = array(
                'Content-Type' => 'text/csv',
                'Content-Disposition' => 'attachment; filename="' . $filename . '"'
            );
            return \Response::make($csv, 200, $headers);
        }




// 以下検証用に作ったもの
    public function dbshow(){

    }

    public function dbedit($id){
        return "Hello";
    }


}