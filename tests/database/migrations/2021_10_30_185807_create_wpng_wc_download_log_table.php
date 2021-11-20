<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWpngWcDownloadLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wpng_wc_download_log', function (Blueprint $table) {
            $table->bigIncrements('download_log_id');
            $table->dateTime('timestamp')->index('timestamp');
            $table->unsignedBigInteger('permission_id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('user_ip_address', 100)->nullable();
            
            $table->foreign('permission_id', 'fk_wpng_wc_download_log_permission_id')->references('permission_id')->on('wpng_woocommerce_downloadable_product_permissions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wpng_wc_download_log');
    }
}
