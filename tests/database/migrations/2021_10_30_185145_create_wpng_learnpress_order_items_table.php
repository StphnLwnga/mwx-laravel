<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWpngLearnpressOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wpng_learnpress_order_items', function (Blueprint $table) {
            $table->bigIncrements('order_item_id');
            $table->longText('order_item_name')->nullable();
            $table->unsignedBigInteger('order_id')->default(0)->index('order_id');
            $table->unsignedBigInteger('item_id')->default(0)->index('item_id');
            $table->string('item_type', 45)->nullable()->index('item_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wpng_learnpress_order_items');
    }
}
