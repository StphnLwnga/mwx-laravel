<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWpngWcProductMetaLookupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wpng_wc_product_meta_lookup', function (Blueprint $table) {
            $table->bigInteger('product_id')->primary();
            $table->string('sku', 100)->nullable();
            $table->boolean('virtual')->nullable()->default(0)->index('virtual');
            $table->boolean('downloadable')->nullable()->default(0)->index('downloadable');
            $table->decimal('min_price', 19, 4)->nullable();
            $table->decimal('max_price', 19, 4)->nullable();
            $table->boolean('onsale')->nullable()->default(0)->index('onsale');
            $table->double('stock_quantity')->nullable()->index('stock_quantity');
            $table->string('stock_status', 100)->nullable()->index('stock_status');
            $table->bigInteger('rating_count')->nullable()->default(0);
            $table->decimal('average_rating', 3, 2)->nullable()->default(0.00);
            $table->bigInteger('total_sales')->nullable()->default(0);
            $table->string('tax_status', 100)->nullable();
            $table->string('tax_class', 100)->nullable();
            
            $table->index(['min_price', 'max_price'], 'min_max_price');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wpng_wc_product_meta_lookup');
    }
}
