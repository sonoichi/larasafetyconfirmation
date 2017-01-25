@extends('layouts.app')

@section('content')
<div class="container" style="margin-top:2em">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <!--<div class="panel-heading">ユーザー登録</div>-->
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                        {{ csrf_field() }}
                    <h2>ユーザーの新規登録</h2>
                    <p>新規のユーザ登録をする際はこちらをご利用ください。<br/>
                    すべての入力が必須項目となりますのでご注意ください</p>
                    @if ($errors->has('work_id') 
                    or $errors->has('name')
                    or $errors->has('email')
                    or $errors->has('password'))
                    <div class="container">
                      <ul>
                        <li><strong>{{ $errors->first('work_id') }}</strong></li>
                        <li><strong>{{ $errors->first('name') }}</strong></li>
                        <li><strong>{{ $errors->first('email') }}</strong></li>
                        <li><strong>{{ $errors->first('password') }}</strong></li>
                      </ul>
                    </div>
                    @endif
                        <div class="form-group{{ $errors->has('work_id') ? ' has-error' : '' }}">
                            <label for="work_id" class="col-md-4 control-label">社員ID</label>

                            <div class="col-md-6">
                                <input id="work_id" type="text" class="form-control" name="work_id" value="{{ old('work_id') }}" required autofocus>

                                <!--@if ($errors->has('work_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('work_id') }}</strong>
                                    </span>
                                @endif-->
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">名前</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                <!--@if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif-->
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">メールアドレス</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                <!--@if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
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

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">確認用パスワード</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-primary">
                                    登録
                                </button>
                            </div>
                        </div>
                    </form>
                    <div class="col-md-12" style="text-align:right;"></p><a class="btn btn-default" href="../">戻る</a><p></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
