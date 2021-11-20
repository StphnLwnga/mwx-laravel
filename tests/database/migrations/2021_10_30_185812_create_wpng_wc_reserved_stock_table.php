<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWpngWcReservedStockTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wpng_wc_reserved_stock', function (Blueprint $table) {
            $table->bigInteger('order_id');
            $table->bigInteger('product_id');
            $table->double('stock_quantity')->default(0);
            $table->dateTime('timestamp')->default('0000-00-00 00:00:00');
            $table->dateTime('expires')->default('0000-00-00 00:00:00');
            
            $table->primary(['order_id', 'product_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wpng_wc_reserved_stock');
    }
}
