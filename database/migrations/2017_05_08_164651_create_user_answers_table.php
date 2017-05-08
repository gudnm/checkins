<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_answers', function(Blueprint $table) {
          $table->increments('id');
          $table->unsignedSmallInteger('question_id');
          $table->foreign('question_id')->references('id')->on('questions');
          $table->unsignedSmallInteger('answer_id');
          $table->foreign('answer_id')->references('id')->on('answers');
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
        //
    }
}
