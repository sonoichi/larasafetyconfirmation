@extends('layout')

@section('content')
<div class="container" style="text-align:center;">
  <div class="jumbotron" style="margin-top:2em">
    <h2>災害安否確認アプリ</h2>
    <p>下記画面より利用する項目を選択してください</p>
    <a class="btn" href="{{ action('LoginController@employee') }}" title="安否情報の登録はこちらから"><p>一般用</p></a><br/>
    <a class="btn" href="{{ action('LoginController@charge') }}" title="安否情報の確認はこちらから"><p>管理者用</P></a><br/>
    <a class="btn" href="{{ url('register')}}" title="新規ユーザーの登録はこちらから"><p>新規ユーザの登録</p></a>
  </div>
</div>
@endsection