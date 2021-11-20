<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWpngLearnpressSectionItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wpng_learnpress_section_items', function (Blueprint $table) {
            $table->bigIncrements('section_item_id');
            $table->unsignedBigInteger('section_id')->default(0);
            $table->unsignedBigInteger('item_id')->default(0);
            $table->unsignedBigInteger('item_order')->default(0);
            $table->string('item_type', 45)->nullable();
            
            $table->index(['section_id', 'item_id'], 'section_item');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wpng_learnpress_section_items');
    }
}
