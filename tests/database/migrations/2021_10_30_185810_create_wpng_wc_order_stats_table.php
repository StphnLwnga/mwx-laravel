<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWpngWcOrderStatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wpng_wc_order_stats', function (Blueprint $table) {
            $table->unsignedBigInteger('order_id')->primary();
            $table->unsignedBigInteger('parent_id')->default(0);
            $table->dateTime('date_created')->default('0000-00-00 00:00:00')->index('date_created');
            $table->dateTime('date_created_gmt')->default('0000-00-00 00:00:00');
            $table->integer('num_items_sold')->default(0);
            $table->double('total_sales')->default(0);
            $table->double('tax_total')->default(0);
            $table->double('shipping_total')->default(0);
            $table->double('net_total')->default(0);
            $table->tinyInteger('returning_customer')->nullable();
            $table->string('status', 200)->nullable();
            $table->unsignedBigInteger('customer_id')->index('customer_id');
            
            $table->index(['status`(191'], 'status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wpng_wc_order_stats');
    }
}
