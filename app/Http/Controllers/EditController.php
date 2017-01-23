<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class EditController extends Controller
{
    public function update(Request $request)
    {
        $input = \Request::all();
        //確認用 
        print_r($input);
        echo $_POST['safety'];
        DB::table('safe_info')
           ->where('work_id',$_POST['work_id'])
           ->update(['safety' => $_POST['safety']]);

        return '送信されました';
    }
}
