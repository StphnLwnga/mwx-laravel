<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWpngLearnpressUserItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wpng_learnpress_user_items', function (Blueprint $table) {
            $table->bigIncrements('user_item_id');
            $table->unsignedBigInteger('user_id')->default(0)->index('user_id');
            $table->unsignedBigInteger('item_id')->default(0)->index('item_id');
            $table->dateTime('start_time')->nullable();
            $table->dateTime('end_time')->nullable();
            $table->string('item_type', 45)->nullable()->index('item_type');
            $table->string('status', 45)->nullable()->index('status');
            $table->string('graduation', 20)->nullable();
            $table->integer('access_level')->default(50);
            $table->unsignedBigInteger('ref_id')->default(0)->index('ref_id');
            $table->string('ref_type', 45)->nullable()->index('ref_type');
            $table->unsignedBigInteger('parent_id')->default(0)->index('parent_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wpng_learnpress_user_items');
    }
}
