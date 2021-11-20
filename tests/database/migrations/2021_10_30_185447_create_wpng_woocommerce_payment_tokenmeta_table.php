<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWpngWoocommercePaymentTokenmetaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wpng_woocommerce_payment_tokenmeta', function (Blueprint $table) {
            $table->bigIncrements('meta_id');
            $table->unsignedBigInteger('payment_token_id')->index('payment_token_id');
            $table->string('meta_key')->nullable();
            $table->longText('meta_value')->nullable();
            
            $table->index(['meta_key`(32'], 'meta_key');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wpng_woocommerce_payment_tokenmeta');
    }
}
