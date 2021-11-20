<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWpngWcWebhooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wpng_wc_webhooks', function (Blueprint $table) {
            $table->bigIncrements('webhook_id');
            $table->string('status', 200)->nullable();
            $table->text('name')->nullable();
            $table->unsignedBigInteger('user_id')->index('user_id');
            $table->text('delivery_url')->nullable();
            $table->text('secret')->nullable();
            $table->string('topic', 200)->nullable();
            $table->dateTime('date_created')->default('0000-00-00 00:00:00');
            $table->dateTime('date_created_gmt')->default('0000-00-00 00:00:00');
            $table->dateTime('date_modified')->default('0000-00-00 00:00:00');
            $table->dateTime('date_modified_gmt')->default('0000-00-00 00:00:00');
            $table->smallInteger('api_version');
            $table->smallInteger('failure_count')->default(0);
            $table->boolean('pending_delivery')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wpng_wc_webhooks');
    }
}
