<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $val = Validator::make($data, [
            'name' => 'required|max:30',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:8|max:8|confirmed',
            'work_id' => 'required|alpha_num'
        ],[
            'name.required' => '名前が未入力です',
            'name.max' => '名前は最大30文字です',
            'email.required' => 'メールが未入力です',
            'email' => 'メールが正しくありません',
            'work_id.required' => '社員IDが未入力です',
            'work_id.alpha_num' => '社員IDは半角英数字のみ利用可能です',
            'password.required' => 'パスワードが未入力です',
            'password.min' => 'パスワードは8文字です',
            'password.max' => 'パスワードは8文字です',
            'password.confirm' => 'パスワードが一致しません'
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
        return User::create([
            'name' => $data['name'],
            'work_id' => $data['work_id'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

}
