@extends('layout')

@section('content')
<div class="container" style="text-align:center;">
    <h1>災害安否確認システム</h1>
    <p>下記画面より選択してください</p>
    <a href="{{ action('LoginController@employee') }}">一般用</a><br/>
    <a href="{{ action('LoginController@charge') }}">管理者用</a>
</div>
@endsection