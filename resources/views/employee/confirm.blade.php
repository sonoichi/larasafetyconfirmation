@extends('layout')

@section('css')
<style>

</style>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css">
@endsection

@section('content')
<div class="container panel panel-default" style="margin:2em auto 0 auto;">
    <section class="underline">
    <div class="container">
      <div class="row">
        <h2 class="col-xs-10 bleft">安否確認入力画面</h2>
        <a class="hidden-xs btn btn-danger" style="margin-top:1.6em;" href="{{action('LoginController@sessionkill')}}">ログアウト</a>
        <a class="visible-xs col-xs-1 btn btn-danger" style="margin-top:1.6em;" href="{{action('LoginController@sessionkill')}}"><i class="icon-logout">  </i></a>
      </div>
    </div>
      <p  class="" style="text-align:right;">こんにちは、{{ DB::table('worker_list')->where('work_id', Session::get('work_id'))->value('name')  }}さん</p>
    </section>

   {!! Form::open(['action' => 'SafeController@store', 'id' => 'confirmForm']) !!}
   <!--{!! Form::open(['url' => '../home']) !!}-->
        {{ csrf_field() }}

        @if(($errors->has('comment')))
        <p>入力に誤りがあります</p>
            <ul>
              <li><strong class="text-danger">{{ $errors->first('comment') }}</strong></li>
            </ul>
        @endif

        <input type="hidden" name="work_id" value="{{Session::get('work_id')}}">
        <div class="form-group{{ $errors->has('safety') ? ' has-error' : '' }}">
            <div class="col-md-12">
            <h3 class="bleft">状況確認</h3>
            <p><b>▼ 体調の確認：「調子はどうですか？」   <span class="text-danger"> ※必須</span></b></p>
                <input id="noReport" type="hidden" name="safety" value="報告なし">
                <input id="good" type="radio" name="safety" value="問題ない" checked>問題なし  <i class="icon-like"></i>　　　
                <input id="bad" type="radio" name="safety" value="問題あり">問題あり  <i class="icon-dislike"></i>
            </div>
        </div>

        <div class="form-group{{ $errors->has('comment') ? ' has-error' : '' }}">
            <label for="comment" class="col-md-12 control-label"><br/>▼ コメントを残す (30文字以内)</label>

            <div class="col-md-12">
                <input id="comment" type="comment" class="form-control" name="comment">
            </div>
        </div>

        <div class="form-group">
            <input id="date" type="hidden" class="form-control" name="date">
                <div class="">
                  <div style="text-align:center" class="">
                  <button style="margin:20px;" id="opener" type="button" class="confirmCheck btn btn-primary">
                    送信
                  </button>
                  <button type="reset" class="btn btn-danger">
                    リセット
                  </button>
                  </div>
                </div>
                <!-- 確認ダイアログ -->
                    <div id="dialog">
                    <p>送信しても宜しいでしょうか？</p>
                    </div>
                <!--<a class="btn btn-default" href="{{ action('SafeController@postconfirm') }}">
                確認
                </a>-->
        </div>
    {!! Form::close() !!}
    <div style="text-align:right">
      <a href="{{action('SafeController@postcheck')}}" style="margin:0 1.6em 1.6em 1.6em;" class="btn btn-default">投稿確認</a>
    </div>
</div>

@endsection

@section('script')
<script>
$( "#dialog" ).dialog({ autoOpen: false });

$( "#opener" ).click(function() {
    $( "#dialog" ).dialog( "open" );
    $( "#dialog" ).dialog({
      //autoOpen: false,
      title: "送信確認",
      resizable: false,
      height:240,
      modal: true,
      buttons: {
        "はい": function() {
        　$('#confirmForm').submit();
        },
        "いいえ": function() {
          $( this ).dialog( "close" );
        }
      }
    });
});
</script>	
@endsection