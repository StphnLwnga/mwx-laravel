<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWpngLearnpressUserItemResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wpng_learnpress_user_item_results', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_item_id')->index('user_item_id');
            $table->longText('result')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wpng_learnpress_user_item_results');
    }
}
