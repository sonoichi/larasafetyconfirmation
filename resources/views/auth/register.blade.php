@extends('layout')

@section('css')
<link rel="stylesheet" href="http://code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css">
@endsection

@section('content')
<div class="contain0er" style="margin-top:2em">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <!--<div class="panel-heading">ユーザー登録</div>-->
                <div class="panel-body">
                    <form id="registForm" class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                        {{ csrf_field() }}
                    <h2 style="text-align:center;"><span class="underline">ユーザー<span class="hidden-xs">の</span>新規登録</span></h2>
                    <p>新規のユーザー登録をする際はこちらをご利用ください。</p>
                    @if ($errors->has('work_id') 
                    or $errors->has('name')
                    or $errors->has('email')
                    or $errors->has('password'))
                    <div class="container">
                      <ul>
                      @if ($errors->has('work_id'))
                        <li><strong class="text-danger">{{ $errors->first('work_id') }}</strong></li>
                      @endif
                      @if ($errors->has('department'))
                        <li><strong class="text-danger">{{ $errors->first('department') }}</strong></li>
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

                        <div class="form-group{{ $errors->has('department') ? ' has-error' : '' }}">
                            <label for="department" class="col-md-4 control-label">所属</label>

                            <div class="col-md-6">
                                <select id="department" class="form-control" name="department">
                                    <option value="">所属を選んでください</option>
                                    <option value="営業" {{ old('department')=="営業" ? 'selected':'' }}>営業</option>{{-- そのうちループさせる --}}
                                    <option value="営業第二" {{ old('department')=="営業第二" ? 'selected':'' }}>営業第二</option>
                                    <option value="営業第三" {{ old('department')=="営業第三" ? 'selected':'' }}>営業第三</option>
                                    <option value="営業第四" {{ old('department')=="営業第四" ? 'selected':'' }}>営業第四</option>
                                    <option value="営業第五" {{ old('department')=="営業第五" ? 'selected':'' }}>営業第五</option>
                                </select>
                                <!--@if ($errors->has('department'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('department') }}</strong>
                                    </span>
                                @endif-->
                            </div>
                        </div>
                        

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label" placeholder="例：田中太郎">名前</label>

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
                            <div class="" style="text-align:center;">
                                <button id="opener" type="button" class="registBtn btn btn-primary" style="">
                                    登録
                                </button>
                                <button type="reset" class="btn btn-danger" style="margin:0 1.4em;">
                                    リセット
                                </button>
                            <!-- 確認ダイアログ -->
                            <div id="dialog">
                            <p>登録しても宜しいでしょうか？</p>
                            </div>
                            </div>
                        </div>
                    </form>
                    <div class="col-md-offset-9 col-md-1 col-sm-offset-10 col-sm-2 col-xs-offset-8 col-xs-2"></p><a class="btn btn-default" href="../">戻る</a><p></div>
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