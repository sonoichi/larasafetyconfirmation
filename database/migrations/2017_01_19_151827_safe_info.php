<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SafeInfo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('safe_info', function (Blueprint $table) {
            $table->increments('work_id');
            $table->string('safety');
            $table->string('comment');
            $table->string('manager_coment');
            $table->timestamp('date');
            $table->timestamp('manager_to');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::dropIfExists('safe_info');
    }
}
