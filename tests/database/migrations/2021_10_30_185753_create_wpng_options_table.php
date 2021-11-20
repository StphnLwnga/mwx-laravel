<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWpngOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wpng_options', function (Blueprint $table) {
            $table->bigIncrements('option_id');
            $table->string('option_name', 191)->nullable()->unique('option_name');
            $table->longText('option_value')->nullable();
            $table->string('autoload', 20)->nullable()->index('autoload');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wpng_options');
    }
}
