@extends('layout')

@section('content')
<div class="container" style="text-align:center;">
  <div class="jumbotron" style="margin-top:2em">
    <h2>災害安否確認アプリ</h2>
    <!--<p>社員ID:{{Session::get('work_id')}}</p>-->
    <p>下記画面より利用する項目を選択してください</p>
    <p><a class="btn btn-default" href="{{ action('LoginController@employee') }}" title="安否情報の登録はこちらから">一般用</a></p><br/>
    <p><a class="btn btn-default" href="{{ action('LoginController@charge') }}" title="安否情報の確認はこちらから">管理者用</a></p><br/>
    <p><a class="btn btn-default" href="{{ url('register')}}" title="新規ユーザーの登録はこちらから">新規ユーザの登録</a></p>
  </div>
</div>
@endsection