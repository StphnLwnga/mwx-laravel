<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWpngActionschedulerClaimsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wpng_actionscheduler_claims', function (Blueprint $table) {
            $table->bigIncrements('claim_id');
            $table->dateTime('date_created_gmt')->default('0000-00-00 00:00:00')->index('date_created_gmt');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wpng_actionscheduler_claims');
    }
}
