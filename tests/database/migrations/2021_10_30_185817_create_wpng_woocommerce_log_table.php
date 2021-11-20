<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWpngWoocommerceLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wpng_woocommerce_log', function (Blueprint $table) {
            $table->bigIncrements('log_id');
            $table->dateTime('timestamp');
            $table->smallInteger('level')->index('level');
            $table->string('source', 200)->nullable();
            $table->longText('message')->nullable();
            $table->longText('context')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wpng_woocommerce_log');
    }
}
