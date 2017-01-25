@extends('layout')

@section('content')
<div class="container">
  <div style="text-align:center;">
    <h1>ログイン</h1>
    <p>こちらは管理者向けログイン画面となります。</p>
    <p></p>
  </div>
    <form class="form-horizontal" role="form" method="POST" action="/charge/list">
        {{ csrf_field() }}
        @if($errors->has('work_id') or $errors->has('password'))
            <div class="container">
               <p>以下の項目が入力条件と一致していないためログインできません。</p>
               <strong class="text-danger">{{ $errors->first('work_id') }}</strong>
               <strong class="text-danger">{{ $errors->first('password') }}</strong>
            </div>
        @endif
        @if(!($errors->has('work_id') or $errors->has('password')))
            <div class="container">
              <p>入力項目はすべて必須となります</p>
            </div>
        @endif
        <div class="form-group{{ $errors->has('work_id') ? ' has-error' : '' }}">
            <label for="work_id" class="col-md-4 control-label">社員ID</label>

            <div class="col-md-6">
                <input id="work_id" type="work_id" class="form-control" name="work_id" value="{{ old('work_id') }}" required autofocus>

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
                <input id="password" type="password" class="form-control" name="password" required>

                <!--@if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif-->
            </div>
        </div>
<!--
        <div class="form-group">
            <div class="col-md-6 col-md-offset-4">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : ''}}> パスワードを記録する
                    </label>
                </div>
            </div>
        </div>
-->
        <div class="form-group">
            <div class="col-md-8 col-md-offset-4">
                <button type="submit" class="btn btn-primary">
                    ログイン
                </button>

                <!--<a class="btn btn-link" href="{{ url('/password/reset') }}">
                    パスワードを忘れてしまった?
                </a>-->
            </div>
        </div>
        <div style="text-align:right">
          <a class="btn btn-default" href="{{ url('../') }}">戻る</a>
        </div>
    </form>

</div>
@endsection