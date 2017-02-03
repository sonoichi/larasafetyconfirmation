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
