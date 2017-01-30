@extends('layout')

@section('css')
<link rel="stylesheet" href="http://code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css">
@endsection

@section('content')
<div class="container" style="margin-top:2em">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <!--<div class="panel-heading">ユーザー登録</div>-->
                <div class="panel-body">
                    <form id="registForm" class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
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
                      @if ($errors->has('work_id'))
                        <li><strong class="text-danger">{{ $errors->first('work_id') }}</strong></li>
                      @endif
                      @if ($errors->has('name'))
                        <li><strong class="text-danger">{{ $errors->first('name') }}</strong></li>
                      @endif
                      @if ($errors->has('email'))
                        <li><strong class="text-danger">{{ $errors->first('email') }}</strong></li>
                      @endif
                      @if ($errors->has('password'))
                        <li><strong class="text-danger">{{ $errors->first('password') }}</strong></li>
                      @endif
                      </ul>
                    </div>
                    @endif
                        <div class="form-group{{ $errors->has('work_id') ? ' has-error' : '' }}">
                            <label for="work_id" class="col-md-4 control-label">社員ID</label>

                            <div class="col-md-6">
                                <input id="work_id" type="text" class="form-control" name="work_id" value="{{ old('work_id') }}"  autofocus>

                                <!--@if ($errors->has('work_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('work_id') }}</strong>
                                    </span>
                                @endif-->
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="department" class="col-md-4 control-label">所属</label>

                            <div class="col-md-6">
                                <!--<input id="department" type="text" class="form-control" name="department" value="{{ old('department') }}" autofocus>-->
                                <select class="form-control" name="department">
                                    <option value="営業">営業</option>{{-- そのうちループさせる --}}
                                    <option value="営業第二">営業第二</option>
                                    <option value="営業第三">営業第三</option>
                                    <option value="営業第四">営業第四</option>
                                    <option value="営業第五">営業第五</option>
                                </select>
                                <!--@if ($errors->has('department'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('department') }}</strong>
                                    </span>
                                @endif-->
                            </div>
                        </div>
                        

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">名前</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" autofocus>

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
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" >

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
                                <input id="password" type="password" class="form-control" name="password" >

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
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" >
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6">
                                <button id="opener" type="button" class="registBtn btn btn-primary">
                                    登録
                                </button>
                            <!-- 確認ダイアログ -->
                            <div id="dialog">
                            <p>登録しても宜しいでしょうか？</p>
                            </div>
                            </div>
                        </div>
                    </form>
                    <div class="col-md-12" style="text-align:right;"></p><a class="btn btn-default" href="../">戻る</a><p></div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- 確認ダイアログ -->
<!--<div id="registDialog">
  <p>登録しますか？</p>
</div>-->
@endsection

@section('script')
<script>
$( "#dialog" ).dialog({ autoOpen: false });

$( "#opener" ).click(function() {
    $( "#dialog" ).dialog( "open" );
    $( "#dialog" ).dialog({
      //autoOpen: false,
      title: "登録確認",
      resizable: false,
      height:240,
      modal: true,
      buttons: {
        "はい": function() {
        　$('#registForm').submit();
        },
        "いいえ": function() {
          $( this ).dialog( "close" );
        }
      }
    });
});
</script>	
@endsection