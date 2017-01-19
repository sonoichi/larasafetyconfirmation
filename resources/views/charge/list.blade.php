@extends('layout')

@section('content')
<div class="container">
  <h2>安否確認リスト</h2>
  <p style="text-align:right;">ようこそ。責任者：(())さん</p></br>
  <a href="{{ action('LoginController@charge') }}"><p style="text-align:right;">戻る</p></a>
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


@foreach($worker_lists as $worker_list)
<tr>
      <td>{{$worker_list->name}}</td>
      <td>{{$worker_list->tell}}</td>
      <td>{{$worker_list->email}}</td>
      <td>{{$worker_list->zip}}</td>
      <td>{{$worker_list->department}}</td>
      <td>{{$worker_list->manager}}</td>
      <td>{{$worker_list->manager_tell}}</td>
      <td><a href="{{ action('LoginController@edit') }}">編集</a></td>
</tr>
@endforeach

  </table>
-->
部門ごとの表示

  <ul class="nav nav-tabs">
    <li class="nav-item">
      <a href="#tab1" class="nav-link navbar-default active" data-toggle="tab">部門０１</a>
    </li>
    <li class="nav-item">
      <a href="#tab2" class="nav-link navbar-default" data-toggle="tab">部門０２</a>
    </li>
    <li class="nav-item">
      <a href="#tab3" class="nav-link navbar-default" data-toggle="tab">部門０３</a>
    </li>
    <li class="nav-item">
      <a href="#tab4" class="nav-link navbar-default" data-toggle="tab">部門０４</a>
    </li>
    <li class="nav-item">
      <a href="#tab5" class="nav-link navbar-default" data-toggle="tab">部門０５</a>
    </li>
  </ul>
  <!--タブの中身-->
  <div class="tab-content">
    <div id="tab1" class="tab-pane active">
      <!--Tab1の内容-->
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


@foreach($worker_lists as $worker_list)
<tr>
      <td>{{$worker_list->name}}</td>
      あああああ
      <td>{{$worker_list->tell}}</td>
      <td>{{$worker_list->email}}</td>
      <td>{{$worker_list->zip}}</td>
      <td>{{$worker_list->department}}</td>
      <td>{{$worker_list->manager}}</td>
      <td>{{$worker_list->manager_tell}}</td>
      <td><a href="{{ action('LoginController@edit') }}">編集</a></td>
</tr>
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
    </tr>


@foreach($worker_lists as $worker_list)
<tr>
      <td>{{$worker_list->name}}</td>
      いいいいい
      <td>{{$worker_list->tell}}</td>
      <td>{{$worker_list->email}}</td>
      <td>{{$worker_list->zip}}</td>
      <td>{{$worker_list->department}}</td>
      <td>{{$worker_list->manager}}</td>
      <td>{{$worker_list->manager_tell}}</td>
      <td><a href="{{ action('LoginController@edit') }}">編集</a></td>
</tr>
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
    </tr>


@foreach($worker_lists as $worker_list)
<tr>
      <td>{{$worker_list->name}}</td>
      <td>{{$worker_list->tell}}</td>
      <td>{{$worker_list->email}}</td>
      <td>{{$worker_list->zip}}</td>
      <td>{{$worker_list->department}}</td>
      <td>{{$worker_list->manager}}</td>
      <td>{{$worker_list->manager_tell}}</td>
      <td><a href="{{ action('LoginController@edit') }}">編集</a></td>
</tr>
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
    </tr>


@foreach($worker_lists as $worker_list)
<tr>
      <td>{{$worker_list->name}}</td>
      <td>{{$worker_list->tell}}</td>
      <td>{{$worker_list->email}}</td>
      <td>{{$worker_list->zip}}</td>
      <td>{{$worker_list->department}}</td>
      <td>{{$worker_list->manager}}</td>
      <td>{{$worker_list->manager_tell}}</td>
      <td><a href="{{ action('LoginController@edit') }}">編集</a></td>
</tr>
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
    </tr>


@foreach($worker_lists as $worker_list)
<tr>
      <td>{{$worker_list->name}}</td>
      <td>{{$worker_list->tell}}</td>
      <td>{{$worker_list->email}}</td>
      <td>{{$worker_list->zip}}</td>
      <td>{{$worker_list->department}}</td>
      <td>{{$worker_list->manager}}</td>
      <td>{{$worker_list->manager_tell}}</td>
      <td><a href="{{ action('LoginController@edit') }}">編集</a></td>
</tr>
@endforeach

  </table>

    </div>
  </div>




</div>
@endsection