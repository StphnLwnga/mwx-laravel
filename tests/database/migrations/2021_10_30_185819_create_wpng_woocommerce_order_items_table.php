<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWpngWoocommerceOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wpng_woocommerce_order_items', function (Blueprint $table) {
            $table->bigIncrements('order_item_id');
            $table->text('order_item_name')->nullable();
            $table->string('order_item_type', 200)->nullable();
            $table->unsignedBigInteger('order_id')->index('order_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wpng_woocommerce_order_items');
    }
}
