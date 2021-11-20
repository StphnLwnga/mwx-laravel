<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWpngLearnpressQuizQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wpng_learnpress_quiz_questions', function (Blueprint $table) {
            $table->bigIncrements('quiz_question_id');
            $table->unsignedBigInteger('quiz_id')->default(0)->index('quiz_id');
            $table->unsignedBigInteger('question_id')->default(0)->index('question_id');
            $table->unsignedBigInteger('question_order')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wpng_learnpress_quiz_questions');
    }
}
