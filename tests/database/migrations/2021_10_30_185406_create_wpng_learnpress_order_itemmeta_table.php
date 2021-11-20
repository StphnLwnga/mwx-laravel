<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWpngLearnpressOrderItemmetaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wpng_learnpress_order_itemmeta', function (Blueprint $table) {
            $table->bigIncrements('meta_id');
            $table->unsignedBigInteger('learnpress_order_item_id')->default(0)->index('learnpress_order_item_id');
            $table->string('meta_key')->nullable();
            $table->string('meta_value')->nullable();
            $table->longText('extra_value')->nullable();
            
            $table->index(['meta_key`(190'], 'meta_key');
            $table->index(['meta_value`(190'], 'meta_value');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wpng_learnpress_order_itemmeta');
    }
}
