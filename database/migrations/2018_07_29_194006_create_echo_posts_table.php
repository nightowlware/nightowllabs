<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEchoPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('echo_posts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
//            $table->foreign('user_id')
//                ->references('id')->on('users')
//                ->onDelete('cascade');
            $table->text('headers');
            $table->text('body');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('echoes');
    }
}
