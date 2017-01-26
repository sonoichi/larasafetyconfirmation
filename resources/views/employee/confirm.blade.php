@extends('layout')

@section('css')
<link rel="stylesheet" href="http://code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css">
@endsection

@section('content')
<div class="container panel panel-default" style="margin:2em auto 0 auto;">
  <h2>安否確認：入力フォーム</h2>

  <p style="text-align:right;">こんにちは、{{ DB::table('worker_list')->where('work_id', Session::get('work_id'))->value('name')  }}さん</p>
    <div class="col-md-12" style="margin:1.2em; text-align:right;">
        <a class="btn btn-default" href="{{action('LoginController@sessionkill')}}">ログアウト</a>
    </div>

   {!! Form::open(['action' => 'SafeController@store', 'id' => 'confirmForm']) !!}
   <!--{!! Form::open(['url' => '../home']) !!}-->
        {{ csrf_field() }}
        <input type="hidden" name="work_id" value="{{Session::get('work_id')}}">
        <div class="form-group{{ $errors->has('safety') ? ' has-error' : '' }}">
            <div class="col-md-12">
            <h3>安否確認</h3>
            <p>調子はどうですか？</p>
                <input id="noReport" type="hidden" name="safety" value="報告なし">
                <input id="good" type="radio" name="safety" value="問題ない" checked>もんだいなし <i class="icon-like"></i>　　　
                <input id="bad" type="radio" name="safety" value="問題あり">もんだいあり <i class="icon-dislike"></i>
            </div>
        </div>

        <div class="form-group{{ $errors->has('comment') ? ' has-error' : '' }}">
            <label for="comment" class="col-md-12 control-label">コメントを残す</label>

            <div class="col-md-12">
                <input id="comment" type="comment" class="form-control" name="comment">
            </div>
        </div>

        <div class="form-group">
            <div style="text-align:right;" class="col-md-2 col-md-offset-10">
                <button id="opener" type="button" class="confirmCheck btn btn-primary">
                    送信
                </button>
                <!-- 確認ダイアログ -->
                    <div id="dialog">
                    <p>送信しても宜しいでしょうか？</p>
                    </div>
                <!--<a class="btn btn-default" href="{{ action('SafeController@postconfirm') }}">
                確認
                </a>-->
            </div>
        </div>
    {!! Form::close() !!}

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