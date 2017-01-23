@extends('layout')

@section('content')
<div class="container" style="text-align:center;">
  <div class="jumbotron" style="margin-top:2em">
    <h1>災害安否確認システム</h1>
    <p>下記画面より選択してください</p>
    <a href="{{ action('LoginController@employee') }}" title="安否情報の登録はこちらから"><p>一般用</p></a><br/>
    <a href="{{ action('LoginController@charge') }}" title="安否情報の確認はこちらから"><p>管理者用</P></a><br/>
    <a href=""><p>新規ユーザの登録</p></a>
  </div>
</div>
@endsection