@extends('layout')

@section('content')
<div class="container panel panel-default" style="margin:2em auto 0 auto;">
  <h2>安否確認：入力フォーム</h2>

  <p style="text-align:right;">こんにちは、{{ DB::table('worker_list')->where('work_id', Session::get('work_id'))->value('name')  }}さん</p>
    <div class="col-md-12" style="margin:1.2em; text-align:right;">
        <a class="btn btn-default" href="{{action('LoginController@sessionkill')}}">ログアウト</a>
    </div>

   {!! Form::open(['action' => 'SafeController@store']) !!}
   <!--{!! Form::open(['url' => '../home']) !!}-->
        {{ csrf_field() }}
        <input type="hidden" name="work_id" value="{{Session::get('work_id')}}">
        <div class="form-group{{ $errors->has('safety') ? ' has-error' : '' }}">
            <div class="col-md-12">
            <h3>安否確認</h3>
            <p>調子はどうですか？</p>
                <input id="noReport" type="hidden" name="safety" value="報告なし">
                <input id="good" type="radio" name="safety" value="問題ない" checked>もんだいなし　　　
                <input id="bad" type="radio" name="safety" value="問題あり">もんだいあり
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
                <button type="submit" class="confirmCheck btn btn-primary">
                    送信
                </button>
                <!--<div id="dialogConfirm">
                  <p>送信しますか？</p>
                </div>-->
                <!--<a class="btn btn-default" href="{{ action('SafeController@postconfirm') }}">
                確認
                </a>-->
            </div>
        </div>
    {!! Form::close() !!}

</div>
@endsection