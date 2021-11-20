<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWpngWoocommercePaymentTokensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wpng_woocommerce_payment_tokens', function (Blueprint $table) {
            $table->bigIncrements('token_id');
            $table->string('gateway_id', 200)->nullable();
            $table->text('token')->nullable();
            $table->unsignedBigInteger('user_id')->default(0)->index('user_id');
            $table->string('type', 200)->nullable();
            $table->boolean('is_default')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wpng_woocommerce_payment_tokens');
    }
}
