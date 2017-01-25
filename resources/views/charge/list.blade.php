@extends('layout')

@section('content')
<!-- リストを表示する
  // ルーチンの内容 
  // どこから呼ばれる
  // 

-->
<div class="container">
  <h2>安否確認リスト</h2>
  <p class="text-warning">* 安否情報で報告なし/問題ありの人のみリストにあがります。</p>
  <p style="text-align:right;">ようこそ。責任者：{{DB::table('worker_list')->where('work_id',$_POST['work_id'])->value('name') }}さん</p></br>
  <p style="text-align:right;"><a class="btn btn-default" href="{{ action('LoginController@sessionkill') }}">ログアウト</a></p>
  <hr>
<!-- 確認用
<table class="table" style="margin:0 12px;">
  <tr>
    <td>社員氏名</td>
    <td>連絡先</td>
    <td>住所</td>
    <td>メールアドレス</td>
    <td>所属部署</td>
    <td>責任者名</td>
    <td>責任者連絡先</td>
  </tr>
<tr>
</tr>
</table>
-->
部門ごとの表示

  <ul class="nav nav-tabs">
    <li class="nav-item">
      <a href="#tab1" class="nav-link navbar-default active" data-toggle="tab">営業</a>
    </li>
    <li class="nav-item">
      <a href="#tab2" class="nav-link navbar-default" data-toggle="tab">営業第二</a>
    </li>
    <li class="nav-item">
      <a href="#tab3" class="nav-link navbar-default" data-toggle="tab">営業第三</a>
    </li>
    <li class="nav-item">
      <a href="#tab4" class="nav-link navbar-default" data-toggle="tab">営業第四</a>
    </li>
    <li class="nav-item">
      <a href="#tab5" class="nav-link navbar-default" data-toggle="tab">営業第五</a>
    </li>
  </ul>
  <!--タブの中身-->
  <div class="tab-content">
    <div id="tab1" class="tab-pane active">
      <!--Tab1の内容-->
  <table class="table table-hover-rows" style="margin:0 12px;">
    <tr>
      <td>社員氏名</td>
      <td>連絡先</td>
      <td>メールアドレス</td>
      <td>住所</td>
      <td>所属部署</td>
      <td>責任者名</td>
      <td>責任者連絡先</td>
      <td>安否情報</td>
      <td></td>
    </tr>
@foreach($users as $worker_list)
@if(($worker_list->department)=='営業') 
<tr>
      <td>{{$worker_list->name}}</td>
      <td>{{$worker_list->tell}}</td>
      <td>{{$worker_list->email}}</td>
      <td>{{$worker_list->zip}}</td>
      <td>{{$worker_list->department}}</td>
      <td>{{$worker_list->manager_name}}</td>
      <td>{{$worker_list->manager_tell}}</td>
      <td>{{$worker_list->safety}}</td>
      <td><a href="edit/{{$worker_list->work_id}}">編集</a></td>
</tr>
@endif
@endforeach
  </table>
    </div>

    <div id="tab2" class="tab-pane">
     <!--Tab２の内容-->
  <table class="table" style="margin:0 12px;">
    <tr>
      <td>社員氏名</td>
      <td>連絡先</td>
      <td>住所</td>
      <td>メールアドレス</td>
      <td>所属部署</td>
      <td>責任者名</td>
      <td>責任者連絡先</td>
      <td>安否情報</td>
      <td></td>
    </tr>


@foreach($users as $worker_list)
@if(($worker_list->department)=='営業第二') 
<tr>
      <td>{{$worker_list->name}}</td>
      <td>{{$worker_list->tell}}</td>
      <td>{{$worker_list->email}}</td>
      <td>{{$worker_list->zip}}</td>
      <td>{{$worker_list->department}}</td>
      <td>{{$worker_list->manager_name}}</td>
      <td>{{$worker_list->manager_tell}}</td>
      <td>{{$worker_list->safety}}</td>
      <td><a href="edit/{{$worker_list->work_id}}">編集</a></td>
</tr>
@endif
@endforeach

  </table>

    </div>
    <div id="tab3" class="tab-pane">
     <!--Tab３の内容-->
  <table class="table" style="margin:0 12px;">
    <tr>
      <td>社員氏名</td>
      <td>連絡先</td>
      <td>住所</td>
      <td>メールアドレス</td>
      <td>所属部署</td>
      <td>責任者名</td>
      <td>責任者連絡先</td>
      <td>安否情報</td>
      <td></td>     
    </tr>


@foreach($users as $worker_list)
@if(($worker_list->department)=='営業第三') 
<tr>
      <td>{{$worker_list->name}}</td>
      <td>{{$worker_list->tell}}</td>
      <td>{{$worker_list->email}}</td>
      <td>{{$worker_list->zip}}</td>
      <td>{{$worker_list->department}}</td>
      <td>{{$worker_list->manager_name}}</td>
      <td>{{$worker_list->manager_tell}}</td>
      <td>{{$worker_list->safety}}</td>
      <td><a href="edit/{{$worker_list->work_id}}">編集</a></td>
</tr>
@endif
@endforeach

  </table>

    </div>
    <div id="tab4" class="tab-pane">
     <!--Tab４の内容-->
  <table class="table" style="margin:0 12px;">
    <tr>
      <td>社員氏名</td>
      <td>連絡先</td>
      <td>住所</td>
      <td>メールアドレス</td>
      <td>所属部署</td>
      <td>責任者名</td>
      <td>責任者連絡先</td>
      <td>安否情報</td>
      <td></td>
    </tr>


@foreach($users as $worker_list)
@if(($worker_list->department)=='営業第四') 
<tr>
      <td>{{$worker_list->name}}</td>
      <td>{{$worker_list->tell}}</td>
      <td>{{$worker_list->email}}</td>
      <td>{{$worker_list->zip}}</td>
      <td>{{$worker_list->department}}</td>
      <td>{{$worker_list->manager_name}}</td>
      <td>{{$worker_list->manager_tell}}</td>
      <td>{{$worker_list->safety}}</td>
      <td><a href="edit/{{$worker_list->work_id}}">編集</a></td>
</tr>
@endif
@endforeach

  </table>

    </div>
    <div id="tab5" class="tab-pane">
     <!--Tab４の内容-->
  <table class="table" style="margin:0 12px;">
    <tr>
      <td>社員氏名</td>
      <td>連絡先</td>
      <td>住所</td>
      <td>メールアドレス</td>
      <td>所属部署</td>
      <td>責任者名</td>
      <td>責任者連絡先</td>
      <td>安否情報</td>
      <td></td>
    </tr>


@foreach($users as $worker_list)
@if(($worker_list->department)=='営業第五') 
<tr>
      <td>{{$worker_list->name}}</td>
      <td>{{$worker_list->tell}}</td>
      <td>{{$worker_list->email}}</td>
      <td>{{$worker_list->zip}}</td>
      <td>{{$worker_list->department}}</td>
      <td>{{$worker_list->manager_name}}</td>
      <td>{{$worker_list->manager_tell}}</td>
      <td>{{$worker_list->safety}}</td>
      <td><a href="edit/{{$worker_list->work_id}}">編集</a></td>
</tr>
@endif
@endforeach

  </table>

    </div>
  </div>




</div>
@endsection