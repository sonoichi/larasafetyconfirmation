<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class WorkerList extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('worker_list', function (Blueprint $table) {
            $table->increments('work_id');
            $table->string('name');
            $table->string('tell');
            $table->string('email');
            $table->string('zip');
            $table->string('department');
            $table->string('manager_name');
            $table->string('manager_tell');
            $table->boolean('safe_flag');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
