<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMoworxOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('moworx_orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('userId');
            $table->bigInteger('productId');
            $table->string('orderId', 20)->nullable();
            $table->dateTime('createdAt')->useCurrent();
            $table->decimal('cost', 10, 0);
            $table->string('channel', 20)->nullable();
            $table->string('invoiceId', 20)->nullable();
            
            $table->foreign('productId', 'moworx_orders_ibfk_1')->references('product_id')->on('wpng_wc_product_meta_lookup');
            $table->foreign('userId', 'moworx_orders_ibfk_2')->references('id')->on('moworx_users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('moworx_orders');
    }
}
