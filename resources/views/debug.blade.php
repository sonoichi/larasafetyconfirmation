{{--{{DB::table('worker_list')->where('work_id','$currentID')->get()}}--}}
<?php
echo 'bladeから';
?>
@foreach($worker_lists as $worker_list)
<tr>
      <td>{{$worker_list->name}}</td>
      <td>{{$worker_list->tell}}</td>
      <td>{{$worker_list->email}}</td>
      <td>{{$worker_list->zip}}</td>
      <td>{{$worker_list->department}}</td>
      <td>{{$worker_list->manager_name}}</td>
      <td>{{$worker_list->manager_tell}}</td>
      <td><a href="{{ action('LoginController@edit') }}">編集</a></td>
</tr>
@endforeach