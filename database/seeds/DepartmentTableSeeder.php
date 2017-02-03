<?php

use Illuminate\Database\Seeder;

class DepartmentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //  安否報告テーブルに仮初期値100個をぶん投げる
        $workers = 1;
        $safe = ['問題ない','報告なし','問題あり'];
        for ($i = 0; $i <= 100; $i++){
            DB::table('department_list')->insert([
                'departmentcode' => $i,
                'manager_name' => $safe[array_rand($safe)],
                'department' => '',
                'manager_tell'=>'',
            ]);
        }
    }
}
