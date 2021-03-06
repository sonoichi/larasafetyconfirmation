<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Lists; // 追加
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Redirect;
use DB;
class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        \Session::flash('flash_check', 'checked');
        $val = Validator::make($data, [
            'name' => 'required|max:30|',
            'email' => 'required|email|max:30|unique:users,email',
            'password' => 'required|min:8|max:8|confirmed',
            'work_id' => 'required|alpha_num|regex:/^[!-~]+$/|unique:worker_list,work_id',
            'department'=> 'required'
        ],[
            'name.required' => '名前が未入力です',
            'name.max' => '名前は最大30文字です',
            'email.required' => 'メールアドレスが未入力です',
            'email.max' => 'アドレスが長すぎて登録できません',
            'email.unique' => '既に登録されているメールアドレスです',
            'email' => '正しいメールアドレスではありません',
            'work_id.required' => '社員IDが未入力です',
            'work_id.regex' => '社員IDは半角英数字のみ利用可能です',
            'work_id.alpha_num' => '社員IDは半角英数字のみ利用可能です',
            'work_id.unique' => '既にその社員IDは登録されています',
            'password.required' => 'パスワードが未入力です',
            'password.min' => 'パスワードは8文字です',
            'password.max' => 'パスワードは8文字です',
            'password.confirmed' => 'パスワードが一致しません',
            'department.required' => '所属を選んでください'
        ]);
        return $val;
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        
        Lists::create([
            'name' => $data['name'],
            'work_id' => $data['work_id'],
            'email' => $data['email'],
            'password' => ($data['password']),
            'department' => ($data['department']),
            'manager_name' => (DB::table('worker_list')->where('department' ,$data['department'])->value("manager_name")),
            'manager_tell' => (DB::table('worker_list')->where('department' ,$data['department'])->value("manager_tell")),
        ]);

        return User::create([
            'name' => $data['name'],
            'work_id' => $data['work_id'],
            'email' => $data['email'],
            'password' => ($data['password']),
        ]);

    }

    public function send(){
        $options = [
            'from' => 'hoge@hogehogehogehoge.hoge',
            'from_jp' => 'ほげほげ',
            'to' => 'fuga@fugafugafugafuga.fuga',
            'subject' => 'テストメール',
            'template' => 'emails.hoge.mail', // resources/views/emails/hoge/mail.blade.php
        ];

        $data = [
            'hoge' => 'hogehoge',
        ];
        Mail::to($options['to'])->send(new HogeShipped($options, $data));


    }

}
