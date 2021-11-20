<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWpngWoocommerceTaxRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wpng_woocommerce_tax_rates', function (Blueprint $table) {
            $table->bigIncrements('tax_rate_id');
            $table->string('tax_rate_country', 2)->nullable()->index('tax_rate_country');
            $table->string('tax_rate_state', 200)->nullable();
            $table->string('tax_rate', 8)->nullable();
            $table->string('tax_rate_name', 200)->nullable();
            $table->unsignedBigInteger('tax_rate_priority')->index('tax_rate_priority');
            $table->integer('tax_rate_compound')->default(0);
            $table->integer('tax_rate_shipping')->default(1);
            $table->unsignedBigInteger('tax_rate_order');
            $table->string('tax_rate_class', 200)->nullable();
            
            $table->index(['tax_rate_state`(2'], 'tax_rate_state');
            $table->index(['tax_rate_class`(10'], 'tax_rate_class');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wpng_woocommerce_tax_rates');
    }
}
