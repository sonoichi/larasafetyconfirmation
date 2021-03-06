<?php

use Illuminate\Database\Seeder;

class SafeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //　クリア
        // DB::table('safe_info')->truncate();

        //  安否報告テーブルに仮初期値100個をぶん投げる
        //  artisan db:seed --class=SafeTableSeeder
        $workers = 1;
        $safe = ['問題ない','報告なし','問題あり'];
        for ($i = 0; $i <= 100; $i++){
            DB::table('safe_info')->insert([
                'work_id' => $i,
                'safety' => $safe[array_rand($safe)],
                'comment' => '',
            ]);
        }

    }
}
