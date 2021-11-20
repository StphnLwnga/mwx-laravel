<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWpngLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wpng_links', function (Blueprint $table) {
            $table->bigIncrements('link_id');
            $table->string('link_url')->nullable();
            $table->string('link_name')->nullable();
            $table->string('link_image')->nullable();
            $table->string('link_target', 25)->nullable();
            $table->string('link_description')->nullable();
            $table->string('link_visible', 20)->nullable()->index('link_visible');
            $table->unsignedBigInteger('link_owner')->default(1);
            $table->integer('link_rating')->default(0);
            $table->dateTime('link_updated')->default('0000-00-00 00:00:00');
            $table->string('link_rel')->nullable();
            $table->mediumText('link_notes')->nullable();
            $table->string('link_rss')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wpng_links');
    }
}
