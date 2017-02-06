@extends('layout')

@section('content')
<div class="container panel panel-default" style="margin-top:2em">
  <div>
    <h1 style="text-align:center;"><span class="underline">ログイン</span></h1>
    <p>こちらは管理者向けログイン画面となります。</p>
    <p></p>
  </div>
    <form class="form-horizontal" role="form" method="POST" action="/charge/list">
        {{ csrf_field() }}

            <div class="container">
               <ul>
               {{-- エラーパターン 社員ID:3 * パスワード：3 => 計:9 --}}
               {{-- 何かいい方法があったら変更する --}}     
                                                                                {{-- エラーがないとき:1 --}}
               @if ($errors->has('work_id')  and !($errors->has('password'))  ) {{-- 社員IDのみエラー：2 --}}
                 <li><strong class="text-danger">{{ $errors->first('work_id') }}</strong></li>
               @endif
               @if ($errors->has('password') and !($errors->has('work_id'))  )  {{-- パスワードのみエラー：2 --}}
                 <li><strong class="text-danger">{{ $errors->first('password') }}</strong></li>
               @endif
               @if ($errors->first('work_id') == '社員IDが未入力です' and $errors->first('password') == 'パスワードが未入力です' )  {{-- 社員IDとパスワードが未入力：1 --}}
                 <li><strong class="text-danger">社員IDとパスワードが未入力です</strong></li>
               @elseif ($errors->has('password') and $errors->has('work_id'))     {{-- 社員IDとぱすわーどのエラー（両方未入力を除く）:3 --}}
                 <li><strong class="text-danger">{{ $errors->first('work_id') }}</strong></li>
                 <li><strong class="text-danger">{{ $errors->first('password') }}</strong></li>
               @endif
               </ul>
            </div>

        @if(!($errors->has('work_id') or $errors->has('password')))
            <div class="container">
              <p class="text-danger">入力項目はすべて必須となります</p>
            </div>
        @endif
        <div class="form-group{{ $errors->has('work_id') ? ' has-error' : '' }}">
            <label for="work_id" class="col-md-4 control-label">社員ID</label>

            <div class="col-md-6">
                <input id="work_id" type="work_id" class="form-control" name="work_id" value="{{ old('work_id') }}"  autofocus>

                <!--@if ($errors->has('work_id'))
                    <span class="help-block">
                        <strong>{{ $errors->first('work_id') }}</strong>
                    </span>
                @endif-->
            </div>
        </div>

        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
            <label for="password" class="col-md-4 control-label">パスワード</label>

            <div class="col-md-6">
                <input id="password" type="password" class="form-control" name="password" >

                <!--@if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif-->
            </div>
        </div>

        <!--<div class="form-group">
            <div class="col-md-6 col-md-offset-4">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : ''}}> パスワードを記録する
                    </label>
                </div>
            </div>
        </div>-->

        <div class="form-group">
            <div class="" style="text-align:center">
                <button type="submit" class="btn btn-primary">
                    ログイン
                </button>
                <a class="btn btn-danger"  style="margin:0 1.4em">
                   リセット
                </a>
                <!--<a class="btn btn-link" href="{{ url('/password/reset') }}">
                    パスワードを忘れてしまった?
                </a>-->
            </div>
        </div>
    </form>
        <div style="text-align:right; margin:0 3em 1.5em auto">
          <a class="btn btn-default" href="{{ url('../') }}">戻る</a>
        </div>
</div>
@endsection