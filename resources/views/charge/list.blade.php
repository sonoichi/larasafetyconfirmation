@extends('layout')

@section('css')
  <style>
  /* 管理者項目 */
    .manager{
      background: #636b6f;
      color:#fff;
    }
    .theadList{
      background: #636b6f;
      color:#fff
    }
    .nav-tabs{
      border-bottom:1px solid #000;
    }
  </style>
@endsection

@section('content')
<!-- リストを表示する
  // ルーチンの内容 
  // どこから呼ばれる
  // 

-->
<div class="container panel panel-default">
<section class="underline">
  <div class="container">
    <div class="row">
    <div class="col-xs-10">
      <h2 class="bleft">安否確認リスト</h2>
      <p class="text-warning">* 安否情報で報告なし/問題ありの人のみリストにあがります。</p>
    </div>
      <div class="col-xs-2">
        <a class="btn btn-danger hidden-xs"  style="margin-top:1.6em;" href="{{ action('LoginController@sessionkill') }}">ログアウト</a>
        <a class="btn btn-danger visible-xs"  style="margin-top:1.6em;" href="{{ action('LoginController@sessionkill') }}"><i class="icon-logout"></i></a>
      </div>
    </div>
    
    
  </div>
  
  <p style="text-align:right;">ようこそ、社員ID： {{Session::get('work_id')}} 、責任者： {{DB::table('worker_list')->where('work_id',Session::get('work_id'))->value('name') }}さん</p></br>
</section>
<br/>
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
<h3 class="bleft">安否情報一覧</h3>
<p style="text-align:right">タブメニューより
閲覧したい部門を選んでください。</p>
  <ul class="nav nav-tabs">
    <li class="nav-item">
      <a href="#tab1" class="nav-link navbar-default" data-toggle="tab" >営業</a>
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
  <div class="tab-content" style="margin-bottom:2.4em;">
    <div id="tab1" class="tab-pane">
      <!--Tab1の内容-->
  <div class="table-responsive">
  <table class="table table-striped" style="margin:0 12px;">
  <thead class="theadList">
    <tr>
      <td>社員氏名</td>
      <td>連絡先</td>
      <td>メールアドレス</td>
      <td>住所</td>
      <td class="manager">所属部署</td>
      <td class="manager" >責任者名</td>
      <td class="manager" >責任者連絡先</td>
      <td>安否情報</td>
      <td></td>
    </tr>
  </thead>
@foreach($users as $worker_list)
@if(($worker_list->department)=='営業') 
<tr>
      <td>{{$worker_list->name}}</td>
      <td>{{$worker_list->tell}}</td>
      <td>{{$worker_list->email}}</td>
      <td>{{$worker_list->zip}}</td>
      <td class="manager">{{$worker_list->department}}</td>
      <td class="manager">{{$worker_list->manager_name}}</td>
      <td class="manager">{{$worker_list->manager_tell}}</td>
      <td>{{$worker_list->safety}}</td>
      <td><a href="edit/{{$worker_list->work_id}}">編集</a></td>
</tr>
@endif
@endforeach
  </table>
  </div>
    </div>

    <div id="tab2" class="tab-pane">
     <!--Tab２の内容-->
  <div class="table-responsive">
  <table class="table" style="margin:0 12px;">
  <thead class="theadList">
    <tr>
      <td>社員氏名</td>
      <td>連絡先</td>
      <td>メールアドレス</td>
      <td>住所</td>
      <td class="manager">所属部署</td>
      <td class="manager" >責任者名</td>
      <td class="manager" >責任者連絡先</td>
      <td>安否情報</td>
      <td></td>
    </tr>
  </thead>


@foreach($users as $worker_list)
@if(($worker_list->department)=='営業第二') 
<tr>
      <td>{{$worker_list->name}}</td>
      <td>{{$worker_list->tell}}</td>
      <td>{{$worker_list->email}}</td>
      <td>{{$worker_list->zip}}</td>
      <td class="manager">{{$worker_list->department}}</td>
      <td class="manager">{{$worker_list->manager_name}}</td>
      <td class="manager">{{$worker_list->manager_tell}}</td>
      <td>{{$worker_list->safety}}</td>
      <td><a href="edit/{{$worker_list->work_id}}">編集</a></td>
</tr>
@endif
@endforeach

  </table>
  </div>

    </div>
    <div id="tab3" class="tab-pane">
     <!--Tab３の内容-->
  <div class="table-responsive">
  <table class="table" style="margin:0 12px;">
  <thead class="theadList">
    <tr>
      <td>社員氏名</td>
      <td>連絡先</td>
      <td>メールアドレス</td>
      <td>住所</td>
      <td class="manager">所属部署</td>
      <td class="manager" >責任者名</td>
      <td class="manager" >責任者連絡先</td>
      <td>安否情報</td>
      <td></td>
    </tr>
  </thead>


@foreach($users as $worker_list)
@if(($worker_list->department)=='営業第三') 
<tr>
      <td>{{$worker_list->name}}</td>
      <td>{{$worker_list->tell}}</td>
      <td>{{$worker_list->email}}</td>
      <td>{{$worker_list->zip}}</td>
      <td class="manager">{{$worker_list->department}}</td>
      <td class="manager">{{$worker_list->manager_name}}</td>
      <td class="manager">{{$worker_list->manager_tell}}</td>
      <td>{{$worker_list->safety}}</td>
      <td><a href="edit/{{$worker_list->work_id}}">編集</a></td>
</tr>
@endif
@endforeach

  </table>
  </div>

    </div>
    <div id="tab4" class="tab-pane">
     <!--Tab４の内容-->
  <div class="table-responsive">
  <table class="table" style="margin:0 12px;">
  <thead class="theadList">
    <tr>
      <td>社員氏名</td>
      <td>連絡先</td>
      <td>メールアドレス</td>
      <td>住所</td>
      <td class="manager">所属部署</td>
      <td class="manager" >責任者名</td>
      <td class="manager" >責任者連絡先</td>
      <td>安否情報</td>
      <td></td>
    </tr>
  </thead>


@foreach($users as $worker_list)
@if(($worker_list->department)=='営業第四') 
<tr>
      <td>{{$worker_list->name}}</td>
      <td>{{$worker_list->tell}}</td>
      <td>{{$worker_list->email}}</td>
      <td>{{$worker_list->zip}}</td>
      <td class="manager">{{$worker_list->department}}</td>
      <td class="manager">{{$worker_list->manager_name}}</td>
      <td class="manager">{{$worker_list->manager_tell}}</td>
      <td>{{$worker_list->safety}}</td>
      <td><a href="edit/{{$worker_list->work_id}}">編集</a></td>
</tr>
@endif
@endforeach

  </table>
  </div>

    </div>
    <div id="tab5" class="tab-pane">
     <!--Tab４の内容-->
  <div class="table-responsive">
  <table class="table" style="margin:0 12px;">
  <thead class="theadList">
    <tr>
      <td>社員氏名</td>
      <td>連絡先</td>
      <td>メールアドレス</td>
      <td>住所</td>
      <td class="manager">所属部署</td>
      <td class="manager" >責任者名</td>
      <td class="manager" >責任者連絡先</td>
      <td>安否情報</td>
      <td></td>
    </tr>
  </thead>


@foreach($users as $worker_list)
@if(($worker_list->department)=='営業第五') 
<tr>
      <td>{{$worker_list->name}}</td>
      <td>{{$worker_list->tell}}</td>
      <td>{{$worker_list->email}}</td>
      <td>{{$worker_list->zip}}</td>
      <td class="manager">{{$worker_list->department}}</td>
      <td class="manager">{{$worker_list->manager_name}}</td>
      <td class="manager">{{$worker_list->manager_tell}}</td>
      <td>{{$worker_list->safety}}</td>
      <td><a href="edit/{{$worker_list->work_id}}">編集</a></td>
</tr>
@endif
@endforeach

  </table>
  </div>

    </div>
  </div>
</div>
@endsection