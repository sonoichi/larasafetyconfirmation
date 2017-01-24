@extends('layout')

@section('content')
<div class="container" style="text-align:center; margin-right: auto; margin-left:auto;">
  <div style="margin-top:2em;">
    <p>下記の内容で投稿されています</p>
    <a class="btn" href="{{ url('/') }}">戻る</a>
  </div>
</div>
@endsection