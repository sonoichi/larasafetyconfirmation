<?php

use Illuminate\Database\Seeder;
// 追加
use Goodby\CSV\Import\Standard\Lexer;
use Goodby\CSV\Import\Standard\Interpreter;
use Goodby\CSV\Import\Standard\LexerConfig;

class DatabaseSeeder extends Seeder
{
    const CSV_FILENAME = '/list.csv';

    public function run()
    {
        $this->command->info('[Start] import data.');

        $config = new LexerConfig();
        $config->setDelimiter(",");
        $lexer = new Lexer($config);
        $interpreter = new Interpreter();
        $interpreter->addObserver(function(array $row) {
            // 各列のデータを取得
            $first = $row[0];
            $second = $row[1];
            $third = $row[2];
            $fourth = $row[3]; 
            $fifth = $row[4]; 
            $sixth = $row[5]; 
            $seventh = $row[6];
            $eighth = $row[7]; 

            // 登録処理をここに書く
            DB::table('worker_list')->insert(
                ['work_id' => $columns[0], 'name' => $columns[1], 'tell' => $columns[2], 'zip' => $columns[3], 
                'department' => $columns[4], 'manager' => $columns[5], 'manager_tell' => $columns[6], 
                'password' => $columns[7]]
            );
        });

        $lexer->parse(app_path() . self::CSV_FILENAME, $interpreter);

        $this->command->info('[End] import data.');
    }

}
