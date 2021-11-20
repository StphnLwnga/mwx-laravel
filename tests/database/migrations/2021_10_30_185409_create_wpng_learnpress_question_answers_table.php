<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWpngLearnpressQuestionAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wpng_learnpress_question_answers', function (Blueprint $table) {
            $table->bigIncrements('question_answer_id');
            $table->unsignedBigInteger('question_id')->default(0)->index('question_id');
            $table->text('title')->nullable();
            $table->string('value', 32)->nullable();
            $table->unsignedBigInteger('order')->default(1);
            $table->string('is_true', 3)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wpng_learnpress_question_answers');
    }
}
