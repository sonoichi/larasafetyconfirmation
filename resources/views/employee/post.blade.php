@extends('layout')

@section('css')
<style>
  thead{
    background: #636b6f;
    color: #FFF;
  }
</style>
@endsection


@section('content')
<div class="container panel panel-default" style="text-align:center; margin-right: auto; margin-left:auto;">
  <div class="" style="margin-top:2em;">
    <p>下記の内容で投稿されています</p>
    {{-- DB::table('worker_list')->where('work_id',$work_id)->value('name') --}}
    <table class="table table-bordered  table-hover">
    <thead class="thead-default">
      <tr>
        <td>名前</td>
        <td>安否状態</td>
        <td>コメント</td>
        <!--<td>管理者からのコメント</td>-->
        <td>投稿時間</td>
      </tr>
    </thead>
    <tbody>
      <tr class="table-success">
        <td>{{ DB::table('worker_list')->where('work_id',$work_id)->value('name')  }}</td>
        <td>{{ DB::table('safe_info')->where('work_id',$work_id)->value('safety')  }}</td>
        <td>{{ DB::table('safe_info')->where('work_id',$work_id)->value('comment')  }}</td>
        <!--<td>{{ DB::table('safe_info')->where('work_id',$work_id)->value('manager_comment')  }}</td>-->
        <td>{{ DB::table('safe_info')->where('work_id',$work_id)->value('date')  }}</td>
      </tr>
    </tbody>
    <table>
    {{-- 管理者コメント --}}
    @if(DB::table('safe_info')->where('work_id',$work_id)->where('manager_comment','!=','')->count('manager_comment'))
      <h4 style="text-align:left;" class="bleft">管理者からコメントがきています</h4>
    {{-- DB::table('safe_info')->where('work_id',$work_id)->where('manager_comment','!=','')->count('manager_comment') --}}
      <p style="text-align:left; margin-left:1.6em;">[管理者投稿時間]：{{ DB::table('safe_info')->where('work_id',$work_id)->value('manager_to') }}
      <br/>　　　　　　[コメント]：{{ DB::table('safe_info')->where('work_id',$work_id)->value('manager_comment')  }}</p>
    @endif
    <a style="margin-bottom:1.4em;" class="btn btn-default" href="{{ action('LoginController@sessionkill') }}">トップへ戻る</a>
  </div>
  
</div>
@endsection