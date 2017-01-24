@extends('layout')

@section('content')
<div class="container" style="text-align:center; margin-right: auto; margin-left:auto;">
  <div style="margin-top:2em;">
    <p>下記の内容で投稿されています</p>
    {{-- DB::table('worker_list')->where('work_id',$work_id)->value('name') --}}
    <table class="table table-hover-rows">
      <tr>
        <td>名前</td>
        <td>安否状態</td>
        <td>コメント</td>
        <td>管理者からのコメント</td>
        <td>更新時間</td>
      </tr>
      <tr>
        <td>{{ DB::table('worker_list')->where('work_id',$work_id)->value('name')  }}</td>
        <td>{{ DB::table('safe_info')->where('work_id',$work_id)->value('safety')  }}</td>
        <td>{{ DB::table('safe_info')->where('work_id',$work_id)->value('comment')  }}</td>
        <td>{{ DB::table('safe_info')->where('work_id',$work_id)->value('manager_comment')  }}</td>
        <td>{{ DB::table('safe_info')->where('work_id',$work_id)->value('date')  }}</td>
      </tr>
    <table>
    <a class="btn" href="{{ url('/') }}">トップへ戻る</a>
  </div>
</div>
@endsection