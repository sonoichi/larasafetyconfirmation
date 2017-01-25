<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// 画面の一覧
// e.g.) index -> login

Route::get('/', function () {
    return view('index');
});

// ログイン画面へ移動
// index -> charge.login
Route::get('/charge/login','LoginController@charge');
// index -> employee.login
Route::get('/employee/login','LoginController@employee');

// 編集画面
// charge
Route::get('/charge/edit','LoginController@edit');

// 一般用管理画面遷移
Auth::routes();
Route::get('/employee/confirm','LoginController@getlogin');
Route::post('/employee/confirm','LoginController@postlogin');
Route::get('/index', 'LoginController@getLogout');

// 管理者用管理画面遷移
Route::get('/charge/list', 'LoginController@getList');
Route::post('/charge/list', 'LoginController@postList');

//安否確認DB処理
//Route::get('/employee/post','SafeController@store'); //get Errorになる
Route::post('/employee/post','SafeController@store');

//投稿後の確認画面
Route::get('/employee/post', 'SafeController@postconfirm');



//仮：DB接続確認用ルート

// 編集画面処理
Route::post('charge/edit/{id}', 'LoginController@edit');
Route::get('charge/edit/{id}', 'LoginController@getedit');

Route::get('/charge/edit','EditController@link');
Route::post('/charge/edit','EditController@update');

//デバッグコード
Route::get('/debug','LoginController@dbshow');
Route::get('debug/{id}', 'LoginController@dbedit');

Route::get('/index', 'LoginController@sessionkill');
/********************************
*********************************/
//認証確認用: 以下デバッグ用確認項目
// 認証ユーザの確認/
/*
    if(!Auth::check()){      
            print ('<p>現在認証されていません</p>');
    }*/
/********************************
********************************/


//Route::get('/home', 'HomeController@index');
