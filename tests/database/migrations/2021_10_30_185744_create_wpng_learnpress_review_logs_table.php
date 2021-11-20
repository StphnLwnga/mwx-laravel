<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWpngLearnpressReviewLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wpng_learnpress_review_logs', function (Blueprint $table) {
            $table->bigIncrements('review_log_id');
            $table->unsignedBigInteger('course_id')->default(0)->index('course_id');
            $table->unsignedBigInteger('user_id')->default(0)->index('user_id');
            $table->text('message')->nullable();
            $table->dateTime('date')->nullable();
            $table->string('status', 45)->nullable();
            $table->string('user_type', 45)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wpng_learnpress_review_logs');
    }
}
