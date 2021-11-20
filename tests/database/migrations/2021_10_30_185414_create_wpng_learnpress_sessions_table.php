<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWpngLearnpressSessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wpng_learnpress_sessions', function (Blueprint $table) {
            $table->bigInteger('session_id')->unique('session_id');
            $table->char('session_key', 32)->nullable()->primary();
            $table->longText('session_value')->nullable();
            $table->bigInteger('session_expiry');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wpng_learnpress_sessions');
    }
}
