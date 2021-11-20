<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWpngWpformsTasksMetaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wpng_wpforms_tasks_meta', function (Blueprint $table) {
            $table->bigInteger('id')->primary();
            $table->string('action')->nullable();
            $table->longText('data')->nullable();
            $table->dateTime('date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wpng_wpforms_tasks_meta');
    }
}
