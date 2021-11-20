<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWpngLearnpressQuestionAnswermetaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wpng_learnpress_question_answermeta', function (Blueprint $table) {
            $table->bigIncrements('meta_id');
            $table->unsignedBigInteger('learnpress_question_answer_id');
            $table->string('meta_key')->nullable();
            $table->longText('meta_value')->nullable();
            
            $table->index(['learnpress_question_answer_id', 'meta_key`(150'], 'question_answer_meta');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wpng_learnpress_question_answermeta');
    }
}
