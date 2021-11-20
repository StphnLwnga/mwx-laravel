<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWpngWcOrderCouponLookupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wpng_wc_order_coupon_lookup', function (Blueprint $table) {
            $table->unsignedBigInteger('order_id');
            $table->bigInteger('coupon_id')->index('coupon_id');
            $table->dateTime('date_created')->default('0000-00-00 00:00:00')->index('date_created');
            $table->double('discount_amount')->default(0);
            
            $table->primary(['order_id', 'coupon_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wpng_wc_order_coupon_lookup');
    }
}
