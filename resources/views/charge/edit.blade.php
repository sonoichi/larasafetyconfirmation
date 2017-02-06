@extends('layout')

@section('css')
<link rel="stylesheet" href="http://code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css">
@endsection

@section('content')
<div class="panel panel-default container">
  <h2 class="bleft">安否確認編集画面</h2>
  <!-- 確認用 --> 
  {{-- Session::get('editWorker') --}}
  
  <p>編集中の社員の安否情報</p>
<div class="underline">
  <div class="table-responsive">
    <table class="table">
    <thead>
        <tr>
        <td>社員ID</td>
        <td>氏名</td>
        <td>状態</td>
        <td>コメント</td>
        <td>投稿時間</td>
        </tr>
    </thead>
    @foreach($editUser as $worker_list)
        <tr>
            <td>{{$worker_list->work_id}}</td>
            <td>{{ DB::table('worker_list')->where('work_id',$worker_list->work_id)->value('name') }}</td>
            <td>{{$worker_list->safety}}</td>
            <td>{{$worker_list->comment}}</td>
            <td>{{$worker_list->date}}</td>
        <tr>
    @endforeach
    </table>
  </div>
</div>

<h2 class="bleft">編集フォーム</h2>
<!--<a class="btn btn-danger col-xs-offset-10 col-xs-2" href="">編集データの削除</a>CRUDにするよう-->

{!! Form::open(['action' => 'EditController@update','id' => 'editForm']) !!}
    {{ csrf_field() }}

    @foreach($editUser as $worker_list)
        <input id="work_id" type="hidden" name="work_id" value="{{ $worker_list->work_id }}">
    @endforeach
    <h3> <b>状況確認</b></h3>
    <div class="form-group{{ $errors->has('safety') ? ' has-error' : '' }}">
        <div class="col-md-12">
            <br class="visible-xs">
            <input id="noReport" type="radio" name="safety" value="報告なし">報告なし <i class="icon-user-unfollow"></i>　　　　
            <br class="visible-xs">
            <input id="good" type="radio" name="safety" value="問題ない">問題ない <i class="icon-like"></i>　　　　
            <br class="visible-xs">
            <input id="bad" type="radio" name="safety" value="問題あり">問題あり <i class="icon-dislike"></i>
            <!--<p class="alert-info">* ボタンが選択されない場合は報告なしになります。</p>-->
            <p></p>
        </div>
    </div>

    <h3> <b>コメント</b></h3>
    <div class="form-group{{ $errors->has('comment') ? ' has-error' : '' }}">
        <label for="comment" class="col-md-2 control-label">▼ コメントを残す</label>

        <div class="col-md-12">
            <input id="comment" type="comment" class="form-control" name="comment" value="{{ Session::get('editComment') }}" readonly="readonly">
            <p style="text-align:right;" class="text-danger">* 編集中の社員のコメントが直接編集されます。現在は読取専用となっています。</p>
        </div>
    </div>

    <h3> <b>管理者からのコメント</b></h3>
    <div class="form-group{{ $errors->has('manager_comment') ? ' has-error' : '' }}">
        <label for="manager_comment" class="col-md-2 col-lg-12 control-label">▼ 管理者コメントを残す</label>

        <div class="col-md-12">
            <input id="manager_comment" type="manager_comment" class="form-control" name="manager_comment" value="{{Session::get('editManager_comment')}}">
            <p></p>
        </div>
    </div>
        <!-- 管理者投稿時間 -->
        <input id="manager_to" type="hidden" class="form-control" name="manager_to" value="{{Session::get('editManager_comment')}}">
    <div style="text-align:left" class="form-group">
        <div class="col-md-12">
          <div style="text-align:center">
            <button id="opener" type="button" class="edit btn btn-primary">
                編集
            </button>
            <a class="btn btn-danger" style="margin:0 1.4em;">
               リセット
            </a>
          </div>
            <!-- 確認ダイアログ -->
                    <div id="dialog">
                    <p>登録しても宜しいでしょうか？</p>
                    </div>
        </div>
    </div>
{!! Form::close() !!}
<div style="text-align:right; margin:1.6em;" class="">
    <a class="btn btn-default" href="{{ action('LoginController@getList') }}">戻る</a>
</div>

</div>
@endsection

@section('script')
<!-- editページでのみ使用 -->
<!-- ラジオボタンのチェック判定 -->
<script>
$(function(){
    if('{{ Session::get('editSafety') }}'==='問題あり'){
      console.log('問題あり');
      $("#bad").attr("checked", true);
    }else if('{{ Session::get('editSafety') }}'=== '問題ない'){
      console.log('問題なし');
      $("#good").attr("checked", true);
    }else{
      $("#noReport").attr("checked", true);
      console.log('報告なし');
    }
});
</script>

<!-- 確認ダイアログ -->
<script>
$( "#dialog" ).dialog({ autoOpen: false });

$( "#opener" ).click(function() {
    $( "#dialog" ).dialog( "open" );
    $( "#dialog" ).dialog({
      //autoOpen: false,
      title: "編集確認",
      resizable: false,
      height:240,
      modal: true,
      buttons: {
        "はい": function() {
        　$('#editForm').submit();
        },
        "いいえ": function() {
          $( this ).dialog( "close" );
        }
      }
    });
});
</script>	

@endsection