@extends('layout')

@section('content')
<div class="container">
  <div style="text-align:center">
    <h1>ログイン</h1>
    <p>こちらは一般向けログイン画面となります。</p>
    <p>安否データのリストが必要な場合は管理者用ページよりログインください。</p>
  </div>
    <form class="form-horizontal" role="form" method="POST" action="{{ action('LoginController@postlogin') }}">
        {{ csrf_field() }}

        <div class="form-group{{ $errors->has('work_id') ? ' has-error' : '' }}">
            <label for="work_id" class="col-md-4 control-label">社員ID</label>

            <div class="col-md-6">
                <input id="work_id" type="work_id" class="form-control" name="work_id" value="{{ old('work_id') }}" required autofocus>

                @if ($errors->has('work_id'))
                    <span class="help-block">
                        <strong>{{ $errors->first('work_id') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
            <label for="password" class="col-md-4 control-label">パスワード</label>

            <div class="col-md-6">
                <input id="password" type="password" class="form-control" name="password" required>

                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-6 col-md-offset-4">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : ''}}> パスワードを記録する
                    </label>
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-8 col-md-offset-4">
                <button type="submit" class="btn btn-primary">
                    ログイン
                </button>

                <a class="btn btn-link" href="{{ url('/password/reset') }}">
                    パスワードを忘れてしまった?
                </a>
            </div>
        </div>
        <div>
          <a href="{{ url('../') }}">戻る</a>
        </div>
    </form>

</div>
@endsection