<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWpngWcOrderProductLookupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wpng_wc_order_product_lookup', function (Blueprint $table) {
            $table->unsignedBigInteger('order_item_id')->primary();
            $table->unsignedBigInteger('order_id')->index('order_id');
            $table->unsignedBigInteger('product_id')->index('product_id');
            $table->unsignedBigInteger('variation_id');
            $table->unsignedBigInteger('customer_id')->nullable()->index('customer_id');
            $table->dateTime('date_created')->default('0000-00-00 00:00:00')->index('date_created');
            $table->integer('product_qty');
            $table->double('product_net_revenue')->default(0);
            $table->double('product_gross_revenue')->default(0);
            $table->double('coupon_amount')->default(0);
            $table->double('tax_amount')->default(0);
            $table->double('shipping_amount')->default(0);
            $table->double('shipping_tax_amount')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wpng_wc_order_product_lookup');
    }
}
