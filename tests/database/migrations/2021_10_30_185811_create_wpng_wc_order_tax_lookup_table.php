<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWpngWcOrderTaxLookupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wpng_wc_order_tax_lookup', function (Blueprint $table) {
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('tax_rate_id')->index('tax_rate_id');
            $table->dateTime('date_created')->default('0000-00-00 00:00:00')->index('date_created');
            $table->double('shipping_tax')->default(0);
            $table->double('order_tax')->default(0);
            $table->double('total_tax')->default(0);
            
            $table->primary(['order_id', 'tax_rate_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wpng_wc_order_tax_lookup');
    }
}
