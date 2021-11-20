<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWpngPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wpng_posts', function (Blueprint $table) {
            $table->bigIncrements('ID');
            $table->unsignedBigInteger('post_author')->default(0)->index('post_author');
            $table->dateTime('post_date')->default('0000-00-00 00:00:00');
            $table->dateTime('post_date_gmt')->default('0000-00-00 00:00:00');
            $table->longText('post_content')->nullable();
            $table->text('post_title')->nullable();
            $table->text('post_excerpt')->nullable();
            $table->string('post_status', 20)->nullable();
            $table->string('comment_status', 20)->nullable();
            $table->string('ping_status', 20)->nullable();
            $table->string('post_password')->nullable();
            $table->string('post_name', 200)->nullable();
            $table->text('to_ping')->nullable();
            $table->text('pinged')->nullable();
            $table->dateTime('post_modified')->default('0000-00-00 00:00:00');
            $table->dateTime('post_modified_gmt')->default('0000-00-00 00:00:00');
            $table->longText('post_content_filtered')->nullable();
            $table->unsignedBigInteger('post_parent')->default(0)->index('post_parent');
            $table->string('guid')->nullable();
            $table->integer('menu_order')->default(0);
            $table->string('post_type', 20)->nullable();
            $table->string('post_mime_type', 100)->nullable();
            $table->bigInteger('comment_count')->default(0);
            
            $table->index(['post_name`(191'], 'post_name');
            $table->index(['post_type', 'post_status', 'post_date', 'ID'], 'type_status_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wpng_posts');
    }
}
