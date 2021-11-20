<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWpngTermsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wpng_terms', function (Blueprint $table) {
            $table->bigIncrements('term_id');
            $table->string('name', 200)->nullable();
            $table->string('slug', 200)->nullable();
            $table->bigInteger('term_group')->default(0);
            
            $table->index(['slug`(191'], 'slug');
            $table->index(['name`(191'], 'name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wpng_terms');
    }
}
