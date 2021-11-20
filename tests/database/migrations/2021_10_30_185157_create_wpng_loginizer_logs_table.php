<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWpngLoginizerLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wpng_loginizer_logs', function (Blueprint $table) {
            $table->string('username')->default('');
            $table->integer('time')->default(0);
            $table->integer('count')->default(0);
            $table->integer('lockout')->default(0);
            $table->string('ip')->default('')->unique('ip');
            $table->string('url')->default('');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wpng_loginizer_logs');
    }
}
