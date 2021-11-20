<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWpngWoocommerceDownloadableProductPermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wpng_woocommerce_downloadable_product_permissions', function (Blueprint $table) {
            $table->bigIncrements('permission_id');
            $table->string('download_id', 36)->nullable();
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('order_id')->default(0)->index('order_id');
            $table->string('order_key', 200)->nullable();
            $table->string('user_email', 200)->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('downloads_remaining', 9)->nullable();
            $table->dateTime('access_granted')->default('0000-00-00 00:00:00');
            $table->dateTime('access_expires')->nullable();
            $table->unsignedBigInteger('download_count')->default(0);
            
            $table->index(['product_id', 'order_id', 'order_key`(16)', 'download_id'], 'download_order_key_product');
            $table->index(['download_id', 'order_id', 'product_id'], 'download_order_product');
            $table->index(['user_id', 'order_id', 'downloads_remaining', 'access_expires'], 'user_order_remaining_expires');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wpng_woocommerce_downloadable_product_permissions');
    }
}
