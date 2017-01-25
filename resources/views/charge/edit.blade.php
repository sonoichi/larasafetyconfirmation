@extends('layout')

@section('content')
<div class="container">
  <h2>安否確認：編集画面</h2>
  <!-- 確認用 --> 
  {{-- Session::get('editWorker') --}}
  
  <p>編集中の社員の安否情報</p>
<div>
    <table class="table">
    <tr>
    <td>社員ID</td>
    <td>氏名</td>
    <td>状態</td>
    <td>コメント</td>
    <td>投稿時間</td>
    </tr>
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

  <hr>

<h2>編集フォーム</h2>

{!! Form::open(['action' => 'EditController@update']) !!}
    {{ csrf_field() }}

    @foreach($editUser as $worker_list)
        <input id="work_id" type="hidden" name="work_id" value="{{ $worker_list->work_id }}">
    @endforeach
    <h3>状態</h3>
    <div class="form-group{{ $errors->has('safety') ? ' has-error' : '' }}">
        <div class="col-md-12">
            <input id="noReport" type="radio" name="safety" value="報告なし">報告なし　　　
            <input id="good" type="radio" name="safety" value="問題ない">もんだいなし　　　
            <input id="bad" type="radio" name="safety" value="問題あり">もんだいあり
            <!--<p class="alert-info">* ボタンが選択されない場合は報告なしになります。</p>-->
            <p></p>
        </div>
    </div>

    <h3>コメント</h3>
    <div class="form-group{{ $errors->has('comment') ? ' has-error' : '' }}">
        <label for="comment" class="col-md-2 control-label">コメント</label>

        <div class="col-md-12">
            <input id="comment" type="comment" class="form-control" name="comment" value="{{ Session::get('editComment') }}" readonly="readonly">
            <p class="text-danger">* 編集中の社員のコメントが直接編集されます。現在は読取専用となっています。</p>
        </div>
    </div>

    <h3>管理者からのコメント</h3>
    <div class="form-group{{ $errors->has('manager_comment') ? ' has-error' : '' }}">
        <label for="manager_comment" class="col-md-2 control-label">コメント</label>

        <div class="col-md-12">
            <input id="manager_comment" type="manager_comment" class="form-control" name="manager_comment" value="{{Session::get('editManager_comment')}}">
            <p></p>
        </div>
    </div>

    <div style="text-align:right" class="form-group">
        <div class="col-md-12">
            <button type="submit" class="edit btn btn-primary">
                編集
            </button>
        </div>
    </div>
{!! Form::close() !!}
<div class="col-md-12">
    <a class="btn btn-default" href="{{ action('LoginController@charge') }}">戻る</a>
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
@endsection